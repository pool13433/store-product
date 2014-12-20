<?php

include '../../MPDF57/mpdf.php';
ob_start();
echo '<link type="text/css" rel="stylesheet" href="../../css/report_style.css"/>';
switch ($_GET['method']) {
    case 'report_1':
        echo '<h2>รายงานสรุปสินค้า ตั้งแต่: ' . $_GET['date_start'] . ' ถึง ' . $_GET['date_end'] . '</h2>';
        include '../back/reportdata_1.php';
        $html = ob_get_contents();
        ob_clean();
        $mpdf = new mPDF("UTF-8");
        $mpdf->SetAutoFont();
        $mpdf->AddPage('L');
        $mpdf->Write($stylesheet, 1);
        $mpdf->WriteHTML($html);
        $mpdf->Output('report_product_summary_' . $date_start . '_to_' . $date_end . '.pdf', 'D');
        break;
    case 'report_2-1':
        $billin_id = $_GET['billin_id'];
        include '../back/reportdata_2-1.php';
        $html = ob_get_contents();
        ob_clean();
        $mpdf = new mPDF("UTF-8");
        $mpdf->SetAutoFont();
        $mpdf->AddPage('L');
        $mpdf->Write($stylesheet, 1);
        $mpdf->WriteHTML($html);
        $mpdf->Output('report_billin_id_'.$billin_id.'.pdf', 'D');
        break;
    case 'report_2-2':

        break;
    case 'report_3':

        break;
    default:
        break;
}

