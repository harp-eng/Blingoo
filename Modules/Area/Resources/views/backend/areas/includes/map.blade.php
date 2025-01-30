<style>
    #map {
        height: 500px;
    }
</style>
<div id="map"></div>

<script>
    let map;
    let drawingManager;
    let polygons = [];
    console.log($('#polygon_coords').val());
    const currentPolygon = [
        JSON.parse($('#polygon_coords').val())
    ];
    const existingPolygons = [
        JSON.parse($('#polygon_coords').val())
    ];


    function initMap() {
        map = new google.maps.Map(document.getElementById("map"), {
            center: {
                lat: -34.397,
                lng: 150.644
            },
            zoom: 8,
        });

        drawingManager = new google.maps.drawing.DrawingManager({
            drawingMode: google.maps.drawing.OverlayType.POLYGON,
            drawingControl: true,
            drawingControlOptions: {
                position: google.maps.ControlPosition.TOP_CENTER,
                drawingModes: ["polygon"],
            },
            polygonOptions: {
                editable: true,
            },
        });

        drawingManager.setMap(map);

        google.maps.event.addListener(drawingManager, "overlaycomplete", function(event) {
            if (event.type === google.maps.drawing.OverlayType.POLYGON) {
                const newPolygon = event.overlay;
                if (isPolygonValid(newPolygon)) {
                    polygons.push(newPolygon);
                    google.maps.event.addListener(newPolygon.getPath(), 'set_at', () => checkPolygon(
                        newPolygon));
                    google.maps.event.addListener(newPolygon.getPath(), 'insert_at', () => checkPolygon(
                        newPolygon));
                    getPolygonCoords(newPolygon);
                } else {
                    newPolygon.setMap(null); // Remove invalid polygon
                    alert("Polygon overlaps with an existing polygon.");
                }
            }
        });
        loadExistingPolygons(currentPolygon,true);
        loadExistingPolygons(existingPolygons);
    }

    function loadExistingPolygons(polygonData, editable = false) {
        polygonData.forEach(path => {
            const polygon = new google.maps.Polygon({
                paths: path,
                map: map,
                editable: false,
            });
            polygons.push(polygon);
        });
    }

    function isPolygonValid(newPolygon) {
        for (let polygon of polygons) {
            if (google.maps.geometry.poly.containsLocation(polygon.getPath().getAt(0), newPolygon)) {
                return false;
            }
            if (google.maps.geometry.poly.containsLocation(newPolygon.getPath().getAt(0), polygon)) {
                return false;
            }
            if (polygonsIntersect(newPolygon, polygon)) {
                return false;
            }
        }
        return true;
    }

    function polygonsIntersect(polygon1, polygon2) {
        const paths1 = polygon1.getPath();
        const paths2 = polygon2.getPath();

        for (let i = 0; i < paths1.getLength(); i++) {
            const segment1Start = paths1.getAt(i);
            const segment1End = paths1.getAt((i + 1) % paths1.getLength());
            for (let j = 0; j < paths2.getLength(); j++) {
                const segment2Start = paths2.getAt(j);
                const segment2End = paths2.getAt((j + 1) % paths2.getLength());
                if (google.maps.geometry.poly.isLocationOnEdge(segment1Start, new google.maps.Polygon({
                        paths: [segment2Start, segment2End]
                    }), 1e-9) ||
                    google.maps.geometry.poly.isLocationOnEdge(segment2Start, new google.maps.Polygon({
                        paths: [segment1Start, segment1End]
                    }), 1e-9)) {
                    return true;
                }
            }
        }
        return false;
    }

    function getPolygonCoords(newPolygon) {
        const len = newPolygon.getPath().getLength();
        let coordinates = [];
        for (let i = 0; i < len; i++) {
            const latLng = newPolygon.getPath().getAt(i);
            coordinates.push({
                lat: latLng.lat(),
                lng: latLng.lng()
            });
        }
        $("#polygon_coords").val(JSON.stringify(coordinates));
        // Here you can use the coordinates array as needed, for example, to display them on the webpage
    }

    function checkPolygon(polygon) {
        getPolygonCoords(polygon);
        if (!isPolygonValid(polygon)) {
            polygon.setMap(null); // Remove invalid polygon
            alert("Polygon overlaps with an existing polygon.");
            const index = polygons.indexOf(polygon);
            if (index > -1) {
                polygons.splice(index, 1);
            }
        }
    }
</script>
<script
    src="https://maps.googleapis.com/maps/api/js?key={{ env('GOOGLE_MAP_KEY') }}&callback=initMap&libraries=drawing,geometry">
</script>
