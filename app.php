<?php
    session_start();
    if (!isset($_SESSION['user'])) {
        header("Location: login.php");
    }
?>
<!DOCTYPE html>
<html>
<head>
    <title>Fuel App</title>
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
    <h2>Fuel App</h2>
    <hr>
         Welcome, <?php echo $_SESSION['user']; ?> | <a href="logout.php">Logout here !</a>
    <hr>
    <form action='app.php' method="post">

        <label>Vehicle Number</label>
        <input type="text" name="vehicleNum" placeholder="Vehicle Number" class="form-control" >

        <label>Fuel</label>
        <input type="number" name="fuel" placeholder="Fuel Amount" class="form-control" min="0" max="100">

        <input type="submit" value="Submit" class="btn">      
    </form>
    <?php
         if (empty($_POST['vehicleNum'])) {
            echo "<p style='color: red;'>Please Provide the Vehicle Number !</p>";
        }
        if (empty($_POST['fuel'])) {
            echo "<p style='color: red;'>Please Provide the fuel capacity !</p>";
        }

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            include 'dbconfig.php'; 
        
            $vehicleNumber = $_POST['vehicleNum'];
            $fuelAmt = $_POST['fuel'];
        
            if (!empty($vehicleNumber) && !empty($fuelAmt)) {
               
                $sql = "SELECT vt.Fuel_limit 
                        FROM vehicle_info vi 
                        JOIN vehicle_types vt ON vi.vehicle_type = vt.Type 
                        WHERE vi.vehicle_no = '$vehicleNumber'";
        
                $result = $conn->query($sql);
        
                if ($result->num_rows > 0) {
                    $row = $result->fetch_assoc();
                    $fuelLimit = $row['Fuel_limit'];
        
                    if ($fuelAmt <= $fuelLimit) {
                        echo "<p style='color: green;'>Success</p>";
                        $nextDateSql = "SELECT next_date FROM fuel_log WHERE vehicle_no = '$vehicleNumber' ORDER BY next_date DESC LIMIT 1";
                        $nextDateResult = $conn->query($nextDateSql);
                        if ($nextDateResult->num_rows > 0) {
                            $nextDateRow = $nextDateResult->fetch_assoc();
                            $nextDate = $nextDateRow['next_date'];
                            echo "<p>Next Date for Fuel: " . htmlspecialchars($nextDate) . "</p>";
                        } else {
                            echo "<p style='color: red;'>No fuel log record found for this vehicle.</p>";
                        }

                    } else {
                        echo "<p style='color: red;'>Exceed the fuel limit</p>";
                    }
                } else {
                    echo "<script>alert('Vehicle number not found'); window.location.href='home.php';</script>";
                }
            } else {
                echo "<script>alert('Error'); window.location.href='home.php';</script>";
            }
        
            $conn->close();
        }
    ?>
</div>
</body>
</html>
