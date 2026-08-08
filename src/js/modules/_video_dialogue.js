window.onload() => {
	document
		.querySelectorAll('button[href*="youtube.com/watch"],button[href*="youtube.com/short"],button[href*="youtu.be"]')
		.forEach(link => {
			link.addEventListener('click', function(event) {
				event.preventDefault();

				const videoId = getYouTubeVideoId(this.href);

				if (!videoId) {
					return;
				}

				// Create dialog
				const dialog = document.createElement('dialog');
				dialog.classList.add('youtube-dialog');

				dialog.innerHTML = `
					<div class="youtube-dialog__video">
						<iframe
							src="https://www.youtube.com/embed/${videoId}?autoplay=1"
							title="YouTube video"
							allowfullscreen
						></iframe>
					</div>
					<button
						type="button"
						class="button"
						aria-label="Close video"
					>
						Close
					</button>
				`;

				document.body.appendChild(dialog);

				// Close button
				dialog
					.querySelector('.youtube-dialog__close')
					.addEventListener('click', () => {
						dialog.close();
					});

				// Clicking backdrop closes dialog
				dialog.addEventListener('click', event => {
					if (event.target === dialog) {
						dialog.close();
					}
				});

				// Remove dialog from DOM after closing
				dialog.addEventListener('close', () => {
					dialog.remove();
				});

				dialog.showModal();
			});
		});


	function getYouTubeVideoId(url) {
		const parsedUrl = new URL(url);

		// youtu.be/VIDEO_ID
		if (parsedUrl.hostname === 'youtu.be') {
			return parsedUrl.pathname.slice(1);
		}

		// youtube.com/watch?v=VIDEO_ID
		if (parsedUrl.searchParams.has('v')) {
			return parsedUrl.searchParams.get('v');
		}

		// youtube.com/embed/VIDEO_ID
		// youtube.com/shorts/VIDEO_ID
		const match = parsedUrl.pathname.match(
			/^\/(?:embed|shorts)\/([^/?]+)/
		);

		return match ? match[1] : null;
	}
}