// Google API
const API_KEY_SEARCH = "AIzaSyBTm2-jknM69ZuoIdZ8jwLe1gCCmfPCdiA";
const cx = "007442906707937569429:tnyp0gt_kfs";

//AIzaSyBTm2-jknM69ZuoIdZ8jwLe1gCCmfPCdiA
//007442906707937569429:tnyp0gt_kfs

// do a information list
function showSearch(title, link, detail) {
   return `
  <div class="list">
    <p>Title: ${title}</p>
    <p>URL: <a href="${link}"><b>${title}</b></a></p>
    <p>Description: ${detail}</p>
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
          						value.title,
          						value.snippet.URL,
              				value.detail
        					)
      				);
    			});
			});
  	} else {
  		console.log("type error")
  	}
})
