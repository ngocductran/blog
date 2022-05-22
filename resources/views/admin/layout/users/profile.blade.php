@extends('admin.layout.index')
@section('title','Profile Settings')
@section('css')
    <script src="https://unpkg.com/gijgo@1.9.13/js/gijgo.min.js" type="text/javascript"></script>
    <link href="https://unpkg.com/gijgo@1.9.13/css/gijgo.min.css" rel="stylesheet" type="text/css" />
@endsection

@section('add_path')
<div class="float-right">
    {{-- <a href="{{route('changePasswordPost')}}" class="d-none d-sm-inline-block btn btn-sm btn-info">
        <i class="fas fa-unlock-alt fa-sm text-white-50"></i> Change Password
    </a> --}}

    <!-- Button trigger modal -->
    <button type="button" class="btn btn-sm btn-info" data-toggle="modal" data-target="#changePassword">
        <i class="fas fa-plus"></i><b> Đổi mật khẩu</b>
    </button>

    <!-- Modal -->
    @if(!empty(Session::get('errors')) || !empty(Session::get('error')))
        <script>
            $(function() {
                $('#changePassword').modal('show');
            });
        </script>
    @endif

    <div class="modal fade" id="changePassword" tabindex="-1" aria-labelledby="changePassword" aria-hidden="true">
        <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
            <h5 class="modal-title" id="changePassword">Đổi mật khẩu</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            </div>
            <div class="modal-body">
                <div class="container">
                    <form method="POST" action="{{route('changePasswordPost')}}">
                        {{ csrf_field() }}
                        <div class="form-group">
                            <label>Mật khẩu cũ *</label>
                            <input type="password" class="form-control" name="current_password">
                        </div>
                        <div class="form-group">
                            <label>Mật khẩu mới *</label>
                            <input type="password" class="form-control" name="password">
                        </div>
                        <div class="form-group">
                            <label>Nhập lại mật khẩu mới *</label>
                            <input type="password" class="form-control" name="password_confirmation">
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Đóng</button>
                            <button type="submit" class="btn btn-primary btn-sm">Thay đổi</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        </div>
    </div>

</div>
@endsection
@section('content')
<div class="text-dark">
    <div class="row">
        <div class="col-md-3 border-right">
            <div class="d-flex flex-column align-items-center text-center p-3 py-5">
                <img class="img-thumbnail w-75 h-75" src="{{asset($profile->avatar)}}">
                <span class="font-weight-bold mt-3">{{$profile->fullname}}</span>
            </div>
        </div>
        <div class="col-md-9">
            <ul class="nav nav-tabs" id="myTab" role="tablist">
                <li class="nav-item">
                  <a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true">Info</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" id="edit-tab" data-toggle="tab" href="#edit" role="tab" aria-controls="edit" aria-selected="false">Edit</a>
                </li>
            </ul>

            <div class="tab-content" id="myTabContent">
                <div class="tab-pane fade show active" id="home">
                    <div class="py-3 container w-75">
                        {{-- <div class="d-flex justify-content-between align-items-center"><span>Edit Experience</span></div> --}}
                        <div class="form-group row mt-3">
                            <label class="col-md-4 text-right"><b>Email:</b></label>
                            <div class="col-sm-8 text-left pl-5">
                                <span>{{$profile->email}}</span>
                            </div>
                        </div>
                        <div class="form-group row mt-3">
                            <label class="col-md-4 text-right"><b>Facebook:</b></label>
                            <div class="col-sm-8 text-left pl-5">
                                <span>{{$profile->facebook}}</span>
                            </div>
                        </div>
                        <div class="form-group row mt-3">
                            <label class="col-md-4 text-right"><b>Ngày sinh</b></label>
                            <div class="col-sm-8 text-left pl-5">
                                <span>{{$profile->age}}</span>
                            </div>
                        </div>
                        <div class="form-group row mt-3">
                            <label class="col-md-4 text-right"><b>Ngày tạo tài khoản:</b></label>
                            <div class="col-sm-8 text-left pl-5">
                                <span>{{$profile->created_at}}</span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="tab-pane fade" id="edit" role="tabpanel" aria-labelledby="edit-tab">
                    <form class="py-3 container w-75" method="POST" enctype="multipart/form-data" action="{{route('profile.update')}}">
                        {{ csrf_field() }}
                        <div class="form-group row mt-3">
                            <label class="col-md-3 text-right col-form-label"><b>Facebook:</b></label>
                            <div class="col-md-9 text-left pl-5">
                                <input type="text" class="form-control" value="{{$profile->facebook}}" name="facebook">
                            </div>
                        </div>
                        <div class="form-group row mt-3">
                            <label class="col-md-3 text-right col-form-label"><b>Ngày sinh:</b></label>
                            <div class="col-md-9 text-left pl-5">
                                <input type="text" id="datepicker" class="form-control" value="{{$profile->age}}" name="age">
                            </div>
                        </div>
                        <div class="form-group row mt-3">
                            <label class="col-md-3 text-right col-form-label"><b>Họ tên:</b></label>
                            <div class="col-md-9 text-left pl-5">
                                <input type="text" class="form-control" value="{{$profile->fullname}}" name="fullname">
                            </div>
                        </div>
                        <div class="form-group row mt-3">
                            <label class="col-md-3 text-right col-form-label"><b>Avatar:</b></label>
                            <div class="col-md-9 text-left pl-5">
                                <input type="file" class="form-control-file" name="avatar">
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

                        <button type="submit" class="btn btn-primary btn-sm" id="cli" disabled>Submit</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
@section('script')
<script>
    $('#datepicker').datepicker({
        uiLibrary: 'bootstrap4',
        format: 'yyyy-mm-dd'
    });

    window.setTimeout(function() {
    $(".alert").fadeTo(5000, 0).slideUp(500, function(){
        $(this).remove();
    });
    }, 3000);
</script>

<script>
    $(document).ready(function(){
        @if(Session::has('message') || Session::has('success'))
        toastr.options =
        {
            "closeButton" : true,
            "progressBar" : true
        }
                toastr.success("{{ session('message') }}" || "{{ session('success') }}");
        @endif
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
        @if(Session::has('error'))
        toastr.options =
        {
            "closeButton" : true,
            "progressBar" : true
        }
                toastr.error("{{ session('error') }}");
        @endif
    });
</script>
@endsection
