@extends('layoutDash.main')

  @section('content')
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">{{$title}}</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">{{$title}}</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        

        @if (session('Success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
              {{session('Success')}}
              <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>  
            @endif
      
            @if ($errors->any())
            @foreach ($errors->all() as $error)
            <div class="alert alert-warning alert-dismissible fade show" role="alert">
                <strong>{{ $error }}</strong> mohon periksa kembali
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            @endforeach
        @endif
        {{-- <a href="{{route('jadwal.create')}}" class="btn btn-primary mb-3"> Tambah Data Jadwal</a> --}}
        <button type="button" class="btn btn-primary mb-3" data-toggle="modal" data-target="#exampleModal">
          <i class="fas fa-plus mr-2"></i>
          Tambah Data Jadwal
      </button>
        <div class="card">
          <div class="card-header bg-success text-center" >
            Jadwal hari ini
          </div>
          <div class="card-body">
              
            <div class="row">
                @foreach($kelas as $kelas)
                <div class="col-lg-3 col-6">
                  <!-- small box -->
                  <div class="small-box bg-info">
                    <div class="inner">
                      <h3>{{$kelas->angka_kelas}} {{$kelas->abjad_kelas}}</h3>
      
                      <p>Wali kelas: {{$kelas->wali_kelas}}</p>
                    </div>
                    <div class="icon">
                      <i class="ion ion-bag"></i>
                    </div>
                    <a href="{{route('jadwal.show',$kelas->id)}}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                  </div>
                </div>
                @endforeach
          </div>
        </div>





</div>
</section>
<!-- /.content -->
</div>
@endsection
