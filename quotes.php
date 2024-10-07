<?php
$page_title = 'ใบเสนอราคา';
require_once('includes/load.php');
page_require_level(2);

$all_quotes = find_all('quotes'); // ดึงข้อมูลใบเสนอราคาทั้งหมด

include_once('layouts/header.php');
?>

<div class="row">
    <div class="col-md-12">
        <div class="panel panel-default">
            <div class="panel-heading">
                <strong>รายการใบเสนอราคา</strong>
            </div>
            <div class="panel-body">
                <table class="table">
                    <thead class="custom-bg">
                        <tr>
                            <th>#</th>
                            <th>ชื่อลูกค้า</th>
                            <th>วันที่</th>
                            <th>จำนวนเงินรวมทั้งสิ้น</th>
                            <th>การดำเนินการ</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($all_quotes as $quote): ?>
                            <tr>
                                <td><?php echo $quote['id']; ?></td>
                                <td><?php echo find_by_id('customers', $quote['customer_id'])['name']; ?></td>
                                <td><?php echo $quote['sale_date']; ?></td>
                                <td><?php echo $quote['total']; ?></td>
                                <td>
                                    <a href="view_quote.php?id=<?php echo $quote['id']; ?>" class="btn btn-primary">ดู</a>
                                    <a href="delete_quote.php?id=<?php echo $quote['id']; ?>" class="btn btn-danger" onclick="return confirm('คุณแน่ใจหรือว่าต้องการลบใบเสนอราคานี้?');">ลบ</a>
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
