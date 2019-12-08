const searchEl = document.getElementById("search");
const showMoreEl = document.getElementById("show-more");
const showMoreParent = document.getElementById("show-more-wrapper");
const resultsEl = document.getElementById("results");
const bulkItem = document.getElementById("bulk-item");

searchEl.addEventListener("keyup", event => {
  if (event.keyCode === 13) {
    getResults(event.target.value)
  }
});

showMoreEl.addEventListener("click", event => {
    getResults(searchEl.value);
})

window.onscroll = function() {
    const d = document.documentElement;
    const offset = d.scrollTop + window.innerHeight;
    const height = d.offsetHeight;

    if (offset === height && showMoreEl.dataset.nextPageToken !== '') {
        getResults(searchEl.value);
    }
};

const isVisible = el => {
    return window.getComputedStyle(el).display !== "none";
}

const getResults = (query) => {
    new Promise(function(resolve, reject) {
        const getAPIData = new XMLHttpRequest();
        let url = `/search/${query}/`;
        if (showMoreEl.dataset.nextPageToken && showMoreEl.dataset.nextPageToken !== '') {
            url += `${showMoreEl.dataset.nextPageToken}/`;
        }
        getAPIData.open("GET", url);
        getAPIData.send();
        getAPIData.onload = function() {
            const responseJson = JSON.parse(getAPIData.responseText);
            resolve(responseJson);
        };
    }).then(data => {
        showMoreEl.dataset.nextPageToken = data.nextPageToken;
        Object.keys(data.items).map(key => {
            const videoId = data.items[key].id.videoId;
            const videoUrl = `https://www.youtube.com/watch?v=${videoId}`;
            const thumbUrl = data.items[key].snippet.thumbnails.medium.url;
            const clonedEl = bulkItem.cloneNode(true);

            clonedEl.classList = "yt-search-item";
            clonedEl.removeAttribute("id");
            clonedEl.addEventListener("click", event => {
                window.open(videoUrl, "_blank");
            });
            clonedEl.getElementsByClassName("search-item-title")[0].textContent = data.items[key].snippet.title;
            clonedEl.getElementsByClassName("search-item-url")[0].textContent = videoUrl;
            clonedEl.getElementsByClassName("search-item-url")[0].href = videoUrl;
            clonedEl.getElementsByClassName("search-item-thumbnail")[0].src = thumbUrl;
            resultsEl.appendChild(clonedEl);
        });
        showMoreParent.classList.remove("hide");
    }).catch(status => {
        console.log(`Error: ${status}`);
    });;
}