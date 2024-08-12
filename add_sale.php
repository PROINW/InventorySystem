<?php
  $page_title = 'เพิ่มการขาย';
  require_once('includes/load.php');
  require_once('includes/session.php');
  require_once('includes/database.php');
  // ตรวจสอบระดับสิทธิ์ของผู้ใช้ในการดูหน้านี้
  page_require_level(3);

  // ดึงข้อมูลบริษัทจัดส่งทั้งหมด
  $all_companies = find_all('delivery_company');
?>
<?php

  if(isset($_POST['add_sale'])){
    $req_fields = array('s_id', 'quantity', 'price', 'total', 'date', 'delivery_company_id');
    validate_fields($req_fields);
    if(empty($errors)){
      $p_id      = $db->escape((int)$_POST['s_id']);
      $s_qty     = $db->escape((int)$_POST['quantity']);
      $s_total   = $db->escape($_POST['total']);
      $date      = $db->escape($_POST['date']);
      $company_id = $db->escape((int)$_POST['delivery_company_id']); // รับค่าบริษัทจัดส่ง

      $sql  = "INSERT INTO sales (product_id, qty, price, date, delivery_company_id)";
      $sql .= " VALUES ('{$p_id}', '{$s_qty}', '{$s_total}', '{$date}', '{$company_id}')"; // ใช้ค่า $date และ $company_id

      if($db->query($sql)){
        update_product_qty($s_qty, $p_id);
        $session->msg('s', "เพิ่มการขายเรียบร้อยแล้ว.");
        redirect('add_sale.php', false);
      } else {
        $session->msg('d', 'ขออภัย! ไม่สามารถเพิ่มการขายได้');
        redirect('add_sale.php', false);
      }
    } else {
      $session->msg("d", $errors);
      redirect('add_sale.php', false);
    }
  }

?>
<?php include_once('layouts/header.php'); ?>
<div class="row">
  <div class="col-md-6">
    <?php echo display_msg($msg); ?>
    <form method="post" action="ajax.php" autocomplete="off" id="sug-form">
      <div class="form-group">
        <div class="input-group">
          <span class="input-group-btn">
            <button type="submit" class="btn btn-primary">ค้นหา</button>
          </span>
          <input type="text" id="sug_input" class="form-control" name="title" placeholder="ค้นหาชื่อสินค้า">
        </div>
        <div id="result" class="list-group"></div>
      </div>
    </form>
  </div>
</div>
<div class="row">
  <div class="col-md-12">
    <div class="panel panel-default">
      <div class="panel-heading clearfix">
        <strong>
          <span class="glyphicon glyphicon-th"></span>
          <span>แก้ไขการขาย</span>
        </strong>
      </div>
      <div class="panel-body">
        <form method="post" action="add_sale.php">
          <table class="table table-bordered">
            <thead>
              <th> รายการ </th>
              <th> ราคา </th>
              <th> จำนวน </th>
              <th> ราคารวม </th>
              <th> วันที่ </th>
              <th> บริษัทจัดส่ง </th> 
              <th> แก้ไข </th>
            </thead>
            <tbody id="product_info">
              <tr>
                <!-- ช่องที่จะแสดงผลเมื่อมีการค้นหาสินค้า -->
              </tr>
            </tbody>
          </table>
        </form>
      </div>
    </div>
  </div>
</div>

<?php include_once('layouts/footer.php'); ?>

<!-- Script สำหรับการค้นหาและการเลือกสินค้า -->
<script>
  // $(document).ready(function(){
  //   $('#sug_input').keyup(function(){
  //     var query = $(this).val();
  //     if(query != '')
  //     {
  //       $.ajax({
  //         url:"fetch.php",
  //         method:"POST",
  //         data:{query:query},
  //         success:function(data)
  //         {
  //           $('#result').fadeIn();
  //           $('#result').html(data);
  //         }
  //       });
  //     }
  //   });

  //   $(document).on('click', 'li', function(){
  //     $('#sug_input').val($(this).text());
  //     $('#result').fadeOut();
  //   });

  //   // เมื่อมีการเลือกสินค้าแล้ว ดึงข้อมูลมาแสดงในฟอร์มการขาย
  //   $(document).on('click', '.list-group-item', function(){
  //     var product_name = $(this).text();
  //     $.ajax({
  //       url: 'ajax.php',
  //       method: 'POST',
  //       data: { p_name: product_name },
  //       success: function(response){
  //         $('#product_info').html(response);
  //       }
  //     });
  //   });
  // });
</script>
