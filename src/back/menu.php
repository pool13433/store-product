<div class="uk-panel uk-panel-box">
    <h3 class="uk-panel-title">ยินดีตอนรับสู่</h3>    
    <h3 class="uk-panel-title">ระบบจัดการคลังสินค้า</h3>
    <ul class="uk-nav uk-nav-side uk-nav-parent-icon" data-uk-nav="">
        <li class="uk-nav-header">
            <button class="uk-button uk-button-mini uk-button-danger" data-uk-offcanvas="{target:'#my-id'}">
                สินค้าใกล้หมด
            </button>
        </li>  
        <li class="uk-nav-divider"></li>
        <li class="uk-nav-header">ตั้งค่า</li>
        <li>
            <a href="index.php?page=manage_prefix"><i class="uk-icon-users"></i> จัดการคำนำหน้าชื่อ</a> 
            <a href="index.php?page=manage_person"><i class="uk-icon-users"></i> จัดการผู้ใช้งาน</a> 
            <a href="index.php?page=manage_store_contact"><i class="uk-icon-mobile"></i> จัดการร้านค้าติดต่อ</a> 
            <a href="index.php?page=manage_supplier_contact"><i class="uk-icon-mobile"></i> จัดการร้านค้าจัดจำหน่าย</a>
            <a href="index.php?page=manage_pay_condition"><i class="uk-icon-money"></i> จัดการระยะเวลาการจ่ายเงิน</a> 
        </li>        
        <li class="uk-nav-divider"></li>
        <li>
            <a href="index.php?page=manage_category"><i class="uk-icon-wrench"></i> จัดการกลุ่มสินค้า</a> 
            <a href="index.php?page=manage_type"><i class="uk-icon-wrench"></i> จัดการชนิดสินค้า</a> 
            <a href="index.php?page=manage_product"><i class="uk-icon-gift"></i> จัดการสินค้า</a> 
            <!-- <a href="index.php?page=manage_adjust"><i class="uk-icon-gift"></i> ปรับสมดุลสินค้า</a> -->
        </li>  
        <li class="uk-nav-divider"></li>
        <li>
            <a href="index.php?page=manage_bill_in"><i class="uk-icon-arrow-down"></i> Bill In</a> 
            <a href="index.php?page=manage_bill_out"><i class="uk-icon-arrow-up"></i> Bill Out</a>            
        </li>    
        <li class="uk-nav-divider"></li>
        <li>
            <a href="index.php?page=report_1"><i class="uk-icon-book"></i> รายงานสรุปสินค้ารายวัน/เดือน</a> 
            <a href="index.php?page=report_2"><i class="uk-icon-book"></i> รายงานสินค้าเข้าคลังสินค้า</a>            
            <a href="index.php?page=report_3"><i class="uk-icon-book"></i> รายงานสรุปยอดคลังสินค้า</a>
        </li>  
        <li class="uk-nav-divider"></li>
        <li>
            <a href="#" onclick="return logout()"><i class="uk-icon-sign-out"></i> ออกจากระบบ</a> 
        </li>
    </ul>
</div>


<script type="text/javascript">
    function logout() {
        var conf = confirm('ยืนยันการออกจากระบบ');
        if (conf) {
            $.post('../database/db_person.php?method=logout', {}, function(data) {
                redirectDelay('../index.php?page=login');
            });
            return true;
        }
        return false;
    }
</script>

