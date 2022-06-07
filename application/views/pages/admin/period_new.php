<?php ?>


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
                    <span>الدورة</span>
                </li>
            </ul>
        </div>
        <!-- END PAGE HEADER-->
        <!-- BEGIN DASHBOARD STATS 1-->

        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                <form class="form-inline margin-bottom-30" role="form" method="post" action="" id="period" enctype="multipart/form-data">


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
                    <div class="form-inline">
                        <label for="period_date" class="col-md-2 control-labeli">دورة شهر</label>
                        <div class="col-md-4">
                            <input type="month" class="form-control monthpicker" id="period_date" name="period_date" placeholder="اسم المشترك">
                        </div>
                    </div>
                    <div class="clearfix"></div>
                    <div class="form-inline">
                        <label for="period_reading_date" class="col-md-2 control-labeli">تاريخ قراءة العداد</label>
                        <div class="col-md-4">
                            <input type="date" class="form-control" id="period_reading_date" name="period_reading_date" >
                        </div>
                    </div>
                    <!--                    <div class="form-inline">
                                            <label for="period_price" class="col-md-2 control-labeli">السعر</label>
                                            <div class="col-md-4">
                                                <input type="text" class="form-control" id="period_price" name="period_price" placeholder="السعر">
                                            </div>
                                        </div>-->
                    <div class="clearfix">
                    </div>
                    <br>

                    <input type="hidden" name="period_id" value="-1" id="period_id" />


                </form>
            </div>
        </div>
        <div class="clearfix"></div>
        <!-- END DASHBOARD STATS 1-->
        <div class="row">
            <div class="col-md-12 col-md-offset-0">
                <img class="loadingimg center-block" src="<?php echo base_url(); ?>assets_admin/global/img/loadingn.gif" alt="جاري التحميل"/>                                   
                <div class="loadingsection portlet box red">
                    <div class="portlet-title">
                        <div class="caption">
                            <i class="fa fa-comments"></i>جدول الدورات</div>
                        <div class="tools">
                            <a href="javascript:;" class="collapse" data-original-title="" title=""> </a>
                            <a href="#portlet-config" data-toggle="modal" class="config" data-original-title="" title=""> </a>
                            <a href="javascript:;" class="reload" data-original-title="" title=""> </a>
                            <a href="javascript:;" class="remove" data-original-title="" title=""> </a>
                        </div>
                    </div>
                    <div class="portlet-body" style="display: block;">
                        <table class="table table-striped table-hover table-bordered" id="period_table">
                            <thead>
                                <tr>
                                    <th> # </th>
                                    <th>اسم المشترك</th>
                                    <th>السعر</th>
                                    <th>رسوم إضافية</th>
                                    <th>تاريخ آخر قراءة</th>
                                    <th>قراءة العداد السابقة</th>
                                    <th>قراءة العداد</th>
                                    <th>الإستهلاك الشهري</th>
                                    <th>قيمة الفاتورة</th>
                                    <th>مجموع المستحقات</th>                               
                                    <th>دفعة مالية</th>                               
                                    <th>مبلغ الخصم</th>                               
                                    <th>ملاحظة</th>
                                    <th>الفواتير</th>
                                </tr>
                            </thead>
                            <tbody>

                            </tbody>
                        </table>
                        <button id="saveAll" class="btn btn-primary" style="width: 100px;display:block;margin: 20px auto auto auto">حفظ</button>
                    </div>
                </div>
            </div>
        </div>


        <!-- Modal Bill -->
        <div class="modal fade" id="billModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">الفواتير</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="container-fluid">
                            <div class="row">
                                <div class="col-md-12 col-md-offset-0">
                                    <div class="portlet box red">
                                        <div class="portlet-title">
                                            <div class="caption">
                                                <i class="fa fa-comments"></i>جدول فواتير المشترك</div>
                                            <div class="tools">
                                                <!--<a id="print_report" class="fa fa-print fa-2x " style="color: #fafcfb;" data-original-title="" title=""> </a>-->
                                              
                                                <a href="#portlet-config" data-toggle="modal" class="config" data-original-title="" title=""> </a>
                                                <a href="javascript:;" class="reload" data-original-title="" title=""> </a>
                                               
                                            </div>
                                        </div>
                                        <div class="portlet-body" style="display: block;">
                                            <table class="table table-striped table-hover table-bordered" id="customer_bill_table">
                                                <thead>
                                                    <tr>
                                                        <th> # </th>
                                                        <th>تاريخ القراءة</th>
                                                        <th>القراءة السابقة</th>
                                                        <th>القراءة الحالية</th>
                                                        <th>الاستهلاك الشهري</th>
                                                        <th>السعر</th>
                                                        <th>قيمة الفاتورة</th>
                                                        <th>المدفوع</th>
                                                        <th>الخصم</th>
                                                        <th>المتبقي</th>                            
                                                        <th>قيمة الدفع</th>                            
                                                        <th>قيمة الخصم</th>                            
                                                        <th>تنفيذ</th>                            
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
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">إغلاق</button>
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
        var period_server_price = 0;
        var customer_bill_id = -1;
        var bill_ids = new Array();
        var bill_periods = new Array();
        var bill_print;
        var payment_print;
        var add_cost_print = new Array();
        var customer_name_print;
        var period_date_print;
        let periodsToSave = new Array();
        var current_bill_total = 0.0;
        var period = $('#period_table').dataTable(function () {
        });
        mon = new Date().getMonth() + 1;
        month = mon < 10 ? '0' + mon : mon;
        year = new Date().getFullYear();
        day = 1;
       
        var fullMonth = year + '-' + month;
        var fullDate = fullMonth + '-0' + 1;
        var fullDate2 = fullMonth + '-' + new Date().getDate();
        var currentDate = new Date();
        window.onload = function () {
            region_get_all();
            period_get_price();
            $('#period_date').val(fullMonth);
            $('#period_reading_date').val(moment(currentDate).format('YYYY-MM-DD'));
            
        };

        $('#period_list_ok').on('click', function (e) {
            e.preventDefault();
            period_get_all_list(fullDate, $('#period_region').children("option:selected").prop('id').split('_').pop()
                    , $('#period_street').children("option:selected").prop('id').split('_').pop());
        });

        $('table').on('focus', 'input[name=period_reading]', function () {
            trId = $(this).closest('tr').prop('id').split('_').pop();
            period_prev_value = $('#period_' + trId + ' input[name=period_previous_reading]').val();
            if (period_prev_value === "0" || period_prev_value === "00" || period_prev_value === "") {
                $('#period_' + trId + ' input[name=period_previous_reading]').val("00");
                $('#period_' + trId + ' input[name=period_previous_reading]').prop("disabled", false);
            } else {
                $('#period_' + trId + ' input[name=period_previous_reading]').prop("disabled", true);
            }

        });
        $('table').on('keyup', 'input[name=period_reading]', function () {
            trId = $(this).closest('tr').prop('id').split('_').pop();
            period_read = $(this).val();
			if(!period_read){
                return
            }
            period_prev_value = $('#period_' + trId + ' input[name=period_previous_reading]').val();
            period_consum = parseFloat(period_read) - parseFloat(period_prev_value);
            $('#period_' + trId + ' input[name=period_consum]').val(period_consum);
            $('#period_' + trId + ' input[name=period_price]').val() === '' ? price = period_server_price : price = $('#period_' + trId + ' input[name=period_price]').val();
            $('#period_' + trId + ' input[name=bill_value]').val(parseFloat(period_consum) * parseFloat(price));

        });
        $('table').on('keyup', 'input[name=period_previous_reading]', function () {
            trId = $(this).closest('tr').prop('id').split('_').pop();
            period_prev_value = $(this).val();
            period_read = $('#period_' + trId + ' input[name=period_reading]').val();
            period_consum = parseFloat(period_read) - parseFloat(period_prev_value);
            $('#period_' + trId + ' input[name=period_consum]').val(period_consum);
            $('#period_' + trId + ' input[name=period_price]').val() === '' ? price = period_server_price : price = $('#period_' + trId + ' input[name=period_price]').val();
            $('#period_' + trId + ' input[name=bill_value]').val(parseFloat(period_consum) * parseFloat(price));

        });

        $('table').on('keyup', 'input[name=period_reading]', function () {
            prev_value = $(this).closest('tr').find('input[name=period_previous_reading]').val();
            current_value = $(this).val();
            if(!current_value){
                return
            }
            if (parseFloat(prev_value) > parseFloat(current_value)) {
                $(this).css("border", "1px dashed red");
                $(this).closest('tr').find('input[name=period_note]').attr("disabled", true);
            } else {
                $(this).css("border", "1px solid green");
                $(this).closest('tr').find('input[name=period_note]').attr("disabled", false);
            }
            let rowId = $(this).closest('tr').attr('id');
            let found = periodsToSave.find(value => value == rowId);
            if(!found){
                periodsToSave.push(rowId);
            }
        });

        $('#saveAll').on('click',function () {
            if($("#period_reading_date").val()==''){
                alert('الرجاء تحديد تاريخ القراءة');
                return;
            }
            
            let temp = [];
            periodsToSave.map(val => {
                temp.push(val);
            });
            temp.forEach(value => {
                let trId = value.split('_').pop();
                period_date = $('#period_date').val();
                period_price = $('#period_' + trId + ' input[name=period_price]').val();
                period_add_money = $('#period_' + trId + ' input[name=period_add_money]').val();
                period_customer = trId;
                period_value = $('#period_' + trId + ' input[name=period_reading]').val();
                period_reading_date = $('#period_reading_date').val();
                period_prev_value = $('#period_' + trId + ' input[name=period_previous_reading]').val();
                period_note = $('#period_' + trId + ' input[name=period_note]').val();
                payment_value = $('#period_' + trId + ' input[name=payment_value]').val();
                payment_discount = $('#period_' + trId + ' input[name=payment_discount]').val();

                period_insert_save_all(period_date, period_price, period_add_money, period_customer, period_value, period_reading_date
                    , period_prev_value, period_note, payment_value, payment_discount);
            })
        });



        period_insert_save_all = function (period_date, period_price, period_add_money, period_customer, period_reading, period_reading_date
            , period_previous_reading, period_note, payment_value, payment_discount) {
            if(!period_note){
                period_note = '';
            }
            $.ajax({
                url: '<?php echo base_url(); ?>main/period_insert',
                type: 'post',
                data: {
                    period_date: period_date,
                    period_price: period_price,
                    period_add_money: period_add_money,
                    period_customer: period_customer,
                    period_reading: period_reading,
                    period_reading_date: period_reading_date,
                    period_previous_reading: period_previous_reading,
                    period_note: period_note,
                    payment_value: payment_value,
                    payment_discount: payment_discount
                },
                success: function (data) {
                    arrs = JSON.parse(data);
                    if (arrs['status'] !== 'error') {
                        $('#period_' + period_customer).css("background-color", "rgba(0, 128, 0, 0.27)");
                        $('#period_' + period_customer + ' input[name=period_previous_reading]').prop("disabled", true);
                        $('#period_' + period_customer + ' input[name=period_reading]').prop("disabled", true);
                        $('#period_' + period_customer + ' .print_cell').html('<span id=' + arrs['bill_id'] + ' class="fa fa-print"></span>');
                        $('#period_' + period_customer + ' .print_cell').css('color', '#bf8808');
                        $('#period_' + period_customer + ' .print_cell').css('text-align', 'center');
                        $('#period_' + period_customer + ' .print_cell').css('vertical-align', 'middle');
                        $('#period_' + period_customer + ' .print_cell').css('cursor', 'pointer');
                        $('#period_' + period_customer + ' .print_cell .fa').css('font-size', '25px');
                        $('#period_' + period_customer + ' .print_cell .fa').css('padding-top', '5px');
                        bill_get_debt_save_all(period_customer);
                        let foundIndex = periodsToSave.findIndex(value => value == 'period_'+ period_customer);
                        if(foundIndex != -1){
                            periodsToSave.splice(foundIndex,1);
                        }
                    } else {
                        $('#period_' + period_customer).css("background-color", "rgba(255, 61, 2, 0.27)");
                    }
                }


            });
        };


        bill_get_debt_save_all = function (customer_bill) {
            $.ajax({
                url: '<?php echo base_url(); ?>main/bill_get_debt',
                type: 'post',
                data: {customer_id: customer_bill},
                success: function (data) {
                    arrs = JSON.parse(data);
                    if (arrs['status'] !== 'error') {
                        $.each(arrs, function (Index, Entry) {
                            $('#period_' + customer_bill + ' input[name=bill_total]').val(parseFloat(Entry.bill_debt).toFixed(2));
                            bill_total = parseFloat(Entry.bill_debt).toFixed(2);

                        });
                    } else {
                        $('#payment_debt').html();
                        // swal("Opps", arrs['msg'], "info");
                    }
                }
            });
        };

        $('table').on('blur', 'input[name=period_note]', function () {
            
            trId = $(this).closest('tr').prop('id').split('_').pop();
            period_date = $('#period_date').val();
            period_price = $('#period_' + trId + ' input[name=period_price]').val();
            period_add_money = $('#period_' + trId + ' input[name=period_add_money]').val();
            period_customer = trId;
            period_value = $('#period_' + trId + ' input[name=period_reading]').val();
            period_reading_date = $('#period_reading_date').val();
            period_prev_value = $('#period_' + trId + ' input[name=period_previous_reading]').val();
            period_note = $('#period_' + trId + ' input[name=period_note]').val();
            payment_value = $('#period_' + trId + ' input[name=payment_value]').val();
            payment_discount = $('#period_' + trId + ' input[name=payment_discount]').val();

            period_insert(period_date, period_price,period_add_money, period_customer, period_value, period_reading_date
                    , period_prev_value, period_note, payment_value, payment_discount);

        });
        $('table').on('blur', 'input[name=period_price]', function () {
            period_customer = $(this).closest('tr').prop('id').split('_').pop();
            period_price = $(this).val();
            customer_price_update(period_customer,period_price);
        });

        customer_price_update = function (customer_id, period_price) {

            $.ajax({
                url: '<?php echo base_url(); ?>main/customer_price_update',
                type: 'post',
                data: {customer_id: customer_id, customer_price: period_price},
                success: function (data) {
//                    arrs = JSON.parse(data);
//                    if (arrs['status'] !== 'error')
//                    {
//                        $('#' + customer_id).css("background-color", "rgba(0, 128, 0, 0.27)");
//                    } else {
//                        $('#' + customer_id).css("background-color", "rgba(255, 61, 2, 0.27)");
//                        swal("Opps", arrs['msg'], "info");
//                    }
                }


            });
        };

        period_get_all_list = function (period_date, period_region, period_street) {
            $('.loadingimg').show();
            $('.loadingsection').hide();
            $.ajax({
                url: '<?php echo base_url(); ?>main/period_get_all_list',
                type: 'post',
                data: {period_date: period_date, period_region: period_region, period_street: period_street},
                success: function (data) {
                   console.log(data);
                   

                    arrs = JSON.parse(data);
                   
                    period.fnDestroy();

                    if (arrs['status'] !== 'error')
                    {
                        html = '';
                        count = 1;
                        
                        $.each(arrs, function (Index, Entry) {
                            console.log("")
                            
                            if(Entry.customer_price==''|| Entry.customer_price==0){
                                customer_price ='';
                            }else{
                                customer_price = Entry.customer_price; 
                            }
                            html += '<tr id="' + ('period_').concat(Entry.customer_id) + '">';
                            html += '<td width="10px">' + count++ + '</td>';
                            html += '<td>' + Entry.customer_name + '</td>';
                            html += '<td><input type="text" class="form-control" name="period_price" value="' +customer_price + '"  placeholder="السعر"></td>';
                            html += '<td><input type="text" class="form-control" name="period_add_money" value=""  placeholder="رسوم إضافية"></td>';
                            html += '<td>' + Entry.period_reading_date + '</td>';
                            html += '<td><input type="text" class="form-control"  disabled name="period_previous_reading" value="' + Entry.period_reading + '"></td>';
                            html += '<td><input type="text" class="form-control"  name="period_reading" placeholder="قراءة العداد"></td>';
                            html += '<td><input type="text" class="form-control"  disabled name="period_consum" value=""></td>';
                            html += '<td><input type="text" class="form-control"  disabled name="bill_value" value=""></td>';
                            html += '<td><input type="text" class="form-control"  disabled name="bill_total" value="' + Entry.bill_sum + '"></td>';
                            html += '<td><input type="text" class="form-control"  name="payment_value" placeholder="المبلغ للدفع"></td>';
                            html += '<td><input type="text" class="form-control"  name="payment_discount" placeholder="الخصم"></td>';
                            html += '<td class="print_cell"><input type="text" class="form-control"  name="period_note" placeholder="ملاحظة"></td>';
                            html += '<td class="show_bills" style="color:green;text-align: center;vertical-align: middle;cursor: pointer;" ><span class="fa fa-caret-square-o-left"></span></td>';
                            html += '</tr>';
                        });
                        $('#period_table tbody').html(html);

                        period = $('#period_table').dataTable(function () {
                        });
                        $('.loadingimg').hide();
                        $('.loadingsection').show();

                    } else {
                        $('#period_table tbody').html('');
                        // swal("Opps", arrs['msg'], "info");
                        $('.loadingimg').hide();
                        $('.loadingsection').show();
                    }
                }


            });
        };


        $('table').on('click', '.show_bills', function (e) {
            customer_id = $(this).closest('tr').prop('id').split('_').pop();
            // alert(customer_id);
            customer_bill_id = customer_id;
            customer_bill_get_reminder(customer_id, -1);


        });
        $('table').on('click', '.print_cell .fa', function (e) {
            customer_id = $(this).closest('tr').attr('id').split('_').pop();
            bill_id = $(this).attr('id');
            current_bill_total = $('#period_' + customer_id + ' input[name=bill_total]').val();

            customer_bill_get_all(customer_id, bill_id);
            // alert(customer_id);
            //customer_bill_id = customer_id;
            //customer_bill_get_reminder(customer_id, -1);


        });

        bill_get_debt = function () {
            $.ajax({
                url: '<?php echo base_url(); ?>main/bill_get_debt',
                type: 'post',
                data: {customer_id: customer_bill_id},
                success: function (data) {
                    arrs = JSON.parse(data);
                    if (arrs['status'] !== 'error')
                    {
                        $.each(arrs, function (Index, Entry) {
                            $('#period_' + customer_bill_id + ' input[name=bill_total]').val(parseFloat(Entry.bill_debt).toFixed(2));
                            bill_total = parseFloat(Entry.bill_debt).toFixed(2);

                        });
                    } else {
                        $('#payment_debt').html();
                        // swal("Opps", arrs['msg'], "info");
                    }
                }
            });
        };

        customer_bill_get_reminder = function (customer_id, bill_period) {
            $.ajax({
                url: '<?php echo base_url(); ?>main/customer_bill_get_reminder',
                type: 'post',
                data: {customer_id: customer_id, bill_period: bill_period},
                success: function (data) {
                    arrs = JSON.parse(data);
                    bill_print = arrs;
                    if (arrs['status'] !== 'error')
                    {
                        html = '';
                        count = 1;
                        $.each(arrs, function (Index, Entry) {

                            html += '<tr id="' + ('bill_').concat(Entry.bill_id) + '">';
                            html += '<td>' + count++ + '</td>';
                            html += '<td>' + Entry.period_reading_date + '</td>';
                            html += '<td>' + Entry.period_previous_reading + '</td>';
                            html += '<td>' + Entry.period_reading + '</td>';
                            html += '<td>' + Entry.bill_consumption + '</td>';
                            html += '<td>' + Entry.bill_price + '</td>';
                            html += '<td> <strong>' + parseFloat(Entry.bill_price) * parseFloat(Entry.bill_consumption) + '</strong></td>';
                            html += '<td>' + Entry.bill_paid + '</td>';
                            html += '<td>' + Entry.bill_discount + '</td>';
                            html += '<td class="payment_reminder text-danger">' + Entry.bill_reminder + '</td>';
                            html += '<td><input type="text" class="form-control"  name="payment_value"  placeholder="المبلغ للدفع"></td>';
                            html += '<td><input type="text" class="form-control"  name="payment_discount"  placeholder="الخصم"></td>';
                            html += '<td> <button class="btn btn-success btn-block save">دفع المبلغ</button> </td>';
                            html += '</tr>';
                            // bill_ids.push(Entry.bill_id);
                        });
                        $('#customer_bill_table tbody').html(html);
                        $('#billModal').modal('show');
//                        $.each(bill_ids, function (index, value) {
//                            customer_bill_get_payment(value);
//                        });
                    } else {
                        $('#customer_bill_table tbody').html('');
                        swal("لا يوجد ديون", arrs['msg'], "info");
                    }
                }


            });

        };


        $('table').on('click', '.save', function () {
            $(this).prop("disabled", true);
            bill_id = $(this).closest('tr').prop('id').split('_').pop();
            payment_discount = $('#bill_' + bill_id + ' input[name=payment_discount]').val() > 0 ? $('#bill_' + bill_id + ' input[name=payment_discount]').val() : 0;
            payment_value = $('#bill_' + bill_id + ' input[name=payment_value]').val() >= 0 ? $('#bill_' + bill_id + ' input[name=payment_value]').val() : 0;
            total_paid = parseFloat(payment_value) + parseFloat(payment_discount);
            bill_reminder = parseFloat($('#bill_' + bill_id + ' .payment_reminder').html()) - parseFloat(total_paid);
            bill_reminder = bill_reminder.toFixed(2);
//            if (parseFloat(bill_reminder) < 0) {
//                $(this).prop("disabled", false);
//                swal("المبلغ المتبقي في السالب", "لقد دفعت مبلغ أكبر من المبلغ المستحق", "info");
//            } else {
            payment_insert(bill_id, payment_value, payment_discount, "تم الدفع من صفحة الإدخال المبسط", bill_reminder);
            //           }
        });


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
        period_get_price = function () {
            $.ajax({
                url: '<?php echo base_url(); ?>main/cost_get_price',
                type: 'post',
                success: function (data) {
                    arrs = JSON.parse(data);

                    if (arrs['status'] !== 'error')
                    {
                        $.each(arrs, function (Index, Entry) {
                            period_server_price = Entry.cost_price;
                        });
                    } else {

                        swal("Opps", arrs['msg'], "info");
                    }
                }


            });
        };

        $('#period_region').change(function () {

            street_get_all_by_region($(this).children("option:selected").prop('id').split('_').pop());

        });
