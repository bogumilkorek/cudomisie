<?php

namespace App\Http\Controllers;

use App\Image;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Carbon\Carbon;
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
        'size' => File::size(public_path('photos/upload'), $imageName),
        'imageable_type' => $request->type,
        'imageable_id' => $request->id,
        'form_token' => $request->_token,
      ]);

      ImageLib::make($image->full_url)
      ->resize(333, 250)
      ->save(public_path('/photos/upload/thumbs/' . $imageName));

      return response()->json(['filename' => $imageName]);
    }
  }

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
