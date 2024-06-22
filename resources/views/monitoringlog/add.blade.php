@extends('template.index')

@section('content')
    <div style="display: flex; justify-content: center">
        <div class="card" style="width: 600px; height: 425px">
            <div class="card-header">
                <h3 class="text-center">TAMBAH UNIT</h3>
            </div>
            <!-- /.card-header -->
            <div class="container">
                <div class="row justify-content-center">

                    <div class="col-6">
                        <form action="{{ route('insertdata') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="mt-3">
                                <label for="id_unit" class="form-label">ID UNIT</label>
                                <input name="id_unit" type="text" class="form-control" id="id_unit" aria-describedby="emailHelp" required>
                                <!-- Tambahkan required di sini -->
                            </div>
                            <div class="mt-3">
                                <label for="ip_unit" class="form-label">IP UNIT</label>
                                <input name="ip_unit" type="text" class="form-control" id="ip_unit" aria-describedby="emailHelp" required>
                                <!-- Tambahkan required di sini -->
                            </div>
                            <div class="mt-3">
                                <label for="unit_name" class="form-label">UNIT NAME</label>
                                <input name="unit_name" type="text" class="form-control" id="unit_name" aria-describedby="emailHelp" required>
                                <!-- Tambahkan required di sini -->
                            </div>

                            <div class="mt-4">
                                <button type="submit" class="btn btn-primary">Submit</button>
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
