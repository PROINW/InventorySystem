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
  <style>
    /* ฟอนต์และพื้นหลัง */
    body {
      background: linear-gradient(to right, #e3ffe7, #d9e7ff);
      font-family: 'Poppins', sans-serif;
      height: 100vh;
      display: flex;
      align-items: center;
      justify-content: center;
    }
    /* กล่องฟอร์ม */
    .login-container {
      max-width: 400px;
      background-color: #fff;
      padding: 30px;
      border-radius: 10px;
      box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
      animation: fadeIn 1s ease-in-out;
    }
    /* หัวเรื่อง */
    .login-container h1, .login-container h4 {
      text-align: center;
      color: #4a4a4a;
      margin-bottom: 20px;
    }
    /* การจัดการอินพุต */
    .form-control {
      margin-bottom: 20px;
      height: 50px;
      font-size: 16px;
      padding-left: 15px;
      border-radius: 5px;
      border: 1px solid #ddd;
      transition: all 0.3s ease;
    }
    /* เอฟเฟกต์อินพุตเมื่อโฟกัส */
    .form-control:focus {
      border-color: #80bdff;
      box-shadow: 0 0 5px rgba(0, 123, 255, 0.25);
    }
    /* ปุ่มสไตล์ */
    .btn-custom {
      background-color: #4a90e2;
      color: #fff;
      font-size: 18px;
      font-weight: 600;
      padding: 10px;
      border-radius: 5px;
      transition: all 0.3s ease;
      width: 100%;
    }
    .btn-custom:hover {
      background-color: #357ab7;
    }
    /* ฟุตเตอร์ */
    .footer-text {
      margin-top: 20px;
      text-align: center;
      color: #6c757d;
      font-size: 14px;
    }
    /* เอฟเฟกต์เปิดตัวฟอร์ม */
    @keyframes fadeIn {
      from { opacity: 0; transform: translateY(20px); }
      to { opacity: 1; transform: translateY(0); }
    }
  </style>
</head>
<body>

<div class="login-container">
  <h1>เข้าสู่ระบบ</h1>
  <h4>บริษัท อาชีวะอุตสาหกรรม จำกัด</h4>

  <!-- แสดงข้อความจากระบบ -->
  <?php echo display_msg($msg); ?>

  <!-- ฟอร์มเข้าสู่ระบบ -->
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

  <!-- ฟุตเตอร์ -->
  <div class="footer-text">
    &copy; 2024 บริษัท อาชีวะอุตสาหกรรม จำกัด
  </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
