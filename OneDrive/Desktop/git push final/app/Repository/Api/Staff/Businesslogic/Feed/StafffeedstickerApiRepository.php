<?php

namespace App\Repository\Api\Staff\Businesslogic\Feed;

use App\Models\Admin\Feeds\Feedsticker;
use App\Repository\Api\Staff\Interfacelayer\Feed\IStafffeedstickerApiRepository;

class StafffeedstickerApiRepository implements IStafffeedstickerApiRepository
{
    public function staffgetallfeedsticker()
    {
        $feedsticker = Feedsticker::where('active', true)->select('uuid', 'sticker_path', 'sticker_category')->get();
        return [true,
            ['title' => array_values(config('archive.sticker_category')),
                'list_one' => $feedsticker->where('sticker_category', 1)->flatten(),
                'list_two' => $feedsticker->where('sticker_category', 2)->flatten(),
                'list_three' => $feedsticker->where('sticker_category', 3)->flatten(),
            ],
            'staffgetallfeedsticker'];
    }
}
