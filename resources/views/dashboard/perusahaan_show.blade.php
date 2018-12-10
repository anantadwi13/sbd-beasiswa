@extends("layout.dashboard")

@php
    /** @var \App\Perusahaan $perusahaan */
@endphp

@section('title','Perusahaan')

@section('content')
    <div class="row">
        <div class="col-lg-12 col-12">
            <div class="card">
                <div class="card-header">
                    <h5>Daftar Beasiswa dengan perusahaan {{$perusahaan->nama}}</h5>
                </div>
                <div class="card-body">
                    <table id="table" class="table table-bordered table-striped">
                        <thead>
                        <tr>
                            <th>No</th>
                            <th>Beasiswa</th>
                            <th>Perusahaan</th>
                            <th>Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($perusahaan->beasiswa()->get() as $item)
                            <tr>
                                <td></td>
                                <td>{{$item->nama}}</td>
                                <td>{{$item->perusahaan()->first()->nama}}</td>
                                <td>
                                    <a href="{{route('dashboard.beasiswa.show', $item)}}" class="btn btn-warning">Lihat</a>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('action')
    <div class="float-sm-right">
        <a onclick="window.history.go(-1); return false;" href="#" class="btn btn-secondary">Back</a>
    </div>
@endsection

@section('css')
    <link rel="stylesheet" href="{{asset('css/dataTables.bootstrap4.css')}}">
@endsection

@section('js')
    <script src="{{asset('js/jquery.dataTables.js')}}"></script>
    <script src="{{asset('js/dataTables.bootstrap4.js')}}"></script>

    <script type="text/javascript">
        $(function () {
            var t = $('#table').DataTable({
                "columnDefs": [ {
                    "searchable": false,
                    "orderable": false,
                    "targets": 0,
                } ],
                "order": [[ 1, 'asc' ]],
                "lengthChange": false,
            });
            t.on( 'order.dt search.dt', function () {
                t.column(0, {search:'applied', order:'applied'}).nodes().each( function (cell, i) {
                    cell.innerHTML = i+1;
                } );
            } ).draw();
        });
    </script>
@endsection