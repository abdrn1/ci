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
                            <span>إضافة مبالغ أخرى على الفاتورة</span>
                        </li>
                    </ul>
                </div>
                <!-- END PAGE HEADER-->
                <!-- BEGIN DASHBOARD STATS 1-->
            </div>
            <div class="row hide_print">
                <div class="col-md-10 col-md-offset-1">
                    <form class="form-inline margin-bottom-30" role="form" method="post" action="" id="add_cost" enctype="multipart/form-data">

                        <div class="form-inline">
                            <label for="period_customer" class="hide_print col-md-2 control-labeli">المشترك</label>
                            <div class="col-md-4">
                                <select class="form-control hide_print" data-live-search="true" id="customer_bill_customer">
                                    <option id="customer_-1">اختر مشترك</option>
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

                        <br>
                        <br>

                        <div class="form-inline">
                            <label for="payment_value" class="col-md-2 control-labeli">المبلغ</label>
                            <div class="col-md-4">
                                <input type="text" class="form-control" id="add_cost_value" name="add_cost_value" placeholder="المبلغ">
                            </div>
                        </div>
                        <div class="form-inline">
                            <label for="payment_note" class="col-md-2 control-labeli">ملاحظة</label>
                            <div class="col-md-4">
                                <input type="text" class="form-control" id="add_cost_note" name="add_cost_note" placeholder="ملاحظة">
                            </div>
                        </div>
                        <br>
                        <br>
                        <br>
                        <div class="form-group">
                            <div class="col-md-offset-10 col-md-2">
                                <button type="submit" id="save" action="add" class="btn blue">حفظ</button>
                            </div>
                        </div>

                    </form>
                </div>
            </div>
            <div class="clearfix"></div>
            <br>
            <!-- END DASHBOARD STATS 1-->
            <div class="row">
                <div class="col-md-10 col-md-offset-1">
                    <div class="portlet box red">
                        <div class="portlet-title">
                            <div class="caption">
                                <i class="fa fa-comments"></i>جدول إضافة مبالغ أخرى على الفاتورة</div>
                            <div class="tools">
                                <a href="javascript:;" class="collapse" data-original-title="" title=""> </a>
                                <a href="#portlet-config" data-toggle="modal" class="config" data-original-title="" title=""> </a>
                                <a href="javascript:;" class="reload" data-original-title="" title=""> </a>
                                <a href="javascript:;" class="remove" data-original-title="" title=""> </a>
                            </div>
                        </div>
                        <div class="portlet-body" style="display: block;">
                            <div id="customer_name_title" style="font-size: 20px;padding: 10px;"></div>
                            <table class="table table-striped table-hover table-bordered" id="add_cost_table">
                                <thead>
                                    <tr>
                                        <th> # </th>
                                        <th>المبلغ</th>
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
        <!-- END CONTENT BODY -->
    </div>
    <!-- END CONTENT -->
</div>
<!-- END CONTAINER -->
<script>
    $(document).ready(function () {

        window.onload = function () {
            customer_bill_get_customer();
        };
        $('#customer_bill_customer').change(function () {

            bill_get_period($(this).children("option:selected").prop('id').split('_').pop(), -1);

        });

        $('#bill_period').change(function () {

            get_add_cost($("#bill_period").children("option:selected").prop('id').split('_').pop());


        });

        get_add_cost = function (period_id) {
            $.ajax({
                url: '<?php echo base_url(); ?>main/get_add_cost',
                type: 'post',
                data: {period_id: period_id},
                success: function (data) {
                    arrs = JSON.parse(data);
                    if (arrs['status'] !== 'error')
                    {
                        html = '';
                        count = 1;
                        $.each(arrs, function (Index, Entry) {
                            html += '<tr id="' + Entry.add_cost_id + '">';
                            html += '<td>' + count++ + '</td>';
                            html += '<td>' + Entry.add_cost_value + '</td>';
                            html += '<td>' + Entry.add_cost_note + '</td>';
                            html += '<td> <button class="btn btn-danger btn-block" id="delete">حذف</button> </td>';
                            html += '</tr>';
                        });
                        $('#add_cost_table tbody').html(html);

                    } else {
                        $('#add_cost_table tbody').html('');
                        swal("Opps,", arrs['msg'], "info");
                    }
                }


            });
        };


        customer_bill_get_customer = function () {

            $.ajax({
                url: '<?php echo base_url(); ?>main/customer_get_for_select',
                type: 'post',
                success: function (data) {
                    arrs = JSON.parse(data);
                    $('#customer_bill_customer').selectpicker('destroy');
                    if (arrs['status'] !== 'error')
                    {
                        var html = '<option id="customer_-1"> اختار مشترك </div>';
                        $.each(arrs, function (Index, Entry) {
                            html += '<option id="' + ('customer_').concat(Entry.customer_id) + '">';
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


        bill_get_period = function (customer_id, bill_period) {

            $.ajax({
                url: '<?php echo base_url(); ?>main/customer_bill_get_all',
                type: 'post',
                data: {customer_id: customer_id, bill_period: bill_period},
                success: function (data) {
                    arrs = JSON.parse(data);
                    if (arrs['status'] !== 'error')
                    {
                        var html = '<option id="customer_-1"> اختار دورة </div>';
                        $.each(arrs, function (Index, Entry) {
                            html += '<option id="' + ('selectbill_').concat(Entry.bill_period) + '">';
                            html += Entry.period_reading_date;
                            html += '</option>';
                        });

                        $('#bill_period').html(html);

                    } else {
                        swal("Opps", arrs['msg'], "info");
                    }
                }


            });
        };

        $('table').on('click', '#delete', function () {
            add_cost_row_id = $(this).closest('tr').prop('id');
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
                            add_cost_delete(add_cost_row_id);
                        } else {
                            swal("تم الإلغاء", "لم يتم الحذف", "error");
                        }
                    });

        });

        add_cost_delete = function (add_cost_id) {
            $.ajax({
                url: '<?php echo base_url(); ?>main/add_cost_delete',
                type: 'post',
                data: {add_cost_id: add_cost_id},
                success: function (data) {
                    arrs = JSON.parse(data);
                    if (arrs['status'] !== 'error')
                    {
                        get_add_cost($("#bill_period").children("option:selected").prop('id').split('_').pop());

                        swal("Success", arrs['msg'], "success");
                    } else {
                        swal("Opps", arrs['msg'], "info");
                    }
                }


            });
        };

        $("#add_cost").validate({
            // Specify validation rules
            rules: {
                add_cost_value: "required",
                add_cost_note: "required"
            },
            // Specify validation error messages
            messages: {
                add_cost_value: "الرجاء كتابة مبلغ",
                add_cost_note: "الرجاء كتابة ملاحظة"
            },
            // Make sure the form is submitted to the destination defined
            // in the "action" attribute of the form when valid
            submitHandler: function (form) {
                var fd = new FormData(form);
                fd.append('period_id', $("#bill_period").children("option:selected").prop('id').split('_').pop());
                $.ajax({
                    url: '<?php echo base_url(); ?>main/add_cost_insert',
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
                            $('#add_cost_value').val('').focus();
                            $('#add_cost_note').val('');

                            get_add_cost($("#bill_period").children("option:selected").prop('id').split('_').pop());
                            swal("!تم الحفظ", "تم حفظ البيانات بنجاح", "success");

                        } else {
                            swal("خطأ في البيانات المدخلة", arrs['msg'], "error");
                        }
                    },
                    error: function (data) {
                        swal("خطأ في البيانات المدخلة", data.innerHTML, "error");
                    }
                });

            }
        });

    });

</script>