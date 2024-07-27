<html>

<head>

	<style>
		
		img{
			width:15px;
			height:15px;
		}
		.thumb:hover{
			display: block;
			margin-left: auto;
			margin-right:auto;

			width:100px;
			height:100px;	
		}
		.big{
			width:300px;
			height:300px;
		}
		#file_list{
			padding:5px;
			margin-right:auto;
			border:1px solid black;
		}
		#images{
			text-align:center;
			display:inline;
			margin-right:auto;
			margin-left:auto;
		}
	</style>
</head>

<?php


$config = parse_ini_file("config.ini");

if(isset($config['background']) and isset($config['color'])){
	echo '<body style="background-color: ' . $config['background'] . '; color: ' . $config['color'] . ';">';
}

if(isset($config['banner'])){
	echo "<h1>" . $config['banner'] . "</h1>";
}
else{
	echo"<h1> banner </h1>";
}
echo "<hr>";
$d = dir(".");
echo "path: " . $d->path . "\n";
echo "<br>";


$files = [];
$sound_extensions = ['mp3', 'wav', 'ogg', 'm4a', 'flac'];
$image_extensions = ['png', 'webp', 'jpg', 'jpeg'];
echo '<div id=images>';
while(false !== ($entry = $d->read())){
	$ext = pathinfo($entry, PATHINFO_EXTENSION);
	if(in_array($ext, $image_extensions)){
		echo '<a href=' . $entry . '><img class=big src=' . $entry . '></a>';
	}
	array_push($files,$entry);
	//echo "<a href='{$entry}'>{$entry}</a><br>";
}
echo '</div>';
$d->close();

echo "<div id=file_list>";
foreach($files as $f){
	$ext = pathinfo($f, PATHINFO_EXTENSION);
	if(in_array($ext, $sound_extensions)){
		echo "<img src=../soundvor-3.png >";
	}
	elseif(in_array($ext, $image_extensions)){
		echo '<img class=thumb src=' . $f . '>';
	}
	if(is_dir($f)){
		echo "<img src=../directory_closed_cool-3.png >";
	}
	
			
	echo "<a href='{$f}'>{$f}</a><br>";
}
echo "</div>";
echo "</body>";
?>
</html>
