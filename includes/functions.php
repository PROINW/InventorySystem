<?php
$errors = array();

/*--------------------------------------------------------------*/
/* Function for Remove escapes special
 /* characters in a string for use in an SQL statement
 /*--------------------------------------------------------------*/
function real_escape($str)
{
  global $con;
  $escape = mysqli_real_escape_string($con, $str);
  return $escape;
}
/*--------------------------------------------------------------*/
/* Function for Remove html characters
/*--------------------------------------------------------------*/
function remove_junk($str)
{
  $str = nl2br($str);
  $str = htmlspecialchars(strip_tags($str, ENT_QUOTES));
  return $str;
}
/*--------------------------------------------------------------*/
/* Function for Uppercase first character
/*--------------------------------------------------------------*/
function first_character($str)
{
  $val = str_replace('-', " ", $str);
  $val = ucfirst($val);
  return $val;
}
/*--------------------------------------------------------------*/
/* Function for Checking input fields not empty
/*--------------------------------------------------------------*/
function validate_fields($var)
{
  global $errors;
  foreach ($var as $field) {
    $val = remove_junk($_POST[$field]);
    if (isset($val) && $val == '') {
      $errors = $field . " can't be blank.";
      return $errors;
    }
  }
}
/*--------------------------------------------------------------*/
/* Function for Display Session Message
   Ex echo displayt_msg($message);
/*--------------------------------------------------------------*/
function display_msg($msg = '')
{
  $output = array();
  if (!empty($msg)) {
    foreach ($msg as $key => $value) {
      $output  = "<div class=\"alert alert-{$key}\">";
      $output .= "<a href=\"#\" class=\"close\" data-dismiss=\"alert\">&times;</a>";
      $output .= remove_junk(first_character($value));
      $output .= "</div>";
    }
    return $output;
  } else {
    return "";
  }
}
/*--------------------------------------------------------------*/
/* Function for redirect
/*--------------------------------------------------------------*/
function redirect($url, $permanent = false)
{
  if (headers_sent() === false) {
    header('Location: ' . $url, true, ($permanent === true) ? 301 : 302);
  }

  exit();
}
/*--------------------------------------------------------------*/
/* Function for find out total saleing price, buying price and profit
/*--------------------------------------------------------------*/
function total_price($totals)
{
  $sum = 0;
  $sub = 0;
  foreach ($totals as $total) {
    $sum += $total['total_saleing_price'];
    $sub += $total['total_buying_price'];
    $profit = $sum - $sub;
  }
  return array($sum, $profit);
}
/*--------------------------------------------------------------*/
/* Function for Readable date time
/*--------------------------------------------------------------*/
function read_date($str)
{
  if ($str)
    return date('F j, Y, g:i:s a', strtotime($str));
  else
    return null;
}
/*--------------------------------------------------------------*/
/* Function for  Readable Make date time
/*--------------------------------------------------------------*/
function make_date()
{
  return strftime("%Y-%m-%d %H:%M:%S", time());
}
/*--------------------------------------------------------------*/
/* Function for  Readable date time
/*--------------------------------------------------------------*/
function count_id()
{
  static $count = 1;
  return $count++;
}
/*--------------------------------------------------------------*/
/* Function for Creting random string
/*--------------------------------------------------------------*/
function randString($length = 5)
{
  $str = '';
  $cha = "0123456789abcdefghijklmnopqrstuvwxyz";

  for ($x = 0; $x < $length; $x++)
    $str .= $cha[mt_rand(0, strlen($cha))];
  return $str;
}

function get_sales_data($type = 'monthly') {
  global $db;

  if ($type == 'monthly') {
    $sql  = "SELECT MONTH(date) as month, SUM(qty * price) as total_sales";
    $sql .= " FROM sales";
    $sql .= " WHERE YEAR(date) = YEAR(CURDATE())"; // ดึงข้อมูลเฉพาะปีปัจจุบัน
    $sql .= " GROUP BY MONTH(date)";
    $sql .= " ORDER BY MONTH(date)";
  } elseif ($type == 'yearly') {
    $sql  = "SELECT YEAR(date) as year, SUM(qty * price) as total_sales";
    $sql .= " FROM sales";
    $sql .= " GROUP BY YEAR(date)";
    $sql .= " ORDER BY YEAR(date)";
  }

  $result = $db->query($sql);
  $data = [];
  
  // เตรียมข้อมูลสำหรับกราฟ
  while ($row = $db->fetch_assoc($result)) {
    $data['labels'][] = $row[$type == 'monthly' ? 'month' : 'year'];
    $data['data'][] = (float) $row['total_sales'];
  }

  return $data;
}
function find_orders_by_user($user_id) {
  global $db;
  $sql  = "SELECT * FROM sales WHERE user_id = '{$user_id}'";
  return find_by_sql($sql);
}
// ฟังก์ชันสำหรับดึงข้อมูลคำสั่งซื้อทั้งหมด
// ฟังก์ชันสำหรับดึงข้อมูลคำสั่งซื้อทั้งหมด
function find_all_orders() {
  global $db;
  $sql  = "SELECT sales.id, products.name AS product_name, customers.name AS customer_name, ";
  $sql .= "sales.qty, sales.price, sales.date, sales.status ";
  $sql .= "FROM sales ";
  $sql .= "JOIN products ON sales.product_id = products.id ";
  $sql .= "LEFT JOIN customers ON sales.customer_id = customers.id";
  $result = $db->query($sql);
  return $result;
}







