<?php
session_start();
unset( $_SESSION['access_token'] );
unset( $_SESSION['fb_state'] );


  header('Location: http://www.virtualrival.mainsusl.com');

 ?>
