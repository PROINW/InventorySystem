<?php
$page_title = 'Edit Delivery Company';
require_once('includes/load.php');
require_once('includes/session.php');
require_once('includes/database.php');
// ตรวจสอบระดับสิทธิ์ของผู้ใช้ในการดูหน้านี้
page_require_level(1);
?>
<?php
// ดึงข้อมูลบริษัทจาก id ที่ส่งมา
$company = find_by_id('delivery_company', (int)$_GET['id']);
if (!$company) {
    $session->msg("d", "Missing company id.");
    redirect('company.php');
}
?>

<?php
if (isset($_POST['edit_company'])) {
    $req_fields = array('company-name', 'company-address', 'company-contact');
    validate_fields($req_fields);
    $company_name = remove_junk($db->escape($_POST['company-name']));
    $company_address = remove_junk($db->escape($_POST['company-address']));
    $company_phone = remove_junk($db->escape($_POST['company-contact']));

    if (empty($errors)) {
        $sql = "UPDATE delivery_company SET name='{$company_name}', address='{$company_address}', contact_number='{$company_phone}'";
        $sql .= " WHERE id='{$company['id']}'";
        $result = $db->query($sql);
        if ($result && $db->affected_rows() === 1) {
            $session->msg("s", "Successfully updated company");
            redirect('company.php', false);
        } else {
            $session->msg("d", "Sorry! Failed to Update");
            redirect('company.php', false);
        }
    } else {
        $session->msg("d", $errors);
        redirect('company.php', false);
    }
}
?>

<?php include_once('layouts/header.php'); ?>

<div class="row">
    <div class="col-md-12">
        <?php echo display_msg($msg); ?>
    </div>
    <div class="col-md-5">
        <div class="panel panel-default">
            <div class="panel-heading">
                <strong>
                    <span class="glyphicon glyphicon-th"></span>
                    <span>แก้ไขบริษัท <?php echo remove_junk(ucfirst($company['name'])); ?></span>
                </strong>
            </div>
            <div class="panel-body">
                <form method="post" action="edit_company.php?id=<?php echo (int)$company['id']; ?>">
                    <div class="form-group">
                        <label for="company-name">ชื่อบริษัท</label>
                        <input type="text" class="form-control" name="company-name" value="<?php echo remove_junk($company['name']); ?>">
                    </div>
                    <div class="form-group">
                        <label for="company-address">ที่อยู่บริษัท</label>
                        <input type="text" class="form-control" name="company-address" value="<?php echo remove_junk($company['address']); ?>">
                    </div>
                    <div class="form-group">
                        <label for="company-contact">เบอร์ติดต่อ</label>
                        <input type="text" class="form-control" name="company-contact" value="<?php echo remove_junk($company['contact_number']); ?>" pattern="\d*" title="กรุณาใส่เฉพาะตัวเลข" maxlength="10" oninput="this.value = this.value.replace(/[^0-9]/g, '')">
            </div>
            <button type="submit" name="edit_company" class="btn btn-primary">อัปเดตบริษัท</button>
            </form>
        </div>
    </div>
</div>
</div>

<?php include_once('layouts/footer.php'); ?>