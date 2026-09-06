document
  .querySelectorAll(
    'button[href*="youtube.com/watch"],button[href*="youtube.com/short"],button[href*="youtu.be"]',
  )
  .forEach((link) => {
    link.addEventListener("click", function (event) {
      let dialogElement = document.getElementById("dialog-wrapper");
      // Clear the dialog
      dialogElement.innerHTML = ``;

      // Get the video id from the url
      const videoId = getYouTubeVideoId(this.getAttribute("href"));

      // If no video id, return
      if (!videoId) {
        return;
      }

      // Create dialog html
      dialogElement.innerHTML = `
				<iframe
					src="https://www.youtube.com/embed/${videoId}?autoplay=1"
					title="YouTube video"
					allowfullscreen
				></iframe>
			`;

      // Add the dialog html to the dialog
      dialogElement.innerHTML = dialogHTML;
    });
  });

function getYouTubeVideoId(url) {
  const parsedUrl = new URL(url);

  // youtu.be/VIDEO_ID
  if (parsedUrl.hostname === "youtu.be") {
    return parsedUrl.pathname.slice(1);
  }

  // youtube.com/watch?v=VIDEO_ID
  if (parsedUrl.searchParams.has("v")) {
    return parsedUrl.searchParams.get("v");
  }

  // youtube.com/embed/VIDEO_ID
  // youtube.com/shorts/VIDEO_ID
  const match = parsedUrl.pathname.match(/^\/(?:embed|shorts)\/([^/?]+)/);

  return match ? match[1] : null;
}
