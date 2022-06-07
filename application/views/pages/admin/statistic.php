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
                    <span>الإحصائيات</span>
                </li>
            </ul>
        </div>
        <!-- END PAGE HEADER-->
        <!-- BEGIN DASHBOARD STATS 1-->
        <div class="row">
            <div class="col-md-12 col-md-offset-0">


                <div class="row">
                    <div class="col-md-10 col-md-offset-1">
                        <div class="form-inline margin-bottom-30" id="statistic">

                            <div class="form-inline">
                                <label for="statistic_date_from" class="col-md-2 control-labeli">من تاريخ</label>
                                <div class="col-md-4">
                                    <input type="date" class="form-control monthpicker" id="statistic_date_from" name="statistic_date_from">
                                </div>
                            </div>
                            <div class="form-inline">
                                <label for="statistic_date_to" class="col-md-2 control-labeli">إلى تاريخ</label>
                                <div class="col-md-4">
                                    <input type="date" class="form-control monthpicker" id="statistic_date_to" name="statistic_date_to" >
                                </div>
                            </div>
                            <div class="clearfix"></div>
                            <div class="form-inline">
                                <label for="statistic_region" class="col-md-2 control-labeli">المنطقة</label>
                                <div class="col-md-4">
                                    <select class="form-control" id="statistic_region">
                                        <option id="region_-1">اختر منطقة</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-inline">
                                <label for="statistic_street" class="col-md-2 control-labeli">الشارع</label>
                                <div class="col-md-4">
                                    <select class="form-control" id="statistic_street">
                                        <option id="region_-1">اختر شارع</option>
                                    </select>
                                </div>
                            </div>
                            <div class="clearfix"></div>
                            <hr>

                            <div class="form-group">
                                <div class="col-md-2 col-md-offset-5">
                                    <button type="submit" id="ok" class="btn green">استعلام</button>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="clearfix"></div>
                <!-- END DASHBOARD STATS 1-->
                <div class="portlet box blue">
                    <div class="portlet-title">
                        <div class="caption">
                            <i class="fa fa-comments"></i>إحصائيات</div>
                        <div class="tools">
                            <a href="javascript:;" class="collapse" data-original-title="" title=""> </a>
                            <a href="#portlet-config" data-toggle="modal" class="config" data-original-title="" title=""> </a>
                            <a href="javascript:;" class="reload" data-original-title="" title=""> </a>
                            <a href="javascript:;" class="remove" data-original-title="" title=""> </a>
                        </div>
                    </div>
                    <div class="portlet-body" style="display: block;">
                        <div class="container-fluid">
                            <div class="row">
                                <div class="thumbnail circle col-md-2 col-sm-offset-1 "> 
                                    <div class="center-block align-center text-center"> <h4>الإستهلاك: <span id="statistic_consum_report" class="font-lg font-blue-soft">  </span> </h4> <div> 
                                        </div>
                                    </div>
                                </div>
                                <div class="thumbnail circle col-md-2 col-sm-offset-1"> 
                                    <div class="center-block align-center text-center"> <h4>المدفوع: <span id="statistic_paid_report" class="font-lg font-blue-soft">  </span> </h4> <div> 
                                        </div>
                                    </div>
                                </div>
                                <div class="thumbnail circle col-md-2 col-sm-offset-1"> 
                                    <div class="center-block align-center text-center"> <h4>المتبقي: <span id="statistic_reminder_report" class="font-lg font-blue-soft">  </span> </h4> <div> 
                                        </div>
                                    </div>
                                </div>
                                <div class="thumbnail circle col-md-2 col-sm-offset-1"> 
                                    <div class="center-block align-center text-center"> <h4>خصومات: <span id="statistic_discount_report" class="font-lg font-blue-soft">  </span> </h4> <div> 
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

            <div class="col-md-6">
                <!-- BEGIN CHART PORTLET-->
                <div class="portlet box green">
                    <div class="portlet-title">
                        <div class="caption">
                            <i class=" icon-layers "></i>
                            <span class="caption-subject uppercase">الإستهلاك</span>
                        </div>
                        <div class="tools">
                            <a href="javascript:;" class="collapse"> </a>
                            <a href="#portlet-config" data-toggle="modal" class="config"> </a>
                            <a href="javascript:;" class="reload"> </a>
                            <a href="javascript:;" class="fullscreen"> </a>
                            <a href="javascript:;" class="remove"> </a>
                        </div>
                    </div>
                    <div class="portlet-body">
                        <div id="pie_chart_1" class="chart"> <div class="margin-top-20">  </div> </div>
                    </div>
                </div>
                <!-- END CHART PORTLET-->

            </div>
            <div class="col-md-6">
                <!-- BEGIN CHART PORTLET-->
                <div class="portlet box green">
                    <div class="portlet-title">
                        <div class="caption">
                            <i class=" icon-layers "></i>
                            <span class="caption-subject uppercase">المتبقي</span>
                        </div>
                        <div class="tools">
                            <a href="javascript:;" class="collapse"> </a>
                            <a href="#portlet-config" data-toggle="modal" class="config"> </a>
                            <a href="javascript:;" class="reload"> </a>
                            <a href="javascript:;" class="fullscreen"> </a>
                            <a href="javascript:;" class="remove"> </a>
                        </div>
                    </div>
                    <div class="portlet-body">
                        <div id="pie_chart_2" class="chart"> <div class="margin-top-20">  </div> </div>
                    </div>
                </div>
                <!-- END CHART PORTLET-->

            </div>

            <!-- END CONTENT BODY -->
        </div>
        <!-- END CONTENT -->
    </div>
    <!-- END CONTAINER -->
    <script>
        $(document).ready(function () {

            window.onload = function () {
                region_get_all();

            };

            var dataprovider = [];
            var dataprovider2 = [];

            statistic_get_sum = function (statistic_date_from, statistic_date_to, statistic_region, statistic_street) {
                $.ajax({
                    url: '<?php echo base_url(); ?>main/statistic_get_sum',
                    type: 'post',
                    data: {statistic_date_from: statistic_date_from, statistic_date_to: statistic_date_to, statistic_region: statistic_region, statistic_street: statistic_street},
                    success: function (data) {
                        arrs = JSON.parse(data);

                        if (arrs['status'] !== 'error')
                        {

                            $.each(arrs, function (Index, Entry) {
								
								consum = Entry.bill_consum;
								paid = Entry.bill_paid;
								reminder = Entry.bill_reminder;
								discount = Entry.bill_discount;
								
                                $('#statistic_consum_report').html(parseFloat(consum).toFixed(2));
                                $('#statistic_paid_report').html(parseFloat(paid).toFixed(2));
                                $('#statistic_reminder_report').html(parseFloat(reminder).toFixed(2));
                                $('#statistic_discount_report').html(parseFloat(discount).toFixed(2));
                            });



                        } else {
                            // swal("Opps", arrs['msg'], "info");
                        }
                    }


                });
            };
            statistic_get_sum_for_chart = function (statistic_date_from, statistic_date_to, statistic_region, statistic_street) {
                $.ajax({
                    url: '<?php echo base_url(); ?>main/statistic_get_sum_for_chart',
                    type: 'post',
                    data: {statistic_date_from: statistic_date_from, statistic_date_to: statistic_date_to, statistic_region: statistic_region, statistic_street: statistic_street},
                    success: function (data) {
                        arrs = JSON.parse(data);
                        dataprovider = [];
                        dataprovider2 = [];
                        if (arrs['status'] !== 'error')
                        {
                            y = 0;
                            z = 0;
                            $.each(arrs, function (Index, Entry) {

                                dataprovider[y] = {
                                    label: Entry.name + ' ( ' + parseInt(Entry.bill_consum) + ' ) ',
                                    data: parseInt(Entry.bill_consum)//, //((parseInt(Entry.STATUS_COUNT) / parseInt(total_status_count)) * 100).toFixed(2)
                                            //color: color[getRandomInt(0, color.length)]
                                };
                                y++;

                            });
                            $.each(arrs, function (Index, Entry) {

                                dataprovider2[z] = {
                                    label: Entry.name + ' ( ' + parseInt(Entry.bill_reminder) + ' ) ',
                                    data: parseInt(Entry.bill_reminder)//, //((parseInt(Entry.STATUS_COUNT) / parseInt(total_status_count)) * 100).toFixed(2)
                                            //color: color[getRandomInt(0, color.length)]
                                };
                                z++;

                            });

                            if ($('#pie_chart_1').size() !== 0) {
                                $.plot($("#pie_chart_1"), (dataprovider), {
                                    series: {
                                        pie: {
                                            show: true,
                                            radius: 1,
                                            label: {
                                                show: true,
                                                radius: 1,
                                                formatter: function (label, series) {
                                                    return '<div style="font-size:8pt;text-align:center;padding:5px;color:white;">' + label + '<br/>' + Math.round(series.percent) + '%</div>';
                                                }
                                                ,
                                                background: {
                                                    opacity: 0.8,
                                                    color: '#000'
                                                }
                                            }
                                        }
                                    },
                                    legend: {
                                        show: false
                                    }
                                });

                            }
                            if ($('#pie_chart_2').size() !== 0) {
                                $.plot($("#pie_chart_2"), (dataprovider2), {
                                    series: {
                                        pie: {
                                            show: true,
                                            radius: 1,
                                            label: {
                                                show: true,
                                                radius: 1,
                                                formatter: function (label, series) {
                                                    return '<div style="font-size:8pt;text-align:center;padding:5px;color:white;">' + label + '<br/>' + Math.round(series.percent) + '%</div>';
                                                }
                                                ,
                                                background: {
                                                    opacity: 0.8,
                                                    color: '#000'
                                                }
                                            }
                                        }
                                    },
                                    legend: {
                                        show: false
                                    }
                                });

                            }


                        } else {
                            // swal("Opps", arrs['msg'], "info");
                        }

                        // initChartSample7();
                    }


                });
            };

            $('#ok').on('click', function () {
                statistic_get_sum($('#statistic_date_from').val(), $('#statistic_date_to').val(), $('#statistic_region').children("option:selected").prop('id').split('_').pop()
                        , $('#statistic_street').children("option:selected").prop('id').split('_').pop());
                statistic_get_sum_for_chart($('#statistic_date_from').val(), $('#statistic_date_to').val(), $('#statistic_region').children("option:selected").prop('id').split('_').pop()
                        , $('#statistic_street').children("option:selected").prop('id').split('_').pop());

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

                            $('#statistic_region').html(html);

                        } else {

                            swal("Opps", arrs['msg'], "info");
                        }
                    }


                });
            };

            $('#statistic_region').change(function () {
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
                            var html = '<option id="street_-1"> اختار شارع </div>';
                            $.each(arrs, function (Index, Entry) {
                                html += '<option id="' + ('street_').concat(Entry.street_id) + '">';
                                html += Entry.street_name;
                                html += '</option>';
                            });

                            $('#statistic_street').html(html);

                        } else {

                            swal("Opps", arrs['msg'], "info");
                        }
                    }


                });
            };

            initChartSample7 = function () {
                var chart = AmCharts.makeChart("chart_7", {
                    "type": "pie",
                    "theme": "light",

                    "fontFamily": 'Open Sans',

                    "color": '#888',
                    "fontSize": 16,

                    "dataProvider": dataprovider,
                    "valueField": "data",
                    "titleField": "label",
                    "outlineAlpha": 0.4,
                    "depth3D": 15,
                    "balloonText": "[[title]]<br><span style='font-size:14px'><b>[[value]]</b> ([[percents]]%)</span>",
                    "angle": 30,
                    "exportConfig": {
                        menuItems: [{
                                icon: '/lib/3/images/export.png',
                                format: 'png'
                            }]
                    }
                });

                jQuery('.chart_7_chart_input').off().on('input change', function () {
                    var property = jQuery(this).data('property');
                    var target = chart;
                    var value = Number(this.value);
                    chart.startDuration = 0;

                    if (property == 'innerRadius') {
                        value += "%";
                    }

                    target[property] = value;
                    chart.validateNow();
                });

                $('#chart_7').closest('.portlet').find('.fullscreen').click(function () {
                    chart.invalidateSize();
                });

                $('g text').each(function () {
                    $(this).attr("text-anchor", "start");
                });
            }


            getRandomInt = function (min, max) {
                return Math.floor(Math.random() * (max - min + 1)) + min;
            };
            var color = ["#FF0F00", "#FF6600", "#FF9E01", "#FCD202", "#F8FF01", "#B0DE09", "#04D215", "#0D8ECF", "#0D52D1", "#2A0CD0", "#8A0CCF", "#CD0D74", "#754DEB", "#DDDDDD", "#999999"];

        });

    </script>