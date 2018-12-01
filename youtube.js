// Youtube API
const API_KEY_YOUTUBE = "AIzaSyBGSidh8WB4tOLGGx_xOEa75yAya0FW62Q";

//This function is called to show result of search result
function showVideo(title, videoId, thumbnails) {
    return `
    <div class="card" style="width: 70rem;">
        <img class="card-img-top" style="width: 35rem;" src="${thumbnails.medium.url}" alt="Card image cap">
        <div class="card-body">
            <p class="card-text"><font size="4.5">${title}<\p>
            <button type="button" class="btn btn-secondary"><a href="http://www.youtube.com/embed/${videoId}">LINK</a></button>

        </div>
    </div>`;   
}

//When submit and select this search option will show the result by the following
$("#submit").click(function() {
    var keyword = $("#keyword").val();
    var type = $("#options").val();
    console.log(keyword) 
    console.log(type)
    const URL = `https://content.googleapis.com/youtube/v3/search?part=snippet&maxResults=21&q=${keyword}&type=video&key=${API_KEY_YOUTUBE}`;
    if(type == "Video") {
        $.get(URL, function({ items }, status) {
            console.log(items)
            $("#showSearch").empty();
            $("#showComment").empty();
            $("#showVideo").empty();
            // get an information to do video list
            items.map(function(value) {
                // show data in index
                $("#showVideo").append(
                    showVideo(
                        value.snippet.title,
                        value.id.videoId,
                        value.snippet.thumbnails
                    )
                );
            });
        });
    } else {
        console.log("type error")
    }
})
