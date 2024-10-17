<?php
$page_title = 'แก้ไขสถานะการสั่งผลิต';
require_once('includes/load.php');
// ตรวจสอบระดับสิทธิ์ของผู้ใช้ในการดูหน้านี้
page_require_level(2);

// ตรวจสอบว่ามี ID ของการสั่งผลิตหรือไม่
if (isset($_GET['id'])) {
    $order_id = $_GET['id'];
    // ดึงข้อมูลการสั่งผลิต
    $production_order = find_by_id('production_orders', $order_id);

    if (!$production_order) {
        $session->msg('d', 'ไม่พบข้อมูลการสั่งผลิตนี้');
        redirect('production_orders_by_quote.php', false);
    }

    // เมื่อผู้ใช้บันทึกการแก้ไข
    if (isset($_POST['update'])) {
        $status = remove_junk($db->escape($_POST['status']));

        $query = "UPDATE production_orders SET status = '{$status}' WHERE id = '{$order_id}'";
        if ($db->query($query)) {
            $session->msg('s', 'อัปเดตสถานะการผลิตสำเร็จ');
            redirect('production_orders_by_quote.php', false);
        } else {
            $session->msg('d', 'อัปเดตสถานะล้มเหลว');
            redirect('edit_production_order.php?id=' . $order_id, false);
        }
    }
} else {
    $session->msg('d', 'Missing order ID.');
    redirect('production_orders_by_quote.php', false);
}
?>

<?php include_once('layouts/header.php'); ?>

<div class="row">
  <div class="col-md-6">
    <?php echo display_msg($msg); ?>
  </div>
</div>

<div class="row">
  <div class="col-md-6">
    <div class="panel panel-default">
      <div class="panel-heading">
        <strong>
          <span class="glyphicon glyphicon-th"></span>
          <span>แก้ไขสถานะการสั่งผลิต</span>
        </strong>
      </div>
      <div class="panel-body">
        <form method="post" action="edit_production_order.php?id=<?php echo $order_id; ?>">
          <div class="form-group">
            <label for="status">สถานะการผลิต</label>
            <select class="form-control" name="status" id="status">
              <option value="Pending" <?php if($production_order['status'] == 'Pending') echo 'selected'; ?>>รอดำเนินการ</option>
              <option value="Completed" <?php if($production_order['status'] == 'Completed') echo 'selected'; ?>>เสร็จสมบูรณ์</option>
            </select>
          </div>
          <button type="submit" name="update" class="btn btn-primary">บันทึกการแก้ไข</button>
        </form>
      </div>
    </div>
  </div>
</div>

<?php include_once('layouts/footer.php'); ?>
