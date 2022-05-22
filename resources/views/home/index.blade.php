<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@yield('title')</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <link rel="stylesheet" href="{{url('assets/home/css/style.css')}}">
</head>
<body>
<header>
    <nav class="navbar navbar-expand-lg navbar-dark bg-primary">
        <div class="container-fluid py-2">
            <a class="navbar-brand font-weight-bold" href="#" style="font-size: 2rem">
                NDT Blog
            </a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav mr-auto">
                    <li class="nav-item active">
                        <a class="nav-link" href="#">Trang chủ <span class="sr-only">(current)</span></a>
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
            @foreach ($categorys as $category)
                <li class="mx-2"><a href="{{$category->slug}}">{{$category->category}}</a></li>
            @endforeach
        </ul>
    </div>
</header>

<main>
    <div class="mx-sline row">
        <div class="col-md-12">
            <div class="py-3 text-primary pl-3 font-weight-bold" style="font-size: 1.2em">
                <span><i class="fas fa-newspaper"></i> Bài viết mới</span>
            </div>
        </div>
        <div class="col-lg-8 ol-md-12 col-sm-12 mb-slider" id="slider">
            <div id="carouselExampleCaptions" class="carousel slide" data-ride="carousel">
                <ol class="carousel-indicators">
                    <li data-target="#carouselExampleCaptions" data-slide-to="0" class="active"></li>
                    <li data-target="#carouselExampleCaptions" data-slide-to="1"></li>
                    <li data-target="#carouselExampleCaptions" data-slide-to="2"></li>
                    <li data-target="#carouselExampleCaptions" data-slide-to="3"></li>
                </ol>
                <div class="carousel-inner">
                    @foreach ($posts_sline as $post)
                    <div class="carousel-item" id="sline-one">
                        <img src="{{asset($post->avatar)}}" class="img-fluid w-100" alt="{{$post->title}}">
                        <div class="carousel-caption d-md-block">
                            <h5>{{$post->title}}</h5>
                            {{-- <p>{{$post->description}}</p> --}}
                        </div>
                    </div>
                    @endforeach
                </div>
                <button class="carousel-control-prev" type="button" data-target="#carouselExampleCaptions" data-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="sr-only">Previous</span>
                </button>
                <button class="carousel-control-next" type="button" data-target="#carouselExampleCaptions" data-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="sr-only">Next</span>
                </button>
            </div>
        </div>
        <div class="col-lg-4 col-md-12 d-flex justify-content-between flex-column col-sm-12">
            @foreach ($posts as $post)
            <div class="row mb-3">
                <div class="col-md-5 d-flex align-items-center">
                    <a href="{{route('post.show',['category'=>$post->category->slug, 'post'=>$post->slug])}}">
                        <img class="img-fluid img-posts" src="{{asset($post->avatar)}}" alt="">
                    </a>
                </div>
                <div class="col-md-7">
                    <a class="text-decoration-none text-dark" href="{{route('post.show',['category'=>$post->category->slug, 'post'=>$post->slug])}}">
                        <span class="">{{$post->title}}</span><br>
                        <small class="create-post text-muted">{{$post->created_at}}</small>
                    </a>
                </div>
            </div>
            @endforeach
        </div>
    </div>

    <div class="mx-sline row">
        <div class="col-md-12 mt-5">
            <div class="py-3 text-primary pl-3 font-weight-bold" style="font-size: 1.2em">
                <span><i class="fas fa-newspaper"></i> Bài viết mới</span>
            </div>
        </div>

        @foreach ($posts_paginate as $post)
            <div class="col-md-3 col-sm-6 col-xs-12 mb-4">
                <a class="text-decoration-none" href="{{route('post.show',['category'=>$post->category->slug, 'post'=>$post->slug])}}">
                    <img class="img-fluid img-post-paginate" src="{{asset($post->avatar)}}" alt="">
                    <span class="font-weight-bold">{{$post->title}}</span><br>
                </a>
                <small class="text-muted">{{$post->created_at}}</small>
                <span class="description-post-paginate">{{$post->description}}</span>
            </div>
        @endforeach
        <div class="col-md-12 d-flex justify-content-end">
            {{ $posts_paginate->links() }}
        </div>
    </div>

    <div class="mx-sline text-center mt-5 bg-white" style="border-top: 10px solid brown;">
        <div class="row">
            <div class="col-md-3">
                <a href="#"><button type="button" class="btn btn-primary"><i class="fas fa-book-medical"></i>&nbsp;Thể thao</button></a>
            </div>
            <div class="col-md-3">
                <a href="#"><button type="button" class="btn btn-primary"><i class="fas fa-calendar-alt"></i>&nbsp;Văn hóa</button></a>
            </div>
            <div class="col-md-3">
                <a href="#"><button type="button" class="btn btn-primary"><i class="fas fa-clock"></i>&nbsp;Giải trí</button></a>
            </div>
            <div class="col-md-3">
                <a href="#"><button type="button" class="btn btn-primary"><i class="fas fa-praying-hands"></i>&nbsp;Âm nhạc</button></a>
            </div>
        </div>
    </div>

    <div class="mx-sline mt-5 bg-white row">
        <div class="col-md-12 mt-5">
            <div class="py-3 text-primary pl-3 font-weight-bold" style="font-size: 1.2em">
                <span><i class="fas fa-newspaper"></i> Bài viết mới</span>
            </div>
        </div>
        <div class="col-md-8 col-sm-12">
            <div class="row">
                <div class="col-md-5"><img class="img-fluid w-100" src="https://i1-thethao.vnecdn.net/2022/04/23/Rodri-6708-1650730728.jpg?w=1020&h=0&q=100&dpr=1&fit=crop&s=nhOtv3MsYUMGPrwgoS2dXw" alt=""></div>
                <div class="col-md-7 d-flex flex-column">
                    <h5 class="font-weight-bold">Man City chạy đà hoàn hảo trước đại chiến Real</h5>
                    <small>26/07/2021</small><br>
                    <span style="font-size: 0.8rem;">Thắng Watford 5-1 ở vòng 34 ngày 23/4, Man City vẫn dẫn đầu Ngoại hạng Anh, đồng thời dưỡng sức cho trận bán kết lượt đi Champions League giữa tuần tới.</span>
                </div>
            </div><hr>
            <div class="row">
                <div class="col-md-5"><img class="img-fluid w-100" src="https://i1-thethao.vnecdn.net/2022/04/23/Rodri-6708-1650730728.jpg?w=1020&h=0&q=100&dpr=1&fit=crop&s=nhOtv3MsYUMGPrwgoS2dXw" alt=""></div>
                <div class="col-md-7 d-flex flex-column">
                    <h5 class="font-weight-bold">Man City chạy đà hoàn hảo trước đại chiến Real</h5>
                    <small>26/07/2021</small><br>
                    <span style="font-size: 0.8rem;">Thắng Watford 5-1 ở vòng 34 ngày 23/4, Man City vẫn dẫn đầu Ngoại hạng Anh, đồng thời dưỡng sức cho trận bán kết lượt đi Champions League giữa tuần tới.</span>
                </div>
            </div><hr>
            <div class="row">
                <div class="col-md-5"><img class="img-fluid w-100" src="https://i1-thethao.vnecdn.net/2022/04/23/Rodri-6708-1650730728.jpg?w=1020&h=0&q=100&dpr=1&fit=crop&s=nhOtv3MsYUMGPrwgoS2dXw" alt=""></div>
                <div class="col-md-7 d-flex flex-column">
                    <h5 class="font-weight-bold">Man City chạy đà hoàn hảo trước đại chiến Real</h5>
                    <small>26/07/2021</small><br>
                    <span style="font-size: 0.8rem;">Thắng Watford 5-1 ở vòng 34 ngày 23/4, Man City vẫn dẫn đầu Ngoại hạng Anh, đồng thời dưỡng sức cho trận bán kết lượt đi Champions League giữa tuần tới.</span>
                </div>
            </div><hr>
            <div class="row">
                <div class="col-md-5"><img class="img-fluid w-100" src="https://i1-thethao.vnecdn.net/2022/04/23/Rodri-6708-1650730728.jpg?w=1020&h=0&q=100&dpr=1&fit=crop&s=nhOtv3MsYUMGPrwgoS2dXw" alt=""></div>
                <div class="col-md-7 d-flex flex-column">
                    <h5 class="font-weight-bold">Man City chạy đà hoàn hảo trước đại chiến Real</h5>
                    <small>26/07/2021</small><br>
                    <span style="font-size: 0.8rem;">Thắng Watford 5-1 ở vòng 34 ngày 23/4, Man City vẫn dẫn đầu Ngoại hạng Anh, đồng thời dưỡng sức cho trận bán kết lượt đi Champions League giữa tuần tới.</span>
                </div>
            </div><hr>
        </div>
        <div class="col-md-4 col-sm-12">
            <div class="bg-primary text-center py-3 text-white mb-3">
                Thể thao
            </div>
            <div class="row">
                <div class="col-md-4 col-5">
                    <img class="img-fluid" src="https://i1-thethao.vnecdn.net/2022/04/23/Rodri-6708-1650730728.jpg?w=1020&h=0&q=100&dpr=1&fit=crop&s=nhOtv3MsYUMGPrwgoS2dXw" alt="">
                </div>
                <div class="col-md-8 col-7" style="font-size: 15px; font-weight: bold;">
                    Man City chạy đà hoàn hảo trước đại chiến Real <br>
                    <small>26/07/2021</small>
                </div>
            </div><hr>
            <div class="row">
                <div class="col-md-4 col-5">
                    <img class="img-fluid" src="https://i1-thethao.vnecdn.net/2022/04/23/Rodri-6708-1650730728.jpg?w=1020&h=0&q=100&dpr=1&fit=crop&s=nhOtv3MsYUMGPrwgoS2dXw" alt="">
                </div>
                <div class="col-md-8 col-7" style="font-size: 15px; font-weight: bold;">
                    Man City chạy đà hoàn hảo trước đại chiến Real <br>
                    <small>26/07/2021</small>
                </div>
            </div><hr><div class="row">
                <div class="col-md-4 col-5">
                    <img class="img-fluid" src="https://i1-thethao.vnecdn.net/2022/04/23/Rodri-6708-1650730728.jpg?w=1020&h=0&q=100&dpr=1&fit=crop&s=nhOtv3MsYUMGPrwgoS2dXw" alt="">
                </div>
                <div class="col-md-8 col-7" style="font-size: 15px; font-weight: bold;">
                    Man City chạy đà hoàn hảo trước đại chiến Real <br>
                    <small>26/07/2021</small>
                </div>
            </div><hr><div class="row">
                <div class="col-md-4 col-5">
                    <img class="img-fluid" src="https://i1-thethao.vnecdn.net/2022/04/23/Rodri-6708-1650730728.jpg?w=1020&h=0&q=100&dpr=1&fit=crop&s=nhOtv3MsYUMGPrwgoS2dXw" alt="">
                </div>
                <div class="col-md-8 col-7" style="font-size: 15px; font-weight: bold;">
                    Man City chạy đà hoàn hảo trước đại chiến Real <br>
                    <small>26/07/2021</small>
                </div>
            </div><hr><div class="row">
                <div class="col-md-12">
                    <div class="embed-responsive embed-responsive-16by9">
                    <iframe class="embed-responsive-item" src="https://www.youtube.com/embed/c7ecVUOOgSg" allowfullscreen></iframe>
                  </div>
                </div>
            </div><hr>
        </div>
    </div>
