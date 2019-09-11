<?php
// session_start();
if(isset($_GET['logout']))
{
    session_start() ;
    $_SESSION = array();
    session_destroy();
    // header("Location:/index.html");
    header("Location:../signin/index.html");
}
?>