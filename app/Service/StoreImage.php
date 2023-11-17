<?php

namespace App\Service;
use Illuminate\Support\Facades\Storage;
use InterventionImage;

class StoreImage {

  static function upload($imageFile, $folderName) {

    if (is_array($imageFile)) {
      $file = $imageFile['image'];
    } else {
      $file = $imageFile;
    }

    $resizedImage = InterventionImage::make($file)
    ->resize(1920, 1080)
    ->encode();

    $fileName = uniqid();
    $extension = $file->extension();
    $StorefileName = $fileName . '.' . $extension;

    Storage::put('public/' . $folderName . '/'  . $StorefileName, $resizedImage);

    return $StorefileName;
  }

}




?>