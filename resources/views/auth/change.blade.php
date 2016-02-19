
<!DOCTYPE html>
<html lang="en">
    <head>
        <title>Change PLS Password | PUBLIC SERVICE VEHICLES’ LICENSING SYSTEM --  By Optimus E-Solutions</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
        <link rel="stylesheet" rev="stylesheet" href="/bootstrap/css/bootstrap.min.css" />
        <link href="/font-awesome-4.1.0/css/font-awesome.min.css" rel="stylesheet" type="text/css">
        <link rel="stylesheet" rev="stylesheet" href="/dist/css/unicorn-login.css" />
        <link rel="stylesheet" rev="stylesheet" href="/dist/css/unicorn-login-custom.css" />

        <script src="/plugins/jQuery/jQuery-2.1.4.min.js" type="text/javascript" language="javascript" charset="UTF-8"></script>
        <script src="/bootstrap/js/bootstrap.min.js" type="text/javascript" language="javascript" charset="UTF-8"></script>
        <script src="/dist/js/zxcvbn.js" type="text/javascript" language="javascript" charset="UTF-8"></script>
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

            meter {
                /* Reset the default appearance */
                -webkit-appearance: none;
                -moz-appearance: none;
                appearance: none;

                margin: 0 auto 1em;
                width: 100%;
                height: 0.5em;

                /* Applicable only to Firefox */
                background: none;
                background-color: rgba(0, 0, 0, 0.1);
            }

            meter::-webkit-meter-bar {
                background: none;
                background-color: rgba(0, 0, 0, 0.1);
            }
            /* Webkit based browsers */
            meter[value="1"]::-webkit-meter-optimum-value { background: red; }
            meter[value="2"]::-webkit-meter-optimum-value { background: yellow; }
            meter[value="3"]::-webkit-meter-optimum-value { background: orange; }
            meter[value="4"]::-webkit-meter-optimum-value { background: green; }

            /* Gecko based browsers */
            meter[value="1"]::-moz-meter-bar { background: red; }
            meter[value="2"]::-moz-meter-bar { background: yellow; }
            meter[value="3"]::-moz-meter-bar { background: orange; }
            meter[value="4"]::-moz-meter-bar { background: green; }
        </style>
        <div id="container">
            <div id="logo">
                <img src="/images/main_logo.png" alt="" style="border-radius: 10px"/>
            </div>

            <div class="alert alert-success text-center msg-demo">

                <h3>Password Change</h3>
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
            <div id="loginbox"style="height: 270px">            
                <form method="post" action="/change-password" accept-charset="utf-8" class="form login-form" id="loginform" >                    
                    {!! csrf_field() !!}
                    <p>Change your password</p>

                    <div class="input-group">
                        <span class="input-group-addon"><i class="fa fa-user"></i></span>
                        <input type="password" name="current_password" id="username" class="form-control" placeholder="Current Password" size="60" required="" />                       
                    </div>
                    <div class="input-group">
                        <span class="input-group-addon"><i class="fa fa-user"></i></span>
                        <input type="password" name="password" value="{{ old('password') }}" id="password" class="form-control" placeholder="New Password" size="60" required="" />                       
                    </div>
                    <div class="input-group">
                        <span class="input-group-addon"><i class="fa fa-user"></i></span>
                        <input type="password" name="password_confirmation"  id="confirm_password" class="form-control" placeholder="Confirm Password" size="60" required="" />                       
                    </div>
                    <meter max="4" id="password-strength-meter"></meter>
                    <span id="password-strength-text"></span>
                    <div class="form-actions">
                        <div class="pull-left">
                            <a href="{{URL::to('/')}}" class="flip-link to-recover"><a href="">Login</a></a><br />
                            2015 Version <span class="label label-info">15.1
                        </div>
                        <div class="pull-right"><input type="submit" class="btn btn-success" value="Change Password" /></div>
                    </div>
                </form>

            </div>






        </div>

    </body>
</html>
<script>
    var strength = {
        0: "Worst",
        1: "Bad",
        2: "Weak",
        3: "Good",
        4: "Strong"
    };
    var password = document.getElementById('password');
    var meter = document.getElementById('password-strength-meter');
    var text = document.getElementById('password-strength-text');

    password.addEventListener('input', function () {
        var val = password.value;
        var result = zxcvbn(val);

        // Update the password strength meter
        meter.value = result.score;

        // Update the text indicator
        if (val !== "") {
            text.innerHTML = "Strength: " + "<strong>" + strength[result.score] + "</strong>" + "<br><i><span class='feedback'>" + result.feedback.warning + " " + result.feedback.suggestions + "</span></i>"; 
        } else {
            text.innerHTML = "";
        }
    });
</script>