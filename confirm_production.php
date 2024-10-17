<?php
require_once('includes/load.php');
// ตรวจสอบระดับสิทธิ์ของผู้ใช้ในการดูหน้านี้
page_require_level(2);

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  $quote_id = $_POST['quote_id'];

  // ดึงข้อมูลสินค้าจากใบเสนอราคา
  $quote_items = find_all_where('quote_items', 'quote_id', $quote_id);

  // บันทึกการสั่งผลิตลงในฐานข้อมูล
  foreach ($quote_items as $item) {
    $sql  = "INSERT INTO production_orders (product_id, quantity, status, quote_id) ";
    $sql .= "VALUES ('{$item['product_id']}', '{$item['quantity']}', 'Pending', '{$quote_id}')";
    $result = $db->query($sql);
    if ($result) {
      $session->msg('s', "สั่งผลิตสินค้าเรียบร้อยแล้ว");
    } else {
      $session->msg('d', "เกิดข้อผิดพลาดในการสั่งผลิตสินค้า");
    }
  }

  redirect('production_orders_by_quote.php', false); // ส่งผู้ใช้ไปยังหน้ารายการสั่งผลิต
} else {
  redirect('quotes.php', false);
}
