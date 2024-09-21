<?php
session_start();
error_reporting(0);
include('dbconnection.php');

if (isset($_POST['login'])) {
    $username = $_POST['username'];
    $password = md5($_POST['password']);

    // Prepare the SQL statement
    $sql = "SELECT * FROM tbladmin WHERE UserName = ? AND Password = ?";
    $stmt = $conn->prepare($sql); // Assuming $conn is your mysqli connection object
    $stmt->bind_param("ss", $username, $password);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $_SESSION['odmsaid'] = $row['ID'];
            $_SESSION['login'] = $row['UserName']; // Corrected to match the column name
            $_SESSION['permission'] = $row['AdminName'];
            $get = $row['Status'];
        }

        $aa = $_SESSION['odmsaid'];
        $sql = "SELECT * FROM tbladmin WHERE ID = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("i", $aa);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                if ($row['Status'] == "1") {
                    echo "<script type='text/javascript'> document.location ='dashboard.php'; </script>";
                } else {
                    echo "<script>
                        alert('Your account was disabled. Approach Admin');
                        document.location ='index.php';
                    </script>";
                }
            }
        }
    } else {
        echo "<script>alert('Invalid Details');</script>";
    }

    // Close the statement
    $stmt->close();
}
?>

<!DOCTYPE html>
<html lang="en">
<?php @include("includes/head.php");?>
<body>
    <div class="container-scroller">
        <div class="container-fluid page-body-wrapper full-page-wrapper">
            <div class="content-wrapper d-flex align-items-center auth">
                <div class="row flex-grow">
                    <div class="col-lg-4 mx-auto">
                        <div class="auth-form-light text-left p-5">
                            <div class="brand-logo" align="center">
                                <img class="img-avatar mb-3" src="companyimages/logo2.png" alt=""><br>
                                <h4 class="text-muted mt-4">
                                    Rock of Ages Total Events
                                </h4>
                            </div>
                            <form role="form" id=""  method="post" enctype="multipart/form-data" class="form-horizontal">  
                                <div class="form-group mb-3">
                                    <input type="text" class="form-control form-control-lg" name="username" id="exampleInputEmail1" placeholder="Username" required>
                                </div>
                                <div class="form-group mt-3">
                                    <input type="password" name="password" class="form-control form-control-lg" id="exampleInputPassword1" placeholder="Password" required>
                                </div>
                                <div class="mt-3">
                                    <button name="login" class="btn btn-block btn-gradient-primary btn-lg font-weight-medium auth-form-btn">SIGN IN</button>
                                </div>
                                <div class="text-center mt-4 font-weight-light"> 
                                    <a href="forgot_password.php" class="text-primary"> 
                                        Forgot Password
                                    </a>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <!-- content-wrapper ends -->
        </div>
        <!-- page-body-wrapper ends -->
    </div>
    <!-- container-scroller -->
    <?php @include("includes/foot.php");?>
    <!-- endinject -->
</body>
</html>