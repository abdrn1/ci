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
                        <span>السعر</span>
                    </li>
                </ul>
            </div>
            <!-- END PAGE HEADER-->
            <!-- BEGIN DASHBOARD STATS 1-->

            <div class="row">
                <div class="col-md-10 col-md-offset-1">
                    <form class="form-horizontal" role="form" method="post" action="" id="cost" enctype="multipart/form-data">

                        <div class="form-group">
                            <label for="cost_price" class="col-md-2 control-labeli">السعر الافتراضي</label>
                            <div class="col-md-4">
                                <input type="text" class="form-control" id="cost_price" name="cost_price" placeholder="">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="cost_price" class="col-md-2 control-labeli">الحد الادنى</label>
                            <div class="col-md-4">
                                <input type="text" value="0" class="form-control" id="min_price" name="min_price" placeholder="حد أدنى">
                                <small id="emailHelp" class="form-text text-muted">ضع قيمة 0 لالغاء الحد الأدنى</small>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="cost_price" class="col-md-2 control-labeli">إرسال الرسائل عند الادخال</label>
                            <div class="col-md-4">
                                <input type="checkbox" class="form-control" id="send_sms" name="send_sms">
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


        </div>
        <!-- END CONTENT BODY -->
    </div>
    <!-- END CONTENT -->
</div>
<!-- END CONTAINER -->
<script>
    $(document).ready(function () {


        window.onload = function () {
            cost_get_price();
            //  region_get_selected();
        };

        cost_get_price = function () {
            $.ajax({
                url: '<?php echo base_url(); ?>main/cost_get_price',
                type: 'post',
                success: function (data) {
                    arrs = JSON.parse(data);
                    if (arrs['status'] !== 'error')
                    {

                        $.each(arrs, function (Index, Entry) {
                            $('#cost_price').val(Entry.cost_price);
                            $('#min_price').val(Entry.min_price);
                            $('#send_sms').prop('checked',(Entry.send_sms==1));
                        });


                    } else {
                        swal("Opps,", arrs['msg'], "info");
                    }
                }


            });
        };

        $("#cost").validate({
            // Specify validation rules
            rules: {
            },
            // Specify validation error messages
            messages: {
            },
            // Make sure the form is submitted to the destination defined
            // in the "action" attribute of the form when valid
            submitHandler: function (form) {
                var fd = new FormData(form);
                //fd.append('cost_price', $('#cost_price').val());
                  send_data ={
                        cost_price:$('#cost_price').val(),
                        send_sms:($('#send_sms').is(":checked"))?'1':'0',
                        min_price:$('#min_price').val()
                    };  
                $.ajax({
                    url: '<?php echo base_url(); ?>main/cost_update',
                    type: 'POST',
                    data:send_data ,
                   
                    
                    success: function (data)
                    {
                        console.log(send_data);
                        arrs = JSON.parse(data);
                        if (arrs['status'] !== 'error') {
                            cost_get_price();
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