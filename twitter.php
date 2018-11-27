<? php
    //import library
    require "twitteroauth/autoload.php";
    use Abraham\TwitterOAuth\TwitterOAuth;
    
    define("APIKey","DpV03fA4Ljw2pBeLaeHEReHSb");
    define("APISecretKey","3UIxpuH80RQkskLW3rLPKrSgmGWgnku0uGSG1vTXS9KSOdY9Kf");
    define("AccessToken","1066363490539995136-E0lD20m4hDZoIYFab3xswSZW0NC0yy");
    define("AccessTokenSecret","7gFEJcbkalXk8OnoZ4IrcXWdaZrIdUk6u6bMpbMGL1gQh");

    function show($result){
        foreach($result->statuses as $key => $value){
            echo "
            <div class=\"container\">
                <div class=\"col-md-12 col-sm-12 col-xs-12\">
                <table class=\"table\">
                <thead>
			    <td rowspan=\"2\"><img src=\"{$value->user->profile_image_url}\" style=\"margin-top:20px;\" alt=\"Avatar\" width=\"48px\" height=\"48px\" class=\"rounded-circle\"></td>
			    <td><h4><b>{$value->user->name}</b></h4></td>
		        </tr>
		        <tr>
			    <td><p style=\"margin-top:5px;\">{$value->text}</p></td>
		        </tr>
                </thead>
               
                </div>
            </div>
            ";
    }

    function search(array $keyword){
              $twitter = new TwitterOAuth(APIKey,APISecretKey,AccessToken,AccessTokenSecret);
              return $twitter->get('search/tweets',$keyword);
    }

    if(isset($_GET['keyword'])){
          $needed_data = array(
            "q" => $_GET['keyword'],
            "count" => 30,
            "result_type"=>"recent",
          );

          $result = search($needed_data);
    }

?>