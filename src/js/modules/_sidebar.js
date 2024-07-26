if (document.getElementById("sidebar")) {
  var sidebar = new StickySidebar('#sidebar', {topSpacing: 96, minWidth: 1025});
  sidebar.updateSticky();
}