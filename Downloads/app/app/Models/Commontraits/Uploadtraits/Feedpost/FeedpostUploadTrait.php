<?php

namespace App\Models\Commontraits\Uploadtraits\Feedpost;

use App\Models\Admin\Feeds\Feedpost;
use Intervention\Image\Facades\Image;
use Storage;

trait FeedpostUploadTrait
{
    public function newimagefomrat($originalImage)
    {
        $originalPath = 'feed/post/images/';
        $thumbnailPath = 'feed/post/thumbnail/';
        $ration = 100;
        if (request()->id) {
            $image = Feedpost::where('id', request()->id)->first()->image;
            if ($image) {
                Storage::disk('public')->delete($originalPath . $image);
                Storage::disk('public')->delete($thumbnailPath . $image);
            }
        }
        $imgname = time() . uniqid() . '.jpg';
        $saveimage = Image::make($originalImage);
        $saveimage->encode('jpg', $ration);
        $saveimage->stream();
        Storage::disk('public')->put($originalPath . '/' . $imgname, $saveimage, 'public');

        $img = Image::make($originalImage);

        $width = $img->width();
        $height = $img->height();

        $dimension = 400;

        $vertical = (($width < $height) ? true : false);
        $horizontal = (($width > $height) ? true : false);
        $square = (($width = $height) ? true : false);

        if ($vertical) {
            $newHeight = ($dimension);
            $img->resize(null, $newHeight, function ($constraint) {
                $constraint->aspectRatio();
            });
        } else if ($horizontal) {
            $newWidth = ($dimension);
            $img->resize($newWidth, null, function ($constraint) {
                $constraint->aspectRatio();
            });
        } else if ($square) {
            $newWidth = ($dimension);
            $img->resize($newWidth, null, function ($constraint) {
                $constraint->aspectRatio();
            });
        }

        $img->resize(400, 400, function ($constraint) {
            $constraint->aspectRatio();
            $constraint->upsize();
        });

        // $img->resizeCanvas($dimension, $dimension, 'center', false, '#ffffff');
        $img->encode('jpg', $ration);
        $img->stream();

        Storage::disk('public')->put($thumbnailPath . '/' . $imgname, $img, 'public');
        return $originalPath . $imgname;
    }
}
