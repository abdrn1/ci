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
        <h3 class="font-red-flamingo page-title"> لوحة التحكم

        </h3>
        <div class="page-bar">
            <ul class="page-breadcrumb">
                <li>
                    <i class="icon-home"></i>
                    <a href="index">الرئيسة</a>
                    <i class="fa fa-angle-left"></i>
                </li>
                <li>
                    <span>الرسائل</span>
                </li>
            </ul>
        </div>
        <!-- END PAGE HEADER-->
        <!-- BEGIN DASHBOARD STATS 1-->

        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                <form class="form-inline margin-bottom-30" role="form" method="post" action="" id="period" enctype="multipart/form-data">

                    <!--                        <div class="form-inline">
                                                <label for="period_date" class="col-md-2 control-labeli">دورة شهر</label>
                                                <div class="col-md-4">
                                                    <input type="month" class="form-control monthpicker" id="period_date" name="period_date" placeholder="اسم المشترك">
                                                </div>
                                            </div>
                                            <div class="clearfix"></div>-->
                   

                    <div class="col-sm-2 col-sm-offset-2"><span class="badge" id="smsCredits"></span>

                    </div>
                    <div class="clearfix"></div>
                    <div class="panel panel-success">
                        <div class="panel-heading">إرسال رسائل  حسب المنطقة أو الشارع</div>
                        <div class="panel-body">


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
                        <label for="sms_text" class="col-md-2 control-labeli">نص الرسالة</label>
                        <div class="col-md-4">
                            <textarea class="form-control" id="smsText" name="smsText" rows="5" cols="25"></textarea>
                        </div>
                        <div class="col-md-1 col-md-offset-0"><span class="badge" id="smsTextLength">0</span>
                        </div>
                    </div>
                    <div class="clearfix"></div>
                    <br>
                    <div class="form-group has-error">
                        <div class="col-md-3">
                            <label for="sms_text" class="control-label input-xlarge has-warning">نص إضافي على الرسالة</label>
                        </div>
                        <input style="width: 100%" type="text" id="smsTextExtra" class="form-control" />

                    </div>


                    <div class="clearfix"></div>
                    <hr>
                    <div class="col-md-2">
                        <button type="submit" disabled="true" id="sendSMS" class="btn btn-danger display block center-block">أرسال </button>
                    </div>
                    <div class="col-md-2">
                        <button type="submit" id="sendSMSBill" class="btn btn-primary display block center-block">أرسال أخر فاتورة </button>
                    </div>
                    <div class="col-md-2">
                        <button type="submit" id="sendSMSSum" class="btn btn-warning display block center-block">أرسال المستحقات </button>
                    </div>
                    <div class="col-md-2">
                        <button type="submit" id="sendSMSCustome" class="btn btn-success block center-block">أرسال نموذج </button>
                    </div>

                    <div class="clearfix"></div>
                    <br>
                    <div class="col-md-12">
                        <div class="alert alert-danger    font-md"> <span> سوف يتم الارسال للمنطقة والشارع المحددتان،</span>
                            <span> في حالة عدم تحديد منطقة سوف يتم الارسال للجميع ، في حالة عدم تحديد شارع سوف يتم الارسال للمنطقة المحددة</span>
                        </div>
                    </div>

                    </div>
        </div>


                    <br>
                    <br>

                    <hr>



                    <div class="panel panel-info">
                        <div class="panel-heading">إرسال رسائل لمشتركين محددين</div>
                        <div class="panel-body">

                            <div class="form-inline">
                                <label for="period_customer" class="hide_print col-md-2 control-labeli">المشترك</label>
                                <div class="col-md-4">
                                    <select class="form-control hide_print" data-live-search="true" id="customer_bill_customer">
                                        <option id="customer_-1">اختر مشترك</option>
                                    </select>
                                </div>
                            </div>
                            <div class="clearfix"></div>
                            <br>
                            <br>

                            <div class="col-md-12">
                                <textarea class="form-control" disabled style="direction: ltr;width: 100%;" id="smsTextFail" name="smsTextFail" rows="5" "></textarea>
                                   
                                </div>
                                <textarea class=" form-control hidden" style="direction: ltr" id="smsIDFail" name="smsIDFail" rows="5" cols="80"></textarea>

                                <div>
                                    <label class="help-block">يمكنك ادخال أرقام بشكل يدوي، الأرقام تبدأ ب 59 ويفصل بين الأرقام ب (,)</label>
                                </div>
                                <div class="col-md-2">
                                    <button type="submit" id="clearSMSFail" class="btn btn-warning display block center-block">مسح الأرقام </button>
                                </div>
                                <div class="clearfix"></div>
                                <br>
                                <div class="col-md-2">
                                    <button type="submit" id="sendSMSFail" class="btn green display block center-block">أرسال </button>
                                </div>
                                <div class="col-md-2">
                                    <button type="submit" id="sendSMSFailBill" class="btn green display block center-block">أرسال أخر فاتورة </button>
                                </div>
                                <div class="col-md-2">
                                    <button type="submit" id="sendSMSFailSum" class="btn green display block center-block">أرسال المستحقات </button>
                                </div>
                                <div class="col-md-2">
                                    <button type="submit" id="sendSMSFailCustome" class="btn green display block center-block">أرسال نموذج </button>
                                </div>
                                <div class="clearfix"></div>
                                <br>
                                <div class="col-md-12">
                                    <div class="alert alert-info font-md"> <span> سوف يتم الارسال للأرقام الموجودة في المستطيل،</span>
                                        <span>بعد عملية الارسال يجب أن يكون المستطيل فارغ، في حالة وجود أرقام قم بالأرسال مرة أخرى فإن عملية الأرسال قد فشلت للأرقام المرجعة فقط</span>
                                    </div>
                                </div>
                            </div>
                        </div>

                </form>
            </div>
        </div>


    </div>
    <!-- END CONTENT BODY -->
