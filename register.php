<?php
session_start();
include('dbconnect.php');

//Session Store
$_SESSION["id"] = $_POST["id"];
$_SESSION["name"] = $_POST["name"];
$_SESSION["gender"] = $_POST["gender"];
$_SESSION["date"] = $_POST["date"];
$_SESSION["club"] = $_POST["club"];
$_SESSION["dept"] = $_POST["dept"];
$_SESSION["admit"] = $_POST["admit"];
$_SESSION["credit"] = $_POST["credit"];
$_SESSION["contacts"] = explode(', ', $_POST["contacts"]);
$_SESSION["email"] = $_POST["email"];
$_SESSION["password"] = $_POST["password"];
$check = $_POST["confirm"];


//For Usage
$id = $_SESSION["id"];
$name = $_SESSION["name"];
$gender = $_SESSION["gender"];
$date = $_SESSION["date"];
$club = $_SESSION["club"];
$dept = $_SESSION["dept"];
$admit = $_SESSION["admit"];
$credit = $_SESSION["credit"];
$contacts = $_SESSION["contacts"];
$email = $_SESSION["email"];
$password = $_SESSION["password"];


//Request Check
$sql1 = "SELECT Member_ID, Email FROM unregistered_member WHERE Member_ID = $id AND Email = '$email'";
$sql2 = "SELECT Member_ID FROM tmember_contact WHERE Member_ID = $id";
$rows1 = mysqli_query($conn, $sql1);
$rows2 = mysqli_query($conn, $sql2);

if (mysqli_num_rows($rows1) != 0 || mysqli_num_rows($rows2) != 0) {
    header('Location: signup.php?error=Request Has Already Been Sent');
    exit();
}

//Member Check
$sql = "SELECT Member_ID FROM registered_member WHERE Member_ID = $id";
$rows = mysqli_query($conn, $sql);
if (mysqli_num_rows($rows) != 0) {
    header('Location: signup.php?error=Member Already Exists');
    exit();
}

//Email Check
$tables = array('advisor', 'department', 'oca', 'registered_member', 'unregistered_member', 'verified_sponsor');
foreach($tables as $table){
    $sql = "SELECT Email FROM $table WHERE Email = '$email'";
    $rows = mysqli_query($conn, $sql);
    if (mysqli_num_rows($rows) != 0) {
        header('Location: signup.php?error=Email Already Exists');
        exit();
    }
}

//Contacts Check
$tables = array('advisor_contact', 'member_contact', 'oca_contact', 'sponsor_contact');
foreach($tables as $table){
    foreach($contacts as $contact){
        $sql = "SELECT Contact FROM $table WHERE Contact = '$contact'";
        $rows = mysqli_query($conn, $sql);
        if (mysqli_num_rows($rows) != 0) {
            header('Location: signup.php?error=Contact Already Exists');
            exit();
        }
    }
}

//Confirm Check
if ($password != $check) {
    header('Location: signup.php?error=Password Mismatch');
    exit();
}

//Insertion
$sql1 = "INSERT INTO unregistered_member Values($id, '$name', '$gender', '$date', '$dept', '$admit', '$credit', '$email', $password)";
$rows1 = mysqli_query($conn, $sql1);

foreach($contacts as $contact){
    $sql2 = "INSERT INTO tmember_contact Values($id, '$contact')";
    $rows2 = mysqli_query($conn, $sql2);
}

$sql3 = "SELECT p.Panel_ID FROM moderate p, registered_member m WHERE p.Panel_ID = m.Member_ID AND m.Club = '$club'";
$rows3 = mysqli_query($conn, $sql3);
while ($row = mysqli_fetch_assoc($rows3)) {
    $pid = $row['Panel_ID'];
    $rqst = date("Y-m-d");

    $sql4 = "INSERT INTO request_membership Values($id, $pid, '$club', '$rqst')";
    $rows4 = mysqli_query($conn, $sql4);
}

header('Location: login.php?mssg=Request Sent Successfully');
exit();
?>
