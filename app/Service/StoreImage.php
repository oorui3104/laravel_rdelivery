<?php

namespace App\Service;
use Illuminate\Support\Facades\Storage;
use InterventionImage;

class StoreImage {

  static function upload($imageFile, $folderName) {
    $resizedImage = InterventionImage::make($imageFile)
    ->resize(1920, 1080)
    ->encode();

    $fileName = uniqid();
    $extension = $imageFile->extension();
    $StorefileName = $fileName . '.' . $extension;

    Storage::put('public/' . $folderName . '/'  . $StorefileName, $resizedImage);

    return $StorefileName;
  }

}




?>