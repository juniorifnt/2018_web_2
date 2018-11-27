// Youtube API key
const API_KEY = "AIzaSyBGSidh8WB4tOLGGx_xOEa75yAya0FW62Q";

// do a video list
function showVideo(title, videoId, thumbnails) {
    return `
    <div class="show">
    <p class=name>Title: ${title}</p>
    <img src="${thumbnails.medium.url}">
    <p>URL: <a href="http://www.youtube.com/embed/${videoId}">www.youtube.com/embed/${videoId}</a></p>
    </div>`;
}

//call a request for Youtube Data API
function callYouTubeAPI(text) {
    const URL = `https://content.googleapis.com/youtube/v3/search?part=snippet&maxResults=21&q=${text}&type=video&key=${API_KEY}`;
    $.get(URL, function({ items }, status) {

        // get an information to do video list
        items.map(function(value) {
            $("#videos").append(
                showVideo(
                    value.snippet.title,
                    value.id.videoId,
                    value.snippet.thumbnails
                )
            );
        });
    });
}

$(document).ready(function() {
    // click to search
    $("#search-btn").click(function() {
        const text = $("#search-input").val();
        $("#videos").empty();
        callYouTubeAPI(text);
    });
    
    // input data for search
    $("#search-input").change(function() {
        const text = $(this).val();
        $("#videos").empty();
        callYouTubeAPI(text);
    });
});
