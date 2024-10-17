<?php
$page_title = 'เริ่มการสั่งผลิต';
require_once('includes/load.php');
// ตรวจสอบระดับสิทธิ์ของผู้ใช้ในการดูหน้านี้
page_require_level(2);

// รับค่า quote_id ที่ส่งมาจากหน้าใบเสนอราคา
$quote_id = isset($_GET['id']) ? (int)$_GET['id'] : 0;
if ($quote_id == 0) {
  $session->msg("d", "ไม่พบใบเสนอราคา");
  redirect('quotes.php', false);
}

// ดึงข้อมูลใบเสนอราคาตาม quote_id
$quote = find_by_id('quotes', $quote_id);
if (!$quote) {
  $session->msg("d", "ไม่พบใบเสนอราคาที่คุณเลือก");
  redirect('quotes.php', false);
}

// ดึงข้อมูลสินค้าที่อยู่ในใบเสนอราคานี้
$quote_items = find_all_where('quote_items', 'quote_id', $quote_id);
?>
<?php include_once('layouts/header.php'); ?>

<div class="row">
  <div class="col-md-12">
    <?php echo display_msg($msg); ?>
  </div>
</div>

<div class="row">
  <div class="col-md-12">
    <div class="panel panel-default">
      <div class="panel-heading clearfix">
        <strong>
          <span class="glyphicon glyphicon-th"></span>
          <span>รายละเอียดการสั่งผลิตจากใบเสนอราคา #<?php echo $quote['id']; ?></span>
        </strong>
      </div>
      <div class="panel-body">
        <h4>ชื่อลูกค้า: <?php echo find_by_id('customers', $quote['customer_id'])['name']; ?></h4>
        <table class="table">
          <thead>
            <tr>
              <th>ชื่อสินค้า</th>
              <th>จำนวน</th>
              <th>ราคาต่อหน่วย</th>
              <th>ราคารวม</th>
            </tr>
          </thead>
          <tbody>
            <?php foreach ($quote_items as $item): ?>
              <?php $product = find_by_id('products', $item['product_id']); ?>
              <tr>
                <td><?php echo $product['name']; ?></td>
                <td><?php echo $item['quantity']; ?></td>
                <td><?php echo number_format($item['price'], 2); ?> บาท</td>
                <td><?php echo number_format($item['quantity'] * $item['price'], 2); ?> บาท</td>
              </tr>
            <?php endforeach; ?>
          </tbody>
        </table>

        <!-- ปุ่มยืนยันการสั่งผลิต -->
        <form method="POST" action="confirm_production.php">
          <input type="hidden" name="quote_id" value="<?php echo $quote['id']; ?>">
          <button type="submit" class="btn btn-success">ยืนยันการสั่งผลิต</button>
        </form>
      </div>
    </div>
  </div>
</div>

<?php include_once('layouts/footer.php'); ?>
