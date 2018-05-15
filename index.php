<!DOCTYPE html>
<html>
<?php

session_start();
if (empty($_SESSION['user'])){
    header('location: login.php');
}
include 'Database.php';
?>


<head>
    <title>Waves</title>
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
            width: 50%;
            text-align: center;
        }

        .modal-title {
            width: 100%;
            text-align: center;
        }


        .modal-reset {

        }

        .btn {
            width: 100px;
            text-align: center;
            margin:0 auto;
        }
    </style>
</head>
<body>


<div id="modal" class="modal">
    <div class="modal-content">
        <div id="title"></div>
        <div id="videoDiv">
            <video id="video" controls>
            </video>
        </div>
        <input type="reset" class="btn btn-danger modal-button modal-reset" id="modal-reset" value="close">
    </div>
</div>



<button style="position: absolute;
        z-index: 999;
        border-radius: 50%;width: 50px;height: 50px;
        background-image: url(./logout.png);
        bottom: 24px;
        background-repeat:no-repeat;
        background-size: 100% 100%;
        right: 24px;"
        onclick="javascript:window.location.replace('logout.php');"></button>

<div id="map"></div>
<script async defer
        src="https://maps.googleapis.com/maps/api/js?key=AIzaSyA9OlshaErMHm0CRLm9tQalSD379fPWv3c&callback=initMap">
</script>
</body>

<script>
    document.addEventListener('contextmenu', function (ev) {
        ev.preventDefault()
    });
    var page = {
        map: null,
        markers: [],
        waves: <?=json_encode(Database::getMedias())?>,
        form: document.getElementById('media-form'),
        modal: {
            _shown: false,
            _modal: document.getElementById('modal'),
            show: function (desc, url) {
                document.getElementById("title").innerHTML = desc;
                changeSource(url);
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
                stopVideo();
            };
        }
    };

    window.addEventListener('load', function () {
        page.init();
    });

    function initMap() {
        page.map = new google.maps.Map(document.getElementById('map'), {
            center: {lat: 33.892795, lng: 35.477759},
            zoom: 12,
            disableDefaultUI: true
        });
        // page.map.addListener('rightclick', function (e) {
        //     document.getElementById('media-lat').value = e.latLng.lat();
        //     document.getElementById('media-lng').value = e.latLng.lng();
        //     page.modal.show();
        // });
        page.waves.forEach(function (value) {
            var infowindow = new google.maps.InfoWindow({
                content: '<span style="max-width: 165px;display: block">' + value.Content + '</span>' + '<button onclick="view('+value.MediaId+')" class="btn">watch</button>'
            });
            var marker = new google.maps.Marker({
                position: {lat: value.Lng, lng: value.Lat},
                map: page.map,
                wave: value
            });
            infowindow.open(map, marker);
            page.markers.push(marker);
        });
    }

    function view(value){
        var _wave = page.waves.filter((x) => { return x.MediaId == value; });
        if(_wave.length == 0)
            return;
        console.log(_wave);
        var wave = _wave[0];
        page.modal.show(wave.Content, wave.MediaPath);
        console.log(wave);
    }


    function changeSource(url) {
        var video = document.getElementById('video');
        video.src = url;
        video.play();
    }



    function stopVideo() {
        var video = document.getElementById('video');
        video.pause();
    }
</script>

</html>