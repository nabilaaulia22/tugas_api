@extends('template.index')

@section('content')
    <div style="display: flex; justify-content: center">
        <div class="card" style="width: 600px; height: 425px">
            <div class="card-header">
                <h3 class="text-center">Edit Data Unit</h3>
            </div>
            <!-- /.card-header -->
            <div class="container">
                <div class="row justify-content-center">

                    <div class="col-6">
                        <form action="/updatedata/{{ $data->id }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="mt-3">
                                <label for="exampleInputEmail1" class="form-label">ID Unit</label>
                                <input name ="id_unit" type="text" class="form-control" id="exampleInputEmail1"
                                    aria-describedby="emailHelp" value="{{ $data->id_unit }}">
                            </div>
                            <div class="mt-3">
                                <label for="exampleInputEmail1" class="form-label">IP Unit</label>
                                <input name ="ip_unit" type="text" class="form-control" id="exampleInputEmail1"
                                    aria-describedby="emailHelp" value="{{ $data->ip_unit }}">
                            </div>
                            <div class="mt-3">
                                <label for="exampleInputEmail1" class="form-label">Unit Name</label>
                                <input name ="unit_name" type="text" class="form-control" id="exampleInputEmail1"
                                    aria-describedby="emailHelp" value="{{ $data->unit_name }}">
                            </div>
                            <div class="mt-4">
                                <button type="submit" class="btn btn-primary">Ubah Data</button>
                            </div>
                        </form>
                    </div>

                </div>

            </div>




            {{-- <!-- /.card-body -->
        <div class="card-footer clearfix">
            <ul class="pagination pagination-sm m-0 float-right">
                <li class="page-item"><a class="page-link" href="#">«</a></li>
                <li class="page-item"><a class="page-link" href="#">1</a></li>
                <li class="page-item"><a class="page-link" href="#">2</a></li>
                <li class="page-item"><a class="page-link" href="#">3</a></li>
                <li class="page-item"><a class="page-link" href="#">»</a></li>
            </ul>
        </div> --}}
        </div>
    </div>
@endsection
