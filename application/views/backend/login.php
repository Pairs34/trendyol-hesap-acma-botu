<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Main CSS-->
    <link rel="stylesheet" type="text/css" href="<?=base_url('public/backend/')?>css/main.css">
    <!-- Font-icon css-->
    <link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <title>Yonetim</title>
</head>
<body>
<section class="material-half-bg">
    <div class="cover"></div>
</section>
<section class="login-content">

    <div class="login-box">
            <?=form_open(route('login.login'),['class'=>'login-form'])?>
            <h3 class="login-head"><i class="fa fa-lg fa-fw fa-user"></i>Yonetim</h3>
            <div class="form-group">
                <label class="control-label">USERNAME</label>
                <input class="form-control" type="text" name="username" placeholder="Username" autofocus>
            </div>
            <div class="form-group">
                <label class="control-label">PASSWORD</label>
                <input class="form-control" type="password" name="password" placeholder="Password">
            </div>

            <div class="form-group btn-container">
                <button class="btn btn-primary btn-block" type="submit"><i class="fa fa-sign-in fa-lg fa-fw"></i>Giriş Yap</button>
            </div>
        <?=form_close()?>

    </div>
</section>
<!-- Essential javascripts for application to work-->
<script src="<?=base_url('public/backend/')?>js/jquery-3.3.1.min.js"></script>
<script src="<?=base_url('public/backend/')?>js/popper.min.js"></script>
<script src="<?=base_url('public/backend/')?>js/bootstrap.min.js"></script>
<script src="<?=base_url('public/backend/')?>js/main.js"></script>
<!-- The javascript plugin to display page loading on top-->
<script src="<?=base_url('public/backend/')?>js/plugins/pace.min.js"></script>

</body>
</html>