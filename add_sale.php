<?php
require_once('includes/load.php');
require_once('includes/session.php');
require_once('includes/database.php');

// ตรวจสอบการเข้าสู่ระบบ
if (!$session->isUserLoggedIn(true)) {
  redirect('index.php', false);
}

// ดึงรายการสินค้าทั้งหมด
$products = find_all('products');

// ดึงข้อมูลบริษัทจัดส่งทั้งหมด
$companies = find_all('delivery_company');

// ดึงรายชื่อลูกค้าทั้งหมด
$customers = find_all('customers');

// เมื่อกดบันทึกการขาย
if (isset($_POST['add_sale'])) {
    $customer_id = $db->escape($_POST['customer_id']); // รับข้อมูล ID ของลูกค้า
    $product_ids = $_POST['product_ids'];
    $quantities = $_POST['quantities'];
    $prices = $_POST['prices'];
    $dates = $_POST['dates'];
    $delivery_company_ids = $_POST['delivery_company_ids'];

    for ($i = 0; $i < count($product_ids); $i++) {
        $p_id = $db->escape($product_ids[$i]);
        $quantity = $db->escape($quantities[$i]);
        $price = $db->escape($prices[$i]);
        $date = $db->escape($dates[$i]);
        $delivery_company_id = $db->escape($delivery_company_ids[$i]);

        $sql  = "INSERT INTO sales (product_id, qty, price, date, delivery_company_id, customer_id)";
        $sql .= " VALUES ('{$p_id}', '{$quantity}', '{$price}', '{$date}', '{$delivery_company_id}', '{$customer_id}')";

        if (!$db->query($sql)) {
            $session->msg('d', 'ขออภัย! ไม่สามารถเพิ่มการขายได้');
            redirect('add_sale.php', false);
        }
    }

    $session->msg('s', "เพิ่มการขายเรียบร้อยแล้ว.");
    redirect('add_sale.php', false);
}
?>

<?php include_once('layouts/header.php'); ?>

<div class="row">
  <div class="col-md-12">
    <div class="panel panel-default">
      <div class="panel-heading clearfix">
        <strong>
          <span class="glyphicon glyphicon-th"></span>
          <span>รายการสินค้าทั้งหมด</span>
        </strong>
      </div>
      <div class="panel-body">
        <form method="post" action="add_sale.php">
          <div class="form-group">
            <label for="customer_id">เลือกผู้สั่งซื้อ</label>
            <select class="form-control" name="customer_id">
              <option value="">เลือกผู้สั่งซื้อ</option>
              <?php foreach ($customers as $customer): ?>
                <option value="<?php echo $customer['id']; ?>"><?php echo $customer['name']; ?></option>
              <?php endforeach; ?>
            </select>
          </div>
          <table class="table table-bordered">
            <thead>
              <th> รายการ </th>
              <th> ราคา </th>
              <th> จำนวน </th>
              <th> ราคารวม </th>
              <th> วันที่ </th>
              <th> บริษัทจัดส่ง </th> 
              <th> ลบ </th>
            </thead>
            <tbody id="product_info">
              <!-- แสดงรายการสินค้าทั้งหมด -->
              <?php if (!empty($products)): ?>
                <?php foreach ($products as $product): ?>
                  <tr>
                    <td><?php echo $product['name']; ?></td>
                    <input type="hidden" name="product_ids[]" value="<?php echo $product['id']; ?>">
                    <td><input type="text" class="form-control" name="prices[]" value="<?php echo $product['sale_price']; ?>" readonly></td>
                    <td><input type="number" class="form-control" name="quantities[]" value="1" oninput="calculateTotal(this)"></td>
                    <td><input type="text" class="form-control total" name="totals[]" value="<?php echo $product['sale_price']; ?>" readonly></td>
                    <td><input type="date" class="form-control" name="dates[]" value="<?php echo date('Y-m-d'); ?>"></td>
                    <td>
                      <select class="form-control" name="delivery_company_ids[]">
                        <option value="">เลือกบริษัทจัดส่ง</option>
                        <?php foreach ($companies as $company): ?>
                          <option value="<?php echo $company['id']; ?>"><?php echo $company['name']; ?></option>
                        <?php endforeach; ?>
                      </select>
                    </td>
                    <td><button type="button" class="btn btn-danger remove-item">ลบ</button></td>
                  </tr>
                <?php endforeach; ?>
              <?php else: ?>
                <tr>
                  <td colspan="7">ไม่พบสินค้าในฐานข้อมูล</td>
                </tr>
              <?php endif; ?>
            </tbody>
          </table>
          <button type="submit" name="add_sale" class="btn btn-primary">บันทึกการขาย</button>
        </form>
      </div>
    </div>
  </div>
</div>

<?php include_once('layouts/footer.php'); ?>

<!-- Script สำหรับลบรายการและคำนวณราคารวม -->
<script>
$(document).ready(function() {
  // ลบรายการ
  $(document).on('click', '.remove-item', function() {
    $(this).closest('tr').remove();
    calculateGrandTotal();  // อัปเดตราคารวมใหม่หลังจากลบรายการ
  });
});

// คำนวณราคารวมเมื่อจำนวนถูกเปลี่ยน
function calculateTotal(element) {
  var row = $(element).closest('tr');
  var price = row.find('input[name="prices[]"]').val();
  var quantity = row.find('input[name="quantities[]"]').val();
  var total = price * quantity;
  row.find('input[name="totals[]"]').val(total.toFixed(2));  // คำนวณราคารวม
  calculateGrandTotal();  // อัปเดตราคารวมทั้งหมด
}

// คำนวณราคารวมทั้งหมดของรายการสินค้า
function calculateGrandTotal() {
  var grandTotal = 0;
  $('input[name="totals[]"]').each(function() {
    grandTotal += parseFloat($(this).val()) || 0;
  });
  $('#grand_total').text(grandTotal.toFixed(2));
}
</script>
