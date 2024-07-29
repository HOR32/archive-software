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

        #audio_controls {
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
$config = parse_ini_file("config.ini");

if (isset($config['background']) && isset($config['color'])) {
    echo '<body style="background-color: ' . $config['background'] . '; color: ' . $config['color'] . ';">';
}

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
while (false !== ($entry = $d->read())) {
    $ext = pathinfo($entry, PATHINFO_EXTENSION);
    if (in_array($ext, $image_extensions)) {
        echo '<a href=' . $entry . '><img class="big" src=' . $entry . '></a>';
    }
    if (in_array($ext, $sound_extensions)) {
        $sound_files[] = $entry;
    }
    $files[] = $entry;
}
echo '</div>';
$d->close();

echo "<div id='file_list'>";
foreach ($files as $f) {
    $ext = pathinfo($f, PATHINFO_EXTENSION);
    if (in_array($ext, $sound_extensions)) {
        echo "<img src='../soundvor-3.png'>";
    } elseif (in_array($ext, $image_extensions)) {
        echo '<img class="thumb" src=' . $f . '>';
    }
    if (is_dir($f)) {
        echo "<img src='../directory_closed_cool-3.png'>";
    }

    echo "<a href='{$f}'>{$f}</a><br>";
}
echo "</div>";

?>

<div id="audio_controls">
    <audio id="audio_player" controls>
        <source id="audio_source" src="" type="audio/mpeg">
        Your browser does not support the audio element.
    </audio>
    <br>
    <button onclick="prevTrack()">Previous</button>
    <button onclick="nextTrack()">Next</button>
    <div id="current_track">No track loaded</div>
</div>

<script>
    var soundFiles = <?php echo json_encode($sound_files); ?>;
    var currentTrack = 0;

    function loadTrack(trackIndex) {
        var player = document.getElementById('audio_player');
        var source = document.getElementById('audio_source');
        var trackDisplay = document.getElementById('current_track');
        source.src = soundFiles[trackIndex];
        trackDisplay.innerHTML = 'Now Playing: ' + soundFiles[trackIndex];
        player.load();
        player.play();
    }

    function prevTrack() {
        currentTrack = (currentTrack > 0) ? currentTrack - 1 : soundFiles.length - 1;
        loadTrack(currentTrack);
    }

    function nextTrack() {
        currentTrack = (currentTrack < soundFiles.length - 1) ? currentTrack + 1 : 0;
        loadTrack(currentTrack);
    }

    window.onload = function() {
        if (soundFiles.length > 0) {
            loadTrack(currentTrack);
        }
    };
</script>

</body>
</html>
