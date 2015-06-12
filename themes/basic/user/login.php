<!DOCTYPE html>
<html lang="en">
<head>
<title>用户登录</title>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta http-equiv="cache-control" content="no-cache">
<meta http-equiv="expires" content="Thu, 19 Nov 1900 08:52:00 GMT">
<!--Loading bootstrap css-->

<link type="text/css" rel="stylesheet" href="/assets/vendors/jquery-ui-1.10.3.custom/css/ui-lightness/jquery-ui-1.10.3.custom.css">
<link type="text/css" rel="stylesheet" href="/assets/vendors/font-awesome/css/font-awesome.min.css">
<link type="text/css" rel="stylesheet" href="/assets/vendors/bootstrap/css/bootstrap.min.css">
<!--Loading style vendors-->
<link type="text/css" rel="stylesheet" href="/assets/vendors/animate.css/animate.css">
<link type="text/css" rel="stylesheet" href="/assets/vendors/iCheck/skins/all.css">
<!--Loading style-->
<link type="text/css" rel="stylesheet" href="/assets/css/themes/style1/pink-blue.css" class="default-style">
<link type="text/css" rel="stylesheet" href="/assets/css/themes/style1/pink-blue.css" id="theme-change" class="style-change color-change">
<link type="text/css" rel="stylesheet" href="/assets/css/style-responsive.css">
<link rel="shortcut icon" href="/assets/images/favicon.ico">
</head>
<body id="signin-page">
<div class="page-form">
    <div class="header-content">
      <h1>登录</h1>
    </div>
    <div class="body-content">
    
        <?php if(isset($message)): ?>
        <div class="alert alert-danger">
            <?=$message?>
        </div>
        <?php endif;?>
        <?php 
            $jump = Yii::$app->request->get('jump', '/');
            $goto = urlencode(\yii\helpers\Url::to('user/forward?jump='.$jump, true));
            $loginUrl = '//i.Themeforest.com/oauth/authorize?client_id=10000&redirect_uri='.$goto; //
        ?>

        <iframe src="<?php echo $loginUrl; ?>" style="width:100%;height:350px;border: 0;" scrolling="no"></iframe>

    </div>
</div>
<script src="/assets/js/jquery-1.10.2.min.js"></script>
<script src="/assets/js/jquery-migrate-1.2.1.min.js"></script>
<script src="/assets/js/jquery-ui.js"></script>
<!--loading bootstrap js-->
<script src="vendors/bootstrap/js/bootstrap.min.js"></script>
<script src="vendors/bootstrap-hover-dropdown/bootstrap-hover-dropdown.js"></script>
<script src="/assets/js/html5shiv.js"></script>
<script src="/assets/js/respond.min.js"></script>
<script src="vendors/iCheck/icheck.min.js"></script>
<script src="vendors/iCheck/custom.min.js"></script><script>//BEGIN CHECKBOX & RADIO
$('input[type="checkbox"]').iCheck({
    checkboxClass: 'icheckbox_minimal-grey',
    increaseArea: '20%' // optional
});
$('input[type="radio"]').iCheck({
    radioClass: 'iradio_minimal-grey',
    increaseArea: '20%' // optional
});
//END CHECKBOX & RADIO</script>
</body>
</html>