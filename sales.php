<?php
$page_title = 'รายการขายทั้งหมด';
require_once('includes/load.php');
// ตรวจสอบระดับสิทธิ์ของผู้ใช้ในการดูหน้านี้
page_require_level(3);
?>
<?php
$sales = find_all_sale();
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
          <span>รายการขายทั้งหมด</span>
        </strong>
        <div class="pull-right">
          <a href="add_sale.php" class="btn btn-primary">เพิ่มการขาย</a>
        </div>
      </div>
      <div class="panel-body">
        <table class="table table-bordered table-striped">
          <thead>
            <tr>
              <th class="text-center" style="width: 50px;">#</th>
              <th> ชื่อสินค้า </th>
              <th class="text-center" style="width: 15%;"> จำนวน</th>
              <th class="text-center" style="width: 15%;"> ราคารวม </th>
              <th class="text-center" style="width: 15%;"> วันที่ </th>
              <th class="text-center" style="width: 15%;"> สถานะ </th>
              <th class="text-center" style="width: 15%;"> บริษัทจัดส่ง </th> <!-- เพิ่มคอลัมน์บริษัทจัดส่ง -->
              <th class="text-center" style="width: 100px;"> แก้ไข </th>
            </tr>
          </thead>
          <tbody>
            <?php foreach ($sales as $sale): ?>
            <tr>
              <td class="text-center"><?php echo count_id(); ?></td>
              <td><?php echo remove_junk($sale['name']); ?></td>
              <td class="text-center"><?php echo (int)$sale['qty']; ?></td>
              <td class="text-center"><?php echo remove_junk($sale['price']); ?></td>
              <td class="text-center"><?php echo $sale['date']; ?></td>
              <td class="text-center">
                <?php 
                  if ($sale['status'] === 'Completed') {
                    echo '<span class="custon-label label-success">เสร็จสมบูรณ์</span>';
                  } elseif ($sale['status'] === 'Pending') {
                    echo '<span class="custon-label label-warning">รอดำเนินการ</span>';
                  } elseif ($sale['status'] === 'Refunded') {
                    echo '<span class="custon-label label-danger">ยกเลิก</span>';
                  } else {
                    echo '<span class="label label-default">ไม่ทราบสถานะ</span>';
                  }
                ?>
              </td>
              <td class="text-center"><?php echo remove_junk($sale['delivery_company']); ?></td> <!-- แสดงบริษัทจัดส่ง -->
              <td class="text-center">
                <div class="btn-group">
                  <a href="edit_sale.php?id=<?php echo (int)$sale['id']; ?>" class="btn btn-warning btn-sm" title="แก้ไข" data-toggle="tooltip">
                    <span class="glyphicon glyphicon-edit"></span>
                  </a>
                  <a href="delete_sale.php?id=<?php echo (int)$sale['id']; ?>" class="btn btn-danger btn-sm" title="ลบ" data-toggle="tooltip">
                    <span class="glyphicon glyphicon-trash"></span>
                  </a>
                </div>
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
