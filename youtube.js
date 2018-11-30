// Youtube API
const API_KEY_YOUTUBE = "AIzaSyBGSidh8WB4tOLGGx_xOEa75yAya0FW62Q";

// do a video list
function showVideo(title, videoId, thumbnails) {
    return `
    <div class="card" style="width: 18rem;">
        <img class="card-img-top" src="${thumbnails.medium.url}" alt="Card image cap">
        <div class="card-body">
            <h5 class="card-title">Title: ${title}</h5>
            <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
            <a href="http://www.youtube.com/embed/${videoId}" class="btn btn-primary">www.youtube.com/embed/${videoId}</a>
        </div>
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
