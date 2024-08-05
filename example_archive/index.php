<html>

<head>
    <style>
        img {
            width: 15px;
            height: 15px;
        }

        .thumb:hover {
            display: block;
            margin-left: auto;
            margin-right: auto;
            width: 100px;
            height: 100px;
        }

        .big {
            width: 300px;
            height: 300px;
        }

        #file_list {
            padding: 5px;
            margin-right: auto;
	    border: 1px solid black;
	    width:75vh;
	    float:left;
        }

        #images {
            text-align: center;
	    display: inline;
	    margin-right:auto;
        }

        #audio_play {
            margin-top: 20px;
	    text-align: center;
	    margin-left: auto;
        }

        #current_track {
            margin-top: 10px;
	    font-weight: bold;
	    margin-left:auto;
	    text-align:center;
        }
    </style>
<?php
echo "<title> " . basename(__DIR__) . "</title>";
?>
</head>

<body>

<?php


echo "<h1>" . basename(__DIR__) . "</h1>";
echo "<hr>";
$d = dir(".");
echo "path: " . $d->path . "\n";
echo "<br>";

$files = [];
$sound_files = [];
$sound_extensions = ['mp3', 'wav', 'ogg', 'm4a', 'flac'];
$image_extensions = ['png', 'webp', 'jpg', 'jpeg'];
echo '<div id="images">';

$iterator = new RecursiveIteratorIterator(
	new RecursiveDirectoryIterator('.',RecursiveDirectoryIterator::SKIP_DOTS));

foreach($iterator as $file){
	if($file->isFile()){
		//$files = $file->getPathname();
		$ext = pathinfo($file, PATHINFO_EXTENSION);
   	 	if (in_array($ext, $image_extensions)) {
        		echo '<a href=' . $file . '><img class="big" src=' . $file . '></a>';
		}
		else{
    			if (in_array($ext, $sound_extensions)) {
				$sound_files[] = $file->getPathname();
				
			}
		array_push($files ,$file->getPathname());
		}
	}
}

echo '</div>';
//sort($files);
echo "<div id='file_list'>";

foreach($sound_files as $song){
	echo "<a href='" . $song . "'> " . $song . "</a> <button class='swap' data-src= '" . $song . "'>select</button> <br> ";
}

echo "</div>";

?>
<div id=audio_play>
	<audio id="audio" src="01. Duvet.flac"></audio>
	<button id="play">Play</button>
	<button id="stop">Stop</button>
</div>
<script>
	document.addEventListener('DOMContentLoaded', (event) => {
	const audio = document.getElementById('audio');
	const play = document.getElementById('play');
	const stop = document.getElementById('stop');
	const swap = document.querySelectorAll('.swap');
	play.addEventListener('click', () =>{
		audio.play();
	});

	stop.addEventListener('click', () => {
		audio.pause();
	});

	swap.forEach(button => {
        button.addEventListener('click', () => {
            const newSrc = button.getAttribute('data-src');
            audio.src = newSrc;
            audio.play();
        });
    });

});

</script>


</body>
</html>
