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
                        <span>صاحب الصندوق</span>
                    </li>
                </ul>
            </div>
            <!-- END PAGE HEADER-->
            <!-- BEGIN DASHBOARD STATS 1-->

            <div class="row">
                <div class="col-md-10 col-md-offset-1">
                    <form class="form-horizontal" role="form" method="post" action="" id="box_respective" enctype="multipart/form-data">

                        <div class="form-group">
                            <label for="box_respective_name" class="col-md-2 control-labeli">اسم صاحب الصندوق</label>
                            <div class="col-md-4">
                                <input type="text" class="form-control" id="box_respective_name" name="box_respective_name" placeholder="اسم نوع الصندوق">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="box_respective_box_type" class="col-md-2 control-labeli">نوع الصندوق</label>
                            <div class="col-md-4">
                                <select class="form-control" id="box_respective_box_type">
                                    <option id="box_type_-1">اختر منطقة</option>
                                </select>
                            </div>
                        </div>
                        <input type="hidden" name="box_respective_id" value="-1" id="box_respective_id" />

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
                    <div class="portlet box red">
                        <div class="portlet-title">
                            <div class="caption">
                                <i class="fa fa-comments"></i>جدول المناطق</div>
                            <div class="tools">
                                <a href="javascript:;" class="collapse" data-original-title="" title=""> </a>
                                <a href="#portlet-config" data-toggle="modal" class="config" data-original-title="" title=""> </a>
                                <a href="javascript:;" class="reload" data-original-title="" title=""> </a>
                                <a href="javascript:;" class="remove" data-original-title="" title=""> </a>
                            </div>
                        </div>
                        <div class="portlet-body" style="display: block;">
                            <table class="table table-striped table-hover table-bordered" id="box_respective_table">
                                <thead>
                                    <tr>
                                        <th> # </th>
                                        <th>اسم صاحب الصندوق</th>
                                        <th> نوع الصندوق</th>
                                        <th> تعديل </th>
                                        <th> حذف </th>
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

        var box_respective = $('#box_respective_table').dataTable(function () {});

        window.onload = function () {
            box_respective_get_all();
            box_type_get_all();
            //  box_respective_get_selected();
        };


        $('table').on('click', '#edit', function () {
            box_respective_get_selected($(this).closest('tr').prop('id'));
        });

        $('table').on('click', '#delete', function () {
            box_respective_row_id = $(this).closest('tr').prop('id');

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
                            box_respective_delete(box_respective_row_id);
                        } else {
                            swal("تم الإلغاء", "لم يتم الحذف", "error");
                        }
                    });



        });

        box_respective_get_all = function () {
            $.ajax({
                url: '<?php echo base_url(); ?>main/box_respective_get_all',
                type: 'post',
                success: function (data) {
                    arrs = JSON.parse(data);
                    box_respective.fnDestroy();
                    if (arrs['status'] !== 'error')
                    {
                        html = '';
                        count = 1;
                        $.each(arrs, function (Index, Entry) {
                            html += '<tr id="' + Entry.box_respective_id + '">';
                            html += '<td>' + count++ + '</td>';
                            html += '<td>' + Entry.box_respective_name + '</td>';
                            html += '<td>' + Entry.box_type_name + '</td>';
                            html += '<td> <button class="btn btn-primary btn-block" id="edit">تعديل</button></td>';
                            html += '<td> <button class="btn btn-danger btn-block" id="delete">حذف</button> </td>';

                            html += '</tr>';
                        });
                        $('#box_respective_table tbody').html(html);

                        setTimeout(function () {
                            box_respective = $('#box_respective_table').dataTable(function () {});
                        }, 15);


                    } else {
                        $('#box_respective_table tbody').html('');
                        swal("Opps", arrs['msg'], "info");
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
                    box_respective.fnDestroy();
                    if (arrs['status'] !== 'error')
                    {
                        var html = '<option id="box_type_-1"> إختار نوع الصندوق </div>';
                        $.each(arrs, function (Index, Entry) {
                            html += '<option id="' + ('box_type_').concat(Entry.box_type_id) + '">';
                            html += Entry.box_type_name;
                            html += '</option>';
                        });

                        $('#box_respective_box_type').html(html);

                    } else {

                        swal("Opps", arrs['msg'], "info");
                    }
                }


            });
        };

        box_respective_get_selected = function (box_respective_id) {
            $.ajax({
                url: '<?php echo base_url(); ?>main/box_respective_get_selected',
                type: 'post',
                data: {box_respective_id: box_respective_id},
                success: function (data) {
                    arrs = JSON.parse(data);
                    if (arrs['status'] !== 'error')
                    {
                        html = '';
                        count = 1;
                        $.each(arrs, function (Index, Entry) {
                            $('#save').attr('action', 'update');
                            $('#save').text('تحديث');
                            $('#box_respective_id').val(box_respective_id);
                            $('#box_respective_name').val(Entry.box_respective_name).focus();
                            $('#box_respective_box_type').val(Entry.box_type_name);
                        });

                    } else {
                        swal("Opps", arrs['msg'], "info");
                    }
                }


            });
        };


        box_respective_delete = function (box_respective_id) {
            $.ajax({
                url: '<?php echo base_url(); ?>main/box_respective_delete',
                type: 'post',
                data: {box_respective_id: box_respective_id},
                success: function (data) {
                    arrs = JSON.parse(data);
                    if (arrs['status'] !== 'error')
                    {
                        box_respective_get_all();
                        swal("Success", arrs['msg'], "success");
                    } else {
                        swal("Opps", arrs['msg'], "info");
                    }
                }


            });
        };

        $("#box_respective").validate({
            // Specify validation rules
            rules: {
                // The key name on the left side is the name attribute
                // of an input field. Validation rules are defined
                // on the right side
                box_respective_name: "required",
                box_respective_box_type: "required"
            },
            // Specify validation error messages
            messages: {
                box_respective_name: "الرجاء كتابة اسم صاحب الصندوق",
                box_respective_box_type: "الرجاء اختار منطقة"
            },
            // Make sure the form is submitted to the destination defined
            // in the "action" attribute of the form when valid
            submitHandler: function (form) {
                var fd = new FormData(form);
                fd.append('box_respective_id', $('#box_respective_id').val());
                fd.append('box_respective_box_type', $("#box_respective_box_type option:selected").prop('id').split("_").pop());
                //fd.append('image2', $('input[type=file]')[0].files[0] ); etc..
                $url = '';
                if ($('#save').attr('action') === 'add') {
                    $url = '<?php echo base_url(); ?>main/box_respective_insert';
                } else if ($('#save').attr('action') === 'update') {
                    $url = '<?php echo base_url(); ?>main/box_respective_update';
                }

                $.ajax({
                    url: $url,
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
                            $('#box_respective_name').val('').focus();
                            $('#box_respective_box_type').val('');
                            //$('input[type=file]').replaceWith($('input[type=file]').val('').clone(true));
                            $('#box_respective').get(0).reset();
                            $('#save').text('إضافة');
                            $('#save').attr('action', 'add');
                            box_respective_get_all();
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