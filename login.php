<!DOCTYPE html>
<html>
<head>
    <title>Login Page</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }

        .login-box {
            background-color: #fff;
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            width: 300px;
        }

        h2 {
            text-align: center;
            margin-bottom: 20px;
            color: #333;
        }

        .form-control {
            width: 100%;
            padding: 10px;
            margin-bottom: 10px;
            border-radius: 5px;
            border: 1px solid #ddd;
        }
       
        .btn {
            width: 100%;
            padding: 10px;
            border: none;
            border-radius: 5px;
            color: #fff;
            background-color: #007bff;
            cursor: pointer;
            margin-bottom: 10px;
        }

        .btn:hover {
            background-color: #0056b3;
        }

        .btn-reset {
            background-color: #6c757d;
        }

        .btn-reset:hover {
            background-color: #5a6268;
        }
    </style>
</head>
<body>

<div class="login-box">
    <h2>Login</h2>
    <form action='login.php' method="post">
        <input type="text" name="username"  placeholder="Username" class="form-control" required>
        <input type="password" name="password" placeholder="Password" class="form-control" required>
        <input type="submit" value="Submit" class="btn">
        <input type="reset" value="Reset" class="btn btn-reset">
    </form>
</div>
    <?php
        session_start();
        include 'dbconfig.php';

        if ($_SERVER['REQUEST_METHOD']=='POST') {
            
            $usr=$_POST['username'];
            $pass=$_POST['password'];

            $sql = "SELECT * FROM logintb WHERE username = '$usr' AND password = '$pass'";
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                $_SESSION['user'] = $usr;
                header("Location: home.php");
                exit();
            } else {
                echo "<script>alert('Invalid username or password');</script>";
                //echo "<p>Invalid </p>";
            }
        }
    ?>

</body>
</html>
