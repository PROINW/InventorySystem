<?php
$page_title = 'แก้ไขการขาย';
require_once('includes/load.php');
require_once('includes/session.php');
require_once('includes/database.php');
// ตรวจสอบระดับสิทธิ์ของผู้ใช้ในการดูหน้านี้
page_require_level(3);
?>
<?php
$sale = find_by_id('sales', (int)$_GET['id']);
if (!$sale) {
  $session->msg("d", "ไม่พบรหัสสินค้า.");
  redirect('sales.php');
}
?>
<?php $product = find_by_id('products', $sale['product_id']); ?>
<?php

if (isset($_POST['update_sale'])) {
  $req_fields = array('title', 'quantity', 'price', 'total', 'date', 'status');
  validate_fields($req_fields);
  if (empty($errors)) {
    $p_id      = $db->escape((int)$product['id']);
    $s_qty     = $db->escape((int)$_POST['quantity']);
    $s_total   = $db->escape($_POST['total']);
    $date      = $db->escape($_POST['date']);
    $s_date    = date("Y-m-d", strtotime($date));
    $s_status  = $db->escape($_POST['status']);  // รับค่าสถานะจากฟอร์ม

    $sql  = "UPDATE sales SET";
    $sql .= " product_id= '{$p_id}', qty={$s_qty}, price='{$s_total}', date='{$s_date}', status='{$s_status}'";  // เพิ่มการอัปเดตสถานะ
    $sql .= " WHERE id ='{$sale['id']}'";
    $result = $db->query($sql);
    if ($result && $db->affected_rows() === 1) {
      update_product_qty($s_qty, $p_id);
      $session->msg('s', "อัปเดตการขายเรียบร้อยแล้ว.");
      redirect('edit_sale.php?id=' . $sale['id'], false);
    } else {
      $session->msg('d', 'ขออภัย! การอัปเดตล้มเหลว');
      redirect('sales.php', false);
    }
  } else {
    $session->msg("d", $errors);
    redirect('edit_sale.php?id=' . (int)$sale['id'], false);
  }
}

?>
<?php include_once('layouts/header.php'); ?>
<div class="row">
  <div class="col-md-6">
    <?php echo display_msg($msg); ?>
  </div>
</div>
<div class="row">
  <div class="col-md-12">
    <div class="panel">
      <div class="panel-heading clearfix">
        <strong>
          <span class="glyphicon glyphicon-th"></span>
          <span>แก้ไขการขาย</span>
        </strong>
        <div class="pull-right">
          <a href="sales.php" class="btn btn-primary">แสดงรายการขายทั้งหมด</a>
        </div>
      </div>
      <div class="panel-body">
        <form method="post" action="edit_sale.php?id=<?php echo (int)$sale['id']; ?>" class="clearfix">
          <div class="row">
            <div class="col-xs-12 col-sm-6 col-md-2">
              <div class="form-group">
                <label for="title">ชื่อสินค้า</label>
                <input type="text" class="form-control" name="title" value="<?php echo remove_junk($product['name']); ?>">
              </div>
            </div>
            <div class="col-xs-12 col-sm-6 col-md-2">
              <div class="form-group">
                <label for="quantity">จำนวน</label>
                <input type="text" class="form-control" name="quantity" value="<?php echo (int)$sale['qty']; ?>">
              </div>
            </div>
            <div class="col-xs-12 col-sm-6 col-md-2">
              <div class="form-group">
                <label for="price">ราคา</label>
                <input type="text" class="form-control" name="price" value="<?php echo remove_junk($product['sale_price']); ?>">
              </div>
            </div>
            <div class="col-xs-12 col-sm-6 col-md-2">
              <div class="form-group">
                <label for="total">ราคารวม</label>
                <input type="text" class="form-control" name="total" value="<?php echo remove_junk($sale['price']); ?>">
              </div>
            </div>
            <div class="col-xs-12 col-sm-6 col-md-2">
              <div class="form-group">
                <label for="date">วันที่</label>
                <input type="date" class="form-control" name="date" value="<?php echo remove_junk($sale['date']); ?>">
              </div>
            </div>
            <div class="col-xs-12 col-sm-6 col-md-2">
              <div class="form-group">
                <label for="status">สถานะ</label>
                <select class="form-control" name="status">
                  <option value="Pending" <?php if ($sale['status'] === 'Pending') echo 'selected'; ?>>รอดำเนินการ</option>
                  <option value="Completed" <?php if ($sale['status'] === 'Completed') echo 'selected'; ?>>เสร็จสมบูรณ์</option>
                  <option value="Refunded" <?php if ($sale['status'] === 'Refunded') echo 'selected'; ?>>ยกเลิก</option>
                  
                </select>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-xs-12 text-right">  
              <button type="submit" name="update_sale" class="btn btn-primary">อัปเดตการขาย</button>
            </div>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>

<?php include_once('layouts/footer.php'); ?>
