<?php

namespace Database\Seeders;

use App\Models\Admin\Feeds\Feedreported;
use Illuminate\Database\Seeder;

class FeedreportedTableSeeder extends Seeder
{
    public function run()
    {
        $feedpostreport = [
            ['id' => 1, 'user_id' => 1, 'name' => 'Offensive for the school community guidelines'],
            ['id' => 2, 'user_id' => 1, 'name' => 'Abusive Content'],
            ['id' => 3, 'user_id' => 1, 'name' => 'Violence'],
            ['id' => 4, 'user_id' => 1, 'name' => 'Harrassment'],
            ['id' => 5, 'user_id' => 1, 'name' => 'Hate Speech'],
            ['id' => 6, 'user_id' => 1, 'name' => 'Spam'],
        ];

        foreach ($feedpostreport as $row) {
            Feedreported::create($row);
        }
    }
}
