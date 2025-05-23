<?php
    //Khai báo sử dụng session
    session_start();
    //Khai báo utf-8 để hiển thị được tiếng việt
    header('Content-Type: text/html; charset=UTF-8');
    //Xử lý đăng nhập
    if (isset($_POST['submit']))
    {
        //Kết nối tới database
        include('connection.php');
        
        //Lấy dữ liệu nhập vào
        $username = addslashes($_POST['hoten']);
        $password = addslashes($_POST['password']);
        
        //Kiểm tra đã nhập đủ tên đăng nhập với mật khẩu chưa
        if (!$username || !$password) {
        echo "Vui lòng nhập đầy đủ tên đăng nhập và mật khẩu. <a href='javascript: history.go(-1)'>Trở lại</a>";
        exit;
        }
        
        // mã hóa pasword
        $password = md5($password);
        
        //Kiểm tra tên đăng nhập có tồn tại không
        $query = "SELECT username, password FROM registered_users WHERE username='$username'";
        $result = mysqli_query($connect, $query) or die( mysqli_error($connect));

        if (!$result) {
        echo "Tên đăng nhập hoặc mật khẩu không đúng!";
        } else {
            header( 'location: http://localhost:82/%c4%90%e1%bb%92%20%c3%81N%20CU%e1%bb%90I%20K%c3%8c/');
            echo "Đăng nhập thành công!";
        }
        
        //Lấy mật khẩu trong database ra
        $row = mysqli_fetch_array($result);
        
        //So sánh 2 mật khẩu có trùng khớp hay không
        if ($password != $row['password']) {
        echo "Mật khẩu không đúng. Vui lòng nhập lại. <a href='javascript: history.go(-1)'>Trở lại</a>";
        exit;
        }
        
        //Lưu tên đăng nhập
        $_SESSION['username'] = $username;
        echo "Xin chào <b>" .$username . "</b>. Bạn đã đăng nhập thành công. <a href=''>Thoát</a>";
        die();
        $connect->close();
    }
?>