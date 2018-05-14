<!DOCTYPE html>
<html>
<?php
include 'Database.php';

Database::getMedias();
if (!empty($_FILES['media'])) {
    if (!file_exists('uploads')) mkdir('uploads', 0777, true);
    $path = "uploads/";
    $path = $path . basename($_FILES['media']['name']);
    $uploaded = move_uploaded_file($_FILES['media']['tmp_name'], $path);
}

?>


<head>
    <title>Simple Map</title>
    <meta name="viewport" content="initial-scale=1.0">
    <meta charset="utf-8">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css"
          integrity="sha384-WskhaSGFgHYWDcbwN70/dfYBj47jz9qbsMId/iRN3ewGhXQFZCSftd1LZCfmhktB" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"
            integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo"
            crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"
            integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49"
            crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"
            integrity="sha384-smHYKdLADwkXOn1EmN1qk/HfnUcbVRZyYmZ4qpPea6sjB/pTJ0euyQp0Mk8ck+5T"
            crossorigin="anonymous"></script>

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
            padding: 2px;
            border: 1px solid #888;
            width: 80%;
        }

        .input {
            display: block;
            width: 100%;
            margin: 8px;
        }

        .modal-form {
            text-align: center;
        }

        .modal-button {
            float: right;
            margin-left: 4px;
        }

        .modal-confirm {

        }

        .modal-reset {

        }

        .modal-title {
            width: 100%;
            text-align: center;
        }
    </style>
</head>
<body>


<div id="modal" class="modal">
    <div class="modal-content">
        <form class="form-control modal-form" method="post" enctype="multipart/form-data">
            <div class="label modal-title">Hello World</div>
            <input type="file" name="media" class="form-control input">
            <input type="text" name="content" class="form-control input">
            <input type="hidden" name="lat" class="form-control input">
            <input type="hidden" name="lng" class="form-control input">
            <input type="submit" class="btn btn-info modal-button modal-confirm" name="submit">
            <input type="reset" class="btn btn-danger modal-button modal-reset" id="modal-reset" value="close">
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
            document.getElementById('modal-reset').onclick = function (ev) {
                page.modal.hide();
            }
        }
    };

    window.addEventListener('load', function () {
        page.init();
    });
</script>

</html>