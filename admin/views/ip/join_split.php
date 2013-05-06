<html>
<head>
    <script type="text/javascript" src="http://localhost/IPMS_ver_1/admin_resources/scripts/jquery-1.4.2.min.js"></script>
    <script type="text/javascript" src="http://localhost/IPMS_ver_1/admin_resources/scripts/jquery-ui-1.8.2.min.js"></script>
    <script type="text/javascript" src="http://localhost/IPMS_ver_1/admin_resources/scripts/jquery.dataTables.js"></script>
    <script type="text/javascript" src="http://localhost/IPMS_ver_1/admin_resources/scripts/jquery.dataTables.columnFilter.js"></script>
    <script type="text/javascript" src="http://localhost/IPMS_ver_1/admin_resources/scripts/facebox.js"></script>


    <style type="text/css">
        @import "http://localhost/IPMS_ver_1/admin_resources/css/demo_table.css";
        @import "http://localhost/IPMS_ver_1/admin_resources/css/smoothness/jquery-ui-1.8.2.custom.css";
        @import "http://localhost/IPMS_ver_1/admin_resources/css/demo_table_jui.css";
        @import "http://localhost/IPMS_ver_1/admin_resources/css/jquery.dataTables_themeroller.css";
    </style>

<!--    <script type="text/javascript" charset="utf-8">-->
<!--        $(document).ready(function(){-->
<!--            $('#records').dataTable({-->
<!--                "bRetrieve":true,-->
<!--                "iDisplayLength": 5,-->
<!--                "aLengthMenu":  [[5,10, 25, 50, -1], [5,10, 25, 50, "All"]]-->
<!--            });-->
<!--        })-->
<!--    </script>-->

</head>

<div class="content-box"><!-- Start Content Box -->

    <div class="content-box-header" style="height: 50px">

        <h3><?=$title?></h3>

    </div> <!-- End .content-box-header -->

    <div class="content-box-content">
        <div id="container" >
        <span>
        <strong>SUBNET & JOIN: &nbsp;</strong>
        <input class="button" type="button" value="NODE BLOCKS" onclick="node_table()" />&nbsp;&nbsp;
        <input class="button" type="button" value="CATEGORY BLOCKS" onclick="category_table()" />&nbsp;&nbsp;
            <span style="float: right;">
        <strong>JOIN: &nbsp;</strong>
        <input class="button" type="button" value="PRIMARY SUB POOL" onclick="primary_table()" />
            </span>
        </span>
<p></p>
            <div id="node_blocks" style="display: none">

                <h3 style="margin-top: 10px;text-align: center;font-weight: bolder;font-size: 1.2em"> Node IP block Details</h3>

                <hr>

                <form id="node_form"  class="records">
                <table id="node_records">
                    <thead>
                    <tr>
                        <th style="font-size: 12px">ID</th>
                        <th style="font-size: 12px">IP ADDRESSES</th>
                        <th style="font-size: 12px">SUBNET</th>
                        <th style="font-size: 12px">SUBNET TO/<br/>JOIN AS</th>
                        <th style="font-size: 12px">ACTION</th>
                        <th style="font-size: 12px">STATUS</th>
                    </tr>
                    </thead>
                </table>

                </form>

            </div>

            <div class="clear"></div>


            <div id="category_blocks" style="display: none;">
                <h3 style="margin-top: 10px;text-align: center;font-weight: bolder;font-size: 1.2em"> Category IP block Details</h3>

                <hr>

                <form id="category_form" class="records">
                    <table id="category_records">
                        <thead>
                        <tr>
                            <th style="font-size: 12px">ID</th>
                            <th style="font-size: 12px">CATEGORY</th>
                            <th style="font-size: 12px">SUBCATEGORY</th>
                            <th style="font-size: 12px">IP ADDRESSES</th>
                            <th style="font-size: 12px">SUBNET</th>
                            <th style="font-size: 12px">SUBNET TO/<br/>JOIN AS</th>
                            <th style="font-size: 12px">ACTION</th>
                            <th style="font-size: 12px">STATUS</th>
                        </tr>
                        </thead>
                    </table>

                </form>

            </div>

            <div class="clear"></div>
            <div id="primary_blocks" style="display: none;">
                <h3 style="margin-top: 10px;text-align: center;font-weight: bolder;font-size: 1.2em"> Primary Pool Details</h3>

                <hr>

                <form id="primary_form" class="records">
                    <table id="primary_records">
                        <thead>
                        <tr>
                            <th style="font-size: 12px">ID</th>
                            <th style="font-size: 12px">IP ADDRESSES</th>
                            <th style="font-size: 12px">SUBNET</th>
                            <th style="font-size: 12px">JOIN AS</th>
                            <th style="font-size: 12px">ACTION</th>
                            <th style="font-size: 12px">STATUS</th>
                        </tr>
                        </thead>
                    </table>

                </form>

            </div>

        </div>

    </div> <!-- End .content-box-content -->

</div>


<script type="text/javascript">
    $('#3').addClass('current');
</script>

</html>


