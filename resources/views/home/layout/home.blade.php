@extends('home.index')

@section('title', "Trang chủ")

@section('content')
<main class="container">
    <div class="row">
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

    <div class="row">
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

    <div class="text-center mt-5 bg-white" style="border-top: 10px solid brown;">
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

    <div class="mt-5 bg-white row">
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
                    <iframe class="embed-responsive-item" src="https://www.youtube.com/embed/KU0w-xP-J_s" allowfullscreen></iframe>
                  </div>
                </div>
            </div><hr>
        </div>
    </div>
</main>

@endsection