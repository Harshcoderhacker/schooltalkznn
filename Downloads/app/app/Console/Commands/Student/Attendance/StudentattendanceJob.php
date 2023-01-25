<?php

namespace App\Console\Commands\Student\Attendance;

use App\Models\Admin\Settings\Schoolsetting\Holiday;
use App\Models\Admin\Settings\Schoolsetting\Weekend;
use App\Models\Admin\Student\Attendance\Studentattendance;
use App\Models\Jobhelper\Student\Studentattendancehelper;
use Carbon\Carbon;
use DB;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;

class StudentattendanceJob extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'student:attendance';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Student Attendance Job';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        try {
            DB::beginTransaction();
            $todaydate = Carbon::today();
            $weekends = Weekend::where('shortname', Carbon::today()->format('D'))->where('is_holiday', true)->get();
            $holidays = Holiday::where('active', true)
                ->whereDate('start_date', '<=', Carbon::today()->format("Y-m-d"))
                ->whereDate('end_date', '>=', Carbon::today()->format("Y-m-d"))
                ->get();
            if (sizeof($weekends) > 0) {
                Log::info("Student Cron is working fine! Oops!!! Job not Executed Date: " . $todaydate->format('d-M-Y') . ". It's a weekend");
            } elseif (sizeof($holidays) > 0) {
                Log::info("Student Cron is working fine! Oops!!! Job not Executed Date: " . $todaydate->format('d-M-Y') . ". It's a holiday");
            } elseif (Studentattendance::whereDate('attendance_date', $todaydate)->count() == 0 && sizeof($weekends) == 0 && sizeof($holidays) == 0) {
                Studentattendancehelper::generateattendancerecord($todaydate);
                Log::info("Student Cron is working fine! Date: " . $todaydate->format('d-M-Y'));
            } else {
                Log::info("Student Cron is working fine! Oops!!! Job already Executed Date: " . $todaydate->format('d-M-Y'));
            }

            DB::commit();
        } catch (Exception $e) {
            DB::rollback();
            Log::error('Exception one: studentattendancehelper  Error: ' . $e->getMessage());
        } catch (QueryException $e) {
            DB::rollback();
            Log::error('Exception two: studentattendancehelper  Error: ' . $e->getMessage());
        } catch (PDOException $e) {
            DB::rollback();
            Log::error('Exception three: studentattendancehelper  Error: ' . $e->getMessage());
        }

    }
}
