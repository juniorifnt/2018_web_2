<?php
    //import library
    require "twitteroauth/autoload.php";
    use Abraham\TwitterOAuth\TwitterOAuth;
    
    const APIKey = "Wtzb0I9jbMY4Ye2hINyRTI9JV";
    const APISecretKey = "JQaV3pMaZayy7fW9ibyKVxoXMTCW6JbdvfeweMpzjP1rSC0BJ8";
    const AccessToken = "1859145668-yKmxMWFE8ir92ZDU7jDAVIZ3ijJrxOd3BC83ip4";
    const AccessTokenSecret ="YjfsRy3OsZ3rm770VslUSTWqQVarD7PrACNYN5xmFkgF8";

    session_start();

    function show($result){
        foreach($result->statuses as $key => $value){
            
            $date=date("l M j \- g:ia",strtotime($value->user->created_at));
            echo "
                <div class=\"card\" style=\"width: 70rem;\">
                    <img style=\"width: 5rem;\" class=\"rounded-circle\" src=\"{$value->user->profile_image_url}\" alt=\"Card image cap\">
                    <div class=\"card-body\">
                        <h5 class=\"card-title\" style=\"font-weight:bolder\"><font size=\"4.5\">{$value->user->name}</h5>
                        <h5 class=\"card-title\" ><font size=\"4\">@{$value->user->screen_name}</h5>
                        <p class=\"card-text\"><font size=\"3\">{$value->text}</p>
                        
                        <h5 class=\"card-title\" style=\"font-weight:bolder\"><font size=\"4.5\">{$date}</h5>
                    </div>
                </div>
                ";
        }
    }
    function search(array $keyword){
              $twitter = new TwitterOAuth(APIKey,APISecretKey,AccessToken,AccessTokenSecret);
              return $twitter->get('search/tweets',$keyword);
    }

    if(!isset($_SESSION['index'])){
        echo "<h5 class=\"card-title\" ><font size=\"4\">Something went wrong</h5>";
    }else{
    if(isset($_GET['key'])){
          $needed_data = array(
            "q" => $_GET['key'],
            "count" => 30,
            "result_type"=>"recent",
          );

          $result = search($needed_data);
          show($result);
    }
    }   

?>