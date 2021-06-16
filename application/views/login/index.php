<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Bandung Clothing Corporation | Login</title>
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <link rel="stylesheet" href="<?= base_url('assets/bower_components/bootstrap/dist/css/bootstrap.min.css') ?>">
    <link rel="stylesheet" href="<?= base_url('assets/dist/css/AdminLTE.min.css') ?>">
    <link rel="stylesheet" href="<?= base_url('assets/dist/css/style.css') ?>">
</head>
<body class="hold-transition">
    <div class="login-page">
        <div class="login-box">
            <form class="login-box-body"  method="POST" action="<?= site_url('login/do_login') ?>">
                <div class="top">
                    <h2 class="login-logo">Login</h2>
                    <div class="form-group">
                        <input id="text" type="text" class="form-control" Placeholder="Username" name="username" value="" required autofocus>
                    </div>
                    <div class="form-group">
                        <input id="password" type="password" Placeholder="Password" class="form-control" name="password" required>
                    </div>
                </div>
                <div class="bottom">
                    <div class="row">
                        <div class="col-xs-12">
                            <button class="btn btn-login btn-block" type="submit">LOGIN</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <footer class="footer">Copyright 2020 Bandung Clothing Corporation. All Right Reserved</footer>
    <!-- jQuery 2.2.3 -->
    <script src="<?= base_url('assets/bower_components/jquery/dist/jquery.min.js') ?>"></script>
    <!-- Bootstrap 3.3.7 -->
    <script src="<?= base_url('assets/bower_components/bootstrap/dist/js/bootstrap.min.js') ?>"></script>
</body>
</html>
