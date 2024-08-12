<?php
  $page_title = 'สินค้าทั้งหมด';
  require_once('includes/load.php');
  // ตรวจสอบระดับสิทธิ์ของผู้ใช้ในการดูหน้านี้
  page_require_level(2);

  // ใช้ฟังก์ชันจากไฟล์ sql.php
  if(isset($_GET['search'])){
    $search_term = $_GET['search'];
    $products = search_product_table($search_term);
  } else {
    $products = join_product_table();
  }
?>

<?php include_once('layouts/header.php'); ?>
  <div class="row">
     <div class="col-md-12">
       <?php echo display_msg($msg); ?>
     </div>
    <div class="col-md-12">
      <div class="panel panel-default">
        <div class="panel-heading clearfix">
          <div class="pull-right">
            <form action="product.php" method="GET" class="form-inline">
              <div class="form-group">
                <input type="text" name="search" class="form-control" placeholder="ค้นหาสินค้า...">
              </div>
              <button type="submit" class="btn btn-primary btn- ">ค้นหา</button>
            </form>
            <!-- <a href="add_product.php" class="btn btn-primary">เพิ่มสินค้าใหม่</a> -->
          </div>
        </div>
        <div class="panel-body">
          <table class="table table-bordered">
            <thead>
              <tr>
                <th class="text-center" style="width: 50px;">#</th>
                <th> รูปภาพ</th>
                <th> ชื่อสินค้า </th>
                <th class="text-center" style="width: 10%;"> หมวดหมู่ </th>
                <th class="text-center" style="width: 10%;"> คงคลัง </th>
                <th class="text-center" style="width: 10%;"> ราคาต้นทุน </th>
                <th class="text-center" style="width: 10%;"> ราคาขาย </th>
                <th class="text-center" style="width: 10%;"> วันที่เพิ่มสินค้า </th>
                <th class="text-center" style="width: 100px;"> แก้ไข </th>
              </tr>
            </thead>
            <tbody>
              <?php foreach ($products as $product):?>
              <tr>
                <td class="text-center"><?php echo count_id();?></td>
                <td>
                  <?php if($product['media_id'] === '0'): ?>
                    <img class="img-avatar img-circle" src="uploads/products/no_image.png" alt="">
                  <?php else: ?>
                    <img class="img-avatar img-circle" src="uploads/products/<?php echo $product['image']; ?>" alt="">
                  <?php endif; ?>
                </td>
                <td> <?php echo remove_junk($product['name']); ?></td>
                <td class="text-center"> <?php echo remove_junk($product['categorie']); ?></td>
                <td class="text-center"> <?php echo remove_junk($product['quantity']); ?></td>
                <td class="text-center"> <?php echo remove_junk($product['buy_price']); ?></td>
                <td class="text-center"> <?php echo remove_junk($product['sale_price']); ?></td>
                <td class="text-center"> <?php echo read_date($product['date']); ?></td>
                <td class="text-center">
                  <div class="btn-group">
                    <a href="edit_product.php?id=<?php echo (int)$product['id'];?>" class="btn btn-info btn-sm"  title="แก้ไข" data-toggle="tooltip">
                      <span class="glyphicon glyphicon-edit"></span>
                    </a>
                    <a href="delete_product.php?id=<?php echo (int)$product['id'];?>" class="btn btn-danger btn-sm"  title="ลบ" data-toggle="tooltip">
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
