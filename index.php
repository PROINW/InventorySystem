<?php require_once('includes/session.php');
ob_start();
require_once('includes/load.php');
if ($session->isUserLoggedIn(true)) {
  redirect('home.php', false);
}
?>
<!DOCTYPE html>
<html lang="th">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>เข้าสู่ระบบ</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="libs/css/index.css" />
</head>
<body>

<div class="login-container">
  <h1>เข้าสู่ระบบ</h1>
  <h4>บริษัท อาชีวะอุตสาหกรรม จำกัด</h4>


  <?php echo display_msg($msg); ?>


  <form method="post" action="auth.php" class="clearfix">
    <div class="form-group">
      <label for="username" class="control-label">Username</label>
      <input type="text" class="form-control" name="username" placeholder="Username" required>
    </div>
    <div class="form-group">
      <label for="password" class="control-label">Password</label>
      <input type="password" name="password" class="form-control" placeholder="Password" required>
    </div>
    <div class="d-grid gap-2">
      <button type="submit" class="btn btn-custom">Login</button>
    </div>
  </form>

 
  <div class="footer-text">
    &copy; 2024 บริษัท อาชีวะอุตสาหกรรม จำกัด
  </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
