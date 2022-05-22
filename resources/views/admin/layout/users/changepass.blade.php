@extends('admin.layout.index')
@section('title','Đổi mật khẩu')
@section('css')

@endsection
@section('content')
<div class="text-left">
    <div class="container w-50">
        <form method="POST" action="{{route('changePasswordPost')}}">
            {{ csrf_field() }}
            @if (session('error'))
                <div class="alert alert-danger">
                    {{ session('error') }}
                </div>
            @endif
            @if (session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif
            @if($errors)
                @foreach ($errors->all() as $error)
                    <div class="alert alert-danger">{{ $error }}</div>
                @endforeach
            @endif
            <div class="form-group">
                <label>Current Password</label>
                <input class="form-control" type="password" name="current-password" required placeholder="Enter current password">
            </div>
            <div class="form-group">
                <label>New Password</label>
                <input type="password" class="form-control" name="new-password" required placeholder="Enter the new password">
            </div>
            <div class="form-group">
                <label>Confirm Password</label>
                <input type="password" class="form-control" name="new-password_confirmation" required placeholder="Enter same password">
            </div>
            <div class="form-check text-center">
                <input type="checkbox" class="form-check-input" onchange="document.getElementById('cli').disabled = !this.checked;">
                <label class="form-check-label">Check me out</label>
            </div>
            <div class="text-center mt-3">
                <button type="submit" class="btn btn-primary" id="cli" disabled>Submit</button>
            </div>
        </form>
    </div>
</div>
@endsection
