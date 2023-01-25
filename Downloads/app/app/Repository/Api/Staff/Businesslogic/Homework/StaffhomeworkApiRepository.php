<?php

namespace App\Repository\Api\Staff\Businesslogic\Homework;

use App\Events\Homeworkevent\HomeworklistEvent;
use App\Http\Resources\Staff\Homework\Homeworkcomment\StaffhomeworkcommentCollection;
use App\Http\Resources\Staff\Homework\Homeworkdetail\StaffHomeworkdetailResource;
use App\Http\Resources\Staff\Homework\Homeworklist\StaffsubjectwisehomeworklistCollection;
use App\Http\Resources\Staff\Homework\Homeworkrecent\StaffhomeworkrecentCollection;
use App\Http\Resources\Staff\Homework\Homeworksubject\StaffhomeworksubjectCollection;
use App\Models\Admin\Homework\Homework;
use App\Models\Admin\Homework\Homeworkcomment;
use App\Models\Admin\Homework\Homeworklist;
use App\Models\Admin\Settings\Academicsetting\Assignsubject;
use App\Models\Admin\Student\Student;
use App\Models\Commonhelper\Homeworkcomment\Homeworkcommenthelper;
use App\Models\Miscellaneous\Helper;
use App\Repository\Api\Staff\Interfacelayer\Homework\IStaffhomeworkApiRepository;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class StaffhomeworkApiRepository implements IStaffhomeworkApiRepository
{
    public function staffgetrecenthomeworklist()
    {
        return [true,
            new StaffhomeworkrecentCollection(Homework::whereHas('assignsubject',
                fn(Builder $q) => $q->where('staff_id', request()->user()->id))
                    ->latest()
                    ->take(7)
                    ->get()),
            'staffgetrecenthomeworklist'];
    }

    public function staffclasssectionwisesubjectlist()
    {
        return [true,
            new StaffhomeworksubjectCollection(Assignsubject::where('staff_id', request()->user()->id)
                    ->get()),
            'staffclasssectionwisesubjectlist'];
    }

    public function staffsubjectwisehomeworklist()
    {
        return [true,
            new StaffsubjectwisehomeworklistCollection(
                Homework::whereHas('assignsubject',
                    fn(Builder $q) => $q->where('uuid', request('assignsubject_uuid')))
                    ->latest()
                    ->paginate(15)),
            'staffsubjectwisehomeworklist',
        ];
    }

    public function staffhomeworkdetailsbyuuid()
    {
        $homework = Homework::where('uuid', request('homework_uuid'))->first();
        $classandsection = ($homework->classmaster ? $homework->classmaster->name : '') . ' ' . ($homework->section ? $homework->section->name : '');
        return [true,
            [
                'homework_title' => $homework->title,
                'classandsection' => $classandsection,
                'homeworklist' => StaffHomeworkdetailResource::collection(
                    Homeworklist::where('homework_id', $homework->id)
                        ->with('student', 'homeworkcomment')
                        ->get()
                )], 'staffhomeworkdetailsbyuuid'];
    }

    public function staffsubjectwisehomeworkpost()
    {
        $assignsubject = Assignsubject::where('uuid', request('assignsubject_uuid'))->first();
        $homework = request()->user()->homework()
            ->save(new Homework(
                [
                    'title' => request('title'),
                    'description' => request('description'),
                    'marks' => request('marks'),
                    "due_date" => Carbon::parse(request('due_date')),
                    'classmaster_id' => $assignsubject->classmaster->id,
                    'section_id' => $assignsubject->section->id,
                    'assignsubject_id' => $assignsubject->id,
                    'staff_id' => request()->user()->id,
                    'academicyear_id' => App::make('generalsetting')->academicyear_id,
                    'usertype' => request()->user()->usertype,
                    'attachment' => request('attachment') ? $this->savehomeworkattachment($assignsubject) : null,
                ]
            ));

        Student::getourclass(App::make('generalsetting')->academicyear_id, $assignsubject->classmaster->id, $assignsubject->section_id)
            ->pluck('id')
            ->each(fn($eachstudent_id) =>
                $homework->homeworklist()->create(['student_id' => $eachstudent_id]));

        Helper::trackmessage(request()->user(), 'Staff Staff Homework Create ',
            'staff_api_staffsubjectwisehomeworkpost',
            substr(request()->header('authorization'), -33),
            'API');

        DB::commit();

        return [true, 'success', 'staffsubjectwisehomeworkpost'];
    }

    public function staffdownloadhomeworkattachment()
    {
        return Storage::download(Homework::where('uuid', request('homework_uuid'))->first()->attachment);
    }

    public function staffdownloadstudenthomework()
    {
        return Storage::download(Homeworklist::where('uuid', request('homeworklist_uuid'))->first()->submissionfile);
    }

    public function staffupdatehomeworkstatus()
    {
        $homeworklist = Homeworklist::where('uuid', request('homeworklist_uuid'))->first();

        $homeworklist->update([
            'staff_homework_status' => 4, // Not Completed for staff
            'homework_status' => 0, // Not Completed for student
        ]);

        DB::commit();
        event(new HomeworklistEvent($homeworklist, auth()->user(), 'REJECTED'));

        return [true, 'success', 'staffupdatehomeworkstatus'];
    }

    public function staffgethomeworkcommentlistbyuuid()
    {
        $homeworklist_id = Homeworklist::where('uuid', request('homeworklist_uuid'))->first()->id;

        auth()->user()
            ->homeworkcommentreceiver()
            ->where('homeworklist_id', $homeworklist_id)
            ->update(['read_at' => Carbon::now()]);

        return [true,
            new StaffhomeworkcommentCollection(
                Homeworkcomment::where('homeworklist_id', $homeworklist_id)
                    ->latest()
                    ->paginate(15)),
            'staffgethomeworkcommentlistbyuuid'];
    }

    public function staffposthomeworkcomment()
    {
        Homeworkcommenthelper::homeworkcommentpost(
            auth()->user(),
            request('body'),
            Homeworklist::with('homework')->where('uuid', request('homeworklist_uuid'))->first());

        DB::commit();

        return [true, 'success', 'staffposthomeworkcomment'];
    }

    protected function savehomeworkattachment($assignsubject)
    {

        return request('attachment')
            ->storeAs('homework/' . $assignsubject->classmaster->uniqid,
                time() . '.' . request('attachment')->getClientOriginalExtension());

    }
}
