@extends('template.index')

@section('title', '')

@section('content')

<div class="card">
    <div class="card-header">
        <h3 class="text-center">DATA UP</h3>
    </div>
    <!-- /.card-header -->
    <div class="container">
        <table class="table table-bordered">
            <thead>
                <tr class="text-center">
                    <th style="width: 10px">NO</th>
                    <th>DOWN ID</th>
                    <th>IP ADDRESS</th>
                    <th>UNIT NAME</th>
                    <th>UP TIME</th>
                </tr>
            </thead>
            <tbody>
                @php
                    $no = 1;
                @endphp

                @foreach ($data as $item)
                    <tr>
                        <td>{{ $no++ }}</td>
                        <td>{{ $item->down ? $item->down->id : '' }}</td> <!-- Periksa apakah relasi "down" tersedia -->
                        <td>{{ $item->ip_address }}</td>
                        <td>{{ $item->unit_name }}</td>
                        <td>{{ $item->up_time }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    <!-- /.card-body -->
</div>

@endsection
