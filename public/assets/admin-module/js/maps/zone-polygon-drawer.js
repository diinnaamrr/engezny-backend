"use strict";

/**
 * Replaces deprecated google.maps.drawing.DrawingManager for zone polygon drawing.
 * Google removed the Drawing Library in May 2026.
 */
function initZonePolygonDrawer(map, options) {
    options = options || {};
    const onComplete = options.onComplete || function () {};
    const polygonOptions = Object.assign({
        editable: true,
        draggable: false,
        strokeColor: "#000000",
        strokeOpacity: 0.8,
        strokeWeight: 2,
        fillColor: "#000000",
        fillOpacity: 0.15,
    }, options.polygonOptions || {});

    let drawing = false;
    let vertices = [];
    let previewLine = null;
    let vertexMarkers = [];
    let activePolygon = null;
    let clickListener = null;
    let dblClickListener = null;

    function clearPreview() {
        vertexMarkers.forEach(function (marker) {
            marker.setMap(null);
        });
        vertexMarkers = [];
        if (previewLine) {
            previewLine.setMap(null);
            previewLine = null;
        }
        vertices = [];
    }

    function updatePreview() {
        if (previewLine) {
            previewLine.setMap(null);
        }
        if (vertices.length < 2) {
            return;
        }
        previewLine = new google.maps.Polyline({
            path: vertices,
            strokeColor: "#000000",
            strokeOpacity: 0.8,
            strokeWeight: 2,
            map: map,
        });
        vertices.forEach(function (latLng, index) {
            vertexMarkers.push(new google.maps.Marker({
                position: latLng,
                map: map,
                icon: {
                    path: google.maps.SymbolPath.CIRCLE,
                    scale: 5,
                    fillColor: index === 0 && vertices.length >= 3 ? "#1a73e8" : "#000000",
                    fillOpacity: 1,
                    strokeWeight: 1,
                    strokeColor: "#fff",
                },
                zIndex: 1000,
            }));
        });
    }

    function stopDrawing() {
        drawing = false;
        controlUI.classList.remove("zone-draw-active");
        map.setOptions({draggableCursor: null, draggingCursor: null});
        if (clickListener) {
            google.maps.event.removeListener(clickListener);
            clickListener = null;
        }
        if (dblClickListener) {
            google.maps.event.removeListener(dblClickListener);
            dblClickListener = null;
        }
        clearPreview();
    }

    function emitComplete(polygon) {
        onComplete(polygon.getPath().getArray(), polygon);
    }

    function bindPolygonEdit(polygon) {
        const path = polygon.getPath();
        ["set_at", "insert_at", "remove_at"].forEach(function (eventName) {
            google.maps.event.addListener(path, eventName, function () {
                emitComplete(polygon);
            });
        });
    }

    function completePolygon() {
        if (vertices.length < 3) {
            return;
        }
        stopDrawing();
        if (activePolygon) {
            activePolygon.setMap(null);
        }
        activePolygon = new google.maps.Polygon(Object.assign({}, polygonOptions, {
            paths: vertices,
            map: map,
        }));
        bindPolygonEdit(activePolygon);
        emitComplete(activePolygon);
    }

    function addVertex(latLng) {
        if (vertices.length >= 3) {
            const first = vertices[0];
            const distance = google.maps.geometry.spherical.computeDistanceBetween(first, latLng);
            if (distance < 30) {
                completePolygon();
                return;
            }
        }
        vertices.push(latLng);
        updatePreview();
    }

    function startDrawing() {
        if (activePolygon) {
            activePolygon.setMap(null);
            activePolygon = null;
        }
        clearPreview();
        drawing = true;
        controlUI.classList.add("zone-draw-active");
        map.setOptions({draggableCursor: "crosshair"});
        clickListener = map.addListener("click", function (event) {
            addVertex(event.latLng);
        });
        dblClickListener = map.addListener("dblclick", function (event) {
            event.stop();
            if (vertices.length >= 3) {
                completePolygon();
            }
        });
    }

    function toggleDrawing() {
        if (drawing) {
            stopDrawing();
        } else {
            startDrawing();
        }
    }

    const controlDiv = document.createElement("div");
    const controlUI = document.createElement("div");
    controlUI.className = "zone-draw-control";
    controlUI.title = options.title || "Draw a shape";
    controlUI.innerHTML = '<svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="#666" stroke-width="2"><polygon points="12,2 22,8.5 22,15.5 12,22 2,15.5 2,8.5"/></svg>';
    controlUI.addEventListener("click", toggleDrawing);
    controlDiv.appendChild(controlUI);
    map.controls[options.position || google.maps.ControlPosition.TOP_CENTER].push(controlDiv);

    return {
        startDrawing: startDrawing,
        stopDrawing: stopDrawing,
        toggleDrawing: toggleDrawing,
        clearPolygon: function () {
            stopDrawing();
            if (activePolygon) {
                activePolygon.setMap(null);
                activePolygon = null;
            }
        },
        getPolygon: function () {
            return activePolygon;
        },
        setPolygon: function (polygon) {
            activePolygon = polygon;
        },
    };
}
