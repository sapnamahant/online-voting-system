<?php
include("connect.php");
session_start();

$mobile = $_POST['mobile'];
$password = $_POST['password'];
$role = $_POST['role'];

$query = "SELECT * FROM `user` WHERE mobile = '$mobile' AND password = '$password' AND role = '$role'";
$check = mysqli_query($conn, $query);

if (mysqli_num_rows($check) > 0) {

    $userdata = mysqli_fetch_array($check);

    $groupquery = "SELECT * FROM `user` WHERE role = 2";

    $groups = mysqli_query($conn, $groupquery);
    $groupsdata = mysqli_fetch_all($groups, MYSQLI_ASSOC);

    $_SESSION['userdata'] = $userdata;
    $_SESSION['groupsdata'] = $groupsdata;

    echo '
    <script>
        window.location="../routes/dashboard.php";
    </script>
    ';
}
else {
    echo '
    <script>
        alert("Invalid Username or Password");
        window.location="../index.html";
    </script>
    ';
}

?>