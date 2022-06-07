<!DOCTYPE html>
<html>

<head>

    <meta charset="UTF-8">
    <title>كشف الارصدة</title>

    <style>
        @font-face {
            font-family: traditionalarabic;
            src: url('<?php echo base_url(); ?>assets_admin/global/fonts/tradbdo.ttf');
        }

        body {
            font-family: traditionalarabic, Tahoma, Helvetica, Arial;
            direction: rtl;
            font-size: 16px;
            font-weight: 500;
            margin: auto;
        }

        .container {
            background-color: white;
            width: 21cm;
            margin: auto;
            padding: 10px 10px 5px 10px;
        }

        @page {
            /*size: A4;*/
            sheet-size: A4;
            odd-header-name: html_myHeader1;
            even-header-name: html_myHeader1;
            odd-footer-name: html_myFooter1;
            even-footer-name: html_myFooter1;

        }

        @page chapter2 {
            odd-header-name: html_Chapter2HeaderOdd;
            even-header-name: html_Chapter2HeaderEven;
            odd-footer-name: html_Chapter2FooterOdd;
            even-footer-name: html_Chapter2FooterEven;
        }

        @page noheader {
            odd-header-name: _blank;
            even-header-name: _blank;
            odd-footer-name: _blank;
            even-footer-name: _blank;
        }

        .newpage {
            page-break-before: always;
        }

        .never-break{
          
            page-break-inside:avoid;
        }

        div.chapter2 {
            page-break-before: right;
            page: chapter2;
        }

        div.noheader {
            page-break-before: right;
            page: noheader;

        }

        td {
            /* padding: 2px 5px 2px 5px; */
        }



        table.datat {

            font-size: 16px;
            font-weight: bold;
            border-width: 1px;
            border-color: #979899;
            border-collapse: collapse;
        }

        .inlineblock {
            float: right;
            width: 46.5%;

            padding: 5px;

        }

        .inleftlineblock {
            float: left;
            width: 46.5%;

            padding: 5px;

        }

        .clearfix {
            clear: both;
        }

        .tablehead {
            background-color: #979899;
        }

        .table1 {
            border: 2px solid black;
            padding: 5px;
            text-align: center;
            border-spacing: 2px;
            /* border-collapse: collapse; */
            width: 95%;


        }
        .table1 td {
            border: 1px solid #979899;
        }
        

        .table2 {
            border: 2px solid black;
           
            text-align: center;
            /* border-spacing: 1px; */
            /* border-collapse: collapse; */
            border-collapse: collapse;
            width: 95%;

        }
        .table2 td{
            border-width: 1px;
            padding: 6px;
            border-style: solid;
            border-color: #5e7880;
            text-align: center;
            vertical-align: middle;
        }

        

        table.datat td {
            border-width: 1px;
            padding: 6px;
            border-style: solid;
            border-color: #5e7880;
            text-align: center;
            vertical-align: middle;
        }

        tr:nth-child(even) {
            /* background-color: #f6f6f6; */
        }

        .info-block-head {
            font-size: 17px;
            margin: 10px 5px 7px 0px;
        }

        div.dash {
            margin-top: 30px;;
            margin-bottom: 15px;;
            border-top: 1px dashed gray;
        }

        .headerbox {
            font-weight: 600;
            font-size: 14px;
            border: 2px dashed #2abed4;
            padding: 10px;
            border-radius: 8px;
            -moz-border-radius: 8px;
            -webkit-border-radius: 8px;
            text-align: center;
            padding: 10px 10px 10px 10px;
            margin-bottom: 20px;
            width: 30%;
        }

        .page-header {
            padding-bottom: 9px;
            font-size: 17px;
            font-weight: bold;
            margin: 40px 0 20px;
            border-bottom: 2px solid #eee;
        }

        .table-header {
            font-size: 18px;
            padding-bottom: 2px;
            margin: 2px 0 5px 0px;
            border-bottom: 1px solid #eee;
        }
    </style>
</head>

<body>
    <div class="container">
    <table class="table2">
         <head>
         <tr style="background-color: #d6d6c2 ;">
         <td>اسم الزبون</td>
         <td>المنطقة</td>
         <td>الشارع</td>
         <td>الرصيد</td>
         </tr>
         </head>
         <body>

        <?php



        foreach ($results as $rec) {


        ?>

        <div class="never-break">

         
       
         <tr>
         <td><?=$rec->customer_name ?></td>
         <td><?=$rec->region_name ?></td>
         <td><?=$rec->street_name ?></td>
         
         <td><?=round($rec->bill_sum,1) ?></td>
         </tr>
        
            

        <?php
        }
        ?>
         </body>
         </table>

    </div>
</body>
<script>
  //  window.print();
</script>

</html>