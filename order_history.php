<?php
$page_title = 'ประวัติการสั่งซื้อทั้งหมด';
require_once('includes/load.php');
// ตรวจสอบระดับสิทธิ์ของผู้ใช้ในการดูหน้านี้
page_require_level(3);

// ดึงข้อมูลคำสั่งซื้อทั้งหมดจากฐานข้อมูล
$orders = find_all_orders(); 
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
        <table class="table ">
          <thead class="custom-bg">
            <tr>
              <th class="text-center">#</th>
              <th> รหัสคำสั่งซื้อ </th>
              <th class="text-center"> ชื่อสินค้า </th>
              <th class="text-center"> ชื่อผู้สั่งซื้อ </th>
              <th class="text-center"> จำนวนสินค้า </th>
              <th class="text-center"> ราคารวม </th>
              <th class="text-center"> วันที่สั่งซื้อ </th>
              <th class="text-center"> สถานะคำสั่งซื้อ </th>
            </tr>
          </thead>
          <tbody>
            <?php foreach ($orders as $order): ?>
              <tr>
                <td class="text-center"><?php echo count_id(); ?></td>
                <td><?php echo remove_junk($order['id']); ?></td>
                <td class="text-center"><?php echo remove_junk($order['product_name']); ?></td>
                <td class="text-center"><?php echo remove_junk($order['customer_name']); ?></td>
                <td class="text-center"><?php echo (int)$order['qty']; ?></td>
                <td class="text-center"><?php echo number_format((float)$order['price'], 2); ?></td>
                <td class="text-center"><?php echo $order['date']; ?></td>
                <td class="text-center">
                  <?php
                  if ($order['status'] === 'Completed') {
                    echo '<span class="custon-label label-success">เสร็จสมบูรณ์</span>';
                  } elseif ($order['status'] === 'Pending') {
                    echo '<span class="custon-label label-warning">รอดำเนินการ</span>';
                  } elseif ($order['status'] === 'Cancelled') {
                    echo '<span class="custon-label label-danger">ยกเลิก</span>';
                  } else {
                    echo '<span class="label label-default">ไม่ทราบสถานะ</span>';
                  }
                  ?>
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
