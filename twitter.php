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

    //This function is called to show result of search result
    function show($result){
        foreach($result->statuses as $key => $value){
            
            //date format 
            $date=date("l M j, Y \- g:ia",strtotime($value->user->created_at));
            
            //part of showing the result on the screen
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
          show($result);
    }
    }   

?>