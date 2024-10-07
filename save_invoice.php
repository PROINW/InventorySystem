<?php
$page_title = 'สร้างใบเสนอราคา';
require_once('includes/load.php');
page_require_level(2);

$customers = find_all('customers');
$products = find_all('products'); // ดึงข้อมูลสินค้าจากฐานข้อมูล
?>

<?php include_once('layouts/header.php'); ?>

<div class="row">
    <!-- ส่วนข้อมูลลูกค้า -->
    <div class="col-md-6">
        <div class="panel panel-default">
            <div class="panel-heading">
                <strong>ข้อมูลลูกค้า</strong>
            </div>
            <div class="panel-body">
                <form method="post" action="save_quote.php">
                    <!-- แก้ไขเพื่อส่งข้อมูลไปยัง save_quote.php -->
                    <div class="form-group">
                        <label for="customer-name">ชื่อลูกค้า</label>
                        <input type="text" class="form-control" name="customer_name" placeholder="ชื่อลูกค้า" required>
                    </div>
                    <div class="form-group">
                        <label for="customer-details">ข้อมูลลูกค้า</label>
                        <textarea class="form-control" name="customer_details" id="customer-details" placeholder="รายละเอียดที่อยู่"></textarea>
                    </div>
                    <div class="form-group">
                        <input type="text" class="form-control" name="postal_code" placeholder="รหัสไปรษณีย์">
                    </div>
                    <div class="form-group">
                        <input type="text" class="form-control" name="tax_id" placeholder="เลขประจำตัวผู้เสียภาษี">
                    </div>
                    <div class="form-group">
                        <input type="text" class="form-control" name="branch_no" placeholder="สำนักงาน/สาขาเลขที่">
                    </div>
            </div>
        </div>
    </div>

    <!-- ส่วนข้อมูลการขาย -->
    <div class="col-md-6">
        <div class="panel panel-default">
            <div class="panel-heading">
                <strong>ข้อมูลการขาย</strong>
            </div>
            <div class="panel-body">
                <div class="form-group">
                    <label for="total-amount">จำนวนเงินรวมทั้งสิ้น</label>
                    <h3 class="h3" id="total-amount">0.00</h3>
                </div>
                <div class="form-group">
                    <label for="sale-date">วันที่</label>
                    <input type="date" class="form-control" name="sale_date" id="sale-date" value="<?php echo date('Y-m-d'); ?>">
                </div>
                <div class="form-group">
                    <label for="salesperson">พนักงานขาย</label>
                    <input type="text" class="form-control" name="salesperson" placeholder="พนักงานขาย">
                </div>
            </div>
        </div>
    </div>
</div>

<!-- ส่วนรายการสินค้า -->
<div class="row">
    <div class="col-md-12">
        <div class="panel panel-default">
            <div class="panel-heading">
                <strong>รายการสินค้า</strong>
            </div>
            <div class="panel-body">
                <table class="table table-bordered">
                    <thead class="custom-bg">
                        <tr>
                            <th>ลำดับ</th>
                            <th>ชื่อสินค้า / รายละเอียด</th>
                            <th>จำนวน</th>
                            <th>ราคา</th>
                            <th>ราคารวม</th>
                            <th>แก้ไข</th>
                        </tr>
                    </thead>
                    <tbody id="product-rows">
                        <!-- แถวสินค้าแรก -->
                        <tr>
                            <td>1</td>
                            <td>
                                <select class="form-control product-select" name="product_id[]" onchange="updatePrice(this)">
                                    <option value="">ชื่อสินค้า</option>
                                    <?php foreach ($products as $product): ?>
                                        <option value="<?php echo $product['id']; ?>"><?php echo $product['name']; ?></option>
                                    <?php endforeach; ?>
                                </select>
                                <textarea class="form-control" name="product_details[]" placeholder="รายละเอียด (กด Shift+Enter เพื่อขึ้นบรรทัดใหม่)"></textarea>
                            </td>
                            <td><input type="number" name="quantity[]" class="form-control" value="1.00" oninput="calculateTotal()"></td>
                            <td><input type="number" name="price[]" class="form-control price-field" value="0.00" readonly></td>
                            <td><input type="text" name="total[]" class="form-control total-field" readonly value="0.00"></td>
                            <td>
                                <button type="button" class="delete-btn" onclick="deleteRow(this)">ลบ</button>
                            </td>    
                        </tr>
                        <tr>
                            <td>2</td>
                            <td>
                                <select class="form-control product-select" name="product_id[]" onchange="updatePrice(this)">
                                    <option value="">ชื่อสินค้า</option>
                                    <?php foreach ($products as $product): ?>
                                        <option value="<?php echo $product['id']; ?>"><?php echo $product['name']; ?></option>
                                    <?php endforeach; ?>
                                </select>
                                <textarea class="form-control" name="product_details[]" placeholder="รายละเอียด (กด Shift+Enter เพื่อขึ้นบรรทัดใหม่)"></textarea>
                            </td>
                            <td><input type="number" name="quantity[]" class="form-control" value="1.00" oninput="calculateTotal()"></td>
                            <td><input type="number" name="price[]" class="form-control price-field" value="0.00" readonly></td>
                            <td><input type="text" name="total[]" class="form-control total-field" readonly value="0.00"></td>
                            <td><button type="button" class="delete-btn" onclick="deleteRow(this)">ลบ</button></td>
                            </tr>
                            <tr>
                            <td>3</td>
                            <td>
                                <select class="form-control product-select" name="product_id[]" onchange="updatePrice(this)">
                                    <option value="">ชื่อสินค้า</option>
                                    <?php foreach ($products as $product): ?>
                                        <option value="<?php echo $product['id']; ?>"><?php echo $product['name']; ?></option>
                                    <?php endforeach; ?>
                                </select>
                                <textarea class="form-control" name="product_details[]" placeholder="รายละเอียด (กด Shift+Enter เพื่อขึ้นบรรทัดใหม่)"></textarea>
                            </td>
                            <td><input type="number" name="quantity[]" class="form-control" value="1.00" oninput="calculateTotal()"></td>
                            <td><input type="number" name="price[]" class="form-control price-field" value="0.00" readonly></td>
                            <td><input type="text" name="total[]" class="form-control total-field" readonly value="0.00"></td>
                            <td><button type="button" class="delete-btn" onclick="deleteRow(this)">ลบ</button></td>
                            </tr>
                    </tbody>
                </table>
                <button type="button" class="add-item-btn btn btn-primary" onclick="addRow()">+ เพิ่มแถวรายการ</button>
            </div>
        </div>
    </div>
