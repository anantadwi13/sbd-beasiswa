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
                <form role="form" method="post">
                    {{csrf_field()}}
                    <input type="hidden" name="laststep" value="true">
                    <div class="card-body">
                        <div class="alert alert-info">
                            Silakan ditinjau ulang sebelum menambahkan data beasiswa baru
                        </div>
                        <div class="form-group">
                            <label for="namaBeasiswa">Nama Beasiswa</label>
                            <input type="text" class="form-control" id="namaBeasiswa" placeholder="Nama beasiswa" name="nama" disabled value="{{$beasiswa->nama}}">
                            <input type="hidden" class="form-control" id="namaBeasiswa" placeholder="Nama beasiswa" name="nama" value="{{$beasiswa->nama}}">
                        </div>
                        <div class="form-group">
                            <label for="deskripsi">Deskripsi</label>
                            <textarea class="form-control" id="deskripsi" placeholder="Tidak diatur" name="deskripsi" disabled>{{$beasiswa->deskripsi}}</textarea>
                            <textarea class="form-control" hidden id="deskripsi" placeholder="Deskripsi Beasiswa" name="deskripsi">{{$beasiswa->deskripsi}}</textarea>
                        </div>
                        <div class="form-group">
                            <label for="perusahaan">Instansi/Perusahaan</label>
                            <select id="perusahaan" class="form-control select2 select2-hidden-accessible" name="perusahaan" style="width: 100%;" tabindex="-1" aria-hidden="true" disabled>
                                <option selected value="{{$beasiswa->id_perusahaan}}">{{\App\Perusahaan::find($beasiswa->id_perusahaan)->nama}}</option>
                            </select>
                            <input type="hidden" value="{{$beasiswa->id_perusahaan}}" name="perusahaan">
                        </div>
                        <div class="form-group">
                            <label>Tanggal Buka Pendaftaran</label>

                            <div class="input-group">
                                <div class="input-group-prepend" data-toggle="datetimepicker" data-target="#tglbuka">
                                  <span class="input-group-text">
                                    <i class="fa fa-calendar"></i>
                                  </span>
                                </div>
                                <input type="text" value="{{$beasiswa->tgl_dibuka?$beasiswa->tgl_dibuka:"Tidak diatur"}}" class="form-control float-right" name="tglbuka" id="tglbuka" data-toggle="datetimepicker" data-target="#tglbuka" disabled>
                                <input type="hidden" value="{{$beasiswa->tgl_dibuka}}" name="tglbuka">
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
                                <input type="text" value="{{$beasiswa->tgl_ditutup?$beasiswa->tgl_ditutup:"Tidak diatur"}}" class="form-control float-right" name="tgltutup" id="tgltutup" data-toggle="datetimepicker" data-target="#tgltutup" disabled>
                                <input type="hidden" value="{{$beasiswa->tgl_ditutup}}" name="tgltutup">
                            </div>
                            <!-- /.input group -->
                        </div>
                        <div class="form-group">
                            <label for="info">Informasi Tambahan</label>
                            <textarea type="text" class="form-control" id="info" placeholder="Tidak diatur" name="infotambahan" disabled>{{$beasiswa->info_tambahan}}</textarea>
                            <input type="hidden" value="{{$beasiswa->info_tambahan}}" name="infotambahan">
                        </div>
                        <div class="form-group">
                            <label>Persyaratan</label>
                            @if($persyaratan)
                            <ul>
                                @foreach($persyaratan as $key=>$item)
                                    <li>
                                        {{$item['nama']}}
                                        <input type="text" class="form-control mt-1 mb-1" id="ketpersyaratan{{$key}}" name="persyaratan[{{$key}}][keterangan]" placeholder="Tambahkan keterangan" value="">
                                        <input type="hidden" name="persyaratan[{{$key}}][id]" value="{{$item['id']}}">
                                    </li>
                                @endforeach
                            </ul>
                            @else
                                <div>Tidak ada persyaratan</div>
                            @endif
                        </div>
                        <div class="form-group">
                            <label>Fasilitas</label>
                            @if($fasilitas)
                            <ul>
                                @foreach($fasilitas as $key=>$item)
                                    <li>
                                        {{$item['nama']}}
                                        <input type="text" class="form-control mt-1 mb-1" id="ketfasilitas{{$key}}" name="fasilitas[{{$key}}][keterangan]" placeholder="Tambahkan keterangan" value="">
                                        <input type="hidden" name="fasilitas[{{$key}}][id]" value="{{$item['id']}}">
                                    </li>
                                @endforeach
                            </ul>
                            @else
                                <div>Tidak ada fasilitas</div>
                            @endif
                        </div>
                    </div>
                    <!-- /.card-body -->

                    <div class="card-footer">
                        <button type="submit" class="btn btn-primary">Submit</button>
                        <button onclick="window.history.go(-1); return false;" class="btn btn-secondary">Back</button>
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
        $('.datetimepicker').datetimepicker({
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