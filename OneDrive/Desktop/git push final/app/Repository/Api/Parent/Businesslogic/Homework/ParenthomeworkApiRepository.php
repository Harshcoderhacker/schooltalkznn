<?php

namespace App\Repository\Api\Parent\Businesslogic\Homework;

use App\Events\Homeworkevent\HomeworklistEvent;
use App\Http\Resources\Parent\Homework\Homeworkcomment\ParenthomeworkcommentCollection;
use App\Http\Resources\Parent\Homework\Homeworkdetails\ParenthomeworkdetailsResource;
use App\Http\Resources\Parent\Homework\Homeworksubjectwiselist\ParenthomeworksubjectwiselistCollection;
use App\Http\Resources\Parent\Homework\Homeworksubject\ParenthomeworksubjectCollection;
use App\Models\Admin\Homework\Homework;
use App\Models\Admin\Homework\Homeworkcomment;
use App\Models\Admin\Homework\Homeworklist;
use App\Models\Admin\Settings\Academicsetting\Assignsubject;
use App\Models\Admin\Settings\Academicsetting\Subject;
use App\Models\Commonhelper\Homeworkcomment\Homeworkcommenthelper;
use App\Models\Parent\Parenthelper\Parenthelper;
use App\Repository\Api\Parent\Interfacelayer\Homework\IParenthomeworkApiRepository;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class ParenthomeworkApiRepository implements IParenthomeworkApiRepository
{
    public function parentgetallhomeworksubject()
    {
        $user = Parenthelper::getstudent();
        return [true,
            new ParenthomeworksubjectCollection(Assignsubject::getsubjectlist($user->classmaster_id, $user->section_id)->get()),
            'parentgetallhomeworksubject'];
    }

    public function parentgethomeworksubjectlistbyuuid()
    {
        $user = Parenthelper::getstudent();

        $data = [
            'subject_name' => Subject::whereHas('assignsubject', fn(Builder $q) => $q->where('uuid', request('assignsubject_uuid')))->first()?->name,
            'unread_count' => Homeworklist::where('student_id', $user->id)
                ->whereNull('read_at')
                ->whereHas('homework', fn(Builder $q) =>
                    $q->whereHas('assignsubject', fn(Builder $q) =>
                        $q->where('uuid', request('assignsubject_uuid'))))->count(),
            'homeworklist' => new ParenthomeworksubjectwiselistCollection(
                Homework::whereHas('assignsubject', fn(Builder $q) => $q->where('uuid', request('assignsubject_uuid')))
                    ->whereHas('homeworklist', fn(Builder $q) => $q->where('student_id', $user->id))
                    ->with(['homeworklist' => fn($q) => $q->where('student_id', $user->id)])
                    ->latest()
                    ->paginate(15)),
        ];

        Homeworklist::where('student_id', $user->id)
            ->whereNull('read_at')
            ->whereHas('homework', fn(Builder $q) =>
                $q->whereHas('assignsubject', fn(Builder $q) =>
                    $q->where('uuid', request('assignsubject_uuid'))))
            ->update(['read_at' => Carbon::now()]);
        DB::commit();

        return [true, $data, 'parentgethomeworksubjectlistbyuuid'];

    }

    public function parentgethomeworkdetailsbyuuid()
    {

        $homework = Homeworklist::where('uuid', request('homeworklist_uuid'))
            ->with('homework')
            ->first();

        if (collect([1, 4])->contains($homework->staff_homework_status) && $homework->homework_status == false) {
            $homework->update(["staff_homework_status" => 2]);
        }

        return [true,
            new ParenthomeworkdetailsResource($homework),
            'parentgethomeworkdetailsbyuuid'];
    }

    public function parentdownloadhomeworkattachment()
    {
        return Storage::download(Homework::where('uuid', request('homework_uuid'))->first()->attachment);
    }

    public function parentposthomeworksubmission()
    {

        $homeworklist = Homeworklist::where('uuid', request('homeworklist_uuid'))
            ->first();

        $existingsubmissionfile = $homeworklist->submissionfile;

        $homeworklist->update([
            'submissionfile' => request('submissionfile')
                ->storeAs('homeworksubmission/' . $homeworklist->homework->classmaster->uniqid,
                    time() . request('submissionfile')->getClientOriginalExtension()), 'staff_homework_status' => 3, 'homework_status' => 1,
        ]);

        if ($existingsubmissionfile) {
            Storage::delete($existingsubmissionfile);
        }

        DB::commit();

        event(new HomeworklistEvent($homeworklist, Parenthelper::getstudent(), 'SUBMISSION'));

        return [true, 'success', 'parentposthomeworksubmission'];
    }

    public function parentgethomeworkcommentlistbyuuid()
    {

        $homeworklist_id = Homeworklist::where('uuid', request('homeworklist_uuid'))->first()->id;

        Parenthelper::getstudent()
            ->homeworkcommentreceiver()
            ->where('homeworklist_id', $homeworklist_id)
            ->update(['read_at' => Carbon::now()]);

        DB::commit();
        return [true,
            new ParenthomeworkcommentCollection(
                Homeworkcomment::where('homeworklist_id', $homeworklist_id)
                    ->latest()
                    ->paginate(15)),
            'parentgethomeworkcommentlistbyuuid'];
    }

    public function parentposthomeworkcomment()
    {
        Homeworkcommenthelper::homeworkcommentpost(
            Parenthelper::getstudent(),
            request('body'),
            Homeworklist::with('homework')->where('uuid', request('homeworklist_uuid'))->first());
        DB::commit();
        return [true, 'success', 'parentposthomeworkcomment'];
    }
}
