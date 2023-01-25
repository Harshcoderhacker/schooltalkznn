<?php

namespace App\Listeners\Feedpostlistener;

use App\Models\Admin\Feeds\Feedpost;
use DB;
use FFMpeg\FFMpeg;
use Illuminate\Contracts\Queue\ShouldQueue;

class FeedposttrimvideoListener implements ShouldQueue
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  \App\Events\FeedposttrimvideoEvent  $event
     * @return void
     */
    public function handle($event)
    {

        $ffmpeg = FFMpeg::create([
            'ffmpeg.binaries' => '/usr/bin/ffmpeg',
            'ffprobe.binaries' => '/usr/bin/ffprobe',
            'timeout' => 3600,
            'ffmpeg.threads' => 12,
        ]);

        $videoname = time();
        $video = $ffmpeg->open(env('APP_URL') . 'storage/' . $event->feedpost->video);
        $clip = $video->clip(\FFMpeg\Coordinate\TimeCode::fromSeconds(0), \FFMpeg\Coordinate\TimeCode::fromSeconds(5));
        $clip->save(new \FFMpeg\Format\Video\X264(), public_path('storage/feed/post/video/' . $videoname . '.mp4'));

        DB::table('feedposts')
            ->where('id', $event->feedpost->id)
            ->update(['is_trimvideo' => true, 'video' => 'feed/post/video/' . $videoname . '.mp4']);

    }
}
