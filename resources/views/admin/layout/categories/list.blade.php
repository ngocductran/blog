@extends('admin.layout.index')
@section('title','Danh sách chuyên mục')
@section('css')
    <link href="https://cdn.datatables.net/1.11.5/css/dataTables.bootstrap4.min.css" rel="stylesheet" type="text/css" />
@endsection
@section('add_path')
<div class="dropdown no-arrow">
    <a href="{{route('admin.create.category.get')}}" class="d-none d-sm-inline-block btn btn-sm btn-success shadow-sm">Thêm chuyên mục</a>
</div>
@endsection
@section('content')
{{-- @if(Session::has('success'))
    <div class="alert alert-success float-right mr-auto" role="alert">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        {{ Session::get('success') }}
    </div>
@endif
@if(Session::has('warning'))
    <div class="alert alert-warning float-right mr-auto" role="alert">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        {{ Session::get('warning') }}
    </div>
@endif --}}
<table class="table table-bordered table-hover table-sm" id="dataTable">
    <thead class="thead-dark">
      <tr>
        <th scope="col">ID</th>
        <th scope="col">Chuyên mục</th>
        <th scope="col">Trạng thái</th>
        <th scope="col">Số bài viết</th>
        <th scope="col">Thao tác</th>
      </tr>
    </thead>
    <tbody>

        @foreach ($category as $cate)
        <tr>
            <th scope="row">{{$cate->id}}</th>
            <td>{{$cate->category}}</td>
            <td>
                {{$cate->status == 1 ? 'Hoạt Động':'Ẩn'}}
            </td>
            <td>
                {{$cate->posts->count()}}
            </td>
            <td class="text-center">
                <a href="{{route('admin.edit.category.post',$cate->id)}}" class="btn btn-small btn-info btn-sm">Edit</a>
                <a href="{{route('admin.delete.category',$cate->id)}}" class="btn btn-danger btn-sm">Xóa</a>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
@endsection

@section('script')
<script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.11.5/js/dataTables.bootstrap4.min.js"></script>
<script>
    $(document).ready(function() {
        @if(Session::has('message') || Session::has('success'))
        toastr.options =
        {
            "closeButton" : true,
            "progressBar" : true
        }
                toastr.success("{{ session('message') }}" || "{{ session('success') }}");
        @endif

        @if(Session::has('errors') || Session::has('error'))
        toastr.options =
        {
            "closeButton" : true,
            "progressBar" : true
        }
                toastr.error("{{ session('errors') }}");
        @endif

        @if(Session::has('info'))
        toastr.options =
        {
            "closeButton" : true,
            "progressBar" : true
        }
                toastr.info("{{ session('info') }}");
        @endif

        @if(Session::has('warning'))
        toastr.options =
        {
            "closeButton" : true,
            "progressBar" : true
        }
                toastr.warning("{{ session('warning') }}");
        @endif
    });

    $(document).ready(function() {
        $('#dataTable').DataTable({
            "language": {
                "url": "//cdn.datatables.net/plug-ins/1.11.5/i18n/vi.json"
            }
        });
    });
</script>
@endsection
