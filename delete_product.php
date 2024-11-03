<?php
  require_once('includes/load.php');
  require_once('includes/session.php');
  // Checkin What level user has permission to view this page
  page_require_level(2);
?>
<?php
  $product = find_by_id('products',(int)$_GET['id']);
  if(!$product){
    $session->msg("d","Missing Product id.");
    redirect('product.php');
  }
?>
<?php
  $delete_id = delete_by_id('products',(int)$product['id']);
  if($delete_id){
      $session->msg("s","ลบรายการสินค้าแล้ว.");
      redirect('product.php');
  } else {
      $session->msg("d","การลบรายการสินค้าล้มเหลว");
      redirect('product.php');
  }
?>
