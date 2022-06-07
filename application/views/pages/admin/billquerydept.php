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
        <h3 class="font-red-flamingo page-title"> لوحة التحكم

        </h3>
        <div class="page-bar">
            <ul class="page-breadcrumb">
                <li>
                    <i class="icon-home"></i>
                    <a href="index">الرئيسة</a>
                    <i class="fa fa-angle-left"></i>
                </li>
                <li>
                    <span>أرصدة الزبائن</span>
                </li>
            </ul>
        </div>
        <!-- END PAGE HEADER-->
        <!-- BEGIN DASHBOARD STATS 1-->
        <div class="row">
            <div class="col-md-12 col-md-offset-0">
                <div class="hide portlet box blue">
                    <div class="portlet-title">
                        <div class="caption">
                            <i class="fa fa-comments"></i>إحصائيات
                        </div>
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
                                    <div class="center-block align-center text-center">
                                        <h4>الإستهلاك: <span id="bill_consum_report" class="font-lg font-blue-soft"> </span> </h4>
                                        <div>
                                        </div>
                                    </div>
                                </div>
                                <div class="thumbnail circle col-md-2 col-sm-offset-1">
                                    <div class="center-block align-center text-center">
                                        <h4>المدفوع: <span id="bill_paid_report" class="font-lg font-blue-soft"> </span> </h4>
                                        <div>
                                        </div>
                                    </div>
                                </div>
                                <div class="thumbnail circle col-md-2 col-sm-offset-1">
                                    <div class="center-block align-center text-center">
                                        <h4>المتبقي: <span id="bill_reminder_report" class="font-lg font-blue-soft"> </span> </h4>
                                        <div>
                                        </div>
                                    </div>
                                </div>
                                <div class="thumbnail circle col-md-2 col-sm-offset-1">
                                    <div class="center-block align-center text-center">
                                        <h4>خصومات: <span id="bill_discount_report" class="font-lg font-blue-soft"> </span> </h4>
                                        <div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row">

                    <div class="col-md-10 col-md-offset-1">

                        <div class="form-group">
                            <div class="col-md-2">
                                <label class="control-label">الزبون</label>
                            </div>
                            <div class="col-md-4">
                                <select class="form-control hide_print" data-live-search="true" id="customer_bill_customer">
                                    <option id="customer_-1">اختر مشترك</option>
                                </select>
                            </div>
                            <div class="form-inline margin-bottom-30" id="bill">

                                <!--                            <div class="form-inline">
                                <label for="bill_date" class="col-md-2 control-labeli">دورة شهر</label>
                                <div class="col-md-4">
                                    <input type="month" class="form-control monthpicker" id="bill_date" name="bill_date" placeholder="اسم المشترك">
                                </div>
                            </div>
                            <hr>                           
                            <div class="clearfix"></div>-->




                                <div class="clearfix"></div>
                                <hr>




                                <div class="form-inline">
                                    <label for="bill_region" class="col-md-2 control-labeli">المنطقة</label>
                                    <div class="col-md-4">
                                        <select class="form-control" id="bill_region">
                                            <option id="region_-1">اختر منطقة</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-inline">
                                    <label for="bill_street" class="col-md-2 control-labeli">الشارع</label>
                                    <div class="col-md-4">
                                        <select class="form-control" id="bill_street">
                                            <option id="street_-1">اختر شارع</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="clearfix"></div>
                                <hr>
                                <div>
                                    <div class="form-group row">
                                        <label for="staticEmail" class="col-sm-2 col-form-label">الرصيد ابتداء</label>
                                        <div class="col-sm-10">
                                            <input type="number" value="0"  class="form-control" id="credit_from" name="credit_from" >
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="inputPassword" class="col-sm-2 col-form-label">الرصيد انتهاء</label>
                                        <div class="col-sm-10">
                                            <input type="number" class="form-control" id="credit_to" name="credit_to" >
                                        </div>
                                    </div>
                                </div>

                                <!--                                <div class="form-group">
                                                                <div class="display center-block center-align">
                                                                    <button type="submit" id="print_report" class="btn blue">طباعة</button>
                                                                </div>
                                                            </div>-->

                                <div class="clearfix"></div>
                                <hr>

                                <!-- <div class="row">


                                    <label for="bill_date_from" class="col-md-2 control-labeli">الرصيد ابتداء</label>
                                    <div class="col-md-3">
                                        <input type="number" class="form-control" id="bill_date_from" name="bill_sum_from">
                                    </div>

                                    <div class="col-md-2">
                                        <label for="bill_date_to" class="col-md-2 control-labeli"> الرصيد حتى</label>
                                    </div>
                                    <div class="col-md-2">

                                        <input type="number" class="form-control" id="bill_date_to" name="bill_sum_to">
                                    </div>

                                </div> -->
                                <hr>
                                <div class="clearfix"></div>
                                <input type="hidden" name="bill_id" value="-1" id="bill_id" />


                                <button id="btn_query" class="btn btn-primary">بحث</button>
                                <a id=btn_print href="#" class="btn btn-success">طـباعة</a>


                            </div>
                        </div>
                    </div>
                    <div class="clearfix"></div>
                    <!-- END DASHBOARD STATS 1-->
                    <div class="row">
                        <div class="col-md-12 col-md-offset-0">
                            <img class="loadingimg center-block" src="<?php echo base_url(); ?>assets_admin/global/img/loadingn.gif" alt="جاري التحميل" />
                            <div class="loadingsection portlet box red">
                                <div class="portlet-title">
                                    <div class="caption">
                                        <i class="fa fa-comments"></i>جدول الفواتير
                                    </div>
                                    <div class="tools">

                                        <a href="javascript:;" class="collapse" data-original-title="" title=""> </a>
                                        <a href="#portlet-config" data-toggle="modal" class="config" data-original-title="" title=""> </a>
                                        <a href="javascript:;" class="reload" data-original-title="" title=""> </a>
                                        <a href="javascript:;" class="remove" data-original-title="" title=""> </a>
                                    </div>
                                </div>
                                <div class="portlet-body" style="display: block;">
                                    <label>عدد السجلات : </label>
                                    <label id="records_count">0</label>
                                    <table class="table table-striped table-hover table-bordered" id="table_query_result">
                                        <thead>
                                            <tr>
                                                <th> # </th>
                                                <th>اسم المشترك</th>
                                                <th>اسم المنطقة</th>
                                                <th>اسم الشارع</th>
                                               
                                                <th>الرصيد</th>

                                            </tr>
                                        </thead>
                                        <tbody>

                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>



                    <!-- Modal -->
                    <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-lg" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">الدفعات</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <div class="container-fluid">
                                        <div class="row">
                                            <form class="form-inline margin-bottom-30" role="form" method="post" action="" id="payment" enctype="multipart/form-data">

                                                <div class="form-inline">
                                                    <label for="payment_value" class="col-md-2 control-labeli">المبلغ للدفع</label>
                                                    <div class="col-md-4">
                                                        <input type="text" class="form-control" id="payment_value" name="payment_value" placeholder="المبلغ" />
                                                    </div>
                                                </div>
                                                <div class="form-inline">
                                                    <label for="payment_discount" class="col-md-2 control-labeli">مبلغ الخصم</label>
                                                    <div class="col-md-4">
                                                        <input type="text" class="form-control" id="payment_discount" name="payment_discount" placeholder="المبلغ" />
                                                    </div>
                                                </div>
                                                <div class="clearfix">
                                                </div>
                                                <br>
                                                <div class="form-inline">
                                                    <label for="payment_reminder" class="col-md-2 control-labeli">المبلغ المتبقي</label>
                                                    <div class="col-md-4">
                                                        <input type="text" class="form-control" disabled id="payment_reminder" name="payment_reminder" placeholder="المبلغ المتبقي">
                                                    </div>
                                                </div>

                                                <div class="form-inline">
                                                    <label for="payment_note" class="col-md-2 control-labeli">ملاحظة</label>
                                                    <div class="col-md-4">
                                                        <input type="text" class="form-control" id="payment_note" name="payment_note" placeholder="ملاحظة">
                                                    </div>
                                                </div>

                                                <input type="hidden" name="payment_id" value="-1" id="payment_id" />
                                                <div class="clearfix">
                                                </div>
                                                <br>
                                                <div class="form-group">
                                                    <div class="col-md-offset-2 col-md-10">
                                                        <button type="submit" id="save" action="add" class="btn blue">حفظ</button>
                                                    </div>
                                                </div>

                                            </form>
                                            <div class="clearfix"></div>
                                            <!--                                            <div class="form-group">
                                                                                        <div class="col-md-offset-5 col-md-2">
                                                                                            <button type="submit" id="print_report" class="btn blue">طباعة</button>
                                                                                        </div>
                                                                                    </div>-->
                                            <div class="clearfix"></div>
                                            <!-- END DASHBOARD STATS 1-->
                                            <div class="row">
                                                <div id="payment_debt" class="col-md-10 col-md-offset-1"></div>
                                                <div class="col-md-10 col-md-offset-1">
                                                    <div class="portlet box red">
                                                        <div class="portlet-title">
                                                            <div class="caption">
                                                                <i class="fa fa-comments"></i>جدول الدفعات
                                                            </div>
                                                            <div class="tools">
                                                                <a href="javascript:;" class="collapse" data-original-title="" title=""> </a>
                                                                <a href="#portlet-config" data-toggle="modal" class="config" data-original-title="" title=""> </a>
                                                                <a href="javascript:;" class="reload" data-original-title="" title=""> </a>
                                                                <a href="javascript:;" class="remove" data-original-title="" title=""> </a>
                                                            </div>
                                                        </div>
                                                        <div class="portlet-body" style="display: block;">
                                                            <table class="table table-striped table-hover table-bordered" id="payment_table">
                                                                <thead>
                                                                    <tr>
                                                                        <th> # </th>
                                                                        <th>قيمة الدفعة</th>
                                                                        <th>قيمة الخصم</th>
                                                                        <th>التاريخ</th>
                                                                        <th>ملاحظة</th>
                                                                        <th>حذف</th>
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
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
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
            $(document).ready(function() {




                var table;
                var bill_id;
                var payment_row_id = -1;
                var customer_id;
                var ArrayToPrint;
                mon = new Date().getMonth() + 1;
                month = mon < 10 ? '0' + mon : mon;
                year = new Date().getFullYear();
                day = 1;
                var fullMonth = year + '-' + month;
                var fullDate = fullMonth + '-0' + 1;
                window.onload = function() {

                    region_get_all();
                    customer_bill_get_customer();
                    $('#bill_date').val(fullMonth);
                    bill_get_sum(fullDate, $('#bill_region').children("option:selected").prop('id').split('_').pop(), $('#bill_street').children("option:selected").prop('id').split('_').pop());
                };
                $('table').on('click', '#view', function(e) {
                    bill_id = $(this).attr('bill-id');
                    customer_id = $(this).attr('customer-id');
                    $('#myModal').modal('show');
                });


                displayRecords = function(arr) {
                    $('#records_count').text(arr.length);
                    countIndex = 1;
                    rowcounter = 1;


                    $.each(arr, function(key, record) {
                        rowstyle = "";
                        if (record.bill_sum > 0) {
                            rowstyle = "background:#ff6666";
                        }
                        $bill_sum = 0;
                        if (record.bill_sum != null) {
                            $bill_sum = record.bill_sum;
                        }
                        currRow = `<tr>
                        <td>${rowcounter++}</td>
                        <td>${record.customer_name}</td>
                        <td>${record.region_name}</td>
                        <td>${record.street_name}</td>
                      
                        <td style="${rowstyle};font-weight: bold;">${$bill_sum}</td>
                   
                        </tr>

`;
                        $('')
                        console.log(record.customer_name);
                        $('#table_query_result tbody').append(currRow);

                    });


                }
                table = $('#bill_table').DataTable({

                    "processing": true, //Feature control the processing indicator.
                    "serverSide": true, //Feature control DataTables' server-side processing mode.
                    "order": [], //Initial no order.

                    // Load data for the table's content from an Ajax source
                    "ajax": {
                        "url": "<?php echo site_url('main/bill_get_all') ?>",
                        "type": "POST"
                    },
                    //Set column definition initialisation properties.
                    "columnDefs": [{
                        "targets": [0], //first column / numbering column
                        "orderable": false, //set not orderable
                    }, ],
                });
                bill_get_sum = function(bill_date, bill_region, bill_street) {
                    $.ajax({
                        url: '<?php echo base_url(); ?>main/bill_get_sum',
                        type: 'post',
                        data: {
                            bill_date: bill_date,
                            bill_region: bill_region,
                            bill_street: bill_street
                        },
                        success: function(data) {
                            arrs = JSON.parse(data);
                            if (arrs['status'] !== 'error') {

                                $.each(arrs, function(Index, Entry) {
                                    $('#bill_consum_report').html(Entry.bill_consum);
                                    $('#bill_paid_report').html(Entry.bill_paid);
                                    $('#bill_reminder_report').html(Entry.bill_reminder);
                                    $('#bill_discount_report').html(Entry.bill_discount);
                                });
                            } else {
                                // swal("Opps", arrs['msg'], "info");
                            }
                        }


                    });
                };
                region_get_all = function() {
                    $.ajax({
                        url: '<?php echo base_url(); ?>main/region_get_all',
                        type: 'post',
                        success: function(data) {
                            arrs = JSON.parse(data);
                            if (arrs['status'] !== 'error') {
                                var html = '<option id="region_-1"> اختار منطقة </div>';
                                $.each(arrs, function(Index, Entry) {
                                    html += '<option id="' + ('region_').concat(Entry.region_id) + '">';
                                    html += Entry.region_name;
                                    html += '</option>';
                                });
                                $('#bill_region').html(html);
                            } else {

                                swal("Opps", arrs['msg'], "info");
                            }
                        }


                    });
                };
                // load all cutstomer
                customer_bill_get_customer = function() {

                    $.ajax({
                        url: '<?php echo base_url(); ?>main/customer_get_for_select',
                        type: 'post',
                        success: function(data) {
                            arrs = JSON.parse(data);
                            $('#customer_bill_customer').selectpicker('destroy');
                            if (arrs['status'] !== 'error') {
                                var html = '<option id="-1"> اختار مشترك </div>';
                                $.each(arrs, function(Index, Entry) {
                                    html += '<option id="' + Entry.customer_id + '">';
                                    html += Entry.customer_name;
                                    html += '</option>';
                                });

                                $('#customer_bill_customer').html(html);

                                $('#customer_bill_customer').selectpicker({
                                    style: 'btn-info',
                                    size: 4
                                });


                            } else {
                                swal("Opps", arrs['msg'], "info");
                            }
                        }


                    });
                };

                $('#bill_region').change(function() {

                    street_get_all_by_region($(this).children("option:selected").prop('id').split('_').pop());
                    bill_get_sum($('#bill_date').val() + '-01', $('#bill_region').children("option:selected").prop('id').split('_').pop(), -1);
                });
                $('#bill_street').change(function() {

                    bill_get_sum($('#bill_date').val() + '-01', $('#bill_region').children("option:selected").prop('id').split('_').pop(), $(this).children("option:selected").prop('id').split('_').pop());
                });
                $('#bill_date').change(function() {
                    bill_get_sum($('#bill_date').val() + '-01', $('#bill_region').children("option:selected").prop('id').split('_').pop(), $('#bill_street').children("option:selected").prop('id').split('_').pop());
                });
                street_get_all_by_region = function(street_region) {
                    $.ajax({
                        url: '<?php echo base_url(); ?>main/street_get_all_by_region',
                        type: 'post',
                        data: {
                            street_region: street_region
                        },
                        success: function(data) {
                            arrs = JSON.parse(data);
                            if (arrs['status'] !== 'error') {
                                var html = '<option id="street_-1">اختر شارع</div>';
                                $.each(arrs, function(Index, Entry) {
                                    html += '<option id="' + ('street_').concat(Entry.street_id) + '">';
                                    html += Entry.street_name;
                                    html += '</option>';
                                });
                                $('#bill_street').html(html);
                            } else {

                                swal("Opps", arrs['msg'], "info");
                            }
                        }


                    });
                };
                $('#myModal').on('hidden.bs.modal', function(e) {
                    table.ajax.reload();
                    bill_get_sum($('#bill_date').val() + '-01', $('#bill_region').children("option:selected").prop('id').split('_').pop(), $('#bill_street').children("option:selected").prop('id').split('_').pop());
                    $('#payment_note').val('');
                    $('#payment_reminder').val('');
                });
                $('#myModal').on('shown.bs.modal', function(e) {
                    // do something...
                    payment_get_selected_bill();
                    bill_get_selected();
                    bill_get_debt();
                });
                payment_get_selected_bill = function() {
                    $.ajax({
                        url: '<?php echo base_url(); ?>main/payment_get_selected_bill',
                        type: 'post',
                        data: {
                            bill_id: bill_id
                        },
                        success: function(data) {
                            arrs = JSON.parse(data);
                            if (arrs['status'] !== 'error') {
                                html = '';
                                count = 1;
                                $.each(arrs, function(Index, Entry) {
                                    html += '<tr id="' + Entry.payment_id + '">';
                                    html += '<td>' + count++ + '</td>';
                                    html += '<td>' + Entry.payment_value + '</td>';
                                    html += '<td>' + Entry.payment_discount + '</td>';
                                    html += '<td>' + Entry.payment_date + '</td>';
                                    html += '<td>' + Entry.payment_note + '</td>';
                                    html += '<td> <button class="btn btn-danger btn-block" id="delete">حذف</button> </td>';
                                    html += '</tr>';
                                });
                                $('#payment_table tbody').html(html);
                            } else {
                                $('#payment_table tbody').html('');
                                // swal("Opps", arrs['msg'], "info");
                            }
                        }



                    });
                };
                $('table').on('click', '#delete', function() {
                    payment_row_id = $(this).closest('tr').prop('id');
                    swal({
                            title: "هل أنت متأكد؟",
                            text: "سوف يتم حذف البيانات!",
                            type: "warning",
                            showCancelButton: true,
                            confirmButtonColor: "#DD6B55",
                            confirmButtonText: "نعم، قم بالحذف!",
                            cancelButtonText: "لا، إلغي الحذف!",
                            closeOnConfirm: false,
                            closeOnCancel: false
                        },
                        function(isConfirm) {
                            if (isConfirm) {
                                payment_delete(payment_row_id);
                            } else {
                                swal("تم الإلغاء", "لم يتم الحذف", "error");
                            }
                        });
                });
                payment_delete = function(payment_id) {
                    $.ajax({
                        url: '<?php echo base_url(); ?>main/payment_delete',
                        type: 'post',
                        data: {
                            payment_id: payment_id
                        },
                        success: function(data) {
                            arrs = JSON.parse(data);
                            if (arrs['status'] !== 'error') {
                                // $('#payment_table #'+payment_id).remove();
                                bill_get_debt();
                                bill_get_selected();
                                payment_get_selected_bill();
                                payment_row_id = -1;
                                swal("Success", arrs['msg'], "success");
                            } else {
                                swal("Opps", arrs['msg'], "info");
                            }
                        }


                    });
                };
                bill_get_selected = function() {
                    $.ajax({
                        url: '<?php echo base_url(); ?>main/bill_get_selected',
                        type: 'post',
                        data: {
                            bill_id: bill_id
                        },
                        success: function(data) {
                            arrs = JSON.parse(data);
                            if (arrs['status'] !== 'error') {
                                $.each(arrs, function(Index, Entry) {
                                    $('#payment_reminder').val(Entry.bill_reminder);
                                });
                                bill_get_debt();
                            } else {
                                // swal("Opps", arrs['msg'], "info");
                            }
                        }
                    });
                };
                bill_get_debt = function() {
                    $.ajax({
                        url: '<?php echo base_url(); ?>main/bill_get_debt',
                        type: 'post',
                        data: {
                            customer_id: customer_id
                        },
                        success: function(data) {
                            arrs = JSON.parse(data);
                            if (arrs['status'] !== 'error') {
                                $.each(arrs, function(Index, Entry) {
                                    $('#payment_debt').html('<div class="alert alert-danger alert-dismissible fade in" role="alert">يوجد ديون أخرى بقيمة ' + (parseFloat(Entry.bill_debt) - parseFloat($('#payment_reminder').val())) + '</div>'); //

                                });
                            } else {
                                $('#payment_debt').html();
                                // swal("Opps", arrs['msg'], "info");
                            }
                        }
                    });
                };
                $("#payment").validate({
                    // Specify validation rules
                    rules: {
                        // The key name on the left side is the name attribute
                        // of an input field. Validation rules are defined
                        // on the right side
                        payment_value: "required"

                    },
                    // Specify validation error messages
                    messages: {
                        payment_value: "الرجاء  كتابة قيمة الدفع"
                    },
                    // Make sure the form is submitted to the destination defined
                    // in the "action" attribute of the form when valid
                    submitHandler: function(form) {
                        payment_discount = $('#payment_discount').val() > 0 ? $('#payment_discount').val() : 0;
                        total_paid = parseFloat(payment_discount) + parseFloat($('#payment_value').val());
                        bill_reminder = parseFloat($('#payment_reminder').val()) - parseFloat(total_paid);
                        if (bill_reminder >= 0) {
                            var fd = new FormData(form);
                            fd.append('bill_id', bill_id);
                            payment_discount = $('#payment_discount').val() > 0 ? $('#payment_discount').val() : 0;
                            fd.append('bill_reminder', parseInt($('#payment_reminder').val()));
                            $.ajax({
                                url: '<?php echo base_url(); ?>main/payment_insert_one',
                                type: 'POST',
                                data: fd,
                                contentType: false,
                                cache: false,
                                processData: false,
                                success: function(data) {
                                    arrs = JSON.parse(data);
                                    if (arrs['status'] !== 'error') {
                                        // alert(data);
                                        $('#payment_value').val('').focus();
                                        $('#payment_discount').val('');
                                        bill_get_selected();
                                        payment_get_selected_bill();
                                        swal("!تم الحفظ", "تم حفظ البيانات بنجاح", "success");
                                    } else {
                                        swal("خطأ في البيانات المدخلة", arrs['msg'], "error");
                                    }
                                },
                                error: function(data) {
                                    swal("خطأ في البيانات المدخلة", data.innerHTML, "error");
                                }
                            });
                        } else {
                            swal("المبلغ المتبقي في السالب", "لقد دفعت مبلغ أكبر من المبلغ المستحق", "info");
                        }
                    }
                });
                $('#print_report').click(function(e) {
                    e.preventDefault();
                    bill_get_print($('').val(), $('#bill_date_from').val(), $('#bill_date_to').val(), $('#bill_region').children("option:selected").prop('id').split('_').pop(), $('#bill_street').children("option:selected").prop('id').split('_').pop(),
                        $('#bill_is_paid').children("option:selected").prop('id').split('_').pop());
                });








            }); // end of on ready function

            bill_get_print = function(bill_customer_id, bill_date_from, bill_date_to, bill_region, bill_street, bill_is_paid,credit_from,credit_to) {
                $('.loadingimg').show();
                $('.loadingsection').hide();
                $('#table_query_result tbody').html('');
                $.ajax({
                    url: '<?php echo base_url(); ?>main/bill_get_credit',
                    type: 'post',
                    data: {
                        bill_customer_id: bill_customer_id,
                        bill_date_from: bill_date_from,
                        bill_date_to: bill_date_to,
                        bill_region: bill_region,
                        bill_street: bill_street,
                        bill_is_paid: bill_is_paid,
                        credit_from:credit_from,
                        credit_to:credit_to
                    },
                    success: function(data) {
                        console.log(data)
                        arrs = JSON.parse(data);
                        ArrayToPrint = arrs;
                        if (arrs['status'] !== 'error') {
                            //  bill_print();
                            displayRecords(arrs);

                            // console.log(arrs);
                        } else {
                            swal("Opps", arrs['msg'], "info");
                        }

                        $('.loadingimg').hide();
                        $('.loadingsection').show();
                    }


                });
            };
            bill_get_print_url = function(bill_customer_id, bill_date_from, bill_date_to, bill_region, bill_street, bill_is_paid,credit_from,credit_to) {


                url = '<?php echo base_url(); ?>';
                console.log('bill date from :' + bill_date_from);
                console.log('bill date to :' + bill_date_to);
                url += `main/get_credit_report?bill_customer_id=${bill_customer_id}&bill_date_from=${bill_date_from}
                &bill_date_to=${bill_date_to}&bill_region=${bill_region}&bill_street=${bill_street}&bill_is_paid=${bill_is_paid}
                &credit_from=${credit_from}&credit_to=${credit_to}`;
                window.open(url, '_blank');

            };

            $('#btn_query').click(function(e) {
                console.log('date is:'+$('#bill_date_from').val());
                // call get period date

                bill_get_print($('#customer_bill_customer').children("option:selected").prop('id'), '', '', $('#bill_region').children("option:selected").prop('id').split('_').pop(), $('#bill_street').children("option:selected").prop('id').split('_').pop(),
                    '-1',$('#credit_from').val(),$('#credit_to').val());
            });


            $('#btn_print').click(function(e) {
                // call get period date
                bill_get_print_url($('#customer_bill_customer').children("option:selected").prop('id'),'','', $('#bill_region').children("option:selected").prop('id').split('_').pop(), $('#bill_street').children("option:selected").prop('id').split('_').pop(),
                    '-1',$('#credit_from').val(),$('#credit_to').val());
            });
        </script>