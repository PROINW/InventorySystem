<?php

$page_title = 'แสดงใบเสนอราคา';
require_once('includes/load.php');
page_require_level(2);

$company_name = "บริษัท อาชีวะอุตสาหกรรม จำกัด";
$company_address = "33/30-35 หมู่ 3 ตำบล นาดี อำเภอเมืองสมุทรสาคร สมุทรสาคร 74000";
$company_phone = "เบอร์ติดต่อ: 02-123-4567";
$company_email = "อีเมล: example@company.com";

if (isset($_GET['id'])) {
    $quote_id = $_GET['id'];
    $quote = find_by_id('quotes', $quote_id);
    $quote_items = find_all_where('quote_items', 'quote_id', $quote_id);
    $customer = find_by_id('customers', $quote['customer_id']);

    if (!$quote || !$customer || !$quote_items) {
        $session->msg('d', 'ไม่พบข้อมูลที่ต้องการ');
        redirect('quotes.php', false);
    }
} else {
    $session->msg('d', 'Missing quote ID.');
    redirect('quotes.php', false);
}


// คำนวณภาษีมูลค่าเพิ่ม 7%
$vat_rate = 0.07;
$vat_amount = $quote['subtotal'] * $vat_rate;
$total_with_vat = $quote['subtotal'] + $vat_amount;
?>

<!DOCTYPE html>
<html lang="th">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>แสดงใบเสนอราคา</title>
    <style>
        body {
            font-family: 'TH SarabunPSK', sans-serif;
            margin: 0;
            padding: 20px;
            background-color: #f4f4f4;
        }

        .container {
            background: #fff;
            padding: 20px;
            max-width: 900px;
            margin: auto;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        .text-right {
            text-align: right;
            margin-bottom: 20px;
        }

        .btn-primary {
            background-color: #007bff;
            border: none;
            color: white;
            padding: 10px 20px;
            text-align: center;
            text-decoration: none;
            display: inline-block;
            font-size: 16px;
            border-radius: 5px;
            cursor: pointer;
        }

        .btn-primary:hover {
            background-color: #0056b3;
        }

        h1 {
            font-size: 30px;
            text-align: center;
        }

        p {
            margin: 5px 0;
        }

        .quote-info, .company-info, .customer-info {
            font-size: 14px;
            margin-bottom: 15px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin: 20px 0;
        }

        table, th, td {
            border: 1px solid black;
        }

        th, td {
            padding: 8px;
            text-align: center;
        }

        .signature-section {
            margin-top: 40px;
            text-align: center;
        }

        .signature-line {
            margin-top: 30px;
            border-top: 1px dotted black;
            width: 40%;
            margin: 0 auto;
        }

        .note-section {
            margin-top: 30px;
            font-size: 14px;
        }

        @media print {
            .btn-primary {
                display: none;
            }

            body {
                margin: 0;
                padding: 0;
                background-color: white;
            }

            .container {
                box-shadow: none;
                margin: 0;
            }
        }
    </style>
</head>
<body>

<div class="container">
    <!-- ปุ่มสำหรับพิมพ์ -->
    <div class="text-right">
        <button class="btn-primary" onclick="window.print()">พิมพ์ใบเสนอราคา</button>
    </div>

    <h1>ใบเสนอราคา (Quotation)</h1>

    <!-- ข้อมูลบริษัทและลูกค้า -->
    <div class="company-info">
        <strong>ผู้ออก:</strong><br>
        <?php echo $company_name; ?><br>
        <?php echo nl2br($company_address); ?><br>
        โทร: <?php echo $company_phone; ?><br>
        อีเมล: <?php echo $company_email; ?><br>
        เลขที่เสียภาษี: 0105564068709
    </div>

    <div class="customer-info">
        <strong>ลูกค้า:</strong> <?php echo $customer['name']; ?><br>
        <strong>ที่อยู่:</strong> <?php echo nl2br($customer['details']); ?><br>
        <strong>เลขที่ผู้เสียภาษี:</strong> <?php echo $customer['tax_id']; ?><br>
    </div>

    <!-- รายการสินค้า -->
    <table>
        <thead>
            <tr>
                <th>รหัสสินค้า</th>
                <th>รายการสินค้า / บริการ</th>
                <th>จำนวน</th>
                <th>หน่วย</th>
                <th>ราคาต่อหน่วย</th>
                <th>จำนวนเงิน</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($quote_items as $item): ?>
            <tr>
                <td><?php echo $item['product_id']; ?></td>
                <td><?php 
                    $product = find_by_id('products', $item['product_id']);
                    echo $product ? $product['name'] : 'ไม่พบสินค้า'; 
                ?></td>
                <td><?php echo number_format($item['quantity'], 0); ?></td>
                <td>ตัว</td>
                <td><?php echo number_format($item['price'], 2); ?></td>
                <td><?php echo number_format($item['total'], 2); ?></td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>

    <!-- สรุปยอดรวม -->
    <table>
        <tr>
            <td>ราคาสินค้าทั้งหมดก่อนภาษีมูลค่าเพิ่ม</td>
            <td><?php echo number_format($quote['subtotal'], 2); ?> บาท</td>
        </tr>
        <tr>
            <td>ภาษีมูลค่าเพิ่ม 7%</td>
            <td><?php echo number_format($vat_amount, 2); ?> บาท</td>
        </tr>
        <tr>
            <td><strong>จำนวนเงินรวมทั้งสิ้น (รวมภาษีมูลค่าเพิ่ม)</strong></td>
            <td><strong><?php echo number_format($total_with_vat, 2); ?> บาท</strong></td>
        </tr>
    </table>

    <!-- หมายเหตุ -->
    <div class="note-section">
        <strong>หมายเหตุ:</strong> <?php echo nl2br($quote['notes']); ?>
    </div>

    <!-- ลายเซ็นต์ -->
    <div class="signature-section">
        <div class="signature-line"></div>
        <strong>อนุมัติโดย</strong>
    </div>

    <div class="signature-section">
        <div class="signature-line"></div>
        <strong>ยอมรับใบเสนอราคาโดย</strong>
    </div>
</div>

</body>
</html>
