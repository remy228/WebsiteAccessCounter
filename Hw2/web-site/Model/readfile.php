<?php

echo "Content-Type:Image/JPEG";

ob_clean(); 

header('Content-Type:Image/JPEG'); 
echo readfile($_GET['p1']);

?>
