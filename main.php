<?php
require('./conn.php');

if (isset($_GET['c'])) {
    $c = $_GET['c'];

    if ($c == 'login') {
        $Username = $_GET['Username'];
        $Password = $_GET['Password'];
        $Enc = sha1($Password);

        $sql = "SELECT * FROM users WHERE Username = '$Username'";

        $result = $conn->query($sql)->fetch_assoc();

        if ($result) {
            if ($Enc === $result['Enc']) {
                $rest = array(
                    "Status" => 200,
                    "Message" => "Login success",
                    "User_Data" => array(
                        "ID" => $result['ID'],
                        "Username" => $result['Username'],
                        "Password" => $result['Password'],
                        "Enc" => $result['Enc']
                    )
                );

                echo json_encode($rest);
            } else {
                $rest = array(
                    "Status" => 200,
                    "Message" => "Login error: password not correct"
                );

                echo json_encode($rest);
            }
        } else {
            $rest = array(
                "Status" => 400,
                "Message" => "Login Error: not found username"
            );

            echo json_encode($rest);
        }
    }

    if ($c === 'register') {
        $Username = $_GET['Username'];
        $Password = $_GET['Password'];
        $Enc = sha1($Password);

        $sqlSelect = "SELECT * FROM users WHERE Username = '$Username'";

        $resultSelect = $conn->query($sqlSelect)->fetch_assoc();

        if ($resultSelect) {
            $rest = array(
                "Status" => 401,
                "Message" => "Register Error: username used"
            );

            echo json_encode($rest);
        } else {
            $sql = "INSERT INTO `users`(`Username`, `Password`, `Enc`) VALUES ('$Username','$Password','$Enc')";

            $result = $conn->query($sql);

            if ($result) {
                $rest = array(
                    "Status" => 200,
                    "Message" => "Register success"
                );

                echo json_encode($rest);
            } else {
                $rest = array(
                    "Status" => 500,
                    "Message" => "Register Error: server error"
                );

                echo json_encode($rest);
            }
        }
    }
}

?>