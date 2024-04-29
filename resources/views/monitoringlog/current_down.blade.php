@extends('template.index')

@section('title', '')

@section('content')

<div class="card">
    <div class="card-header">
        <h3 class="text-center">DATA YANG SEDANG DOWN</h3>
    </div>
    <!-- /.card-header -->
    <div class="container">
        <table class="table table-bordered">
            <thead>
                <tr class="text-center">
                    <th style="width: 10px">NO</th>
                    <th>IP ADDRESS</th>
                    <th>UNIT NAME</th>
                    <th>DOWN TIME</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($currentDownData as $index => $down)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td>{{ $down->ip_address }}</td>
                    <td>{{ $down->unit_name }}</td>
                    <td>{{ $down->down_time }}</td>
                </tr>
                @endforeach
                @if ($currentDownData->isEmpty())
                <tr>
                    <td colspan="4" class="text-center">Tidak ada data down yang sedang aktif</td>
                </tr>
                @endif
            </tbody>
        </table>
    </div>
    <!-- /.card-body -->
</div>

@endsection
