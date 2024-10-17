<?php
$page_title = 'หน้าหลักผู้ดูแลระบบ';
require_once('includes/load.php');
page_require_level(1);

// นับจำนวนหมวดหมู่, สินค้า, ยอดขาย และผู้ใช้ในระบบ
$c_categorie     = count_by_id('categories');
$c_product       = count_by_id('products');
$c_sale          = count_by_id('quotes');
$c_user          = count_by_id('users');


$products_sold   = find_higest_saleing_product('10');
$recent_products = find_recent_product_added('5');
$recent_sales    = find_recent_sale_added('5');

// ดึงข้อมูลยอดขายสำหรับกราฟยอดขายรายเดือนและรายปี
$sales_data_month = get_sales_data('monthly');
$sales_data_year = get_sales_data('yearly');
?>
<?php include_once('layouts/header.php'); ?>

<div class="row">
  <div class="col-md-6">
    <?php echo display_msg($msg); ?>
  </div>
</div>

<!-- แสดงจำนวนผู้ใช้, หมวดหมู่, สินค้า, และยอดขาย -->
<div class="row">
  <!-- บล็อกแสดงจำนวนผู้ใช้ -->
  <a href="users.php" style="color:black;">
    <div class="col-md-3">
      <div class="panel panel-box clearfix">
        <div class="panel-icon pull-left bg-secondary1">
          <i class="glyphicon glyphicon-user"></i>
        </div>
        <div class="panel-value pull-right">
          <h2 class="margin-top"> <?php echo $c_user['total']; ?> </h2>
          <p class="text-muted">ผู้ใช้</p>
        </div>
      </div>
    </div>
  </a>

  <a href="categorie.php" style="color:black;">
    <div class="col-md-3">
      <div class="panel panel-box clearfix">
        <div class="panel-icon pull-left bg-red">
          <i class="glyphicon glyphicon-th-large"></i>
        </div>
        <div class="panel-value pull-right">
          <h2 class="margin-top"> <?php echo $c_categorie['total']; ?> </h2>
          <p class="text-muted">หมวดหมู่</p>
        </div>
      </div>
    </div>
  </a>

  <a href="product.php" style="color:black;">
    <div class="col-md-3">
      <div class="panel panel-box clearfix">
        <div class="panel-icon pull-left bg-blue2">
          <i class="glyphicon glyphicon-shopping-cart"></i>
        </div>
        <div class="panel-value pull-right">
          <h2 class="margin-top"> <?php echo $c_product['total']; ?> </h2>
          <p class="text-muted">สินค้า</p>
        </div>
      </div>
    </div>
  </a>

  <a href="sales.php" style="color:black;">
    <div class="col-md-3">
      <div class="panel panel-box clearfix">
        <div class="panel-icon pull-left bg-green">
          <i class="glyphicon glyphicon-usd"></i>
        </div>
        <div class="panel-value pull-right">
          <h2 class="margin-top"> <?php echo $c_sale['total']; ?></h2>
          <p class="text-muted">ยอดขายรวม</p>
        </div>
      </div>
    </div>
  </a>
</div>

<!-- กราฟแสดงยอดขายรายเดือนและรายปี -->
<div class="row">
  <div class="col-md-6">
    <div class="panel panel-default">
      <div class="panel-heading">
        <strong>
          <span class="glyphicon glyphicon-th"></span>
          <span>กราฟยอดขายรายเดือน</span>
        </strong>
      </div>
      <div class="panel-body">
        <canvas id="monthlySalesChart" style="max-height: 400px;"></canvas>
      </div>
    </div>
  </div>

  <!-- กราฟแสดงยอดขายรายปี -->
  <div class="col-md-6">
    <div class="panel panel-default">
      <div class="panel-heading">
        <strong>
          <span class="glyphicon glyphicon-th"></span>
          <span>กราฟยอดขายรายปี</span>
        </strong>
      </div>
      <div class="panel-body">
        <canvas id="yearlySalesChart" style="max-height: 400px;"></canvas>
      </div>
    </div>
  </div>
</div>

