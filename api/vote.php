<?php
    include("connect.php");
    session_start();

    $votes = $_POST['gvotes'];
    $total_votes = $votes+1;

    $gid = $_POST['gid'];
    $uid = $_SESSION['userdata']['id'];

    $query1 = "UPDATE `user` SET votes = '$total_votes' WHERE id = '$gid'";
    $update_votes = mysqli_query($conn, $query1);

    $query2 = "UPDATE `user` SET status = 1 WHERE id = '$uid'";
    $update_user_status = mysqli_query($conn, $query2);

    if ($update_votes and $update_user_status) {

        $query3 = "SELECT id,name,votes,photo FROM `user` WHERE role=2";
        $groups = mysqli_query($conn, $query3);

        $groupsdata = mysqli_fetch_all($groups, MYSQLI_ASSOC);

        $_SESSION['userdata']['status'] = 1;
        $_SESSION['groupsdata'] = $groupsdata;

        echo '
            <script>
                alert("Voting Successful!");
                window.location="../routes/dashboard.php";
            </script>
            ';

    }else{
        echo '
            <script>
                alert("Some error occured!");
                window.location="../routes/dashboard.php";
            </script>
            ';
    }

?>