<?php
session_start();
session_destroy();

echo "
<script>window.open('../admin/index.php', '_self')</script>
";
?>