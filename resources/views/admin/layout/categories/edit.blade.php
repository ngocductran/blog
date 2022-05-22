@extends('admin.layout.index')
@section('title','Sửa chuyên mục')
@section('content')

<div class="container w-50">
<form class="text-left" method="POST" enctype="multipart/form-data" action="{{route('admin.edit.category.post', $category->id)}}">
    {{ csrf_field() }}
    <div class="form-group row">
      <label class="col-sm-2 col-form-label">Category</label>
      <div class="col-sm-10">
        <input type="text" class="form-control" name="category" id="category" onkeyup="ChangeToSlug();"
        @if(isset($category->category))
            value="{{$category->category}}"
        @endif>
      </div>
    </div>
    <div class="form-group row">
      <label class="col-sm-2 col-form-label">Slug</label>
      <div class="col-sm-10">
        <input type="text" class="form-control" id="slug" name="slug" value="{{$category->slug}}">
      </div>
    </div>

    <div class="form-group row">
        <label class="col-sm-2 col-form-label">Trạng thái</label>
        <div class="col-sm-10">
            <select data-placeholder="Chọn trạng thái" name="status" class="form-control w-50">
                <option value="0">Ẩn</option>
                <option value="1">Hoạt Động</option>
            </select>
        </div>
    </div>

    <div class="form-group row">
      <div class="col-sm-2"></div>
      <div class="col-sm-10">
        <div class="form-check">
          <input class="form-check-input" type="checkbox" id="gridCheck1" onchange="document.getElementById('cli').disabled = !this.checked;">
          <label class="form-check-label" for="gridCheck1">
            Confirm
          </label>
        </div>
      </div>
    </div>

    <div class="form-group row">
      <div class="col-sm-10  text-center">
        <button id="cli" type="submit" class="btn btn-primary" disabled>Submit</button>
      </div>
    </div>
</form>
</div>
@endsection

@section('script')
<script src="{{url('assets/admin/dashboard/js/slug.js')}}"></script>
<script language="javascript">
    $(document).ready(function() {
        $('#category').keyup(function(event) {
            var title = $('#category').val();
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
