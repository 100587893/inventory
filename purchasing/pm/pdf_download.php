<?php
    session_start();
    if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true && $_SESSION['role'] == 'purchasing') {
        include("../../connect.php");
    } else {
        header("Location: C:/wamp64/www/index.php");
        exit();
    }

    $campus = $_GET['campus'];
    $id = $_GET['id'];

        if (isset($_GET['other'])) {
            $query = "SELECT location FROM purchase_orders WHERE id=$id;";
            $result = mysqli_query($conn, $query);
            $row = mysqli_fetch_assoc($result);

            $location = $row['location'];
            $filename = basename($location);

            header("Content-type: application/octet-stream");
            header("Content-Disposition: attachment; filename='$filename'");
            header("Content-Description: File Transfer");            
            header("Content-Length: " . filesize($location));

            flush();

            $fp = fopen($location, "r");

            while (!feof($fp)) {
                echo fread($fp, 65536);
                flush();
            }

            fclose($fp);
        }
?>