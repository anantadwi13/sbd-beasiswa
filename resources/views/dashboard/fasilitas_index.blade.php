@extends("layout.dashboard")

@php
    /** @var \App\Fasilitas[] $dataFasilitas */
@endphp

@section('title','Fasilitas')

@section('content')
    <div class="row">
        <div class="offset-4 offset-lg-4 col-lg-4 col-4">
            @if(session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{session('success')}}
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            @endif
            @if($errors->any())
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    {{$errors->first()}}
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            @endif
        </div>
        <div class="col-lg-12 col-12">
            <div class="card">
                <div class="card-body">
                    <table id="table" class="table table-bordered table-striped">
                        <thead>
                        <tr>
                            <th>No</th>
                            <th>Fasilitas</th>
                            <th>Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($dataFasilitas as $item)
                            <tr>
                                <td></td>
                                <td>{{$item->nama}}</td>
                                <td>
                                    <a href="{{route('dashboard.fasilitas.edit', $item)}}" class="btn btn-warning">Edit</a>
                                    <a href="{{route('dashboard.fasilitas.show', $item)}}" class="btn btn-primary" title="Lihat daftar beasiswa yang memberikan fasilitas ini">Beasiswa</a>
                                    <form method="post" class="delete" action="{{route('dashboard.fasilitas.destroy', $item)}}" style="display: inline-block;">
                                        {{csrf_field()}}
                                        <input type="hidden" name="_method" value="DELETE">
                                        <button class="btn btn-danger">Hapus</button>
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
@endsection

@section('action')
    <div class="float-sm-right">
        <a href="{{route('dashboard.fasilitas.create')}}" class="btn btn-primary">Tambah Baru</a>
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
            });
            t.on( 'order.dt search.dt', function () {
                t.column(0, {search:'applied', order:'applied'}).nodes().each( function (cell, i) {
                    cell.innerHTML = i+1;
                } );
            } ).draw();
        });
        $('form.delete').submit(function (e) {
            e.preventDefault();

            if (confirm('Apakah Anda yakin ingin menghapus fasilitas ini?'))
                this.submit();
        });
    </script>
@endsection