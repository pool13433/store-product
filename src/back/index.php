<!DOCTYPE html>
<html>
    <head>
        <title>ระบบจัดการสต๊อกสินค้า</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" type="text/css" href="../../lib/uikit-master/docs/css/uikit.docs.min.css"/>    
        <link rel="stylesheet" type="text/css" href="../../lib/validationengine/css/validationEngine.jquery.css"/>
        <link rel="stylesheet" type="text/css" href="../../lib/DataTables-1.10.4/media/css/jquery.dataTables.min.css"/>
        <link rel="stylesheet" type="text/css" href="../../lib/TableTools-2.2.3/css/dataTables.tableTools.min.css"/>
        <script type="text/javascript" src="../../lib/uikit-master/vendor/jquery.js"></script>
        <script type="text/javascript" src="../../lib/uikit-master/docs/js/uikit.min.js"></script>
        <script type="text/javascript" src="../../lib/uikit-master/src/js/components/notify.js"></script>
        <script type="text/javascript" src="../../lib/uikit-master/src/js/components/datepicker.js"></script>

        <!-- validate enging-->        
        <script type="text/javascript" src="../../lib/validationengine/js/jquery.validationEngine.js"></script>
        <script type="text/javascript" src="../../lib/validationengine/js/languages/jquery.validationEngine-en.js"></script>
        <!-- validate enging-->

        <!-- datatable-->
        <script type="text/javascript" src="../../lib/DataTables-1.10.4/media/js/jquery.dataTables.min.js"></script>
        <!-- datatable-->

        <!-- datatools-->
        <script type="text/javascript" src="../../lib/TableTools-2.2.3/js/dataTables.tableTools.js"></script>
        <!-- datatools-->

        <!-- muti select -->
        <!--        <link rel="stylesheet" href="../../lib/bootstrap-multiselect-master/dist/css/bootstrap-multiselect.css"/>
                <script type="text/javascript" src="../../lib/bootstrap-multiselect-master/dist/js/bootstrap-multiselect.js"></script>-->
        <link rel="stylesheet" type="text/css" href="../../lib/select2-3.5.0/select2.css"/>
        <script type="text/javascript" src="../../lib/select2-3.5.0/select2.min.js"></script>
        <!-- muti select -->

        <script type="text/javascript" src="../../js/script.js"></script>
    </head>
    <body>
        <!--        <div class="uk-container uk-container-center uk-margin-top uk-margin-large-bottom">-->
        <div style="padding-left: 20px;padding-right:10px;padding-top:20px;">
            <div class="uk-grid">
                <div class="uk-width-2-10">
                    <?php include './menu.php'; ?>
                </div>
                <div class="uk-width-8-10">
                    <?php
                    include '../config/Website.php';
                    // ตรวจสอบ ค่า ว่ามีการส่งค่ามาหรือเปล่า
                    if (!empty($_GET)) {  // มีค่า
                        $page = $_GET['page'] . '.php';
                        if (file_exists($page)) {
                            include $page;
                        } else {
                            echo MsgBox('danger', 'ไม่พบ หน้าเว็บ ที่เรียกหา Error 404');
                        }
                    } else {
                        include 'login.php';
                    }
                    ?>

                    <!-- This is the off-canvas sidebar -->
                    <div id="my-id" class="uk-offcanvas">
                        <div class="uk-offcanvas-bar">
                            <div style="background-color: white;padding : 10px;">
                                <ul class="uk-list uk-list-line uk-width-medium-10-10">
                                    <?php
                                    $sql_minproduct = "SELECT * FROM product WHERE pro_amount < 50 ORDER BY pro_amount ASC";
                                    $query_minprodut = mysql_query($sql_minproduct) or die(mysql_error());
                                    while ($data = mysql_fetch_array($query_minprodut)):
                                        ?>
                                        <li>
                                            <div class="uk-alert uk-alert-success"><?= $data['pro_name'] ?> คงเหลือ <?= $data['pro_amount'] ?> ชิ้น </div>                                                                                                                            
                                        </li>
                                    <?php endwhile; ?>
                                    <?php
                                    if (!empty($conn))
                                        mysql_close($conn);
                                    ?>
                                </ul>                                
                            </div>
                        </div>
                    </div>
                </div>
            </div>            
        </div>        
    </body>
</html>
