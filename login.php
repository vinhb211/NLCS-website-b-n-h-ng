<?php
session_start();
include "header.php";

$message = "";
$servername = "localhost"; // Thay đổi nếu cần
$usernameDB = "root"; // Thay đổi thành tên người dùng của bạn
$passwordDB = ""; // Thay đổi thành mật khẩu của bạn
$dbname = "website_Tvi"; // Thay đổi thành tên cơ sở dữ liệu của bạn

$conn = new mysqli($servername, $usernameDB, $passwordDB, $dbname);

if ($conn->connect_error) {
    die("Kết nối thất bại: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = $_POST['password'];
    //Truy van mat khau nguoi dung 
    $sql = "SELECT password FROM users WHERE username = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $stmt->store_result();
    
    if ($stmt->num_rows > 0) {
        $stmt->bind_result($hashed_password);
        $stmt->fetch();
        if (password_verify($password, $hashed_password)) {
            $_SESSION['username'] = $username;
            header("Location: Hhome.php");
            exit();
        } else {
            $message = "Mật khẩu không đúng!";
        }
    } else {
        $message = "Tên người dùng không tồn tại!";
    }

    $stmt->close();
}

$conn->close();

?>

<!-- --------------------------FORM ĐĂNG NHẬP----------------------- -->

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!--icon-->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
    <link rel="stylesheet" href="./style.css">
    <title>TVI</title>
</head>
<body>
     <?php
     ?>

    <main>
        
        <div class="login">
        
        <form method="post" action="login.php">
        <h2>ĐĂNG NHẬP</h2>
        <table>
            <tr>
                <td><label for="username">Tên đăng nhập</label>
                </td>
                <td>
                <input type="text" id="username" name="username" required><br><br>
                </td>
            </tr>
            <tr>
                <td>
                   <label for="password">Mật khẩu</label>
                </td>
                <td>
                  <input type="password" id="password" name="password" required><br><br>
                </td>
            </tr>
            <tr >
                <td colspan="2">
                    <button type="submit">Đăng nhập</button>
                </td>
                <td></td>
            </tr>
        </table>
        </form>
        </div>
     </main>
   
<footer>
    <div class="footer">
        <p class="bottom">Tải ứng dụng TVI shop</p>
        <div class="app">
            <img src="./image/appstore.webp" alt="">
            <img src="./image/googleplay.png" alt="">
        </div>
        <p class="bottom">Nhận bản tin TVI shop</p>
        <input type="text" placeholder="Nhập email của bạn">
        <div class="p-bottom">
        <li>Liên hệ</li>
        <li>Tuyển dụng</li>
        <li>Giới thiệu</li>
        <li>
            <a href="" class="fab fa-facebook-f"></a>
            <a href="" class="fab fa-twitter"></a>
            <a href="" class="fab fa-youtube"></a>
        </li>
        </div>
        <div class="footer-bottom">
        <p>
        Công ty Cổ phần Vinh Thạch với số đăng ký kinh doanh: 0100756759<br>
        Địa chỉ: Đường 3/2, Phường Xuân Khánh, Quận Ninh Kiều, Thành phố Cần Thơ, Việt Nam<br>
        Đặt hàng online: <b>0264 233 4343</b>
        </p>
        </div>
        
        <div class="footer-bottom-2">
            @Tvishop All rights reserved
        </div>
    </div>

</footer>

</body>
<script>
    const header = document.querySelector("header")
    window.addEventListener("scroll",function(){
        x = window.pageYOffset
        if(x > 0){
            header.classList.add("sticky")
        }
        else{
            header.classList.add("sticky")
        }
    })
</script>
<style>
    table{
      text-align: center;
      align-items: center;
      border: 2px solid greenyellow;
      padding: 20px 10px;
      border-radius: 15px;
      background-color: rgba(0, 255, 183, 0.327);
      margin-left: auto;
      margin-right: auto;
    }
    .login{
    /* text-align: center; */
    margin-left: auto;
    margin-right: auto;
    margin-top: 100px;
    margin-bottom: 50px;
   
    max-width: 800px;
   
 }
 h2{
    text-align: center; 
     color: green;
     padding-bottom: 30px;
 }
 .login input{
     width:400px;
     height: 30px;
     border:none;
     border-radius: 3px;
 }
 .login label{
    text-align: left;
    max-width: 150px;
    float: left;
    padding-right: 10px;
    padding-bottom: 15px;
 }
 .login button{
    /* align-items:center; */
    /* justify-content: center; */
    /* text-align: center; */
    border-radius: 5px;
    border: none;
    padding: 10px 70px;
    background-color: rgba(0, 255, 183, 0.985);
    color: green;
 }
 .login button:hover{
    background-color: rgba(0, 255, 115, 0.985);
    cursor: pointer;
    color: #000;
 }
 .login form{
    background-color: #fff;
    padding: 50px;
 }
 .notification {
            color: #fff;
            padding: 10px;
            margin: 10px;
            border-radius: 5px;
            position: absolute;
            top: 70px;
            right: 20px;
            background-color: #28a745; /* Màu xanh lá cho thông báo thành công */
        }
 .notification.error {
            background-color: #dc3545; /* Màu đỏ cho thông báo lỗi */
        }
</style>

</html>


