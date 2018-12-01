<?php
    //import library
    require "twitteroauth/autoload.php";
    use Abraham\TwitterOAuth\TwitterOAuth;
    
    //Twitter API key and Token that need to send request to twitter
    const APIKey = "Wtzb0I9jbMY4Ye2hINyRTI9JV";
    const APISecretKey = "JQaV3pMaZayy7fW9ibyKVxoXMTCW6JbdvfeweMpzjP1rSC0BJ8";
    const AccessToken = "1859145668-yKmxMWFE8ir92ZDU7jDAVIZ3ijJrxOd3BC83ip4";
    const AccessTokenSecret ="YjfsRy3OsZ3rm770VslUSTWqQVarD7PrACNYN5xmFkgF8";

    //session resume from index page
    session_start();

    $count_negative = 0;
    $count_positive = 0;
    $count_neutral = 0;
    

    $positive_txt=file_get_contents("Positive.txt");
    $negative_txt=file_get_contents("Negative.txt");
    $negative=explode("\n",$negative_txt);
    $positive=explode("\n",$positive_txt);
    //print_r($negative) ;

    $dataPoints = array(
        array("label"=> "Negative", "y"=>$count_negative),
        array("label"=> "Positive", "y"=> $count_positive),
        array("label"=> "Neutral", "y"=> $count_neutral),
    );

    //This function is called to show result of search result
    function show($result){
        foreach($result->statuses as $key => $value){
            
            //date format 
            $date=date("l M j, Y \- g:ia",strtotime($value->user->created_at));
            $text="";
            $text=$value->text;
            SentimentAnalysis($text);
            //part of showing the result on the screen
            echo "
                <div class=\"card\" style=\"width: 70rem;\">
                    <img style=\"width: 5rem;\" class=\"rounded-circle\" src=\"{$value->user->profile_image_url}\" alt=\"Card image cap\">
                    <div class=\"card-body\">
                        <h5 class=\"card-title\" style=\"font-weight:bolder\"><font size=\"4.5\">{$value->user->name}</h5>
                        <h5 class=\"card-title\" ><font size=\"4\">@{$value->user->screen_name}</h5>
                        <p class=\"card-text\"><font size=\"3\">{$value->text}</p>
                        <h5 class=\"card-title\" style=\"font-weight:bolder\"><font size=\"3\">{$date}</h5>
                    </div>
                </div>
                ";
        }
    }

    //bonus
    function SentimentAnalysis($text){
        $negative_word=0;
        $positive_word=0;
        //echo $negative_word;
        //echo $positive_word;
        global $count_negative,$count_positive,$count_neutral,$negative,$positive;
        foreach($negative as $word)
        {
            $check_negative=strpos($text,$word);
	        if(gettype($check_negative) != "boolean"){
		        $negative_word=$negative_word+1;
	        }	
        }
        foreach($positive as $word)
        {
            $check_positive=strpos($text,$word);
	        if(gettype($check_positive) != "boolean"){
		        $positive_word=$positive_word+1;
	        }	
        }
        if($negative_word>$positive_word){
            $count_negative=$count_negative+1;
        }else if($positive_word>$negative_word){
            $count_positive=$count_positive+1;
        }else{
            $count_neutral=$count_neutral+1;
        }
        //echo"<br>";
        //echo $count_negative;
    //echo $count_positive;
    //echo $count_neutral;
    }

    //Search for keyword and return result by requesting from twitter
    function search(array $keyword){
              $twitter = new TwitterOAuth(APIKey,APISecretKey,AccessToken,AccessTokenSecret);
              return $twitter->get('search/tweets',$keyword);
    }

    //check if session is setted from index or not
    if(!isset($_SESSION['index'])){
        //if not show this message
        echo "<h5 class=\"card-title\" ><font size=\"4\" color=\"white\" >Something went wrong</h5>";
    }else{
        //if yes continue do the following
    if(isset($_GET['key'])){

        //array of parameter that need to send to twitter
          $needed_data = array(
            "q" => $_GET['key'],
            "count" => 30,
            "result_type"=>"recent",
          );

        //result after search
          $result = search($needed_data);

        //showing the result
          show($result,$negative,$positive);
    }
    }   
    //echo $count_negative;
    //echo $count_positive;
    //echo $count_neutral;
?>
<!DOCTYPE HTML>
<html>
<head>  
<script>
window.onload = function () {
 
var chart = new CanvasJS.Chart("chartContainer", {
	animationEnabled: true,
	exportEnabled: true,
	title:{
		text: "Sentiment Analysis"
	},
	data: [{
		type: "pie",
		showInLegend: "true",
		legendText: "{label}",
		indexLabelFontSize: 16,
		indexLabel: "{label} - #percent%",
		yValueFormatString: "฿#,##0",
		dataPoints: <?php echo json_encode($dataPoints, JSON_NUMERIC_CHECK); ?>
	}]
});
chart.render();
 
}
</script>
</head>
<body>
<div  style="height: 370px; width: 100%;   z-index: 110;"></div>
<script src="https://canvasjs.com/assets/script/canvasjs.min.js"></script>
</body>
</html>                              