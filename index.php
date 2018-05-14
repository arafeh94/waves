<!DOCTYPE html>
<html>
<head>
    <title>Simple Map</title>
    <meta name="viewport" content="initial-scale=1.0">
    <meta charset="utf-8">
    <style>
        /* Always set the map height explicitly to define the size of the div
         * element that contains the map. */
        #map {
            height: 100%;
        }

        html, body {
            height: 100%;
            margin: 0;
            padding: 0;
        }

        .modal {
            display: none; /* Hidden by default */
            position: fixed; /* Stay in place */
            z-index: 1; /* Sit on top */
            padding-top: 100px; /* Location of the box */
            left: 0;
            top: 0;
            width: 100%; /* Full width */
            height: 100%; /* Full height */
            overflow: auto; /* Enable scroll if needed */
            background-color: rgb(0, 0, 0); /* Fallback color */
            background-color: rgba(0, 0, 0, 0.4); /* Black w/ opacity */
        }

        /* Modal Content */
        .modal-content {
            background-color: #fefefe;
            margin: auto;
            padding: 20px;
            border: 1px solid #888;
            width: 80%;
        }

        .close {
            color: #aaaaaa;
            float: right;
            font-size: 28px;
            font-weight: bold;
        }

        .close:hover,
        .close:focus {
            color: #000;
            text-decoration: none;
            cursor: pointer;
        }

        .input {
            display: block;
            width: 80%;
            margin: 8px;
        }
    </style>
</head>
<body>


<div id="modal" class="modal">
    <div class="modal-content">
        <span id="modal-close" class="close">&times;</span>
        <form>
            <input type="file" name="media" class="input">
            <input type="text" name="content" class="input">
            <input type="hidden" name="lat" class="input">
            <input type="hidden" name="lng" class="input">
            <input type="submit">
        </form>
    </div>
</div>


<div id="map"></div>
<script>
    var map;

    function initMap() {
        map = new google.maps.Map(document.getElementById('map'), {
            center: {lat: -34.397, lng: 150.644},
            zoom: 15
        });
        map.addListener('click', function (e) {
            page.modal.show();
        });
    }
</script>
<script async defer
        src="https://maps.googleapis.com/maps/api/js?key=AIzaSyA9OlshaErMHm0CRLm9tQalSD379fPWv3c&callback=initMap">
</script>
</body>

<script>
    var page = {
        modal: {
            _shown: false,
            _modal: document.getElementById('modal'),
            show: function () {
                this._shown = true;
                this._modal.style.display = "block";
            },
            hide: function () {
                this._shown = false;
                this._modal.style.display = "none";
            },
            isShown: function () {
                return this._shown;
            },
            views: {
                close: document.getElementById('modal-close')
            }
        },
        init: function () {
            page.modal.views.close.onclick = function () {
                page.modal.hide();
            };
        }
    };

    window.addEventListener('load', function () {
        page.init();
    });
</script>

</html>