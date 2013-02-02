<?php $imageContents = file_get_contents('code.png');
header('Content-Type: image/png');
echo $imageContents;
?>