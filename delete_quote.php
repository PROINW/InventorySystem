<?php
require_once('includes/load.php');
page_require_level(2);

if(isset($_GET['id'])){
    $quote_id = (int)$_GET['id'];
    $delete_quote = "DELETE FROM quotes WHERE id='{$quote_id}'";
    
    // ลบสินค้าที่อยู่ในใบเสนอราคานั้นด้วย
    $delete_quote_items = "DELETE FROM quote_items WHERE quote_id='{$quote_id}'";
    
    if($db->query($delete_quote) && $db->query($delete_quote_items)){
        $session->msg("s", "ลบใบเสนอราคาเรียบร้อยแล้ว.");
    } else {
        $session->msg("d", "ลบใบเสนอราคาไม่สำเร็จ.");
    }
    redirect('quotes.php', false);
} else {
    $session->msg("d", "Missing quote id.");
    redirect('quotes.php', false);
}
