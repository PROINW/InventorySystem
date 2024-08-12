<?php
require_once('includes/load.php');
require_once('includes/session.php');
require_once('includes/database.php');
// ตรวจสอบระดับสิทธิ์ของผู้ใช้ในการดูหน้านี้
page_require_level(1);

if (isset($_GET['id'])) {
    $company_id = (int)$_GET['id'];
    
    // ตรวจสอบว่ามีบริษัทจัดส่งนี้อยู่ในฐานข้อมูลหรือไม่
    $company = find_by_id('delivery_company', $company_id);
    if (!$company) {
        $session->msg("d", "ไม่พบข้อมูลบริษัทจัดส่งที่ต้องการลบ.");
        redirect('company.php');
    }

    // ลบข้อมูลบริษัทจัดส่ง
    $sql = "DELETE FROM delivery_company WHERE id = '{$company_id}'";
    if ($db->query($sql)) {
        $session->msg("s", "ลบข้อมูลบริษัทจัดส่งเรียบร้อยแล้ว.");
        redirect('company.php');
    } else {
        $session->msg("d", "ขออภัย! การลบข้อมูลบริษัทจัดส่งล้มเหลว.");
        redirect('company.php');
    }
} else {
    $session->msg("d", "Missing company id.");
    redirect('company.php');
}
?>