</main>

<!-- /.container -->
<footer class="mt-5">
<div class="footer-dark">
    <footer>
        <div class="container">
            <div class="row">
                <div class="col-sm-6 col-md-3 item">
                    <h3>Services</h3>
                    <ul>
                        <li><a href="#">Web design</a></li>
                        <li><a href="#">Development</a></li>
                        <li><a href="#">Hosting</a></li>
                    </ul>
                </div>
                <div class="col-sm-6 col-md-3 item">
                    <h3>About</h3>
                    <ul>
                        <li><a href="#">Company</a></li>
                        <li><a href="#">Team</a></li>
                        <li><a href="#">Careers</a></li>
                    </ul>
                </div>
                <div class="col-md-6 item text">
                    <h3>Company Name</h3>
                    <p>Praesent sed lobortis mi. Suspendisse vel placerat ligula. Vivamus ac sem lacus. Ut vehicula rhoncus elementum. Etiam quis tristique lectus. Aliquam in arcu eget velit pulvinar dictum vel in justo.</p>
                </div>
                <div class="col item social">
                	<a href="#"><i class="fab fa-facebook"></i></a>
                	<a href="#"><i class="fab fa-twitter"></i></a>
                	<a href="#"><i class="fab fa-instagram"></i></a>
                	<a href="#"><i class="fab fa-youtube"></i></a>
                </div>
            </div>
            <p class="copyright">Company Name © 2018</p>
        </div>
    </footer>
</div>
</footer>
</body>
</html>

<script src="https://cdn.jsdelivr.net/npm/jquery@3.6.0/dist/jquery.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.bundle.min.js"></script>
<script src="{{url('assets/home/js/app.js')}}"></script>
