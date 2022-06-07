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
                    <span>الفواتير</span>
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
                            <i class="fa fa-comments"></i>إحصائيات</div>
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
                                    <div class="center-block align-center text-center"> <h4>الإستهلاك: <span id="bill_consum_report" class="font-lg font-blue-soft">  </span> </h4> <div> 
                                        </div>
                                    </div>
                                </div>
                                <div class="thumbnail circle col-md-2 col-sm-offset-1"> 
                                    <div class="center-block align-center text-center"> <h4>المدفوع: <span id="bill_paid_report" class="font-lg font-blue-soft">  </span> </h4> <div> 
                                        </div>
                                    </div>
                                </div>
                                <div class="thumbnail circle col-md-2 col-sm-offset-1"> 
                                    <div class="center-block align-center text-center"> <h4>المتبقي: <span id="bill_reminder_report" class="font-lg font-blue-soft">  </span> </h4> <div> 
                                        </div>
                                    </div>
                                </div>
                                <div class="thumbnail circle col-md-2 col-sm-offset-1"> 
                                    <div class="center-block align-center text-center"> <h4>خصومات: <span id="bill_discount_report" class="font-lg font-blue-soft">  </span> </h4> <div> 
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-10 col-md-offset-1">
                        <div class="form-inline margin-bottom-30" id="bill">

