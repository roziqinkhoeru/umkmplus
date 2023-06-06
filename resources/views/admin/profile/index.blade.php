@extends('admin.layouts.app')

@section('content')
    <div class="container">
        <div class="page-inner">
            <h4 class="page-title">Admin Profile</h4>
            <div class="row">
                <div class="col-md-8">
                    <div class="card card-with-nav">
                        {{-- tab --}}
                        <div class="card-header">
                            <div class="row row-nav-line">
                                <ul class="nav nav-tabs nav-line nav-color-secondary w-100 pl-4" role="tablist">
                                    <li class="nav-item"> <a class="nav-link active show" data-toggle="tab" href="#profile"
                                            role="tab" aria-selected="false">Profile</a> </li>
                                </ul>
                            </div>
                        </div>
                        {{-- form profile --}}
                        <div class="card-body">
                            <form action="#" id="profileAdminForm">
                                <div class="row mt-3">
                                    {{-- name --}}
                                    <div class="col-md-6">
                                        <div class="form-group form-group-default">
                                            <label>Name</label>
                                            <input type="text" class="form-control" name="name" placeholder="Name"
                                                value="Hizrian">
                                        </div>
                                    </div>
                                    {{-- email --}}
                                    <div class="col-md-6">
                                        <div class="form-group form-group-default">
                                            <label>Email</label>
                                            <input type="email" class="form-control" name="email" placeholder="Name"
                                                value="hello@example.com">
                                        </div>
                                    </div>
                                </div>
                                <div class="row mt-3">
                                    {{-- birth date --}}
                                    <div class="col-md-4">
                                        <div class="form-group form-group-default">
                                            <label>Birth Date</label>
                                            <input type="text" class="form-control" id="datepicker" name="datepicker"
                                                value="03/21/1998" placeholder="Birth Date">
                                        </div>
                                    </div>
                                    {{-- gender --}}
                                    <div class="col-md-4">
                                        <div class="form-group form-group-default">
                                            <label>Gender</label>
                                            <select class="form-control" id="gender" name="gender">
                                                <option value="Laki-laki">Laki-laki</option>
                                                <option value="perempuan">perempuan</option>
                                            </select>
                                        </div>
                                    </div>
                                    {{-- phone --}}
                                    <div class="col-md-4">
                                        <div class="form-group form-group-default">
                                            <label>Phone</label>
                                            <input type="text" class="form-control" value="082314876543" name="phone"
                                                placeholder="Phone">
                                        </div>
                                    </div>
                                </div>
                                <div class="row mt-3">
                                    {{-- address --}}
                                    <div class="col-md-12">
                                        <div class="form-group form-group-default">
                                            <label>Address</label>
                                            <input type="text" class="form-control"
                                                value="st Merdeka Putih, Jakarta Indonesia" name="address"
                                                placeholder="Address">
                                        </div>
                                    </div>
                                </div>
                                <div class="text-right mt-3 mb-3">
                                    <button class="btn btn-success">Save</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card card-profile">
                        <div class="card-header"
                            style="background-image: url({{ asset('assets/template/admin/img/blogpost.jpg') }})">
                            <div class="profile-picture">
                                <div class="avatar avatar-xl">
                                    <img src="{{ asset('assets/template/admin/img/profile.jpg') }}" alt="profile-name-admin"
                                        class="avatar-img rounded-circle">
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="user-profile text-center">
                                <div class="name">Hizrian, 19</div>
                                <div class="job">Admin</div>
                                <div class="desc">
                                    Mengelola data UMKMPlus
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script>
        $('#datepicker').datetimepicker({
            format: 'MM/DD/YYYY',
        });

        $('#profileAdminForm').validate({
            rules: {
                name: {
                    required: true,
                },
                email: {
                    required: true,
                },
                datepicker: {
                    required: true,
                },
                gender: {
                    required: true,
                },
                phone: {
                    required: true,
                    number: true,
                    minlength: 10,
                },
                address: {
                    required: true,
                },
            },
            messages: {
                name: {
                    required: '<i class="fas fa-exclamation-circle mr-1 text-sm icon-error"></i>Nama tidak boleh kosong',
                },
                email: {
                    required: '<i class="fas fa-exclamation-circle mr-1 text-sm icon-error"></i>Email tidak boleh kosong',
                },
                datepicker: {
                    required: '<i class="fas fa-exclamation-circle mr-1 text-sm icon-error"></i>Tanggal lahir tidak boleh kosong',
                },
                gender: {
                    required: '<i class="fas fa-exclamation-circle mr-1 text-sm icon-error"></i>Jenis kelamin tidak boleh kosong',
                },
                phone: {
                    required: '<i class="fas fa-exclamation-circle mr-1 text-sm icon-error"></i>Nomor telepon tidak boleh kosong',
                    number: '<i class="fas fa-exclamation-circle mr-1 text-sm icon-error"></i>Nomor telepon harus berupa angka',
                    minlength: '<i class="fas fa-exclamation-circle mr-1 text-sm icon-error"></i>Nomor telepon minimal 10 digit',
                },
                address: {
                    required: '<i class="fas fa-exclamation-circle mr-1 text-sm icon-error"></i>Alamat tidak boleh kosong',
                }
            },
        });
    </script>
@endsection
