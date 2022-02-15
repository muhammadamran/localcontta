<?php
$to_email = 'joko.afandi15@gmail.com';
$subject = 'Testing PHP Mail';
$message = 'This mail is sent using the PHP mail';
$headers = 'From: noreply@kn-idcore.ap.win.int.kn';
mail("joko.afandi15@gmail.com",$subject,$message,$headers);
?>