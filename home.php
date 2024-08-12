<?php
  $page_title = 'หน้าหลัก';
  require_once('includes/load.php');
  require_once('includes/session.php');
  if (!$session->isUserLoggedIn(true)) { redirect('index.php', false);}
?>
<?php include_once('layouts/header.php'); ?>
<div class="row">
  <div class="col-md-12">
    <?php echo display_msg($msg); ?>
  </div>
 <div class="col-md-12">
    <div class="panel">
      <div class="jumbotron text-center">
         <h1>ยินดีต้อนรับผู้ใช้ <hr> ระบบการจัดการสินค้า</h1>
         <p>สำรวจเพื่อค้นหาหน้าต่าง ๆ ที่คุณสามารถเข้าถึงได้!</p>
      </div>
    </div>
 </div>
</div>
<?php include_once('layouts/footer.php'); ?>
