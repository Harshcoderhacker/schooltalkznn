<?php

namespace Database\Seeders;

use App\Models\Admin\Feeds\Feedtag;
use Illuminate\Database\Seeder;

class FeedtagTableSeeder extends Seeder
{
    public function run()
    {
        $feedtags = [
            ['id' => 1, 'name' => 'Offensive for the school community guidelines'],
            ['id' => 2, 'name' => 'Abusive Content'],
            ['id' => 3, 'name' => 'Violence'],
            ['id' => 4, 'name' => 'Harrassment'],
            ['id' => 5, 'name' => 'Hate Speech'],
            ['id' => 6, 'name' => 'Spam'],
        ];

        foreach ($feedtags as $row) {
            Feedtag::create($row);
        }
    }
}
