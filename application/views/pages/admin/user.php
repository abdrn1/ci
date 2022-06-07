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
                        <span>إعادة كلمة المرور</span>
                    </li>
                </ul>
            </div>
            <!-- END PAGE HEADER-->
            <!-- BEGIN DASHBOARD STATS 1-->

            <div class="row">
                <div class="col-md-10 col-md-offset-1">
                    <form class="form-horizontal" role="form" method="post" action="" id="cost" enctype="multipart/form-data">

                        <div class="form-group">
                            <label for="current_password" class="col-md-2 control-labeli">كلمة السر القديمة</label>
                            <div class="col-md-4">
                                <input type="password" class="form-control" id="current_password" name="current_password" placeholder="كلمة السر القديمة">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="new_password" class="col-md-2 control-labeli">كلمة السر الجديدة</label>
                            <div class="col-md-4">
                                <input type="password" class="form-control" id="new_password" name="new_password" placeholder="كلمة السر الجديدة">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="renew_password" class="col-md-2 control-labeli">إعادة كلمة السر الجديدة</label>
                            <div class="col-md-4">
                                <input type="password" class="form-control" id="renew_password" name="renew_password" placeholder="كلمة السر القديمة">
                            </div>
                        </div>

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
            <br>

            <div class="page-bar">
                <ul class="page-breadcrumb">
                    <li>
                        <i class="icon-home"></i>
                        <a href="index">الرئيسة</a>
                        <i class="fa fa-angle-left"></i>
                    </li>
                    <li>
                        <span>إسترجاع قاعدة البيانات</span>
                    </li>
                </ul>
            </div>
            <div class="col-md-offset-2 col-md-10">
                <button type="submit" id="restore"  class="btn btn-danger">إسترجاع</button>
            </div>
        </div>
        <!-- END CONTENT BODY -->
    </div>
    <!-- END CONTENT -->
</div>
<!-- END CONTAINER -->
<script>
    $(document).ready(function () {

        $("#cost").validate({
            // Specify validation rules
            rules: {
                current_password: 'required',
                new_password: 'required',
                renew_password: 'required'
            },
            // Specify validation error messages
            messages: {
                current_password: 'الرجاء كتابة كلمة المرور القديمة',
                new_password: 'الرجاء كتابة كلمة المرور الجديدة',
                renew_password: 'الرجاءإعادة كتابة كلمة المرور الجديدة'
            },
            // Make sure the form is submitted to the destination defined
            // in the "action" attribute of the form when valid
            submitHandler: function (form) {
                var fd = new FormData(form);
                $.ajax({
                    url: '<?php echo base_url(); ?>main/change_password',
                    type: 'POST',
                    data: fd,
                    contentType: false,
                    cache: false,
                    processData: false,
                    success: function (data)
                    {
                        arrs = JSON.parse(data);
                        if (arrs['status'] !== 'error') {
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

        db_restore_backup = function () {
            $.ajax({
                url: '<?php echo base_url(); ?>main/db_restore_backup',
                type: 'post',
                success: function (data) {
                    arrs = JSON.parse(data);

                    if (arrs['status'] !== 'error')
                    {
                        $('#restore').prop('disabled', false);
                        swal("تم", arrs['msg'], "success");

                    } else {
                        $('#restore').prop('disabled', false);
                        swal("Opps", arrs['msg'], "info");
                    }
                },
                error: function (data) {
                    $('#restore').prop('disabled', false);
                    swal("خطأ.. لم تتم العملية بنجاح", data.innerHTML, "error");
                }

            });
        };

        $('#restore').on('click', function () {
           			$(this).prop('disabled', true);
							swal({
					title: "هل أنت متأكد؟",
					type: "warning",
					showCancelButton: true,
					confirmButtonColor: "#DD6B55",
					closeOnConfirm: false,
					closeOnCancel: false
				},
						function (isConfirm) {
							if (isConfirm) {
								db_restore_backup();
							} else {
								swal("تم الإلغاء", "لم يتم الاستعادة", "error");
								$(this).prop('disabled', false);
							}
						});
        });

    });

</script>