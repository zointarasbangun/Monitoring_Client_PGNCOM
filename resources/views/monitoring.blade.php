@extends('layout.main')

@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-0">
                    <div class="col-md-3">
                        <h5><b>Monitoring Customer</b></h5>
                    </div>
                    <div class="col-md-3">
                    </div>
                    {{-- <div class="col-md-6">
                        <h5> <b>Highlight PGNCOM</b></h5>
                    </div> --}}

                    <!-- /.col -->
                    {{-- <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item active">Dashboard v1</li>
                        </ol>
                    </div><!-- /.col --> --}}
                </div><!-- /.row -->
            </div>
            <!-- /.content-header -->

            <!-- Main content -->
            <section class="content">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-md-6">
                            @if (Auth::user()->role == 'admin')
                                <a href="{{ route('admin.monitoring.create') }}" class="btn btn-primary mb-1"> Tambah
                                    Data</a>
                            @endif
                            <div class="card">
                                {{-- <div class="card-header">
                                <div class="card-tools">
                                    <div class="input-group input-group-sm" style="width: 150px;">
                                        <input type="text" name="table_search" class="form-control float-right"
                                            placeholder="Search">

                                        <div class="input-group-append">
                                            <button type="submit" class="btn btn-default">
                                                <i class="fas fa-search"></i>
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div> --}}
                                <!-- /.card-header -->
                                <div class="card-body table-responsive p-0" style="max-height: 600px; overflow-y: auto;">
                                    <table class="table table-hover text-nowrap">
                                        {{-- <thead>
                                        <tr>
                                            <th>Logo</th>
                                            <th>Customer</th>
                                            <th>Status</th>
                                            @if (Auth::user()->role == 'admin')
                                                <th>Ip address</th>
                                                <th>Action</th>
                                            @endif

                                        </tr>
                                    </thead> --}}
                                        <tbody>
                                            @if ($monitoringData->isEmpty())
                                                <tr>
                                                    <td colspan="6" class="text-center">Tidak ada data monitoring</td>
                                                </tr>
                                            @else
                                                @foreach ($monitoringData as $d)
                                                    <tr>
                                                        <td><img src="{{ asset('storage/photo-user/'.$d->image) }}" alt="" width="30"></td>
                                                        <td style="white-space: pre-wrap;">{{ $d->nama }}</td>
                                                        <td id="status-{{ $d->id }}">
                                                            @if ($d->status == true)
                                                                <span class="badge bg-success">
                                                                    Terhubung
                                                                </span>
                                                            @else
                                                                <span class="badge bg-danger">
                                                                    Tidak Terhubung
                                                                </span>
                                                            @endif
                                                        </td>
                                                        @if (Auth::user()->role == 'admin')
                                                            <td>{{ $d->alamat_ip }}</td>
                                                            <td>
                                                                <a href="{{ route('admin.monitoring.edit', ['id' => $d->id]) }}"
                                                                    class="btn btn-primary"><i
                                                                        class="fas fa-pen"></i>Edit</a>
                                                                <a href="{{ route('admin.monitoring') }}"
                                                                    data-toggle="modal"
                                                                    data-target="#modal-hapus{{ $d->id }}"
                                                                    class="btn btn-danger"><i
                                                                        class="fas fa-trash-alt"></i>Hapus</i></a>
                                                            </td>
                                                        @endif
                                                    </tr>
                                                    <div class="modal fade" id="modal-hapus{{ $d->id }}">
                                                        <div class="modal-dialog">
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <h4 class="modal-title">Konfirmasi Hapus Data</h4>
                                                                    <button type="button" class="close"
                                                                        data-dismiss="modal" aria-label="Close">
                                                                        <span aria-hidden="true">&times;</span>
                                                                    </button>
                                                                </div>
                                                                <div class="modal-body">
                                                                    <p>Apakah anda yakin ingin menghapus data user
                                                                        <b>{{ $d->name }}</b>
                                                                    </p>
                                                                </div>

                                                                <div class="modal-footer justify-content-between">
                                                                    <form
                                                                        action="{{ route('admin.monitoring.delete', ['id' => $d->id]) }}"
                                                                        method="POST">
                                                                        @csrf
                                                                        @method('DELETE')
                                                                        <button type="button" class="btn btn-default"
                                                                            data-dismiss="modal">Close</button>
                                                                        <button type="submit" class="btn btn-primary">Ya,
                                                                            Hapus
                                                                            Data</button>
                                                                    </form>

                                                                </div>
                                                            </div>
                                                            <!-- /.modal-content -->
                                                        </div>
                                                        <!-- /.modal-dialog -->
                                                    </div>
                                                    <!-- /.modal -->
                                                @endforeach
                                            @endif
                                        </tbody>
                                    </table>
                                </div>
                                <!-- /.card-body -->
                            </div>
                            <!-- /.card -->
                        </div>
                        <div class="col-md-6">
                            @if (Auth::user()->role == 'admin')
                                <a href="{{ route('admin.monitoring.create') }}" class="mb-1"></a>
                            @endif
                            <div class="card">
                                {{-- <div class="card-header">
                                <div class="card-tools">
                                    <div class="input-group input-group-sm" style="width: 150px;">
                                        <input type="text" name="table_search" class="form-control float-right"
                                            placeholder="Search">

                                        <div class="input-group-append">
                                            <button type="submit" class="btn btn-default">
                                                <i class="fas fa-search"></i>
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div> --}}
                                <!-- /.card-header -->
                                <div class="card-body table-responsive p-0" style="max-height: 600px; overflow-y: auto;">
                                    <table class="table table-hover text-nowrap">
                                        {{-- <thead>
                                        <tr>
                                            <th>Logo</th>
                                            <th>Customer</th>
                                            <th>Status</th>
                                            @if (Auth::user()->role == 'admin')
                                                <th>Ip address</th>
                                                <th>Action</th>
                                            @endif

                                        </tr>
                                    </thead> --}}
                                        <tbody>
                                            @if ($monitoringData->isEmpty())
                                                <tr>
                                                    <td colspan="6" class="text-center">Tidak ada data monitoring</td>
                                                </tr>
                                            @else
                                                @foreach ($monitoringData as $d)
                                                    <tr>
                                                        <td><img src="{{ asset('storage/photo-user/'.$d->image) }}" alt="" width="30"></td>
                                                        <td style="white-space: pre-wrap;">{{ $d->nama }}</td>
                                                        <td id="status-{{ $d->id }}">
                                                            @if ($d->status == true)
                                                                <span class="badge bg-success">
                                                                    Terhubung
                                                                </span>
                                                            @else
                                                                <span class="badge bg-danger">
                                                                    Tidak Terhubung
                                                                </span>
                                                            @endif
                                                        </td>
                                                        @if (Auth::user()->role == 'admin')
                                                            <td>{{ $d->alamat_ip }}</td>
                                                            <td>
                                                                <a href="{{ route('admin.monitoring.edit', ['id' => $d->id]) }}"
                                                                    class="btn btn-primary"><i
                                                                        class="fas fa-pen"></i>Edit</a>
                                                                <a href="{{ route('admin.monitoring') }}"
                                                                    data-toggle="modal"
                                                                    data-target="#modal-hapus{{ $d->id }}"
                                                                    class="btn btn-danger"><i
                                                                        class="fas fa-trash-alt"></i>Hapus</i></a>
                                                            </td>
                                                        @endif
                                                    </tr>
                                                    <div class="modal fade" id="modal-hapus{{ $d->id }}">
                                                        <div class="modal-dialog">
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <h4 class="modal-title">Konfirmasi Hapus Data</h4>
                                                                    <button type="button" class="close"
                                                                        data-dismiss="modal" aria-label="Close">
                                                                        <span aria-hidden="true">&times;</span>
                                                                    </button>
                                                                </div>
                                                                <div class="modal-body">
                                                                    <p>Apakah anda yakin ingin menghapus data user
                                                                        <b>{{ $d->name }}</b>
                                                                    </p>
                                                                </div>

                                                                <div class="modal-footer justify-content-between">
                                                                    <form
                                                                        action="{{ route('admin.monitoring.delete', ['id' => $d->id]) }}"
                                                                        method="POST">
                                                                        @csrf
                                                                        @method('DELETE')
                                                                        <button type="button" class="btn btn-default"
                                                                            data-dismiss="modal">Close</button>
                                                                        <button type="submit" class="btn btn-primary">Ya,
                                                                            Hapus
                                                                            Data</button>
                                                                    </form>

                                                                </div>
                                                            </div>
                                                            <!-- /.modal-content -->
                                                        </div>
                                                        <!-- /.modal-dialog -->
                                                    </div>
                                                    <!-- /.modal -->
                                                @endforeach
                                            @endif
                                        </tbody>
                                    </table>
                                </div>
                                <!-- /.card-body -->
                            </div>
                            <!-- /.card -->
                        </div>
                        {{-- <div class="col-md-5">
                            <!-- Kontainer slide gambar dan video -->
                            <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
                                <ol class="carousel-indicators">
                                    <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
                                    <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
                                    <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
                                    <li data-target="#carouselExampleIndicators" data-slide-to="3"></li>
                                    <li data-target="#carouselExampleIndicators" data-slide-to="4"></li>
                                </ol>
                                <div class="carousel-inner">
                                    <div class="carousel-item active">
                                        <img class="img-fluid" src="{{ URL('images/pgncom1.jpeg') }}" alt="Slide 1">
                                    </div>
                                    <div class="carousel-item">
                                        <img class="img-fluid" src="{{ URL('images/pertamina.jpeg') }}" alt="Slide 2">
                                    </div>
                                    <div class="carousel-item">
                                        <img class="img-fluid" src="{{ URL('images/akhlak.jpeg') }}" alt="Slide 3">
                                    </div>
                                    <div class="carousel-item">
                                        <img class="img-fluid" src="{{ URL('images/pgncom1.jpeg') }}" alt="Slide 4">
                                    </div>
                                    <div class="carousel-item">
                                        <video class="img-fluid" src="{{ URL('images/PROFILE_PGNCOM.mp4') }}" controls allowfullscreen></video>
                                    </div>
                                </div>
                                <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
                                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                    <span class="sr-only">Previous</span>
                                </a>
                                <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
                                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                    <span class="sr-only">Next</span>
                                </a>
                            </div>
                        </div> --}}


                        <style>
                            .carousel-control-prev {
                                left: -75px;
                            }

                            .carousel-control-next {
                                right: -75px;
                            }
                        </style>



                    </div>
                    <!-- /.row (main row) -->
                </div><!-- /.container-fluid -->
            </section>
            <!-- /.content -->
        </div>

        @section('js')
    <script>
        var data = @json($monitoringData);
        function tesPing(){

            data.forEach(d => {
                $.ajax({
                    type:"get",
                    url:"{{ url('admin/tesPing') }}",
                    data:{ip:d.alamat_ip},
                    success:function(status){
                        if (status == true){
                            $("[id='status-"+d.id+"']").html("<span class='badge bg-success'>Terhubung</span>")
                        }
                        else{
                            $("[id='status-"+d.id+"']").html("<span class='badge bg-danger'>Tidak Terhubung</span>")
                        }

                    }
                })
            });
        }

        $(document).ready(function(){
            setInterval(tesPing, 1000 );
             // $("[id='status-25']").html("<span class='badge bg-success'>Terhubung</span>")
        })
    </script>
    @stop
    @endsection
