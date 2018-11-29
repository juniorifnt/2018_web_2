// Google API
const API_KEY_SEARCH = "AIzaSyBwdnMGnnef_olJQKcXr396eSmkCLGtrJs";
const cx = "006915378234751030454:8ur5gwuf5pg";

// do a information list
function showSearch(title, link, detail) {
  return `
  <div class="list">
    <p>Title: ${title}</p>
    <p>URL: ${link}</p>
  </div>`;
}

$("#submit").click(function() {
	let keyword = $("#keyword").val()
  let type = $("#options").val();
    console.log(type)
    const URL = `https://www.googleapis.com/customsearch/v1?key=${API_KEY_SEARCH}&cx=${cx}&q=${keyword}`;
  	if(type == "Custom Search") {
  		$.get(URL, function({ items }, status) {
				// get an information to do information list
    		items.map(function(value) { 
					// show data in index
      		$("#showSearch").append(
        		showSearch(
          		value.snippet.title,
          		value.snippet.URL
        		)
      		);
    		});
			});
  	} else {
  		console.log("type error")
  	}
})
