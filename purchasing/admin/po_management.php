<?php
    session_start();
    if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true && $_SESSION['role'] == 'admin') {
        include("pm_topbar.php");
        include("..\..\connect.php");
        include("..\..\mailer.php");
    } else {
        header("Location: C:/wamp64/www/index.php");
        exit();
    }

    $campus = $_GET['campus'];

    if (isset($_GET['id'])) {
        $id = $_GET['id'];

        if (isset($_GET['email'])) {
            $query = "SELECT * FROM purchase_orders WHERE id=$id";
            $result = mysqli_query($conn, $query);
            $row = mysqli_fetch_assoc($result);

            $supplier = $row['supplier'];
            $requester = $row['requester'];
            $loc = $row['location'];

            $query = "SELECT name, email FROM suppliers WHERE name='$supplier';";
            $result = mysqli_query($conn, $query);
            $row = mysqli_fetch_assoc($result);

            $email = $row['email'];
            $name = $row['name'];

            $mail->addAddress($email, $name);
            $mail->isHTML(true);
            $mail->Subject = "Purchasing - Order Update";
            $mail->Body = "<i>Please see attached, thanks.<i>";
            $mail->AltBody = "Please see attached, thanks.";
            $mail->addAttachment($loc);

            try {
                $mail->send();
            } catch (Exception $e) {
                echo $e;
            }

            $query = "SELECT fullname, email FROM user WHERE fullname='$requester';";
            $result = mysqli_query($conn, $query);
            $row = mysqli_fetch_assoc($result);

            $email = $row['email'];
            $name = $row['fullname'];

            $mail->addAddress($email, $name);
            $mail->isHTML(true);
            $mail->Subject = "Purchasing - Order Update";
            $mail->Body = "<i>Your order has been processed and is on the way.<i>";
            $mail->AltBody = "Your order has been processed and is on the way.";

            try {
                $mail->send();
            } catch (Exception $e) {
                echo $e;
            }

            $query = "UPDATE purchase_orders SET status='ordered' WHERE id=$id;";
            mysqli_query($conn, $query);

            $query = "UPDATE requests SET status='ordered' WHERE po_number=$id;";
            mysqli_query($conn, $query);
        }
        elseif (isset($_GET['other'])) {
            $query = "SELECT supplier, requester FROM purchase_orders WHERE id=$id;";
            $result = mysqli_query($conn, $query);
            $row = mysqli_fetch_assoc($result);

            $supplier = $row['supplier'];
            $requester = $row['requester'];

            $query = "SELECT fullname, email FROM user WHERE fullname='$requester';";
            $result = mysqli_query($conn, $query);
            $row = mysqli_fetch_assoc($result);

            $email = $row['email'];
            $name = $row['fullname'];

            $mail->addAddress($email, $name);
            $mail->isHTML(true);
            $mail->Subject = "Purchasing - Order Update";
            $mail->Body = "<i>Your order has been processed and is on the way.<i>";
            $mail->AltBody = "Your order has been processed and is on the way.";

            try {
                $mail->send();
            } catch (Exception $e) {
                echo "error";
            }
            
            $query = "UPDATE purchase_orders SET status='ordered' WHERE id=$id;";
            mysqli_query($conn, $query);

            $query = "UPDATE requests SET status='ordered' WHERE po_number=$id;";
            mysqli_query($conn, $query);
        }
    }

    $query = "SELECT * FROM purchase_orders WHERE campus='$campus' and (status='approved' OR status='ordered') ORDER BY status;";
    $result = mysqli_query($conn, $query);
?>

<html>
    <head>
        <title>Purchase Order Management</title>

        <style>
            table {
                width: 100%;
            }
            th{
                height: 50px;
                background: #006;
                color: #FFF;
                font-size: 20px;
                font-family: Tahoma, Geneva, sans-serif;
            }
            table, th, td {
                border: 1px solid black;
                text-align:center;
            }
            .outside{
                font-size: 40px;
                color: Black;
                font-family: Tahoma, Geneva, sans-serif;
                text-align:center;
            }
        </style>
    </head>

    <body>
        <br>
        <br>
        <h2 class="outside">Purchase Orders</h2>
        <br>
        <br>
        
        <div class="container">
            <?php
                if (mysqli_num_rows($result) == 0) {
                    echo "<h5>There are no active orders at this time</h5>";
                }
                else {
                    ?>

                    <table>
                        <tr>
                            <th>PO Number</th>
                            <th>Location</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>

                        <?php 
                            while ($row = mysqli_fetch_assoc($result)) {
                                $id = $row['id'];
                                echo "  <tr>
                                            <td>" .$row['id']. "</td>
                                            <td>" .$row['location']. "</td>
                                            <td>" .$row['status']. "</td>
                                            <td>";
                                if ($row['status'] == 'approved') {
                                    echo "      <a href='po_management.php?campus=$campus&email=true&id=$id' style='width: 50%'><button type='button'>Email</button></a>
                                                <a href='po_management.php?campus=$campus&other=true&id=$id' style='width: 50%'><button type='button'>Other</button></a>";
                                }
                                            "</td>
                                        </tr>";
                            }
                        ?>

                    </table>

                    <?php
                }
            ?>
        </div>
  </body>
</html>