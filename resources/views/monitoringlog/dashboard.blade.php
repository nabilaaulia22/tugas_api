@extends('template.index')
@section('title', '')
@section('content')

    <div class="row">
        <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-info">
                <div class="inner">
                    <h3>{{ $totalDowntime }}</h3>
                    <p>Total Down</p>
                </div>
                <div class="icon">
                    <i class="fas fa-clock"></i>
                </div>
                <a href="{{ route('down') }}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
        </div>
        <!-- ./col -->

        <!-- ./col -->
        <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-warning">
                <div class="inner">
                    <h3>{{ $jumlahRayon }}</h3>
                    <p>Jumlah Unit</p>
                </div>
                <div class="icon">
                    <i class="fas fa-map-marker-alt"></i>
                </div>
                <a href="{{ Route('unitdata') }}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
        </div>
        <!-- ./col -->
<!-- Tambahkan jam digital di sini -->
<div id="digital-clock" class="digital-clock" style="font-size: 85px; font-weight: light; margin-left: 70px;"></div>



    </div>

    <div class="card-body">
        <div class="d-flex mb-3">
            <p class="d-flex flex-column">
                <span class="text-bold text-lg">GRAFIK DATA DOWN</span>
            </p>
        </div>
        <!-- /.d-flex -->
        <div class="row">
            <div class=" col-md-6 mb-4"> <!-- Sesuaikan lebar sesuai kebutuhan -->
                <canvas id="sales-chart"></canvas> <!-- Hapus atribut height -->
            </div>
            <div class="col-md-6" style="margin-top: -78px;"> <!-- Menambahkan margin atas negatif -->
                <div class="mb-3">
                    <h5 class="mb-3"><b>TOP 5 DOWN DATA THIS MONTH</b></h5>
                    <ul id="topDownData" class="list-group">
                        @foreach ($topDownData as $down)
                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                {{ $down->unit_name }}
                                <span class="badge badge-primary badge-pill">{{ $down->count }}</span>
                            </li>
                        @endforeach
                    </ul>
                </div>

            </div>
        </div>
    </div>

@endsection

@section('scripts')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.7.0/chart.min.js"></script>
    <script>
        var ctx = document.getElementById('sales-chart').getContext('2d');
        var myChart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: {!! json_encode($months) !!},
                datasets: [{
                    label: 'Down Data',
                    data: {!! json_encode($downCountsByMonth) !!},
                    backgroundColor: 'rgba(30, 144, 255, 0.5)', // Biru terang
                    borderColor: 'rgba(30, 144, 255, 1)',
                    borderWidth: 1
                }]
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true
                    }
                },
                plugins: {
                    title: {
                        display: true,
                        text: 'Down Data by Month - ' + (new Date()).getFullYear(), // Menambahkan label tahun
                        font: {
                            weight: 'bold'
                        }
                    }
                }

            }
        });

        // Fungsi untuk mengambil waktu saat ini dalam format xx:xx:xx
        function getCurrentTime() {
            var now = new Date();
            var hours = now.getHours().toString().padStart(2, '0');
            var minutes = now.getMinutes().toString().padStart(2, '0');
            var seconds = now.getSeconds().toString().padStart(2, '0');
            return hours + ":" + minutes + ":" + seconds;
        }

        // Fungsi untuk menampilkan jam digital secara real-time
        function updateDigitalClock() {
            var digitalClock = document.getElementById('digital-clock');
            if (digitalClock) {
                digitalClock.textContent = getCurrentTime();
            }
        }

        // Panggil fungsi updateDigitalClock setiap detik
        setInterval(updateDigitalClock, 1000);

        function refreshTopDownData() {
            $.ajax({
                url: "{{ route('api.getTopDownData') }}",
                method: "GET",
                success: function(data) {
                    $('#topDownData').empty();
                    data.forEach(function(item) {
                        $('#topDownData').append('<li class="list-group-item d-flex justify-content-between align-items-center">' +
                            item.unit_name + '<span class="badge badge-primary badge-pill">' +
                            item.count + '</span></li>');
                    });
                }
            });
        }

        // // Panggil fungsi refreshTopDownData saat halaman dimuat
        // $(document).ready(function() {
        //     refreshTopDownData();
        // });

        // Panggil fungsi refreshTopDownData setiap awal bulan
        setInterval(function() {
            var currentDate = new Date();
            if (currentDate.getDate() === 1) {
                refreshTopDownData();
            }
        }, 24 * 60 * 60 * 1000); // Setiap hari
    </script>z
@endsection
