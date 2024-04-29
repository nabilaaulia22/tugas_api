@extends('template.index')

@section('title', '')

@section('content')

    <div class="card">
        <div class="card-header">
            <h3 class="text-center">DATA DOWN</h3>
        </div>
        <!-- /.card-header -->
        <div class="container">
            <table id="downTable" class="table table-bordered">
                <thead>
                    <tr class="text-center">
                        <th style="width: 10px">NO</th>
                        <th>IP ADDRESS</th>
                        <th>UNIT NAME</th>
                        <th>DOWN TIME</th>
                        <th>DURATION</th> <!-- Tambahkan kolom untuk durasi -->
                    </tr>
                </thead>
                <tbody>
                    @php
                        $no = 1;
                    @endphp

                    @foreach ($data as $item)
                        @if (!$item->isUp()) <!-- Periksa apakah data masih down -->
                            <tr>
                                <td>{{ $no++ }}</td>
                                <td>{{ $item->ip_address }}</td>
                                <td>{{ $item->unit_name }}</td>
                                <td>{{ $item->down_time }}</td>
                                <td id="duration_{{ $item->id }}"></td> <!-- Kolom untuk menampilkan durasi -->
                            </tr>
                        @endif
                    @endforeach
                </tbody>
            </table>
        </div>
        <!-- /.card-body -->
    </div>

@endsection

@section('scripts')
    <script>
        // Fungsi untuk menghitung durasi dan memperbarui tampilan setiap detik
        function updateDurations() {
            var currentTime = new Date();
            @foreach ($data as $item)
                var row = document.getElementById("duration_{{ $item->id }}");
                if (row) { // Periksa apakah baris masih ada
                    @if (!$item->isUp()) // Periksa apakah data masih down
                        var downTime{{ $item->id }} = new Date("{{ $item->down_time }}");
                        var duration{{ $item->id }} = Math.floor((currentTime - downTime{{ $item->id }}) / 1000);
                        var days{{ $item->id }} = Math.floor(duration{{ $item->id }} / (3600 * 24));
                        var hours{{ $item->id }} = Math.floor((duration{{ $item->id }} % (3600 * 24)) / 3600);
                        var minutes{{ $item->id }} = Math.floor((duration{{ $item->id }} % 3600) / 60);
                        var seconds{{ $item->id }} = duration{{ $item->id }} % 60;
                        var durationString{{ $item->id }} = "";
                        if (days{{ $item->id }} > 0) {
                            durationString{{ $item->id }} += days{{ $item->id }} + " hari ";
                        }
                        durationString{{ $item->id }} += (hours{{ $item->id }} < 10 ? "0" + hours{{ $item->id }} : hours{{ $item->id }}) + " : " + (minutes{{ $item->id }} < 10 ? "0" + minutes{{ $item->id }} : minutes{{ $item->id }}) + " : " + (seconds{{ $item->id }} < 10 ? "0" + seconds{{ $item->id }} : seconds{{ $item->id }}) + " detik"; // Tambahkan "detik" di akhir
                        row.innerText = durationString{{ $item->id }};
                    @else
                        row.innerText = ""; // Kosongkan durasi jika data telah di-up
                    @endif
                }
            @endforeach
        }

        // Panggil fungsi untuk mengupdate durasi setiap detik
        setInterval(updateDurations, 1000);
    </script>
@endsection

@section('scripts')
    <script>
        // Fungsi untuk memuat ulang data setiap 30 detik
        function reloadPage() {
            location.reload(); // Memuat ulang halaman
        }

        // Panggil fungsi untuk memuat ulang setiap 30 detik
        setInterval(reloadPage, 30000); // 30 detik = 30000 milidetik
    </script>
@endsection

