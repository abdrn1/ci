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
                            <label for="period_date" class="col-md-2 control-labeli">دورة شهر</label>
                            <div class="col-md-4">
                                <input type="month" class="form-control monthpicker" id="period_date" name="period_date" placeholder="اسم المشترك">
                            </div>
                        </div>
                        <div class="clearfix"></div>
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
                            <label for="period_reading_date" class="col-md-2 control-labeli">تاريخ قراءة العداد</label>
                            <div class="col-md-4">
                                <input type="date" class="form-control" id="period_reading_date" name="period_reading_date" >
                            </div>
                        </div>
                        <div class="form-inline">
                            <label for="period_price" class="col-md-2 control-labeli">السعر</label>
                            <div class="col-md-4">
                                <input type="text" class="form-control" id="period_price" name="period_price" placeholder="السعر">
                            </div>
                        </div>
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
                    <img class="loadingimg center-block" src="<?php echo base_url(); ?>assets_admin/global/img/loadingn" alt="جاري التحميل"/>                                   
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

                            <table id="table" class="table table-striped table-hover table-bordered" cellspacing="0" width="100%">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>First Name</th>
                                        <th>Last Name</th>
                                        <th>Phone</th>
                                        <th>Address</th>
                                        <th>City</th>
                                        <th>Country</th>
                                    </tr>
                                </thead>
                                <tbody>
                                </tbody>

                                <tfoot>
                                    <tr>
                                        <th>No</th>
                                        <th>First Name</th>
                                        <th>Last Name</th>
                                        <th>Phone</th>
                                        <th>Address</th>
                                        <th>City</th>
                                        <th>Country</th>
                                    </tr>
                                </tfoot>
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


<script type="text/javascript">

    var table;

    $(document).ready(function () {

        //datatables
        table = $('#table').DataTable({

            "processing": true, //Feature control the processing indicator.
            "serverSide": true, //Feature control DataTables' server-side processing mode.
            "order": [], //Initial no order.
            "rowId": 'period_id',

            // Load data for the table's content from an Ajax source
            "ajax": {
                "url": "<?php echo site_url('customers/ajax_list') ?>",
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

    });

</script>

</body>
</html>