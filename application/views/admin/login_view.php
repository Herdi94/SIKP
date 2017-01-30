<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <title>Sign In | Kerja Praktek Online | Admin</title>

    <!-- Favicon-->
    <link rel="icon" href="<?php echo base_url('assets/images/jabar.png')?>" type="image/x-icon">


    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Roboto:400,700&subset=latin,cyrillic-ext" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet" type="text/css">


    <!-- Bootstrap Core Css -->
    <link href="<?php echo base_url('assets/AdminBSB/plugins/bootstrap/css/bootstrap.css')?>" rel="stylesheet">


    <!-- Waves Effect Css -->
    <link href="<?php echo base_url('assets/AdminBSB/plugins/node-waves/waves.css')?>" rel="stylesheet" />


    <!-- Animation Css -->
    <link href="<?php echo base_url('assets/AdminBSB/plugins/animate-css/animate.css')?>" rel="stylesheet" />

    <!-- Custom Css -->
    <link href="<?php echo base_url('assets/AdminBSB/css/style.css')?>" rel="stylesheet">

</head>

<body class="login-page">

<div class="login-box">
    <div class="logo">
        <a href="javascript:void(0);"><font size="5px">Kerja Praktek Online - </font><font size="4px">Admin</font> </a>
    </div>
    <div class="card">
        <div class="body">
            <form id="sign_in" method="POST" action="<?php echo $action ?>">
                <div class="msg">Sign in to start your session</div>
                <div class="input-group">
                        <span class="input-group-addon">
                            <i class="material-icons">person</i>
                        </span>
                    <form method="post">
                        <div class="form-line">
                            <input type="text" class="form-control" name="username" placeholder="Username / Email" required autofocus>
                        </div>
                </div>
                <div class="input-group">
                        <span class="input-group-addon">
                            <i class="material-icons">lock</i>
                        </span>
                    <div class="form-line">
                        <input type="password" class="form-control" name="password" placeholder="Password" required>
                    </div>
                </div>
                <div class="row">
                    <div class="col-xs-8 p-t-5">
                        <!--to set remember me -->
                    </div>
                    <div class="col-xs-4">
                        <button class="btn btn-block bg-pink waves-effect" type="submit">SIGN IN</button>
                    </div>
                </div>
                <div class="msg"><?php echo $error; ?></div>
                <div class="row m-t-15 m-b--20">

                    <div class="col-xs-6 align-left">
                        <a href="<?php echo site_url('dashboard/display_doforget'); ?>">Forgot Password?</a>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>


<!-- Jquery Core Js -->
<script src="<?php echo base_url('assets/AdminBSB/plugins/jquery/jquery.min.js') ?>"></script>


<!-- Bootstrap Core Js -->
<script src="<?php echo base_url('assets/AdminBSB/plugins/bootstrap/js/bootstrap.js') ?>"></script>


<!-- Waves Effect Plugin Js -->
<script src="<?php echo base_url('assets/AdminBSB/plugins/node-waves/waves.js') ?>"></script>

<!-- Validation Plugin Js -->
<script src="<?php echo base_url('assets/AdminBSB/plugins/jquery-validation/jquery.validate.js') ?>"></script>

<!-- Custom Js -->
<script src="<?php echo base_url('assets/AdminBSB/js/admin.js') ?>"></script>
<script src="<?php echo base_url('assets/AdminBSB/js/pages/examples/sign-in.js') ?>"></script>


</body>

</html>
