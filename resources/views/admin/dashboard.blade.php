@extends('admin.layouts.app')

@section('content')
    <div class="container"></div>
@endsection

@section('script')
    <script>
        //Notify
        $.notify({
            icon: 'flaticon-alarm-1',
            title: 'UMKMPlus Admin',
            message: 'Selamat Datang di Dashboard UMKMPlus',
        }, {
            type: 'secondary',
            placement: {
                from: "bottom",
                align: "right"
            },
            time: 2000,
        });
    </script>
@endsection
