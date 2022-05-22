@extends('admin.layout.index')
@section('title','Danh sách bài viết')
@section('css')
    <link href="https://cdn.datatables.net/1.11.5/css/dataTables.bootstrap4.min.css" rel="stylesheet" type="text/css" />
@endsection
@section('add_path')
<div class="dropdown no-arrow">
    <a href="{{route('admin.create.post.get')}}" class="d-none d-sm-inline-block btn btn-sm btn-success shadow-sm">Thêm bài viết</a>
</div>
@endsection

@section('content')
<div class="table-responsive">
<table class="table table-bordered table-hover" id="dataTable" >
    <thead class="thead-dark">
      <tr>
        <th scope="col" width="5%">ID</th>
        <th scope="col" width="27%">Tiêu đề</th>
        <th scope="col" width="24%">Mô tả</th>
        <th scope="col" width="13%">Chuyên mục</th>
        <th scope="col" width="11%">Tác giả</th>
        <th scope="col" width="10%">Ảnh</th>
        <th scope="col" width="10%">Thao tác</th>
      </tr>
    </thead>
    <tbody>

        @foreach ($post as $post)
        <tr>
            <th scope="row">{{$post->id}}</th>
            <td>{{$post->title}}</td>
            <td>
                {{$post->description}}
            </td>
            <td>
                {{ $post->category->category }}
            </td>
            <td>
                {{ $post->user->fullname }}
            </td>
            <td><img src="{{asset($post->avatar)}}" class="img-fluid"></td>
            <td class="text-center">
                <a href="{{route('admin.edit.post.get',$post->id)}}" class="btn btn-small btn-info btn-sm">Edit</a>
                <a href="{{route('admin.delete.post',$post->id)}}" class="btn btn-danger btn-sm">Xóa</a>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
</div>
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

