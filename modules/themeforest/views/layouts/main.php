<?php

use yii\helpers\Url;
use yii\widgets\Menu;
use yii\helpers\Html;
use app\assets\AppAsset;
use mdm\admin\components\MenuHelper;

AppAsset::register($this);
if(!isset($this->context->title))
{
    $this->context->title = "";
}
$menuID     = 3;
$styleSheet = isset($this->context->styleSheet) ? $this->context->styleSheet : 'yellow-grey';
?>
<!DOCTYPE html>
<html lang="en">

    <head>
        <title><?= $this->context->title ?></title>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <?= Html::csrfMetaTags() ?>
        <meta http-equiv="cache-control" content="no-cache">
        <meta http-equiv="expires" content="<?= gmdate("r") ?>">
        <link rel="shortcut icon" href="/assets/images/icons/favicon.ico">
        <link rel="apple-touch-icon" href="/assets/images/icons/favicon.png">
        <link rel="apple-touch-icon" sizes="72x72" href="/assets/images/icons/favicon-72x72.png">
        <link rel="apple-touch-icon" sizes="114x114" href="/assets/images/icons/favicon-114x114.png">
        <!--Loading bootstrap css-->

        <link type="text/css" rel="stylesheet" href="/assets/vendors/jquery-ui-1.10.4.custom/css/ui-lightness/jquery-ui-1.10.4.custom.min.css">
        <link type="text/css" rel="stylesheet" href="/assets/vendors/font-awesome/css/font-awesome.min.css">
        <link type="text/css" rel="stylesheet" href="/assets/vendors/bootstrap/css/bootstrap.min.css">
        <!--LOADING STYLESHEET FOR PAGE-->
        <link type="text/css" rel="stylesheet" href="/assets/vendors/intro.js/introjs.css">
        <link type="text/css" rel="stylesheet" href="/assets/vendors/calendar/zabuto_calendar.min.css">
        <link type="text/css" rel="stylesheet" href="/assets/vendors/sco.message/sco.message.css">
        <link type="text/css" rel="stylesheet" href="/assets/vendors/intro.js/introjs.css">
        <!--Loading style /assets/vendors-->
        <link type="text/css" rel="stylesheet" href="/assets/vendors/animate.css/animate.css">
        <link type="text/css" rel="stylesheet" href="/assets/vendors/jquery-pace/pace.css">
        <link type="text/css" rel="stylesheet" href="/assets/vendors/iCheck/skins/all.css">
        <link type="text/css" rel="stylesheet" href="/assets/vendors/jquery-notific8/jquery.notific8.min.css">
        <!--Loading style-->
        <link type="text/css" rel="stylesheet" href="/assets/css/themes/style1/<?= $styleSheet ?>.css" class="default-style">
        <link type="text/css" rel="stylesheet" href="/assets/css/style-responsive.css">

        <?php $this->head() ?>
    </head>

    <body>
        <div>
            <!--BEGIN BACK TO TOP-->
            <a id="totop" href="#"> <i class="fa fa-angle-up"> </i>
            </a>
            <!--END BACK TO TOP-->
            <!--BEGIN TOPBAR-->
            <div id="header-topbar-option-demo" class="page-header-topbar">
                <nav id="topbar" role="navigation"
                     style="margin-bottom: 0; z-index: 2;"
                     class="navbar navbar-default navbar-static-top">
                    <div class="navbar-header">
                        <button type="button" data-toggle="collapse"
                                data-target=".sidebar-collapse" class="navbar-toggle">
                            <span class="sr-only"> Toggle navigation </span> <span
                                class="icon-bar"> </span> <span class="icon-bar"> </span> <span
                                class="icon-bar"> </span>
                        </button>
                        <a id="logo" href="<?= Url::to('/store') ?>" class="navbar-brand"> <span
                                class="fa fa-rocket"> </span> <span class="logo-text"><?= Yii::$app->name; ?></span>
                            <span style="display: none" class="logo-text-icon"> A </span>
                        </a>
                    </div>
                    <div class="topbar-main">
                        <a id="menu-toggle" href="#" class="hidden-xs"> <i
                                class="fa fa-bars"> </i>
                        </a>
                        <form id="topbar-search" action="#" method="GET" class="hidden-xs">
                            <div class="input-group">
                                <input type="text" placeholder="Search..." class="form-control" />
                                <span class="input-group-btn"> <a href="javascript:;" class="btn submit"> <i class="fa fa-search"> </i>
                                    </a>
                                </span>
                            </div>
                        </form>
                        <ul class="nav navbar navbar-top-links navbar-right mbn">

                            <li style="height: 48px;">
                                <a href="<?= Url::to('orders/create') ?>" style="padding: 8px 15px 0px 15px;" >
                                    <i class="fa fa-qrcode fa-fw" style="font-size: 25px;"> </i>
                                </a>
                            </li>
                            <li class="dropdown">
                                <a data-hover="dropdown" href="#" class="dropdown-toggle">
                                    <i class="fa fa-bell fa-fw"> </i> <span class="badge badge-green"> 0 </span>
                                </a>
                                <ul class="dropdown-menu dropdown-alerts">
                                    <li>
                                        <p>没有新的消息</p>
                                    </li>
                                    <li>
                                        <div class="dropdown-slimscroll">
                                            <ul>
                                                <!-- <li>
                                                        <a href="#">
                                                            <span class="label label-blue">
                                                                <i class="fa fa-comment">
                                                                </i>
                                                            </span>
                                                            New Comment
                                                            <span class="pull-right text-muted small">
                                                                4 mins ago
                                                            </span>
                                                        </a>
                                                    </li> -->
                                            </ul>
                                        </div>
                                    </li>
                                    <li class="last"><a href="#" class="text-right"> 查看所有 </a></li>
                                </ul></li>
                            <li class="dropdown"><a data-hover="dropdown" href="#"
                                                    class="dropdown-toggle"> <i class="fa fa-envelope fa-fw"> </i> <span
                                        class="badge badge-orange"> 0 </span>
                                </a>
                                <ul class="dropdown-menu dropdown-messages">
                                    <li>
                                        <p>您现在没有任何消息</p>
                                    </li>
                                    <li>
                                        <div class="dropdown-slimscroll">

                                        </div>
                                    </li>
                                    <li class="last"><a href="#"> 查看所有 </a></li>
                                </ul></li>

                            <li class="dropdown topbar-user"><a data-hover="dropdown" href="#"
                                                                class="dropdown-toggle"> <img
                                        src="<?= Yii::$app->user->identity->avatar ?>" alt=""
                                        class="img-responsive img-circle" /> &nbsp; <span
                                        class="hidden-xs">
                                            <?= Yii::$app->user->identity->username ?>
                                    </span> &nbsp; <span class="caret">
                                    </span>
                                </a>
                                <ul class="dropdown-menu dropdown-user pull-right">
                                    <li><a href="<?= Url::to('/dashboard/profile') ?>"> <i class="fa fa-user"> </i>
                                            个人信息
                                        </a></li>

                                    <li class="divider"></li>

                                    <li><a href="<?= Url::to(['/user/logout', 'jump' => Yii::$app->request->url]) ?>"> <i class="fa fa-key">
                                            </i> 退出登录
                                        </a></li>
                                </ul>
                            </li>



                        </ul>
                    </div>
                </nav>
                <!--BEGIN MODAL CONFIG PORTLET-->
                <div id="modal-config" class="modal fade">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" data-dismiss="modal" aria-hidden="true"
                                        class="close">&times;</button>
                                <h4 class="modal-title">
                                    <?= Yii::$app->user->identity->username ?>
                                </h4>
                            </div>
                            <div class="modal-body">
                                <p></p>
                            </div>

                        </div>
                    </div>
                </div>
                <!--END MODAL CONFIG PORTLET-->
            </div>
            <!--END TOPBAR-->
            <div id="wrapper">
                <!--BEGIN SIDEBAR MENU-->
                <nav id="sidebar" role="navigation"
                     class="navbar-default navbar-static-side">
                    <div class="sidebar-collapse menu-scroll">
                        <ul id="side-menu" class="nav">
                            <li class="user-panel">
                                <div class="thumb">
                                    <img src="<?= Yii::$app->user->identity->avatar ?>" alt=""
                                         class="img-circle">
                                </div>
                                <div class="info">
                                    <p>
                                    </p>

                                    <ul class="list-inline list-unstyled">
                                        <li><a href="<?= Url::to('/dashboard/profile') ?>" data-hover="tooltip" title=""
                                               data-original-title="Profile"> <i class="fa fa-user"> </i>
                                            </a></li>
                                        <li><a href="<?= Url::to('/dashboard/mail') ?>" data-hover="tooltip" title=""
                                               data-original-title="Mail"> <i class="fa fa-envelope"> </i>
                                            </a></li>
                                        <li><a href="#" data-hover="tooltip" title=""
                                               data-toggle="modal" data-target="#modal-config"
                                               data-original-title="Setting"> <i class="fa fa-cog"> </i>
                                            </a></li>
                                        <li><a href="<?= Url::to('/user/logout') ?>" data-hover="tooltip"
                                               title="" data-original-title="Logout"> <i
                                                    class="fa fa-sign-out"> </i>
                                            </a></li>
                                    </ul>
                                </div>
                                <div class="clearfix"></div>
                            </li>






                            <?php
                            $callback = function ($menu)
                            {
                                $base = [
                                    'label' => $menu['name'],
                                    'url' => [$menu['route']],
                                    'items' => $menu['children']
                                ];
                                if (trim($menu['data']) != '')
                                {
                                    $base['template'] = $menu['data'];
                                }
                                return $base;
                            };

                            echo Menu::widget([
                                'options' => [
                                    'tag' => 'li'
                                ],
                                'encodeLabels' => false,
                                'activateParents' => true,
                                'linkTemplate' => '<a href="{url}"><i class="fa fa-angle-right"></i><span class="submenu-title">{label} </span> </a>',
                                'submenuTemplate' => '<ul class="nav nav-second-level collapse">{items}</ul>',
                                'items' => \mdm\admin\components\MenuHelper::getAssignedMenu(Yii::$app->user->id, $menuID, $callback),
                            ]);
                            ?>

                            <!--li.charts-sum<div id="ajax-loaded-data-sidebar"></div>-->
                        </ul>
                    </div>
                </nav>
                <!--END SIDEBAR MENU-->
                <!--BEGIN CHAT FORM-->

                <!--END CHAT FORM-->
                <!--BEGIN PAGE WRAPPER-->
                <div id="page-wrapper">
                    <!--BEGIN TITLE & BREADCRUMB PAGE-->
                    <div id="title-breadcrumb-option-demo" class="page-title-breadcrumb">
                        <div class="page-header pull-left">
                            <div class="page-title"><?= $this->context->title ?></div>
                        </div>
                        <ol class="breadcrumb page-breadcrumb pull-right">
                            <li><i class="fa fa-home"> </i> &nbsp; <a
                                    href="<?= Url::toRoute("default/index") ?>"> 主页 </a> &nbsp;&nbsp; <i
                                    class="fa fa-angle-right"> </i> <a href="./index"><?= $this->context->title ?></a>&nbsp;&nbsp;</li>
                            <li class="hidden"><a href="#"> <?= isset($this->title) ? $this->title : "" ?></a>
                                &nbsp;&nbsp; <i class="fa fa-angle-right"> </i> &nbsp;&nbsp;</li>
                            <li class="active"></li>
                        </ol>
                        <div class="clearfix"></div>
                    </div>
                    <div class="page-content">
                            <?= $content ?>
                    </div>

                    <!--END CONTENT QUICK SIDEBAR-->
                </div>
                <!--BEGIN FOOTER-->
                <div id="footer">
                    <div class="copyright">2014 © Themeforest TECH Admin System
                    </div>
                </div>
                <!--END FOOTER-->
                <!--END PAGE WRAPPER-->
            </div>
        </div>
        <!--Modal Default-->
        <div id="modal-default" tabindex="-1" role="dialog" aria-labelledby="modal-default-label" aria-hidden="true" class="modal fade">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" data-dismiss="modal" aria-hidden="true" class="close">&times;</button>
                        <h4 id="modal-default-label" class="modal-title">查看图片</h4>
                    </div>
                    <div class="modal-body"><img id="modal-img" width="568px"src="http://m.baidu.com/static/index/plus/weather/3_3.jpg"/></div>
                    <div class="modal-footer">
                        <button type="button" data-dismiss="modal" class="btn btn-default">关闭</button>

                    </div>
                </div>
            </div>
        </div>


        <script src="/assets/js/jquery-migrate-1.2.1.min.js"></script>
        <script src="/assets/js/jquery-ui.js"></script>
        <!--loading bootstrap js-->
        <script src="/assets/vendors/bootstrap/js/bootstrap.min.js"></script>
        <script
        src="/assets/vendors/bootstrap-hover-dropdown/bootstrap-hover-dropdown.js"></script>
        <script src="/assets/js/html5shiv.js"></script>
        <script src="/assets/js/respond.min.js"></script>
        <script src="/assets/vendors/metisMenu/jquery.metisMenu.js"></script>
        <script src="/assets/vendors/slimScroll/jquery.slimscroll.js"></script>
        <script src="/assets/vendors/jquery-cookie/jquery.cookie.js"></script>
        <script src="/assets/vendors/iCheck/icheck.min.js"></script>
        <script src="/assets/vendors/iCheck/custom.min.js"></script>
        <script src="/assets/vendors/jquery-notific8/jquery.notific8.min.js"></script>
        <script src="/assets/vendors/jquery-highcharts/highcharts.js"></script>
        <script src="/assets/js/jquery.menu.js"></script>
        <script src="/assets/vendors/jquery-pace/pace.min.js"></script>
        <script src="/assets/vendors/holder/holder.js"></script>
        <script src="/assets/vendors/responsive-tabs/responsive-tabs.js"></script>
        <!--CORE JAVASCRIPT-->
        <!--LOADING SCRIPTS FOR PAGE-->
        <script src="/assets/vendors/intro.js/intro.js"></script>
        <script src="/assets/vendors/flot-chart/jquery.flot.js"></script>
        <script src="/assets/vendors/flot-chart/jquery.flot.categories.js"></script>
        <script src="/assets/vendors/flot-chart/jquery.flot.pie.js"></script>
        <script src="/assets/vendors/flot-chart/jquery.flot.tooltip.js"></script>
        <script src="/assets/vendors/flot-chart/jquery.flot.resize.js"></script>
        <script src="/assets/vendors/flot-chart/jquery.flot.fillbetween.js"></script>
        <script src="/assets/vendors/flot-chart/jquery.flot.stack.js"></script>
        <script src="/assets/vendors/flot-chart/jquery.flot.spline.js"></script>
        <script src="/assets/vendors/calendar/zabuto_calendar.min.js"></script>
        <script src="/assets/vendors/sco.message/sco.message.js"></script>
        <script src="/assets/vendors/intro.js/intro.js"></script>
        <script src="/assets/js/main.js"></script>

    </body>

    <?php $this->endBody() ?>
</html>
<?php $this->endPage() ?>
<!-- Localized -->