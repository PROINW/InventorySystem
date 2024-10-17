<?php
$page_title = 'ประวัติการสั่งซื้อทั้งหมด';
require_once('includes/load.php');
// ตรวจสอบระดับสิทธิ์ของผู้ใช้ในการดูหน้านี้
page_require_level(3);

// ดึงข้อมูลคำสั่งซื้อทั้งหมดจากฐานข้อมูล
$orders = find_by_sql("SELECT q.id as order_id, q.sale_date, q.total, p.name as product_name, c.name as customer_name, qi.quantity 
                        FROM quotes q
                        LEFT JOIN quote_items qi ON q.id = qi.quote_id
                        LEFT JOIN products p ON qi.product_id = p.id
                        LEFT JOIN customers c ON q.customer_id = c.id
                        ORDER BY q.sale_date DESC"); 
?>
<?php include_once('layouts/header.php'); ?>
<link rel="stylesheet" href="libs/css/main.css" />

<div class="row">
  <div class="col-md-6">
    <?php echo display_msg($msg); ?>
  </div>
</div>

<div class="row">
  <div class="col-md-12">
    <div class="panel panel-default">
      <div class="panel-heading clearfix">
        <strong>
          <span class="glyphicon glyphicon-th"></span>
          <span>ประวัติการสั่งซื้อทั้งหมด</span>
        </strong>
      </div>
      <div class="panel-body">
        <table class="table">
          <thead class="custom-bg">
            <tr>
              <th class="text-center">#</th>
              <th> รหัสคำสั่งซื้อ </th>
              <th class="text-center"> ชื่อสินค้า </th>
              <th class="text-center"> ชื่อผู้สั่งซื้อ </th>
              <th class="text-center"> จำนวนสินค้า </th>
              <th class="text-center"> ราคารวม </th>
              <th class="text-center"> วันที่สั่งซื้อ </th>
            </tr>
          </thead>
          <tbody>
            <?php foreach ($orders as $order): ?>
              <tr>
                <td class="text-center"><?php echo count_id(); ?></td>
                <td><?php echo remove_junk($order['order_id'] ?? ''); ?></td>
                <td class="text-center"><?php echo remove_junk($order['product_name'] ?? ''); ?></td>
                <td class="text-center"><?php echo remove_junk($order['customer_name'] ?? ''); ?></td>
                <td class="text-center"><?php echo (int)($order['quantity'] ?? 0); ?></td>
                <td class="text-center"><?php echo number_format((float)($order['total'] ?? 0), 2); ?></td>
                <td class="text-center">
                  <?php echo $order['sale_date'] ? date('d/m/Y', strtotime($order['sale_date'])) : 'N/A'; ?>
                </td>
              </tr>
            <?php endforeach; ?>
          </tbody>
        </table>
      </div>
    </div>
  </div>
</div>

<?php include_once('layouts/footer.php'); ?>
