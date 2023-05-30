@extends('admin.layouts.app')

@section('content')
    <div class="container">
        <div class="page-inner">
            {{-- header --}}
            <div class="page-header">
                <h4 class="page-title">Add Mentor</h4>
                <ul class="breadcrumbs">
                    <li class="nav-home">
                        <a href="/admin">
                            <i class="flaticon-home"></i>
                        </a>
                    </li>
                    <li class="separator">
                        <i class="flaticon-right-arrow"></i>
                    </li>
                    <li class="nav-item">
                        <a href="/admin/mentor">Data Mentor</a>
                    </li>
                    <li class="separator">
                        <i class="flaticon-right-arrow"></i>
                    </li>
                    <li class="nav-item">
                        Form Add Mentor
                    </li>
                </ul>
            </div>

            {{-- main content --}}
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <div class="card-title">Form Add Mentor</div>
                            <div class="card-category">
                                Form ini digunakan untuk menambah data mentor
                            </div>
                        </div>
                        <form id="addMentorForm" action="#">
                            <div class="card-body">
                                {{-- fullname --}}
                                <div class="form-group form-show-validation row">
                                    <label for="fullname" class="col-lg-3 col-md-3 col-sm-4 mt-sm-2 text-right">Nama Lengkap
                                        <span class="required-label">*</span></label>
                                    <div class="col-lg-4 col-md-9 col-sm-8">
                                        <input type="text" class="form-control" id="fullname" name="fullname"
                                            placeholder="Masukkan Nama Lengkap" required>
                                    </div>
                                </div>
                                {{-- username --}}
                                <div class="form-group form-show-validation row">
                                    <label for="username" class="col-lg-3 col-md-3 col-sm-4 mt-sm-2 text-right">Username
                                        <span class="required-label">*</span></label>
                                    <div class="col-lg-4 col-md-9 col-sm-8">
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text" id="username-addon">@</span>
                                            </div>
                                            <input type="text" class="form-control" placeholder="username"
                                                aria-label="username" aria-describedby="username-addon" id="username"
                                                name="username" required>
                                        </div>
                                    </div>
                                </div>
                                {{-- email --}}
                                <div class="form-group form-show-validation row">
                                    <label for="email" class="col-lg-3 col-md-3 col-sm-4 mt-sm-2 text-right">Email
                                        Address <span class="required-label">*</span></label>
                                    <div class="col-lg-4 col-md-9 col-sm-8">
                                        <input type="email" class="form-control" id="email" placeholder="Enter Email"
                                            required>
                                    </div>
                                </div>
                                {{-- password --}}
                                <div class="form-group form-show-validation row">
                                    <label for="password" class="col-lg-3 col-md-3 col-sm-4 mt-sm-2 text-right">Password
                                        <span class="required-label">*</span></label>
                                    <div class="col-lg-4 col-md-9 col-sm-8">
                                        <input type="password" class="form-control" id="password" name="password"
                                            placeholder="Enter Password" required>
                                    </div>
                                </div>
                            </div>
                            <div class="card-action">
                                <div class="row">
                                    <div class="col-md-12 text-right">
                                        <a href="/admin/mentor" class="btn btn-default btn-outline-dark">Cancel</a>
                                        <button class="btn btn-primary ml-3" type="submit">Add</button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script>
        $("#addMentorForm").validate({
            rules: {
                fullname: {
                    required: true,
                    minlength: 3,
                    maxlength: 50,
                },
                username: {
                    required: true,
                    minlength: 3,
                    maxlength: 50,
                },
                email: {
                    required: true,
                    email: true,
                },
                password: {
                    required: true,
                    minlength: 8,
                },
            },
            messages: {
                fullname: {
                    required: '<i class="fas fa-exclamation-circle mr-1 text-sm icon-error"></i>Nama lengkap tidak boleh kosong',
                    minlength: '<i class="fas fa-exclamation-circle mr-1 text-sm icon-error"></i>Nama lengkap minimal 3 karakter',
                    maxlength: '<i class="fas fa-exclamation-circle mr-1 text-sm icon-error"></i>Nama lengkap maksimal 50 karakter',
                },
                username: {
                    required: '<i class="fas fa-exclamation-circle mr-1 text-sm icon-error"></i>Username tidak boleh kosong',
                    minlength: '<i class="fas fa-exclamation-circle mr-1 text-sm icon-error"></i>Username minimal 3 karakter',
                    maxlength: '<i class="fas fa-exclamation-circle mr-1 text-sm icon-error"></i>Username maksimal 50 karakter',
                },
                email: {
                    required: '<i class="fas fa-exclamation-circle mr-1 text-sm icon-error"></i>Email tidak boleh kosong',
                    email: '<i class="fas fa-exclamation-circle mr-1 text-sm icon-error"></i>Email tidak valid',
                },
                password: {
                    required: '<i class="fas fa-exclamation-circle mr-1 text-sm icon-error"></i>Password tidak boleh kosong',
                    minlength: '<i class="fas fa-exclamation-circle mr-1 text-sm icon-error"></i>Password minimal 8 karakter',
                },
            },
            highlight: function(element) {
                $(element).closest('.form-group').removeClass('has-success').addClass('has-error');
            },
            success: function(element) {
                $(element).closest('.form-group').removeClass('has-error');
            },
        });
    </script>
@endsection
