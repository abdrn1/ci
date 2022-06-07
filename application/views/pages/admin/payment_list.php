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
                        <span>كشف دفعات</span>
                    </li>
                </ul>
            </div>
            <!-- END PAGE HEADER-->
            <!-- BEGIN DASHBOARD STATS 1-->
        </div>
        <div class="row hide_print">
            <div class="col-md-10 col-md-offset-1">
                <form class="form-inline margin-bottom-30" role="form" method="post" action="" id="payment_list_table" enctype="multipart/form-data">

                    <div class="form-inline">
                        <label for="payment_date" class="col-md-2 control-labeli">تاريخ بداية الدفعات</label>
                        <div class="col-md-4">
                            <input type="date" class="form-control" id="payment_list_date" name="payment_date">
                        </div>
                        <label for="payment_list_end_date" class="col-md-2 control-labeli">تاريخ نهاية الدفعات</label>
                        <div class="col-md-4">
                            <input type="date" class="form-control" id="payment_list_end_date" name="payment_date_end">
                        </div>
                    </div>

                   <div class="col-md-12"></div>

                    <div class="form-inline">
                        <label for="period_region" class="col-md-2 control-labeli">المنطقة</label>
                        <div class="col-md-4">
                            <select class="form-control" id="period_region">
                                <option id="region_-1">اختر منطقة</option>
                            </select>
                        </div>
                        <label for="period_street" class="col-md-2 control-labeli">الشارع</label>
                        <div class="col-md-4">
                            <select class="form-control" id="period_street">
                                <option id="region_-1">اختر شارع</option>
                            </select>
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="col-md-2 col-md-offset-5">
                            <button type="submit" id="payment_list_ok" class="btn green">استعلام</button>

                        </div>
                    </div>
                    <br>
                    <hr>
                    <div class="alert alert-success">مجموع الدفعات: <strong id="payment_total">  </strong></div>
                    <div class="alert alert-info">مجموع الخصومات: <strong id="payment_total_discount">  </strong></div>
                    <hr>
                    <br>

                </form>
            </div>
        </div>
        <div class="clearfix"></div>
        <br>
        <!-- END DASHBOARD STATS 1-->
        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                <img class="loadingimg center-block" src="<?php echo base_url(); ?>assets_admin/global/img/loadingn" alt="جاري التحميل"/>                                   
                <div class="loadingsection portlet box red">
                    <div class="portlet-title">
                        <div class="caption">
                            <i class="fa fa-comments"></i>جدول الدفعات</div>
                        <div class="tools">
                            <a href="javascript:;" class="collapse" data-original-title="" title=""> </a>
                            <a href="#portlet-config" data-toggle="modal" class="config" data-original-title="" title=""> </a>
                            <a href="javascript:;" class="reload" data-original-title="" title=""> </a>
                            <a href="javascript:;" class="remove" data-original-title="" title=""> </a>
                        </div>
                    </div>
                    <div class="portlet-body" style="display: block;">
                        <div id="customer_name_title" style="font-size: 20px;padding: 10px;"></div>
                        <table class="table table-striped table-hover table-bordered" id="payment_list_table">
                            <thead>
                                <tr>
                                    <th> # </th>
                                    <th>اسم المشترك</th>
                                    <th>المبلغ</th>
                                    <th>الخصم</th>
                                    <th>ملاحظة</th>                      
                                    <th>التاريخ</th>                      
                                </tr>
                            </thead>
                            <tbody>

                            </tbody>
                        </table>
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

        var d = new Date();
        mon = d.getMonth() + 1;
        month = mon < 10 ? '0' + mon : mon;
        year = d.getFullYear();
        dy = d.getDate();
        day = dy < 10 ? '0' + dy : dy;
        var fullMonth = year + '-' + month;
        var fullDate = fullMonth + '-' + day;
        window.onload = function () {
            $('#payment_list_date').val(fullDate);
            region_get_all();
        };

        get_payment_list = function (payment_list_date,payment_list_end_date,bill_region,bill_street) {
            $.ajax({
                url: '<?php echo base_url(); ?>main/get_payment_list',
                type: 'post',
                data: {payment_list_date: payment_list_date,payment_list_end_date:payment_list_end_date,bill_region:bill_region,bill_street:bill_street},
                success: function (data) {

                    arrs = JSON.parse(data);
                    var payment_total = 0;
                    var payment_total_discount = 0;
                    if (arrs['status'] !== 'error')
                    {
                        html = '';
                        count = 1;
                        $.each(arrs, function (Index, Entry) {
                            html += '<tr>';
                            html += '<td>' + count++ + '</td>';
                            html += '<td>' + Entry.customer_name + '</td>';
                            html += '<td>' + Entry.payment_value + '</td>';
                            html += '<td>' + Entry.payment_discount + '</td>';
                            html += '<td>' + Entry.payment_note + '</td>';
                            html += '<td>' + Entry.payment_date + '</td>';
                            html += '</tr>';
                            payment_total += parseFloat(Entry.payment_value);
                            payment_total_discount += parseFloat(Entry.payment_discount);
                        });
                        $('#payment_list_table tbody').html(html);
                        $('#payment_total').html(payment_total);
                        $('#payment_total_discount').html(payment_total_discount);
                        $('.loadingimg').hide();
                        $('.loadingsection').show();

                    } else {
                        $('#payment_list_table tbody').html('');
                        $('#payment_total').html('');
                        $('#payment_total_discount').html('');
                        swal("Opps,", arrs['msg'], "info");
                        $('.loadingimg').hide();
                        $('.loadingsection').show();
                    }
                }


            });
        };

        region_get_all = function () {
            $.ajax({
                url: '<?php echo base_url(); ?>main/region_get_all',
                type: 'post',
                success: function (data) {
                    arrs = JSON.parse(data);
                    if (arrs['status'] !== 'error')
                    {
                        var html = '<option id="region_-1"> اختار منطقة </div>';
                        $.each(arrs, function (Index, Entry) {
                            html += '<option id="' + ('region_').concat(Entry.region_id) + '">';
                            html += Entry.region_name;
                            html += '</option>';
                        });
                        $('#period_region').html(html);
                    } else {

                        swal("Opps", arrs['msg'], "info");
                    }
                }


            });
        };


        $('#period_region').change(function () {

            street_get_all_by_region($(this).children("option:selected").prop('id').split('_').pop());

        });

        street_get_all_by_region = function (street_region) {
            $.ajax({
                url: '<?php echo base_url(); ?>main/street_get_all_by_region',
                type: 'post',
                data: {street_region: street_region},
                success: function (data) {
                    arrs = JSON.parse(data);
                    if (arrs['status'] !== 'error')
                    {
                        var html = '<option id="street_-1">اختر شارع</div>';
                        $.each(arrs, function (Index, Entry) {
                            html += '<option id="' + ('street_').concat(Entry.street_id) + '">';
                            html += Entry.street_name;
                            html += '</option>';
                        });
                        $('#period_street').html(html);
                    } else {

                        //  swal("Opps", arrs['msg'], "info");
                    }
                }


            });
        };

        $('#payment_list_ok').on('click', function (e) {
            e.preventDefault();
            $('.loadingimg').show();
            $('.loadingsection').hide();
            $('#payment_total').html('');
            $('#payment_total_discount').html('');
            get_payment_list($('#payment_list_date').val(),$('#payment_list_end_date').val(),$("#period_region").children("option:selected").prop('id').split('_').pop(),$("#period_street").children("option:selected").prop('id').split('_').pop());
        });

    });

</script>