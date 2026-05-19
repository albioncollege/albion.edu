async function initMap() {
  // Request needed libraries.
  const { Map } = await google.maps.importLibrary("maps");
  const { AdvancedMarkerElement } = await google.maps.importLibrary("marker");
  const center = { lat: 42.244132014018355, lng: -84.74419733615092 };
  const map = new Map(document.getElementById("map"), {
	zoom: 15,
	center,
	tilt: 47.5,
	mapId: "8c85b69b9c14ff651fe76e7f",
  });
  const ALBION_BOUNDS = {
	  north: 42.3,
	  south: 42.2,
	  west: -84.77,
	  east: -84.72
  };

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
		  latLngBounds: ALBION_BOUNDS,
		  strictBounds: false,
	  },
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
	let imageGalleryHTML = ""
	if (property.gallery && property.gallery.length) {
		imageGalleryHTML = `
		  <div class="image-gallery">
			${property.gallery.map((image) => `
				<img src="${image.url}" alt="${image.alt || ""}" />
				${image.caption ? `<p class="media__caption">${image.caption}</p>` : ""}
			`).join("")}
		  </div>
		`;
	  }
	propertyInfoDiv.innerHTML = `
		<h2>${property.name}</h2>
		${property.description}
		${imageGalleryHTML}
	`
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