//        $('#period_street').change(function () {
//            period_get_all_list($('#period_date').val() + '-01', $('#period_region').children("option:selected").prop('id').split('_').pop()
//                    , $(this).children("option:selected").prop('id').split('_').pop());
//        });

        street_get_all_by_region = function (street_region) {
            $.ajax({
                url: '<?php echo base_url(); ?>main/street_get_all_by_region',
                type: 'post',
                data: {street_region: street_region},
                success: function (data) {
                    arrs = JSON.parse(data);

                    if (arrs['status'] !== 'error')
                    {
                        var html = '<option id="street_-1"> اختار شارع </div>';
                        $.each(arrs, function (Index, Entry) {
                            html += '<option id="' + ('street_').concat(Entry.street_id) + '">';
                            html += Entry.street_name;
                            html += '</option>';
                        });

                        $('#period_street').html(html);

                    } else {

                        swal("Opps", arrs['msg'], "info");
                    }
                }


            });
        };


        period_insert = function (period_date, period_price, period_add_money, period_customer, period_reading, period_reading_date
                , period_previous_reading, period_note, payment_value, payment_discount) {

            $.ajax({
                url: '<?php echo base_url(); ?>main/period_insert',
                type: 'post',
                data: {period_date: period_date, period_price: period_price,period_add_money:period_add_money, period_customer: period_customer, period_reading: period_reading, period_reading_date: period_reading_date
                    , period_previous_reading: period_previous_reading, period_note: period_note, payment_value: payment_value, payment_discount: payment_discount},
                success: function (data) {
                    arrs = JSON.parse(data);
                    if (arrs['status'] !== 'error')
                    {
                        $('#period_' + period_customer).css("background-color", "rgba(0, 128, 0, 0.27)");
                        $('#period_' + period_customer + ' input[name=period_previous_reading]').prop("disabled", true);
                        $('#period_' + period_customer + ' input[name=period_reading]').prop("disabled", true);
                        $('#period_' + period_customer + ' .print_cell').html('<span id=' + arrs['bill_id'] + ' class="fa fa-print"></span>');
                        $('#period_' + period_customer + ' .print_cell').css('color', '#bf8808');
                        $('#period_' + period_customer + ' .print_cell').css('text-align', 'center');
                        $('#period_' + period_customer + ' .print_cell').css('vertical-align', 'middle');
                        $('#period_' + period_customer + ' .print_cell').css('cursor', 'pointer');
                        $('#period_' + period_customer + ' .print_cell .fa').css('font-size', '25px');
                        $('#period_' + period_customer + ' .print_cell .fa').css('padding-top', '5px');
                        customer_bill_id = period_customer;
                        bill_get_debt();
						let foundIndex = periodsToSave.findIndex(value => value == 'period_'+ period_customer);
						if(foundIndex != -1){
							periodsToSave.splice(foundIndex,1);
						}
                    } else {
                        $('#period_' + period_customer).css("background-color", "rgba(255, 61, 2, 0.27)");
                        swal("Opps", arrs['msg'], "info");
                    }
                }


            });
        };


        payment_insert = function (bill_id, payment_value, payment_discount, payment_note, bill_reminder) {

            $.ajax({
                url: '<?php echo base_url(); ?>main/payment_insert',
                type: 'post',
                data: {bill_id: bill_id, payment_value: payment_value, payment_discount: payment_discount, payment_note: payment_note, bill_reminder: bill_reminder},
                success: function (data) {
                    arrs = JSON.parse(data);
                    if (arrs['status'] !== 'error')
                    {
                        $('#bill_' + bill_id).css("background-color", "rgba(0, 128, 0, 0.27)");
                        $('#bill_' + bill_id + ' input[name=payment_value]').prop("disabled", true);
                        $('#bill_' + bill_id + ' input[name=payment_discount]').prop("disabled", true);
                        bill_get_debt();
                        $('#billModal').modal('hide');
                        $('#period_' + customer_bill_id + ' input[name=bill_total]').val(bill_total.toFixed(2));
                    } else {
                        $('#bill_' + bill_id).css("background-color", "rgba(255, 61, 2, 0.27)");
                        console.log( arrs['msg']);
                        swal("Opps", arrs['msg'], "info");
                    }
                }


            });
        };

        customer_bill_get_all = function (customer_id, bill_period) {
            bill_print = new Array();
            bill_ids = new Array();
            $.ajax({
                url: '<?php echo base_url(); ?>main/customer_bill_get_all',
                type: 'post',
                data: {customer_id: customer_id, bill_period: bill_period},
                success: function (data) {
                    arrs = JSON.parse(data);
                    bill_print = arrs;
                    if (arrs['status'] !== 'error')
                    {
                        $.each(arrs, function (Index, Entry) {

                            customer_name_print = Entry.customer_name;
                            period_date_print = Entry.period_reading_date;

                            bill_ids.push(Entry.bill_id);
                            bill_periods.push(Entry.bill_period);
                        });
                        $.each(bill_ids, function (index, value) {
                            customer_bill_get_payment(value);
                        });
                        $.each(bill_periods, function (index, value) {
                            get_add_cost(value);
                        });
                    } else {
                        swal("Opps", arrs['msg'], "info");
                    }
                }


            });
        };


        customer_bill_get_payment = function (bill_id) {
            $.ajax({
                url: '<?php echo base_url(); ?>main/payment_get_selected_bill',
                type: 'post',
                data: {bill_id: bill_id},
                success: function (data) {
                    arrs = JSON.parse(data);
                    payment_print = arrs;
                    bill_print_func();
                }



            });
        };
        get_add_cost = function (period_id) {
            $.ajax({
                url: '<?php echo base_url(); ?>main/get_add_cost',
                type: 'post',
                data: {period_id: period_id},
                success: function (data) {
                    arrs = JSON.parse(data);
                    add_cost_print = arrs;

                    if (arrs['status'] !== 'error')
                    {


                    } else {
                        //  swal("Opps,", arrs['msg'], "info");
                    }
                }


            });
        };

        bill_print_func = function () {
            var add_cost_datails = '';
            var bill_period = period_date_print;
            var customer_bill_customer = customer_name_print;

            var report = '<style>'
                    + 'th{text-align:center;font-size:14px;direction:rtl;}'
                    + 'td{text-align:center;font-size:12px;direction:rtl;}'
                    + 'tr{page-break-inside: avoid !important;page-break-after: auto !important;}'
                    + '.loc_label{float:right;padding-left:10px;}'
                    + '.loc_title{float:right;width:550px;padding:15px;}'
                    + 'table{margin-bottom:5px;}ul{list-style:none;}'
                    + '.right-header{left:0;background:#ddd;position:absolute;top:0}'
                    + '.right-header{right:0;background:#333;position:absolute;top:0}'
                    + '</style>';
//

            var head = '<div class="row-fluid" style="padding-top:0px;'
                    + 'padding-bottom:0px;border-bottom:2px solid #000000;margin-bottom: 0px;direction:rtl;">'
                    + '<div style="text-align:center;font-weight:bold";margin-bottom: 50px;></div>' //position:relative;width:250px;height:90;margin:0 auto;
                    + '<div style="text-align:center;font-weight:bold";margin-bottom: 10px;margin-top: 50px;>كشف فاتورة</div>' //position:relative;width:250px;height:90;margin:0 auto;
                    + '<div class="loc_title"><strong>' + customer_bill_customer + ', ' + bill_period + ' </strong></div></div>'
                    + '<div class="row-fluid" style="padding-top:5px;padding-bottom:5px;margin-bottom:5px;direction:rtl;">'
                    + '<div class="loc_label"></div>'
                    + '</div>';
            var header = '<table width="100%" border="1" cellspacing="0" cellpadding="5">'
                    + '<tr><th width="8%" scope="col">مجموع المستحقات</th>'
                    + '<th width="8%" scope="col">مستحقات سابقة</th>'
                    + '<th width="8%" scope="col">متبقي هذه الفاتورة</th>'
                    + '<th width="8%" scope="col">المخصوم</th>'
                    + '<th width="8%" scope="col">المدفوع</th>'
                    + '<th width="8%" scope="col">قيمة الفاتورة</th>'
                    + '<th width="8%" scope="col">السعر</th>'
                    + '<th width="8%" scope="col">الإستهلاك الشهري</th>'
                    + '<th width="6%" scope="col">القراءة الحالية</th>'
                    + '<th width="6%" scope="col">القراءة السابقة</th>'
                    + '<th width="12%" scope="col">تاريخ القرأة</th>';

            var header_details = '<table width="100%" border="0" cellspacing="0" cellpadding="5">'
                    + '<tr>'
                    + '<th width="8%" scope="col">ملاحظة</th>'
                    + '<th width="8%" scope="col">الخصم</th>'
                    + '<th width="6%" scope="col">قيمة الدفعة</th>'
                    + '<th width="6%" scope="col">التاريخ</th>';


            if (add_cost_print.length > 0) {
                add_cost_datails = '<br><br><div style="float:right;direction:rtl;"> <strong> مبالغ أخرى تم إضافتها على الفاتورة:   </strong> <br> <br> ';

                for (var i = 0; i < add_cost_print.length; i++)
                {
                    var row = add_cost_print[i];
                    add_cost_datails += '<strong> ' + row.add_cost_value + ' --- ' + row.add_cost_note + '</strong><br>';
                }
                add_cost_datails += '</div> <br> <br>';

            }

            var temp = '';
            var temp_details = '';
            var ptype;
            var ptype2;
            var status = "";
            var p_type = "";

            for (var i = 0; i < payment_print.length; i++)
            {
                var row = payment_print[i];
                temp_details += '<tr><td><span style=" font-size: 120%;">' + row.payment_note + '</span></td>'
                        + '<td><span style=" font-size: 120%;">' + row.payment_discount + '</span></td>'
                        + '<td><span style=" font-size: 120%;">' + row.payment_value + '</span></td>'
                        + '<td><span style=" font-size: 120%;">' + row.payment_date + '</span></td></tr>'
            } // end for


            temp += header;
            for (var i = 0; i < bill_print.length; i++)
            {
                var row = bill_print[i];
                temp += '<tr><td><span style=" font-size: 120%;">' + current_bill_total + '</span></td>'
                        + '<td><span style=" font-size: 120%;">' + (row.bill_sum - row.bill_reminder) + '</span></td>'
                        + '<td><span style=" font-size: 120%;">' + row.bill_reminder + '</span></td>'
                        + '<td><span style=" font-size: 120%;">' + row.bill_discount + '</span></td>'
                        + '<td><span style=" font-size: 120%;">' + row.bill_paid + '</span></td>'
                        + '<td><span style=" font-size: 120%;"><strong>' + parseFloat(row.bill_price) * parseFloat(row.bill_consumption) + '</strong></span></td>'
                        + '<td><span style=" font-size: 120%;">' + row.bill_price + '</span></td>'
                        + '<td><span style=" font-size: 120%;">' + row.bill_consumption + '</span></td>'
                        + '<td><span style=" font-size: 120%;">' + row.period_reading + '</span></td>'
                        + '<td><span style=" font-size: 120%;">' + row.period_previous_reading + '</span></td>'
                        + '<td><span style=" font-size: 120%;">' + row.period_reading_date + '</span></td>';
            } // end for
            report += head;
            report += temp;
            report = report + '</table>' + '<br><div style="text-align:center;font-weight:bold";margin-bottom: 0px;>' //position:relative;width:250px;height:90;margin:0 auto;
                    + 'تفاصيل الفاتورة</div><br>';
            var footer = '<div class="row-fluid" style="padding-top:0px;'
                    + 'padding-bottom:0px;margin-top: 30px;direction:rtl;">'
                    + '<div class="loc_title"></div></div><br><br>'
                    + '<div class="loc_title" style="float:left"></div></div>'
                    + '<div class="row-fluid" style="padding-top:5px;padding-bottom:5px;margin-bottom:5px;direction:rtl;">'
                    + '<div class="loc_label"></div>'
                    + '</div>';
            report += header_details + temp_details + '</table>' + add_cost_datails + footer;
            temp = '';

            var newWindow = window.open('', '', 'width=1000, height=600'),
                    document = newWindow.document.open();

            document.write(report);
            report = '';

            document.close();
            newWindow.print();

        };


    });

</script>