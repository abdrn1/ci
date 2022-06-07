<!DOCTYPE html>
<!-- 
Template Name: Metronic - Responsive Admin Dashboard Template build with Twitter Bootstrap 3.3.6
Version: 4.5.6
Author: KeenThemes
Website: http://www.keenthemes.com/
Contact: support@keenthemes.com
Follow: www.twitter.com/keenthemes
Dribbble: www.dribbble.com/keenthemes
Like: www.facebook.com/keenthemes
Purchase: http://themeforest.net/item/metronic-responsive-admin-dashboard-template/4021469?ref=keenthemes
Renew Support: http://themeforest.net/item/metronic-responsive-admin-dashboard-template/4021469?ref=keenthemes
License: You must have a valid license purchased only from themeforest(the above link) in order to legally use the theme for your project.
-->
<!--[if IE 8]> <html lang="en" class="ie8 no-js"> <![endif]-->
<!--[if IE 9]> <html lang="en" class="ie9 no-js"> <![endif]-->
<!--[if !IE]><!-->
<html lang="en"><!--<![endif]--><!-- BEGIN HEAD --><head>
        <meta charset="utf-8">
        <title><?php echo $title; ?></title>
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta content="width=device-width, initial-scale=1" name="viewport">
        <meta content="" name="description">
        <meta content="" name="author">
        <!-- BEGIN GLOBAL MANDATORY STYLES -->
        <!--<link href="http://fonts.googleapis.com/css?family=Open+Sans:400,300,600,700&amp;subset=all" rel="stylesheet" type="text/css">-->
        <link href="<?php echo base_url(); ?>assets_admin/global/plugins/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
        <link href="<?php echo base_url(); ?>assets_admin/global/plugins/simple-line-icons/simple-line-icons.min.css" rel="stylesheet" type="text/css">
        <link href="<?php echo base_url(); ?>assets_admin/global/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css">
        <link href="<?php echo base_url(); ?>assets_admin/global/plugins/sweet-alert/css/sweetalert.css" rel="stylesheet" type="text/css">
        <link href=="<?php echo base_url(); ?>assets_admin/global/plugins/datatables/css/jquery.dataTables.min.css" type="text/css">
        <link href=="<?php echo base_url(); ?>assets_admin/global/plugins/datatables/css/dataTables.bootstrap.min.css" type="text/css">
        <link href="<?php echo base_url(); ?>assets_admin/global/plugins/bootstrap-switch/css/bootstrap-switch.min.css" rel="stylesheet" type="text/css">
        <!-- END GLOBAL MANDATORY STYLES -->
        <!-- BEGIN PAGE LEVEL PLUGINS -->
        <link href="<?php echo base_url(); ?>assets_admin/global/plugins/bootstrap-datepicker/css/bootstrap-datepicker.min.css" rel="stylesheet" type="text/css">
        <link href="<?php echo base_url(); ?>assets_admin/global/plugins/bootstrap-select/css/bootstrap-select.min.css" rel="stylesheet" type="text/css">
        <!--<link href="<?php echo base_url(); ?>assets_admin/global/plugins/month-picker/css/MonthPicker.min.css" rel="stylesheet" type="text/css">-->
        <link href="<?php echo base_url(); ?>assets_admin/global/plugins/morris/morris.css" rel="stylesheet" type="text/css">
        <link href="<?php echo base_url(); ?>assets_admin/global/plugins/fullcalendar/fullcalendar.min.css" rel="stylesheet" type="text/css">
        <link href="<?php echo base_url(); ?>assets_admin/global/plugins/jqvmap/jqvmap/jqvmap.css" rel="stylesheet" type="text/css">
        <!-- END PAGE LEVEL PLUGINS -->
        <!-- BEGIN THEME GLOBAL STYLES -->
        <link href="<?php echo base_url(); ?>assets_admin/global/css/components.min.css" rel="stylesheet" id="style_components" type="text/css">
        <link href="<?php echo base_url(); ?>assets_admin/global/css/plugins.min.css" rel="stylesheet" type="text/css">
        <!-- END THEME GLOBAL STYLES -->
        <!-- BEGIN THEME LAYOUT STYLES -->
        <link href="<?php echo base_url(); ?>assets_admin/layouts/layout2/css/layout.min.css" rel="stylesheet" type="text/css">
        <link href="<?php echo base_url(); ?>assets_admin/layouts/layout2/css/themes/blue.min.css" rel="stylesheet" type="text/css" id="style_color">
        <link href="<?php echo base_url(); ?>assets_admin/layouts/layout2/css/custom.min.css" rel="stylesheet" type="text/css">
        <!-- END THEME LAYOUT STYLES -->
        <!-- BEGIN PAGE LEVEL STYLES -->
        <link href="<?php echo base_url(); ?>assets_admin/pages/css/login.min.css" rel="stylesheet" type="text/css" />
        <link href="<?php echo base_url(); ?>assets_admin/pages/css/abdstyle.css" rel="stylesheet" type="text/css" />
        <!-- END PAGE LEVEL STYLES -->
        <link rel="shortcut icon" href="favicon.ico">


        <!--- ***************** Start Scripts ****************** ---->


        <!--[if lt IE 9]>
        <script src="<?php echo base_url(); ?>assets_admin/global/plugins/respond.min.js"></script>
        <script src="<?php echo base_url(); ?>assets_admin/global/plugins/excanvas.min.js"></script> 
        <![endif]-->
        <!-- BEGIN CORE PLUGINS -->
        <!--<script src="<?php echo base_url(); ?>assets_admin/global/plugins/jquery.min.js" type="text/javascript"></script>-->
        <script src="<?php echo base_url(); ?>assets_admin/global/plugins/jquery-2.2.3.min.js" type="text/javascript"></script>
        <script src="<?php echo base_url(); ?>assets_admin/global/plugins/jquery-migrate-1.4.1.min.js" type="text/javascript"></script>
        <script src="<?php echo base_url(); ?>assets_admin/global/plugins/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
        <script src="<?php echo base_url(); ?>assets_admin/global/plugins/sweet-alert/js/sweetalert.min.js" type="text/javascript"></script>
        <script src="<?php echo base_url(); ?>assets_admin/global/plugins/jquery.validate.min.js" type="text/javascript"></script>
        <script src="<?php echo base_url(); ?>assets_admin/global/plugins/additional-methods.min.js" type="text/javascript"></script>
        <script src="<?php echo base_url(); ?>assets_admin/global/plugins/datatables/js/jquery.dataTables.min.js" type="text/javascript"></script>
        <script src="<?php echo base_url(); ?>assets_admin/global/plugins/datatables/js/dataTables.bootstrap.js" type="text/javascript"></script>
        <script src="<?php echo base_url(); ?>assets_admin/global/plugins/js.cookie.min.js" type="text/javascript"></script>
        <!--<script src="<?php echo base_url(); ?>assets_admin/global/plugins/jquery.uploadPreview.min.js" type="text/javascript"></script>-->
        <script src="<?php echo base_url(); ?>assets_admin/global/plugins/bootstrap-hover-dropdown/bootstrap-hover-dropdown.min.js" type="text/javascript"></script>
        <script src="<?php echo base_url(); ?>assets_admin/global/plugins/jquery-slimscroll/jquery.slimscroll.min.js" type="text/javascript"></script>
        <script src="<?php echo base_url(); ?>assets_admin/global/plugins/jquery.blockui.min.js" type="text/javascript"></script>
        <script src="<?php echo base_url(); ?>assets_admin/global/plugins/bootstrap-switch/js/bootstrap-switch.min.js" type="text/javascript"></script>
        <script src="<?php echo base_url(); ?>assets_admin/global/plugins/bootstrap-select/js/bootstrap-select.min.js" type="text/javascript"></script>
        <script src="<?php echo base_url(); ?>assets_admin/global/plugins/bootstrap-datepicker/js/bootstrap-datepicker.min.js" type="text/javascript"></script>
        <script src="<?php echo base_url(); ?>assets_admin/global/plugins/amcharts/amcharts/amcharts.js" type="text/javascript"></script>
        <script src="<?php echo base_url(); ?>assets_admin/global/plugins/amcharts/amcharts/serial.js" type="text/javascript"></script>
        <script src="<?php echo base_url(); ?>assets_admin/global/plugins/amcharts/amcharts/pie.js" type="text/javascript"></script>
        <script src="<?php echo base_url(); ?>assets_admin/global/plugins/jquery-easypiechart/jquery.easypiechart.js" type="text/javascript"></script>
        <script src="<?php echo base_url(); ?>assets_admin/global/plugins/flot/jquery.flot.min.js" type="text/javascript"></script>
        <script src="<?php echo base_url(); ?>assets_admin/global/plugins/flot/jquery.flot.resize.min.js" type="text/javascript"></script>
        <script src="<?php echo base_url(); ?>assets_admin/global/plugins/flot/jquery.flot.categories.min.js" type="text/javascript"></script>
        <script src="<?php echo base_url(); ?>assets_admin/global/plugins/flot/jquery.flot.pie.min.js" type="text/javascript"></script>
        <script src="<?php echo base_url(); ?>assets_admin/global/plugins/flot/jquery.flot.stack.min.js" type="text/javascript"></script>
        <script src="<?php echo base_url(); ?>assets_admin/global/plugins/flot/jquery.flot.crosshair.min.js" type="text/javascript"></script>
        <script src="<?php echo base_url(); ?>assets_admin/global/plugins/flot/jquery.flot.axislabels.js" type="text/javascript"></script>
        <script src="<?php echo base_url(); ?>assets_admin/global/plugins/moment.min.js" type="text/javascript"></script>

        <!--<script src="<?php echo base_url(); ?>assets_admin/global/plugins/month-picker/js/MonthPicker.min.js" type="text/javascript"></script>-->
        <!-- END CORE PLUGINS -->
        <!-- BEGIN PAGE LEVEL PLUGINS -->
        <script src="<?php echo base_url(); ?>assets_admin/global/plugins/morris/morris.min.js" type="text/javascript"></script>
        <script src="<?php echo base_url(); ?>assets_admin/global/plugins/ckeditor/ckeditor.js" type="text/javascript"></script>
        <!-- END PAGE LEVEL PLUGINS -->
        <!-- BEGIN THEME GLOBAL SCRIPTS -->
        <script src="<?php echo base_url(); ?>assets_admin/global/scripts/app.min.js" type="text/javascript"></script>
        <!-- END THEME GLOBAL SCRIPTS -->
        <!-- BEGIN PAGE LEVEL SCRIPTS -->
        <script src="<?php echo base_url(); ?>assets_admin/pages/scripts/dashboard.min.js" type="text/javascript"></script>

        <!-- END PAGE LEVEL SCRIPTS -->
        <!-- BEGIN THEME LAYOUT SCRIPTS -->
        <script src="<?php echo base_url(); ?>assets_admin/layouts/layout2/scripts/layout.min.js" type="text/javascript"></script>
        <script src="<?php echo base_url(); ?>assets_admin/layouts/layout2/scripts/demo.min.js" type="text/javascript"></script>
        <script src="<?php echo base_url(); ?>assets_admin/layouts/global/scripts/quick-sidebar.min.js" type="text/javascript"></script>
        <!-- END THEME LAYOUT SCRIPTS -->

        <!--- ***************** End Scripts ****************** ---->


        <style type="text/css">
            .jqstooltip { position: absolute;left: 0px;top: 0px;visibility: hidden;background: rgb(0, 0, 0) transparent;background-color: rgba(0,0,0,0.6);filter:progid:DXImageTransform.Microsoft.gradient(startColorstr=#99000000, endColorstr=#99000000);-ms-filter: "progid:DXImageTransform.Microsoft.gradient(startColorstr=#99000000, endColorstr=#99000000)";color: white;font: 10px arial, san serif;text-align: left;white-space: nowrap;padding: 5px;border: 1px solid white;z-index: 10000;}.jqsfield { color: white;font: 10px arial, san serif;text-align: left;}

            #image-preview {
                width: 400px;
                height: 400px;
                position: relative;
                overflow: hidden;
                background-color: #ffffff;
                background-size: cover;
                background-position: center center;
                color: #ecf0f1;
            }
            #image-preview input {
                line-height: 200px;
                font-size: 200px;
                position: absolute;
                opacity: 0;
                z-index: 10;
            }
            #image-preview span label {
                position: absolute;
                z-index: 5;
                opacity: 0.8;
                cursor: pointer;
                background-color: #bdc3c7;
                width: 200px;
                height: 50px;
                font-size: 20px;
                line-height: 50px;
                text-transform: uppercase;
                top: 0;
                left: 0;
                right: 0;
                bottom: 0;
                margin: auto;
                text-align: center;
            }

            label.error {
                color: #ff0000;
                background-color: #fff;
                border-color: #faebcc;
                padding: 10px;
                margin-top: 5px;
                margin-bottom: 40px;
                margin-right: 5px;
                border: 1px solid transparent;
                border-radius: 4px;
            }

            .form-control.error {
                border-color: #f00;
            }

            .error {
                color: #ff0000;
            }
            @media print{
                .hide_print,.btn-info{
                    display: none !important;
                }
                .portlet.box.red,.porder_hide_print,.porder_hide_print tr, .porder_hide_print tr td{
                    border: 0px !important;
                }
            }

            ul.page-sidebar-menu.page-header-fixed.page-sidebar-menu-hover-submenu{
                min-height: 1080px;
            }
        </style>
    </head>
    <!-- END HEAD -->

    <?php
    if (isset($name) && !empty($name)) {
        echo '<body class="page-header-fixed page-sidebar-closed-hide-logo page-container-bg-solid ">
        <!-- BEGIN HEADER -->
        <div class="page-header navbar navbar-fixed-top hide_print">
            <!-- BEGIN HEADER INNER -->
            <div class="page-header-inner ">
                <!-- BEGIN LOGO -->
                <div class="page-logo">
                    <a href="index">
                        <img src="' . base_url() . 'assets_admin/layouts/layout2/img/logo-default.png" alt="logo" class="logo-default"> </a>
                    <div class="menu-toggler sidebar-toggler">
                        <!-- DOC: Remove the above "hide" to enable the sidebar toggler button on header -->
                    </div>
                </div>
                <!-- END LOGO -->
                <!-- BEGIN RESPONSIVE MENU TOGGLER -->
                <a href="javascript:;" class="menu-toggler responsive-toggler" data-toggle="collapse" data-target=".navbar-collapse"> </a>
                <!-- END RESPONSIVE MENU TOGGLER -->
                <!-- BEGIN PAGE ACTIONS -->
                <!-- DOC: Remove "hide" class to enable the page header actions -->

                <!-- END PAGE ACTIONS -->
                <!-- BEGIN PAGE TOP -->
                <div class="page-top">
                    <!-- BEGIN HEADER SEARCH BOX -->
                    <!-- DOC: Apply "search-form-expanded" right after the "search-form" class to have half expanded search box -->

                    <!-- END HEADER SEARCH BOX -->
                    <!-- BEGIN TOP NAVIGATION MENU -->
                    <div class="top-menu">
                        <ul class="nav navbar-nav pull-right">
                            <li class="dropdown dropdown-user">
                                <a href="javascript:;" class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" data-close-others="true" aria-expanded="false">
                                    <span class="username username-hide-on-mobile">' . $name . '</span>
                                    <i class="fa fa-angle-down"></i>
                                </a>
                                <ul class="dropdown-menu dropdown-menu-default">

                                    <li>
                                        <a href="user">
                                            <i class="icon-user"></i> المستخدمين </a>
                                    </li>
                                    <li class="divider"> </li>
                                    <li>
                                        <a id="logout" href="logout.php">
                                            <i class="icon-key"></i> تسجيل خروج </a>
                                    </li>
                                </ul>
                            </li>
                        </ul>
                    </div>
                    <!-- END TOP NAVIGATION MENU -->
                </div>
                <!-- END PAGE TOP -->
            </div>
            <!-- END HEADER INNER -->
        </div>
        <!-- END HEADER -->
        <!-- BEGIN HEADER & CONTENT DIVIDER -->
        <div class="clearfix"> </div>
        <!-- END HEADER & CONTENT DIVIDER -->';
    }
    ?>
    
