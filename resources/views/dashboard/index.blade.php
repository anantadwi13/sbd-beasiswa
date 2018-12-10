@extends("layout.dashboard")

@section('content')
    <div class="row">
        <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-info">
                <div class="inner">
                    <h3>{{\App\Beasiswa::count()}}</h3>

                    <p>Beasiswa</p>
                </div>
                <div class="icon">
                    <i class="fa fa-list"></i>
                </div>
                <a href="{{route('dashboard.beasiswa.index')}}" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
            </div>
        </div>
        <!-- ./col -->
        @if(Auth::check() && Auth::user()->type == \App\User::TYPE_ADMIN)
        <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-success">
                <div class="inner">
                    <h3>{{\App\Perusahaan::count()}}</h3>

                    <p>Instansi/Perusahaan</p>
                </div>
                <div class="icon">
                    <i class="far fa-building"></i>
                </div>
                <a href="{{route('dashboard.perusahaan.index')}}" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
            </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-warning">
                <div class="inner">
                    <h3>{{\App\Persyaratan::count()}}</h3>

                    <p>Persyaratan</p>
                </div>
                <div class="icon">
                    <i class="fa fa-clipboard-check"></i>
                </div>
                <a href="{{route('dashboard.persyaratan.index')}}" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
            </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-danger">
                <div class="inner">
                    <h3>{{\App\Fasilitas::count()}}</h3>

                    <p>Fasilitas</p>
                </div>
                <div class="icon">
                    <i class="fa fa-star"></i>
                </div>
                <a href="{{route('dashboard.fasilitas.index')}}" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
            </div>
        </div>
        @endif
        <!-- ./col -->
    </div>
@endsection