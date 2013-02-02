<?php
$file = 'leaderBoard.txt';
$current = file_get_contents($file);
if (isset($_POST['uName']) and trim($_POST['uName']) != '' ) {
	$current = trim($_POST['uName']); 
}
file_put_contents($file, $current);
echo "".$current."";
?>