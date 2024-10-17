<?php
$page_title = 'ยอดขายรายวัน';
require_once('includes/load.php');
// ตรวจสอบระดับสิทธิ์ของผู้ใช้ในการดูหน้านี้
page_require_level(3);
?>

<?php
// ดึงข้อมูลใบเสนอราคาตามปีและเดือนปัจจุบัน
$year  = date('Y');
$month = date('m');

// ฟังก์ชันเพื่อดึงข้อมูลใบเสนอราคาและคำนวณราคารวมของแต่ละสินค้า
$sales = find_by_sql("SELECT q.id, q.sale_date, p.name, qi.quantity, (qi.quantity * qi.price) AS total 
                      FROM quotes q
                      LEFT JOIN quote_items qi ON q.id = qi.quote_id
                      LEFT JOIN products p ON qi.product_id = p.id
                      WHERE YEAR(q.sale_date) = '{$year}' AND MONTH(q.sale_date) = '{$month}'");
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
          <span>ยอดขายรายวัน</span>
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
              <th class="text-center" style="width: 15%;"> วันที่ </th>
            </tr>
          </thead>
          <tbody>
            <?php foreach ($sales as $sale): ?>
              <tr>
                <td class="text-center"><?php echo count_id(); ?></td>
                <td><?php echo remove_junk($sale['name']); ?></td>
                <td class="text-center"><?php echo (int)$sale['quantity']; ?></td>
                <td class="text-center"><?php echo number_format($sale['total'], 2); ?></td> <!-- ราคารวมของแต่ละรายการสินค้า -->
                <td class="text-center"><?php echo read_date($sale['sale_date']); ?></td>
              </tr>
            <?php endforeach; ?>
          </tbody>
        </table>
      </div>
    </div>
  </div>
</div>

<?php include_once('layouts/footer.php'); ?>
