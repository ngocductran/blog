@extends('admin.layout.index')
@section('title','Tạo chuyên mục')
@section('content')
{{-- @if (count($errors) > 0)
    <div class="alert alert-danger float-right text-left">
        <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
        @foreach ($errors->all() as $error)
            {{ $error }} &nbsp<br>
        @endforeach
    </div>
@endif --}}

<div class="container w-50">
    <form class="text-left" method="POST" enctype="multipart/form-data" action="{{route('admin.create.category.post')}}">
        {{ csrf_field() }}
        <div class="form-group row">
        <label class="col-sm-2 col-form-label">Category</label>
        <div class="col-sm-10">
            <input type="text" class="form-control" name="category" id="category" value="{{old('category')}}">
            {{-- @if ($errors->has('category'))
                <span class="h-auto">
                    <p class="text-danger"><small> * {{ $errors->first('category') }}</small></p>
                </span>
            @endif --}}
        </div>
        </div>
        <div class="form-group row">
        <label class="col-sm-2 col-form-label">Slug</label>
        <div class="col-sm-10">
            <input type="text" class="form-control" id="slug" name="slug">
            {{-- @if ($errors->has('slug'))
                <span class="h-auto">
                    <p class="text-danger"><small> * {{ $errors->first('slug') }}</small></p>
                </span>
            @endif --}}
        </div>
        </div>

        <div class="form-group row">
            <label class="col-sm-2 col-form-label">Trạng thái</label>
            <div class="col-sm-10">
                <select name="status" class="form-control w-50">
                    <option value="0" {{old('status') == 0?'selected':false}}>Ẩn</option>
                    <option value="1" {{old('status') == 1?'selected':false}}>Hoạt Động</option>
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
            {{-- <button type="reset" class="btn btn-info">Reset</button> --}}
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
        // window.setTimeout(function() {
        //     $(".alert").fadeTo(500, 0).slideUp(500, function(){
        //         $(this).remove();
        //     });
        // }, 3000);

        @if(Session::has('errors'))
        @foreach ($errors->all() as $error)
            toastr.options =
            {
                "closeButton" : true,
                "progressBar" : true
            }
                    // toastr.error("{{ $errors->first('category') }} ");
                    // toastr.error("{{ $errors->first('slug') }} ");

                toastr.error("{{ $error }} ");
        @endforeach
        @endif
    });
</script>
@endsection
