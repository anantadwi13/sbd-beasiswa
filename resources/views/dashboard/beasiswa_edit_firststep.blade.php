@extends("layout.dashboard")

@php
    /** @var \App\Beasiswa $beasiswa */
@endphp

@section('title','Beasiswa')

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
        <div class="offset-lg-2 offset-2 col-lg-8 col-8">
            <div class="card card-primary">
                <div class="card-header">
                    <h3 class="card-title">Tambah Beasiswa Baru</h3>
                </div>
                <!-- /.card-header -->
                <!-- form start -->
                <form role="form" method="post" action="{{route('dashboard.beasiswa.update',$beasiswa)}}">
                    {{csrf_field()}}
                    <input type="hidden" name="_method" value="PUT">
                    <div class="card-body">
                        <div class="form-group">
                            <label for="namaBeasiswa">Nama Beasiswa</label>
                            <input type="text" class="form-control" id="namaBeasiswa" placeholder="Nama beasiswa" name="nama" value="{{$beasiswa->nama}}">
                        </div>
                        <div class="form-group">
                            <label for="deskripsi">Deskripsi</label>
                            <textarea type="text" class="form-control" id="deskripsi" placeholder="Deskripsi Beasiswa" name="deskripsi">{{$beasiswa->deskripsi}}</textarea>
                        </div>
                        <div class="form-group">
                            <label for="perusahaan">Instansi/Perusahaan</label>
                            <select id="perusahaan" class="form-control select2 select2-hidden-accessible" name="perusahaan" style="width: 100%;" tabindex="-1" aria-hidden="true">
                                <option disabled selected>-</option>
                                @foreach($perusahaan as $item)
                                    <option value="{{$item->id}}" @if($beasiswa->id_perusahaan == $item->id) selected @endif>{{$item->nama}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Tanggal Buka Pendaftaran</label>

                            <div class="input-group">
                                <div class="input-group-prepend" data-toggle="datetimepicker" data-target="#tglbuka">
                                  <span class="input-group-text">
                                    <i class="fa fa-calendar"></i>
                                  </span>
                                </div>
                                <input type="text" autocomplete="off" class="form-control float-right datetimepicker datetimepicker-input" name="tglbuka" id="tglbuka" data-toggle="datetimepicker" data-target="#tglbuka" value="{{$beasiswa->tgl_dibuka}}">
                            </div>
                            <!-- /.input group -->
                        </div>
                        <div class="form-group">
                            <label>Tanggal Tutup Pendaftaran</label>

                            <div class="input-group">
                                <div class="input-group-prepend" data-toggle="datetimepicker" data-target="#tgltutup">
                                  <span class="input-group-text">
                                    <i class="fa fa-calendar"></i>
                                  </span>
                                </div>
                                <input type="text" autocomplete="off" class="form-control float-right datetimepicker datetimepicker-input" name="tgltutup" id="tgltutup" data-toggle="datetimepicker" data-target="#tgltutup" value="{{$beasiswa->tgl_ditutup}}">
                            </div>
                            <!-- /.input group -->
                        </div>
                        <div class="form-group">
                            <label for="info">Informasi Tambahan</label>
                            <textarea type="text" class="form-control" id="info" placeholder="Informasi Tambahan" name="infotambahan">{{$beasiswa->info_tambahan}}</textarea>
                        </div>
                        <div class="form-group">
                            <label>Persyaratan</label>
                            <select class="form-control select2 select2-hidden-accessible" name="persyaratan[][id]" multiple style="width: 100%;" tabindex="-1" aria-hidden="true">
                                @foreach($persyaratan as $item)
                                    <option value="{{$item->id}}" @if(!empty($persyaratan_select[$item->id])) selected @endif>{{$item->nama}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Fasilitas</label>
                            <select class="form-control select2 select2-hidden-accessible" name="fasilitas[][id]" multiple style="width: 100%;" tabindex="-1" aria-hidden="true">
                                @foreach($fasilitas as $item)
                                    <option value="{{$item->id}}" @if(!empty($fasilitas_select[$item->id])) selected @endif>{{$item->nama}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <!-- /.card-body -->

                    <div class="card-footer">
                        <button type="submit" class="btn btn-primary">Next</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@section('css')
    <link rel="stylesheet" href="{{asset('css/select2.min.css')}}">
    <link rel="stylesheet" href="{{asset('css/tempusdominus-bootstrap-4.min.css')}}" />
@endsection

@section('js')
    <script src="{{asset('js/select2.min.js')}}"></script>
    <script type="text/javascript" src="{{asset('js/moment.min.js')}}"></script>
    <script type="text/javascript" src="{{asset('js/moment-with-locales.min.js')}}"></script>
    <script type="text/javascript" src="{{asset('js/tempusdominus-bootstrap-4.min.js')}}"></script>

    <script>
        $(document).ready(function() {
            $('.select2').select2();
        });
        var tglBuka = $('#tglbuka');
        var tglTutup = $('#tgltutup');

        tglBuka.datetimepicker({
            date: tglBuka.val(),
            locale: 'id',
            format: 'YYYY-MM-DD HH:mm:ss',
            icons:{
                date: 'far fa-calendar',
                time: 'far fa-clock'
            }
        });
        tglTutup.datetimepicker({
            date: tglTutup.val(),
            locale: 'id',
            format: 'YYYY-MM-DD HH:mm:ss',
            icons:{
                date: 'far fa-calendar',
                time: 'far fa-clock'
            }
        });

        $('form').submit(function()
        {
            $("button[type='submit']", this)
                .text("Please Wait...")
                .attr('disabled', 'disabled');

            return true;
        });
    </script>
@endsection