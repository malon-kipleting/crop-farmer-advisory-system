<!DOCTYPE html>
<html>

<head>

    <title>Admin | Log In</title>
    <?php
include './components/header.php';
?>

</head>

<body>

    <div id="container">
        <div class="w3-green p-3 mb-3">
            <h2><b>
                    <center>Crop Farmer's Advisory System<center>
                </b></h2>
            <p><b>
        </div>


        <div class="row">
            <div class="col-md-4"></div>
            <div class="col-md-4 border border-info rounded p-4 mt-3">
                <h1 class="text-center">Admin Login</h1>
                <form action="connection.php" method="POST">
                    <div class="form-group">
                        <label for="exampleInputEmail1">Username</label>
                        <input type="text" class="form-control" name="admin_email" id="exampleInputEmail1"
                            aria-describedby="emailHelp" placeholder="Enter username" required>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputPassword1">Password</label>
                        <input type="password" name="admin_password" class="form-control" id="exampleInputPassword1"
                            placeholder="Password" required>
                    </div>
                    <input type="submit" class="btn btn-primary btn-block" name="admin_login_btn" value="Log In" />
                </form>
            </div>
            <div class="col-md-4"></div>
        </div>

        <div id="footer" class=" w3-center w3-bottom w3-green" style="padding:10px">
            Crop Farmer's Advisory System: Copyright &copy; 2023
        </div>


</body>

</html>