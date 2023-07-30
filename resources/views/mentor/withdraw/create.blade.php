@extends('admin.layouts.app')

@section('content')
    <div class="container">
        <div class="page-inner">
            {{-- header --}}
            <div class="page-header">
                <h4 class="page-title">Permohonan Withdraw</h4>
                <ul class="breadcrumbs">
                    <li class="nav-home">
                        <a href="{{ route('mentor.dashboard') }}">
                            <i class="flaticon-home"></i>
                        </a>
                    </li>
                    <li class="separator">
                        <i class="flaticon-right-arrow"></i>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('mentor.withdraw') }}">Data Withdraw</a>
                    </li>
                    <li class="separator">
                        <i class="flaticon-right-arrow"></i>
                    </li>
                    <li class="nav-item">
                        <a href="#">Form Permohonan Withdraw</a>
                    </li>
                </ul>
            </div>

            {{-- main content --}}
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <div class="card-title">Form Permohonan Withdraw</div>
                            <div class="card-category">
                                Form ini digunakan untuk menambah data Permohonan Withdraw
                            </div>
                        </div>
                        <form id="withdrawForm" action="#" method="POST">
                            @csrf
                            <div class="card-body">
                                {{-- accountNumber --}}
                                <div class="form-group form-show-validation row">
                                    <label for="accountNumber"
                                        class="col-lg-3 col-md-3 col-sm-4 mt-sm-2 text-sm-right">Nomer
                                        Rekening Bank
                                        <span class="required-label">*</span></label>
                                    <div class="col-lg-4 col-md-9 col-sm-8">
                                        <div class="input-group">
                                            <input type="text" class="form-control"
                                                placeholder="Masukkan Nomer Rekening Bank"
                                                value="{{ old('accountNumber') }}" aria-label="accountNumber"
                                                aria-describedby="accountNumber-addon" id="accountNumber"
                                                name="accountNumber" required>
                                        </div>
                                    </div>
                                </div>
                                {{-- accountName --}}
                                <div class="form-group form-show-validation row">
                                    <label for="accountName" class="col-lg-3 col-md-3 col-sm-4 mt-sm-2 text-sm-right">Nama
                                        Pemilik Bank
                                        <span class="required-label">*</span></label>
                                    <div class="col-lg-4 col-md-9 col-sm-8">
                                        <div class="input-group">
                                            <input type="text" class="form-control"
                                                placeholder="Masukkan Nama Pemilik Bank" value="{{ old('accountName') }}"
                                                aria-label="accountName" aria-describedby="accountName-addon"
                                                id="accountName" name="accountName" required>
                                        </div>
                                    </div>
                                </div>
                                {{-- bank --}}
                                <div class="form-group form-show-validation row">
                                    <label for="bank" class="col-lg-3 col-md-3 col-sm-4 mt-sm-2 text-sm-right">
                                        Bank
                                        <span class="required-label">*</span></label>
                                    <div class="col-lg-4 col-md-9 col-sm-8">
                                        <select class="form-control" aria-label="Default select example" name="bank"
                                            id="bank" required>
                                            {{-- <option hidden>Pilih Spesialisasi</option> --}}
                                            @foreach ($banks as $bank)
                                                <option @if ($bank == old('bank')) selected @endif
                                                    value="{{ $bank }}">{{ $bank }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                {{-- amount --}}
                                <div class="form-group form-show-validation row">
                                    <label for="amount" class="col-lg-3 col-md-3 col-sm-4 mt-sm-2 text-sm-right"> Jumlah
                                        Withdraw <br> (Maks. Rp {{ number_format($balance, 0, ',', '.') }})
                                        <span class="required-label">*</span></label>
                                    <div class="col-lg-4 col-md-9 col-sm-8">
                                        <div class="input-group mb-3">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text">Rp</span>
                                            </div>
                                            <input type="number" name="amount" class="form-control" id="amount"
                                                placeholder="Masukkan Jumlah Withdraw" value="{{ old('amount') }}"
                                                min="100000" max="{{ $balance }}" required>
                                            <span class="input-group-text"
                                                style="border-top-left-radius: 0; border-bottom-left-radius: 0">.00</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                    </div>
                    <div class="card-action">
                        <div class="row">
                            <div class="col-md-12 text-right">
                                <a href="{{ route('mentor.withdraw') }}" class="btn btn-default btn-outline-dark">Batal</a>
                                <button class="btn btn-primary ml-3" id="createButton" type="submit">Kirim</button>
                            </div>
                        </div>
                    </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script>
        $.validator.addMethod("nowhitespace", function(value, element) {
            return this.optional(element) || /^\S+$/i.test(value);
        }, "Username tidak boleh ada spasi");
        $("#withdrawForm").validate({
            rules: {
                accountNumber: {
                    required: true,
                    number: true,
                    maxlength: 30,
                },
                accountName: {
                    required: true,
                    maxlength: 50,
                },
                bank: {
                    required: true,
                },
                amount: {
                    required: true,
                    number: true,
                    min: 100000,
                    max: {{ $balance }},
                },
            },
            messages: {
                accountNumber: {
                    required: '<i class="fas fa-exclamation-circle mr-1 text-sm icon-error"></i>Nomer rekening bank tidak boleh kosong',
                    number: '<i class="fas fa-exclamation-circle mr-1 text-sm icon-error"></i>Nomer rekening bank harus berupa angka',
                    maxlength: '<i class="fas fa-exclamation-circle mr-1 text-sm icon-error"></i>Nomer rekening bank maksimal 30 karakter',
                },
                accountName: {
                    required: '<i class="fas fa-exclamation-circle mr-1 text-sm icon-error"></i>Nama pemilik bank tidak boleh kosong',
                    maxlength: '<i class="fas fa-exclamation-circle mr-1 text-sm icon-error"></i>Nama pemilik bank maksimal 50 karakter',
                },
                bank: {
                    required: '<i class="fas fa-exclamation-circle mr-1 text-sm icon-error"></i>Nama bank tidak boleh kosong',
                },
                amount: {
                    required: '<i class="fas fa-exclamation-circle mr-1 text-sm icon-error"></i>Jumlah withdraw tidak boleh kosong',
                    number: '<i class="fas fa-exclamation-circle mr-1 text-sm icon-error"></i>Jumlah withdraw harus berupa angka',
                    min: '<i class="fas fa-exclamation-circle mr-1 text-sm icon-error"></i>Jumlah withdraw minimal Rp. 100.000',
                    max: '<i class="fas fa-exclamation-circle mr-1 text-sm icon-error"></i>Jumlah withdraw melebihi saldo',
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
                $('#createButton').html('<i class="fas fa-circle-notch text-lg spinners-2"></i>');
                $('#createButton').prop('disabled', true);
                $.ajax({
                    url: "{{ route('mentor.withdraw.store') }}",
                    type: "POST",
                    data: {
                        account_number: $('#accountNumber').val(),
                        account_name: $('#accountName').val(),
                        bank: $('#bank').val(),
                        amount: $('#amount').val(),
                        _token: "{{ csrf_token() }}"
                    },
                    success: function(response) {
                        $('#createButton').html('Kirim');
                        $('#createButton').prop('disabled', false);
                        $.notify({
                            icon: 'flaticon-alarm-1',
                            title: 'UMKMPlus mentor',
                            message: response.meta.message,
                        }, {
                            type: 'secondary',
                            placement: {
                                from: "top",
                                align: "right"
                            },
                            time: 2000,
                        });
                        window.location.href = response.data.redirect
                    },
                    error: function(xhr, status, error) {
                        $('#createButton').html('Kirim');
                        $('#createButton').prop('disabled', false);
                        if (xhr.responseJSON)
                            Swal.fire({
                                icon: 'error',
                                title: 'PERMOHONAN WITHDRAW GAGAL!',
                                text: xhr.responseJSON.meta.message + " Error: " + xhr
                                    .responseJSON.data.error,
                            })
                        else
                            Swal.fire({
                                icon: 'error',
                                title: 'Permohonan Withdraw GAGAL!',
                                text: "Terjadi kegagalan, silahkan coba beberapa saat lagi! Error: " +
                                    error,
                            })
                        return false;
                    }
                });
            }
        });
    </script>
@endsection
