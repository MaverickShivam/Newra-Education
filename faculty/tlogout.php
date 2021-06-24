<?php
session_start();
function logout()
{
    session_unset();
    session_destroy();
}
logout();
?>
<script>
    localStorage.clear();
    window.open("teachermenu.php","_self");
</script>