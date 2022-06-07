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
                    <span>ترتيب المشتركين</span>
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

                    <button type="submit" id="period_list_ok" class="btn green display block center-block">جلب البيانات</button>

                    <div class="clearfix"></div>
                    <hr>
                    <!--                        <div class="form-group">
                                                <div class="col-md-offset-2 col-md-10">
                                                    <button type="submit" id="print_report" class="btn blue">طباعة</button>
                                                </div>
                                            </div>-->
                </form>
            </div>
        </div>
        <div class="clearfix"></div>
        <!-- END DASHBOARD STATS 1-->
        <div class="row">
            <div class="col-md-12 col-md-offset-0">
                <img class="loadingimg center-block" src="<?php echo base_url(); ?>assets_admin/global/img/loadingn" alt="جاري التحميل"/>                 
                <div class="loadingsection portlet box red">
                    <div class="portlet-title">
                        <div class="caption">
                            <i class="fa fa-comments"></i>جدول ترتيب المشتركين</div>
                        <div class="tools">
                            <!--<a id="print_report" class="fa fa-print fa-2x " style="color: #fafcfb;" data-original-title="" title=""> </a>-->
                            <a href="javascript:;" class="collapse" data-original-title="" title=""> </a>
                            <a href="#portlet-config" data-toggle="modal" class="config" data-original-title="" title=""> </a>
                            <a href="javascript:;" class="reload" data-original-title="" title=""> </a>
                            <a href="javascript:;" class="remove" data-original-title="" title=""> </a>
                        </div>
                    </div>
                    <div class="portlet-body" style="display: block;">
                        <table class="table table-striped table-hover table-bordered" id="customer_order_table">
                            <thead>
                                <tr>
                                    <th> # </th>
                                    <th>اسم المشترك</th>
                                    <th>المنطقة</th>
                                    <th>الشارع</th>
                                    <th>ترتيب المشترك الحالي</th>
                                    <th>تعديل ترتيب المشترك</th>
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
<!--  END CONTAINER -->
<script>
    $(document).ready(function () {
        var ArrayToPrint;
        var period = $('#customer_order_table').dataTable(function () {});
        window.onload = function () {
            region_get_all();
        };
        $('#period_list_ok').on('click', function (e) {
            e.preventDefault();
            period_consum_get_all($('#period_region').children("option:selected").prop('id').split('_').pop()
                    , $('#period_street').children("option:selected").prop('id').split('_').pop());
        });
        period_consum_get_all = function (period_region, period_street) {
            $('.loadingimg').show();
            $('.loadingsection').hide();
            $.ajax({
                url: '<?php echo base_url(); ?>main/period_consum_get_all',
                type: 'post',
                data: {period_region: period_region, period_street: period_street}, success: function (data) {
                    arrs = JSON.parse(data);
                    ArrayToPrint = arrs;
                    period.fnDestroy();
                    if (arrs['status'] !== 'error')
                    {
                        html = '';
                        count = 1;
                        $.each(arrs, function (Index, Entry) {
                            html += '<tr id="' + Entry.customer_id + '">';
                            html += '<td width="10px">' + count++ + '</td>';
                            html += '<td width="30%">' + Entry.customer_name + '</td>';
                            html += '<td>' + Entry.region_name + '</td>';
                            html += '<td>' + Entry.street_name + '</td>';
                            html += '<td>' + Entry.customer_order + '</td>';
                            html += '<td><input type="text" class="form-control" name="customer_order" value="' + Entry.customer_order + '"></td>';
                            html += '</tr>';
                        });
                        $('#customer_order_table tbody').html(html);

                        period = $('#customer_order_table').dataTable(function () {});

                        $('.loadingimg').hide();
                        $('.loadingsection').show();
                    } else {
                        $('#customer_order_table tbody').html('');
                        // swal("Opps", arrs['msg'], "info");
                        $('.loadingimg').hide();
                        $('.loadingsection').show();
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
                        var html = '<option id="street_-1">اختر شارع</div>';
                        $.each(arrs, function (Index, Entry) {
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

        $('table').on('blur', 'input[name=customer_order]', function () {
            trId = $(this).closest('tr').prop('id');
            customer_order_update(trId, $(this).val());
        });

        customer_order_update = function (customer_id, customer_order) {

            $.ajax({
                url: '<?php echo base_url(); ?>main/customer_order_update',
                type: 'post',
                data: {customer_id: customer_id, customer_order: customer_order},
                success: function (data) {
                    arrs = JSON.parse(data);
                    if (arrs['status'] !== 'error')
                    {
                        $('#' + customer_id).css("background-color", "rgba(0, 128, 0, 0.27)");
                    } else {
                        $('#' + customer_id).css("background-color", "rgba(255, 61, 2, 0.27)");
                        swal("Opps", arrs['msg'], "info");
                    }
                }


            });
        };



//        $('#print_report').click(function (e) {
//            e.preventDefault();
//            var period_region = $('#period_region').children("option:selected").val() !== 'اختار منطقة' ?
//                    $('#period_region').children("option:selected").val() : '';
//            var period_street = $('#period_street').children("option:selected").val() !== 'اختر شارع' ?
//                    ', ' + $('#period_street').children("option:selected").val() : '';
//
//            var report = '<style>'
//                    + '@media print {table {page-break-after: always;}}'
//                    //+ 'tr{page-break-inside: avoid !important;page-break-after: auto !important;}}'
//                    + 'th{text-align:center;font-size:14px;direction:rtl;}'
//                    + 'td{text-align:center;font-size:12px;direction:rtl;}'
//                    + 'tr{page-break-inside: avoid !important;page-break-after: auto !important;}'
//                    + '.loc_label{float:right;padding-left:10px;}'
//                    + '.loc_title{float:right;width:250px;padding-top:5px;}'
//                    + 'table{margin-bottom:5px;}ul{list-style:none;}'
//                    + '.right-header{left:0;background:#ddd;position:absolute;top:0}'
//                    + '.right-header{right:0;background:#333;position:absolute;top:0}'
//                    + '</style>';
////
//
//            var head = '<div class="row-fluid" style="padding-top:0px;'
//                    + 'padding-bottom:0px;border-bottom:2px solid #000000;margin-bottom: 0px;direction:rtl;">'
//                    + '<div style="text-align:center;font-weight:bold";margin-bottom: 0px;>' //position:relative;width:250px;height:90;margin:0 auto;
//                    + 'كشف قراءة عدادات المشتركين</div><div class="loc_title"><strong>' + period_region + '  ' + period_street + '</strong></div></div>'
//                    + '<div class="row-fluid" style="padding-top:5px;padding-bottom:5px;margin-bottom:5px;direction:rtl;">'
//                    + '<div class="loc_label"></div>'
//                    + '</div>';
//            var header = '<table width="100%" border="1" cellspacing="0" cellpadding="5">'
//                    + '<tr><th width="8%" scope="col">ملاحظة</th>'
//                    + '<th width="8%" scope="col">مجموع المستحقات</th>'
//                    + '<th width="8%" scope="col">مستحقات الفتورة السابقة</th>'
//                    + '<th width="8%" scope="col">القراءة الحالية</th>'
//                    + '<th width="8%" scope="col">القراءة السابقة</th>'
//                    + '<th width="8%" scope="col">تاريخ القراءة السابقة</th>'
//                    + '<th width="6%" scope="col">الشارع</th>'
//                    + '<th width="6%" scope="col">المنطقة</th>'
//                    + '<th width="12%" scope="col">اسم المشترك</th>'
//                    + '<th width="2%"  scope="col">م</th></tr>';
//            var temp = '';
//            var ptype;
//            var ptype2;
//            var status = "";
//            var p_type = "";
//            if (ArrayToPrint.length > 20)
//            {
//
//                for (var i = 0; i < ArrayToPrint.length; i++)
//                {
//                    var row = ArrayToPrint[i];
//                    if (i % 20 == 0)
//                    {
//                        if (i > ArrayToPrint.length)
//                        {
//                            temp += '</tbody></table><div style="clear:both;"></div>';
//                        }
//                        if (i == 0) {
//                            temp += '</tbody></table>';
//                            temp += header;
//                        } else {
//                            temp += '</tbody></table><br><div class="p-break"></div>';
//                            temp += header;
//                        }
//                    }
//
//                    temp += '<tr><td><span style=" font-size: 120%;">' + row.period_note + '</span></td>'
//                            + '<td><span style=" font-size: 120%;">' + row.bill_sum + '</span></td>'
//                            + '<td><span style=" font-size: 120%;">' + row.bill_reminder + '</span></td>'
//                            + '<td><span style=" font-size: 120%;">ـ ـ ـ ـ ـ ـ</span></td>'
//                            + '<td><span style=" font-size: 120%;">' + row.period_reading + '</span></td>'
//                            + '<td><span style=" font-size: 120%;">' + row.period_reading_date + '</span></td>'
//                            + '<td><span style=" font-size: 120%;">' + row.street_name + '</span></td>'
//                            + '<td><span style=" font-size: 120%;">' + row.region_name + '</span></td>'
//                            + '<td><span style=" font-size: 120%;">' + row.customer_name + '</span></td>'
//                            + '<td><span style=" font-size: 120%;">' + (parseInt(i) + 1) + '</span></td>';
//
//                } // end for			
//
//                report += head;
//                report += temp;
//
//            } else if (ArrayToPrint.length <= 20)
//            {
//                temp += header;
//                for (var i = 0; i < ArrayToPrint.length; i++)
//                {
//                    var row = ArrayToPrint[i];
//                    temp += '<tr><td><span style=" font-size: 120%;">' + row.period_note + '</span></td>'
//                            + '<td><span style=" font-size: 120%;">' + row.bill_sum + '</span></td>'
//                            + '<td><span style=" font-size: 120%;">' + row.bill_reminder + '</span></td>'
//                            + '<td><span style=" font-size: 120%;">ـ ـ ـ ـ ـ ـ</span></td>'
//                            + '<td><span style=" font-size: 120%;">' + row.period_reading + '</span></td>'
//                            + '<td><span style=" font-size: 120%;">' + row.period_reading_date + '</span></td>'
//                            + '<td><span style=" font-size: 120%;">' + row.street_name + '</span></td>'
//                            + '<td><span style=" font-size: 120%;">' + row.region_name + '</span></td>'
//                            + '<td><span style=" font-size: 120%;">' + row.customer_name + '</span></td>'
//                            + '<td><span style=" font-size: 120%;">' + (parseInt(i) + 1) + '</span></td>';
//                } // end for
//                report += head;
//                report += temp;
//                report = report + '</table>';
//                temp = '';
//            }
//            var newWindow = window.open('', '', 'width=1000, height=600'),
//                    document = newWindow.document.open();
//
//            document.write(report);
//            report = '';
//
//            document.close();
//            newWindow.print();
//
//        });

    });

</script>