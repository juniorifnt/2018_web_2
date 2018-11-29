// Youtube API
const API_KEY_YOUTUBE = "AIzaSyBGSidh8WB4tOLGGx_xOEa75yAya0FW62Q";

// do a video list
function showVideo(title, videoId, thumbnails) {
    return `
    <div class="show">
    <p class=name>Title: ${title}</p>
    <img src="${thumbnails.medium.url}">
    <p>URL: <a href="http://www.youtube.com/embed/${videoId}">www.youtube.com/embed/${videoId}</a></p>
    </div>`;
}

$("#submit").click(function() {
    var keyword = $("#keyword").val();
    var type = $("#options").val();
    console.log(keyword) 
    console.log(type)
    const URL = `https://content.googleapis.com/youtube/v3/search?part=snippet&maxResults=21&q=${keyword}&type=video&key=${API_KEY_YOUTUBE}`;
    if(type == "Video") {
        $.get(URL, function({ items }, status) {
            console.log(items)
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
