<?php
if(isset($_POST['logout']))
{
    echo "logout";
}
if( array_key_exists( 'logout', $_POST ) )
{
  // handle tea
  echo "USERLOGOUT";
}
?>