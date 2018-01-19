<?php
///If statement for the admins login information as well as the controls for what the admin can do.
if (isset($_POST["login"])) {
    $query = $GLOBALS["conn"]->query('SELECT * FROM admins WHERE
            `username` = "' . $GLOBALS["conn"]->real_escape_string($_POST["username"]) . '" AND
            `password` = "' . $GLOBALS["conn"]->real_escape_string(md5($_POST["password"])) . '"
            ');
    $info = $query->fetch_array();
    if ($info) {
        $_SESSION["logged"] = true;
    }
}
if (isset($_POST["Logout"])) {
    $_SESSION["logged"] = false;
}



?>

<!-- Code consists of if statement for admin if admin logged in then the table of classes is displayed and the information for each one, as well as button for creating a class, -->
<!-- viewing the main page, marking a class as full or deleting a class from the list.  -->
<?php if (isset($_SESSION["logged"]) && $_SESSION["logged"]): ?>
    <table border="1" cellpadding="0" cellspacing="0" class="admin-table">
        <tr>
            <td colspan="9"><a href="index.php?page=create">Create Class</a> / <a href="index.php?page=main">Main Page</a></td>
            <td>
                <form method="post" action="">
                    <input type="submit" name="Logout" value="Logout"/>
                </form>
            </td>
        </tr>
        <tr>
            <td>Yoga Style</td>
            <td>Instructor</td>
            <td>Duration</td>
            <td>Maximum Class Size</td>
            <td>Full</td>
            <td>Applicants</td>
            <td>Date</td>
            <td>Time</td>
            <td>Action</td>
            <td>Mark</td>
        </tr>
        <?php foreach ($classes as $keyClasses => $valueClasses) : ?>
            <tr>
                <td><?php echo $valueClasses["style"]; ?></td>
                <td><?php echo $valueClasses["instructor"]; ?></td>
                <td><?php echo $valueClasses["duration"]; ?></td>
                <td><?php echo $valueClasses["maximum"]; ?></td>
                <td><?php echo $valueClasses["full"]; ?></td>
                <td><?php echo $valueClasses["applicants"]; ?></td>
                <td><?php echo $valueClasses["date"]; ?></td>
                <td><?php echo $valueClasses["time"]; ?></td>
                <td><a href="index.php?page=delete&id=<?php echo $valueClasses["id"]; ?>">Delete Class</a></td>
                <td><a href="index.php?page=mark&id=<?php echo $valueClasses["id"]; ?>">Mark Full</a></td>
            </tr>
        <?php endforeach; ?>
    </table>
<?php else: ?>
    <form method="post" action="">
        <input type="text" name="username" placeholder="Admin Name" class="input-style" />
        <input type="password" name="password" placeholder="Password" class="input-style" />
        <input type="submit" name="login" value="Log In" />
    </form>
<?php endif; ?>
