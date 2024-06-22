@extends('template.index')

@section('title', '')

@section('content')

<div class="row justify-content-center">
    <!-- Profile Information -->
    <div class="col-md-6">
        <div class="card card-primary card-outline">
            <div class="card-body box-profile text-center">
                <div>
                    <img class="profile-user-img img-fluid img-circle"
                        src="{{ asset('photo/' . auth()->user()->photo) }}" alt="User profile picture">
                </div>

                <h3 class="profile-username">{{ auth()->user()->name }}</h3>
                <p class="text-muted">{{ auth()->user()->email }}</p>

                <form action="/update_profile" method="post" class="form-horizontal" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group row">
                        <label for="name" class="col-sm-3 col-form-label text-right">Ubah Nama</label>
                        <div class="col-sm-9">
                            <input type="text" name="name" class="form-control" id="name">
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="email" class="col-sm-3 col-form-label text-right">Ubah Email</label>
                        <div class="col-sm-9">
                            <input type="email" name="email" class="form-control" id="email">
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="photo" class="col-sm-3 col-form-label text-right">Ubah Photo</label>
                        <div class="col-sm-9">
                            <input type="file" name="photo" class="form-control" id="photo">
                        </div>
                    </div>

                    <button type="submit" class="btn btn-primary btn-block"><b>Update Profile</b></button>
                </form>
            </div>
            <!-- /.card-body -->
        </div>
    </div>
</div>

<div class="row justify-content-center">
    <!-- Password Update -->
    <div class="col-md-6">
        <div class="card card-primary card-outline">
            <div class="card-body box-profile text-center">
                <form action="/update_password" method="post" class="form-horizontal">
                    @csrf
                    <div class="form-group row">
                        <label for="password" class="col-sm-4 col-form-label text-right">Ubah Password</label>
                        <div class="col-sm-8">
                            <input type="password" name="password" class="form-control" id="password" required>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="konfirmasi_password" class="col-sm-4 col-form-label text-right">Konfirmasi Password</label>
                        <div class="col-sm-8">
                            <input type="password" name="konfirmasi_password" class="form-control" id="konfirmasi_password" required>
                        </div>
                    </div>

                    <button type="submit" class="btn btn-primary btn-block"><b>Update Password</b></button>
                </form>
            </div>
            <!-- /.card-body -->
        </div>
    </div>
</div>

@endsection
