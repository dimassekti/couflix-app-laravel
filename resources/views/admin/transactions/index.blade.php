@extends('admin.layouts.base')

@section('title', 'Movie')

@section('content')

  <div class="row">
    <div class="col-md-12">
      <div class="card card-primary">
        <div class="card-header">
          <h3 class="card-title">Transactions</h3>
        </div>
        <div class="card-body">
          <div class="row">
            <div class="col-md-12">
              <table id="transaction"
                     class="table table-bordered table-hover">
                <thead>
                  <tr>
                    <th>Id</th>
                    <th>Package</th>
                    <th>User</th>
                    <th>Amount</th>
                    <th>Transaction Code</th>
                    <th>Status</th>
                  </tr>
                </thead>
                <tbody>
                  @foreach ($transactions as $transaction)
                    <tr>
                      <td>{{ $transaction->id }}</td>
                      <td>{{ $transaction->package->name }}</td>
                      <td>{{ $transaction->user->name }}</td>
                      <td>{{ $transaction->amount }}</td>
                      <td>{{ $transaction->status }}</td>
                      <td></td>
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
    $('#transaction').DataTable({
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
