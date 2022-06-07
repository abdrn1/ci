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
                        <span>الصندوق</span>
                    </li>
                </ul>
            </div>
            <!-- END PAGE HEADER-->
            <!-- BEGIN DASHBOARD STATS 1-->
        </div>
        <div class="row hide_print">
            <div class="col-md-10 col-md-offset-1">
                <form class="form-inline margin-bottom-30" role="form" method="post" action="" id="box" enctype="multipart/form-data">

                    <div class="form-inline">
                        <label for="box_box_type" class="hide_print col-md-2 control-labeli">نوع الصندوق</label>
                        <div class="col-md-4">
                            <select class="form-control hide_print" data-live-search="true" id="box_box_type">
                                <option id="box_type_-1">اختر نوع الصندوق</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-inline">
                        <label for="box_respective" class="hide_print col-md-2 control-labeli">صاحب الصندوق</label>
                        <div class="col-md-4">
                            <select class="form-control hide_print" id="box_respective">
                                <option id="box_respective_-1">اختر صاحب الصندوق</option>
                            </select>
                        </div>
                    </div>

                    <br>
                    <br>

                    <div class="form-inline">
                        <label for="payment_value" class="col-md-2 control-labeli">المبلغ</label>
                        <div class="col-md-4">
                            <input type="text" class="form-control" id="box_value" name="box_value" placeholder="المبلغ">
                        </div>
                    </div>
                    <div class="form-inline">
                        <label for="box_date" class="col-md-2 control-labeli">التاريخ</label>
                        <div class="col-md-4">
                            <input type="date" class="form-control" id="box_date" name="box_date">
                        </div>
                    </div>
                    <br>
                    <br>
                    <div class="form-inline">
                        <label for="payment_note" class="col-md-2 control-labeli">ملاحظة</label>
                        <div class="col-md-4">
                            <input type="text" class="form-control" id="box_note" name="box_note" placeholder="ملاحظة">
                        </div>
                    </div>
                    <div class="form-inline">
                        <label for="box_respective" class="hide_print col-md-2 control-labeli">داخل / خارج الصندوق</label>
                        <div class="col-md-4">
                            <select class="form-control hide_print" id="box_in_out">
                                <option id="box_-1">اختر داخل/خارج</option>
                                <option id="box_in">داخل</option>
                                <option id="box_out">خارج</option>
                            </select>
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
                            <i class="fa fa-comments"></i>جدول الصندوق</div>
                        <div class="tools">
                            <a href="javascript:;" class="collapse" data-original-title="" title=""> </a>
                            <a href="#portlet-config" data-toggle="modal" class="config" data-original-title="" title=""> </a>
                            <a href="javascript:;" class="reload" data-original-title="" title=""> </a>
                            <a href="javascript:;" class="remove" data-original-title="" title=""> </a>
                        </div>
                    </div>
                    <div class="portlet-body" style="display: block;">
                        <div id="box_type_name_title" style="font-size: 20px;padding: 10px;"></div>
                        <table class="table table-striped table-hover table-bordered" id="box_table">
                            <thead>
                                <tr>
                                    <th> # </th>
                                    <th>المبلغ</th>
                                    <th>صاحب الصندوق</th>
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
    <!-- END CONTENT BODY -->
