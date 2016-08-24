
<!DOCTYPE html>
<html lang="en" class="no-js">

    <head>

        <meta charset="utf-8">
        <title>Admin Login</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="description" content="">
        <meta name="author" content="">

        <!-- CSS -->
		
        <link rel='stylesheet' href='http://fonts.googleapis.com/css?family=PT+Sans:400,700'>
        <link rel="stylesheet" href="{{URL::asset('/public/admin/css/reset.css') }}">
        <link rel="stylesheet" href="{{ URL::asset('/public/admin/css/supersized.css') }}">
        <link rel="stylesheet" href="{{ URL::asset('/public/admin/css/style.css') }}">


        <!-- HTML5 shim, for IE6-8 support of HTML5 elements -->
        <!--[if lt IE 9]>
        <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
        <![endif]-->

    </head>

    <body>
    {{--{{ csrf_token() }}--}}
        <div class="page-container">
            <h1>Login</h1>
            <form action="{{url('/admin/user_login ')}}" method="post">
                {{csrf_field()}}
                @if(session('msg'))
                  <div  style="background-color: #ac2925">{{session('msg')}}</div>
                @endif

                <input type="text" name="username" class="username" placeholder="请输入用户名">
                <input type="password" name="password" class="password" placeholder="请输入密码">

                <input type="text" name="verCode" class="password" placeholder="请输入验证码">
                <div  style="float: right "><img src="{{url('/admin/veri_code')}}"  onclick="this.src='{{url('/admin/veri_code')}}?'+Math.random()"></div>

                <button type="submit">登录</button>
                <div class="error"><span> </span></div>
            </form>
          {{--  <div class="connect">
                <p>Or connect with:</p>
                <p>
                    <a class="facebook" href=""></a>
                    <a class="twitter" href=""></a>
                </p>
            </div>--}}
        </div>
       {{-- <div align="center">Collect from <a href="" target="_blank" title=""></a></div>--}}

        <!-- Javascript -->
		
        <script src="{{ URL::asset('/public/admin/js/jquery-1.8.2.min.js')}}"></script>
        <script src="{{ URL::asset('/public/admin/js/supersized.3.2.7.min.js')}}"></script>
        <script src="{{ URL::asset('/public/admin/js/supersized-init.js')}}"></script>
        <script src="{{ URL::asset('/public/admin/js/scripts.js')}}"></script>

    </body>

</html>