<!--                            <div class="form-inline">
                                <label for="bill_date" class="col-md-2 control-labeli">دورة شهر</label>
                                <div class="col-md-4">
                                    <input type="month" class="form-control monthpicker" id="bill_date" name="bill_date" placeholder="اسم المشترك">
                                </div>
                            </div>
                            <hr>                           
                            <div class="clearfix"></div>-->
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
                            <div class="form-inline">
                                <label for="bill_is_paid" class="col-md-2 col-md-offset-3 control-labeli">مدفوع/غير مدفوع</label>
                                <div class="col-md-4">
                                    <select class="form-control" id="bill_is_paid">
                                        <option id="paid_-1">مدفوع/غير مدفوع</option>
                                        <option id="paid_1">مدفوع</option>
                                        <option id="paid_2">غير مدفوع</option>
                                    </select>
                                </div>
                                
                            </div>

                            <!--                                <div class="form-group">
                                                                <div class="display center-block center-align">
                                                                    <button type="submit" id="print_report" class="btn blue">طباعة</button>
                                                                </div>
                                                            </div>-->
                            
                            <div class="clearfix"></div>
                            <hr>
                            <div class="form-inline">
                                <label for="bill_date_from" class="col-md-2 control-labeli">من تاريخ</label>
                                <div class="col-md-4">
                                    <input type="date" class="form-control" id="bill_date_from" name="bill_date_from">
                                </div>
                            </div>
                            <div class="form-inline">
                                <label for="bill_date_to" class="col-md-2 control-labeli">إلى تاريخ</label>
                                <div class="col-md-4">
                                    <input type="date" class="form-control" id="bill_date_to" name="bill_date_to">
                                </div>
                            </div>
                            <hr>
                            <div class="clearfix"></div>
                            <input type="hidden" name="bill_id" value="-1" id="bill_id" />


                        </div>
                    </div>
                </div>
                <div class="clearfix"></div>
                <!-- END DASHBOARD STATS 1-->
                <div class="row">
                    <div class="col-md-12 col-md-offset-0">
                        <img class="loadingimg center-block" src="<?php echo base_url(); ?>assets_admin/global/img/loadingn" alt="جاري التحميل"/>
                        <div class="loadingsection portlet box red">
                            <div class="portlet-title">
                                <div class="caption">
                                    <i class="fa fa-comments"></i>جدول الفواتير</div>
                                <div class="tools">
                                    <a id="print_report" class="fa fa-print fa-2x " style="color: #fafcfb;" data-original-title="" title=""> </a>
                                    <a href="javascript:;" class="collapse" data-original-title="" title=""> </a>
                                    <a href="#portlet-config" data-toggle="modal" class="config" data-original-title="" title=""> </a>
                                    <a href="javascript:;" class="reload" data-original-title="" title=""> </a>
                                    <a href="javascript:;" class="remove" data-original-title="" title=""> </a>
                                </div>
                            </div>
                            <div class="portlet-body" style="display: block;">
                                <table class="table table-striped table-hover table-bordered" id="bill_table">
                                    <thead>
                                        <tr>
                                            <th> # </th>
                                            <th>اسم المشترك</th>
                                            <th>اسم المنطقة</th>
                                            <th>اسم الشارع</th>
                                            <th>دورة شهر</th>
                                            <th>تاريخ القراءة</th>
                                            <th>القراءة الحالية</th>
                                            <th>القراءة السابقة</th>
                                            <th style="width: 10px !important;">الإستهلاك</th>
                                            <th>السعر</th>
                                            <th>المدفوع</th>
                                            <th>المخصوم</th>
                                            <th>المتبقي</th>
                                            <th>الدفعات</th>   
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
                                                    <input type="text" class="form-control" id="payment_value" name="payment_value" placeholder="المبلغ"/>
                                                </div>
                                            </div>
                                            <div class="form-inline">
                                                <label for="payment_discount" class="col-md-2 control-labeli">مبلغ الخصم</label>
                                                <div class="col-md-4">
                                                    <input type="text" class="form-control" id="payment_discount" name="payment_discount" placeholder="المبلغ"/>
                                                </div>
                                            </div>
                                            <div class="clearfix">
                                            </div>
                                            <br>
                                            <div class="form-inline">
                                                <label for="payment_reminder" class="col-md-2 control-labeli">المبلغ المتبقي</label>
                                                <div class="col-md-4">
                                                    <input type="text" class="form-control" disabled id="payment_reminder" name="payment_reminder" placeholder="المبلغ المتبقي" >
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
                                                            <i class="fa fa-comments"></i>جدول الدفعات</div>
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
        $(document).ready(function () {

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
            window.onload = function () {
                region_get_all();
                $('#bill_date').val(fullMonth);
                bill_get_sum(fullDate, $('#bill_region').children("option:selected").prop('id').split('_').pop()
                        , $('#bill_street').children("option:selected").prop('id').split('_').pop());
            };
            $('table').on('click', '#view', function (e) {
                bill_id = $(this).attr('bill-id');
                customer_id = $(this).attr('customer-id');
                $('#myModal').modal('show');
            });
            bill_get_print = function (bill_date_from, bill_date_to, bill_region, bill_street, bill_is_paid) {

                $.ajax({
                    url: '<?php echo base_url(); ?>main/bill_get_print',
                    type: 'post',
                    data: {bill_date_from: bill_date_from, bill_date_to: bill_date_to, bill_region: bill_region, bill_street: bill_street, bill_is_paid: bill_is_paid},
                    success: function (data) {
                        arrs = JSON.parse(data);
                        ArrayToPrint = arrs;
                        if (arrs['status'] !== 'error')
                        {
                            bill_print();
                        } else {
                            swal("Opps", arrs['msg'], "info");
                        }
                    }


                });
            };
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
                "columnDefs": [
                    {
                        "targets": [0], //first column / numbering column
                        "orderable": false, //set not orderable
                    },
                ],
            });
            bill_get_sum = function (bill_date, bill_region, bill_street) {
                $.ajax({
                    url: '<?php echo base_url(); ?>main/bill_get_sum',
                    type: 'post',
                    data: {bill_date: bill_date, bill_region: bill_region, bill_street: bill_street},
                    success: function (data) {
                        arrs = JSON.parse(data);
                        if (arrs['status'] !== 'error')
                        {

                            $.each(arrs, function (Index, Entry) {
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
                            $('#bill_region').html(html);
                        } else {

                            swal("Opps", arrs['msg'], "info");
                        }
                    }


                });
            };
            $('#bill_region').change(function () {

                street_get_all_by_region($(this).children("option:selected").prop('id').split('_').pop());
                bill_get_sum($('#bill_date').val() + '-01', $('#bill_region').children("option:selected").prop('id').split('_').pop()
                        , -1);
            });
            $('#bill_street').change(function () {

                bill_get_sum($('#bill_date').val() + '-01', $('#bill_region').children("option:selected").prop('id').split('_').pop()
                        , $(this).children("option:selected").prop('id').split('_').pop());
            });
            $('#bill_date').change(function () {
                bill_get_sum($('#bill_date').val() + '-01', $('#bill_region').children("option:selected").prop('id').split('_').pop()
                        , $('#bill_street').children("option:selected").prop('id').split('_').pop());
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
                            $('#bill_street').html(html);
                        } else {

                            swal("Opps", arrs['msg'], "info");
                        }
                    }


                });
            };
            $('#myModal').on('hidden.bs.modal', function (e) {
                table.ajax.reload();
                bill_get_sum($('#bill_date').val() + '-01', $('#bill_region').children("option:selected").prop('id').split('_').pop()
                        , $('#bill_street').children("option:selected").prop('id').split('_').pop());
                $('#payment_note').val('');
                $('#payment_reminder').val('');
            });
            $('#myModal').on('shown.bs.modal', function (e) {
                // do something...
                payment_get_selected_bill();
                bill_get_selected();
                bill_get_debt();
            });
            payment_get_selected_bill = function () {
                $.ajax({
                    url: '<?php echo base_url(); ?>main/payment_get_selected_bill',
                    type: 'post',
                    data: {bill_id: bill_id},
                    success: function (data) {
                        arrs = JSON.parse(data);
                        if (arrs['status'] !== 'error')
                        {
                            html = '';
                            count = 1;
                            $.each(arrs, function (Index, Entry) {
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
            $('table').on('click', '#delete', function () {
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
                        function (isConfirm) {
                            if (isConfirm) {
                                payment_delete(payment_row_id);
                            } else {
                                swal("تم الإلغاء", "لم يتم الحذف", "error");
                            }
                        });
            });
            payment_delete = function (payment_id) {
                $.ajax({
                    url: '<?php echo base_url(); ?>main/payment_delete',
                    type: 'post',
                    data: {payment_id: payment_id},
                    success: function (data) {
                        arrs = JSON.parse(data);
                        if (arrs['status'] !== 'error')
                        {
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
            bill_get_selected = function () {
                $.ajax({
                    url: '<?php echo base_url(); ?>main/bill_get_selected',
                    type: 'post',
                    data: {bill_id: bill_id},
                    success: function (data) {
                        arrs = JSON.parse(data);
                        if (arrs['status'] !== 'error')
                        {
                            $.each(arrs, function (Index, Entry) {
                                $('#payment_reminder').val(Entry.bill_reminder);
                            });
                            bill_get_debt();
                        } else {
                            // swal("Opps", arrs['msg'], "info");
                        }
                    }
                });
            };
            bill_get_debt = function () {
                $.ajax({
                    url: '<?php echo base_url(); ?>main/bill_get_debt',
                    type: 'post',
                    data: {customer_id: customer_id},
                    success: function (data) {
                        arrs = JSON.parse(data);
                        if (arrs['status'] !== 'error')
                        {
                            $.each(arrs, function (Index, Entry) {
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
                submitHandler: function (form) {
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
                            success: function (data)
                            {
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
                            error: function (data) {
                                swal("خطأ في البيانات المدخلة", data.innerHTML, "error");
                            }
                        });
                    } else {
                        swal("المبلغ المتبقي في السالب", "لقد دفعت مبلغ أكبر من المبلغ المستحق", "info");
                    }
                }
            });
            $('#print_report').click(function (e) {
                e.preventDefault();
                bill_get_print($('#bill_date_from').val(), $('#bill_date_to').val(), $('#bill_region').children("option:selected").prop('id').split('_').pop()
                        , $('#bill_street').children("option:selected").prop('id').split('_').pop(),
                        $('#bill_is_paid').children("option:selected").prop('id').split('_').pop());
            });


            bill_print = function () {
                var period_region = $('#bill_region').children("option:selected").val() !== 'اختار منطقة' ?
                        $('#bill_region').children("option:selected").val() : '';
                var period_street = $('#bill_street').children("option:selected").val() !== 'اختر شارع' ?
                        ', ' + $('#bill_street').children("option:selected").val() : '';
                var report = '<style>'
                        + '@media print {.p-break {page-break-before: always;}}'
                        + 'th{text-align:center;font-size:14px;direction:rtl;}'
                        + 'td{text-align:center;font-size:12px;direction:rtl;}'
                        + '.loc_label{float:right;padding-left:10px;}'
                        + '.loc_title{float:right;width:250px;padding-top:10px;}'
                        + 'table{margin-bottom:20px;}ul{list-style:none;}'
                        + '.right-header{left:0;background:#ddd;position:absolute;top:0}'
                        + '.right-header{right:0;background:#333;position:absolute;top:0}'
                        + 'tr, td, th, thead, tfoot { page-break-inside: avoid !important;}'
                        + 'thead{ display:table-row-group;}'
                        + '</style>';
//
                var header = '<div class="row-fluid" style="padding-top:10px;'
                        + 'padding-bottom:5px;border-bottom:2px solid #000000;margin-bottom: 10px;direction:rtl;">'
                        + '<div style="text-align:center;font-weight:bold";margin-bottom: 5px;>' //position:relative;width:250px;height:90;margin:0 auto;
                        + 'كشف الفواتير</div><div class="loc_title"><strong>' + period_region + '  ' + period_street + '</strong></div></div>'
                        + '<div class="row-fluid" style="padding-top:5px;padding-bottom:5px;margin-bottom:5px;direction:rtl;">'
                        + '<div class="loc_label"></div>'
                        + '</div><table width="100%" border="1" cellspacing="0" cellpadding="5">'
                        + '<thead><tr><th width="8%" scope="col">ملاحظة</th>'
                        + '<th width="8%" scope="col">المبلغ للدفع</th>'
                        + '<th width="8%" scope="col">الإستهلاك الشهري</th>'
                        + '<th width="8%" scope="col">القراءة السابقة</th>'
                        + '<th width="8%" scope="col">القراءة الحالية</th>'
                        + '<th width="6%" scope="col">تاريخ القراءة الحالية</th>'
                        + '<th width="12%" scope="col">اسم المشترك</th>'
                        + '<th width="2%"  scope="col">م</th></tr></thead><tbody>';
                var temp = '';
                var ptype;
                var ptype2;
                var status = "";
                var p_type = "";
                if (ArrayToPrint.length > 20)
                {

                    for (var i = 0; i < ArrayToPrint.length; i++)
                    {
                        var row = ArrayToPrint[i];
                        if (i % 20 == 0)
                        {
                            if (i > ArrayToPrint.length)
                            {

                                temp += '</tbody></table><div style="clear:both;"></div>';
                            }
                            temp += '</tbody></table><div class="p-break" style="clear:both;"></div>';
                            temp += header;
                        }

                        temp += '<tr><td><span style=" font-size: 120%;">' + row.period_note + '</span></td>'
                                + '<td><span style=" font-size: 120%;">' + row.bill_reminder + '</span></td>'
                                + '<td><span style=" font-size: 120%;">' + row.bill_consumption + '</span></td>'
                                + '<td><span style=" font-size: 120%;">' + row.period_previous_reading + '</span></td>'
                                + '<td><span style=" font-size: 120%;">' + row.period_reading + '</span></td>'
                                + '<td><span style=" font-size: 120%;">' + row.period_reading_date + '</span></td>'
                                + '<td><span style=" font-size: 120%;">' + row.customer_name + '</span></td>'
                                + '<td><span style=" font-size: 120%;">' + (parseInt(i) + 1) + '</span></td>';
                    } // end for			

                    report += temp;
                } else if (ArrayToPrint.length <= 20)
                {
                    temp += header;
                    for (var i = 0; i < ArrayToPrint.length; i++)
                    {
                        var row = ArrayToPrint[i];
                        temp += '<tr><td><span style=" font-size: 120%;">' + row.period_note + '</span></td>'
                                + '<td><span style=" font-size: 120%;">' + row.bill_reminder + '</span></td>'
                                + '<td><span style=" font-size: 120%;">' + row.bill_consumption + '</span></td>'
                                + '<td><span style=" font-size: 120%;">' + row.period_previous_reading + '</span></td>'
                                + '<td><span style=" font-size: 120%;">' + row.period_reading + '</span></td>'
                                + '<td><span style=" font-size: 120%;">' + row.period_reading_date + '</span></td>'
                                + '<td><span style=" font-size: 120%;">' + row.customer_name + '</span></td>'
                                + '<td><span style=" font-size: 120%;">' + (parseInt(i) + 1) + '</span></td>';
                    } // end for
                    report += temp;
                    report = report + '</tbody></table>';
                    temp = '';
                }
                var newWindow = window.open('', '', 'width=1000, height=600'),
                        document = newWindow.document.open();
                document.write(report);
                report = '';
                document.close();
                newWindow.print();
            };
        });

    </script>