<?php
$page_title = 'รายงานการขาย';
$results = '';
require_once('includes/load.php');
require_once('includes/session.php');
require_once('includes/database.php');
// ตรวจสอบระดับสิทธิ์ของผู้ใช้ในการดูหน้านี้
page_require_level(3);
?>
<?php
if (isset($_POST['submit'])) {
  $req_dates = array('start-date', 'end-date');
  validate_fields($req_dates);

  if (empty($errors)):
    $start_date   = remove_junk($db->escape($_POST['start-date']));
    $end_date     = remove_junk($db->escape($_POST['end-date']));
    
    // แก้ไข query ให้ดึงข้อมูลจากตาราง quotes
    $sql = "SELECT * FROM quotes WHERE sale_date BETWEEN '{$start_date}' AND '{$end_date}'";
    $results = $db->query($sql);
    
  else:
    $session->msg("d", $errors);
    redirect('sales_report.php', false);
  endif;
} else {
  $session->msg("d", "กรุณาเลือกวันที่");
  redirect('sales_report.php', false);
}
?>
<!doctype html>
<html lang="th">

<head>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
  <title>รายงานการขาย</title>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css" />
  <style>
    @media print {
      html, body { font-size: 9.5pt; margin: 0; padding: 0; }
      .page-break { page-break-before: always; width: auto; margin: auto; }
      .no-print { display: none; }
    }

    .page-break { width: 980px; margin: 0 auto; }
    .sale-head { margin: 40px 0; text-align: center; }
    .sale-head h1, .sale-head strong { padding: 10px 20px; display: block; }
    .sale-head h1 { margin: 0; border-bottom: 1px solid #212121; }
    .table>thead:first-child>tr:first-child>th { border-top: 1px solid #000; }
    table thead tr th { text-align: center; border: 1px solid #ededed; }
    table tbody tr td { vertical-align: middle; }
    .sale-head, table.table thead tr th, table tbody tr td, table tfoot tr td { border: 1px solid #212121; white-space: nowrap; }
    .sale-head h1, table thead tr th, table tfoot tr td { background-color: #f8f8f8; }
    tfoot { color: #000; text-transform: uppercase; font-weight: 500; }
  </style>
</head>

<body>
  <?php if ($results && $results->num_rows > 0): ?>
    <div class="page-break">
      <div class="sale-head">
        <h1>รายงานการขาย</h1>
        <strong><?php if (isset($start_date)) echo $start_date; ?> ถึงวันที่ <?php if (isset($end_date)) echo $end_date; ?></strong>
      </div>
      <table class="table table-border">
        <thead>
          <tr>
            <th>วันที่</th>
            <th>ชื่อพนักงานขาย</th>
            <th>ยอดรวมก่อนหักส่วนลด</th>
            <th>ส่วนลด %</th>
            <th>ยอดรวมทั้งหมด</th>
          </tr>
        </thead>
        <tbody>
          <?php while ($result = $results->fetch_assoc()): ?>
            <tr>
              <td><?php echo remove_junk($result['sale_date']); ?></td>
              <td><?php echo remove_junk(ucfirst($result['salesperson'])); ?></td>
              <td class="text-right">฿<?php echo number_format($result['subtotal'], 2); ?></td>
              <td class="text-right"><?php echo number_format($result['discount'], ); ?></td>
              <td class="text-right">฿<?php echo number_format($result['total'], 2); ?></td>
            </tr>
          <?php endwhile; ?>
        </tbody>
        <tfoot>
          <!-- รวมยอดทั้งหมด, คำนวณภาษี ฯลฯ -->
        </tfoot>
      </table>
      <div class="text-center no-print">
        <button onclick="window.print();" class="btn btn-primary">พิมพ์รายงาน</button>
      </div>
    </div>
  <?php else: ?>
    <?php
    $session->msg("d", "ขออภัย ไม่พบข้อมูลการขายในช่วงวันที่ที่เลือก");
    redirect('sales_report.php', false);
    ?>
  <?php endif; ?>
</body>

</html>
<?php if (isset($db)) { $db->db_disconnect(); } ?>
