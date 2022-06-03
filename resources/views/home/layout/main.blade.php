@extends('home.index')

@section('title', $post->title)

@section('content')
<main>
    @if(session('message'))
        <div class="alert alert-success">
            {{ session('message') }}
        </div>
    @endif

    @if(session()->has('errors'))
        <div class="alert alert-danger">
            @foreach($errors->all() as $error)
                {{ $error }}
            @endforeach
        </div>
    @endif
<div class="container">
    <div class="row my-5">
        <div class="col-md-8 col-sm-12 post-detail text-justify">
            <h5 class="font-weight-bold post-detail-title mb-5">{{$post->title}}</h5>
            <div class="d-flex justify-content-between mb-4">
                <div class="font-weight-bold">
                    <a href="{{$post->category->slug}}">{{$post->category->category}}</a>
                </div>
                <small> {{$post->created_at}} </small>
            </div>
            <div class="post-detail-content">
                {!!$post->content!!}
            </div>
            <div class="d-flex justify-content-end mt-5">
                <div class="font-weight-bold">
                    Tác giả: {{$post->user->fullname}}
                </div>
            </div>
            @if ($post->tags)
            <div class="col-md-12">
                @php
                    $tags = $post->tags;
                    $tags = explode(",", $tags);
                @endphp

                Tags:
                @foreach ($tags as $tag)
                    <a class="tag" href="#">{{$tag}}</a>
                @endforeach
            </div>
            @endif
            @if (Auth::check())
            <div class="col-md-12 mt-5" >
                <form method="POST" enctype="multipart/form-data" action="{{route('comment.create')}}">
                    {{ csrf_field() }}
                    <div class="mb-3">
                        <label for="comment-textarea" class="form-label">Bình luận bài viết</label>
                        <textarea class="form-control" id="comment-textarea" rows="3" name="comment"></textarea>
                        <input type="hidden" name="post_id" value="{{ $post->id }}" />
                        <div class="d-flex justify-content-end">
                            <button type="submit" class="btn-comment my-3 btn btn-primary">Post Comment</button>
                        </div>
                    </div>
                </form>
            </div>
            @else
            <div class="alert alert-warning my-5 text-center" role="alert">
                Bạn cần <a href="{{route('login')}}">đăng nhập</a> để bình luận bài viết !!!
            </div>
            @endif
            @if($post->comments->count() > 0)
                <span class="h3 border-bottom mb-3">{{$post->comments->count()}} Comments</span>
            @endif

            @foreach($post->comments as $comment)
                <div class="container mt-3">
                    <div class="row rounded border py-3">
                        <div class="col-md-2 text-center">
                            <img src="{{asset($comment->user->avatar)}}" class="img-avatar-circle"/>
                        </div>
                        <div class="col-md-10">
                            <div class="col-md-12 d-flex justify-content-between">
                                <a href="#"><strong>{{ $comment->user->fullname }}</strong></a>
                                <p class="text-secondary text-center">{{ Carbon\Carbon::parse($comment->created_at)->diffForHumans()}}</p>
                            </div>
                            <div class="col-md-12">
                                <span>{{ $comment->comment }}</span>
                            </div>
                            @if (Auth::check())
                            <div class="col-md-12 d-flex justify-content-end">
                                <a class="btn text-white btn-danger"> <i class="fa fa-heart"></i> Like</a>
                                <button id="{{ $comment->id }}" type="submit" class="btn btn-outline-primary ml-2 btn-reply"><i class="fa fa-reply"></i> Reply</button>
                            </div>                           
                            <div class="col-md-12">
                                <form action="{{route('comment.create')}}" method="post" id="form-reply-{{ $comment->id }}" style="display: none;" class="my-2">
                                    {{ csrf_field() }}
                                    <div class="form-group">
                                        <input type="hidden" value="{{ $comment->id }}" name="parent_id">
                                        <input type="hidden" value="{{ $post->id }}" name="post_id">
                                        <textarea class="form-control" rows="3" name="comment"></textarea>
                                        <div class="d-flex justify-content-end">
                                            <button type="submit" class="btn btn-primary btn-comment mt-2">Post Reply</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                            @endif
                            @foreach ($comment->replies as $reply)
                            <div class="col-md-12 border rounded mt-3 py-2">
                                <div class="row">
                                    <div class="col-md-2 text-center">
                                        <img src="{{asset($reply->user->avatar)}}" class="img-avatar-circle"/>
                                    </div>
                                    <div class="col-md-10">
                                        <a href="#"><strong>{{ $reply->user->fullname }}</strong></a>
                                        <span class="text-secondary float-right">{{ Carbon\Carbon::parse($reply->created_at)->diffForHumans()}}</span><br>
                                        <span>{{$reply->comment }}</span>
                                    </div>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        <div class="col-md-4">
            <div class="mb-3 text-center bg-primary p-3 h5 text-white rounded">Bài viết cùng chuyên mục</div>
            <div class="">
                @foreach ($post->category->posts as $cate)
                    @if($cate->id != $post->id)
                    <a href="{{ $cate->slug }}">
                        <div class="shadow-sm p-3 mb-1 bg-white rounded">
                            <i class="far fa-arrow-alt-circle-right text-danger"></i> {{ $cate->title }}
                        </div>
                    </a>
                    @endif                
                @endforeach                
            </div>
        </div>
    </div>
</div>
</main>
@endsection

@section('script')
<script type="text/javascript">
$(document).ready(function(){
    $(".btn-reply").click(function(){
        var id = this.id;
        var reply = "#form-reply-" + id;
        // alert(reply);
        $(reply).toggle();
    });
});
</script>
@endsection
