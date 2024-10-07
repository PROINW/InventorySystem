<?php
  $page_title = 'กลุ่มผู้ใช้ทั้งหมด';
  require_once('includes/load.php');
  // ตรวจสอบระดับสิทธิ์ของผู้ใช้ในการดูหน้านี้
   page_require_level(1);
  $all_groups = find_all('user_groups');
?>
<?php include_once('layouts/header.php'); ?>
<link rel="stylesheet" href="libs/css/main.css" />
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
        <span>กลุ่มผู้ใช้</span>
     </strong>
       <a href="add_group.php" class="btn btn-primary pull-right "> เพิ่มกลุ่มใหม่</a>
    </div>
     <div class="panel-body">
      <table class="table table-bordered">
        <thead>
          <tr>
            <th class="text-center" style="width: 50px;">#</th>
            <th>ชื่อกลุ่ม</th>
            <th class="text-center" style="width: 20%;">ระดับกลุ่ม</th>
            <th class="text-center" style="width: 15%;">สถานะ</th>
            <th class="text-center" style="width: 100px;">แก้ไข</th>
          </tr>
        </thead>
        <tbody>
        <?php foreach($all_groups as $a_group): ?>
          <tr>
           <td class="text-center"><?php echo count_id();?></td>
           <td><?php echo remove_junk(ucwords($a_group['group_name']))?></td>
           <td class="text-center">
             <?php echo remove_junk(ucwords($a_group['group_level']))?>
           </td>
           <td class="text-center">
           <?php if($a_group['group_status'] === '1'): ?>
            <span class="custon-label custom-label-sucess"><?php echo "ใช้งาน"; ?></span>
          <?php else: ?>
            <span class="custom-label2 custom-label-danger"><?php echo "ไม่ใช้งาน"; ?></span>
          <?php endif;?>
           </td>
           <td class="text-center">
             <div class="btn-group">
                <a href="edit_group.php?id=<?php echo (int)$a_group['id'];?>" class="btn btn-sm btn-warning" data-toggle="tooltip" title="แก้ไข">
                  <i class="glyphicon glyphicon-pencil"></i>
               </a>
                <a href="delete_group.php?id=<?php echo (int)$a_group['id'];?>" class="btn btn-sm btn-danger" data-toggle="tooltip" title="ลบ">
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
