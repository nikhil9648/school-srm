<<<<<<< HEAD
<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.1/css/brands.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="style.css">
    <link rel="shortcut icon" href="./favicon.jpg" type="image/x-icon">
    <script src="./javascript/function.js"></script>
    <style>
       #fullscreen-container {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.9);
            justify-content: center;
            align-items: center;
            flex-direction: column;
        }

        #fullscreen-image {
            max-height: 90%;
            max-width: 90%;
        }

        /* Navigation Buttons */
        .arrow {
            position: fixed;
            top: 50%;
            transform: translateY(-50%);
            font-size: 40px;
            color: white;
            cursor: pointer;
            background: rgba(0, 0, 0, 0.5);
            padding: 10px;
            border: none;
            z-index: 1000;
            user-select: none;
        }

        .arrow#left {
            left: 20px;
        }

        .arrow#right {
            right: 20px;
        }

        #close-button {
            position: fixed;
            top: 20px;
            right: 20px;
            color: white;
            font-size: 24px;
            cursor: pointer;
            z-index: 1000;
            user-select: none;
        }
    </style>
</head>

<body>
    <?php include 'partials/header.php';
    include './partials/youtubeinsta.php'; ?>
    <div class="photogallery">
        <h1 style="text-align:center;margin:20px;">Photo Gallery</h1>
        <div class="photo">
            <div><img src="img/5001.jpg" alt="" id="image" style="cursor: pointer;" onclick="viewFullscreen(this)"></div>
            <div><img src="img/5002.jpg" alt="" id="image" style="cursor: pointer;" onclick="viewFullscreen(this)"></div>
            <div><img src="img/5004.jpg" alt="" id="image" style="cursor: pointer;" onclick="viewFullscreen(this)"></div>
            <div><img src="img/5005.jpg" alt="" id="image" style="cursor: pointer;" onclick="viewFullscreen(this)"></div>
            <div><img src="img/5006.jpg" alt="" id="image" style="cursor: pointer;" onclick="viewFullscreen(this)"></div>
            <div><img src="gallery_img/IMG-20250605-WA0007.jpg" alt="" id="image" style="cursor: pointer;" onclick="viewFullscreen(this)"></div>
            <div><img src="gallery_img/IMG-20250605-WA0008.jpg" alt="" id="image" style="cursor: pointer;" onclick="viewFullscreen(this)"></div>
            <div><img src="gallery_img/IMG-20250605-WA0009.jpg" alt="" id="image" style="cursor: pointer;" onclick="viewFullscreen(this)"></div>
            <div><img src="gallery_img/IMG-20250605-WA0010.jpg" alt="" id="image" style="cursor: pointer;" onclick="viewFullscreen(this)"></div>
            <div><img src="gallery_img/IMG-20250605-WA0011.jpg" alt="" id="image" style="cursor: pointer;" onclick="viewFullscreen(this)"></div>
            <div><img src="gallery_img/IMG-20250605-WA0012.jpg" alt="" id="image" style="cursor: pointer;" onclick="viewFullscreen(this)"></div>
            <div><img src="gallery_img/IMG-20250605-WA0013.jpg" alt="" id="image" style="cursor: pointer;" onclick="viewFullscreen(this)"></div>
            <div><img src="gallery_img/IMG-20250605-WA0014.jpg" alt="" id="image" style="cursor: pointer;" onclick="viewFullscreen(this)"></div>
            <div><img src="gallery_img/IMG-20250605-WA0015.jpg" alt="" id="image" style="cursor: pointer;" onclick="viewFullscreen(this)"></div>
            <div><img src="gallery_img/IMG-20250605-WA0016.jpg" alt="" id="image" style="cursor: pointer;" onclick="viewFullscreen(this)"></div>
            <div><img src="img/debate.jpg" alt="" id="image" style="cursor: pointer;" onclick="viewFullscreen(this)"></div>
            <div><img src="img/art.jpg" alt="" id="image" style="cursor: pointer;" onclick="viewFullscreen(this)"></div>
            <div><img src="img/rangoli.jpg" alt="" id="image" style="cursor: pointer;" onclick="viewFullscreen(this)"></div>
            <div><img src="img/25.jpg" alt="" id="image" style="cursor: pointer;" onclick="viewFullscreen(this)"></div>
            <div><img src="img/55.jpg" alt="" id="image" style="cursor: pointer;" onclick="viewFullscreen(this)"></div>
            <div><img src="img/5007.jpg" alt="" id="image" style="cursor: pointer;" onclick="viewFullscreen(this)"></div>
            <div><img src="img/5008.jpg" alt="" id="image" style="cursor: pointer;" onclick="viewFullscreen(this)"></div>
            <div><img src="img/5009.jpg" alt="" id="image" style="cursor: pointer;" onclick="viewFullscreen(this)"></div>
        </div>
    </div>
    <div class="photogallery">
        <h1 style="text-align:center;margin:20px;">Video Gallery</h1>
        <div class="photo">
            <div><video src="video/45.mp4" controls></video></div>
            <!-- <div><video src="video/51.mp4" style="rotate:-90deg;" controls></video></div> -->
            <div><video src="video/5655.mp4" controls></video></div>
            <div><video src="video/45.mp4" controls></video></div>
            <div><video src="video/dfgh.mp4" controls></video></div>
            <div><video src="video/4846554.mp4" controls></video></div>
            <div><video src="video/dfgvhn.mp4" controls></video></div>
            <!-- <div><video src="video/v3.mp4" controls></video></div> -->
            <!-- <div><video src="video/3.mp4"></video></div>
            <div><video src="video/3.mp4"></video></div>
            <div><video src="video/3.mp4"></video></div>
            <div><video src="video/3.mp4"></video></div> -->

        </div>

    </div>
    <?php include 'partials/footer.php'?>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"
        integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js"
        integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy" crossorigin="anonymous">
    </script>
    <script>
    function viewFullscreen(img) {
        if (img.requestFullscreen) {
            img.requestFullscreen();
        } else if (img.webkitRequestFullscreen) { /* Safari */
            img.webkitRequestFullscreen();
        } else if (img.msRequestFullscreen) { /* IE11 */
            img.msRequestFullscreen();
        }
    }
    
    </script>