<div class="row">
  <!-- สินค้าขายดี -->
  <div class="col-md-4">
    <div class="panel panel-default">
      <div class="panel-heading">
        <strong>
          <span class="glyphicon glyphicon-th"></span>
          <span>สินค้าผลิตมากที่สุด</span>
        </strong>
      </div>
      <div class="panel-body">
        <table class="table table-striped table-bordered table-condensed">
          <thead>
            <tr>
              <th>ชื่อสินค้า</th>
              <th>จำนวนครั้งที่ผลิต</th>
              <th>จำนวนรวมที่ผลิต</th>
            </tr>
          </thead>
          <tbody>
            <!-- ดึงข้อมูลสินค้าที่ถูกสั่งผลิตมากที่สุด -->
            <?php
            $top_produced_products = find_top_produced_products('10'); // ฟังก์ชันใหม่สำหรับดึงสินค้าที่ถูกผลิตมากที่สุด
            foreach ($top_produced_products as $product): ?>
              <tr>
                <td><?php echo remove_junk(first_character($product['name'])); ?></td>
                <td><?php echo (int)$product['production_count']; ?></td> <!-- จำนวนครั้งที่ถูกผลิต -->
                <td><?php echo (int)$product['total_production_quantity']; ?></td> <!-- จำนวนรวมที่ถูกผลิต -->
              </tr>
            <?php endforeach; ?>
          </tbody>
        </table>
      </div>
    </div>
  </div>

  <!-- ยอดขายล่าสุด -->
  <div class="col-md-4">
    <div class="panel panel-default">
      <div class="panel-heading">
        <strong>
          <span class="glyphicon glyphicon-th"></span>
          <span>การสั่งผลิตล่าสุด</span>
        </strong>
      </div>
      <div class="panel-body">
        <table class="table table-striped table-bordered table-condensed">
          <thead>
            <tr>
              <th class="text-center" style="width: 50px;">#</th>
              <th class="text-center" style="width: 120px;">ชื่อสินค้า</th>
              <th class="text-center" style="width: 50px;">วันที่สั่งผลิต</th>
              <th class="text-center" style="width: 85px;">จำนวน</th>
            </tr>
          </thead>
          <tbody>
            <!-- ดึงข้อมูลการสั่งผลิตล่าสุด -->
            <?php
            // แทนที่ $recent_sales ด้วยการดึงข้อมูลจาก production_orders
            $recent_production_orders = find_recent_production_orders('5'); // ฟังก์ชันใหม่สำหรับดึงข้อมูลการสั่งผลิตล่าสุด
            foreach ($recent_production_orders as $production_order) : ?>
              <tr>
                <td class="text-center"><?php echo count_id(); ?></td>
                <td>
                  <a href="edit_production_order.php?id=<?php echo (int)$production_order['id']; ?>">
                    <?php echo remove_junk(first_character(find_by_id('products', $production_order['product_id'])['name'])); ?>
                  </a>
                </td>
                <td class="text-center"><?php echo remove_junk($production_order['created_at']); ?></td>
                <td class="text-center"><?php echo number_format((int)$production_order['quantity']); ?></td>
              </tr>
            <?php endforeach; ?>
          </tbody>
        </table>
      </div>
    </div>
  </div>


  <!-- สินค้าที่เพิ่มล่าสุด -->
  <div class="col-md-4">
    <div class="panel panel-default">
      <div class="panel-heading">
        <strong>
          <span class="glyphicon glyphicon-th"></span>
          <span>สินค้าที่เพิ่มล่าสุด</span>
        </strong>
      </div>
      <div class="panel-body">
        <div class="list-group">
          <!-- แสดงสินค้าที่เพิ่มล่าสุด 5 รายการ -->
          <?php foreach ($recent_products as  $recent_product) : ?>
            <a class="list-group-item clearfix" href="edit_product.php?id=<?php echo    (int)$recent_product['id']; ?>">
              <h4 class="list-group-item-heading">
                <!-- แสดงรูปภาพของสินค้า -->
                <?php if ($recent_product['media_id'] === '0') : ?>
                  <img class="img-avatar img-circle" src="uploads/products/no_image.png" alt="">
                <?php else : ?>
                  <img class="img-avatar img-circle" src="uploads/products/<?php echo $recent_product['image']; ?>" alt="" />
                <?php endif; ?>
                <!-- แสดงชื่อสินค้าและราคาสินค้า -->
                <?php echo remove_junk(first_character($recent_product['name'])); ?>
                <span class="label label-warning pull-right">
                  ฿<?php echo (int)$recent_product['sale_price']; ?>
                </span>
              </h4>
              <span class="list-group-item-text pull-right">
                <?php echo remove_junk(first_character($recent_product['categorie'])); ?>
              </span>
            </a>
          <?php endforeach; ?>
        </div>
      </div>
    </div>
  </div>
</div>

<!-- แสดงกราฟยอดขายรายเดือนและรายปี -->
<div class="row">
</div>

<?php include_once('layouts/footer.php'); ?>

<!-- สร้างกราฟยอดขายรายเดือนและรายปีด้วย Chart.js -->
<script>
  const monthlySalesData = <?php echo json_encode($sales_data_month); ?>;
  const yearlySalesData = <?php echo json_encode($sales_data_year); ?>;

  const ctxMonthly = document.getElementById('monthlySalesChart').getContext('2d');
  const ctxYearly = document.getElementById('yearlySalesChart').getContext('2d');

  // แปลงตัวเลขเดือนเป็นชื่อเดือนภาษาไทย
  const monthNames = ["มกราคม", "กุมภาพันธ์", "มีนาคม", "เมษายน", "พฤษภาคม", "มิถุนายน", "กรกฎาคม", "สิงหาคม", "กันยายน", "ตุลาคม", "พฤศจิกายน", "ธันวาคม"];
  monthlySalesData.labels = monthlySalesData.labels.map(month => monthNames[month - 1]);

  // สร้างกราฟยอดขายรายเดือน
  let monthlySalesChart = new Chart(ctxMonthly, {
    type: 'bar',
    data: {
      labels: monthlySalesData.labels,
      datasets: [{
        label: 'ยอดขายรายเดือน',
        data: monthlySalesData.data,
        backgroundColor: 'rgba(75, 192, 192, 0.2)',
        borderColor: 'rgba(75, 192, 192, 1)',
        borderWidth: 1
      }]
    },
    options: {
      scales: {
        y: {
          beginAtZero: true
        }
      }
    }
  });

  // สร้างกราฟยอดขายรายปี
  let yearlySalesChart = new Chart(ctxYearly, {
    type: 'bar',
    data: {
      labels: yearlySalesData.labels,
      datasets: [{
        label: 'ยอดขายรายปี',
        data: yearlySalesData.data,
        backgroundColor: 'rgba(153, 102, 255, 0.2)',
        borderColor: 'rgba(153, 102, 255, 1)',
        borderWidth: 1
      }]
    },
    options: {
      scales: {
        y: {
          beginAtZero: true
        }
      }
    }
  });
</script>