<?php
//if ($_FILES) {
//    $name = $_FILES['image']['name'];
//    move_uploaded_file($_FILES['image']['tmp_name'], $name);
//    echo "Uploaded image '$name'<br><img src='$name'>";
//}
?>




<!-- BEGIN CONTENT -->
<div class="page-content-wrapper">
    <!-- BEGIN CONTENT BODY -->
    <div class="page-content" style="min-height:265px">
        <!-- BEGIN PAGE HEADER-->
        <div class="hide_print">
            <h3 class="font-red-flamingo page-title">  لوحة التحكم 

            </h3>
            <div class="page-bar">
                <ul class="page-breadcrumb">
                    <li>
                        <i class="icon-home"></i>
                        <a href="index">الرئيسة</a>
                        <i class="fa fa-angle-left"></i>
                    </li>
                    <li>
                        <span>كشف الفواتير</span>
                    </li>
                </ul>
            </div>
            <!-- END PAGE HEADER-->
            <!-- BEGIN DASHBOARD STATS 1-->
        </div>
        <div class="row hide_print">
            <div class="col-md-10 col-md-offset-1">
                <form class="form-inline margin-bottom-30" role="form" method="post" action="" id="period" enctype="multipart/form-data">

                    <div class="form-inline">
                        <label for="period_customer" class="hide_print col-md-2 control-labeli">المشترك</label>
                        <div class="col-md-4">
                            <select class="form-control hide_print" data-live-search="true" id="customer_bill_customer">
                                <option id="">اختر مشترك</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-inline">
                        <label for="bill_period" class="hide_print col-md-2 control-labeli">الدورة</label>
                        <div class="col-md-4">
                            <select class="form-control hide_print" id="bill_period">
                                <option id="period_-1">اختر دورة</option>
                            </select>
                        </div>
                    </div>

                </form>
            </div>
        </div>