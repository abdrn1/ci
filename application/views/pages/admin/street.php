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
                    <form class="form-horizontal" role="form" method="post" action="" id="street" enctype="multipart/form-data">

                        <div class="form-group">
                            <label for="street_name" class="col-md-2 control-labeli">اسم الشارع</label>
                            <div class="col-md-4">
                                <input type="text" class="form-control" id="street_name" name="street_name" placeholder="اسم المنطقة">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="street_region" class="col-md-2 control-labeli">المنطقة</label>
                            <div class="col-md-4">
                                <select class="form-control" id="street_region">
                                    <option id="region_-1">اختر منطقة</option>
                                </select>
                            </div>
                        </div>
                        <input type="hidden" name="street_id" value="-1" id="street_id" />

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
                            <table class="table table-striped table-hover table-bordered" id="street_table">
                                <thead>
                                    <tr>
                                        <th> # </th>
                                        <th>اسم الشارع</th>
                                        <th> المنطقة</th>
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

        var street = $('#street_table').dataTable(function () {});

        window.onload = function () {
            street_get_all();
            region_get_all();
            //  street_get_selected();
        };


        $('table').on('click', '#edit', function () {
            street_get_selected($(this).closest('tr').prop('id'));
        });

        $('table').on('click', '#delete', function () {
            street_row_id = $(this).closest('tr').prop('id');

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
                            street_delete(street_row_id);
                        } else {
                            swal("تم الإلغاء", "لم يتم الحذف", "error");
                        }
                    });



        });

        street_get_all = function () {
            $.ajax({
                url: '<?php echo base_url(); ?>main/street_get_all',
                type: 'post',
                success: function (data) {
                    arrs = JSON.parse(data);
                    street.fnDestroy();
                    if (arrs['status'] !== 'error')
                    {
                        html = '';
                        count = 1;
                        $.each(arrs, function (Index, Entry) {
                            html += '<tr id="' + Entry.street_id + '">';
                            html += '<td>' + count++ + '</td>';
                            html += '<td>' + Entry.street_name + '</td>';
                            html += '<td>' + Entry.region_name + '</td>';
                            html += '<td> <button class="btn btn-primary btn-block" id="edit">تعديل</button></td>';
                            html += '<td> <button class="btn btn-danger btn-block" id="delete">حذف</button> </td>';

                            html += '</tr>';
                        });
                        $('#street_table tbody').html(html);

                        setTimeout(function () {
                            street = $('#street_table').dataTable(function () {});
                        }, 15);


                    } else {
                        $('#street_table tbody').html('');
                        swal("Opps", arrs['msg'], "info");
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
                    street.fnDestroy();
                    if (arrs['status'] !== 'error')
                    {
                        var html = '<option id="region_-1"> إختار منطقة </div>';
                        $.each(arrs, function (Index, Entry) {
                            html += '<option id="' + ('region_').concat(Entry.region_id) + '">';
                            html += Entry.region_name;
                            html += '</option>';
                        });

                        $('#street_region').html(html);

                    } else {

                        swal("Opps", arrs['msg'], "info");
                    }
                }


            });
        };

        street_get_selected = function (street_id) {
            $.ajax({
                url: '<?php echo base_url(); ?>main/street_get_selected',
                type: 'post',
                data: {street_id: street_id},
                success: function (data) {
                    arrs = JSON.parse(data);
                    if (arrs['status'] !== 'error')
                    {
                        html = '';
                        count = 1;
                        $.each(arrs, function (Index, Entry) {
                            $('#save').attr('action', 'update');
                            $('#save').text('تحديث');
                            $('#street_id').val(street_id);
                            $('#street_name').val(Entry.street_name).focus();
                            $('#street_region').val(Entry.region_name);
                        });

                    } else {
                        swal("Opps", arrs['msg'], "info");
                    }
                }


            });
        };


        street_delete = function (street_id) {
            $.ajax({
                url: '<?php echo base_url(); ?>main/street_delete',
                type: 'post',
                data: {street_id: street_id},
                success: function (data) {
                    arrs = JSON.parse(data);
                    if (arrs['status'] !== 'error')
                    {
                        street_get_all();
                        swal("Success", arrs['msg'], "success");
                    } else {
                        swal("Opps", arrs['msg'], "info");
                    }
                }


            });
        };

        $("#street").validate({
            // Specify validation rules
            rules: {
                // The key name on the left side is the name attribute
                // of an input field. Validation rules are defined
                // on the right side
                street_name: "required",
                street_region: "required"
            },
            // Specify validation error messages
            messages: {
                street_name: "الرجاء كتابة اسم الشارع",
                street_region: "الرجاء اختار منطقة"
            },
            // Make sure the form is submitted to the destination defined
            // in the "action" attribute of the form when valid
            submitHandler: function (form) {
                var fd = new FormData(form);
                fd.append('street_id', $('#street_id').val());
                fd.append('street_region', $("#street_region option:selected").prop('id').split("_").pop());
                //fd.append('image2', $('input[type=file]')[0].files[0] ); etc..
                $url = '';
                if ($('#save').attr('action') === 'add') {
                    $url = '<?php echo base_url(); ?>main/street_insert';
                } else if ($('#save').attr('action') === 'update') {
                    $url = '<?php echo base_url(); ?>main/street_update';
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
                            $('#street_name').val('').focus();
                            $('#street_region').val('');
                            //$('input[type=file]').replaceWith($('input[type=file]').val('').clone(true));
                            $('#street').get(0).reset();
                            $('#save').text('إضافة');
                            $('#save').attr('action', 'add');
                            street_get_all();
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