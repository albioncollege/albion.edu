let droneOverlay;

async function initMap() {
  // Request needed libraries.
  const { Map } = await google.maps.importLibrary("maps");
  const { AdvancedMarkerElement } = await google.maps.importLibrary("marker");
  const center = { lat: 42.244132014018355, lng: --84.74260534813175 };
  const map = new Map(document.getElementById("map"), {
    zoom: 16.5,
    center,
    tilt: 47.5,
    mapId: "8c85b69b9c14ff651fe76e7f",
    mapTypeId: "satellite",
    mapTypeControlOptions: {
      myTypeIds: ["sattelite"],
	  style: google.maps.MapTypeControlStyle.DROPDOWN_MENU
    },
  });
  const albionBounds = {
    north: 42.25,
    south: 42.23,
    west: -84.77,
    east: -84.73,
  };

  const imageBounds = {
    north: 42.249,
    south: 42.239,
    west: -84.75058,
    east: -84.7339,
  };

  droneOverlay = new google.maps.GroundOverlay(
    "https://www.albion.edu/wp-content/uploads/2026/07/Albion-College-Full-Map-5-27-2026-orthophoto-straightened.webp",
    imageBounds,
  );
  droneOverlay.setMap(map);

  const properties = JSON.parse(
    document.getElementById("map").dataset.locations,
  );
  
  const clearMapSelection = () => {
	clearSelection();
	document.querySelector(".info-wrapper")?.classList.add("hide");
  };
  
  map.addListener("click", clearMapSelection);
  droneOverlay.addListener("click", clearMapSelection);

  for (const property of properties) {
    const advancedMarkerElement = new google.maps.marker.AdvancedMarkerElement({
      map,
      content: buildContent(property),
      position: {
        lat: parseFloat(property.latitude),
        lng: parseFloat(property.longitude),
      },
      title: property.name,
    });
    advancedMarkerElement.addListener("gmp-click", () => {
      toggleHighlight(advancedMarkerElement, property);
    });
  }

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
  map.addListener("maptypeid_changed", () => {
    const type = map.getMapTypeId();

    if (type === google.maps.MapTypeId.SATELLITE) {
      droneOverlay.setMap(map);
    } else {
      droneOverlay.setMap(null);
    }
  });
}

function toggleHighlight(markerView, property) {
  // Get number of active highlights
  clearSelection();
  document.querySelector(".info-wrapper").classList.remove("hide");
  addInfo(property);
  const activeHighlights = document.querySelectorAll(".highlight").length;
  markerView.content.classList.add("highlight");
}

function clearSelection() {
  document.querySelectorAll(".property.highlight").forEach((el) => {
    el.classList.remove("highlight");
  });
  document.getElementById("property-info").innerHTML = ``;
}

