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
                    <span>صافي الصندوق</span>
                </li>
            </ul>
        </div>
        <!-- END PAGE HEADER-->
        <!-- BEGIN DASHBOARD STATS 1-->
        <div class="row">
            <div class="col-md-12 col-md-offset-0">


                <div class="row">
                    <div class="col-md-10 col-md-offset-1">
                        <div class="form-inline margin-bottom-30" id="statistic">

                            <div class="form-inline">
                                <label for="statistic_date_from" class="col-md-2 control-labeli">من تاريخ</label>
                                <div class="col-md-4">
                                    <input type="date" class="form-control monthpicker" id="statistic_date_from" name="statistic_date_from">
                                </div>
                            </div>
                            <div class="form-inline">
                                <label for="statistic_date_to" class="col-md-2 control-labeli">إلى تاريخ</label>
                                <div class="col-md-4">
                                    <input type="date" class="form-control monthpicker" id="statistic_date_to" name="statistic_date_to" >
                                </div>
                            </div>
                            <div class="clearfix"></div>
                            <hr>

                            <div class="form-group">
                                <div class="col-md-2 col-md-offset-5">
                                    <button type="submit" id="ok" class="btn green">استعلام</button>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="clearfix"></div>
                <!-- END DASHBOARD STATS 1-->
                <div class="portlet box blue">
                    <div class="portlet-title">
                        <div class="caption">
                            <i class="fa fa-comments"></i>الصندوق</div>
                        <div class="tools">
                            <a href="javascript:;" class="collapse" data-original-title="" title=""> </a>
                            <a href="#portlet-config" data-toggle="modal" class="config" data-original-title="" title=""> </a>
                            <a href="javascript:;" class="reload" data-original-title="" title=""> </a>
                            <a href="javascript:;" class="remove" data-original-title="" title=""> </a>
                        </div>
                    </div>
                    <div class="portlet-body" style="display: block;">
                        <div class="container-fluid">
                            <div class="row">
                                <div class="thumbnail circle col-md-2 col-sm-offset-1 "> 
                                    <div class="center-block align-center text-center"> <h4>إجمالي الفواتير: <strong> <span id="statistic_consum_report" class="font-lg FontBig">  </span> </strong></h4> <div> 
                                        </div>
                                    </div>
                                </div>
                                <div class="thumbnail circle col-md-2 col-sm-offset-1"> 
                                    <div class="center-block align-center text-center"> <h4>المدفوع: <span id="statistic_paid_report" class="font-lg font-green">  </span> </h4> <div> 
                                        </div>
                                    </div>
                                </div>
                                <div class="thumbnail circle col-md-2 col-sm-offset-1"> 
                                    <div class="center-block align-center text-center"> <h4>المتبقي: <span id="statistic_reminder_report" class="font-lg font-red-flamingo">  </span> </h4> <div> 
                                        </div>
                                    </div>
                                </div>
                                <div class="thumbnail circle col-md-2 col-sm-offset-1"> 
                                    <div class="center-block align-center text-center"> <h4>خصومات: <span id="statistic_discount_report" class="font-lg font-purple">  </span> </h4> <div> 
                                        </div>
                                    </div>
                                </div>
                                <div class="thumbnail circle col-md-2 col-sm-offset-1 "> 
                                    <div class="center-block align-center text-center"> <h4>إجمالي الصندوق: <strong> <span id="statistic_box_value" class="font-lg FontBig">  </span> </strong></h4> <div> 
                                        </div>
                                    </div>
                                </div>
                                <div class="clearfix"></div>
                                <div class="thumbnail col-md-10 col-sm-offset-1 "> 
                                    <div class="center-block align-center font-yellow-casablanca "> <h4>صافي الصندوق بعد تحصيل جميع الرسوم: <strong> <span id="box_value" class="font-lg FontBig">  </span> </strong></h4> <div> 
                                        </div>
                                    </div>
                                </div>
                                <div class="clearfix"></div>
                                <div class="thumbnail col-md-10 col-sm-offset-1 "> 
                                    <div class="center-block align-center font-red "> <h4>صافي الصندوق بدون المبلغ المتبقي: <strong> <span id="box_value_without_reminder" class="font-lg FontBig">  </span> </strong></h4> <div> 
                                        </div>
                                    </div>
                                </div>
                                <div class="clearfix"></div>
                                <div class="thumbnail col-md-10 col-sm-offset-1 "> 
                                    <div class="center-block align-center font-blue-steel"> <h4>صافي الصندوق بدون المبلغ المخصوم: <strong> <span id="box_value_without_discount" class="font-lg FontBig">  </span> </strong></h4> <div> 
                                        </div>
                                    </div>
                                </div>
                                <div class="clearfix"></div>
                                <div class="thumbnail col-md-10 col-sm-offset-1 "> 
                                    <div class="center-block align-center font-green"> <h4>صافي الصندوق بدون المبلغ المخصوم والمبلغ المتبقي (الحالي): <strong> <span id="box_current_value" class="font-lg FontBig">  </span> </strong></h4> <div> 
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
            <!-- END CONTENT BODY -->
        </div>
        <!-- END CONTENT -->
    </div>
    <!-- END CONTAINER -->
    <script>
        $(document).ready(function () {

            window.onload = function () {
            //    region_get_all();
               statistic_get_sum($('#statistic_date_from').val(), $('#statistic_date_to').val(), -1, -1);
            };
            var bill_total = 0;
            var bill_paid = 0;
            var bill_reminder = 0;
            var bill_discount = 0;
            var box_value = 0;

            statistic_get_sum = function (statistic_date_from, statistic_date_to, statistic_region, statistic_street) {
                $.ajax({
                    url: '<?php echo base_url(); ?>main/statistic_get_sum',
                    type: 'post',
                    data: {statistic_date_from: statistic_date_from, statistic_date_to: statistic_date_to, statistic_region: statistic_region, statistic_street: statistic_street},
                    success: function (data) {
                        arrs = JSON.parse(data);

                        if (arrs['status'] !== 'error')
                        {

                            $.each(arrs, function (Index, Entry) {
								
								
								
                                $('#statistic_consum_report').html(parseFloat(Entry.bill_total).toFixed(2));
                                $('#statistic_paid_report').html(parseFloat(Entry.bill_paid).toFixed(2));
                                $('#statistic_reminder_report').html(parseFloat(Entry.bill_reminder).toFixed(2));
                                $('#statistic_discount_report').html(parseFloat(Entry.bill_discount).toFixed(2));
                                bill_total = Entry.bill_total;
                                bill_paid = Entry.bill_paid;
                                bill_reminder = Entry.bill_reminder;
                                bill_discount = Entry.bill_discount;
                            });

                            statistic_box_get_sum(statistic_date_from, statistic_date_to);

                        } else {
                            // swal("Opps", arrs['msg'], "info");
                        }
                    }


                });
            };
            statistic_box_get_sum = function (statistic_date_from, statistic_date_to) {
                $.ajax({
                    url: '<?php echo base_url(); ?>main/statistic_box_get_sum',
                    type: 'post',
                    data: {statistic_date_from: statistic_date_from, statistic_date_to: statistic_date_to},
                    success: function (data) {
                        arrs = JSON.parse(data);

                        if (arrs['status'] !== 'error')
                        {

                            $.each(arrs, function (Index, Entry) {
                                box_value =  Entry.box_value == '' ? 0 : Entry.box_value ;
                                $('#statistic_box_value').html(box_value);
                                
                            });

                            $('#box_value').html((parseFloat(bill_total) + parseFloat(box_value)).toFixed(2));
                            $('#box_value_without_reminder').html(((parseFloat(bill_total) - parseFloat(bill_reminder)) + parseFloat(box_value)).toFixed(2));
                            $('#box_value_without_discount').html(((parseFloat(bill_total) - parseFloat(bill_discount)) + parseFloat(box_value)).toFixed(2));
                            $('#box_current_value').html(((parseFloat(bill_total) - parseFloat(bill_discount) - parseFloat(bill_reminder)) + parseFloat(box_value)).toFixed(2));

                        } else {
                            // swal("Opps", arrs['msg'], "info");
                        }
                    }


                });
            };

            $('#ok').on('click', function () {
                statistic_get_sum($('#statistic_date_from').val(), $('#statistic_date_to').val(), -1, -1);
            });





        });

    </script>