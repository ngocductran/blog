@extends('admin.layout.index')
@section('title','Chỉnh sửa bài viết')
@section('css')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-tagsinput/0.8.0/bootstrap-tagsinput.css" integrity="sha512-xmGTNt20S0t62wHLmQec2DauG9T+owP9e6VU8GigI0anN7OXLip9i7IwEhelasml2osdxX71XcYm6BQunTQeQg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <style>
        .bootstrap-tagsinput .tag{
            /* color: #000; */
        }
        .label-info{
            background: #03dcfd;
            padding: 3px;
            border-radius: 3px;
        }
    </style>
@endsection
@section('content')
<!-- Page Content -->
<div class="container">
    <form class="text-left" method="POST" enctype="multipart/form-data" action="{{route('admin.edit.post.post', $post->id)}}">
        {{ csrf_field() }}
        <div class="form-group row">
          <label class="col-sm-2 col-form-label">Tiêu đề</label>
          <div class="col-sm-10">
            <input type="text" class="form-control" id="title" name="title" value="{{$post->title}}">
          </div>
        </div>
        <div class="form-group row">
          <label class="col-sm-2 col-form-label">Đường dẫn</label>
          <div class="col-sm-10">
            <input type="text" class="form-control" id="slug" name="slug" value="{{$post->slug}}">
          </div>
        </div>
        <div class="form-group row">
            <label class="col-sm-2 col-form-label">Tóm tắt</label>
            <div class="col-sm-10">
              <input type="text" class="form-control" name="description" value="{{$post->description}}">
            </div>
        </div>

        <div class="form-group row">
            <label class="col-sm-2 col-form-label">Nội dung</label>
            <div class="col-sm-10">
              <textarea name="content" id="demo" class="form-control ckeditor">{{$post->content}}</textarea>
            </div>
        </div>

        <div class="form-group row">
            <label class="col-sm-2 col-form-label">Chuyên mục</label>
            <div class="col-sm-10">
                <select name="category" class="form-control">
                    <option value="{{$post->cate_id}}">Chọn chuyên mục</option>
                    @foreach($cate as $val))
                        <option value="{{ $val->id }}">{{ $val->category }}</option>
                    @endforeach
                </select>
            </div>
        </div>

        <div class="form-group row">
            <label class="col-sm-2 col-form-label">Tags</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" name="tags" value="{{$post->tags}}" data-role="tagsinput">
            </div>
        </div>

        <div class="form-group row">
            <label class="col-sm-2 col-form-label">Trạng thái</label>
            <div class="col-sm-10">
                <select name="status" class="form-control">
                    <option value="0" {{old('status') == 0?'selected':false}}>Ẩn</option>
                    <option value="1" {{old('status') == 1?'selected':false}}>Hoạt Động</option>
                </select>
            </div>
        </div>

        <div class="form-group row">
            <label class="col-sm-2 col-form-label">Hình ảnh</label>
            <div class="col-sm-5">
                <input type="file" class="form-control-file" name="avatar" oninput="pic.src=window.URL.createObjectURL(this.files[0])">
            </div>
            <div class="col-sm-3 text-center">
                <img class="img-fluid" id="pic" src="{{asset($post->avatar)}}"/>
            </div>
        </div>

        <div class="form-group row">
          <div class="col-sm-12">
            <div class="form-check text-center">
              <input class="form-check-input" type="checkbox" id="gridCheck1" onchange="document.getElementById('cli').disabled = !this.checked;">
              <label class="form-check-label" for="gridCheck1">
                Confirm
              </label>
            </div>
          </div>
        </div>

        <div class="form-group row">
          <div class="col-sm-12 text-center">
            <button id="cli" type="submit" class="btn btn-primary" disabled>Submit</button>
          </div>
        </div>
    </form>
</div>

@endsection
@section('script')
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-tagsinput/0.8.0/bootstrap-tagsinput.min.js" integrity="sha512-9UR1ynHntZdqHnwXKTaOm1s6V9fExqejKvg5XMawEMToW4sSw+3jtLrYfZPijvnwnnE8Uol1O9BcAskoxgec+g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script src="https://cdn.ckeditor.com/4.16.0/standard/ckeditor.js"></script>
<script src="{{url('assets/admin/dashboard/js/slug.js')}}"></script>
<script>
    CKEDITOR.replace( 'demo' );

    $(document).ready(function() {
        $('#title').keyup(function(event) {
            var title = $('#title').val();
            var slug = ChangeToSlug(title);
            $('#slug').val(slug);
        });
    });
</script>
<script>
    $(document).ready(function(){
        @if(Session::has('errors'))
            @foreach ($errors->all() as $error)
                toastr.options =
                {
                    "closeButton" : true,
                    "progressBar" : true
                }
                    toastr.error("{{ $error }} ");
            @endforeach
        @endif
    });
</script>
@endsection
