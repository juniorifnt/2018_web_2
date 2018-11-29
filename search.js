// Google API
const API_KEY_SEARCH = "AIzaSyDUNJ-JUrweFdzcVhH2xCYmrfIaK-8b8o0";
const cx = "006915378234751030454:8ur5gwuf5pg";

// do a information list
function showSearch(title, link, description) {
   return `
  <div class="list">
    <p style="color:red;"><b>Title: ${title}</b></p>
    <p>URL: <a href="${link}"><b>${title}</b></a></p>
    <p>Description: ${description} </p>
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
    		items.map(function(value) { 
					// show data in index
      		$("#showSearch").append(
        		showSearch(
          		value.title,
          		value.snippet.URL,
              value.snippet.description
        		)
      		);
    		});
			});
  	} else {
  		console.log("type error")
  	}

    $("#keyword").change(function() {
    const text = $(this).val();
    $("#list").empty();
    items.map(function(value) { 
          // show data in index
          $("#showSearch").append(
            showSearch(
              value.title,
              value.snippet.URL,
              value.snippet.description
            )
          );
        });
  });
})
