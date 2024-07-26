<html>
<head>
	<style>
		#cont{
			display:inline;
		
		}
		img{
			width:500px;
			height:500px;
			border:1px solid black;
}
	</style>
</head>
<?php
echo "<h1> gallery </h1>";
$d = dir(".");
echo "<div id=cont>";
while(false !== ($image = $d->read())){
	echo "<img src=" . $image . ">";
}
echo "</div>"
?>
</html>
