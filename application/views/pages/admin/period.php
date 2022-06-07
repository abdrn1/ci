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
                        <span>الدورة</span>
                    </li>
                </ul>
            </div>
            <!-- END PAGE HEADER-->
            <!-- BEGIN DASHBOARD STATS 1-->

            <div class="row">
                <div class="col-md-10 col-md-offset-1">
                    <form class="form-inline margin-bottom-30" role="form" method="post" action="" id="period" enctype="multipart/form-data">

                        <div class="form-inline">
                            <label for="period_date" class="col-md-2 control-labeli">دورة شهر</label>
                            <div class="col-md-4">
                                <input type="month" class="form-control monthpicker" id="period_date" name="period_date" placeholder="اسم المشترك">
                            </div>
                        </div>
                        <div class="clearfix"></div>
                        <div class="form-inline">
                            <label for="period_region" class="col-md-2 control-labeli">المنطقة</label>
                            <div class="col-md-4">
                                <select class="form-control" id="period_region">
                                    <option id="region_-1">اختر منطقة</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-inline">
                            <label for="period_street" class="col-md-2 control-labeli">الشارع</label>
                            <div class="col-md-4">
                                <select class="form-control" id="period_street">
                                    <option id="region_-1">اختر شارع</option>
                                </select>
                            </div>
                        </div>
                        <div class="clearfix"></div>
                        <hr>
                        <div class="form-inline">
                            <label for="period_customer" class="col-md-2 control-labeli">المشترك</label>
                            <div class="col-md-4">
                                <select class="form-control" data-live-search="true" id="period_customer">
                                    <option id="region_-1">اختر مشترك</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-inline">
                            <label for="period_price" class="col-md-2 control-labeli">السعر</label>
                            <div class="col-md-4">
                                <input type="text" class="form-control" id="period_price" name="period_price" placeholder="السعر">
                            </div>
                        </div>
                        <div class="clearfix">
                        </div>
                        <br>
                        <div class="form-inline">
                            <label for="period_reading" class="col-md-2 control-labeli">قراءة العداد</label>
                            <div class="col-md-4">
                                <input type="text" class="form-control" id="period_reading" name="period_reading" placeholder="قراءة العداد">
                            </div>
                        </div>
                        <div class="form-inline">
                            <label for="period_reading_date" class="col-md-2 control-labeli">تاريخ قراءة العداد</label>
                            <div class="col-md-4">
                                <input type="date" class="form-control" id="period_reading_date" name="period_reading_date" >
                            </div>
                        </div>
                        <div class="clearfix">
                        </div>
                        <br>
                        <div class="form-inline">
                            <label for="period_previous_reading" class="col-md-2 control-labeli">قراءة الشهر السابق</label>
                            <div class="col-md-4">
                                <input type="text" class="form-control" id="period_previous_reading" disabled name="period_previous_reading" placeholder="قراءة الشهر السابق">
                            </div>
                        </div>
                        <div class="form-inline">
                            <label for="period_note" class="col-md-2 control-labeli">ملاحظة</label>
                            <div class="col-md-4">
                                <input type="text" class="form-control" id="period_note" name="period_note" placeholder="ملاحظة">
                            </div>
                        </div>

                        <input type="hidden" name="period_id" value="-1" id="period_id" />

                        <div class="form-group">
                            <div class="col-md-offset-2 col-md-10">
                                <button type="submit" id="save" action="add" class="btn blue">حفظ</button>
                            </div>
                        </div>

                    </form>
                </div>
            </div>
            <div class="clearfix"></div>
            <!-- END DASHBOARD STATS 1-->
            <div class="row">
                <div class="col-md-10 col-md-offset-1">
                    <img class="loadingimg center-block" src="<?php echo base_url(); ?>assets_admin/global/img/loadingn" alt="جاري التحميل"/>
                    <div class="loadingsection portlet box red">
                        <div class="portlet-title">
                            <div class="caption">
                                <i class="fa fa-comments"></i>جدول الدورات</div>
                            <div class="tools">
                                <a href="javascript:;" class="collapse" data-original-title="" title=""> </a>
                                <a href="#portlet-config" data-toggle="modal" class="config" data-original-title="" title=""> </a>
                                <a href="javascript:;" class="reload" data-original-title="" title=""> </a>
                                <a href="javascript:;" class="remove" data-original-title="" title=""> </a>
                            </div>
                        </div>
                        <div class="portlet-body" style="display: block;">
                            <table class="table table-striped table-hover table-bordered" id="period_table">
                                <thead>
                                    <tr>
                                        <th style="width:10px !important"> # </th>
                                        <th>اسم المشترك</th>
                                        <th>المنطقة</th>
                                        <th>الشارع</th>
                                        <th>قراءة العداد</th>
                                        <th>تاريخ القراءة</th>
                                        <th>قراءة العداد السابقة</th>
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

        var table;
        mon = new Date().getMonth() + 1;
        month = mon < 10 ? '0' + mon : mon;
        year = new Date().getFullYear();
        day = 1;
        var fullMonth = year + '-' + month;
        var fullDate = fullMonth + '-0' + 1;
        window.onload = function () {
            region_get_all();
            $('#period_date').val(fullMonth);
            period_get_customer(fullDate, $('#period_region').children("option:selected").prop('id').split('_').pop()
                    , $('#period_street').children("option:selected").prop('id').split('_').pop());
        };


        $('table').on('click', '#delete', function () {

            period_row_id = $(this).attr('period-id');
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
                            period_delete(period_row_id);
                        } else {
                            swal("تم الإلغاء", "لم يتم الحذف", "error");
                        }
                    });

        });

        table = $('#period_table').DataTable({

            "processing": true, //Feature control the processing indicator.
            "serverSide": true, //Feature control DataTables' server-side processing mode.
            "order": [], //Initial no order.

            // Load data for the table's content from an Ajax source
            "ajax": {
                "url": "<?php echo site_url('main/period_get_all') ?>",
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
            period_get_customer($('#period_date').val() + '-01', $(this).children("option:selected").prop('id').split('_').pop()
                    , -1);

        });
        $('#period_street').change(function () {
            period_get_customer($('#period_date').val() + '-01', $('#period_region').children("option:selected").prop('id').split('_').pop()
                    , $(this).children("option:selected").prop('id').split('_').pop());
        });

        $('#period_date').change(function () {
            period_get_customer($(this).val() + '-01', $('#period_region').children("option:selected").prop('id').split('_').pop()
                    , $('#period_street').children("option:selected").prop('id').split('_').pop());

        });

        $('#period_customer').change(function () {

            period_get_previous_reading($('#period_date').val() + '-01', $(this).children("option:selected").prop('id').split('_').pop());

        });

        period_get_previous_reading = function (period_date, period_customer) {

            $.ajax({
                url: '<?php echo base_url(); ?>main/period_get_previous_reading',
                type: 'post',
                data: {period_date: period_date, period_customer: period_customer},
                success: function (data) {
                    arrs = JSON.parse(data);
                    if (arrs['status'] !== 'error')
                    {
                        $.each(arrs, function (Index, Entry) {
                            $('#period_previous_reading').prop("disabled", true);
                            $('#period_previous_reading').val(Entry.period_reading);
                        });
                    } else {
                        $('#period_previous_reading').prop("disabled", false);

                        // swal("Opps", arrs['msg'], "info");
                    }
                }


            });
        };


        street_get_all_by_region = function (street_region) {
            $.ajax({
                url: '<?php echo base_url(); ?>main/street_get_all_by_region',
                type: 'post',
                data: {street_region: street_region},
                success: function (data) {
                    arrs = JSON.parse(data);

                    if (arrs['status'] !== 'error')
                    {
                        var html = '<option id="street_-1"> اختار شارع </div>';
                        $.each(arrs, function (Index, Entry) {
                            html += '<option id="' + ('street_').concat(Entry.street_id) + '">';
                            html += Entry.street_name;
                            html += '</option>';
                        });

                        $('#period_street').html(html);

                    } else {

                        swal("Opps", arrs['msg'], "info");
                    }
                }


            });
        };

        period_get_customer = function (period_date, period_region, period_street) {

            $.ajax({
                url: '<?php echo base_url(); ?>main/customer_get_for_select',
                type: 'post',
                data: {period_date: period_date, period_region: period_region, period_street: period_street},
                success: function (data) {
                    arrs = JSON.parse(data);
                    $('#period_customer').selectpicker('destroy');
                    if (arrs['status'] !== 'error')
                    {
                        var html = '<option id="region_-1"> اختار مشترك </div>';
                        $.each(arrs, function (Index, Entry) {
                            html += '<option id="' + ('region_').concat(Entry.customer_id) + '">';
                            html += Entry.customer_name;
                            html += '</option>';
                        });

                        $('#period_customer').html(html);

                        $('#period_customer').selectpicker({
                            style: 'btn-info',
                            size: 4
                        });


                    } else {
                        $('#period_customer').html('<option id="region_-1">مكتمل</div>');
                        $('#period_customer').selectpicker({
                            style: 'btn-info',
                            size: 4
                        });
                        // swal("Opps", arrs['msg'], "info");
                    }
                }


            });
        };

        period_get_selected = function (period_id) {
            $.ajax({
                url: '<?php echo base_url(); ?>main/period_get_selected',
                type: 'post',
                data: {period_id: period_id},
                success: function (data) {
                    arrs = JSON.parse(data);
                    if (arrs['status'] !== 'error')
                    {
                        html = '';
                        count = 1;
                        $.each(arrs, function (Index, Entry) {
                            $('#save').attr('action', 'update');
                            $('#save').text('تحديث');
                            $('#period_id').val(period_id);
                            $('#period_name').val(Entry.period_name).focus();
                            $('#period_jawwal').val(Entry.period_jawwal);
                            $('#period_serial_number').val(Entry.period_serial_number);
                            $('#period_region').val(Entry.region_name);
                            $('#period_street').val(Entry.street_name);
                        });

                    } else {
                        swal("Opps", arrs['msg'], "info");
                    }
                }


            });
        };


        period_delete = function (period_id) {
            $.ajax({
                url: '<?php echo base_url(); ?>main/period_delete',
                type: 'post',
                data: {period_id: period_id},
                success: function (data) {
                    arrs = JSON.parse(data);
                    if (arrs['status'] !== 'error')
                    {
                        table.ajax.reload();
                        period_get_customer($('#period_date').val() + '-01', $('#period_region').children("option:selected").prop('id').split('_').pop()
                                , $('#period_street').children("option:selected").prop('id').split('_').pop());

                        swal("Success", arrs['msg'], "success");
                    } else {
                        swal("Opps", arrs['msg'], "info");
                    }
                }


            });
        };

        $("#period").validate({
            // Specify validation rules
            rules: {
                // The key name on the left side is the name attribute
                // of an input field. Validation rules are defined
                // on the right side
                period_date: "required",
                period_customer: "required",
                period_reading: "required",
                period_reading_date: "required"
            },
            // Specify validation error messages
            messages: {
                period_date: "الرجاء تحديد الدورة",
                period_customer: "الرجاء اختيار اسم المشترك",
                period_reading: "الرجاء كتابة قراءة العداد",
                period_reading_date: "الرجاء  تحديد تاريخ القراءة"
            },
            // Make sure the form is submitted to the destination defined
            // in the "action" attribute of the form when valid
            submitHandler: function (form) {
                var fd = new FormData(form);
                fd.append('period_id', $('#period_id').val());
                fd.append('period_previous_reading', $('#period_previous_reading').val());
                fd.append('period_customer', $("#period_customer option:selected").prop('id').split("_").pop());
                $.ajax({
                    url: '<?php echo base_url(); ?>main/period_insert',
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
                            $('#period_reading').val('').focus();
                            $('#period_price').val('');
                            $('#period_previous_reading').val('').prop('disabled', true);
                            $('#period_customer').children("option:selected").remove();

                            //$('input[type=file]').replaceWith($('input[type=file]').val('').clone(true));
                            //$('#period').get(0).reset();
                            $('#save').text('إضافة');
                            $('#save').attr('action', 'add');
                            table.ajax.reload();
                            period_get_customer($('#period_date').val() + '-01', $('#period_region').children("option:selected").prop('id').split('_').pop()
                                    , $('#period_street').children("option:selected").prop('id').split('_').pop());

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