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
                        <span>نوع الصندوق</span>
                    </li>
                </ul>
            </div>
            <!-- END PAGE HEADER-->
            <!-- BEGIN DASHBOARD STATS 1-->

            <div class="row">
                <div class="col-md-10 col-md-offset-1">
                    <form class="form-horizontal" role="form" method="post" action="" id="box_type" enctype="multipart/form-data">

                        <div class="form-group">
                            <label for="box_type_name" class="col-md-2 control-labeli">اسم نوع الصندوق</label>
                            <div class="col-md-4">
                                <input type="text" class="form-control" id="box_type_name" name="box_type_name" placeholder="اسم نوع الصندوق">
                            </div>
                        </div>
                        <input type="hidden" name="box_type_id" value="-1" id="box_type_id" />

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
                            <table class="table table-striped table-hover table-bordered" id="box_type_table">
                                <thead>
                                    <tr>
                                        <th> # </th>
                                        <th>اسم نوع الصندوق</th>
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

        var box_type = $('#box_type_table').dataTable(function () {});

        window.onload = function () {
            box_type_get_all();
            //  box_type_get_selected();
        };


        $('table').on('click', '#edit', function () {
            box_type_get_selected($(this).closest('tr').prop('id'));
        });


        $('table').on('click', '#delete', function () {
            box_type_row_id = $(this).closest('tr').prop('id');

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
                            box_type_delete(box_type_row_id);
                        } else {
                            swal("تم الإلغاء", "لم يتم الحذف", "error");
                        }
                    });



        });

        box_type_get_all = function () {
            $.ajax({
                url: '<?php echo base_url(); ?>main/box_type_get_all',
                type: 'post',
                success: function (data) {
                    arrs = JSON.parse(data);
                    box_type.fnDestroy();
                    if (arrs['status'] !== 'error')
                    {
                        html = '';
                        count = 1;
                        $.each(arrs, function (Index, Entry) {
                            html += '<tr id="' + Entry.box_type_id + '">';
                            html += '<td>' + count++ + '</td>';
                            html += '<td>' + Entry.box_type_name + '</td>';
                            html += '<td> <button class="btn btn-primary btn-block" id="edit">تعديل</button></td>';
                            html += '<td> <button class="btn btn-danger btn-block" id="delete">حذف</button> </td>';

                            html += '</tr>';
                        });
                        $('#box_type_table tbody').html(html);

                        box_type = $('#box_type_table').dataTable(function () {});

                    } else {
                         $('#box_type_table tbody').html('');
                        swal("Opps,", arrs['msg'], "info");
                    }
                }


            });
        };


        box_type_get_selected = function (box_type_id) {
            $.ajax({
                url: '<?php echo base_url(); ?>main/box_type_get_selected',
                type: 'post',
                data: {box_type_id: box_type_id},
                success: function (data) {
                    arrs = JSON.parse(data);
                    if (arrs['status'] !== 'error')
                    {
                        html = '';
                        count = 1;
                        $.each(arrs, function (Index, Entry) {
                            $('#save').attr('action', 'update');
                            $('#save').text('تحديث');
                            $('#box_type_id').val(box_type_id);
                            $('#box_type_name').val(Entry.box_type_name).focus();
                        });

                    } else {
                        swal("Opps,", arrs['msg'], "info");
                    }
                }


            });
        };


        box_type_delete = function (box_type_id) {
            $.ajax({
                url: '<?php echo base_url(); ?>main/box_type_delete',
                type: 'post',
                data: {box_type_id: box_type_id},
                success: function (data) {
                    arrs = JSON.parse(data);
                    if (arrs['status'] !== 'error')
                    {
                        box_type_get_all();
                        swal("Success", arrs['msg'], "success");
                    } else {
                        swal("Opps,", arrs['msg'], "info");
                    }
                }


            });
        };

        $("#box_type").validate({
            // Specify validation rules
            rules: {
                // The key name on the left side is the name attribute
                // of an input field. Validation rules are defined
                // on the right side
                box_type_name: "required"
            },
            // Specify validation error messages
            messages: {
                box_type_name: "الرجاء كتابة اسم نوع الصندوق"
            },
            // Make sure the form is submitted to the destination defined
            // in the "action" attribute of the form when valid
            submitHandler: function (form) {
                var fd = new FormData(form);
                fd.append('box_type_id', $('#box_type_id').val());
                //fd.append('image2', $('input[type=file]')[0].files[0] ); etc..
                $url = '';
                if ($('#save').attr('action') === 'add') {
                    $url = '<?php echo base_url(); ?>main/box_type_insert';
                } else if ($('#save').attr('action') === 'update') {
                    $url = '<?php echo base_url(); ?>main/box_type_update';
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
                            $('#box_type_name').val('').focus();
                            //$('input[type=file]').replaceWith($('input[type=file]').val('').clone(true));
                            //$('#box_type').get(0).reset();
                            $('#save').text('إضافة');
                            $('#save').attr('action', 'add');
                            box_type_get_all();
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