<?php
    session_start();
    if (!isset($_SESSION['user'])) {
        header("Location: login.php");
    }
?>

<?php
include 'dbconfig.php';
$vehicleTypes = [];
$query = "SELECT Type FROM vehicle_types";
$result = $conn->query($query);

if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        $vehicleTypes[] = $row['Type'];
    }
}
//$conn->close();
?>

<!DOCTYPE html>
<html>
<head>
    <title>Home Page</title>
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
    <h2>Add New Vehicle</h2>
    <hr>
    Welcome, <?php echo $_SESSION['user']; ?> | <a href="logout.php">Logout here !</a>
    <hr>
    <form action='home.php' method="post">
        <label>Vehicle Number</label>
        <input type="text" name="vehicleNum" placeholder="Vehicle Number" class="form-control"  required>

        <label>Owner Name</label>
        <input type="text" name="owner" placeholder="Owner Name" class="form-control">

        <label>Vehicle Type</label>
        <select name="vehicle_type" class="form-control">
            <option>---Select vehicle type---</option>
            <?php foreach ($vehicleTypes as $type): ?>
                <option value="<?php echo $type; ?>"><?php echo $type; ?></option>
            <?php endforeach; ?>
        </select>

        <input type="submit" value="Add" class="btn">   
    </form>
    <?php
        if (empty($_POST['vehicleNum'])) {
            echo "<p style='color: red;'>Please Provide the Vehicle Number !</p>";
        }
        if (empty($_POST['owner'])) {
            echo "<p style='color: red;'>Please Provide the Name !</p>";
        }
        if (empty($_POST['vehicle_type'])) {
            echo "<p style='color: red;'>Please Provide the Vehicle Type !</p>";
        }

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    
            $vehicleNumber = $_POST['vehicleNum'];
            $owner = $_POST['owner'];
            $type = $_POST['vehicle_type'];

            $checkTypeSql = "SELECT Type FROM vehicle_types WHERE Type = '$type'";
            $typeResult = $conn->query($checkTypeSql);
        
            if ($typeResult->num_rows > 0) {
                $sql = "INSERT INTO vehicle_info VALUES ('$vehicleNumber', '$type', '$owner')";
        
                if ($conn->query($sql) === TRUE) {
                    header('Location: app.php');
                    exit();
                } else {
                    echo "<script>alert('Error: " . $conn->error . "'); window.location.href='home.php';</script>";
                    exit();
                }
            } else {
                echo "<script>alert('Vehicle type not found'); window.location.href='home.php';</script>";
                exit();
            }
        }
    
    ?>
</div>
</body>
</html>
