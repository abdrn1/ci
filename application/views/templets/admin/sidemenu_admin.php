<?php
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
?>

<!-- BEGIN CONTAINER -->
<div class="page-container">
    <!-- BEGIN SIDEBAR -->
    <div class="page-sidebar-wrapper">
        <!-- END SIDEBAR -->
        <!-- DOC: Set data-auto-scroll="false" to disable the sidebar from auto scrolling/focusing -->
        <!-- DOC: Change data-auto-speed="200" to adjust the sub menu slide up/down speed -->
        <div class="page-sidebar navbar-collapse collapse">
            <!-- BEGIN SIDEBAR MENU -->
            <!-- DOC: Apply "page-sidebar-menu-light" class right after "page-sidebar-menu" to enable light sidebar menu style(without borders) -->
            <!-- DOC: Apply "page-sidebar-menu-hover-submenu" class right after "page-sidebar-menu" to enable hoverable(hover vs accordion) sub menu mode -->
            <!-- DOC: Apply "page-sidebar-menu-closed" class right after "page-sidebar-menu" to collapse("page-sidebar-closed" class must be applied to the body element) the sidebar sub menu mode -->
            <!-- DOC: Set data-auto-scroll="false" to disable the sidebar from auto scrolling/focusing -->
            <!-- DOC: Set data-keep-expand="true" to keep the submenues expanded -->
            <!-- DOC: Set data-auto-speed="200" to adjust the sub menu slide up/down speed -->
            <ul class="page-sidebar-menu  page-header-fixed page-sidebar-menu-hover-submenu " data-keep-expanded="false" data-auto-scroll="true" data-slide-speed="200">
                <li class="nav-item start <?php
                if (isset($page)) {
                    if ($page == 'period_new') {
                        echo 'active';
                    }
                }
                ?>">
                    <a href="period_new" class="nav-link ">
                        <i class="icon-speedometer"></i>
                        <span class="title">الدورات إدخال مبسط</span>
                        <span class="arrow"></span>
                    </a>
                </li>
                <li class="nav-item  <?php
                if (isset($page)) {
                    if ($page == 'customer_cost') {
                        echo 'active';
                    }
                }
                ?>">
                    <a href="customer_cost" class="nav-link ">
                        <i class="fa fa-dollar"></i>
                        <span class="title">إضافة رسوم على الفاتورة</span>
                        <span class="arrow"></span>
                    </a>
                </li>
                <li class="nav-item  <?php
                if (isset($page)) {
                    if ($page == 'customer_bill') {
                        echo 'active';
                    }
                }
                ?>">
                    <a href="customer_bill" class="nav-link ">
                        <i class="fa fa-dollar"></i>
                        <span class="title">كشف الفواتير</span>
                        <span class="arrow"></span>
                    </a>
                </li>

                <li class="nav-item  <?php
                if (isset($page)) {
                    if ($page == 'billquery') {
                        echo 'active';
                    }
                }
                ?>">
                    <a href="billquery" class="nav-link ">
                    <i class="fa fa-print" aria-hidden="true"></i>
                        <span class="title">طباعةالفواتير </span>
                        <span class="arrow"></span>
                    </a>
                </li>

                <li class="nav-item  <?php
                if (isset($page)) {
                    if ($page == 'billquerydept') {
                        echo 'active';
                    }
                }
                ?>">
                    <a href="billquerydept" class="nav-link ">
                    <i class="fa fa-print" aria-hidden="true"></i>
                        <span class="title">أرصدة الزبائن</span>
                        <span class="arrow"></span>
                    </a>
                </li>


                <li class="nav-item start  <?php
                if (isset($page)) {
                    if ($page == 'period') {
                        echo 'active';
                    }
                }
                ?>">
                    <a href="period" class="nav-link ">
                        <i class="icon-calendar"></i>
                        <span class="title">الدورات</span>
                        <span class="arrow"></span>
                    </a>
                </li>
                <li class="nav-item  <?php
                if (isset($page)) {
                    if ($page == 'customer') {
                        echo 'active';
                    }
                }
                ?>">
                    <a href="customer" class="nav-link ">
                        <i class="icon-user-follow"></i>
                        <span class="title">المشتركين</span>
                        <span class="arrow"></span>
                    </a>
                </li>
                <li class="nav-item <?php
                if (isset($page)) {
                    if ($page == 'bill') {
                        echo 'active';
                    }
                }
                ?>">
                    <a href="bill" class="nav-link">
                        <i class="fa fa-money"></i>
                        <span class="title">الفواتير</span>
                        <span class="arrow"></span>
                    </a>
                </li>
                <li class="nav-item <?php
                if (isset($page)) {
                    if ($page == 'payment_list') {
                        echo 'active';
                    }
                }
                ?>">
                    <a href="payment_list" class="nav-link">
                        <i class="fa fa-money"></i>
                        <span class="title">كشف الدفعات</span>
                        <span class="arrow"></span>
                    </a>
                </li>
                <li class="nav-item  <?php
                if (isset($page)) {
                    if ($page == 'statistic') {
                        echo 'active';
                    }
                }
                ?>">
                    <a href="statistic" class="nav-link">
                        <i class="fa fa-circle-o"></i>
                        <span class="title">إحصائيات</span>
                        <span class="arrow"></span>
                    </a>
                </li>
                <li class="nav-item  <?php
                if (isset($page)) {
                    if ($page == 'sms') {
                        echo 'active';
                    }
                }
                ?>">
                    <a href="sms" class="nav-link">
                        <i class="fa fa-circle-o"></i>
                        <span class="title">الرسائل</span>
                        <span class="arrow"></span>
                    </a>
                </li>
                <?php $period_consum = array("1" => "period_consum", "2" => "period_collect_money", "3" => "period_note", "4" => "period_customer_list"); ?>
                <li class="nav-item  <?php
                if (isset($page)) {
                    if (array_search($page, $period_consum)) {
                        echo 'active';
                    }
                }
                ?>">
                    <a href="javascript:;" class="nav-link nav-toggle">
                        <i class="icon-list"></i>
                        <span class="title">الكشوفات</span>
                        <span class="arrow "></span>
                    </a>
                    <ul class="sub-menu">
                        <li class="nav-item  <?php
                        if (isset($page)) {
                            if ($page == 'period_consum') {
                                echo 'active';
                            }
                        }
                        ?>">
                            <a href="period_consum" class="nav-link">
                                <i class="fa fa-circle-o"></i>
                                <span class="title">كشف قراءة عدادات المشتركين</span>
                                <span class="arrow"></span>
                            </a>
                        </li>
                        <li class="nav-item  <?php
                        if (isset($page)) {
                            if ($page == 'period_collect_money') {
                                echo 'active';
                            }
                        }
                        ?>">
                            <a href="period_collect_money" class="nav-link">
                                <i class="fa fa-circle-o"></i>
                                <span class="title">كشف التحصيل</span>
                                <span class="arrow"></span>
                            </a>
                        </li>
                        <li class="nav-item  <?php
                        if (isset($page)) {
                            if ($page == 'period_note') {
                                echo 'active';
                            }
                        }
                        ?>">
                            <a href="period_note" class="nav-link">
                                <i class="fa fa-circle-o"></i>
                                <span class="title">كشف الملاحظات</span>
                                <span class="arrow"></span>
                            </a>
                        </li>
                        <li class="nav-item  <?php
                        if (isset($page)) {
                            if ($page == 'period_customer_list') {
                                echo 'active';
                            }
                        }
                        ?>">
                            <a href="period_customer_list" class="nav-link">
                                <i class="fa fa-circle-o"></i>
                                <span class="title">كشف المشتركين</span>
                                <span class="arrow"></span>
                            </a>
                        </li>
                    </ul>
                </li>
                <?php $general = array("1" => "customer_order", "2" => "region", "3" => "street", "4" => "price"); ?>
                <li class="nav-item  <?php
                if (isset($page)) {
                    if (array_search($page, $general)) {
                        echo 'active';
                    }
                }
                ?>">
                    <a href="javascript:;" class="nav-link nav-toggle">
                        <i class="icon-folder"></i>
                        <span class="title">عام</span>
                        <span class="arrow "></span>
                    </a>
                    <ul class="sub-menu">
                        <li class="nav-item  <?php
                        if (isset($page)) {
                            if ($page == 'customer_order') {
                                echo 'active';
                            }
                        }
                        ?>">
                            <a href="customer_order" class="nav-link ">
                                <i class="fa fa-compass" aria-hidden="true">&nbsp; ترتيب المشتركين</i>
                            </a>
                        </li>
                        <li class="nav-item  <?php
                        if (isset($page)) {
                            if ($page == 'region') {
                                echo 'active';
                            }
                        }
                        ?>">
                            <a href="region" class="nav-link ">
                                <i class="fa fa-compass" aria-hidden="true">&nbsp; المناطق</i>
                            </a>

                        </li>

                        <li class="nav-item  <?php
                        if (isset($page)) {
                            if ($page == 'employee') {
                                echo 'active';
                            }
                        }
                        ?>">
                            <a href="employee" class="nav-link ">
                                <i class="fa fa-compass" aria-hidden="true">&nbsp; الموظفين</i>
                            </a>

                        </li>


                        <li class="nav-item  <?php
                        if (isset($page)) {
                            if ($page == 'street') {
                                echo 'active';
                            }
                        }
                        ?>">
                            <a href="street" class="nav-link ">
                                <i class="fa fa-road" aria-hidden="true">&nbsp; الشوارع</i>
                            </a>
                        </li>
                        <li class="nav-item  <?php
                        if (isset($page)) {
                            if ($page == 'price') {
                                echo 'active';
                            }
                        }
                        ?>">
                            <a href="price" class="nav-link ">
                                <i class="fa fa-money" aria-hidden="true">&nbsp; السعر والاعدادات</i>
                            </a>
                        </li>
                    </ul>  
                </li>
                <?php $box = array("1" => "box_type", "2" => "box_respective", "3" => "box", "4" => "box_report","5" => "box_statistic"); ?>
                <li class="nav-item  <?php if (isset($page)) {
                    if (array_search($page, $box)) {
                        echo 'active';
                    }
                } ?>">
                    <a href="javascript:;" class="nav-link nav-toggle">
                        <i class="icon-bag"></i>
                        <span class="title">الصندوق</span>
                        <span class="arrow "></span>
                    </a>
                    <ul class="sub-menu">
                        <li class="nav-item  <?php if (isset($page)) {
                    if ($page == 'box_type') {
                        echo 'active';
                    }
                } ?>">
                            <a href="box_type" class="nav-link ">
                                <i class="fa fa-compass" aria-hidden="true">&nbsp;  نوع الصندوق</i>
                            </a>
                        </li>
                        <li class="nav-item  <?php if (isset($page)) {
                    if ($page == 'box_respective') {
                        echo 'active';
                    }
                } ?>">
                            <a href="box_respective" class="nav-link ">
                                <i class="fa fa-compass" aria-hidden="true">&nbsp; صاحب الصندوق</i>
                            </a>

                        </li>
                        <li class="nav-item  <?php if (isset($page)) {
                    if ($page == 'box') {
                        echo 'active';
                    }
                } ?>">
                            <a href="box" class="nav-link ">
                                <i class="fa fa-road" aria-hidden="true">&nbsp; الصندوق</i>
                            </a>
                        </li>
                        <li class="nav-item  <?php if (isset($page)) {
                    if ($page == 'box_rebort') {
                        echo 'active';
                    }
                } ?>">
                            <a href="box_report" class="nav-link ">
                                <i class="fa fa-money" aria-hidden="true">&nbsp; تقرير</i>
                            </a>
                        </li>
                        <li class="nav-item  <?php if (isset($page)) {
                    if ($page == 'box_statistic') {
                        echo 'active';
                    }
                } ?>">
                            <a href="box_statistic" class="nav-link ">
                                <i class="fa fa-money" aria-hidden="true">&nbsp; صافي الصندوق</i>
                            </a>
                        </li>
                    </ul>
                </li>
            </ul>

            <!-- END SIDEBAR MENU -->
        </div>
        <!-- END SIDEBAR -->
    </div>
    <!-- END SIDEBAR -->
    <!-- BEGIN CONTENT -->