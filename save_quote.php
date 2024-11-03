<?php
require_once('includes/load.php');
page_require_level(2);

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    error_log('Post Data: ' . print_r($_POST, true));  // Log ข้อมูลเพื่อการตรวจสอบ

    // รับค่าจากฟอร์ม
    $client_name = $db->escape($_POST['customer_name']);
    $client_details = $db->escape($_POST['customer_details']);
    $phone_number = $db->escape($_POST['phone_number']);  // รับค่าเบอร์โทร
    $postal_code = $db->escape($_POST['postal_code']);
    $tax_id = $db->escape($_POST['tax_id']);
    $branch_no = $db->escape($_POST['branch_no']);
    $subtotal = $db->escape($_POST['subtotal']);
    $discount = $db->escape($_POST['discount']);
    $total = $db->escape($_POST['total']);
    $sale_date = $db->escape($_POST['sale_date']);
    $salesperson = $db->escape($_POST['salesperson']);
    $notes = $db->escape($_POST['notes']);
    $internal_notes = $db->escape($_POST['internal_notes']);
    $tax = isset($_POST['tax']) ? 7 : 0;

    // Insert customer details into the customers table
    $sql_customer = "INSERT INTO customers (name, details, phone_number, postal_code, tax_id, branch_no)
                     VALUES ('{$client_name}', '{$client_details}', '{$phone_number}', '{$postal_code}', '{$tax_id}', '{$branch_no}')";

    if ($db->query($sql_customer)) {
        $customer_id = $db->insert_id();  // ดึง ID ของ customer ที่เพิ่งถูกเพิ่ม

        // Insert quote details into the quotes table
        $sql_quote = "INSERT INTO quotes (customer_id, sale_date, salesperson, subtotal, discount, tax, total, notes, internal_notes)
                      VALUES ('{$customer_id}', '{$sale_date}', '{$salesperson}', '{$subtotal}', '{$discount}', '{$tax}', '{$total}', '{$notes}', '{$internal_notes}')";

        if ($db->query($sql_quote)) {
            $quote_id = $db->insert_id();  // ดึง ID ของ quote ที่เพิ่งถูกเพิ่ม

            // ตรวจสอบข้อมูลที่ส่งเข้ามาและดำเนินการกับ array ของรายการสินค้า
            if (is_array($_POST['product_id']) && is_array($_POST['quantity']) && is_array($_POST['price'])) {
                foreach ($_POST['product_id'] as $index => $product_id) {
                    // ตรวจสอบว่ามีการเลือกสินค้าและกรอกจำนวนและราคาถูกต้อง
                    if (!empty($product_id) && !empty($_POST['quantity'][$index]) && $_POST['price'][$index] != '0.00') {
                        $quantity = $db->escape($_POST['quantity'][$index]);
                        $price = $db->escape($_POST['price'][$index]);
                        $item_total = $quantity * $price;

                        error_log("Processing item $index with product ID: $product_id, Quantity: $quantity, Price: $price, Total: $item_total");

                        $sql_item = "INSERT INTO quote_items (quote_id, product_id, quantity, price, total)
                                     VALUES ('{$quote_id}', '{$product_id}', '{$quantity}', '{$price}', '{$item_total}')";

                        if (!$db->query($sql_item)) {
                            error_log("Error inserting quote item: " . $db->error);
                        } else {
                            error_log("Successfully inserted item $index - Product ID: $product_id, Quantity: $quantity, Price: $price, Total: $item_total");
                        }
                    }
                }
            } else {
                error_log("Form data is not in array format as expected.");
            }

            $session->msg('s', "Quote added successfully.");
            redirect('quotes.php', false);
        } else {
            $session->msg('d', 'Failed to add quote.');
            redirect('add_quote.php', false);
        }
    } else {
        $session->msg('d', 'Failed to add customer.');
        redirect('add_quote.php', false);
    }
}
?>
