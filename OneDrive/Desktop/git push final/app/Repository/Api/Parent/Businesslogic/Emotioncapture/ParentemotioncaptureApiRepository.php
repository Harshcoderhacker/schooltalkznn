<?php

namespace App\Repository\Api\Parent\Businesslogic\Emotioncapture;

use App\Models\Admin\Emotioncapture\Emotioncapture;
use App\Models\Admin\Settings\Schoolsetting\Holiday;
use App\Models\Admin\Settings\Schoolsetting\Weekend;
use App\Models\Parent\Parenthelper\Parenthelper;
use App\Repository\Api\Parent\Interfacelayer\Emotioncapture\IParentemotioncaptureApiRepository;
use Carbon\Carbon;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\DB;

class ParentemotioncaptureApiRepository implements IParentemotioncaptureApiRepository
{
    public function parentstoreemotioncapture()
    {
        $user = Parenthelper::getstudent();
        $academicyear_id = App::make('generalsetting')->academicyear_id;

        Emotioncapture::updateOrCreate([
            'classmaster_id' => $user->classmaster_id,
            'section_id' => $user->section_id,
            'aparent_id' => $user->aparent_id,
            'academicyear_id' => $academicyear_id,
            'student_id' => $user->id,
            'emotioncapturedate' => Carbon::today()],
            [
                'emotionstatus' => request('emotion_status'),

            ]);
        DB::commit();
        return [true, 'Emotion Captured',
            'parentstoreemotioncapture'];
    }

    public function parentcheckemotioncapture()
    {
        $user = Parenthelper::getstudent();
        $academicyear_id = App::make('generalsetting')->academicyear_id;
        $weekends = Weekend::where('shortname', Carbon::today()->format('D'))->where('is_holiday', true)->get();
        $holidays = Holiday::where('active', true)
            ->whereDate('start_date', '<=', Carbon::today()->format("Y-m-d"))
            ->whereDate('end_date', '>=', Carbon::today()->format("Y-m-d"))
            ->get();
        if (sizeof($weekends) > 0) {
            return [true, ['emotionstatus' => true], 'parentcheckemotioncapture'];
        } elseif (sizeof($holidays) > 0) {
            return [true, ['emotionstatus' => true], 'parentcheckemotioncapture'];
        } else {
            $emotion = Emotioncapture::where('emotioncapturedate', Carbon::today())
                ->where('student_id', $user->id)
                ->where('academicyear_id', $academicyear_id)
                ->where('classmaster_id', $user->classmaster_id)
                ->where('section_id', $user->section_id)
                ->first();
            return [true,
                ['emotionstatus' => $emotion == null || $emotion->emotionstatus == 0 ? false : true,
                ]
                , 'parentcheckemotioncapture'];
        }

    }
    public function parentcalendaremotioncapture()
    {
        $user = Parenthelper::getstudent();
        $academicyear_id = App::make('generalsetting')->academicyear_id;
        $today = \Carbon\Carbon::createFromFormat('Y-m-d H:s:i', request('year') . '-' . request('month') . '-5 3:30:34');
        $dates = [];
        for ($i = 1; $i < $today->daysInMonth + 1; ++$i) {
            $dates[] = \Carbon\Carbon::createFromDate($today->year, $today->month, $i)->format('d');
        }
        $everydayemotion = [];

        foreach ($dates as $key => $value) {
            $emotion = Emotioncapture::whereMonth('emotioncapturedate', request('month'))
                ->whereYear('emotioncapturedate', request('year'))
                ->whereDay('emotioncapturedate', (int) $value)
                ->where('student_id', $user->id)
                ->where('academicyear_id', $academicyear_id)
                ->where('classmaster_id', $user->classmaster_id)
                ->where('section_id', $user->section_id)
                ->first();
            array_push($everydayemotion, [
                'date' => $value,
                'emotion_status' => $emotion == null ? '' : (($emotion->emotionstatus == 0) ? '' : $emotion->emotionstatus),

            ]);
        }
        return [true, $everydayemotion, 'parentcalendaremotioncapture'];

    }
}
