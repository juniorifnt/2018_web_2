<?php
    //import library
    require "twitteroauth/autoload.php";
    use Abraham\TwitterOAuth\TwitterOAuth;
    
    const APIKey = "DpV03fA4Ljw2pBeLaeHEReHSb";
    const APISecretKey = "3UIxpuH80RQkskLW3rLPKrSgmGWgnku0uGSG1vTXS9KSOdY9Kf";
    const AccessToken = "1066363490539995136-E0lD20m4hDZoIYFab3xswSZW0NC0yy";
    const AccessTokenSecret ="7gFEJcbkalXk8OnoZ4IrcXWdaZrIdUk6u6bMpbMGL1gQh";

    function show($result){
        foreach($result->statuses as $key => $value){
            echo "
            <div class=\"container\">

            <table class=\"table\" border=\"1\">
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