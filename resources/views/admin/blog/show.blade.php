@extends('admin.layouts.app')

@section('content')
    <div class="container">
        <div class="page-inner">
            {{-- header --}}
            <div class="page-header">
                <h4 class="page-title">Blog</h4>
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
                        <a href="{{ route('admin.course') }}">
                            Data Blog
                        </a>
                    </li>
                    <li class="separator">
                        <i class="flaticon-right-arrow"></i>
                    </li>
                    <li class="nav-item">
                        <a href="#">
                            Detail Blog
                        </a>
                    </li>
                </ul>
            </div>

            {{-- main content --}}
            {{-- Detail Course --}}
            <div class="row">
                <div class="col-md-12">
                {{-- blog data --}}
                    <div class="card">
                        <div class="card-header">
                            <div class="card-head-row">
                                <div class="card-title">Data Blog</div>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive table-hover table-sales">
                                <table class="table">
                                    <tbody>
                                        {{-- buatkan tag img untuk thumbnail --}}
                                        <tr>
                                            <td>Judul</td>
                                            <td class="text-right">
                                                :
                                            </td>
                                            <td>{{ $blog->title }}</td>
                                        </tr>
                                        <tr>
                                            <td>Nama Penulis</td>
                                            <td class="text-right">
                                                :
                                            </td>
                                            <td>{{ $blog->user->customer->name }}</td>
                                        </tr>
                                        <tr>
                                            <td>Headline</td>
                                            <td class="text-right">
                                                :
                                            </td>
                                            <td>{{ $blog->headline }}</td>
                                        </tr>
                                        <tr>
                                            <td>Konten</td>
                                            <td class="text-right">
                                                :
                                            </td>
                                            <td>{!! $blog->content !!}</td>
                                        </tr>
                                        <tr>
                                            <td>Status</td>
                                            <td class="text-right">
                                                :
                                            </td>
                                            <td><span
                                                    class="badge @switch($blog->status)
                                                                    @case(1)
                                                                        badge-active
                                                                        @break
                                                                    @case(0)
                                                                        badge-nonactive
                                                                        @break
                                                                @endswitch"><i
                                                        class="fas fa-circle" style="font-size: 10px"></i>
                                                    {{ $blog->status == 1 ? 'Aktif' : 'Nonaktif' }}
                                                </span></td>
                                        </tr>
                                        <tr>
                                            <td>Thumbnail</td>
                                            <td class="text-right">:</td>
                                            <td>
                                                @if ($blog->thumbnail)
                                                    <img src="{{ asset($blog->thumbnail) }}" alt="Thumbnail" style="height: 200px; width: 300px;">
                                                @else
                                                    <img src="{{ asset('assets/img/dummy/testimoni-1.png') }}" alt="Thumbnail" style="height: 200px; width: 300px;">
                                                @endif
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
            </div>
        </div>
        </div>
    </div>
@endsection

@section('script')
@endsection
