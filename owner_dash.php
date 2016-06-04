<?php

include('constants.php');

if($_SESSION['staffID'] == $admin){
     echo "
      <li><a href='new_event.php'>Event</a></li>
      <li><a href='new_bill.php'>Bill</a></li>
     ";
   }

?>
