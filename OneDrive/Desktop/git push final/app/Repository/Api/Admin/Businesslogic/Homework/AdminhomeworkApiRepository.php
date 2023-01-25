<?php

namespace App\Repository\Api\Admin\Businesslogic\Homework;

use App\Events\Homeworkevent\HomeworklistEvent;
use App\Http\Resources\Admin\Homework\Homeworkcomment\AdminhomeworkcommentCollection;
use App\Http\Resources\Admin\Homework\Homeworkdetail\AdminHomeworkdetailResource;
use App\Http\Resources\Admin\Homework\Homeworklist\AdminsubjectwisehomeworklistCollection;
use App\Http\Resources\Admin\Homework\Homeworkrecent\AdminhomeworkrecentCollection;
use App\Http\Resources\Admin\Homework\Homeworksubject\AdminhomeworksubjectCollection;
use App\Models\Admin\Homework\Homework;
use App\Models\Admin\Homework\Homeworkcomment;
use App\Models\Admin\Homework\Homeworklist;
use App\Models\Admin\Settings\Academicsetting\Assignsubject;
use App\Models\Admin\Settings\Academicsetting\Classmaster;
use App\Models\Admin\Student\Student;
use App\Models\Commonhelper\Homeworkcomment\Homeworkcommenthelper;
use App\Models\Miscellaneous\Helper;
use App\Repository\Api\Admin\Interfacelayer\Homework\IAdminhomeworkApiRepository;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class AdminhomeworkApiRepository implements IAdminhomeworkApiRepository
{
    public function admingetrecenthomeworklist()
    {
        return [true,
            new AdminhomeworkrecentCollection(Homework::latest()->take(7)->get()),
            'admingetrecenthomeworklist'];
    }

    public function adminclasssectionwisesubjectlist()
    {
        return [true,
            new AdminhomeworksubjectCollection(Assignsubject::whereHas('classmaster',
                fn(Builder $q) => $q->where('uuid', request('class_uuid'))
            )->whereHas('section',
                fn(Builder $q) => $q->where('uuid', request('section_uuid')))
                    ->get()),
            'adminclasssectionwisesubjectlist'];

    }
    public function adminsubjectwisehomeworklist()
    {
        return [true,
            new AdminsubjectwisehomeworklistCollection(
                Homework::whereHas('assignsubject',
                    fn(Builder $q) => $q->where('uuid', request('assignsubject_uuid')))
                    ->latest()
                    ->paginate(15)),
            'adminsubjectwisehomeworklist',
        ];
    }

    public function adminstudentwisehomeworkdetails()
    {

        $homework = Homework::where('uuid', request('homework_uuid'))->first();
        $classandsection = ($homework->classmaster ? $homework->classmaster->name : '') . ' ' . ($homework->section ? $homework->section->name : '');
        return [true,
            [
                'homework_title' => $homework->title,
                'classandsection' => $classandsection,
                'homeworklist' => AdminHomeworkdetailResource::collection(
                    Homeworklist::where('homework_id', $homework->id)
                        ->with('student', 'homeworkcomment')
                        ->get()
                )], 'adminstudentwisehomeworkdetails'];
    }

    public function adminsubjectwisehomeworkpost()
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
                    'staff_id' => $assignsubject->staff->id ? $assignsubject->staff->id : null,
                    'academicyear_id' => App::make('generalsetting')->academicyear_id,
                    'usertype' => request()->user()->usertype,
                    'attachment' => request('attachment') ? $this->savehomeworkattachment($assignsubject) : null,
                ]
            ));

        Student::getourclass(App::make('generalsetting')->academicyear_id, $assignsubject->classmaster->id, $assignsubject->section_id)
            ->pluck('id')
            ->each(fn($eachstudent_id) =>
                $homework->homeworklist()->create(['student_id' => $eachstudent_id]));

        Helper::trackmessage(request()->user(), 'Admin Admin Homework Create ',
            'admin_api_adminsubjectwisehomeworkpost',
            substr(request()->header('authorization'), -33),
            'API');

        DB::commit();

        return [true, 'success', 'adminsubjectwisehomeworkpost'];
    }

    public function admindownloadhomeworkattachment()
    {
        return Storage::download(Homework::where('uuid', request('homework_uuid'))->first()->attachment);
    }

    public function admindownloadstudenthomework()
    {
        return Storage::download(Homeworklist::where('uuid', request('homeworklist_uuid'))->first()->submissionfile);
    }

    public function adminupdatehomeworkstatus()
    {
        $homeworklist = Homeworklist::where('uuid', request('homeworklist_uuid'))->first();

        $homeworklist->update([
            'staff_homework_status' => 4,
            'homework_status' => 0,
        ]);

        DB::commit();
        event(new HomeworklistEvent($homeworklist, auth()->user(), 'REJECTED'));
        return [true, 'success', 'adminupdatehomeworkstatus'];
    }

    public function admingethomeworkcommentlistbyuuid()
    {
        $homeworklist_id = Homeworklist::where('uuid', request('homeworklist_uuid'))->first()->id;

        auth()->user()
            ->homeworkcommentreceiver()
            ->where('homeworklist_id', $homeworklist_id)
            ->update(['read_at' => Carbon::now()]);

        return [true,
            new AdminhomeworkcommentCollection(
                Homeworkcomment::where('homeworklist_id', $homeworklist_id)
                    ->latest()
                    ->paginate(15)),
            'admingethomeworkcommentlistbyuuid'];
    }

    public function adminposthomeworkcomment()
    {

        Homeworkcommenthelper::homeworkcommentpost(
            auth()->user(),
            request('body'),
            Homeworklist::with('homework')->where('uuid', request('homeworklist_uuid'))->first());

        DB::commit();

        return [true, 'success', 'adminposthomeworkcomment'];

    }

    protected function savehomeworkattachment($assignsubject)
    {

        return request('attachment')
            ->storeAs('homework/' . $assignsubject->classmaster->uniqid,
                time() . '.' . request('attachment')->getClientOriginalExtension());

    }
}
