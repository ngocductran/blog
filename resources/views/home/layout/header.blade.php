<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/png" href="https://laravel.com/img/favicon/favicon-16x16.png"/>

    <title>@yield('title')</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <link rel="stylesheet" href="{{url('assets/home/css/style.css')}}">
</head>
<body>
<header>
    <nav class="navbar navbar-expand-lg navbar-dark bg-primary">
        <div class="container-fluid py-2">
            <a class="navbar-brand font-weight-bold" href="/" style="font-size: 2rem">
                NDT Blog
            </a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav mr-auto">
                    <li class="nav-item active">
                        <a class="nav-link" href="/admin/index">Trang chủ <span class="sr-only">(current)</span></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Giới thiệu</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Liên hệ</a>
                    </li>
                </ul>
                <form class="form-inline my-2 my-lg-0">
                    <span class="fa fa-search form-control-icon"></span>
                    <input class="form-control mr-sm-2 form-search w-100" type="search" placeholder="Tìm kiếm">
                </form>

                <div class="text-end">
                    @if (Auth::check())
                        <span class="navbar-text text-white">
                            Xin chào: {{Auth::user()->fullname;}}
                        </span>
                    @endif
                    @if(!Auth::check())
                    <a href="{{route('login')}}">
                        <span class="navbar-text text-white">
                            Đăng nhập
                        </span>
                    </a>
                    <span class="text-white"> / </span>
                    <a href="{{route('register')}}">
                        <span class="navbar-text text-white">
                            Đăng ký
                        </span>
                    </a>
                    @endif
                </div>
            </div>
        </div>
    </nav>
    <div>
        <ul class="d-flex justify-content-center flex-wrap bg-light py-2 list-unstyled text-uppercase">
            {{-- @foreach ($categorys as $category)
                <li class="mx-2"><a href="{{$category->slug}}">{{$category->category}}</a></li>
            @endforeach --}}
        </ul>
    </div>
</header>
