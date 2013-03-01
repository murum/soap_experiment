<?php
	include_once("ChartLyricsWebService.php");
	$client = new ChartLyricsService();
	try
	{
		if(isset($_GET['lyricChecksum']) && isset($_GET['lyricId']))
		{
			$getLyric = new GetLyric();
			$getLyric->lyricCheckSum = $_GET['lyricChecksum'];
			$getLyric->lyricId = (int)$_GET['lyricId'];
			$getLyricResponse = $client->GetLyric($getLyric);
			$lyricResult = $getLyricResponse->GetLyricResult;
			$lyrics = array('lyric' => $lyricResult->Lyric, 'artist' => $lyricResult->LyricArtist, 'song' => $lyricResult->LyricSong);
		}
		else
		{
			$searchLyric = new SearchLyric();
			$searchLyric->artist = "Michael Jackson";
			$searchLyric->song = "Bad";
			
			$searchLyricResponse = new SearchLyricResponse();
			
			$searchLyricResponse = $client->SearchLyric($searchLyric);
			
			foreach($searchLyricResponse->SearchLyricResult->SearchLyricResult as $searchLyricResult)
			{
				$result[]= array('artist' => $searchLyricResult->Artist, 'song' => $searchLyricResult->Song, 'lyricChecksum' => $searchLyricResult->LyricChecksum, 'lyricId' => $searchLyricResult->LyricId);
			}
		}
	} catch (Exception $e)
	{
		$error = "Vänligen, vänta några sekunder och testa igen!";
	}
?>

<!DOCTYPE html>
<html lang="sv">
<head>
	<meta charset="UTF-8" />
	<title>Soap test</title>
</head>
<body>
	<div id="container">
		<h1>Grym hemsida</h1>
		<ul>
		<?php
			if(isset($result))
			{
				foreach ($result as $key) {
					if(isset($key['lyricChecksum']) && isset($key['lyricId']))
					echo "<li><a href='?lyricChecksum=".$key['lyricChecksum']."&lyricId=".$key['lyricId']."'>".$key['artist']." - ".$key['song']."</a></li>";
				}
			}
		?>
		</ul>
		<?php
			if(isset($lyrics))
			{
				echo "<h2>Lyrics | ".$lyrics['artist']." - ".$lyrics['song']."</h2>";
				echo $lyrics['lyric'];
			}
		?>
		<?php 
			if(isset($error))
			{
				echo "<p>".$error."</p>";
			}
		?>
	</div>
</body>
</html>
