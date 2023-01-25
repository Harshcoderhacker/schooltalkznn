<?php

namespace App\Models\Jobhelper\Feed\Idealibrary\Student;

use App\Models\Admin\Feeds\Studentidealibrary;
use App\Models\Admin\Settings\Academicsetting\Classmaster;
use App\Models\Admin\Settings\Onlineassessment\Mapclass;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Studentidealibraryhelper extends Model
{
    public static function syncidealibrary($idealibrary)
    {
        foreach ($idealibrary as $eachidealibrary) {
            $imagepath = "";
            if ($eachidealibrary->image) {
                $img = $eachidealibrary->image;
                $idealibrary_image = basename($eachidealibrary->image);
                Storage::disk('public')->put('studentidealibrary/' . $idealibrary_image, file_get_contents($img), 'public');
                $imagepath = '/' . 'studentidealibrary/' . $idealibrary_image;
            }
            $studentidealibrary = Studentidealibrary::create([
                'name' => $eachidealibrary->name,
                'idea_category' => $eachidealibrary->idealibrary_category,
                'tag' => $eachidealibrary->tag,
                'description' => $eachidealibrary->description,
                'image' => $imagepath,
                'starvalue' => $eachidealibrary->star_value,
                'template_uuid' => $eachidealibrary->idealibrary_uuid,
                'template_uniqid' => $eachidealibrary->idealibrary_uniqid,
            ]);
            $classmaster = [];
            foreach ($eachidealibrary->classmaster as $key => $eachclassmaster) {
                $classmaster[$key] = Mapclass::where('mapclass_uuid', $eachclassmaster->classmaster_uuid)->first()->classmaster_id;
            }
            $studentidealibrary->classmaster()->sync($classmaster);
        }
    }
}
