
<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>School</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.1/css/brands.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="style.css">
    <link rel="shortcut icon" href="./favicon.jpg" type="image/x-icon">
    <script src="./javascript/function.js"></script>
    
<body>
    <?php 
    include 'partials/header.php';
    include './partials/youtubeinsta.php';
//     if(isset($_GET['logoutsuccess']) && $_GET['logoutsuccess']=="true"){
//        echo '<div id="hello" class="logout alert alert-success alert-dismissible fade show my-0" role="alert">
//     <strong>Suceess </strong> You are logout sucessfully.
//     <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
//   </div>';
//   }
?>

    <div id="carouselExampleIndicators" class="carousel slide">
        <div class="carousel-indicators">
            <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="0" class="active"
                aria-current="true" aria-label="Slide 1"></button>
            <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="1"
                aria-label="Slide 2"></button>
            <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="2"
                aria-label="Slide 3"></button>
        </div>
        <div class="carousel-inner">
            <div class="carousel-item active">
                <img src="img/100.jpg" class="d-block w-100" alt="...">
            </div>
            <div class="carousel-item">
                <img src="..." class="d-block w-100" alt="...">
            </div>
            <div class="carousel-item">
                <img src="..." class="d-block w-100" alt="...">
            </div>
        </div>
        <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleIndicators"
            data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Previous</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleIndicators"
            data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Next</span>
        </button>
    </div>
    <div class="container3">
        <marquee behavior="" direction="" style="margin-top:5px;color:white;">Admissions Open for Academic Year 2025–26</marquee>
    </div>
    <section class="welcomes">
        <h1>Welcome to</h1>
        <h2>SRM Modern Public School</h2>
        <p>Established in 2010, our school fosters academic excellence, creativity, and character development, providing
            a supportive and innovative learning environment.</p>
    </section>

    <div class="schoolvideo">
        <h1>About Our School</h1>
        <div class="aboutvideo">
            <div class="aboutindex">
                <p>Established in 2010, our school is dedicated to academic excellence, innovation, and holistic
                    development. We provide a nurturing environment that fosters creativity, critical thinking, and
                    strong moral values. With experienced faculty, modern facilities, and a commitment to student
                    success, we empower learners to reach their full potential and become responsible global citizens.
                </p>
            </div>
            <iframe src="https://www.youtube.com/embed/vmpbkDc_EDM?si=nTQGn2ESTQMMCmlj" title="YouTube video player"
                frameborder="0"
                allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share"
                referrerpolicy="strict-origin-when-cross-origin" allowfullscreen></iframe>
        </div>
    </div>
    <div class="facilities_index">
        <h2>Facilities at SRM School</h2>
        <div class="facilities_card">
            <div class="card" style="width: 14rem;">
                <img src="./img/i8.jpg" class="card-img-top" alt="...">
                <div class="card-body" style="background-color:rgb(177, 86, 26);">
                    <h3 class="card-title">Smart Classrooms</h3>
                    <p class="card-text">Smart classrooms use technology to create interactive, engaging, and efficient
                        learning environments.</p>
                </div>
            </div>
            <div class="card" style="width: 14rem;">
                <img src="./img/i7.jpg" class="card-img-top" alt="...">
                <div class="card-body" style="background-color:rgb(152, 185, 22);">
                    <h3 class="card-title">Library</h3>
                    <p class="card-text">Library facilities provide books, study spaces, digital resources, internet
                        access, and research assistance services.</p>
                </div>
            </div>
            <div class="card" style="width: 14rem;">
                <img src="./img/playground.jpg" class="card-img-top" alt="...">
                <div class="card-body" style="background-color:rgb(52, 126, 200);">
                    <h3 class="card-title">Playground</h3>
                    <p class="card-text">A playground offers swings, slides, climbing structures, and open space for
                        children’s fun, exercise, and social interaction.</p>
                </div>
            </div>
            <div class="card" style="width: 14rem;">
                <img src="./img/i6.jpg" class="card-img-top" alt="...">
                <div class="card-body" style="background-color:rgb(111, 52, 200);">
                    <h3 class="card-title">Conference Room</h3>
                    <p class="card-text">A school conference room is for meetings, discussions, and presentations.</p>
                </div>
            </div>
            <div class="card" style="width: 14rem;">
                <img src="./img/i1.jpg" class="card-img-top" alt="...">
                <div class="card-body" style="background-color:rgb(200, 52, 72);">
                    <h3 class="card-title">Computer Lab</h3>
                    <p class="card-text">A computer lab offers students access to computers, internet, software, and
                        digital tools for learning.</p>
                </div>
            </div>
            <div class="card" style="width: 14rem;">
                <img src="./img/hall.jpeg" class="card-img-top" alt="...">
                <div class="card-body" style="background-color:rgb(52, 200, 82);">
                    <h3 class="card-title">Multi-Purpose Hall</h3>
                    <p class="card-text">Multi-purpose hall serves activities like meetings, events, sports, and
                        cultural programs in schools.</p>
                </div>
            </div>
            <div class="card" style="width: 14rem;">
                <img src="./img/i5.jpg" class="card-img-top" alt="...">
                <div class="card-body" style="background-color:rgb(175, 52, 200);">
                    <h3 class="card-title">Transport</h3>
                    <p class="card-text">School transport ensures safe travel for students through buses, vans, and
                        other vehicles with proper supervision.</p>
                </div>
            </div>
            <div class="card" style="width: 14rem;">
                <img src="./img/i2.jpg" class="card-img-top" alt="...">
                <div class="card-body" style="background-color:rgb(200, 89, 52);">
                    <h3 class="card-title">Physics Lab</h3>
                    <p class="card-text">A physics lab provides equipment, tools, and experiments for students to
                        explore physical principles and concepts.</p>
                </div>
            </div>
            <div class="card" style="width: 14rem;">
                <img src="./img/i3.jpg" class="card-img-top" alt="...">
                <div class="card-body" style="background-color:rgb(52, 158, 200);">
                    <h3 class="card-title">Chemistry Lab</h3>
                    <p class="card-text">A chemistry lab provides chemicals, equipment, and safety tools for students to
                        conduct experiments.</p>
                </div>
            </div>
            <div class="card" style="width: 14rem;">
                <img src="./img/i4.jpg" class="card-img-top" alt="...">
                <div class="card-body" style="background-color:rgb(200, 153, 52);">
                    <h3 class="card-title">Biology Lab</h3>
                    <p class="card-text">Biology lab provides microscopes, specimens, equipment for students to study
                        living organisms and life sciences.</p>
                </div>
            </div>
        </div>
    </div>
    <div class="curriculum">
        <h2>Curriculum Overview</h2>
        <div class="curriculum_card">
            <div class="card" style="width: 23rem;">
                <img src="./img/sci.jpg" class="card-img-top" alt="...">
                <div class="card-body">
                    <h3 class="card-title">Science Exhibition</h3>
                    <p class="card-text">Science exhibition showcases student innovations, experiments, models, creativity, teamwork, problem-solving, and scientific learning.</p>
                </div>
            </div>
            <div class="card" style="width: 23rem;">
                <img src="./img/art.jpg" class="card-img-top" alt="...">
                <div class="card-body">
                    <h3 class="card-title">Arts & Craft</h3>
                    <p class="card-text">Arts and crafts involve creating decorative or functional objects using various materials, techniques, and creativity.</p>
                </div>
            </div>
            <div class="card" style="width: 23rem;">
                <img src="./img/sport.jpg" class="card-img-top" alt="...">
                <div class="card-body">
                    <h3 class="card-title">National Sport Day</h3>
                    <p class="card-text">National Sports Day in schools promotes fitness, teamwork, discipline, competitions, motivation, and honoring athletes' contributions.</p>
                </div>
            </div>
            <div class="card" style="width: 23rem;">
                <img src="./img/rangoli.jpg" class="card-img-top" alt="...">
                <div class="card-body">
                    <h3 class="card-title">Rangoli Competition</h3>
                    <p class="card-text">Rangoli competition showcases creativity, tradition, colors, patterns, teamwork, cultural art, and festive spirit beautifully.</p>
                </div>
            </div>
            <div class="card" style="width: 23rem;">
                <img src="./img/debate.jpg" class="card-img-top" alt="...">
                <div class="card-body">
                    <h3 class="card-title">Debate Competition</h3>
                    <p class="card-text">Debate competition enhances reasoning, confidence, communication, research, teamwork, critical thinking, and persuasive speaking skills.</p>
                </div>
            </div>
            <div class="card" style="width: 23rem;">
                <img src="./img/art.jpg" class="card-img-top" alt="...">
                <div class="card-body">
                    <h3 class="card-title">Card title</h3>
                    <p class="card-text">Some quick example text to build on the card title and make up the bulk of the
                        card's content.</p>
                </div>
            </div>
        </div>
    </div>
    <?php include 'partials/footer.php'?>

    <script>
    // Toggle sidebar
    function toggleSidebar() {
        document.getElementById('scrollSidebar').classList.toggle('show');
    }
    // Auto-show after 2s
    setTimeout(() => {
        document.getElementById('scrollSidebar').classList.add('show');
    }, 2000);
    // Hide on click outside
    document.addEventListener('click', (e) => {
        const sidebar = document.getElementById('scrollSidebar');
        if (!sidebar.contains(e.target)) {
            sidebar.classList.remove('show');
        }
    });
    </script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"
        integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js"
        integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy" crossorigin="anonymous">
    </script>
</body>

</html>
