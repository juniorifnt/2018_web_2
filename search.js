// Google API
const API_KEY_SEARCH = "AIzaSyBwdnMGnnef_olJQKcXr396eSmkCLGtrJs";
const cx = "006915378234751030454:ytol-tifmki";

// do a information list
function showSearch(title, link, description) {
  	return `
  	<div class="list">
    <h3 style="color:white; margin-left:25px;"><b>Title: ${title}</b></h3>
    <p style="color:#F7DC6F; margin-left:20px;"><b>URL: <a href="${link}">${title}</b></a></p>
    <p style="color:#82E0AA; margin-left:20px;"><b>Description:</b> ${description} </p>
  	</div>`;
}

$("#submit").click(function() {
		let keyword = $("#keyword").val()
  	let type = $("#options").val();
    console.log(keyword)
  	console.log(type)
  	const URL = `https://www.googleapis.com/customsearch/v1?key=${API_KEY_SEARCH}&cx=${cx}&q=${keyword}`;
  	if(type == "Custom Search") {
  		$.get(URL, function({ items }, status) {
				// get an information to do information list
        $("#showVideo").empty();
        $("#showComment").empty();
        $("#showSearch").empty();
    		items.map(function(value) { 
					// show data in index
      		$("#showSearch").append(
        		showSearch(
          		value.title,
          		value.snippet.URL,
              value.snippet
        		)
      		);
    		});
			});
  	} else {
  			console.log("type error")
  	}
})




   

