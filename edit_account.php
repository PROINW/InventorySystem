<!doctype html>
<html lang="th">

<head>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>

<?php
$page_title = 'แก้ไขบัญชี';
require_once('includes/load.php');
require_once('includes/session.php');
require_once('includes/database.php');
page_require_level(3);
?>
<?php
// อัพโหลดรูปผู้ใช้
if (isset($_POST['submit'])) {
  $photo = new Media();
  $user_id = (int)$_POST['user_id'];
  $photo->upload($_FILES['file_upload']);
  if ($photo->process_user($user_id)) {
    $session->msg('s', 'อัพโหลดรูปภาพเรียบร้อยแล้ว');
    redirect('edit_account.php');
  } else {
    $session->msg('d', join($photo->errors));
    redirect('edit_account.php');
  }
}
?>
<?php
// อัพเดทข้อมูลผู้ใช้
if (isset($_POST['update'])) {
  $req_fields = array('name', 'username');
  validate_fields($req_fields);
  if (empty($errors)) {
    $id = (int)$_SESSION['user_id'];
    $name = remove_junk($db->escape($_POST['name']));
    $username = remove_junk($db->escape($_POST['username']));
    $sql = "UPDATE users SET name ='{$name}', username ='{$username}' WHERE id='{$id}'";
    $result = $db->query($sql);
    if ($result && $db->affected_rows() === 1) {
      $session->msg('s', "อัพเดทข้อมูลเรียบร้อยแล้ว");
      redirect('edit_account.php', false);
    } else {
      $session->msg('d', 'ขออภัย อัพเดทข้อมูลล้มเหลว!');
      redirect('edit_account.php', false);
    }
  } else {
    $session->msg("d", $errors);
    redirect('edit_account.php', false);
  }
}
?>
<?php include_once('layouts/header.php'); ?>
<div class="row">
  <div class="col-md-12">
    <?php echo display_msg($msg); ?>
  </div>
  <div class="col-md-6">
    <div class="panel panel-default">
      <div class="panel-heading">
        <div class="panel-heading clearfix">
          <span class="glyphicon glyphicon-camera"></span>
          <span>เปลี่ยนรูปภาพของฉัน</span>
        </div>
      </div>
      <div class="panel-body">
        <div class="row">
          <div class="col-md-4">
            <img class="img-circle img-size-2" src="uploads/users/<?php echo $user['image']; ?>" alt="">
          </div>
          <div class="col-md-8">
            <form class="form" action="edit_account.php" method="POST" enctype="multipart/form-data">
              <div class="form-group">
                <label for="formFileMultiple" class="form-label">อัพโหลดรูปภาพ</label>
                <input type="file" name="file_upload" multiple="multiple" class="form-control" />
              </div>
              <div class="form-group">
                <input type="hidden" name="user_id" value="<?php echo $user['id']; ?>">
                <button type="submit" name="submit" class="btn btn-warning">เปลี่ยน</button>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
  <div class="col-md-6">
    <div class="panel panel-default">
      <div class="panel-heading clearfix">
        <span class="glyphicon glyphicon-edit"></span>
        <span>แก้ไขบัญชีของฉัน</span>
      </div>
      <div class="panel-body">
        <form method="post" action="edit_account.php?id=<?php echo (int)$user['id']; ?>" class="clearfix">
          <div class="form-group">
            <label for="name" class="control-label">ชื่อ</label>
            <input type="name" class="form-control" name="name" value="<?php echo remove_junk(ucwords($user['name'])); ?>">
          </div>
          <div class="form-group">
            <label for="username" class="control-label">ชื่อผู้ใช้</label>
            <input type="text" class="form-control" name="username" value="<?php echo remove_junk(ucwords($user['username'])); ?>">
          </div>
          <div class="form-group clearfix">
            <a href="change_password.php" title="เปลี่ยนรหัสผ่าน" class="btn btn-danger pull-right">เปลี่ยนรหัสผ่าน</a>
            <button type="submit" name="update" class="btn btn-info">อัพเดท</button>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>



<?php include_once('layouts/footer.php'); ?>


