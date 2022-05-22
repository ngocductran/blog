<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Register admin</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.min.js" charset="utf-8"></script>

    <link rel="stylesheet" type="text/css" href="{{url('assets/admin/login/css/style.css')}}">
    <script src="{{url('assets/admin/login/js/app.js')}}"></script>
</head>
<body>
    <form action="{{route('admin.register.post')}}" id="login-form" method="POST">
        <input type="hidden" name="_token" value="{{ csrf_token() }}" />
        <h1>
            Admin Register
        </h1>
        <div class="input-box">
            <input type="text" placeholder="Username" name="username">
        </div>

        <div class="input-box">
            <input type="email" placeholder="Email" name="email">
        </div>

        <div class="input-box">
            <input type="password" placeholder="Password" name="password">
        </div>

        <div class="input-box">
            <input type="password" placeholder="Confirm Password" name="confirn_password">
        </div>

        <input type="text" value="1" hidden name="level">

        @if (count($errors) > 0)
        <div class="alert alert-danger">
            <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
            @foreach ($errors->all() as $error)
                {{ $error }}<br>
            @endforeach
        </div>
        @endif

        <button type="submit" class="login-btn">Đăng ký</button>

        <div class="bottom-links">
          <p>You have account? <a href="{{route('login')}}">Login</a></p>
        </div>
    </form>
</body>
</html>
