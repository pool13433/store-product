<?php
$date_start = "";
$date_end = "";
if (!empty($_GET['date_start']) && !empty($_GET['date_end'])):
    $date_start = $_GET['date_start'];
    $date_end = $_GET['date_end'];
endif;
?>
<div class="uk-panel" style="padding-right: 15px">    
    <h3 class="uk-panel-title">ค้นหารายงาน</h3>
    <form  class="uk-form uk-form-horizontal" method="get" action="index.php?page=report_1">
        <div class="uk-grid">
            <div class="uk-width-1-2">
                <div class="uk-form-row">
                    <label for="input-month" class="uk-form-label">เริ่มตั้งแต่</label>
                    <div class="uk-form-controls">          
                        <input type="hidden" name="page" value="report_1"/>
                        <input type="text" name="date_start" id="input-month" value="<?= $date_start ?>"
                               readonly data-uk-datepicker="{format:'DD/MM/YYYY'}"/>
                    </div>
                </div>
            </div>
            <div class="uk-width-1-2">
                <div class="uk-form-row">
                    <label for="input-month" class="uk-form-label">ถึง</label>
                    <div class="uk-form-controls">          
                        <input type="text" name="date_end" id="input-month" value="<?= $date_end ?>"
                               readonly data-uk-datepicker="{format:'DD/MM/YYYY'}"/>
                    </div>
                </div>
            </div>
        </div>       
        <div class="uk-grid">
            <div class="uk-width-1-1">
                <div class="uk-form-row">
                    <div class="uk-form-controls">
                        <button class="uk-button uk-button-primary uk-button-large" type="submit">
                            <i class="uk-icon-save"></i> ค้นหาข้อมูล
                        </button>
                    </div>
                </div>
            </div>
        </div>        
    </form>
    <?php if (!empty($_GET['date_start']) && !empty($_GET['date_end'])): ?>
        <?php include './reportdata_1.php'; ?>
        <div class="uk-form-row" style="text-align: right">
            <div class="uk-form-controls">
                <a class="uk-button uk-button-primary" 
                   href="../report/report.php?method=report_1&date_start=<?= $_GET['date_start'] ?>&date_end=<?= $_GET['date_end'] ?>" target="_blank">
                    <i class="uk-icon-print"></i> ออกรายงาน
                </a>
            </div>
        </div>
    <?php endif; ?>
</div>