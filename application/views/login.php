<?php //phpinfo();  ?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>Log in</title>
        <!-- Tell the browser to be responsive to screen width -->
        <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
        <link rel="shortcut icon" type="image/jpg" href="<?php echo base_url(); ?>images/logo.jpg"/>
        <!-- Bootstrap -->
        <link href="<?php echo base_url(); ?>vendors/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
        <!-- Font Awesome -->
        <link href="<?php echo base_url(); ?>vendors/font-awesome/css/font-awesome.min.css" rel="stylesheet">
        <link href="<?php echo base_url(); ?>build/css/site-style.css" rel="stylesheet">
        <style>

            body{background:#2A3F54;}
            h1,h3{
                color:#ccc;
                text-align:center;
                font-family: 'Vibur', cursive;
                font-size: 50px;
            }

            .title-1 {
                font-family: Poppins-Bold;
                font-size: 30px;
                color:#2A3F54;
                text-transform: uppercase;
                line-height: 1.2;
                text-align: center;
            }
            .login-form{
                width:350px;
                padding:40px 30px;
                background:#eee;
                @include border-radius(4px);
                margin:auto;
                position: absolute;
                left: 0;
                right: 0;
                top:18%;
                @include translateY(-50%);
            }
            .form-group{
                position: relative;
                margin-bottom:15px;
            }
            .form-control{
                width:100%;
                height:50px;
                border:none;
                padding:5px 7px 5px 15px;
                background:#fff;
                color:#666;
                border:2px solid #ddd;
                @include border-radius(4px);
                &:focus, &:focus + .fa{
                    border-color:#10CE88;
                    color:#10CE88;
                }
            }
            .form-group .fa{
                position: absolute;
                right:15px;
                top:17px;
                color:#999;
            }
            .log-status.wrong-entry {
                @include animation( wrong-log 0.3s);
            }
            .log-status.wrong-entry .form-control, .wrong-entry .form-control + .fa {
                border-color: #ed1c24;
                color: #ed1c24;
            }
            .log-btn{
                background:#0AC986;
                dispaly:inline-block;
                width:100%;
                font-size:16px;
                height:50px;
                color:#fff;
                text-decoration:none;
                border:none;
                @include border-radius(4px);
            }

            .link{
                text-decoration:none;
                color:#C6C6C6;
                float:right;
                font-size:12px;
                margin-bottom:15px;
                &:hover{
                    text-decoration: underline;
                    color:#8C918F;
                }
            }   
            .alert {
                color:red;
            }

        </style>
    </head>
    <body>
        <div class="login-form">
            <div class="title-1"> Sign In </div>
            <h1> <img src="<?php echo base_url(); ?>images/logo.jpg" alt="..." height="70px" width="70px" class="img-circle profile_img"></h1>
            <div class="form-group ">
                <input type="text" class="form-control" placeholder="Username" value="hanzo.hatory79@gmail.com" id="UserName" autocomplete="off">
                <i class="fa fa-user"></i>
            </div>
            <div class="form-group log-status">
                <input type="password" class="form-control" placeholder="Password" value="123" id="Passwod">
                <i class="fa fa-lock"></i>
            </div>
            <span class="alert hidden">Invalid Credentials</span>
            <a class="link" href="#">Lost your password?</a>
            <button type="button" class="log-btn" onclick="doLogin();" >Log in</button>
        </div>
        <!-- /.login-box -->
        <div class="loading hidden">Loading&#8230;</div>
        <!-- jQuery -->
        <script src="<?php echo base_url(); ?>vendors/jquery/dist/jquery.min.js"></script>
        <!-- Bootstrap -->
        <script src="<?php echo base_url(); ?>vendors/bootstrap/dist/js/bootstrap.min.js"></script>
        <script src="<?php echo base_url(); ?>build/js/site-js.js"></script>
        <script type="text/javascript">
                /////////// add room Function///////////////
                function doLogin() {
                    var username = $('#UserName').val();
                    var password = $('#Passwod').val();
                    if (isEmpty(username)) {
                        var v = $('.alert');
                        v.text("Username is Required");
                        v.removeClass("hidden");
                        v.addClass("show");
                        return;
                    }
                    if (isEmpty(password)) {
                        var v = $('.alert');
                        v.text("Password is Required");
                        v.removeClass("hidden");
                        v.addClass("show");
                        return;
                    }
                    $.ajax({
                        url: '<?php echo base_url() ?>/home/dologin',
                        type: 'POST',
                        data: {'username': username, 'password': password},
                        beforeSend: function () {
                            $(".loading").removeClass('hidden');
                            $(".loading").addClass('show');
                        },
                        success: function (data) {
                            data = $.parseJSON(data);
                            if (data.errorCode == "0000") {
                                window.location.href = "<?php echo base_url() ?>reserve/book";
                            } else {
                                $(".alert").removeClass('hidden');
                            }
                        },
                        error: function (xhr) { // if error occured
                            alert("Error occured.please try again");
                        },
                        complete: function () {
                            $(".loading").removeClass('show');
                            $(".loading").addClass('hidden');
                        }
                    });
                }

        </script>
    </body>
</html>
