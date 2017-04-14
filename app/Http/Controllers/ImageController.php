<?php

namespace App\Http\Controllers;

use App\Image;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Carbon\Carbon;
// use Illuminate\Contracts\Filesystem\Factory as Storage;
// use Illuminate\Filesystem\Filesystem;
use Illuminate\Support\Facades\File;
use Intervention\Image\Facades\Image as ImageLib;

class ImageController extends Controller
{
  public function __construct()
  {
    $this->middleware(['auth', 'admin']);
  }

  public function index()
  {
  }

  public function store(Request $request)
  {
    if($request->hasFile('image'))
    {
      $imageFile = $request->file('image');
      $imageName = uniqid() . '-' . $imageFile->getClientOriginalName();

      $imageFile->move(public_path('photos/upload'), $imageName);

      $image = Image::create([
        'url' => $imageName,
        'size' => File::size($imageFile),
        'imageable_type' => $request->type,
        'imageable_id' => $request->id,
        'form_token' => $request->_token,
      ]);

      ImageLib::make($image->url)
      ->resize(333, 250)
      ->save(public_path('/photos/upload/thumbs/' . $imageName));

      return response()->json(['filename' => $imageName]);
    }
  }

  // public function store(Storage $storage, Request $request)
  // {
  //   if($request->isXmlHttpRequest())
  //   {
  //     $image = $request->file('image');
  //     $timestamp = $this->getFormattedTimestamp();
  //     $savedImageName = $this->getSavedImageName($timestamp, $image);
  //     $imageUploaded = $this->uploadImage($image, $savedImageName, $storage);
  //
  //     if($imageUploaded)
  //     {
  //       Image::create([
  //         'url' => $savedImageName,
  //         'original_url' => $image->getClientOriginalName(),
  //         'size' => File::size($image),
  //         'imageable_type' => $request->type,
  //         'imageable_id' => $request->id,
  //         'form_token' => $request->_token,
  //       ]);
  //
  //       ImageLib::make(asset('/photos/upload/' . $savedImageName))
  //       ->resize(333, 250)
  //       ->save(public_path('/photos/upload/thumbs/' . $savedImageName));
  //
  //       return response()->json(['filename' => $savedImageName], 200);
  //     }
  //   }
  //
  // }
  //
  // /**
  // * @param $image
  // * @param $imageFullName
  // * @param $storage
  // * @return mixed
  // * @throws \Illuminate\Contracts\Filesystem\FileNotFoundException
  // */
  // public function uploadImage($image, $imageFullName, $storage)
  // {
  //   $filesystem = new Filesystem;
  //   return $storage->disk('image')->put($imageFullName, $filesystem->get( $image ));
  // }
  //
  // /**
  // * @return string
  // */
  // protected function getFormattedTimestamp()
  // {
  //   return str_replace([' ', ':'], '-', Carbon::now()->toDateTimeString());
  // }
  //
  // /**
  // * @param $timestamp
  // * @param $image
  // * @return string
  // */
  // protected function getSavedImageName($timestamp, $image)
  // {
  //   return $timestamp . '-' . $image->getClientOriginalName();
  // }

  public function destroy(Request $request)
  {
    $image = Image::where('url', $request->url)->first();

    if($image)
    {
      if(File::exists(public_path('/photos/upload/' . $request->url)))
        File::delete(public_path('/photos/upload/' . $request->url));
      if(File::exists(public_path('/photos/upload/thumbs/' . $request->url)))
        File::delete(public_path('/photos/upload/thumbs/' . $request->url));

      $image->delete();

      return response()->json(['message' => 'Image deleted']);
    }
    else
      return response()->json(['message' => 'Image not found']);
  }
}
