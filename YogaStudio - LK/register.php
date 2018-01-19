<?php
///Code below deals with submitting the regsitered form information into the database.
if (isset($_POST["name"])) {
    $register = insertApplications();
} else {
    $register = false;
}
?>
<!-- Code below deals with upon successfully registering a link appears to go back to the main Page -->
<!-- as well as containing the actual form code below with the different fields, their types etc. -->
<?php if ($register): ?>
<div class="success-block">
    Registration Complete, Please <a href="index.php?page=main">Go Back</a>
</div>
<?php else: ?>
    <div id="register-form">
        <form method="post" action="" id="reg-submit">
            <table>
                <tr><td colspan="2" align="right"><a href="index.php?page=main" class="go-back">Go Back</a></td></tr>
                <tr>
                    <td>Full Name</td>
                    <td><input type="text" name="name" class="input-style jq" /></td>
                </tr>
                <tr>
                    <td>Phone Number</td>
                    <td><input type="text" name="phone" class="input-style jq" /></td>
                </tr>
                <tr>
                    <td>Email</td>
                    <td><input type="text" name="email" class="input-style jq" /></td>
                </tr>
                <tr>
                    <td>Any Comments?</td>
                    <td><textarea name="comment" class="textarea-style"></textarea></td>
                </tr>
                <tr><td colspan="2"><div class="submit-form jq-click">Register for Class</div></td></tr>
            </table>
        </form>
    </div>
<?php endif; ?>
