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
    let previewFill = null;
    let vertexMarkers = [];
    let activePolygon = null;
    let clickListener = null;
    let dblClickListener = null;
    let rightClickListener = null;

    function getCloseThreshold() {
        const zoom = map.getZoom() || 10;
        return Math.max(40, 1200 / Math.pow(2, zoom - 10));
    }

    function computeDistanceMeters(a, b) {
        if (
            google.maps.geometry &&
            google.maps.geometry.spherical &&
            typeof google.maps.geometry.spherical.computeDistanceBetween === "function"
        ) {
            return google.maps.geometry.spherical.computeDistanceBetween(a, b);
        }

        const toRad = function (value) {
            return value * Math.PI / 180;
        };
        const earthRadius = 6371000;
        const dLat = toRad(b.lat() - a.lat());
        const dLng = toRad(b.lng() - a.lng());
        const lat1 = toRad(a.lat());
        const lat2 = toRad(b.lat());
        const h = Math.sin(dLat / 2) * Math.sin(dLat / 2) +
            Math.cos(lat1) * Math.cos(lat2) * Math.sin(dLng / 2) * Math.sin(dLng / 2);

        return 2 * earthRadius * Math.asin(Math.sqrt(h));
    }

    function stopMapEvent(event) {
        if (event && typeof event.stop === "function") {
            event.stop();
        }
        if (event && event.domEvent) {
            event.domEvent.preventDefault();
            event.domEvent.stopPropagation();
        }
    }

    function clearVertexMarkers() {
        vertexMarkers.forEach(function (marker) {
            marker.setMap(null);
        });
        vertexMarkers = [];
    }

    function clearPreview() {
        clearVertexMarkers();
        if (previewLine) {
            previewLine.setMap(null);
            previewLine = null;
        }
        if (previewFill) {
            previewFill.setMap(null);
            previewFill = null;
        }
        vertices = [];
    }

    function getPreviewPath() {
        if (vertices.length < 2) {
            return vertices;
        }
        if (vertices.length >= 3) {
            return vertices.concat([vertices[0]]);
        }
        return vertices;
    }

    function updatePreview() {
        if (previewLine) {
            previewLine.setMap(null);
        }
        if (previewFill) {
            previewFill.setMap(null);
            previewFill = null;
        }

        clearVertexMarkers();

        if (vertices.length >= 3) {
            previewFill = new google.maps.Polygon({
                paths: vertices,
                strokeOpacity: 0,
                fillColor: "#1a73e8",
                fillOpacity: 0.12,
                clickable: false,
                map: map,
            });
        }

        if (vertices.length >= 2) {
            previewLine = new google.maps.Polyline({
                path: getPreviewPath(),
                strokeColor: "#000000",
                strokeOpacity: 0.8,
                strokeWeight: 2,
                map: map,
            });
        }

        vertices.forEach(function (latLng, index) {
            const isClosePoint = index === 0 && vertices.length >= 3;
            const marker = new google.maps.Marker({
                position: latLng,
                map: map,
                icon: {
                    path: google.maps.SymbolPath.CIRCLE,
                    scale: isClosePoint ? 7 : 5,
                    fillColor: isClosePoint ? "#1a73e8" : "#000000",
                    fillOpacity: 1,
                    strokeWeight: 2,
                    strokeColor: "#fff",
                },
                zIndex: isClosePoint ? 1001 : 1000,
                title: isClosePoint ? "Click to close zone" : "",
            });

            if (isClosePoint) {
                google.maps.event.addListener(marker, "click", function (event) {
                    stopMapEvent(event);
                    completePolygon();
                });
            }

            vertexMarkers.push(marker);
        });

        finishUI.style.display = vertices.length >= 3 ? "inline-flex" : "none";
    }

    function stopDrawing() {
        drawing = false;
        controlUI.classList.remove("zone-draw-active");
        finishUI.style.display = "none";
        map.setOptions({
            draggableCursor: null,
            draggingCursor: null,
            disableDoubleClickZoom: false,
        });
        if (clickListener) {
            google.maps.event.removeListener(clickListener);
            clickListener = null;
        }
        if (dblClickListener) {
            google.maps.event.removeListener(dblClickListener);
            dblClickListener = null;
        }
        if (rightClickListener) {
            google.maps.event.removeListener(rightClickListener);
            rightClickListener = null;
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
        const savedVertices = vertices.slice();
        stopDrawing();
        if (activePolygon) {
            activePolygon.setMap(null);
        }
        activePolygon = new google.maps.Polygon(Object.assign({}, polygonOptions, {
            paths: savedVertices,
            map: map,
        }));
        bindPolygonEdit(activePolygon);
        emitComplete(activePolygon);
    }

    function addVertex(latLng) {
        if (vertices.length >= 3) {
            const first = vertices[0];
            const distance = computeDistanceMeters(first, latLng);
            if (distance < getCloseThreshold()) {
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
        map.setOptions({
            draggableCursor: "crosshair",
            disableDoubleClickZoom: true,
        });
        clickListener = map.addListener("click", function (event) {
            addVertex(event.latLng);
        });
        dblClickListener = map.addListener("dblclick", function (event) {
            stopMapEvent(event);
            if (vertices.length >= 3) {
                completePolygon();
            }
        });
        rightClickListener = map.addListener("rightclick", function (event) {
            stopMapEvent(event);
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
    controlDiv.className = "zone-draw-controls";

    const controlUI = document.createElement("div");
    controlUI.className = "zone-draw-control";
    controlUI.title = options.title || "Draw zone";
    controlUI.innerHTML = '<svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="#666" stroke-width="2"><polygon points="12,2 22,8.5 22,15.5 12,22 2,15.5 2,8.5"/></svg>';
    controlUI.addEventListener("click", toggleDrawing);

    const finishUI = document.createElement("div");
    finishUI.className = "zone-draw-control zone-draw-finish";
    finishUI.title = "Finish zone (min 3 points)";
    finishUI.style.display = "none";
    finishUI.innerHTML = '<svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="#1a73e8" stroke-width="2.5"><polyline points="20 6 9 17 4 12"/></svg><span style="margin-left:4px;font-size:12px;font-weight:600;color:#1a73e8;">Finish</span>';
    finishUI.addEventListener("click", function () {
        completePolygon();
    });

    controlDiv.appendChild(controlUI);
    controlDiv.appendChild(finishUI);
    map.controls[options.position || google.maps.ControlPosition.TOP_CENTER].push(controlDiv);

    return {
        startDrawing: startDrawing,
        stopDrawing: stopDrawing,
        toggleDrawing: toggleDrawing,
        completePolygon: completePolygon,
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
