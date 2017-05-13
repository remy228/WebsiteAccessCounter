<?php
header('Content-Type:text/html'); 
echo "Content-Type:text/html";
ob_clean(); 
echo readfile($_GET['p1']);
?>