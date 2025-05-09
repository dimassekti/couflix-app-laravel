<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Movie;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class MovieController extends Controller
{
  //
  public function index()
  {

    $movies = Movie::all();
    return view('admin.movies.index', ['movies' => $movies]);
  }

  public function create()
  {
    return view('admin.movies.create');
  }

  public function edit($id)
  {
    $movie = Movie::find($id);
    return view('admin.movies.edit', ['movie' => $movie]);
  }



  public function store(Request $request)
  {
    // $data = $request->all();
    $data = $request->except('_token');

    $request->validate([
      'title' => 'required|required|string',
      'small_thumbnail' => 'required|image|mimes:png,jpg,jpeg',
      'large_thumbnail' => 'required|image|mimes:png,jpg,jpeg',
      'trailer' => 'required|url',
      'movie' => 'required|url',
      'casts' => 'required|string',
      'categories' => 'required|string',
      'release_date' => 'required|string',
      'about' => 'required|string',
      'short_about' => 'required|string',
      'duration' => 'required|string',
      'featured' => 'required'

    ]);

    $smallThumbnail = $request->small_thumbnail;
    $largeThumbnail = $request->large_thumbnail;

    $originalSmallThumbnailName = Str::random(10) . $smallThumbnail->getClientOriginalName();


    $originalLargeThumbnailName = Str::random(10) . $largeThumbnail->getClientOriginalName();
    // dd($largeThumbnail->getClientOriginalName());

    $smallThumbnail->storeAs('public/thumbnail', $originalSmallThumbnailName);
    $largeThumbnail->storeAs('public/thumbnail', $originalLargeThumbnailName);

    // dd(Str::random(10) . $largeThumbnail->getClientOriginalName());

    // dd($data);

    $data['large_thumbnail'] = $originalLargeThumbnailName;
    $data['small_thumbnail'] = $originalSmallThumbnailName;

    // dd($data);

    Movie::create($data);

    return redirect()->route('admin.movie')->with('success', 'Movie created');
  }

  public function update(Request $request, $id)
  {
    $data = $request->except('_token');

    $request->validate([
      'title' => 'required|string',
      'small_thumbnail' => 'image|mimes:png,jpg,jpeg',
      'large_thumbnail' => 'image|mimes:png,jpg,jpeg',
      'trailer' => 'url',
      'movie' => 'url',
      'casts' => 'string',
      'categories' => 'string',
      'release_date' => 'string',
      'about' => 'string',
      'short_about' => 'string',
      'duration' => 'string',
      'featured' => ''

    ]);

    $movie = Movie::find($id);

    if ($request->small_thumbnail) {
      // save new image
      $smallThumbnail = $request->small_thumbnail;

      $originalSmallThumbnailName = Str::random(10) . $smallThumbnail->getClientOriginalName();

      $smallThumbnail->storeAs('public/thumbnail', $originalSmallThumbnailName);

      $data['small_thumbnail'] = $originalSmallThumbnailName;

      // delete old image
      Storage::delete(['public/thumbnail/', $movie->small_thumbnail]);
    }

    if ($request->large_thumbnail) {
      // save new image
      $largeThumbnail = $request->large_thumbnail;

      $originalLargeThumbnailName = Str::random(10) . $largeThumbnail->getClientOriginalName();

      $largeThumbnail->storeAs('public/thumbnail', $originalLargeThumbnailName);
      $data['large_thumbnail'] = $originalLargeThumbnailName;

      // delete old image
      Storage::delete(['public/thumbnail/', $movie->large_thumbnail]);
    }

    $movie->update($data);

    return redirect()->route('admin.movie')->with('success', 'Movie updated');
  }

  public function destroy($id)
  {
    Movie::find($id)->delete();

    return redirect()->route('admin.movie')->with('success', 'Movie deleted');
  }
}
