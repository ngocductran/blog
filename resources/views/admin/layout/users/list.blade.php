@extends('admin.layout.index')
@section('title','Profile')
@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">Author
                <small>Danh Sách</small>
            </h1>
        </div>
        <!-- /.col-lg-12 -->
        <table class="table table-striped table-bordered table-hover">
            <thead class="thead-dark">
                <tr>
                    <th>ID</th>
                    <th>Tên</th>
                    <th>Email</th>
                    <th>Ngày Sinh</th>
                    <th>Số Bài Viết</th>
                    <th>Tạo Lúc</th>
                    <th>Hành Động</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                  <th scope="row">{{$profile->username}}</th>
                  <td>Mark</td>
                  <td>Otto</td>
                  <td>@mdo</td>
                </tr>
            </tbody>
        </table>
    </div>
    <!-- /.row -->
</div>
@endsection
