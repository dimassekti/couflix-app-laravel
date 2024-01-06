@extends('admin.layouts.base')

@section('title', 'Movie')

@section('content')

  <div class="row">
    <div class="col-md-12">
      <div class="card card-primary">
        <div class="card-header">
          <h3 class="card-title">Movies</h3>
        </div>

        <div class="card-body">
          <div class="row">
            <div class="col-md-12">
              <a href="{{ route('admin.movie.create') }}"
                 class="btn btn-warning">Create Movie</a>
            </div>
          </div>

          @if (session()->has('success'))
            <div class="alert alert-success">
              {{ session('success') }}
            </div>
          @endif

          <div class="row">
            <div class="col-md-12">
              <table id="movie"
                     class="table table-bordered table-hover">
                <thead>
                  <tr>
                    <th>Id</th>
                    <th>Title</th>
                    <th>Thumbnail</th>
                    <th>Thumbnail</th>
                    <th>Categories</th>
                    <th>Casts</th>
                    <th>Action</th>
                  </tr>
                </thead>
                <tbody>
                  @foreach ($movies as $movie)
                    <tr>
                      <td>{{ $movie->id }}</td>
                      <td>{{ $movie->title }}</td>
                      <td>
                        <img src="{{ asset('storage/thumbnail/' . $movie->small_thumbnail) }}"
                             alt=""
                             width="50%">
                      </td>
                      <td><img src="{{ asset('storage/thumbnail/' . $movie->large_thumbnail) }}"
                             alt=""
                             width="50%"></td>
                      <td>{{ $movie->categories }}</td>
                      <td>{{ $movie->casts }}</td>
                      <td>
                        <a href="{{ route('admin.movie.edit', $movie->id) }}"
                           class="btn btn-secondary">
                          <i class="fas fa-edit"></i>
                        </a>

                        <form action="{{ route('admin.movie.delete', $movie->id) }}"
                              method="POST">
                          @method('DELETE')
                          @csrf
                          <button type="submit"
                                  class="btn btn-danger">
                            <i class="fas fa-trash-alt"></i>
                          </button>
                        </form>
                      </td>
                    </tr>
                  @endforeach

                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

@endsection

@section('js')

  <link href="https://cdn.datatables.net/v/dt/jszip-3.10.1/dt-1.13.8/af-2.6.0/b-2.4.2/b-html5-2.4.2/datatables.min.css"
        rel="stylesheet">

  <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/pdfmake.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/vfs_fonts.js"></script>
  <script src="https://cdn.datatables.net/v/dt/jszip-3.10.1/dt-1.13.8/af-2.6.0/b-2.4.2/b-html5-2.4.2/datatables.min.js">
  </script>

  <script>
    $('#movie').DataTable({
      dom: 'Bfrtip',
      buttons: [
        'copyHtml5',
        'excelHtml5',
        'csvHtml5',
        'pdfHtml5'
      ]
    });
  </script>

@endsection
