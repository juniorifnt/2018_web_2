<?php
    //import library
    require "twitteroauth/autoload.php";
    use Abraham\TwitterOAuth\TwitterOAuth;
    
    const APIKey = "Wtzb0I9jbMY4Ye2hINyRTI9JV";
    const APISecretKey = "JQaV3pMaZayy7fW9ibyKVxoXMTCW6JbdvfeweMpzjP1rSC0BJ8";
    const AccessToken = "1859145668-yKmxMWFE8ir92ZDU7jDAVIZ3ijJrxOd3BC83ip4";
    const AccessTokenSecret ="YjfsRy3OsZ3rm770VslUSTWqQVarD7PrACNYN5xmFkgF8";

    function show($result){
        foreach($result->statuses as $key => $value){
            echo "
            <div class=\"container\">

            <table class=\"table\" >
            <thead>
            <td rowspan=\"2\"><img src=\"{$value->user->profile_image_url}\"></td>
            <td><h4>{$value->user->name}</h4></td>
            </tr>
            <tr>
            <td><p>{$value->text}</p></td>
            </tr>
            </thead>
            </div>
            ";
        }
    }

    function search(array $keyword){
              $twitter = new TwitterOAuth(APIKey,APISecretKey,AccessToken,AccessTokenSecret);
              return $twitter->get('search/tweets',$keyword);
    }

    if(isset($_GET['key'])){
          $needed_data = array(
            "q" => $_GET['key'],
            "count" => 30,
            "result_type"=>"recent",
          );

          $result = search($needed_data);
          show($result);
    }

?>