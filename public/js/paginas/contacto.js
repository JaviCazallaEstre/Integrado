$(function () {
  initMap();

  function initMap() {
    var map;
    map = new google.maps.Map(document.getElementById("mapid"), {
      center: { lat: 37.746018855089474,  lng: -3.9135664653912143 },
      zoom: 13,
    });
    var marker = new google.maps.Marker({
      position: { lat: 37.746018855089474, lng: -3.9135664653912143 },
      map: map,
      title: "Alma Verde",
    });
  }
});