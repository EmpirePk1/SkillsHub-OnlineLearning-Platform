<?php
include "../config/connection.php";

$id = $_GET["id"];
mysqli_query($link, "DELETE FROM courses WHERE CourseID= $id");
?>

<script type="text/javascript">
    window.location="index.php";
</script>