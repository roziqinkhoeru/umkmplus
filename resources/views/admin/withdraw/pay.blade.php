@extends('admin.layouts.app')

@section('content')
    <div class="container">
        <div class="page-inner">
            {{-- header --}}
            <div class="page-header">
                <h4 class="page-title">Bayar Permohonan Withdraw</h4>
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
                        <a href="/admin/withdraw">Data Withdraw</a>
                    </li>
                    <li class="separator">
                        <i class="flaticon-right-arrow"></i>
                    </li>
                    <li class="nav-item">
                        <a href="#">Form Bayar Permohonan Withdraw</a>
                    </li>
                </ul>
            </div>

            {{-- main content --}}
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <div class="card-title">Form Bayar Permohonan Withdraw</div>
                            <div class="card-category">
                                Form ini digunakan untuk menambah data bayar permohonan withdraw
                            </div>
                        </div>
                        <form id="withdrawForm" action="{{ url('/admin/withdraw/' . $withdraw->id) }}" method="POST"
                            enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <div class="card-body">
                                {{-- accountNumber --}}
                                <div class="form-group form-show-validation row">
                                    <label for="accountNumber" class="col-lg-3 col-md-3 col-sm-4 mt-sm-2 text-right">Nomer
                                        Rekening Bank</label>
                                    <div class="col-lg-4 col-md-9 col-sm-8">
                                        <div class="input-group">
                                            <input disabled type="text" class="form-control"
                                                value="{{ $withdraw->account_number }}" aria-label="accountNumber"
                                                aria-describedby="accountNumber-addon" id="accountNumber"
                                                name="accountNumber">
                                        </div>
                                    </div>
                                </div>
                                {{-- accountName --}}
                                <div class="form-group form-show-validation row">
                                    <label for="accountName" class="col-lg-3 col-md-3 col-sm-4 mt-sm-2 text-right">Nama
                                        Pemilik Bank</label>
                                    <div class="col-lg-4 col-md-9 col-sm-8">
                                        <div class="input-group">
                                            <input disabled type="text" class="form-control"
                                                value="{{ $withdraw->account_name }}" aria-label="accountName"
                                                aria-describedby="accountName-addon" id="accountName" name="accountName">
                                        </div>
                                    </div>
                                </div>
                                {{-- bank --}}
                                <div class="form-group form-show-validation row">
                                    <label for="bank" class="col-lg-3 col-md-3 col-sm-4 mt-sm-2 text-right">
                                        Bank</label>
                                    <div class="col-lg-4 col-md-9 col-sm-8">
                                        <input disabled type="text" class="form-control" value="{{ $withdraw->bank }}"
                                            aria-label="bank" aria-describedby="bank-addon" id="bank" name="bank">
                                    </div>
                                </div>
                                {{-- amount --}}
                                <div class="form-group form-show-validation row">
                                    <label for="amount" class="col-lg-3 col-md-3 col-sm-4 mt-sm-2 text-right"> Jumlah
                                        Withdraw</label>
                                    <div class="col-lg-4 col-md-9 col-sm-8">
                                        <input disabled type="text" name="amount" class="form-control" id="amount"
                                            value="{{ 'Rp ' . number_format($withdraw->amount, 0, ',', '.') }}">
                                    </div>
                                </div>
                                {{-- nameMentor --}}
                                <div class="form-group form-show-validation row">
                                    <label for="nameMentor" class="col-lg-3 col-md-3 col-sm-4 mt-sm-2 text-right"> Nama
                                        Mentor</label>
                                    <div class="col-lg-4 col-md-9 col-sm-8">
                                        <input disabled type="text" name="nameMentor" class="form-control"
                                            id="nameMentor" value="{{ $withdraw->customer->name }}">
                                    </div>
                                </div>
                                {{-- balance --}}
                                <div class="form-group form-show-validation row">
                                    <label for="balance" class="col-lg-3 col-md-3 col-sm-4 mt-sm-2 text-right"> Saldo
                                        Mentor</label>
                                    <div class="col-lg-4 col-md-9 col-sm-8">
                                        <input disabled type="text" name="balance" class="form-control" id="balance"
                                            value="{{ 'Rp ' . number_format($withdraw->customer->dataMentor->balance, 0, ',', '.') }}">
                                    </div>
                                </div>
                                {{-- paymentProof --}}
                                <div class="form-group form-show-validation row">
                                    <label for="paymentProof" class="col-lg-3 col-md-3 col-sm-4 mt-sm-2 text-right">Bukti
                                        Pembayaran <span class="required-label">*</span></label>
                                    <div class="col-lg-4 col-md-9 col-sm-8">
                                        <div class="input-file input-file-image">
                                            <img class="img-upload-preview" width="240" src="http://placehold.it/240x240"
                                                alt="blog-payment-proof-preview" id="imagePreview">
                                            <input type="file" class="form-control form-control-file"
                                                id="paymentProof" name="paymentProof" accept="image/*" required
                                                onchange="previewImage(event)">
                                            <label for="paymentProof" class="label-input-file btn btn-black btn-round">
                                                <span class="btn-label">
                                                    <i class="fa fa-file-image"></i>
                                                </span>
                                                Upload Bukti Pembayaran
                                            </label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card-action">
                                <div class="row">
                                    <div class="col-md-12 text-right">
                                        <a href="/admin/withdraw" class="btn btn-default btn-outline-dark">Batal</a>
                                        <button class="btn btn-primary ml-3" id="updateButton"
                                            type="submit">Kirim</button>
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
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.5/jquery.validate.min.js"
        integrity="sha512-rstIgDs0xPgmG6RX1Aba4KV5cWJbAMcvRCVmglpam9SoHZiUCyQVDdH2LPlxoHtrv17XWblE/V/PP+Tr04hbtA=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.5/additional-methods.min.js"
        integrity="sha512-6S5LYNn3ZJCIm0f9L6BCerqFlQ4f5MwNKq+EthDXabtaJvg3TuFLhpno9pcm+5Ynm6jdA9xfpQoMz2fcjVMk9g=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script>
        $.validator.addMethod("nowhitespace", function(value, element) {
            return this.optional(element) || /^\S+$/i.test(value);
        }, "Username tidak boleh ada spasi");
        // Menambahkan aturan validasi kustom untuk ukuran maksimum file
        $.validator.addMethod('maxfilesize', function(value, element, param) {
            var maxSize = param;

            if (element.files.length > 0) {
                var fileSize = element.files[0].size; // Ukuran file dalam byte
                return fileSize <= maxSize;
            }

            return true;
        }, '');

        window.onload = function() {
            var imagePreview = document.getElementById('imagePreview');
            var storedImage = localStorage.getItem('imageWDPreview');

            if (storedImage) {
                imagePreview.src = storedImage;
            }
        };


        function previewImage(event) {
            var imagePreview = document.getElementById('imagePreview');
            var file = event.target.files[0];
            var reader = new FileReader();

            reader.onload = function(e) {
                imagePreview.src = e.target.result;
                localStorage.setItem('imageWDPreview', e.target.result);
            };

            reader.readAsDataURL(file);
        }


        $("#withdrawForm").validate({
            rules: {
                paymentProof: {
                    required: true,
                    maxfilesize: 2 * 1024 * 1024, // 2MB (dalam byte)
                    extension: "jpg|jpeg|png",
                },
            },
            messages: {
                paymentProof: {
                    required: '<i class="fas fa-exclamation-circle mr-1 text-sm icon-error"></i>Thumbnail tidak boleh kosong',
                    maxfilesize: '<i class="fas fa-exclamation-circle mr-1 text-sm icon-error"></i>Ukuran file maksimal 2MB',
                    extension: '<i class="fas fa-exclamation-circle mr-1 text-sm icon-error"></i>Format file harus berupa .jpg, .jpeg, atau .png',
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
                Swal.fire({
                    title: 'Apakah anda yakin?',
                    text: "Anda akan mengirimkan permintaan penarikan saldo mentor ini!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#206bc4',
                    cancelButtonColor: '#858796',
                    confirmButtonText: 'Ya, Kirim!',
                    cancelButtonText: 'Batal',
                }).then((result) => {
                    if (result.isConfirmed) {
                        localStorage.removeItem('imageWDPreview');
                        form.submit();
                    } else {
                        $('#updateButton').html('Kirim');
                        $('#updateButton').prop('disabled', false);
                    }
                })
            }
        });
    </script>
@endsection
