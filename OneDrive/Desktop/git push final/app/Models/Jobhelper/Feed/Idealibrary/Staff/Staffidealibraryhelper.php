<?php

namespace App\Models\Jobhelper\Feed\Idealibrary\Staff;

use App\Models\Admin\Feeds\Stafffeedidealibrary;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Staffidealibraryhelper extends Model
{
    public static function syncidealibrary($idealibrary)
    {
        foreach ($idealibrary as $eachidealibrary) {
            $imagepath = "";
            if ($eachidealibrary->image) {
                $img = $eachidealibrary->image;
                $idealibrary_image = basename($eachidealibrary->image);
                Storage::disk('public')->put('staffidealibrary/' . $idealibrary_image, file_get_contents($img), 'public');
                $imagepath = '/' . 'staffidealibrary/' . $idealibrary_image;
            }
            Stafffeedidealibrary::create([
                'name' => $eachidealibrary->name,
                'tag' => $eachidealibrary->tag,
                'description' => $eachidealibrary->description,
                'image' => $imagepath,
                'starvalue' => $eachidealibrary->star_value,
                'template_uuid' => $eachidealibrary->idealibrary_uuid,
                'template_uniqid' => $eachidealibrary->idealibrary_uniqid,
            ]);
        }
    }
}