</div>
<!-- END CONTENT -->
</div>
<!-- END CONTAINER -->
<script>
    $(document).ready(function () {

        window.onload = function () {
            box_type_get_all();
        };
        $('#box_box_type').change(function () {

            box_respective_get_all_by_box_type($(this).children("option:selected").prop('id').split('_').pop(), -1);

        });

        $('#box_respective').change(function () {

            box_get_by_respective($("#box_respective").children("option:selected").prop('id').split('_').pop());


        });

        box_get_by_respective = function (box_respective) {
            $.ajax({
                url: '<?php echo base_url(); ?>main/box_get_by_respective',
                type: 'post',
                data: {box_respective: box_respective},
                success: function (data) {
                    arrs = JSON.parse(data);
                    if (arrs['status'] !== 'error')
                    {
                        html = '';
                        count = 1;
                        $.each(arrs, function (Index, Entry) {
                            html += '<tr id="' + Entry.box_id + '">';
                            html += '<td>' + count++ + '</td>';
                            html += '<td>' + Entry.box_value + '</td>';
                            html += '<td>' + Entry.box_respective_name + '</td>';
                            html += '<td>' + Entry.box_date + '</td>';
                            html += '<td>' + Entry.box_note + '</td>';
                            html += '<td> <button class="btn btn-danger btn-block" id="delete">حذف</button> </td>';
                            html += '</tr>';
                        });
                        $('#box_table tbody').html(html);

                    } else {
                        $('#box_table tbody').html('');
                        swal("Opps,", arrs['msg'], "info");
                    }
                }


            });
        };



        box_type_get_all = function () {
            $.ajax({
                url: '<?php echo base_url(); ?>main/box_type_get_all',
                type: 'post',
                success: function (data) {
                    arrs = JSON.parse(data);
                    // box_respective.fnDestroy();
                    if (arrs['status'] !== 'error')
                    {
                        var html = '<option id="box_type_-1"> إختار نوع الصندوق </div>';
                        $.each(arrs, function (Index, Entry) {
                            html += '<option id="' + ('box_type_').concat(Entry.box_type_id) + '">';
                            html += Entry.box_type_name;
                            html += '</option>';
                        });

                        $('#box_box_type').html(html);

                    } else {

                        swal("Opps", arrs['msg'], "info");
                    }
                }


            });
        };

        box_respective_get_all_by_box_type = function (box_respective_box_type) {
            $.ajax({
                url: '<?php echo base_url(); ?>main/box_respective_get_all_by_box_type',
                type: 'post',
                data: {box_respective_box_type: box_respective_box_type},
                success: function (data) {
                    arrs = JSON.parse(data);
                    if (arrs['status'] !== 'error')
                    {

                        var html = '<option id="box_respective_-1"> إختار صاحب الصندوق </div>';
                        $.each(arrs, function (Index, Entry) {
                            html += '<option id="' + ('box_type_').concat(Entry.box_respective_id) + '">';
                            html += Entry.box_respective_name;
                            html += '</option>';
                        });

                        $('#box_respective').html(html);

                    } else {
                        swal("Opps", arrs['msg'], "info");
                    }
                }


            });
        };


        $('table').on('click', '#delete', function () {
            box_row_id = $(this).closest('tr').prop('id');
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
                            box_delete(box_row_id);
                        } else {
                            swal("تم الإلغاء", "لم يتم الحذف", "error");
                        }
                    });

        });

        box_delete = function (box_id) {
            $.ajax({
                url: '<?php echo base_url(); ?>main/box_delete',
                type: 'post',
                data: {box_id: box_id},
                success: function (data) {
                    arrs = JSON.parse(data);
                    if (arrs['status'] !== 'error')
                    {
                        box_get_by_respective($("#box_respective").children("option:selected").prop('id').split('_').pop());

                        swal("Success", arrs['msg'], "success");
                    } else {
                        swal("Opps", arrs['msg'], "info");
                    }
                }


            });
        };

        $("#box").validate({
            // Specify validation rules
            rules: {
                box_value: "required",
                //box_note: "required",
                box_date: "required"
            },
            // Specify validation error messages
            messages: {
                box_value: "الرجاء كتابة مبلغ",
                //box_note: "الرجاء كتابة ملاحظة",
                box_date: "الرجاء تحديد التاريخ "
            },
            // Make sure the form is submitted to the destination defined
            // in the "action" attribute of the form when valid
            submitHandler: function (form) {
                var fd = new FormData(form);
                fd.append('box_respective', $("#box_respective").children("option:selected").prop('id').split('_').pop());
                fd.append('box_in_out', $("#box_in_out").children("option:selected").prop('id').split('_').pop());

                $.ajax({
                    url: '<?php echo base_url(); ?>main/box_insert',
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
                            $('#box_value').val('').focus();
                            $('#box_note').val('');

                            box_get_by_respective($("#box_respective").children("option:selected").prop('id').split('_').pop());
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