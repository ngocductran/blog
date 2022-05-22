@extends('home.layout.index')

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
            @foreach($errors->all() as $err)
                {{ $err }}<br>
            @endforeach
        </div>
    @endif

    <div class="mx-sline row">
        <div class="col-md-12">
            <div class="py-3 text-primary pl-3 font-weight-bold" style="font-size: 1.2em">
                <span><i class="fas fa-newspaper"></i> Bài viết mới</span>
            </div>
        </div>
        <div class="col-md-8 col-sm-12 post-detail mx-3 text-justify my-5">
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
            <div class="col-md-12">
                @php
                    $tags = $post->tags;
                    $tags = explode(",", $tags);
                @endphp

                Tags:
                @foreach ($tags as $tag)
                    <a href="">{{$tag}}, </a>
                @endforeach
            </div>

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
            <span class="h3 border-bottom mb-3">{{$post->comments->count()}} Comments</span>
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


    fetchstudent();

    function fetchstudent() {
        $.ajax({
            type: "GET",
            url: "/fetch-students",
            dataType: "json",
            success: function (response) {
                console.log(response);
                $('tbody').html("");
                $.each(response.students, function (key, item) {
                    $('tbody').append('<tr>\
                        <td>' + item.id + '</td>\
                        <td>' + item.name + '</td>\
                        <td>' + item.course + '</td>\
                        <td>' + item.email + '</td>\
                        <td>' + item.phone + '</td>\
                        <td><button type="button" value="' + item.id + '" class="btn btn-primary editbtn btn-sm">Edit</button></td>\
                        <td><button type="button" value="' + item.id + '" class="btn btn-danger deletebtn btn-sm">Delete</button></td>\
                    \</tr>');
                });
            }
        });
    }

    $(document).on('click', '.add_student', function (e) {
        e.preventDefault();

        $(this).text('Sending..');

        var data = {
            'name': $('.name').val(),
            'course': $('.course').val(),
            'email': $('.email').val(),
            'phone': $('.phone').val(),
        }

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $.ajax({
            type: "POST",
            url: "/students",
            data: data,
            dataType: "json",
            success: function (response) {
                // console.log(response);
                if (response.status == 400) {
                    $('#save_msgList').html("");
                    $('#save_msgList').addClass('alert alert-danger');
                    $.each(response.errors, function (key, err_value) {
                        $('#save_msgList').append('<li>' + err_value + '</li>');
                    });
                    $('.add_student').text('Save');
                } else {
                    $('#save_msgList').html("");
                    $('#success_message').addClass('alert alert-success');
                    $('#success_message').text(response.message);
                    $('#AddStudentModal').find('input').val('');
                    $('.add_student').text('Save');
                    $('#AddStudentModal').modal('hide');
                    fetchstudent();
                }
            }
        });

    });
});
</script>
@endsection
