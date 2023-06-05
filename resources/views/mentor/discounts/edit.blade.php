@extends('admin.layouts.app')

@section('content')
    <div class="container">
        <div class="page-inner">
            {{-- header --}}
            <div class="page-header">
                <h4 class="page-title">Ubah Diskon</h4>
                <ul class="breadcrumbs">
                    <li class="nav-home">
                        <a href="/mentor/dashboard">
                            <i class="flaticon-home"></i>
                        </a>
                    </li>
                    <li class="separator">
                        <i class="flaticon-right-arrow"></i>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('mentor.discount') }}">Data Diskon</a>
                    </li>
                    <li class="separator">
                        <i class="flaticon-right-arrow"></i>
                    </li>
                    <li class="nav-item">
                        <a href="#">Form Ubah Diskon</a>
                    </li>
                </ul>
            </div>

            {{-- main content --}}
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <div class="card-title">Form Ubah Diskon</div>
                            <div class="card-category">
                                Form ini digunakan untuk mengubah data diskon
                            </div>
                        </div>
                        <form id="formEditDiscount" action="#" method="POST">
                            @csrf
                            @method('PUT')
                            <div class="card-body">
                                {{-- Kode --}}
                                <div class="form-group form-show-validation row">
                                    <label for="code" class="col-lg-3 col-md-3 col-sm-4 mt-sm-2 text-right">Kode
                                        <span class="required-label">*</span></label>
                                    <div class="col-lg-4 col-md-9 col-sm-8">
                                        <input type="text" class="form-control" id="code" name="code"
                                            value="{{ $discount->code }}" required>
                                    </div>
                                </div>
                                {{-- Diskon --}}
                                <div class="form-group form-show-validation row">
                                    <label for="discount" class="col-lg-3 col-md-3 col-sm-4 mt-sm-2 text-right">Diskon (Rp)
                                        <span class="required-label">*</span></label>
                                    <div class="col-lg-4 col-md-9 col-sm-8">
                                        <input type="number" class="form-control" id="discount" name="discount"
                                            value="{{ $discount->discount }}" required>
                                    </div>
                                </div>
                            </div>
                            <div class="card-action">
                                <div class="row">
                                    <div class="col-md-12 text-right">
                                        <a href="/mentor/discount" class="btn btn-default btn-outline-dark">Batal</a>
                                        <button class="btn btn-primary ml-3" id="updateButton" type="submit">Ubah</button>
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
        $.validator.addMethod("nowhitespace", function(value, element) {
            return this.optional(element) || /^\S+$/i.test(value);
        }, "Kode tidak boleh ada spasi");
        $("#formEditDiscount").validate({
            rules: {
                code: {
                    required: true,
                    nowhitespace: true,
                    minlength: 10,
                    maxlength: 10,
                },
                discount: {
                    required: true,
                    number: true,
                },
            },
            messages: {
                code: {
                    required: '<i class="fas fa-exclamation-circle mr-6 text-sm icon-error"></i>Kode tidak boleh kosong',
                    nowhitespace: '<i class="fas fa-exclamation-circle mr-6 text-sm icon-error"></i>Kode tidak boleh ada spasi',
                    minlength: '<i class="fas fa-exclamation-circle mr-6 text-sm icon-error"></i>Kode kurang dari 10 karakter',
                    maxlength: '<i class="fas fa-exclamation-circle mr-6 text-sm icon-error"></i>Kode lebih dari 10 karakter',
                },
                discount: {
                    required: '<i class="fas fa-exclamation-circle mr-6 text-sm icon-error"></i>Diskon tidak boleh kosong',
                    number: '<i class="fas fa-exclamation-circle mr-6 text-sm icon-error"></i>Diskon harus berupa angka',
                },
            },
            highlight: function(element) {
                $(element).closest('.form-group').removeClass('has-success').addClass('has-error');
            },
            success: function(element) {
                $(element).closest('.form-group').removeClass('has-error');
            },
            submitHandler: function(form, event) {
                event.preventDefault();
                $('#updateButton').html('<i class="fas fa-circle-notch text-lg spinners-2"></i>');
                $('#updateButton').prop('disabled', true);
                $.ajax({
                    type: "PUT",
                    url: `{{ url('/mentor/discount/' . $discount->id) }}`,
                    data: {
                        code: $('#code').val(),
                        discount: $('#discount').val(),
                        _token: "{{ csrf_token() }}",
                    },
                    success: function(response) {
                        $('#updateButton').html('Ubah');
                        $('#updateButton').prop('disabled', false);
                        $.notify({
                            icon: 'flaticon-alarm-1',
                            title: 'UMKMPlus Admin',
                            message: response.meta.message,
                        }, {
                            type: 'secondary',
                            placement: {
                                from: "bottom",
                                align: "right",
                            },
                            time: 2000,
                        });
                        window.location.href = response.data.redirect
                    },
                    error: function(xhr, status, error) {
                        $('#updateButton').html('Ubah');
                        $('#updateButton').prop('disabled', false);
                        if (xhr.responseJSON) {
                            Swal.fire({
                                icon: 'error',
                                title: 'UBAH DISCOUNT GAGAL!',
                                text: xhr.responseJSON.meta.message + " Error: " + xhr
                                    .responseJSON.data.error,
                            });
                        } else {
                            Swal.fire({
                                icon: 'error',
                                title: 'UBAH DISCOUNT GAGAL!',
                                text: "Terjadi kegagalan, silahkan coba beberapa saat lagi! Error: " +
                                    error,
                            });
                        }
                        return false;
                    },
                });
            }
        });
    </script>
@endsection
