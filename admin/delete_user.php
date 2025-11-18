<?php
include "../config/connection.php";

$id = $_GET["id"];
mysqli_query($link, "DELETE FROM users WHERE ID= $id");
?>

<script type="text/javascript">
    window.location="/SkillsHub/admin/usermgt.php"
</script>