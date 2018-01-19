<?php
///Contains the code for the creation of a yoga class and its submission into the database
///as well as then displaying it on the main page as well as in the admins list of classes on the admin page.
if (isset($_POST["addclass"])) {
    $addClass = addClass();
} else {
    $addClass = false;
}
?>
<!-- Code contains what the class creation form is consisted of, what information can be added for each class etc. -->
<?php if ($addClass): ?>
    <div class="success-block">
        Class added, please <a href="index.php?page=create">go back</a>
    </div>
<?php else: ?>
    <div id="register-form">
        <form method="post" action="" id="reg-submit">
            <table>
                <tr><td colspan="2" align="right"><a href="index.php?page=admin" class="go-back">Go Back</a></td></tr>
                <tr>
                    <td>Instructor</td>
                    <td><input type="text" name="instructor" class="input-style jq" /></td>
                </tr>
                <tr>
                    <td>Style</td>
                    <td><input type="text" name="style" class="input-style jq" /></td>
                </tr>
                <tr>
                    <td>Class Duration</td>
                    <td>
                        <select name="duration" class="input-style">
                            <option value="30">30</option>
                            <option value="60">60</option>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td>Maximum Class Size</td>
                    <td><input type="text" name="maximum" class="input-style jq" /></td>
                </tr>
                <tr>
                    <td>Date</td>
                    <td><input type="date" name="date" class="input-style jq" /></td>
                </tr>
                <tr>
                    <td>Time</td>
                    <td><input type="time" name="time" class="input-style jq" /></td>
                </tr>

                <tr><td colspan="2"><input type="submit" name="addclass" class="submit-form" value="Add"></td></tr>
            </table>
        </form>
    </div>
<?php endif; ?>
