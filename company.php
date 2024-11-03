<?php
$page_title = 'บริษัททั้งหมด';
require_once('includes/load.php');
require_once('includes/session.php');
require_once('includes/database.php');
// ตรวจสอบระดับสิทธิ์ของผู้ใช้ในการดูหน้านี้
page_require_level(1);

$all_companies = find_all('delivery_company');
?>
<?php
if (isset($_POST['add_company'])) {
  $req_fields = array('company-name', 'company-address', 'company-contact');
  validate_fields($req_fields);
  $company_name = remove_junk($db->escape($_POST['company-name']));
  $company_address = remove_junk($db->escape($_POST['company-address']));
  $company_contact = remove_junk($db->escape($_POST['company-contact']));

  if (empty($errors)) {
    $sql  = "INSERT INTO delivery_company (name, address, contact_number)";
    $sql .= " VALUES ('{$company_name}', '{$company_address}', '{$company_contact}')";
    if ($db->query($sql)) {
      $session->msg("s", "เพิ่มบริษัทเรียบร้อยแล้ว");
      redirect('company.php', false);
    } else {
      $session->msg("d", "ขออภัย! การเพิ่มบริษัทล้มเหลว.");
      redirect('company.php', false);
    }
  } else {
    $session->msg("d", $errors);
    redirect('company.php', false);
  }
}
?>
<?php include_once('layouts/header.php'); ?>

<div class="row">
  <div class="col-md-12">
    <?php echo display_msg($msg); ?>
  </div>
</div>
<div class="row">
  <div class="col-md-5">
    <div class="panel panel-default">
      <div class="panel-heading">
        <strong>
          <span class="glyphicon glyphicon-th"></span>
          <span>เพิ่มบริษัท</span>
        </strong>
      </div>
      <div class="panel-body">
        <form method="post" action="company.php">
          <div class="form-group">
            <input type="text" class="form-control" name="company-name" placeholder="ชื่อบริษัท">
          </div>
          <div class="form-group">
            <textarea class="form-control" name="company-address" placeholder="ที่อยู่บริษัท"></textarea>
          </div>
          <div class="form-group">
            <input type="text" class="form-control" name="company-contact" placeholder="เบอร์ติดต่อ" pattern="\d*" maxlength="10" oninput="this.value = this.value.replace(/[^0-9]/g, '')">
          </div>

          <button type="submit" name="add_company" class="btn btn-primary">เพิ่มบริษัท</button>
        </form>
      </div>
    </div>
  </div>
  <div class="col-md-7">
    <div class="panel panel-default">
      <div class="panel-heading">
        <strong>
          <span class="glyphicon glyphicon-th"></span>
          <span>บริษัททั้งหมด</span>
        </strong>
      </div>
      <div class="panel-body">
        <table class="table table-bordered table-striped table-hover">
          <thead>
            <tr>
              <th class="text-center" style="width: 50px;">#</th>
              <th>ชื่อบริษัท</th>
              <th>ที่อยู่</th>
              <th>เบอร์ติดต่อ</th>
              <th class="text-center" style="width: 100px;">แก้ไข</th>
            </tr>
          </thead>
          <tbody>
            <?php foreach ($all_companies as $company): ?>
              <tr>
                <td class="text-center"><?php echo count_id(); ?></td>
                <td><?php echo remove_junk($company['name']); ?></td>
                <td><?php echo remove_junk($company['address']); ?></td>
                <td><?php echo remove_junk($company['contact_number']); ?></td>
                <td class="text-center">
                  <div class="btn-group">
                    <a href="edit_company.php?id=<?php echo (int)$company['id']; ?>" class="btn btn-sm btn-warning" data-toggle="tooltip" title="แก้ไข">
                      <span class="glyphicon glyphicon-edit"></span>
                    </a>
                    <a href="delete_company.php?id=<?php echo (int)$company['id']; ?>" class="btn btn-sm btn-danger" data-toggle="tooltip" title="ลบ">
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
</div>
<?php include_once('layouts/footer.php'); ?>