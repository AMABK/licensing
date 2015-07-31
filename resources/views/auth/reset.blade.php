
<!DOCTYPE html>
<html lang="en">
    <head>
        <title>Welcome to FleetMan | Fleet Management System --  By Optimus E-Solutions</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
        <link rel="stylesheet" rev="stylesheet" href="/bootstrap/css/bootstrap.min.css" />
        <link href="/font-awesome-4.1.0/css/font-awesome.min.css" rel="stylesheet" type="text/css">
        <link rel="stylesheet" rev="stylesheet" href="/dist/css/unicorn-login.css" />
        <link rel="stylesheet" rev="stylesheet" href="/dist/css/unicorn-login-custom.css" />

        <script src="/dist/js/jquery-1.11.0.js" type="text/javascript" language="javascript" charset="UTF-8"></script>
        <script src="/dist/js/bootstrap.min.js" type="text/javascript" language="javascript" charset="UTF-8"></script>
    </head>
    <body>
        <style>
            .alert-success{
                background: white;
            }
            h3{
                color: #D63E13;
            }
            .btn-success{
                background: #D63E13;
            }
            .btn-success:hover{
                background: #D63E13;
            }
        </style>
        <div id="container">
            <div id="logo">
                <img src="/images/main_logo.png" alt="" style="border-radius: 10px"/>
            </div>

            <div class="alert alert-success text-center msg-demo">

                <h3>Password Reset</h3>
            </div>
            <center>
            @if(Session::has('global'))
            <p>{!!Session::get('global')!!}</p>
            @endif 
            @if($errors->has('email'))
            <div class="alert alert-warning" align="center">{{$errors->first('email')}}</div>
            @endif
            @if($errors->has('password'))
            <div class="alert alert-warning" align="center">{{$errors->first('password')}}</div>
            @endif
            </center>
            <div id="loginbox">            
                <form method="post" action="/password/reset" accept-charset="utf-8" class="form login-form" id="loginform" >                    
                    {!! csrf_field() !!}
                    <p>Welcome to the FleetMan.<br>Enter your new password.</p>
                    <div class="input-group">
                        <span class="input-group-addon"><i class="fa fa-user"></i></span>
                        <input type="email" name="email" value="{{ old('email') }}" id="username" class="form-control" placeholder="Username" size="20" required="" />                       
                    </div>
                    <div class="input-group">
                        <span class="input-group-addon"><i class="fa fa-user"></i></span>
                        <input type="password" name="password" value="{{ old('password') }}" id="username" class="form-control" placeholder="Password" size="60" required="" />                       
                    </div>
                    <div class="input-group">
                        <span class="input-group-addon"><i class="fa fa-user"></i></span>
                        <input type="password" name="password_confirmation"  id="username" class="form-control" placeholder="Password" size="60" required="" />                       
                    </div>
                    <div class="form-actions">
                        <div class="pull-left">
                            <a href="{{URL::to('/')}}" class="flip-link to-recover"><a href="">Login</a></a><br />


                            2015 Version <span class="label label-info">15.1
                        </div>
                        <div class="pull-right"><input type="submit" class="btn btn-success" value="Send Password Reset Link" /></div>
                    </div>
                </form>

            </div>






        </div>

    </body>
</html>