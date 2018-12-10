@extends("layout.dashboard")

@php
    /** @var \App\Beasiswa $beasiswa */
    /** @var \App\Persyaratan $syarat */
    /** @var \App\Fasilitas $fasilitas */
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
            <div class="card">
                <div class="card-body">
                    <div class="form-group">
                        <label>Nama Beasiswa</label>
                        <div>{{$beasiswa->nama}}</div>
                    </div>
                    <div class="form-group">
                        <label>Perusahaan</label>
                        <div>{{$beasiswa->perusahaan->nama}}</div>
                    </div>
                    <div class="form-group">
                        <label>Tentang Beasiswa</label>
                        <div>{{$beasiswa->deskripsi?$beasiswa->deskripsi:"-"}}</div>
                    </div>
                    @if($beasiswa->tgl_dibuka)
                    <div class="form-group">
                        <label>Tanggal Buka Pendaftaran</label>
                        <div>{{date('d M Y H:i', strtotime($beasiswa->tgl_dibuka))}}</div>
                    </div>
                    @endif
                    @if($beasiswa->tgl_ditutup)
                    <div class="form-group">
                        <label>Tanggal Tutup Pendaftaran</label>
                        <div>{{date('d M Y H:i', strtotime($beasiswa->tgl_ditutup))}}</div>
                    </div>
                    @endif
                    @if($beasiswa->info_tambahan)
                    <div class="form-group">
                        <label>Informasi Tambahan</label>
                        <div>{{$beasiswa->info_tambahan}}</div>
                    </div>
                    @endif
                    @if($beasiswa->persyaratan()->count())
                    <div class="form-group">
                        <label>Persyaratan</label>
                        <ol>
                            @foreach($beasiswa->persyaratan()->get() as $syarat)
                                <li>{{$syarat->nama}} {{$syarat->pivot->keterangan?"(".$syarat->pivot->keterangan.")":""}}</li>
                            @endforeach
                        </ol>
                    </div>
                    @endif
                    @if($beasiswa->fasilitas()->count())
                    <div class="form-group">
                        <label>Fasilitas</label>
                        <ol>
                            @foreach($beasiswa->fasilitas()->get() as $fasilitas)
                                <li>{{$fasilitas->nama}} {{$fasilitas->pivot->keterangan?"(".$fasilitas->pivot->keterangan.")":""}}</li>
                            @endforeach
                        </ol>
                    </div>
                    @endif
                    <div class="form-group mb-1 mt-5" style="font-size: 14px;color: #757575;">
                        <span class="mt-2">
                            <i class="nav-icon far fa-clock mr-1"></i>
                            Dibuat pada {{date('d M Y H:i', strtotime($beasiswa->created_at))}}
                            @if($beasiswa->created_at != $beasiswa->updated_at) | Diperbarui pada {{date('d M Y H:i', strtotime($beasiswa->updated_at))}}@endif
                        </span>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('action')
    <div class="float-sm-right">
        <a href="{{route('dashboard.beasiswa.index')}}" class="btn btn-secondary">Back</a>
    </div>
@endsection

@section('css')
@endsection

@section('js')
@endsection