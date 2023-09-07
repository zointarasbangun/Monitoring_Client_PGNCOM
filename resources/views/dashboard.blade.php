    @extends('layout.main')
    @section('content')
        <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            <div class="content-header">
                <div class="container-fluid">
                    <div class="row mb-2">
                        <div class="col-sm-6">
                            <h1 class="m-0">Dashboard</h1>
                        </div><!-- /.col -->

                    </div><!-- /.row -->
                </div><!-- /.container-fluid -->
            </div>
            <!-- /.content-header -->

            <!-- Main content -->
            <section class="content">
                <div class="container-fluid">
                    <!-- ./col -->

                    <!-- Small boxes (Stat box) -->
                    <div class="row">
                        <div class="col-lg-3 col-6">
                            <!-- small box -->
                            <div class="small-box bg-warning">
                                <div class="inner">
                                    <h3>22</h3>

                                    <p>Customer PGNCOM</p>
                                </div>
                                <div class="icon">
                                    <i class="ion ion-person-add"></i>
                                </div>
                                <a href="{{ route('admin.monitoring') }}" class="small-box-footer">More info <i
                                        class="fas fa-arrow-circle-right"></i></a>
                            </div>
                        </div>
                        <div class="col-lg-3 col-6">
                            <!-- small box -->
                            <div class="small-box bg-info">
                                <div class="inner">
                                    <h3>-</h3>

                                    <p>New Customers</p>
                                </div>
                                <div class="icon">
                                    <i class="ion ion-bag"></i>
                                </div>
                                <a href="#" class="small-box-footer">More info <i
                                        class="fas fa-arrow-circle-right"></i></a>
                            </div>
                        </div>
                        <!-- ./col -->
                        <div class="col-lg-3 col-6">
                            <!-- small box -->
                            <div class="small-box bg-success">
                                <div class="inner">
                                    <h3>-<sup style="font-size: 20px">%</sup></h3>

                                    <p>Bounce Rate</p>
                                </div>
                                <div class="icon">
                                    <i class="ion ion-stats-bars"></i>
                                </div>
                                <a href="#" class="small-box-footer">More info <i
                                        class="fas fa-arrow-circle-right"></i></a>
                            </div>
                        </div>
                        <!-- ./col -->
                        <div class="col-lg-3 col-6">
                            <!-- small box -->
                            <div class="small-box bg-danger">
                                <div class="inner">
                                    <h3>-</h3>

                                    <p>More</p>
                                </div>
                                <div class="icon">
                                    <i class="ion ion-pie-graph"></i>
                                </div>
                                <a href="#" class="small-box-footer">More info <i
                                        class="fas fa-arrow-circle-right"></i></a>
                            </div>
                        </div>
                        <!-- ./col -->
                    </div>
                    <!-- /.row -->
                    <!-- Main row -->
                    <div class="row">
                        <!-- Left col -->
                        <section class="col-lg-7 connectedSortable">
                            <!-- Custom tabs (Charts with tabs)-->

                            <div class="col-lg-12 connectedSortable">
                                <div id="map" style="width: 800px; height: 400px;"></div>
                            </div>

                            <script>
                                const map = L.map('map').setView([-5.400219, 105.256424], 11);

                                const tiles = L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png', {
                                    maxZoom: 19,
                                    attribution: '&copy; <a href="http://www.openstreetmap.org/copyright">OpenStreetMap</a>'
                                }).addTo(map);

                                const markers = @json($monitoringData);

                                markers.forEach(markerData => {
                                    const marker = L.marker([markerData.latitude, markerData.longitude]).addTo(map)
                                        .bindPopup(
                                            `<img src="{{ asset('storage/photo-user/') }}/${markerData.image}" alt="" width="30"><b>${markerData.nama}</b><br  />Status Jaringan: ${markerData.status ? '<span class="badge bg-success">Terhubung</span>' : '<span class="badge bg-danger">Tidak Terhubung</span>'}`
                                        ).openPopup();
                                });

                                function onMapClick(e) {
                                    popup
                                        .setLatLng(e.latlng)
                                        .setContent(`You clicked the map at ${e.latlng.toString()}`)
                                        .openOn(map);
                                }

                                map.on('click', onMapClick);
                            </script>

                        </section>
                        <!-- /.Left col -->
                        <!-- right col (We are only adding the ID to make the widgets sortable)-->
                        <section class="col-lg-5 connectedSortable">
                            <div class="col-md-12">
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
                                        <div class="carousel-item active"><img class="img-fluid" src="{{ URL('images/pgncom1.jpeg') }}" alt="Slide 1">

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
                                            <video class="img-fluid" src="{{ URL('images/PROFILE_PGNCOM.mp4') }}" controls
                                                allowfullscreen></video>
                                        </div>
                                    </div>
                                    <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button"
                                        data-slide="prev">
                                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                        <span class="sr-only">Previous</span>
                                    </a>
                                    <a class="carousel-control-next" href="#carouselExampleIndicators" role="button"
                                        data-slide="next">
                                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                        <span class="sr-only">Next</span>
                                    </a>
                                </div>
                            </div>
                        </section>
                        <!-- right col -->
                    </div>
                    <!-- /.row (main row) -->
                </div><!-- /.container-fluid -->
            </section>
            <!-- /.content -->
        </div>
    @section('js')
        <script>
            var map;
            var markersData = @json($monitoringData);
            var markers = {};

            function initializeMap() {
                map = L.map('map').setView([-5.400219, 105.256424], 11);

                L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                    maxZoom: 19,
                    attribution: '&copy; <a href="http://www.openstreetmap.org/copyright">OpenStreetMap</a>'
                }).addTo(map);

                markersData.forEach(markerData => {
                    markers[markerData.id] = L.marker([markerData.latitude, markerData.longitude]).addTo(map);
                    updateMarkerStatus(markerData);
                });
            }

            function updateMarkerStatus(markerData) {
                $.ajax({
                    type: "get",
                    url: "{{ url('admin/tesPing') }}",
                    data: {
                        ip: markerData.alamat_ip
                    },
                    success: function(status) {
                        const marker = markers[markerData.id];
                        if (status == true) {
                            marker.bindPopup(
                                `<img src="{{ asset('storage/photo-user/') }}/${markerData.image}" alt="" width="30"><b>${markerData.nama}</b><br  />Status Jaringan: <span class="badge bg-success">Terhubung</span>`
                            ).openPopup();
                        } else {
                            marker.bindPopup(
                                `<img src="{{ asset('storage/photo-user/') }}/${markerData.image}" alt="" width="30"><b>${markerData.nama}</b><br  />Status Jaringan: <span class="badge bg-danger">Tidak Terhubung</span>`
                            ).openPopup();
                        }
                    }
                });
            }

            $(document).ready(function() {
                initializeMap();
                setInterval(updateMarkersStatus, 1000);
            });

            function updateMarkersStatus() {
                markersData.forEach(markerData => {
                    updateMarkerStatus(markerData);
                });
            }
        </script>
    @stop
@endsection
