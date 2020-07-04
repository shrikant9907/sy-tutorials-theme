<style type="text/css">
  
  .transscript_youtube {
    margin-bottom: 20px;
  }

  .transscript_youtube text {
    width: 100%;
    display: inline-block;
    color:#000 !important;
  }

  .transscript_youtube text font {
      color: #000000 !important;  
  }
  
  h5,p{
    margin:0px;
  }
  
  text.highlight_line, text.highlight_line font {
      color: #f00 !important;  
  }
  
.transscript_youtube .track_records {
    height: 150px;
    overflow-x: hidden;
    overflow-y: scroll;
    width: 100%;
    padding: 15px;
    background: #fdfdfd;
}

</style>

<!--<iframe id="player"  src="https://www.youtube.com/embed/NnW5EjwtE2U?feature=oembed" allowfullscreen="" width="800" height="450" frameborder="0"></iframe>-->
 
<iframe id="player" src="https://www.youtube.com/embed/NnW5EjwtE2U?enablejsapi=1"></iframe>

<script >  

// Youtube Script 
if (!window['YT']) {var YT = {loading: 0,loaded: 0};}if (!window['YTConfig']) {var YTConfig = {'host': 'http://www.youtube.com'};}if (!YT.loading) {YT.loading = 1;(function(){var l = [];YT.ready = function(f) {if (YT.loaded) {f();} else {l.push(f);}};window.onYTReady = function() {YT.loaded = 1;for (var i = 0; i < l.length; i++) {try {l[i]();} catch (e) {}}};YT.setConfig = function(c) {for (var k in c) {if (c.hasOwnProperty(k)) {YTConfig[k] = c[k];}}};var a = document.createElement('script');a.type = 'text/javascript';a.id = 'www-widgetapi-script';a.src = 'https://s.ytimg.com/yts/jsbin/www-widgetapi-vflQKB5wA/www-widgetapi.js';a.async = true;var b = document.getElementsByTagName('script')[0];b.parentNode.insertBefore(a, b);})();}

var player, timer, timeSpent = [], display = document.getElementById('display');

function onYouTubeIframeAPIReady() {
	player = new YT.Player( 'player', {
		events: { 'onStateChange': onPlayerStateChange }
	});
}
 
function onPlayerStateChange(event) {
	if(event.data === 1) { // Started playing
        if(!timeSpent.length){
            for(var i=0, l=parseInt(player.getDuration()); i<l; i++) timeSpent.push(false);
        }
	    timer = setInterval(record,100);
    } else {
		clearInterval(timer);
	}
}

function record(){
	timeSpent[ parseInt(player.getCurrentTime()) ] = true;
        var video_current_time = player.getCurrentTime();
        var ts_list = document.getElementsByTagName("text");

        var ts_item_length = ts_list.length; 
        var check_first = 1;

        for(var i=0; i<=ts_item_length; i++) {
            
            if( typeof ts_list[i] !== 'undefined' ) {
            
                var start_value = ts_list[i].getAttribute("start");  
                if(start_value>=video_current_time) {  
                    if((check_first===1) && (i!==0)) {
                        ts_list[i-1].className = "highlight_line";   
                        
                        if(i>=5) {
                            ts_element = document.getElementsByClassName("track_records")['0'];
                            ts_element.scrollTop = 10*i; 
                        }
                        
                    }
                    check_first = check_first + 1;  
                } 
                ts_list[i].classList.remove("highlight_line");
            
            }
            
        } 

        
}
 


</script>

<?php  
  
// get video id from url
$video_url = 'https://www.youtube.com/watch?v=NnW5EjwtE2U';
preg_match("#(?<=v=)[a-zA-Z0-9-]+(?=&)|(?<=v\/)[^&\n]+(?=\?)|(?<=v=)[^&\n]+|(?<=youtu.be/)[^&\n]+#", $video_url, $matches);

// get video info from id
$video_id = $matches[0];
$video_info = file_get_contents('http://www.youtube.com/get_video_info?&video_id='.$video_id);
parse_str($video_info, $video_info_array);

$captiontracksdata = json_decode($video_info_array['player_response'])->captions->playerCaptionsTracklistRenderer->captionTracks;

//echo "<pre>";
//print_r($captiontracksdata);
//echo "</pre>";

if($captiontracksdata) { 
    foreach ($captiontracksdata as $trackdata) {
        
      $name = $trackdata->name->simpleText;
      $languagecode = $trackdata->languageCode;
      $baseurl = $trackdata->baseUrl;
 
      $trackdata = file_get_contents($baseurl);
      if($trackdata!='') {
        echo '<div class="transscript_youtube">'; 
        echo '<span>Language Code</span> '.$languagecode;
        echo '<div class="track_records">'.htmlspecialchars_decode($trackdata).'</div>';
        echo '</div>';
      }  

    }
}  