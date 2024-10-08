<?php
$page_title = 'เพิ่มกลุ่มผู้ใช้';
require_once('includes/load.php');
require_once('includes/session.php');
require_once('includes/database.php');
// ตรวจสอบระดับสิทธิ์ของผู้ใช้ในการดูหน้านี้
page_require_level(1);
?>
<?php
if (isset($_POST['add'])) {
    $req_fields = array('group-name', 'group-level');
    validate_fields($req_fields);

    // ตรวจสอบค่าของ Group Level
    $group_level = (int)$_POST['group-level'];
    if ($group_level > 3) {
        $session->msg('d', '<b>ขออภัย!</b> Group Level ต้องไม่เกิน 3!');
        redirect('add_group.php', false);
    }

    if (find_by_groupName($_POST['group-name']) === false) {
        $session->msg('d', '<b>ขออภัย!</b> ชื่อกลุ่มที่กรอกอยู่ในฐานข้อมูลแล้ว!');
        redirect('add_group.php', false);
    } elseif (find_by_groupLevel($_POST['group-level']) === false) {
        $session->msg('d', '<b>ขออภัย!</b> ระดับกลุ่มที่กรอกอยู่ในฐานข้อมูลแล้ว!');
        redirect('add_group.php', false);
    }

    if (empty($errors)) {
        $name = remove_junk($db->escape($_POST['group-name']));
        $level = remove_junk($db->escape($_POST['group-level']));
        $status = remove_junk($db->escape($_POST['status']));

        $query  = "INSERT INTO user_groups (";
        $query .= "group_name, group_level, group_status";
        $query .= ") VALUES (";
        $query .= " '{$name}', '{$level}', '{$status}'";
        $query .= ")";
        if ($db->query($query)) {
            // success
            $session->msg('s', "กลุ่มถูกสร้างเรียบร้อยแล้ว!");
            redirect('add_group.php', false);
        } else {
            // failed
            $session->msg('d', 'ขออภัย ไม่สามารถสร้างกลุ่มได้!');
            redirect('add_group.php', false);
        }
    } else {
        $session->msg("d", $errors);
        redirect('add_group.php', false);
    }
}
?>
<?php include_once('layouts/header.php'); ?>
<div class="login-page">
    <div class="text-center">
       <h3>เพิ่มกลุ่มผู้ใช้ใหม่</h3>
    </div>
    <?php echo display_msg($msg); ?>
    <form method="post" action="add_group.php" class="clearfix">
        <div class="form-group">
            <label for="name" class="control-label">ชื่อกลุ่ม</label>
            <input type="name" class="form-control" name="group-name" required>
        </div>
        <div class="form-group">
            <label for="level" class="control-label">ระดับกลุ่ม (สูงสุด 3)</label>
            <input type="number" class="form-control" name="group-level" max="3" min="1" required>
        </div>
        <div class="form-group">
            <label for="status">สถานะ</label>
            <select class="form-control" name="status">
                <option value="1">ใช้งาน</option>
                <option value="0">ไม่ใช้งาน</option>
            </select>
        </div>
        <div class="form-group clearfix">
            <button type="submit" name="add" class="btn btn-info">เพิ่ม</button>
        </div>
    </form>
</div>

<?php include_once('layouts/footer.php'); ?>
