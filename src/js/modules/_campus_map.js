let droneOverlay;

async function initMap() {
  // Request needed libraries.
  const { Map } = await google.maps.importLibrary("maps");
  const { AdvancedMarkerElement } = await google.maps.importLibrary("marker");
  const center = { lat: 42.244132014018355, lng: -84.74419733615092 };
  const map = new Map(document.getElementById("map"), {
	zoom: 16,
	center,
	tilt: 47.5,
	mapId: "8c85b69b9c14ff651fe76e7f",
	mapTypeId: 'satellite',
	mapTypeControlOptions: {
		myTypeIds: ['sattelite']
	}
  });
  const albionBounds = {
	  north: 42.25,
	  south: 42.23,
	  west: -84.77,
	  east: -84.73
  };
  
  const imageBounds = {
	  north: 42.249,
	  south: 42.239,
	  west: -84.75058,
	  east: -84.7339,
  };
  
  droneOverlay = new google.maps.GroundOverlay(
	  "/wp-content/uploads/2026/06/Albion-College-Full-Map-5-27-2026-orthophoto-straightened-scaled.webp",
	  imageBounds
  );
  droneOverlay.setMap(map);

  const properties = JSON.parse(document.getElementById("map").dataset.locations);
  console.log(properties);

  for (const property of properties) {
	  console.log(property)
	const advancedMarkerElement = new google.maps.marker.AdvancedMarkerElement({
	  map,
	  content: buildContent(property),
	  position: {
		lat: parseFloat(property.latitude),
		lng: parseFloat(property.longitude),
	  },
	  title: property.description,
	});
	advancedMarkerElement.addListener("gmp-click", () => {
	  toggleHighlight(advancedMarkerElement, property);
	});
  }

  const buttons = [
	[
	  "Rotate Left",
	  "rotate",
	  20,
	  google.maps.ControlPosition.INLINE_START_BLOCK_CENTER,
	],
	[
	  "Rotate Right",
	  "rotate",
	  -20,
	  google.maps.ControlPosition.INLINE_END_BLOCK_CENTER,
	],
	[
	  "Tilt Down",
	  "tilt",
	  20,
	  google.maps.ControlPosition.BLOCK_START_INLINE_CENTER,
	],
	[
	  "Tilt Up",
	  "tilt",
	  -20,
	  google.maps.ControlPosition.BLOCK_END_INLINE_CENTER,
	],
  ];

  buttons.forEach(([text, mode, amount, position]) => {
	const controlUI = document.createElement("button");

	controlUI.classList.add("ui-button");
	controlUI.innerText = `${text}`;
	controlUI.style.margin = "10px";
	controlUI.addEventListener("click", () => {
	  adjustMap(mode, amount);
	});
	map.controls[position].push(controlUI);
  });

  const adjustMap = function (mode, amount) {
	switch (mode) {
	  case "tilt":
		map.setTilt(map.getTilt() + amount);
		break;
	  case "rotate":
		map.setHeading(map.getHeading() + amount);
		break;
	  default:
		break;
	}
  };
  
  // Restrict the map area
  map.setOptions({
	  restriction: {
		  latLngBounds: albionBounds,
		  strictBounds: false,
	  },
  });
  
  // Hide/Show overlay with satellite
  map.addListener('maptypeid_changed', () => {
	const type = map.getMapTypeId();
  
	if (
	  type === google.maps.MapTypeId.SATELLITE
	) {
	  droneOverlay.setMap(map);
	} else {
	  droneOverlay.setMap(null);
	}
  });
}

function toggleHighlight(markerView, property) {
  // Get number of active highlights
  clearSelection();
  addInfo(property);
  const activeHighlights = document.querySelectorAll(".highlight").length;
  markerView.content.classList.add("highlight");
}

function clearSelection() {
  document.querySelectorAll('.property.highlight').forEach((el) => {
	el.classList.remove('highlight');
  });
  document.getElementById("property-info").innerHTML = ``;
}

function addInfo(property) {
	const propertyInfoDiv = document.getElementById("property-info");
	let imageGalleryHTML = "";
	let videoButtonHTML = "";
	if (property.gallery && property.gallery.length) {
		imageGalleryHTML = `
		  <div class="image-gallery">
			${property.gallery.map((image) => `
				<div class="thumbnail-button" command="show-modal" commandfor="dialog" role="button" tabindex="0" aria-label="expand image into lightbox view">
					<img src="${image.url}" alt="${image.alt || ""}" />
				</div>
				${image.caption ? `<p class="media__caption">${image.caption}</p>` : ""}
			`).join("")}
		  </div>
		`;
	};
	videoButtonHTML = `<button class="button show-video-dialog" command="show-modal" commandfor="dialog">Watch Video</button>`

	propertyInfoDiv.innerHTML = `
		<h2>${property.name}</h2>
		${videoButtonHTML}
		${imageGalleryHTML}
		${property.description}
	`
	
	// Add video to dialog
	if (property.youtube_video_url) {
		let youtubeURL = property.youtube_video_url;
		let regex = '\/(?=[^\/]*$).*';
		let youtubeVideoID = youtubeURL.match(regex);
		
		document.querySelector(".show-video-dialog").addEventListener("click", () => {
			let youtubeEmbedHTML = `
				<iframe width="100%" height="100%" src="https://www.youtube.com/embed/${youtubeVideoID}" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" referrerpolicy="strict-origin-when-cross-origin" allowfullscreen></iframe>
			`;
			let youtubeEmbedHTMLDialog = document.getElementById("dialog-wrapper")
			youtubeEmbedHTMLDialog.innerHTML = youtubeEmbedHTML;
		});
	}
	
	// Add light box to photos
	if (property.gallery && property.gallery.length) {
		lightbox();
	}
}

function buildContent(property) {
  const content = document.createElement("div");
  content.classList.add("property");
  content.innerHTML = `
	<div class="icon">
		<span class="svgstore svgstore--icon-${property.icon}">
			<svg>
				<title>${property.icon}</title>
				<use xlink:href="/wp-content/themes/albion/dist/img/svgstore.svg#icon-${property.icon}"></use>
			</svg>
		</span>
		<span class="sr-only">${property.name}</span>
	</div>
	<div class="details">
		<div class="name">${property.name}</div>
	</div>
	`;
  return content;
}
window.initMap = initMap;

document.querySelector("#view-map").addEventListener("click", () => {
	document.querySelector(".info-wrapper").classList.toggle("min");
	document.querySelector("#info").classList.toggle("min");
});

function updateDialoge() {
	
}

function lightbox() {
	const thumbnailsButtons = document.querySelectorAll(".thumbnail-button").forEach((element) => {
		element.addEventListener("click", (e) => {
			let imageLigthboxHTML = e.target.outerHTML;
			let dialogWrapperElement = document.getElementById("dialog-wrapper")
			dialogWrapperElement.innerHTML = imageLigthboxHTML;
			document.getElementById("dialog").showModal();
		});
	});
	document.querySelector("dialog").addEventListener("click", (e) =>  {
		console.log(e);
		if(e.target.nodeName != "IMG") {
			document.getElementById("dialog").close();
		}
	});
}