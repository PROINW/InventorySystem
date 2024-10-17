<?php
$page_title = 'สั่งผลิตสินค้าจากใบเสนอราคา';
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
          <span>สั่งผลิตจากใบเสนอราคา</span>
        </strong>
      </div>
      <div class="panel-body">
        <table class="table">
          <thead class="custom-bg">
            <tr>
              <th class="text-center">#</th>
              <th> ชื่อลูกค้า </th>
              <th class="text-center"> จำนวนสินค้าทั้งหมด </th>
              <th class="text-center"> ราคารวม </th>
              <th class="text-center"> วันที่เสนอราคา </th>
              <th class="text-center"> การดำเนินการ </th>
            </tr>
          </thead>
          <tbody>
            <?php foreach ($all_quotes as $quote): ?>
              <tr>
                <td class="text-center"><?php echo $quote['id']; ?></td>
                <td><?php echo find_by_id('customers', $quote['customer_id'])['name']; ?></td>

                <!-- แสดงจำนวนสินค้าทั้งหมด -->
                <td class="text-center">
                  <?php
                  $quote_items = find_all_where('quote_items', 'quote_id', $quote['id']);
                  $total_quantity = 0;
                  foreach ($quote_items as $item):
                    $total_quantity += $item['quantity'];
                  endforeach;
                  echo number_format($total_quantity);
                  ?>
                </td>

                <td class="text-center"><?php echo number_format($quote['total'], 2); ?></td> <!-- ราคารวมทั้งสิ้น -->
                <td class="text-center"><?php echo $quote['sale_date']; ?></td> <!-- วันที่เสนอราคา -->

                <td class="text-center">
                  <!-- ปุ่มดูใบเสนอราคา -->
                  <a href="view_quote.php?id=<?php echo $quote['id']; ?>" class="btn btn-success" title="ดูใบเสนอราคา" data-toggle="tooltip">
                    <span class="glyphicon glyphicon-eye-open"></span> ดูใบเสนอราคา
                  </a>
                  <!-- ลิงก์เพื่อเริ่มการผลิตจากใบเสนอราคา -->
                  <a href="start_production.php?id=<?php echo $quote['id']; ?>" class="btn btn-warning" title="สั่งผลิต" data-toggle="tooltip">
                    <span class="glyphicon glyphicon-cog"></span> สั่งผลิต
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
