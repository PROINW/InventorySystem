<?php include_once('includes/load.php'); 
require_once('includes/session.php');?>
<?php
$req_fields = array('username','password' );
validate_fields($req_fields);
$username = remove_junk($_POST['username']);
$password = remove_junk($_POST['password']);

if(empty($errors)){
  $user_id = authenticate($username, $password);
  if($user_id){
    //create session with id
     $session->login($user_id);
    //Update Sign in time
     updateLastLogIn($user_id);
     $session->msg("s", "ยินดีต้อนรับเข้าสู่ระบบจัดการคลังสินค้า");
     redirect('admin.php',false);

  } else {
    $session->msg("d", "ขออภัย ชื่อผู้ใช้หรือรหัสผ่านไม่ถูกต้อง.");
    redirect('index.php',false);
  }

} else {
   $session->msg("d", $errors);
   redirect('index.php',false);
}

?>
