<?php
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
    $confirm_password = $_POST['confirm_password'];

    if ($password !== $confirm_password) {
        $message = "Mật khẩu không khớp!";
    } elseif (strlen($password) < 8 || !preg_match('/[^\w]/', $password)) {
        // $message = "Mật khẩu phải có ít nhất 8 ký tự và chứa ít nhất 1 ký tự đặc biệt!";
        echo 'Mật khẩu phải có ít nhất 8 ký tự và chứa ít nhất 1 ký tự đặc biệt!';
    } else {
        //Ma hoa pass
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);
        $sql = "INSERT INTO users (username, password) VALUES (?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ss", $username, $hashed_password);

        if ($stmt->execute()) {
            // $message = "Đăng ký thành công!";
            echo 'Đăng ký thành công';
            header('Location: login.php');
        } else {
            $message = "Lỗi: " . $stmt->error;
        }

        $stmt->close();
    }
}

$conn->close();

?>


</html>
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

   
    <main>
        
        <div class="register">
        
        <form method="post" action="register.php">
        <h2>ĐĂNG KÝ</h2>
        <table class="form-wrap">
            <tr class="form-group">
                <td><label for="username">Tên đăng nhập</label>
                </td>
                <td>
                <input type="text" id="username" name="username" required><br><br> 
                <div class="form-error"></div>

                </td>
            </tr>
            <tr class="form-group">
                <td>
                   <label for="password">Mật khẩu</label>
                </td>
                <td>
                  <input type="password" id="password" name="password" required><br><br>
                <div class="form-error"></div>

                </td>
            </tr>
            <tr class="form-group">
                <td>
                   <label for="confirm_password" >Nhập lại mật khẩu</label>
                </td>
                <td>
                  <input type="password" id="confirm_password" name="confirm_password" required><br><br>
                <div class="form-error"></div>

                </td>
            </tr>
            <tr >
                <td >
                    <button type="submit">Đăng ký</button>
                </td>
                <td>
                Đã có tài khoản <i class="fa-solid fa-hand-point-right"></i>
                <button type="submit"><a href="login.php"> Đăng nhập</a></button>
                </td>
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


<script>
		Validator({
			selector: '.form-wrap',
			errorSelector: '.form-error',
			rules: [
				Validator.isEmail('#email'),
				Validator.minLength('#password', 8),
				Validator.confirmSelector('#confirm_password', function () {
					let form = document.querySelector('.form-wrap')
					return form.querySelector('#password')
				})
			],
			submit: (data) => {
				alert(JSON.stringify(data));
			}
		});
</script>
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
    form{
        margin-top: 100px;
    }
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
    .register{
    /* text-align: center; */
    margin-left: auto;
    margin-right: auto;
    margin-top: 50px;
    margin-bottom: 50px;
   border: none;
    max-width: 800px;
   
 }
 h2{
    text-align: center; 
     color: green;
     padding-bottom: 30px;
 }
 .register input{
     width:400px;
     height: 30px;
     border:none;
     border-radius: 3px;
 }
 .register label{
    text-align: left;
    max-width: 150px;
    float: left;
    padding-right: 10px;
    padding-bottom: 15px;
 }
 .register button{
    /* align-items:center; */
    /* justify-content: center; */
    /* text-align: center; */
    border-radius: 5px;
    border: none;
    padding: 10px 60px;
    background-color: rgba(0, 255, 183, 0.985);
    color: green;
    margin-right: 30px;
 }
 .register button:hover{
    background-color: rgba(0, 255, 115, 0.985);
    cursor: pointer;
    color: #000;
 }
 .register form{
    background-color: #fff;
    padding: 50px;
    box-shadow: 0 4px 6px rgba(0, 1, 0, 0.9);
    border-radius: 10px;
 }
 .notification {
            color: #fff;
            padding: 10px;
            margin: 10px;
            border-radius: 5px;
            position: absolute;
            top: 200px;
            right: 20px;
            background-color: #28a745; /* Màu xanh lá cho thông báo thành công */
        }
 .notification.error {
            background-color: #dc3545; /* Màu đỏ cho thông báo lỗi */
        }
</style>


<!-- -------------------------SCRIPT validator---------------------------- -->
 
</script>
</html>


