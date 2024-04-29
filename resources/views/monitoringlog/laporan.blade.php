@extends('template.index')

@section('title', '')

@section('content')

    <div class="card">
        <div class="card-header">
            <h3 class="text-center">LOG TABLE LAPORAN</h3>
        </div>

        <div class="row">
            <div class="col">
                <form method="get" action="{{ route('laporan.filter') }}" class="form-inline">
                    @csrf
                    <div class="form-row">
                        <div class="col">
                            <label>Start Date</label>
                            <input type="date" name="start_date" id="start_date" class="form-control ml-3">
                        </div>
                        <div class="col">
                            <label>End Date</label>
                            <input type="date" name="end_date" id="end_date" class="form-control">
                        </div>
                        <div class="col" style="margin-top: 23px; margin-bottom: 23px;">
                            <button type="submit" name="filter_tgl" class="btn btn-primary">Search</button>
                        </div>
                    </div>
                </form>

            </div>
        </div>

        <div class="card-body">
            <div class="row mb-3 ">
                <div class="col-md-9"></div>
                <div class="col-md-3 d-flex align-items-end justify-content-end">
                    @if(isset($isFiltered) && $isFiltered)
                        <a class="btn btn-success btn-sm w-auto" href="{{ url('laporan/export/excel') }}">
                            <i class="fas fa-file-excel"></i> Download Excel
                        </a>
                    @endif
                </div>
            </div>
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th style="width: 10px">NO</th>
                        <th class="text-center">IP ADDRESS</th>
                        <th class="text-center">UNIT NAME</th>
                        <th class="text-center">DOWN TIME</th>
                        <th class="text-center">UP TIME</th>
                        <th class="text-center">DURATION</th>
                    </tr>
                </thead>
                <tbody>
                    @if (isset($logGangguan) && $logGangguan->count() > 0)
                        @foreach ($logGangguan as $index => $item)
                            <tr>
                                <td>{{ $index + 1 }}</td>
                                <td>{{ $item->ip_address }}</td>
                                <td>{{ $item->unit_name }}</td>
                                <td>{{ $item->down_time }}</td>
                                <td>{{ $item->up_time }}</td>
                                <td>{{ $item->duration }}</td>
                            </tr>
                        @endforeach
                    @else
                        @foreach ($logGangguan as $index => $item)
                            <tr>
                                <td>{{ $index + 1 }}</td>
                                <td>{{ $item->ip_address }}</td>
                                <td>{{ $item->unit_name }}</td>
                                <td>{{ $item->down_time }}</td>
                                <td>{{ $item->up_time }}</td>
                                <td>{{ $item->duration }}</td>
                            </tr>
                        @endforeach
                    @endif
                </tbody>
            </table>
        </div>
    </div>

@endsection
