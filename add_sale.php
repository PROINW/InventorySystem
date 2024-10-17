<?php
$page_title = 'ใบเสร็จรับเงิน/ใบกำกับภาษี';
require_once('includes/load.php');

// ตรวจสอบระดับสิทธิ์ของผู้ใช้ในการดูหน้านี้
page_require_level(2);

// ดึงข้อมูลใบเสนอราคาที่เกี่ยวข้อง
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
$subtotal = $quote['subtotal'];
$vat_amount = $subtotal * $vat_rate;
$total_with_vat = $subtotal + $vat_amount;

?>

<!DOCTYPE html>
<html lang="th">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ใบเสร็จรับเงิน/ใบกำกับภาษี</title>
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
    <!-- ส่วนหัวของใบเสร็จ -->
    <h1>ใบเสร็จรับเงิน/ใบกำกับภาษี</h1>
    <div class="company-info">
        <strong>บริษัท ผู้ขายทดสอบ จำกัด (สำนักงานใหญ่)</strong><br>
        999 หมู่ 999 ถ.ทดสอบ 999 แขวงทดสอบ<br>
        เขตบางกะทัด กรุงเทพมหานคร 10500<br>
        เลขที่ผู้เสียภาษี 1234567890999<br>
        โทร. 0912345678 อีเมล seller@test.com
    </div>

    <!-- ข้อมูลลูกค้า -->
    <div class="customer-info">
        <strong>ลูกค้า:</strong> <?php echo $customer['name']; ?><br>
        <strong>ที่อยู่:</strong> <?php echo nl2br($customer['details']); ?><br>
        <strong>เลขที่ผู้เสียภาษี:</strong> <?php echo $customer['tax_id']; ?><br>
        <strong>โทร:</strong> <?php echo $customer['phone']; ?><br>
        <strong>อีเมล:</strong> <?php echo $customer['email']; ?>
    </div>

    <!-- รายการสินค้า -->
    <table>
        <thead>
            <tr>
                <th>#</th>
                <th>รายการสินค้า / บริการ</th>
                <th>จำนวน</th>
                <th>หน่วย</th>
                <th>ราคาต่อหน่วย</th>
                <th>จำนวนเงิน</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($quote_items as $key => $item): ?>
            <tr>
                <td><?php echo $key + 1; ?></td>
                <td><?php
                    $product = find_by_id('products', $item['product_id']);
                    echo $product ? $product['name'] : 'ไม่พบสินค้า'; 
                ?></td>
                <td><?php echo $item['quantity']; ?></td>
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
            <td><?php echo number_format($subtotal, 2); ?> บาท</td>
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
        <strong>ผู้รับเงิน</strong>
    </div>

</div>

</body>
</html>
