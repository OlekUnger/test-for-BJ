<?php
use Intervention\Image\ImageManagerStatic as Image;

class IntImage
{
//    public static function image($img,$dist,$size1,$size2)
//    {
//        $image = Image::make($img)->resize($size1,$size2,function($image){
//            $image->aspectRatio();
//        })->save($dist);
//        return $image;
//    }
//    public static function imageB($img,$dist,$size)
//    {
//        $image = Image::make($img)->resize($size,$size)->save($dist);
//        return $image;
//    }
    public static function image($img,$dist,$size1,$size2)
    {
        $image = Image::make($img)->resize($size1,$size2)->save($dist,100);
        return $image;
    }
}