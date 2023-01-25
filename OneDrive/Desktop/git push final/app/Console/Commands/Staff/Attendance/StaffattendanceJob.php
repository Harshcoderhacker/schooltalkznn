<?php

namespace App\Console\Commands\Staff\Attendance;

use App\Models\Admin\Staff\Attendance\Staffattendance;
use App\Models\Jobhelper\Staff\Staffattendancehelper;
use Carbon\Carbon;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class StaffattendanceJob extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'staff:attendance';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Staff Attendance Job';

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

            if (Staffattendance::whereDate('attendance_date', $todaydate)->count() == 0) {
                Staffattendancehelper::generateattendancerecord($todaydate);
                Log::info("Staff Cron is working fine! Date: " . $todaydate->format('d-M-Y'));
            } else {
                Log::info("Staff Cron is working fine! Oops!!! Job already Executed Date: " . $todaydate->format('d-M-Y'));
            }

            DB::commit();
        } catch (Exception $e) {
            DB::rollback();
            Log::error('Exception one: Staffattendancehelper  Error: ' . $e->getMessage());
        } catch (QueryException $e) {
            DB::rollback();
            Log::error('Exception two: Staffattendancehelper  Error: ' . $e->getMessage());
        } catch (PDOException $e) {
            DB::rollback();
            Log::error('Exception three: Staffattendancehelper  Error: ' . $e->getMessage());
        }

    }
}
