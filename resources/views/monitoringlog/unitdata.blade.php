@extends('template.index')

@section('title','')

@section('content')

<div class="card">
    <div class="card-header">
      <h3 class="text-center">DATA TABLE</h3>
    </div>
    <!-- /.card-header -->
    <div class="container">
      <a href="{{ route('add') }}" class="btn btn-success mt-2 mb-2">Add <i class="fas fa-plus-square"></i></a>
      <table class="table table-bordered">
        <thead>
          <tr class="text-center">
            <th style="width: 10px">NO</th>
            <th>ID UNIT</th>
            <th>IP UNIT</th>
            <th>UNIT NAME</th>
            <th style="width: 30px">ACTION</th>
          </tr>
        </thead>
        <tbody>
            @php
                $no =1;
            @endphp


            @foreach ($data as $item)
            <tr>
                <td>{{ $no++ }}</td>
                <td>{{ $item['id_unit']}}</td>
                <td>{{ $item['ip_unit']}}</td>
                <td>{{ $item['unit_name']}}</td>

                <td class="text-center">
                    <a href="/tampilkandata/{{ $item->id }}"><i class= "fas fa-edit" style=""></i></a>
                    <a href="/delete/{{ $item->id }}"><i class= "fas fa-trash-alt" style="color: red",></i></a>
                </td>
            </tr>
            @endforeach
        </tbody>
      </table>
    </div>
    <!-- /.card-body -->
    <div class="card-footer clearfix">
      <ul class="pagination pagination-sm m-0 float-right">
        <li class="page-item"><a class="page-link" href="#">«</a></li>
        <li class="page-item"><a class="page-link" href="#">1</a></li>
        <li class="page-item"><a class="page-link" href="#">2</a></li>
        <li class="page-item"><a class="page-link" href="#">3</a></li>
        <li class="page-item"><a class="page-link" href="#">»</a></li>
      </ul>
    </div>
  </div>

@endsection
