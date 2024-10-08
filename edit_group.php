<!doctype html>
<html lang="th">

<head>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
  <title>แก้ไขกลุ่ม</title>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</head>

<body>
<?php
$page_title = 'แก้ไขกลุ่ม';
require_once('includes/load.php');
require_once('includes/session.php');
require_once('includes/database.php');
// ตรวจสอบระดับสิทธิ์ของผู้ใช้ในการดูหน้านี้
page_require_level(1);
?>
<?php
$e_group = find_by_id('user_groups', (int)$_GET['id']);
if (!$e_group) {
  $session->msg("d", "ไม่พบ ID ของกลุ่ม.");
  redirect('group.php');
}
?>
<?php
if (isset($_POST['update'])) {
  $req_fields = array('group-name', 'group-level');
  validate_fields($req_fields);
  if (empty($errors)) {
    $name = remove_junk($db->escape($_POST['group-name']));
    $level = remove_junk($db->escape($_POST['group-level']));

    $query  = "UPDATE user_groups SET ";
    $query .= "group_name='{$name}', group_level='{$level}' ";
    $query .= "WHERE id='{$db->escape($e_group['id'])}'";
    $result = $db->query($query);
    if ($result && $db->affected_rows() === 1) {
      // สำเร็จ
      $session->msg('s', "กลุ่มได้ถูกอัปเดตแล้ว!");
      redirect('group.php', false);
    } else {
      // ล้มเหลว
      $session->msg('d', 'ขออภัย ล้มเหลวในการอัปเดตกลุ่ม!');
      redirect('edit_group.php?id=' . (int)$e_group['id'], false);
    }
  } else {
    $session->msg("d", $errors);
    redirect('edit_group.php?id=' . (int)$e_group['id'], false);
  }
}
?>
<?php include_once('layouts/header.php'); ?>
<div class="login-page">
  <div class="text-center">
    <h3>แก้ไขกลุ่ม</h3>
  </div>
  <?php echo display_msg($msg); ?>
  <form method="post" action="edit_group.php?id=<?php echo (int)$e_group['id']; ?>" class="clearfix" id="editGroupForm">
    <div class="form-group">
      <label for="name" class="control-label">ชื่อกลุ่ม</label>
      <input type="text" class="form-control" name="group-name" value="<?php echo remove_junk(ucwords($e_group['group_name'])); ?>">
    </div>
    <div class="form-group">
      <label for="level" class="control-label">ระดับกลุ่ม</label>
      <input type="number" class="form-control" name="group-level" value="<?php echo (int)$e_group['group_level']; ?>">
    </div>
    <div class="form-group clearfix">
      <!-- ปุ่มเปิดโมดอล -->
      <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#confirmModal">อัปเดต</button>
    </div>
    <!-- ปุ่มซ่อนสำหรับการส่งฟอร์ม -->
    <button type="submit" name="update" id="submitForm" class="d-none"></button>
  </form>

  <!-- โมดอล -->
  <div class="modal fade" id="confirmModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h1 class="modal-title fs-5" id="exampleModalLabel">ยืนยันการอัปเดต</h1>
          <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          คุณแน่ใจว่าต้องการอัปเดตกลุ่มนี้หรือไม่?
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">ปิด</button>
          <!-- ปุ่มยืนยันการอัปเดต -->
          <button type="button" class="btn btn-primary" id="confirmUpdate">บันทึก</button>
        </div>
      </div>
    </div>
  </div>

  <?php include_once('layouts/footer.php'); ?>

  <script>
  document.getElementById('confirmUpdate').addEventListener('click', function() {
      document.getElementById('submitForm').click();
      history.back();
  });
  </script>
</body>
</html>
