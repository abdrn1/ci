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
                        <span>المشتركين</span>
                    </li>
                </ul>
            </div>
            <!-- END PAGE HEADER-->
            <!-- BEGIN DASHBOARD STATS 1-->

            <div class="row">
                <div class="col-md-10 col-md-offset-1">
                    <form class="form-inline margin-bottom-30" role="form" method="post" action="" id="customer" enctype="multipart/form-data">

                        <div class="form-inline">
                            <label for="customer_name" class="col-md-2 control-labeli">اسم المشترك</label>
                            <div class="col-md-4">
                                <input type="text" class="form-control" id="customer_name" name="customer_name" placeholder="اسم المشترك">
                            </div>
                        </div>
                        <div class="form-inline">
                            <label for="customer_jawwal" class="col-md-2 control-labeli">هاتف المشترك</label>
                            <div class="col-md-4">
                                <input type="text" class="form-control" id="customer_jawwal" name="customer_jawwal" placeholder="هاتف المشترك">
                            </div>
                        </div>
                        <div class="form-inline">
                            <label for="customer_serial_number" class="col-md-2 control-labeli">الرقم المتسلسل للعداد</label>
                            <div class="col-md-4">
                                <input type="text" class="form-control" id="customer_serial_number" name="customer_serial_number" placeholder="الرقم المتسلسل للعداد">
                            </div>
                        </div>
                        <div class="form-inline">
                            <label for="customer_region" class="col-md-2 control-labeli">المنطقة</label>
                            <div class="col-md-4">
                                <select class="form-control" id="customer_region">
                                    <option id="region_-1">اختر منطقة</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-inline">
                            <label for="customer_street" class="col-md-2 control-labeli">الشارع</label>
                            <div class="col-md-4">
                                <select class="form-control" id="customer_street">
                                    <option id="region_-1">اختر شارع</option>
                                </select>
                            </div>
                        </div>

                        <div class="form-inline">
                            <label for="customer_jawwal" class="col-md-2 control-labeli">سعر الوحدة</label>
                            <div class="col-md-4">
                                <input type="text" class="form-control" id="customer_price" name="customer_price" placeholder="السعر للمشترك">
                            </div>
                        </div>
                        <input type="hidden" name="customer_id" value="-1" id="customer_id" />

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
                                <i class="fa fa-comments"></i>جدول المشتركين</div>
                            <div class="tools">
                                <a id="print_report" class="fa fa-print fa-2x " style="color: #fafcfb;" data-original-title="" title=""> </a>
                                <a href="javascript:;" class="collapse" data-original-title="" title=""> </a>
                                <a href="#portlet-config" data-toggle="modal" class="config" data-original-title="" title=""> </a>
                                <a href="javascript:;" class="reload" data-original-title="" title=""> </a>
                                <a href="javascript:;" class="remove" data-original-title="" title=""> </a>
                            </div>
                        </div>
                        <div class="portlet-body" style="display: block;">
                            <table class="table table-striped table-hover table-bordered" id="customer_table">
                                <thead>
                                    <tr>
                                        <th> # </th>
                                        <th>اسم المشترك</th>
                                        <th> رقم الجوال</th>
                                        <th width="5%">السعر</th>
                                        <th>  الرقم المتسلسل للعداد</th>                                      
                                        <th>قراءة أخر دورة</th>
                                        <th>تاريخ أخر دورة</th>
                                        <th> المنطقة</th>
                                        <th> الشارع</th>
                                        <th> تعديل </th>
                                        <th> حذف </th>
                                    </tr>
                                </thead>
                                <tbody>

                                </tbody>

                                <thead>
                                    <tr>
                                        <th> # </th>
                                        <th>اسم المشترك</th>
                                        <th> رقم الجوال</th>
                                        <th>السعر</th>
                                        <th>  الرقم المتسلسل للعداد</th>                                      
                                        <th>قراءة أخر دورة</th>
                                        <th>تاريخ أخر دورة</th>
                                        <th> المنطقة</th>
                                        <th> الشارع</th>
                                        <th> تعديل </th>
                                        <th> حذف </th>
                                    </tr>
                                </thead>
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
        var ArrayToPrint;
        //   var customer = $('#customer_table').dataTable(function () {});

        window.onload = function () {
            region_get_all();
        };
        $('table').on('click', '#edit', function (e) {
            customer_get_selected($(this).attr('customer-id'));
        });
        $('table').on('click', '#delete', function (e) {

            customer_row_id = $(this).attr('customer-id');
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
                            customer_delete(customer_row_id);
                        } else {
                            swal("تم الإلغاء", "لم يتم الحذف", "error");
                        }
                    });
        });
        customer_get_print = function () {

            $.ajax({
                url: '<?php echo base_url(); ?>main/customer_get_print',
                type: 'post',
                success: function (data) {

                    arrs = JSON.parse(data);
                    ArrayToPrint = arrs;

                    if (arrs['status'] !== 'error') {
                        customer_print();
                    } else
                    {
                        swal("Opps", arrs['msg'], "info");
                    }
                }


            });
        };
        table = $('#customer_table').DataTable({

            "processing": true, //Feature control the processing indicator.
            "serverSide": true, //Feature control DataTables' server-side processing mode.
            "order": [], //Initial no order.

            // Load data for the table's content from an Ajax source
            "ajax": {
                "url": "<?php echo site_url('main/customer_get_all') ?>",
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
                        var html = '<option id="region_-1"> إختار منطقة </div>';
                        $.each(arrs, function (Index, Entry) {
                            html += '<option id="' + ('region_').concat(Entry.region_id) + '">';
                            html += Entry.region_name;
                            html += '</option>';
                        });
                        $('#customer_region').html(html);
                    } else {

                        swal("Opps", arrs['msg'], "info");
                    }
                }


            });
        };
        $('#customer_region').change(function () {
            street_get_all_by_region($(this).children("option:selected").prop('id').split('_').pop());
        });
        street_get_all_by_region = function (street_region) {
            $.ajax({
                url: '<?php echo base_url(); ?>main/street_get_all_by_region',
                type: 'post',
                data: {street_region: street_region},
                success: function (data) {
                    arrs = JSON.parse(data);
                    if (arrs['status'] !== 'error')
                    {
                        var html = '<option id="street_-1"> إختار شارع </div>';
                        $.each(arrs, function (Index, Entry) {
                            html += '<option id="' + ('street_').concat(Entry.street_id) + '">';
                            html += Entry.street_name;
                            html += '</option>';
                        });
                        $('#customer_street').html(html);
                    } else {

                        swal("Opps", arrs['msg'], "info");
                    }
                }


            });
        };
        customer_get_selected = function (customer_id) {
            $.ajax({
                url: '<?php echo base_url(); ?>main/customer_get_selected',
                type: 'post',
                data: {customer_id: customer_id},
                success: function (data) {
                    arrs = JSON.parse(data);
                    if (arrs['status'] !== 'error')
                    {
                        html = '';
                        count = 1;
                        $.each(arrs, function (Index, Entry) {
                            $('#save').attr('action', 'update');
                            $('#save').text('تحديث');
                            $('#customer_id').val(customer_id);
                            $('#customer_name').val(Entry.customer_name).focus();
                            $('#customer_price').val(Entry.customer_price);
                            $('#customer_jawwal').val(Entry.customer_jawwal);
                            $('#customer_serial_number').val(Entry.customer_serial_number);
                            $('#customer_region').val(Entry.region_name);
                            getStreetsAndSelect($('#customer_region').children("option:selected").prop('id').split('_').pop(),Entry.street_name);
                        });
                    } else {
                        swal("Opps", arrs['msg'], "info");
                    }
                }
            });
        };


        getStreetsAndSelect = function (street_region,street) {
            $.ajax({
                url: '<?php echo base_url(); ?>main/street_get_all_by_region',
                type: 'post',
                data: {street_region: street_region},
                success: function (data) {
                    arrs = JSON.parse(data);
                    if (arrs['status'] !== 'error')
                    {
                        var html = '<option id="street_-1"> إختار شارع </div>';
                        $.each(arrs, function (Index, Entry) {
                            html += '<option id="' + ('street_').concat(Entry.street_id) + '">';
                            html += Entry.street_name;
                            html += '</option>';
                        });
                        $('#customer_street').html(html);
                        $('#customer_street').val(street);
                    } else {

                        swal("Opps", arrs['msg'], "info");
                    }
                }


            });
        };

        customer_delete = function (customer_id) {
            $.ajax({
                url: '<?php echo base_url(); ?>main/customer_delete',
                type: 'post',
                data: {customer_id: customer_id},
                success: function (data) {
                    arrs = JSON.parse(data);
                    if (arrs['status'] !== 'error')
                    {
                        table.ajax.reload();
                        swal("Success", arrs['msg'], "success");
                    } else {
                        swal("Opps", arrs['msg'], "info");
                    }
                }


            });
        };
        $("#customer").validate({
            // Specify validation rules
            rules: {
                // The key name on the left side is the name attribute
                // of an input field. Validation rules are defined
                // on the right side
                customer_name: "required",
                customer_region: "required",
                customer_street: "required"
//                customer_jawwal: "required",
                        //               customer_serial_number: "required"
            },
            // Specify validation error messages
            messages: {
                customer_name: "الرجاء كتابة اسم الشارع",
                customer_region: "الرجاء اختار منطقة",
                customer_street: "الرجاء اختار الشارع"
//                customer_jawwal: "الرجاء كتابة رقم الهاتف",
//                customer_serial_number: "الرجاء كتابة الرقم التسلسلي"
            },
            // Make sure the form is submitted to the destination defined
            // in the "action" attribute of the form when valid
            submitHandler: function (form) {
                var fd = new FormData(form);
                fd.append('customer_id', $('#customer_id').val());
                fd.append('customer_street', $("#customer_street option:selected").prop('id').split("_").pop());
                //fd.append('image2', $('input[type=file]')[0].files[0] ); etc..
                $url = '';
                if ($('#save').attr('action') === 'add') {
                    $url = '<?php echo base_url(); ?>main/customer_insert';
                } else if ($('#save').attr('action') === 'update') {
                    $url = '<?php echo base_url(); ?>main/customer_update';
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
                            $('#customer_name').val('').focus();
                            $('#customer_region').val('');
                            //$('input[type=file]').replaceWith($('input[type=file]').val('').clone(true));
                            $('#customer').get(0).reset();
                            $('#save').text('إضافة');
                            $('#save').attr('action', 'add');
                            table.ajax.reload();
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
        $('#print_report').click(function (e) {
            e.preventDefault();
            customer_get_print();
        });
        customer_print = function () {
            var report = '<style>'
                    + '@media print {.p-break {page-break-before: always;}}'
                    + 'th{text-align:center;font-size:14px;direction:rtl;}'
                    + 'td{text-align:center;font-size:12px;direction:rtl;}'
                    + '.loc_label{float:right;padding-left:10px;}'
                    + '.loc_title{float:right;width:250px;padding-top:10px;}'
                    + 'table{margin-bottom:20px;}ul{list-style:none;}'
                    + '.right-header{left:0;background:#ddd;position:absolute;top:0}'
                    + '.right-header{right:0;background:#333;position:absolute;top:0}'
                    + '</style>';
//
            var header = '<div class="row-fluid" style="padding-top:10px;'
                    + 'padding-bottom:5px;border-bottom:2px solid #000000;margin-bottom: 10px;direction:rtl;">'
                    + '<div style="text-align:center;font-weight:bold";margin-bottom: 5px;>' //position:relative;width:250px;height:90;margin:0 auto;
                    + 'كشف  المشتركين</div></div>'
                    + '<div class="row-fluid" style="padding-top:5px;padding-bottom:5px;margin-bottom:5px;direction:rtl;">'
                    + '<div class="loc_label"></div>'
                    + '</div><table width="100%" border="1" cellspacing="0" cellpadding="5">'
                    + '<th width="8%" scope="col">الشارع</th>'
                    + '<th width="8%" scope="col">المنطقة</th>'
                    + '<th width="8%" scope="col">رقم العداد</th>'
                    + '<th width="6%" scope="col">رقم الجوال</th>'
                    + '<th width="12%" scope="col">اسم المشترك</th>'
                    + '<th width="2%"  scope="col">م</th></tr>';
            var temp = '';
            var ptype;
            var ptype2;
            var status = "";
            var p_type = "";
            if (ArrayToPrint.length > 30)
            {

                for (var i = 0; i < ArrayToPrint.length; i++)
                {
                    var row = ArrayToPrint[i];
                    if (i % 30 == 0)
                    {
                        if (i > ArrayToPrint.length)
                        {
                            temp += '</tbody></table><div style="clear:both;"></div>';
                        }
                        temp += '</tbody></table><div class="p-break" style="clear:both;"><br><br></div>';
                        temp += header;
                    }

                    temp += '<tr><td><span style=" font-size: 120%;">' + row.street_name + '</span></td>'
                            + '<td><span style=" font-size: 120%;">' + row.region_name + '</span></td>'
                            + '<td><span style=" font-size: 120%;">' + row.customer_serial_number + '</span></td>'
                            + '<td><span style=" font-size: 120%;">' + row.customer_jawwal + '</span></td>'
                            + '<td><span style=" font-size: 120%;">' + row.customer_price + '</span></td>'
                            + '<td><span style=" font-size: 120%;">' + row.customer_name + '</span></td>'
                            + '<td><span style=" font-size: 120%;">' + (parseInt(i) + 1) + '</span></td>';
                } // end for			

                report += temp;
            } else if (ArrayToPrint.length <= 30)
            {
                temp += header;
                for (var i = 0; i < ArrayToPrint.length; i++)
                {
                    var row = ArrayToPrint[i];
                    temp += '<tr><td><span style=" font-size: 120%;">' + row.street_name + '</span></td>'
                            + '<td><span style=" font-size: 120%;">' + row.region_name + '</span></td>'
                            + '<td><span style=" font-size: 120%;">' + row.customer_serial_number + '</span></td>'
                            + '<td><span style=" font-size: 120%;">' + row.customer_jawwal + '</span></td>'
                            + '<td><span style=" font-size: 120%;">' + row.customer_price + '</span></td>'
                            + '<td><span style=" font-size: 120%;">' + row.customer_name + '</span></td>'
                            + '<td><span style=" font-size: 120%;">' + (parseInt(i) + 1) + '</span></td>';
                } // end for
                report += temp;
                report = report + '</table>';
                temp = '';
            }
            var newWindow = window.open('', '', 'width=1000, height=600'),
                    document = newWindow.document.open();
            document.write(report);
            report = '';
            document.close();
            newWindow.print();
        };
    });

</script>