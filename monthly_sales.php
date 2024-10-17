<?php
$page_title = 'ยอดขายรายเดือน';
require_once('includes/load.php');
// ตรวจสอบระดับสิทธิ์ของผู้ใช้ในการดูหน้านี้
page_require_level(3);
?>

<?php
// ใช้ปีปัจจุบันเป็นค่าเริ่มต้น
$year = date('Y');
$month = date('m');
$sales = monthlyQuotes($year); // ปรับเป็นฟังก์ชันดึงข้อมูลจากใบเสนอราคา
?>

<?php include_once('layouts/header.php'); ?>
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
          <span>ยอดขายรายเดือน</span>
        </strong>
      </div>
      <div class="panel-body">
        <table class="table table-bordered table-striped">
          <thead>
            <tr>
              <th class="text-center" style="width: 50px;">#</th>
              <th> ชื่อสินค้า </th>
              <th class="text-center" style="width: 15%;"> จำนวนที่ขายได้</th>
              <th class="text-center" style="width: 15%;"> ราคารวม </th>
              <th class="text-center" style="width: 15%;"> วันที่ </th> <!-- ปรับส่วนหัวตาราง -->
            </tr>
          </thead>
          <tbody>
            <?php foreach ($sales as $sale): ?>
              <tr>
                <td class="text-center"><?php echo count_id(); ?></td>
                <td><?php echo remove_junk($sale['name']); ?></td>
                <td class="text-center"><?php echo (int)$sale['qty']; ?></td>
                <td class="text-center"><?php echo number_format($sale['total'], 2); ?></td>
                <td class="text-center"><?php echo read_date($sale['sale_date']); ?></td> <!-- ใช้ฟังก์ชัน read_date -->
              </tr>
            <?php endforeach; ?>
          </tbody>
        </table>
      </div>
    </div>
  </div>
</div>

<?php include_once('layouts/footer.php'); ?>
