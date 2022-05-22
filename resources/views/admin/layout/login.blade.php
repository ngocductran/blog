<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Login admin</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.min.js" charset="utf-8"></script>

    <link rel="stylesheet" type="text/css" href="{{url('assets/admin/login/css/style.css')}}">
    <script src="{{url('assets/admin/login/js/app.js')}}"></script>
</head>
<body>
    <form action="{{route('admin.login.post')}}" id="login-form" method="POST">
        <input type="hidden" name="_token" value="{{ csrf_token() }}" />
        <h1>
            Admin Login
        </h1>
        <div class="input-box">
            <input type="text" placeholder="Username" name="username">
        </div>

        <div class="input-box">
            <input type="password" placeholder="Password" name="password">
        </div>

        @if(session('error'))
        <div class="control-group">
            <div class="controls row-fluid">
                <div class="alert alert-danger alert-dismissible">
                    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                     {{session('error')}}
                </div>
            </div>
        </div>
        @endif
        <label>
          <input type="checkbox" name="remember"> Remember me
        </label>

        <button type="submit" class="login-btn">Login</button>

        <div class="bottom-links">
          <p>Don’t have account? <a href="{{route('register')}}">Sign up</a></p>
        </div>
    </form>
</body>
</html>
