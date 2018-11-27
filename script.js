
const API_KEY = "AIzaSyDnAu44JqxQYij5Ex9Bz9owB43DuX-SqSY";
const cx = "006915378234751030454:8ur5gwuf5pg";

function resultlist(title, link, detail) {
  return `
  <div class="list">
    <p>Title: ${title}</p>
    <p>URL: ${link}</p>
  </div>`;
}

$("#submit").click(function() {
	var keyword = $("#keyword").val()
    var type = $("#customSearch").val();
    const URL = `https://www.googleapis.com/customsearch/v1?key=${API_KEY}&cx=${cx}&q=${keyword}`;
  	if(type == "#customSearch") {
  		$.get(URL, function({ items }, status) {
    		items.map(function(value) {
      			$("#showSearch").append(
        			resultlist(
          				value.snippet.title,
          				value.snippet.URL
        			)
      			);
    		});
		});
  	} else {
  		console.log("type error")
  	}
	
//$("#keyword").change(function() {
  //  const text = $(this).val();
    //$("#results").empty();
    //callGoogleAPI(text);
  //});
});
