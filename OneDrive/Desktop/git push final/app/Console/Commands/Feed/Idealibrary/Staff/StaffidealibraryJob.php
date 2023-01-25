<?php

namespace App\Console\Commands\Feed\Idealibrary\Staff;

use App\Models\Admin\Feeds\Stafffeedidealibrary;
use App\Models\Admin\Settings\Onlineassessment\Mapboard;
use App\Models\Jobhelper\Feed\Idealibrary\Staff\Staffidealibraryhelper;
use Carbon\Carbon;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class StaffidealibraryJob extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'staff:idealibrary';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

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
        $board_uuid = "";
        $board = Mapboard::where('active', true)->first();
        if ($board) {
            $board_uuid = $board->mapboard_uuid;
        }
        $idealibrary = Stafffeedidealibrary::where('active', true)->get();
        $todaydate = Carbon::now();
        if ($idealibrary) {
            $exsisting_uuid = $idealibrary->pluck('template_uuid')->implode(',');
        }
        $response = Http::post(config('archive.online_assessment.path') . '/getstaffidealibrary', [
            'key' => config('archive.online_assessment.key'),
            'board_uuid' => $board_uuid,
            'exsisting_template_uuid' => $exsisting_uuid ? $exsisting_uuid : '',
        ]);
        if ($response->successful()) {
            $response = json_decode($response->body());
            $idealibrary = collect($response->idealibrary);
            if ($idealibrary->isNotEmpty()) {
                try
                {
                    DB::beginTransaction();
                    Staffidealibraryhelper::syncidealibrary($idealibrary);
                    Log::info("Staff Cron is working fine! Date & Time: " . $todaydate->format('d-M-Y H:i:s'));
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
            } else {
                Log::info("Staff Cron is working fine! Oops!!! Job already Date & Time: " . $todaydate->format('d-M-Y H:i:s'));
            }
            DB::commit();
        }

    }
}