</div>

<!-- ส่วนการคำนวณภาษีและส่วนลด -->
<div class="row">
    <div class="col-md-6">
        <div class="form-group">
            <label for="notes">หมายเหตุ:</label>
            <textarea class="form-control" name="notes" id="notes"></textarea>
        </div>
        <div class="form-group">
            <label for="internal-notes">โน้ตภายในบริษัท:</label>
            <textarea class="form-control" name="internal_notes" id="internal-notes"></textarea>
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group">
            <label for="subtotal">รวมเป็นเงิน</label>
            <input type="text" id="subtotal" class="form-control" readonly value="0.00" disabled>
            <input type="hidden" name="subtotal" id="subtotal-hidden">
            <input type="hidden" name="discount" id="discount-hidden">
            <input type="hidden" name="total" id="total-hidden">
        </div>
        <div class="form-group">
            <label for="discount">ส่วนลด %</label>
            <input type="number" id="discount" class="form-control" value="0" oninput="calculateTotal()">
        </div>
        <div class="form-group">
            <label for="tax">ภาษีมูลค่าเพิ่ม 7%</label>
            <input type="checkbox" id="tax" checked onchange="calculateTotal()">
        </div>
        <div class="form-group">
            <label for="total">จำนวนเงินรวมทั้งสิ้น</label>
            <input type="text" id="total" class="form-control" readonly value="0.00" disabled>
        </div>
        <button type="submit" class="btn btn-success">บันทึกเอกสาร</button>
    </div>
</div>
</form> <!-- ปิดแท็กฟอร์มที่เริ่มต้นในส่วนข้อมูลลูกค้า -->

<?php include_once('layouts/footer.php'); ?>

<!-- Script สำหรับการจัดการตาราง -->
<script>
    const productPrices = {
        <?php foreach ($products as $product): ?> 
            "<?php echo $product['id']; ?>": "<?php echo $product['sale_price']; ?>",
        <?php endforeach; ?>
    };

    function addRow() {
    var table = document.getElementById("product-rows");
    var rowCount = table.rows.length + 1; // นับจำนวนแถวปัจจุบัน
    var row = table.insertRow(); // เพิ่มแถวใหม่ในตาราง

    row.innerHTML = `
        <td>${rowCount}</td>
        <td>
            <select class="form-control product-select" name="product_id[]" onchange="updatePrice(this)">
                <option value="">ชื่อสินค้า</option>
                <?php foreach ($products as $product): ?>
                    <option value="<?php echo $product['id']; ?>"><?php echo $product['name']; ?></option>
                <?php endforeach; ?>
            </select>
            <textarea class="form-control" name="product_details[]" placeholder="รายละเอียด (กด Shift+Enter เพื่อขึ้นบรรทัดใหม่)"></textarea>
        </td>
        <td><input type="number" name="quantity[]" class="form-control" value="1.00" oninput="calculateTotal()"></td>
        <td><input type="number" name="price[]" class="form-control price-field" value="0.00" readonly></td>
        <td><input type="text" name="total[]" class="form-control total-field" readonly value="0.00"></td>
        <td><button type="button" class="delete-btn" onclick="deleteRow(this)">ลบ</button></td>
    `;
}

    function updatePrice(selectElement) {
        const productId = selectElement.value;
        const priceField = selectElement.parentElement.parentElement.querySelector('.price-field');

        if (productPrices[productId]) {
            priceField.value = productPrices[productId];
        } else {
            priceField.value = "0.00";
        }

        calculateTotal();
    }

    function deleteRow(btn) {
        const row = btn.parentNode.parentNode;
        row.parentNode.removeChild(row);
        calculateTotal();
    }

    function calculateTotal() {
        let subtotal = 0;
        const rows = document.getElementById('product-rows').getElementsByTagName('tr');

        for (let i = 0; i < rows.length; i++) {
            const qty = parseFloat(rows[i].querySelector('input[name="quantity[]"]').value) || 0;
            const price = parseFloat(rows[i].querySelector('input[name="price[]"]').value) || 0;
            const total = qty * price;
            rows[i].querySelector('input[name="total[]"]').value = total.toFixed(2);
            subtotal += total;
        }

        document.getElementById('subtotal').value = subtotal.toFixed(2);
        document.getElementById('subtotal-hidden').value = subtotal.toFixed(2);

        let discount = parseFloat(document.getElementById('discount').value) || 0;
        let discountedSubtotal = subtotal - (subtotal * (discount / 100));

        if (document.getElementById('tax').checked) {
            discountedSubtotal *= 1.07;
        }

        document.getElementById('total').value = discountedSubtotal.toFixed(2);
        document.getElementById('total-hidden').value = discountedSubtotal.toFixed(2);
        document.getElementById('discount-hidden').value = discount;

        document.getElementById('total-amount').textContent = discountedSubtotal.toFixed(2);
    }
</script>

</body>

</html>