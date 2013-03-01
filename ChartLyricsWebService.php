<?php
class SearchLyric{
    var $artist;
    //string
    var $song;
    //string
}
class SearchLyricResponse{
    var $SearchLyricResult;
    //ArrayOfSearchLyricResult
}
class ArrayOfSearchLyricResult{
    var $SearchLyricResult;
    //SearchLyricResult
}
class SearchLyricResult{
    var $TrackChecksum;
    //string
    var $TrackId;
    //int
    var $LyricChecksum;
    //string
    var $LyricId;
    //int
    var $SongUrl;
    //string
    var $ArtistUrl;
    //string
    var $Artist;
    //string
    var $Song;
    //string
    var $SongRank;
    //int
}
class SearchLyricText{
    var $lyricText;
    //string
}
class SearchLyricTextResponse{
    var $SearchLyricTextResult;
    //ArrayOfSearchLyricResult
}
class GetLyric{
    var $lyricId;
    //int
    var $lyricCheckSum;
    //string
}
class GetLyricResponse{
    var $GetLyricResult;
    //GetLyricResult
}
class GetLyricResult{
    var $TrackChecksum;
    //string
    var $TrackId;
    //int
    var $LyricChecksum;
    //string
    var $LyricId;
    //int
    var $LyricSong;
    //string
    var $LyricArtist;
    //string
    var $LyricUrl;
    //string
    var $LyricCovertArtUrl;
    //string
    var $LyricRank;
    //int
    var $LyricCorrectUrl;
    //string
    var $Lyric;
    //string
}
class AddLyric{
    var $trackId;
    //int
    var $trackCheckSum;
    //string
    var $lyric;
    //string
    var $email;
    //string
}
class AddLyricResponse{
    var $AddLyricResult;
    //string
}
class SearchLyricDirect{
    var $artist;
    //string
    var $song;
    //string
}
class SearchLyricDirectResponse{
    var $SearchLyricDirectResult;
    //GetLyricResult
}
class ChartLyricsService
{
    var $soapClient;
    
    private static $classmap = array('SearchLyric'=>'SearchLyric'
    ,'SearchLyricResponse'=>'SearchLyricResponse'
    ,'ArrayOfSearchLyricResult'=>'ArrayOfSearchLyricResult'
    ,'SearchLyricResult'=>'SearchLyricResult'
    ,'SearchLyricText'=>'SearchLyricText'
    ,'SearchLyricTextResponse'=>'SearchLyricTextResponse'
    ,'GetLyric'=>'GetLyric'
    ,'GetLyricResponse'=>'GetLyricResponse'
    ,'GetLyricResult'=>'GetLyricResult'
    ,'AddLyric'=>'AddLyric'
    ,'AddLyricResponse'=>'AddLyricResponse'
    ,'SearchLyricDirect'=>'SearchLyricDirect'
    ,'SearchLyricDirectResponse'=>'SearchLyricDirectResponse'
    
    );
    
    function __construct($url='http://api.chartlyrics.com/apiv1.asmx?WSDL')
    {
        $this->soapClient = new SoapClient($url,array("classmap"=>self::$classmap,"trace" => true,"exceptions" => true));
    }
    
    function SearchLyric($SearchLyric)
    {
        
        $SearchLyricResponse = $this->soapClient->SearchLyric($SearchLyric);
        return $SearchLyricResponse;
        
    }
    function SearchLyricText($SearchLyricText)
    {
        
        $SearchLyricTextResponse = $this->soapClient->SearchLyricText($SearchLyricText);
        return $SearchLyricTextResponse;
        
    }
    function GetLyric($GetLyric)
    {
        
        $GetLyricResponse = $this->soapClient->GetLyric($GetLyric);
        return $GetLyricResponse;
        
    }
    function AddLyric($AddLyric)
    {
        
        $AddLyricResponse = $this->soapClient->AddLyric($AddLyric);
        return $AddLyricResponse;
        
    }
    function SearchLyricDirect($SearchLyricDirect)
    {
        
        $SearchLyricDirectResponse = $this->soapClient->SearchLyricDirect($SearchLyricDirect);
        return $SearchLyricDirectResponse;
        
    }
}