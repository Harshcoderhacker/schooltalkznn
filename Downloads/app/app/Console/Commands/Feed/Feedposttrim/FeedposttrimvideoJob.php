<?php

namespace App\Console\Commands\Feed\Feedposttrim;

use App\Models\Admin\Feeds\Feedpost;
use FFMpeg\FFMpeg;
use File;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

class FeedposttrimvideoJob extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'feedpost:trimvideo';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Feedpost Trimvideo Job';

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
        $feedpost = Feedpost::where('type', 1)
            ->where('is_mediatype', 2)
            ->where('is_trimvideo', false)
            ->get();

        foreach ($feedpost as $eachfeedpost) {
            $ffmpeg = FFMpeg::create([
                'ffmpeg.binaries' => '/usr/bin/ffmpeg',
                'ffprobe.binaries' => '/usr/bin/ffprobe',
                'timeout' => 3600,
                'ffmpeg.threads' => 12,
            ]);

            $videoname = time();
            $video = $ffmpeg->open(env('APP_URL') . 'storage/' . $eachfeedpost->video);
            $clip = $video->clip(\FFMpeg\Coordinate\TimeCode::fromSeconds(0), \FFMpeg\Coordinate\TimeCode::fromSeconds(60));
            $clip->save(new \FFMpeg\Format\Video\X264(), public_path('storage/feed/post/video/' . $videoname . '.mp4'));

            DB::table('feedposts')
                ->where('id', $eachfeedpost->id)
                ->update(['is_trimvideo' => true, 'video' => 'feed/post/video/' . $videoname . '.mp4']);

            File::delete(public_path('storage/' . $eachfeedpost->video));
        }
    }
}