function addInfo(property) {
  const propertyInfoDiv = document.getElementById("property-info");
  let imageGalleryHTML = "";
  let videoButtonHTML = "";
  // Add image gallery with alt text and description
  if (property.gallery && property.gallery.length) {
    imageGalleryHTML = `
		  <div class="image-gallery">
			${property.gallery
        .map(
          (image) => `
				<div class="thumbnail-button" command="show-modal" commandfor="dialog" role="button" tabindex="0" aria-label="expand image into lightbox view">
					<img loading="lazy" src="${image.url}" alt="${image.alt || ""}" data-caption="${image.caption}"/>
				</div>
			`,
        )
        .join("")}
		  </div>
		`;
  }
  if (property.youtube_video_url) {
    videoButtonHTML = `<button class="button show-video-dialog" command="show-modal" commandfor="dialog">Watch Video</button>`;
  }

  propertyInfoDiv.innerHTML = `
		<h2 class="h3">${property.name}</h2>
		${videoButtonHTML}
		${imageGalleryHTML}
		${property.description}
	`;

  // Add video to dialog
  if (property.youtube_video_url) {
    let youtubeURL = property.youtube_video_url;
    let regex = "\/(?=[^\/]*$).*";
    let youtubeVideoID = youtubeURL.match(regex);

    document
      .querySelector(".show-video-dialog")
      .addEventListener("click", () => {
        let youtubeEmbedHTML = `
				<iframe width="100%" height="100%" src="https://www.youtube.com/embed/${youtubeVideoID}" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" referrerpolicy="strict-origin-when-cross-origin" allowfullscreen></iframe>
			`;
        let youtubeEmbedHTMLDialog = document.getElementById("dialog-wrapper");
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

const viewMap = document.querySelector("#view-map");
if (viewMap !== null) {
  viewMap.addEventListener("click", () => {
    document.querySelector(".info-wrapper").classList.toggle("min");
	document.querySelector(".info-wrapper").classList.add("hide");
    document.querySelector("#info").classList.toggle("min");
	
	const buttonWrapper = document.createElement('div');
	buttonWrapper.classList.add('button-wrapper');
	
	const visitButton = document.createElement("a");
	visitButton.classList.add("button");
	visitButton.textContent = "Schedule a Tour";
	visitButton.href = "https://apply.albion.edu/portal/campus-visit_vNew";
	buttonWrapper.append(visitButton);
	
	const eventButton = document.createElement("a");
	eventButton.classList.add("button");
	eventButton.textContent = "Attend an Event";
	eventButton.href = "/visit";
	buttonWrapper.append(eventButton);
	
	document.querySelector("#map").append(buttonWrapper);
	
  });
}

function lightbox() {
  const thumbnailsButtons = document
    .querySelectorAll(".thumbnail-button")
    .forEach((element) => {
      element.addEventListener("click", (e) => {
        let imageLigthboxObject = e.target.closest(".image-gallery");
        let imageLigthboxHTML = `<div class="image-gallery">`;

        for (const image of imageLigthboxObject.querySelectorAll("img")) {
          let wrapperDiv = document.createElement("div");
          const description = image.dataset.description;
          wrapperDiv.classList.add("image-gallery-item");
          if (image.src === e.target.src) {
            wrapperDiv.classList.add("active");
          }
          wrapperDiv.innerHTML = `<img src="${image.src}" alt="${image.alt || ""}" />
          <div class="image-gallery-caption">${image.dataset.caption}</div>`;
          imageLigthboxHTML += wrapperDiv.outerHTML;
        }
        imageLigthboxHTML += `</div>`;

        // If there is more than one image, add a previous and next button
        if (
          imageLigthboxObject.querySelectorAll(".thumbnail-button").length > 1
        ) {
          imageLigthboxHTML += `
          <div class="image-gallery-navigation">
                    <button class="button previous-button">Previous</button>
                    <button class="button next-button">Next</button>
                    </div>
                `;
        }
        let dialogWrapperElement = document.getElementById("dialog-wrapper");
        dialogWrapperElement.innerHTML = imageLigthboxHTML;
        document.getElementById("dialog").showModal();
        dialogWrapperElement
          .querySelector(".previous-button")
          ?.addEventListener("click", previousImage);
        dialogWrapperElement
          .querySelector(".next-button")
          ?.addEventListener("click", nextImage);
      });
    });
}

// Add function to navigate through the images
function previousImage() {
  let currentImage = document.querySelector(".image-gallery-item.active");
  if (currentImage.previousElementSibling) {
    let previousImage = currentImage.previousElementSibling;
    currentImage.classList.remove("active");
    previousImage.classList.add("active");
  } else {
    let lastImage = document.querySelectorAll(".image-gallery-item")[
      document.querySelectorAll(".image-gallery-item").length - 1
    ];
    currentImage.classList.remove("active");
    lastImage.classList.add("active");
  }
}
function nextImage() {
  let currentImage = document.querySelector(".image-gallery-item.active");
  if (currentImage.nextElementSibling) {
    let nextImage = currentImage.nextElementSibling;
    currentImage.classList.remove("active");
    nextImage.classList.add("active");
  } else {
    let firstImage = document.querySelectorAll(".image-gallery-item")[0];
    currentImage.classList.remove("active");
    firstImage.classList.add("active");
  }
}
