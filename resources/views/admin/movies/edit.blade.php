@extends('admin.layouts.base')

@section('title', 'Movie')

@section('content')

  <div class="row">
    <div class="col-md-12">

      {{-- Alert Here --}}
      @if ($errors->any())
        <div class="alert alert-danger">
          <ul>
            @foreach ($errors->all() as $error)
              <li>{{ $error }}</li>
            @endforeach
          </ul>
        </div>
      @endif

      <div class="card card-primary">
        <div class="card-header">
          <h3 class="card-title">Edit Movie</h3>
        </div>
        <!-- /.card-header -->
        <!-- form start -->
        <form enctype="multipart/form-data"
              method="POST"
              action="{{ route('admin.movie.update', $movie->id) }}">
          @csrf
          @method('PUT')
          <div class="card-body">
            <div class="form-group">
              <label for="title">Title</label>
              <input id="title"
                     type="text"
                     class="form-control"
                     name="title"
                     placeholder="e.g Guardian of The Galaxy"
                     value="{{ $movie->title }}">
            </div>
            <div class="form-group">
              <label for="trailer">Trailer</label>
              <input id="trailer"
                     type="text"
                     class="form-control"
                     name="trailer"
                     placeholder="Video url"
                     value="{{ $movie->trailer }}">
            </div>
            <div class="form-group">
              <label for="movie">Movie</label>
              <input id="movie"
                     type="text"
                     class="form-control"
                     name="movie"
                     placeholder="Video url"
                     value="{{ $movie->movie }}">
            </div>
            <div class="form-group">
              <label for="duration">Duration</label>
              <input id="duration"
                     type="text"
                     class="form-control"
                     name="duration"
                     placeholder="1h 39m"
                     value="{{ $movie->duration }}">
            </div>
            <div class="form-group">
              <label>Date:</label>
              <div id="release-date"
                   class="input-group date"
                   data-target-input="nearest">
                <input type="text"
                       name="release_date"
                       value="{{ $movie->release_date }}"
                       class="form-control datetimepicker-input"
                       data-target="#release-date" />
                <div class="input-group-append"
                     data-target="#release-date"
                     data-toggle="datetimepicker">
                  <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                </div>
              </div>
            </div>
            <div class="form-group">
              <label for="short-about">Casts</label>
              <input id="short-about"
                     type="text"
                     class="form-control"
                     name="casts"
                     value="{{ $movie->casts }}"
                     placeholder="Jackie Chan">
            </div>
            <div class="form-group">
              <label for="short-about">Categories</label>
              <input id="short-about"
                     type="text"
                     class="form-control"
                     name="categories"
                     value="{{ $movie->categories }}"
                     placeholder="Action, Fantasy">
            </div>
            <div class="form-group">
              <label for="small-thumbnail">Small Thumbnail</label>
              <input type="file"
                     class="form-control"
                     name="small_thumbnail">
            </div>
            <div class="form-group">
              <label for="large-thumbnail">Large Thumbnail</label>
              <input type="file"
                     class="form-control"
                     name="large_thumbnail">
            </div>
            <div class="form-group">
              <label for="short-about">Short About</label>
              <input id="short-about"
                     type="text"
                     class="form-control"
                     name="short_about"
                     value="{{ $movie->short_about }}"
                     placeholder="Awesome Movie">
            </div>
            <div class="form-group">
              <label for="about">About</label>
              <input id="about"
                     type="text"
                     class="form-control"
                     name="about"
                     value="{{ $movie->about }}"
                     placeholder="Awesome Movie">
            </div>
            <div class="form-group">
              <label>Featured</label>
              <select class="custom-select"
                      name="featured">
                <option value="0"
                        {{ $movie->featured === '0' ? 'selected' : '' }}>No</option>
                <option value="1"
                        {{ $movie->featured === '1' ? 'selected' : '' }}>Yes</option>
              </select>
            </div>
          </div>
          <!-- /.card-body -->

          <div class="card-footer">
            <button type="submit"
                    class="btn btn-primary">Submit</button>
          </div>
        </form>
      </div>
    </div>
  </div>

@endsection

@section('js')
  <script>
    $('#release-date').datetimepicker({
      format: 'YYYY-MM-DD'
    })
  </script>
@endsection
