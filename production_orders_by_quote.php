<?php
$page_title = 'รายการสั่งผลิตตามใบสั่งซื้อ';
require_once('includes/load.php');
// ตรวจสอบระดับสิทธิ์ของผู้ใช้ในการดูหน้านี้
page_require_level(2);

// ดึงข้อมูลใบเสนอราคาทั้งหมด
$all_quotes = find_all('quotes');
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
          <span>รายการสั่งผลิตตามใบสั่งซื้อ</span>
        </strong>
      </div>
      <div class="panel-body">
        <!-- วนลูปเพื่อแสดงรายการสั่งผลิตแยกตามใบสั่งซื้อ -->
        <?php foreach ($all_quotes as $quote): ?>
          <div class="panel panel-info">
            <div class="panel-heading">
              <strong>ใบสั่งซื้อ #<?php echo $quote['id']; ?></strong> - ชื่อลูกค้า: <?php echo find_by_id('customers', $quote['customer_id'])['name']; ?>
            </div>
            <div class="panel-body">
              <table class="table table-bordered">
                <thead>
                  <tr>
                    <th>ชื่อสินค้า</th>
                    <th class="text-center">จำนวน</th>
                    <th class="text-center">สถานะการผลิต</th>
                    <th class="text-center">วันที่สั่งผลิต</th>
                    <th class="text-center">ดำเนินการ</th>
                  </tr>
                </thead>
                <tbody>
                  <?php
                  // ดึงข้อมูลรายการสั่งผลิตตามใบเสนอราคานี้
                  $production_orders = find_all_where('production_orders', 'quote_id', $quote['id']);
                  foreach ($production_orders as $order):
                    $product = find_by_id('products', $order['product_id']);
                  ?>
                    <tr>
                      <td><?php echo $product['name']; ?></td>
                      <td class="text-center"><?php echo $order['quantity']; ?></td>
                      <td class="text-center">
                        <?php echo $order['status'] == 'Pending' ? '<span class="label label-warning">รอดำเนินการ</span>' : '<span class="label label-success">เสร็จสมบูรณ์</span>'; ?>
                      </td>
                      <td class="text-center"><?php echo $order['created_at']; ?></td>
                      <td class="text-center">
                        <a href="edit_production_order.php?id=<?php echo $order['id']; ?>" class="btn btn-warning btn-sm" title="แก้ไข" data-toggle="tooltip">
                          <span class="glyphicon glyphicon-edit"></span>
                        </a>
                      </td>
                    </tr>
                  <?php endforeach; ?>
                </tbody>
              </table>
            </div>
          </div>
        <?php endforeach; ?>
      </div>
    </div>
  </div>
</div>

<?php include_once('layouts/footer.php'); ?>
