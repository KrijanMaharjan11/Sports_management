<?php
require 'init.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $sportName = $_POST['sport_name'];


    $query = "INSERT INTO sports (s_name) VALUES ('$sportName')";
    $result = mysqli_query($conn, $query);

    if ($result) {

        header('Location: admin_sports.php');
        exit();
    } else {
        echo 'Error: ' . mysqli_error($conn);
    }
}
?>


<?php
$query = "SELECT * FROM sports";
$result = mysqli_query($conn, $query);
while ($row = mysqli_fetch_assoc($result)) {
    echo '<option value="' . $row['id'] . '">' . $row['name'] . '</option>';
}
?>
</select>
<input type="submit" value="Remove Sport">
</form>
</div>

<h2>Current Sports</h2>
<ul class="sports-list">
    <?php
    $query = "SELECT * FROM sports";
    $result = mysqli_query($conn, $query);
    while ($row = mysqli_fetch_assoc($result)) {
        echo '<li>' . $row['name'] . '</li>';
    }
    ?>
</ul>
</div>
</body>

</html> -->