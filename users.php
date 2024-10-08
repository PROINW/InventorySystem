<?php
  $page_title = 'ผู้ใช้งานทั้งหมด';
  require_once('includes/load.php');
?>
<?php
// ตรวจสอบสิทธิ์ของผู้ใช้ในการเข้าถึงหน้านี้
 page_require_level(1);
// ดึงข้อมูลผู้ใช้ทั้งหมดจากฐานข้อมูล
 $all_users = find_all_user();
?>

<?php include_once('layouts/header.php'); ?>
<div class="row">
   <div class="col-md-12">
     <?php echo display_msg($msg); ?>
   </div>
</div>
<div class="row">
  <div class="col-md-12">
    <div class="panel panel-default">
      <div class="panel-heading clearfix">
        <strong>
          <span class="glyphicon glyphicon-th"></span>
          <span>ผู้ใช้งาน</span>
       </strong>
         <a href="add_user.php" class="btn btn-info pull-right">เพิ่มผู้ใช้ใหม่</a>
      </div>
     <div class="panel-body">
      <table class="table table-bordered table-striped">
        <thead>
          <tr>
            <th class="text-center" style="width: 50px;">#</th>
            <th>ชื่อ</th>
            <th>ชื่อผู้ใช้</th>
            <th class="text-center" style="width: 15%;">บทบาทผู้ใช้</th>
            <th class="text-center" style="width: 10%;">สถานะ</th>
            <th class="text-center" style= "width: 20%;">การเข้าสู่ระบบครั้งล่าสุด</th>
            <th class="text-center" style="width: 100px;">แก้ไข</th>
          </tr>
        </thead>
        <tbody>
        <?php foreach($all_users as $a_user): ?>
          <tr>
           <td class="text-center"><?php echo count_id();?></td>
           <td><?php echo remove_junk(ucwords($a_user['name']))?></td>
           <td><?php echo remove_junk(ucwords($a_user['username']))?></td>
           <td class="text-center"><?php echo remove_junk(ucwords($a_user['group_name']))?></td>
           <td class="text-center">
           <?php if($a_user['status'] === '1'): ?>
            <span class="label label-success"><?php echo "ใช้งานอยู่"; ?></span>
          <?php else: ?>
            <span class="label label-danger"><?php echo "ไม่ใช้งาน"; ?></span>
          <?php endif;?>
           </td>
           <td><?php echo read_date($a_user['last_login'])?></td>
           <td class="text-center">
             <div class="btn-group">
                <a href="edit_user.php?id=<?php echo (int)$a_user['id'];?>" class="btn btn-sm btn-warning" data-toggle="tooltip" title="แก้ไข" >
                  <i class="glyphicon glyphicon-pencil"></i>
               </a>
                <a href="delete_user.php?id=<?php echo (int)$a_user['id'];?>" class="btn btn-sm btn-danger" data-toggle="tooltip" title="ลบ" >
                  <i class="glyphicon glyphicon-remove"></i>
                </a>
                </div>
           </td>
          </tr>
        <?php endforeach;?>
       </tbody>
     </table>
     </div>
    </div>
  </div>
</div>
<?php include_once('layouts/footer.php'); ?>
