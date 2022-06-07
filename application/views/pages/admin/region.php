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
                        <span>المنطقة</span>
                    </li>
                </ul>
            </div>
            <!-- END PAGE HEADER-->
            <!-- BEGIN DASHBOARD STATS 1-->

            <div class="row">
                <div class="col-md-10 col-md-offset-1">
                    <form class="form-horizontal" role="form" method="post" action="" id="region" enctype="multipart/form-data">

                        <div class="form-group">
                            <label for="region_name" class="col-md-2 control-labeli">اسم المنطقة</label>
                            <div class="col-md-4">
                                <input type="text" class="form-control" id="region_name" name="region_name" placeholder="اسم المنطقة">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="sender_name" class="col-md-2 control-labeli">اسم المرسل</label>
                            <div class="col-md-4">
                                <input type="text" class="form-control" id="sender_name" name="sender_name" placeholder="اسم المرسل">
                            </div>
                        </div>
                        <input type="hidden" name="region_id" value="-1" id="region_id" />

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
                            <table class="table table-striped table-hover table-bordered" id="region_table">
                                <thead>
                                    <tr>
                                        <th> # </th>
                                        <th>اسم المنطقة</th>
                                        <th>اسم المرسل</th>
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

        var region = $('#region_table').dataTable(function () {});

        window.onload = function () {
            region_get_all();
            //  region_get_selected();
        };


        $('table').on('click', '#edit', function () {
            region_get_selected($(this).closest('tr').prop('id'));
        });


        $('table').on('click', '#delete', function () {
            region_row_id = $(this).closest('tr').prop('id');

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
                            region_delete(region_row_id);
                        } else {
                            swal("تم الإلغاء", "لم يتم الحذف", "error");
                        }
                    });



        });

        region_get_all = function () {
            $.ajax({
                url: '<?php echo base_url(); ?>main/region_get_all',
                type: 'post',
                success: function (data) {
                    arrs = JSON.parse(data);
                    region.fnDestroy();
                    if (arrs['status'] !== 'error')
                    {
                        html = '';
                        count = 1;
                        $.each(arrs, function (Index, Entry) {
                            html += '<tr id="' + Entry.region_id + '">';
                            html += '<td>' + count++ + '</td>';
                            html += '<td>' + Entry.region_name + '</td>';
                            html += '<td>' + Entry.sender_name + '</td>';
                            html += '<td> <button class="btn btn-primary btn-block" id="edit">تعديل</button></td>';
                            html += '<td> <button class="btn btn-danger btn-block" id="delete">حذف</button> </td>';

                            html += '</tr>';
                        });
                        $('#region_table tbody').html(html);

                        region = $('#region_table').dataTable(function () {});

                    } else {
                         $('#region_table tbody').html('');
                        swal("Opps,", arrs['msg'], "info");
                    }
                }


            });
        };


        region_get_selected = function (region_id) {
            $.ajax({
                url: '<?php echo base_url(); ?>main/region_get_selected',
                type: 'post',
                data: {region_id: region_id},
                success: function (data) {
                    arrs = JSON.parse(data);
                    if (arrs['status'] !== 'error')
                    {
                        html = '';
                        count = 1;
                        $.each(arrs, function (Index, Entry) {
                            $('#save').attr('action', 'update');
                            $('#save').text('تحديث');
                            $('#region_id').val(region_id);
                            $('#region_name').val(Entry.region_name).focus();
                            $('#sender_name').val(Entry.sender_name);
                        });

                    } else {
                        swal("Opps,", arrs['msg'], "info");
                    }
                }


            });
        };


        region_delete = function (region_id) {
            $.ajax({
                url: '<?php echo base_url(); ?>main/region_delete',
                type: 'post',
                data: {region_id: region_id},
                success: function (data) {
                    arrs = JSON.parse(data);
                    if (arrs['status'] !== 'error')
                    {
                        region_get_all();
                        swal("Success", arrs['msg'], "success");
                    } else {
                        swal("Opps,", arrs['msg'], "info");
                    }
                }


            });
        };

        $("#region").validate({
            // Specify validation rules
            rules: {
                // The key name on the left side is the name attribute
                // of an input field. Validation rules are defined
                // on the right side
                region_name: "required"
            },
            // Specify validation error messages
            messages: {
                region_name: "الرجاء كتابة اسم المنطقة"
            },
            // Make sure the form is submitted to the destination defined
            // in the "action" attribute of the form when valid
            submitHandler: function (form) {
                var fd = new FormData(form);
                fd.append('region_id', $('#region_id').val());
                //fd.append('image2', $('input[type=file]')[0].files[0] ); etc..
                $url = '';
                if ($('#save').attr('action') === 'add') {
                    $url = '<?php echo base_url(); ?>main/region_insert';
                } else if ($('#save').attr('action') === 'update') {
                    $url = '<?php echo base_url(); ?>main/region_update';
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
                            $('#region_name').val('').focus();
                            $('#sender_name').val('');
                            //$('input[type=file]').replaceWith($('input[type=file]').val('').clone(true));
                            //$('#region').get(0).reset();
                            $('#save').text('إضافة');
                            $('#save').attr('action', 'add');
                            region_get_all();
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