</div>
<!-- END CONTENT -->
</div>
<!--  END CONTAINER -->
<script>
    $(document).ready(function() {

        window.onload = function() {
            region_get_all();
            customer_bill_get_customer();
            smsGetCredits();
        };

        smsGetCredits = function() {

            $.ajax({
                url: '<?php echo base_url(); ?>main/smsGetCredits',
                type: 'post',
                data: {
                    method: 'smsGetCredits'
                },
                success: function(data) {

                    $('#smsCredits').html('الرصيد: ' + data + '<br>');
                }


            });
        };


        $('#customer_bill_customer').change(function() {

            customer_id = $(this).children("option:selected").prop('id').split('_').pop();
            customer_jawwal = $(this).children("option:selected").attr('customer-jawwal').split('_').pop();

            smsTextFail = $('textarea[name=smsTextFail]').val().trim();
            smsIDFail = $('textarea[name=smsIDFail]').val().trim();

            if (smsTextFail == '') {
                $('textarea[name=smsTextFail]').val(customer_jawwal);
                $('textarea[name=smsIDFail]').val(customer_id);
            } else {
                $('textarea[name=smsTextFail]').val(smsTextFail + ',' + customer_jawwal);
                $('textarea[name=smsIDFail]').val(smsIDFail + ',' + customer_id);
            }

        });

        customer_bill_get_customer = function() {

            $.ajax({
                url: '<?php echo base_url(); ?>main/customer_get_for_select',
                type: 'post',
                success: function(data) {
                    arrs = JSON.parse(data);
                    $('#customer_bill_customer').selectpicker('destroy');
                    if (arrs['status'] !== 'error') {
                        var html = '<option id="customer_-1"> اختار مشترك </div>';
                        $.each(arrs, function(Index, Entry) {
                            html += '<option customer-jawwal="' + ('customer_').concat(Entry.customer_jawwal) + '" id="' + ('customer_').concat(Entry.customer_id) + '">';
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

        $('#clearSMSFail').on('click', function(e) {
            e.preventDefault();

            swal({
                    title: "هل أنت متأكد؟",
                    text: "سوف يتم مسح الأرقام من القائمة",
                    type: "warning",
                    showCancelButton: true,
                    confirmButtonColor: "#DD6B55",
                    confirmButtonText: "نعم، قم  بالمسح!",
                    cancelButtonText: "لا، إلغي المسح!",
                    closeOnConfirm: false,
                    closeOnCancel: false
                },
                function(isConfirm) {
                    if (isConfirm) {
                        $('textarea[name=smsTextFail]').val('');
                        $('textarea[name=smsIDFail]').val('');
                        swal("تم التنفيذ", "تم المسح", "success");
                    } else {
                        swal("تم الإلغاء", "لم يتم المسح", "success");
                    }
                });

        });

        $('#sendSMS').on('click', function(e) {
            e.preventDefault();

            swal({
                    title: "هل أنت متأكد؟",
                    text: "الرجاء التأكد من نص الرسالة والجهة المرسل إليها قبل التنفيذ!!",
                    type: "warning",
                    showCancelButton: true,
                    confirmButtonColor: "#DD6B55",
                    confirmButtonText: "نعم، قم  بالإرسال!",
                    cancelButtonText: "لا، إلغي الإرسال!",
                    closeOnConfirm: false,
                    closeOnCancel: false
                },
                function(isConfirm) {
                    if (isConfirm) {
                        $('button[type="submit"]').prop("disabled", true);
                        sendSMS($('#period_region').children("option:selected").prop('id').split('_').pop(), $('#period_street').children("option:selected").prop('id').split('_').pop(), $('textarea[name=smsText]').val(), 1, $('#smsTextExtra').val());
                        swal("جاري الإرسال", "تم إرسال الأمر", "info");
                    } else {
                        swal("تم الإلغاء", "لم يتم الإرسال", "error");
                    }
                });

        });

        $('#sendSMSBill').on('click', function(e) {
            e.preventDefault();

            swal({
                    title: "هل أنت متأكد؟",
                    text: "الرجاء التأكد من نص الرسالة والجهة المرسل إليها قبل التنفيذ!!",
                    type: "warning",
                    showCancelButton: true,
                    confirmButtonColor: "#DD6B55",
                    confirmButtonText: "نعم، قم  بالإرسال!",
                    cancelButtonText: "لا، إلغي الإرسال!",
                    closeOnConfirm: false,
                    closeOnCancel: false
                },
                function(isConfirm) {
                    if (isConfirm) {
                        $('button[type="submit"]').prop("disabled", true);
                        sendSMS($('#period_region').children("option:selected").prop('id').split('_').pop(), $('#period_street').children("option:selected").prop('id').split('_').pop(), $('textarea[name=smsText]').val(), 2, $('#smsTextExtra').val());
                        swal("جاري الإرسال", "تم إرسال الأمر", "info");
                    } else {
                        swal("تم الإلغاء", "لم يتم الإرسال", "error");
                    }
                });

        });
        $('#sendSMSSum').on('click', function(e) {
            e.preventDefault();

            swal({
                    title: "هل أنت متأكد؟",
                    text: "الرجاء التأكد من نص الرسالة والجهة المرسل إليها قبل التنفيذ!!",
                    type: "warning",
                    showCancelButton: true,
                    confirmButtonColor: "#DD6B55",
                    confirmButtonText: "نعم، قم  بالإرسال!",
                    cancelButtonText: "لا، إلغي الإرسال!",
                    closeOnConfirm: false,
                    closeOnCancel: false
                },
                function(isConfirm) {
                    if (isConfirm) {
                        $('button[type="submit"]').prop("disabled", true);
                        sendSMS($('#period_region').children("option:selected").prop('id').split('_').pop(), $('#period_street').children("option:selected").prop('id').split('_').pop(), $('textarea[name=smsText]').val(), 3, $('#smsTextExtra').val());
                        swal("جاري الإرسال", "تم إرسال الأمر", "info");
                    } else {
                        swal("تم الإلغاء", "لم يتم الإرسال", "error");
                    }
                });

        });
        $('#sendSMSCustome').on('click', function(e) {
            e.preventDefault();

            swal({
                    title: "هل أنت متأكد؟",
                    text: "الرجاء التأكد من نص الرسالة والجهة المرسل إليها قبل التنفيذ!!",
                    type: "warning",
                    showCancelButton: true,
                    confirmButtonColor: "#DD6B55",
                    confirmButtonText: "نعم، قم  بالإرسال!",
                    cancelButtonText: "لا، إلغي الإرسال!",
                    closeOnConfirm: false,
                    closeOnCancel: false
                },
                function(isConfirm) {
                    if (isConfirm) {
                        $('button[type="submit"]').prop("disabled", true);
                        sendSMS($('#period_region').children("option:selected").prop('id').split('_').pop(), $('#period_street').children("option:selected").prop('id').split('_').pop(), $('textarea[name=smsText]').val(), 4, $('#smsTextExtra').val());
                        swal("جاري الإرسال", "تم إرسال الأمر", "info");
                    } else {
                        swal("تم الإلغاء", "لم يتم الإرسال", "error");
                    }
                });

        });

        $('#sendSMSFail').on('click', function(e) {
            e.preventDefault();

            swal({
                    title: "هل أنت متأكد؟",
                    text: "الرجاء التأكد من نص الرسالة والجهة المرسل إليها قبل التنفيذ!!",
                    type: "warning",
                    showCancelButton: true,
                    confirmButtonColor: "#DD6B55",
                    confirmButtonText: "نعم، قم  بالإرسال!",
                    cancelButtonText: "لا، إلغي الإرسال!",
                    closeOnConfirm: false,
                    closeOnCancel: false
                },
                function(isConfirm) {
                    if (isConfirm) {
                        $('button[type="submit"]').prop("disabled", true);
                        sendSMSFail($('textarea[name=smsText]').val(), $('textarea[name=smsTextFail]').val(), $('textarea[name=smsIDFail]').val(), 1, $('#smsTextExtra').val());
                        swal("جاري الإرسال", "تم إرسال الأمر", "info");
                    } else {
                        swal("تم الإلغاء", "لم يتم الإرسال", "error");
                    }
                });

        });
        $('#sendSMSFailBill').on('click', function(e) {
            e.preventDefault();

            swal({
                    title: "هل أنت متأكد؟",
                    text: "الرجاء التأكد من نص الرسالة والجهة المرسل إليها قبل التنفيذ!!",
                    type: "warning",
                    showCancelButton: true,
                    confirmButtonColor: "#DD6B55",
                    confirmButtonText: "نعم، قم  بالإرسال!",
                    cancelButtonText: "لا، إلغي الإرسال!",
                    closeOnConfirm: false,
                    closeOnCancel: false
                },
                function(isConfirm) {
                    if (isConfirm) {
                        $('button[type="submit"]').prop("disabled", true);
                        sendSMSFail($('textarea[name=smsText]').val(), $('textarea[name=smsTextFail]').val(), $('textarea[name=smsIDFail]').val(), 2, $('#smsTextExtra').val());
                        swal("جاري الإرسال", "تم إرسال الأمر", "info");
                    } else {
                        swal("تم الإلغاء", "لم يتم الإرسال", "error");
                    }
                });

        });
        $('#sendSMSFailSum').on('click', function(e) {
            e.preventDefault();

            swal({
                    title: "هل أنت متأكد؟",
                    text: "الرجاء التأكد من نص الرسالة والجهة المرسل إليها قبل التنفيذ!!",
                    type: "warning",
                    showCancelButton: true,
                    confirmButtonColor: "#DD6B55",
                    confirmButtonText: "نعم، قم  بالإرسال!",
                    cancelButtonText: "لا، إلغي الإرسال!",
                    closeOnConfirm: false,
                    closeOnCancel: false
                },
                function(isConfirm) {
                    if (isConfirm) {
                        $('button[type="submit"]').prop("disabled", true);
                        sendSMSFail($('textarea[name=smsText]').val(), $('textarea[name=smsTextFail]').val(), $('textarea[name=smsIDFail]').val(), 3, $('#smsTextExtra').val());
                        swal("جاري الإرسال", "تم إرسال الأمر", "info");
                    } else {
                        swal("تم الإلغاء", "لم يتم الإرسال", "error");
                    }
                });

        });
        $('#sendSMSFailCustome').on('click', function(e) {
            e.preventDefault();

            swal({
                    title: "هل أنت متأكد؟",
                    text: "الرجاء التأكد من نص الرسالة والجهة المرسل إليها قبل التنفيذ!!",
                    type: "warning",
                    showCancelButton: true,
                    confirmButtonColor: "#DD6B55",
                    confirmButtonText: "نعم، قم  بالإرسال!",
                    cancelButtonText: "لا، إلغي الإرسال!",
                    closeOnConfirm: false,
                    closeOnCancel: false
                },
                function(isConfirm) {
                    if (isConfirm) {
                        $('button[type="submit"]').prop("disabled", true);
                        sendSMSFail($('textarea[name=smsText]').val(), $('textarea[name=smsTextFail]').val(), $('textarea[name=smsIDFail]').val(), 4, $('#smsTextExtra').val());
                        swal("جاري الإرسال", "تم إرسال الأمر", "info");
                    } else {
                        swal("تم الإلغاء", "لم يتم الإرسال", "error");
                    }
                });

        });

        $('textarea[name=smsText]').on('keyup', function() {
            smsText = $('textarea[name=smsText]').val().length;
            $('#smsTextLength').html(smsText);
            if (smsText > 0) {
                $('#sendSMSFail').prop("disabled", false);
                $('#sendSMS').prop("disabled", false);
            } else {
                $('#sendSMSFail').prop("disabled", true);
                $('#sendSMS').prop("disabled", true);
            }
        });


        region_get_all = function() {
            $.ajax({
                url: '<?php echo base_url(); ?>main/region_get_all',
                type: 'post',
                success: function(data) {
                    arrs = JSON.parse(data);
                    if (arrs['status'] !== 'error') {
                        var html = '<option id="region_-1"> اختار منطقة </div>';
                        $.each(arrs, function(Index, Entry) {
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

        sendSMS = function(period_region, period_street, smsText, messageType, smsTextExtra) {
            $.ajax({
                url: '<?php echo base_url(); ?>main/sendSMSLoop', /// ture use sendSMSLoop
                type: 'post',
                data: {
                    period_region: period_region,
                    period_street: period_street,
                    smsText: smsText,
                    messageType: messageType,
                    smsTextExtra: smsTextExtra
                },
                success: function(data) {
                    smsGetCredits();

                    $('button[type="submit"]').prop("disabled", false);
                    if (data != '') {
                        arrs = JSON.parse(data);

                        smsTextFail = $('textarea[name=smsTextFail]').val();
                        smsIDFail = $('textarea[name=smsIDFail]').val();

                        if (smsTextFail.trim() == '') {
                            $('textarea[name=smsTextFail]').val(arrs['customer_jawwal'].trim());
                            $('textarea[name=smsIDFail]').val(arrs['customer_id'].trim());
                        } else {
                            smsTextFail = smsTextFail + ',' + arrs['customer_jawwal'].trim();
                            smsIDFail = smsIDFail + ',' + arrs['customer_id'].trim();
                            $('textarea[name=smsTextFail]').val(smsTextFail);
                            $('textarea[name=smsIDFail]').val(smsIDFail);
                        }
                        $('html, body').animate({
                            scrollTop: $('textarea[name=smsTextFail]').offset().top - 200
                        }, 500);
                        $('textarea[name=smsTextFail]').focus();
                    }
                   
                }


            });
        };

        sendSMSFail = function(smsText, sms_fails, sms_ids, messageType, smsTextExtra) {

            $.ajax({
                url: '<?php echo base_url(); ?>main/sendSMSFail', // use : sendSMSFail
                type: 'post',
                data: {
                    smsText: smsText,
                    sms_fails: sms_fails,
                    sms_ids: sms_ids,
                    messageType: messageType,
                    smsTextExtra: smsTextExtra
                },
                success: function(data) {
                    smsGetCredits();
                    $('button[type="submit"]').prop("disabled", false);
                    $('textarea[name=smsTextFail]').val('');
                    $('textarea[name=smsIDFail]').val('');
                    if (data != '') {
                        arrs = JSON.parse(data);
                        $('textarea[name=smsTextFail]').val(arrs['customer_jawwal'].trim());
                        $('textarea[name=smsIDFail]').val(arrs['customer_id'].trim());

                        $('html, body').animate({
                            scrollTop: $('textarea[name=smsTextFail]').offset().top - 200
                        }, 500);
                        $('textarea[name=smsTextFail]').focus();
                    }

                    
                }


            });
        };

        $('#period_region').change(function() {

            street_get_all_by_region($(this).children("option:selected").prop('id').split('_').pop());

        });

        street_get_all_by_region = function(street_region) {
            $.ajax({
                url: '<?php echo base_url(); ?>main/street_get_all_by_region',
                type: 'post',
                data: {
                    street_region: street_region
                },
                success: function(data) {
                    arrs = JSON.parse(data);
                    if (arrs['status'] !== 'error') {
                        var html = '<option id="street_-1">اختر شارع</div>';
                        $.each(arrs, function(Index, Entry) {
                            html += '<option id="' + ('street_').concat(Entry.street_id) + '">';
                            html += Entry.street_name;
                            html += '</option>';
                        });
                        $('#period_street').html(html);
                    } else {

                        //  swal("Opps", arrs['msg'], "info");
                    }
                }


            });
        };


    });
</script>