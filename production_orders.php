<?php
$page_title = 'รายการสั่งผลิตสินค้า';
require_once('includes/load.php');
// ตรวจสอบระดับสิทธิ์ของผู้ใช้ในการดูหน้านี้
page_require_level(2);

// ดึงข้อมูลคำสั่งผลิตทั้งหมด
$all_production_orders = find_all('production_orders');
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
          <span>รายการสั่งผลิตสินค้า</span>
        </strong>
      </div>
      <div class="panel-body">
        <table class="table table-bordered">
          <thead>
            <tr>
              <th class="text-center">#</th>
              <th> ชื่อสินค้า </th>
              <th class="text-center"> จำนวน </th>
              <th class="text-center"> สถานะ </th>
              <th class="text-center"> วันที่สั่งผลิต </th>
              <th class="text-center"> การดำเนินการ </th>
            </tr>
          </thead>
          <tbody>
            <?php foreach ($all_production_orders as $order): ?>
              <?php $product = find_by_id('products', $order['product_id']); ?>
              <tr>
                <td class="text-center"><?php echo $order['id']; ?></td>
                <td><?php echo $product['name']; ?></td>
                <td class="text-center"><?php echo $order['quantity']; ?></td>
                <td class="text-center">
                  <?php echo $order['status'] == 'Pending' ? '<span class="label label-warning">รอดำเนินการ</span>' : '<span class="label label-success">เสร็จสมบูรณ์</span>'; ?>
                </td>
                <td class="text-center"><?php echo $order['created_at']; ?></td>
                <td class="text-center">
                  <!-- ลิงก์เพื่อแก้ไขหรืออัพเดตสถานะ -->
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
  </div>
</div>

<?php include_once('layouts/footer.php'); ?>
