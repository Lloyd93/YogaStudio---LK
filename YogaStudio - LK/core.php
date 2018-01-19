<?php
///Contains the bulk of the mysql code.
///Creation of connection to the specific database as well as fetching the classes.
function connection() {
    $mysqli = new mysqli('localhost', 'root', '', 'yoga');
    if ($mysqli->connect_errno) {
        die('Could not coonect to database');
    }
    return $mysqli;
}

$conn = connection();
$GLOBALS["conn"] = $conn;

function getClasses() {
    $return = array();
    $query = $GLOBALS["conn"]->query('SELECT * FROM classes ORDER BY unix DESC');
    while ($row = $query->fetch_assoc()) {
        $return[] = $row;
    }
    return $return;
}
///Inserts the persons information that is registering for a particular class into database.
function insertApplications() {
    $GLOBALS["conn"]->query(
            'INSERT INTO applications SET
                `course-id` = "' . $GLOBALS["conn"]->real_escape_string($_GET["id"]) . '",
                `name` = "' . $GLOBALS["conn"]->real_escape_string($_POST["name"]) . '",
                `phone` = "' . $GLOBALS["conn"]->real_escape_string($_POST["phone"]) . '",
                `email` = "' . $GLOBALS["conn"]->real_escape_string($_POST["email"]) . '",
                `comment` = "' . $GLOBALS["conn"]->real_escape_string($_POST["comment"]) . '"
            ');
    $GLOBALS["conn"]->query('UPDATE  classes SET `applicants` = `applicants` + 1 WHERE `id` = "' . $GLOBALS["conn"]->real_escape_string($_GET["id"]) . '" ');
    checkFull();
    return true;
}
///Checks if class is full.
function checkFull() {
    $query = $GLOBALS["conn"]->query('SELECT * FROM classes WHERE `id` = "' . $GLOBALS["conn"]->real_escape_string($_GET["id"]) . '" ');
    $info = $query->fetch_array();
    if ($info["applicants"] == $info["maximum"]) {
        $GLOBALS["conn"]->query('UPDATE  classes SET `full` = 1 WHERE `id` = "' . $GLOBALS["conn"]->real_escape_string($_GET["id"]) . '" ');
    }
    return true;
}
///Delete function for each class.
function delete() {
    $GLOBALS["conn"]->query('DELETE FROM classes WHERE `id` = "' . $GLOBALS["conn"]->real_escape_string($_GET["id"]) . '" ');
    header("location: index.php?page=admin");
}
///Mark function allowing for class to be marked as full.
function mark() {
    $GLOBALS["conn"]->query('UPDATE  classes SET `full` = 1 WHERE `id` = "' . $GLOBALS["conn"]->real_escape_string($_GET["id"]) . '" ');
    header("location: index.php?page=admin");
}
///Function for adding a class with its information
function addClass() {
    $GLOBALS["conn"]->query(
            'INSERT INTO classes SET
                `instructor` = "' . $GLOBALS["conn"]->real_escape_string($_POST["instructor"]) . '",
                `style` = "' . $GLOBALS["conn"]->real_escape_string($_POST["style"]) . '",
                `duration` = "' . $GLOBALS["conn"]->real_escape_string($_POST["duration"]) . '",
                `maximum` = "' . $GLOBALS["conn"]->real_escape_string($_POST["maximum"]) . '",
                `date` = "' . $GLOBALS["conn"]->real_escape_string($_POST["date"]) . '",
                `time` = "' . $GLOBALS["conn"]->real_escape_string($_POST["time"]) . '",
                `unix` = "' . strtotime($_POST["date"] . " " . $_POST["time"]) . '"
            ');
    return true;
}

?>
