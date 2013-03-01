<?php

	require_once("ChartLyricsWebService.php");

	class SoapExperiment {
	
		private $client;
		
		private $artist = "Michael Jackson";
		private $song = "Bad";
		
		CONST GET_CHECKSUM = "lyricChecksum";
		CONST GET_ID = "lyricId";
		
		CONST LYRIC = 'lyric';
		CONST LYRIC_CHECKSUM = 'lyricChecksum';
		CONST LYRIC_ID = 'lyricId';
		CONST ARTIST = 'artist';
		CONST SONG = 'song';
		
		CONST ERROR = 'error';
		
		public function __construct()
		{
			$this->client = new ChartLyricsService();
		}
		
		public function DoExperiment()
		{
			try
			{
				if(isset($_GET[self::GET_CHECKSUM]) && isset($_GET[self::GET_ID]))
				{
					$getLyric = new GetLyric();
					$getLyric->lyricCheckSum = $_GET[self::GET_CHECKSUM];
					$getLyric->lyricId = (int)$_GET[self::GET_ID];
					$getLyricResponse = $this->client->GetLyric($getLyric);
					$lyricResult = $getLyricResponse->GetLyricResult;
					return array(self::LYRIC => $lyricResult->Lyric, self::ARTIST => $lyricResult->LyricArtist, self::SONG => $lyricResult->LyricSong);
				}
				else
				{
					$searchLyric = new SearchLyric();
					$searchLyric->artist = $this->artist;
					$searchLyric->song = $this->song;
					
					$searchLyricResponse = new SearchLyricResponse();
					
					$searchLyricResponse = $this->client->SearchLyric($searchLyric);
					
					foreach($searchLyricResponse->SearchLyricResult->SearchLyricResult as $searchLyricResult)
					{
						$result[] = array(self::ARTIST => $searchLyricResult->Artist, self::SONG => $searchLyricResult->Song, self::LYRIC_CHECKSUM => $searchLyricResult->LyricChecksum, self::LYRIC_ID => $searchLyricResult->LyricId);
					}
					return $result;
				}
			} catch (Exception $e)
			{
				return array(self::ERROR => "Vänligen, vänta några sekunder och testa igen!");
			}
		}
	}

	$se = new SoapExperiment();
	$body = $se->DoExperiment();
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
		<?php
			if(isset($body[0][SoapExperiment::LYRIC_CHECKSUM]))
			{
				?>
				<ul>
				<?php
				foreach ($body as $key) {
					if(isset($key[SoapExperiment::LYRIC_CHECKSUM]) && isset($key[SoapExperiment::LYRIC_ID]))
					echo "<li>
							<a 
								href='?".SoapExperiment::GET_CHECKSUM."=".$key[SoapExperiment::LYRIC_CHECKSUM]."&".SoapExperiment::GET_ID."=".$key[SoapExperiment::LYRIC_ID]."'
							>"
								.$key[SoapExperiment::ARTIST]." - ".$key[SoapExperiment::SONG]."
							 </a>
						 </li>";
				}
				?>
				</ul>
				<?php
			}
		?>
		<?php
			if(isset($body[SoapExperiment::LYRIC]))
			{
				echo "<h2>Lyrics | ".$body[SoapExperiment::ARTIST]." - ".$body[SoapExperiment::SONG]."</h2>";
				echo $body[SoapExperiment::LYRIC];
			}
		?>
		<?php 
			if(isset($body[SoapExperiment::ERROR]))
			{
				echo "<p>".$body[SoapExperiment::ERROR]."</p>";
			}
		?>
	</div>
</body>
</html>