</body>

=======
<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.1/css/brands.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="style.css">
    <script src="./javascript/function.js"></script>
    <style>
       #fullscreen-container {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.9);
            justify-content: center;
            align-items: center;
            flex-direction: column;
        }

        #fullscreen-image {
            max-height: 90%;
            max-width: 90%;
        }

        /* Navigation Buttons */
        .arrow {
            position: fixed;
            top: 50%;
            transform: translateY(-50%);
            font-size: 40px;
            color: white;
            cursor: pointer;
            background: rgba(0, 0, 0, 0.5);
            padding: 10px;
            border: none;
            z-index: 1000;
            user-select: none;
        }

        .arrow#left {
            left: 20px;
        }

        .arrow#right {
            right: 20px;
        }

        #close-button {
            position: fixed;
            top: 20px;
            right: 20px;
            color: white;
            font-size: 24px;
            cursor: pointer;
            z-index: 1000;
            user-select: none;
        }
    </style>
</head>

<body>
    <?php include 'partials/header.php';
    include './partials/youtubeinsta.php'; ?>
    <div class="photogallery">
        <h1 style="text-align:center;margin:20px;">Photo Gallery</h1>
        <div class="photo">
            <div><img src="img/2.jpg" alt="" id="image" style="cursor: pointer;" onclick="viewFullscreen(this)"></div>
            <div><img src="img/g4.webp" alt="" id="image" style="cursor: pointer;" onclick="viewFullscreen(this)"></div>
            <div><img src="img/g5.jpg" alt="" id="image" style="cursor: pointer;" onclick="viewFullscreen(this)"></div>
            <div><img src="img/g6.jpg" alt="" id="image" style="cursor: pointer;" onclick="viewFullscreen(this)"></div>
            <div><img src="img/g7.jpg" alt="" id="image" style="cursor: pointer;" onclick="viewFullscreen(this)"></div>
            <div><img src="img/g8.jpg" alt="" id="image" style="cursor: pointer;" onclick="viewFullscreen(this)"></div>
            <div><img src="img/g4.webp" alt="" id="image" style="cursor: pointer;" onclick="viewFullscreen(this)"></div>
            <div><img src="img/g5.jpg" alt="" id="image" style="cursor: pointer;" onclick="viewFullscreen(this)"></div>
            <div><img src="img/g6.jpg" alt="" id="image" style="cursor: pointer;" onclick="viewFullscreen(this)"></div>
            <div><img src="img/g7.jpg" alt="" id="image" style="cursor: pointer;" onclick="viewFullscreen(this)"></div>
            <div><img src="img/g8.jpg" alt="" id="image" style="cursor: pointer;" onclick="viewFullscreen(this)"></div>
            <div><img src="img/g4.webp" alt="" id="image" style="cursor: pointer;" onclick="viewFullscreen(this)"></div>
        </div>
    </div>
    <div class="photogallery">
        <h1 style="text-align:center;margin:20px;">Video Gallery</h1>
        <div class="photo">
            <div><video src="video/v1.mp4" controls></video></div>
            <div><video src="video/v3.mp4" controls></video></div>
            <div><video src="video/v1.mp4" controls></video></div>
            <div><video src="video/v3.mp4" controls></video></div>
            <div><video src="video/v1.mp4" controls></video></div>
            <div><video src="video/v3.mp4" controls></video></div>
            <div><video src="video/v1.mp4" controls></video></div>
            <div><video src="video/v3.mp4" controls></video></div>
            <!-- <div><video src="video/3.mp4"></video></div>
            <div><video src="video/3.mp4"></video></div>
            <div><video src="video/3.mp4"></video></div>
            <div><video src="video/3.mp4"></video></div> -->

        </div>

    </div>
    <?php include 'partials/footer.php'?>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"
        integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js"
        integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy" crossorigin="anonymous">
    </script>
    <script>
    function viewFullscreen(img) {
        if (img.requestFullscreen) {
            img.requestFullscreen();
        } else if (img.webkitRequestFullscreen) { /* Safari */
            img.webkitRequestFullscreen();
        } else if (img.msRequestFullscreen) { /* IE11 */
            img.msRequestFullscreen();
        }
    }
    
    </script>
</body>

>>>>>>> 4beebbdc82d2827daeeae769b710cb7c6b78c248
</html>