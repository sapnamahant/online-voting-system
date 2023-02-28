<?php
session_start();
$userdata = $_SESSION['userdata'];
$groupsdata = $_SESSION['groupsdata'];

if ($userdata['status'] == 0) {
    $status = '<b style="color: red;">Not Voted</b>';
}
else{
    $status = '<b style="color: green;">Voted</b>';
}

if (!isset($_SESSION['userdata'])) {
    header("location: ../");    
}
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Online Voting System | Dashboard</title>
        <link rel="stylesheet" href="../css/style.css">
        <style>
            body{
                text-align: unset;
            }
            #header-section{
                text-align: center;
            }
        </style>
    </head>
    <body>
        <div id="main-section">

            <section id="header-section">
                <a href="../"><button id="back-btn">Back</button></a>
                <a href="logout.php"><button id="logout-btn">Logout</button></a>
                <h1>Online Voting System</h1>
            </section>

            <hr>

            <div id="main-panel">
                <section id="profile">
                    <img src="../uploads/<?php echo $userdata['photo']; ?>" height="100"><br><br>
                    <b>Name: </b> <?php echo $userdata['name']; ?> <br><br>
                    <b>Mobile: </b> <?php echo $userdata['mobile']; ?> <br><br>
                    <b>Address: </b> <?php echo $userdata['address']; ?> <br><br>
                    <b>Status: </b> <?php echo $status; ?>
                </section>
                <section id="groups">
                    <?php
                        if ($_SESSION['userdata']) {
                            for ($i=0; $i < count($groupsdata); $i++) { 
                                ?>
                                <div>
                                    <img src="../uploads/<?php echo $groupsdata[$i]['photo']; ?>" height="100"> <br><br>
                                    <b>Group Name: </b> <?php echo $groupsdata[$i]['name']; ?> <br><br>
                                    <b>Votes: </b> <?php echo $groupsdata[$i]['votes']; ?> <br><br>
                                    <form action="../api/vote.php" method="POST">
                                        <input type="hidden" name="gvotes" value="<?php echo $groupsdata[$i]['votes']; ?>">
                                        <input type="hidden" name="gid" value="<?php echo $groupsdata[$i]['id']; ?>">

                                        <?php
                                            if($_SESSION['userdata']['status']==0){
                                                ?>
                                                <input type="submit" name="vote-btn" id="vote-btn" value="Vote">
                                                <?php
                                            } else {
                                                ?>
                                                <button disabled type="submit" name="vote-btn" id="voted" >Voted</button>
                                                <?php
                                            }
                                        ?>
                                        
                                    </form>
                                </div>
                                <hr>
                                <?php
                            }
                        }
                    ?>
                </section>
            </div>
            
        </div>
    </body>
</html>