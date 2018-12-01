// Google API and cx number that will show certain websites
const API_KEY_SEARCH = "AIzaSyB1ejMqAdncJDuvHd-ykLiB2cw70-yRa4c";
const cx = "006915378234751030454:ytol-tifmki";

//This function is called to show result of search result
function showSearch(title, link, description) {
		return `
		<div class="card" style="width: 70rem;">
				<div class="card-body">
						<h5 class="card-title" style="font-weight:bolder"><font size="4.5">${title}</h5>
						<p class="card-text"><font size="3">${description}</p>
            <a href="${link}">${title}</b></a>
        </div>
    </div>`;   
}

//When submit and select this search option will show the result by the following
$("#submit").click(function() {
		let keyword = $("#keyword").val()
  	let type = $("#options").val();
    console.log(keyword)
  	console.log(type)
  	const URL = `https://www.googleapis.com/customsearch/v1?key=${API_KEY_SEARCH}&cx=${cx}&q=${keyword}`;
  	if(type == "Custom Search") {
  		$.get(URL, function({ items }, status) {
				//set every search result as empty before show search result from google 
        $("#showVideo").empty();
        $("#showComment").empty();
        $("#showSearch").empty();
    		items.map(function(value) { 
					// show data in index
      		$("#showSearch").append(
        		showSearch(
          		value.title,
          		value.link,
              value.snippet
        		)
      		);
    		});
			});
  	} 
})





   

