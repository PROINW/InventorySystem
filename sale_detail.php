<?php
require_once('includes/load.php');
require_once('includes/session.php');
require_once('includes/database.php');

// ตรวจสอบการเข้าสู่ระบบ
if (!$session->isUserLoggedIn(true)) {
  redirect('index.php', false);
}

// ตรวจสอบว่ามีการส่งค่า ID หรือไม่
$sale_id = isset($_GET['id']) ? (int)$_GET['id'] : 0;
$sale = find_by_id('sales', $sale_id);

// ดึงข้อมูลสินค้าทั้งหมด
$products = find_all('products');

// ดึงข้อมูลบริษัทจัดส่งทั้งหมด
$companies = find_all('delivery_company');

// เมื่อกดบันทึกการแก้ไข
if (isset($_POST['update_sale'])) {
    $product_id = $_POST['product_id'];
    $quantity = $_POST['quantity'];
    $price = $_POST['price'];
    $date = $_POST['date'];
    $status = $_POST['status'];
    $delivery_company_id = $_POST['delivery_company_id'];

    $sql = "UPDATE sales SET ";
    $sql .= "product_id='{$product_id}', qty='{$quantity}', price='{$price}', date='{$date}', ";
    $sql .= "delivery_company_id='{$delivery_company_id}', status='{$status}' ";
    $sql .= "WHERE id='{$sale_id}'";

    if ($db->query($sql)) {
        $session->msg('s', 'อัปเดตรายการขายสำเร็จ');
        redirect("sale_detail.php?id={$sale_id}", false);
    } else {
        $session->msg('d', 'ขออภัย! ไม่สามารถอัปเดตรายการขายได้');
        redirect("sale_detail.php?id={$sale_id}", false);
    }
}
?>

<?php include_once('layouts/header.php'); ?>

<div class="row">
  <div class="col-md-6">
    <div class="panel panel-default">
      <div class="panel-heading">
        <strong>
          <span class="glyphicon glyphicon-th"></span>
          <span>แก้ไขรายการขาย</span>
        </strong>
      </div>
      <div class="panel-body">
        <form method="post" action="sale_detail.php?id=<?php echo $sale_id; ?>">
          <div class="form-group">
            <label for="product_id">สินค้า</label>
            <select class="form-control" name="product_id">
              <?php foreach ($products as $product): ?>
                <option value="<?php echo $product['id']; ?>" <?php if($product['id'] == $sale['product_id']) echo 'selected'; ?>>
                  <?php echo $product['name']; ?>
                </option>
              <?php endforeach; ?>
            </select>
          </div>
          <div class="form-group">
            <label for="quantity">จำนวน</label>
            <input type="number" class="form-control" name="quantity" value="<?php echo $sale['qty']; ?>">
          </div>
          <div class="form-group">
            <label for="price">ราคา</label>
            <input type="text" class="form-control" name="price" value="<?php echo $sale['price']; ?>">
          </div>
          <div class="form-group">
            <label for="date">วันที่ขาย</label>
            <input type="date" class="form-control" name="date" value="<?php echo $sale['date']; ?>">
          </div>
          <div class="form-group">
            <label for="status">สถานะ</label>
            <input type="text" class="form-control" name="status" value="<?php echo $sale['status']; ?>">
          </div>
          <div class="form-group">
            <label for="delivery_company_id">บริษัทจัดส่ง</label>
            <select class="form-control" name="delivery_company_id">
              <?php foreach ($companies as $company): ?>
                <option value="<?php echo $company['id']; ?>" <?php if($company['id'] == $sale['delivery_company_id']) echo 'selected'; ?>>
                  <?php echo $company['name']; ?>
                </option>
              <?php endforeach; ?>
            </select>
          </div>
          <button type="submit" name="update_sale" class="btn btn-primary">บันทึกการแก้ไข</button>
        </form>
      </div>
    </div>
  </div>
</div>

<?php include_once('layouts/footer.php'); ?>
