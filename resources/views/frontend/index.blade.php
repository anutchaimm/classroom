<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>League Learing</title>

    <!-- Css Style -->
    <link rel="stylesheet" href=" {{ asset('css/style.css')}}">

    <!-- Bootstrap 4 -->
    <link rel="stylesheet" href=" {{ asset('lib/bootstrap/css/bootstrap.min.css')}}">

    <!-- owl_carousel -->
    <link rel="stylesheet" href=" {{ asset('lib/owl_carousel/assets/owl.carousel.min.css')}}">
    <link rel="stylesheet" href=" {{ asset('lib/owl_carousel/assets/owl.theme.default.min.css')}}">

    <!-- Font Awesome JS -->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.11.2/css/all.css">

    <!-- animate.css -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/3.7.2/animate.min.css">

</head>

<body>

    <!---------------------------------- Header ---------------------------------->
    <header id="tp-heading">
        <nav class="navbar navbar-expand-lg navbar-light wow fadeInDown">
            <div class="container-fluid">
                <a class="navbar-brand text-uppercase" href="#"><i class="fas fa-book fa-lg pr-2"></i> <b>League</b>
                    <span class="text-muted">Learning</span></a>
                <button class="navbar-toggler d-lg-none border-0" type="button" data-toggle="modal"
                    data-target="#collapsibleNavId" aria-controls="collapsibleNavId" aria-expanded="false"
                    aria-label="Toggle navigation">
                    <i class="fas fa-align-right fa-lg text-white"></i>
                </button>
                <div class="collapse navbar-collapse">
                    <ul class="navbar-nav ml-auto mt-2 mt-lg-0">
                        <li class="nav-item pr-2">
                            <a class="nav-link text-uppercase" href="#definition">Introduction</a>
                        </li>
                        <li class="nav-item pr-2">
                            <a class="nav-link text-uppercase" href="#process-h">Process</a>
                        </li>
                        <li class="nav-item pr-2">
                            <a class="nav-link text-uppercase" href="#speciality">Component</a>
                        </li>
                        <li class="nav-item">
                        <a class="btn btn-nav px-5 py-1 text-uppercase" href="{{route('login')}}">Sign In</a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>

        <div id="h-content">
            <img class="h-rectangle" src="{{ asset('images/Rectangle/n-1.png')}}" alt="heading-Rectangle">
            <div class="container">
                <div class="row">
                    <div class="col-sm-7 col-md-6 col-lg-6">
                        <div class="text-left">
                            <h1 class="display-3 wow flip" data-wow-delay="0.1s">League Learning</h1>
                            <h1 class="display-3 wow flip" data-wow-delay="0.2s">Management</h1>
                            <h1 class="display-3 wow flip" data-wow-delay="0.3s">System</h1>
                            <a href="{{route('login')}}" class="btn btn-blue mt-4 btn-lg px-5 wow flipInY" data-wow-delay="0.4s">Get
                                Started</a>
                        </div>
                    </div>
                    <div class="col-sm-5  col-md-6 col-lg-6">
                        <img src="{{ asset('images/Rectangle/undraw_mobile_marketing_iqbr.svg')}}" class="wow flipInX"
                            data-wow-delay="0.4s" width="100%" alt="">
                    </div>
                </div>
            </div>
        </div>

        <!-- Modal collapsibleNavId -->
        <div class="modal fade" id="collapsibleNavId" tabindex="-1" role="dialog"
            aria-labelledby="collapsibleNavIdLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title text-uppercase" id="collapsibleNavIdLabel"><i
                                class="fas fa-book fa-lg pr-2"></i>
                            <b>League</b>
                            <span class="text-muted">Learning</span></h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body p-0">
                        <ul class="list-group list-group-flush">
                            <li class="list-group-item">
                                <a class="nav-link text-uppercase" href="#definition">Introduction</a>
                            </li>
                            <li class="list-group-item">
                                <a class="nav-link text-uppercase" href="#process-h">Process</a>
                            </li>
                            <li class="list-group-item">
                                <a class="nav-link text-uppercase" href="#speciality">Component</a>
                            </li>
                            <li class="list-group-item">
                                <a class="nav-link text-uppercase" href="{{route('login')}}">Sign In</a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </header>


    <!---------------------------------- League Learning Definition ---------------------------------->
    <section id="definition">
        <div class="container">
            <div class="row">
                <div class="col-md-6 col-lg-6">
                    <img src="{{ asset('images/Rectangle/undraw_browsing_urt9.svg')}}" class="wow bounceInLeft" data-wow-delay="0.1s"
                        width="100%">
                </div>
                <div class="col-md-6  col-lg-6 text-left">
                    <div class="card border-0 shadow wow bounceInRight" data-wow-delay="0.2s">
                        <div class="card-body">
                            <h1 class="display-4 wow bounceInRight" data-wow-delay="0.3s">Introduction
                            </h1>
                            <p class="wow bounceInRight" data-wow-delay="0.4s">League Learning is a learning model derived from League Tournament of conven-tional sports and E-Sports.
                                It encourages students to exhibit their potential and capabil-ity via competition in the form of one-on-one format.
                                Activities used in the competition may be chosen from games, quizzes, or any other activities that can provide conclusive competition result.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>


    <!---------------------------------- League Learning Process ---------------------------------->
    <section id="process-h">
        <div class="container">
            <div class="row">
                <div class="col-12 text-center">
                    <h1 class="display-4 wow bounceInUp" data-wow-delay="0.2s">League Learning Process</h1>
                </div>
            </div>
        </div>
    </section>

    <!---------------------------------- Coaching ---------------------------------->
    <section id="process-R">
        <img class="d-rectangle wow bounceInLeft" data-wow-delay="0.1s" src="{{ asset('images/Rectangle/n-4.png')}}">
        <div class="container">
            <div class="row">
                <div class="col-12 col-sm-6 col-lg-5">
                    <div class="card border-0 shadow wow bounceInLeft" data-wow-delay="0.2s">
                        <img class="card-img-top" src="{{ asset('images/bg_card/fallon-michael-rlxOGriu1ko-unsplash.jpg')}}" alt="">
                        <div class="card-body">
                            <h4 class="card-title">Coaching</h4>
                            <p class="card-text font-weight-light">First, teacher provides students motivation and teaches the lesson contents.
                                Teacher also provides students guidelines on how to train themselves before taking part in the upcoming competition.
                            </p>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-sm-6 col-lg-6">
                    <div class="text-left">
                        <h1 class="display-4 wow bounceInRight" data-wow-delay="0.2s">Coaching</h1>
                        <p class="text-muted wow bounceInRight" data-wow-delay="0.3s">Initially, teacher provides students motivation and teaches the lesson contents according to the lesson plan.
                            Teacher also provides students guidelines on how to train themselves before taking part in the upcoming competition.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </section>


    <!---------------------------------- Training ---------------------------------->
    <section id="process">
        <img class="p-rectangle wow bounceInRight" data-wow-delay="0.1s" src="{{ asset('images/Rectangle/n-4.png')}}">
        <div class="container">
            <div class="row">
                <div class="col-12 col-sm-6 col-lg-6">
                    <div class="card shadow border-0 wow bounceInRight d-block d-sm-none" data-wow-delay="0.2s">
                        <img class="card-img-top" src="{{ asset('images/bg_card/jr-korpa-stwHyPWNtbI-unsplash.jpg')}}" alt="">
                        <div class="card-body">
                            <h4 class="card-title">Training</h4>
                            <p class="card-text font-weight-light">It is note that all students may have to perform the Training stage individually at the first week, since the Pairing stage has not yet begun.</p>
                        </div>
                    </div>
                    <div class="text-right d-none d-sm-block">
                        <h1 class="display-4 wow bounceInLeft" data-wow-delay="0.2s">Training</h1>
                        <p class="text-muted wow bounceInLeft" data-wow-delay="0.3s">If students already have a partner, they can learn together in pair. They may review the learned contents, search for new information from other sources, prac-tice their skills, and exchange knowledges together with their couple.</p>
                    </div>
                </div>
                <div class="col-12 col-sm-6 col-lg-5">

                    <div class="card shadow border-0 wow bounceInRight d-none d-sm-block" data-wow-delay="0.2s">
                        <img class="card-img-top" src="{{ asset('images/bg_card/jr-korpa-stwHyPWNtbI-unsplash.jpg')}}" alt="">
                        <div class="card-body">
                            <h4 class="card-title">Training</h4>
                            <p class="card-text font-weight-light">If students already have a partner, they can learn together in pair. They may review the learned contents, search for new information from other sources, prac-tice their skills, and exchange knowledges together with their couple.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>


    <!---------------------------------- Competing ---------------------------------->
    <section id="process-R">
        <img class="d-rectangle wow bounceInLeft" data-wow-delay="0.1s" src="{{ asset('images/Rectangle/n-4.png')}}">
        <div class="container">
            <div class="row">
                <div class="col-12 col-sm-6 col-lg-5">
                    <div class="card border-0 shadow wow bounceInLeft" data-wow-delay="0.2s">
                        <img class="card-img-top" src="{{ asset('images/bg_card/kaze-0421-XW5BbnQ1I5w-unsplash.jpg')}}" alt="">
                        <div class="card-body">
                            <h4 class="card-title">Competing</h4>
                            <p class="card-text font-weight-light">The Competing stage is set up by using Round-Robin format. Each week, all students must take on the opponent in the form of one-on-one competition.
                            </p>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-sm-6 col-lg-6">
                    <div class="text-left">
                        <h1 class="display-4 wow bounceInRight" data-wow-delay="0.2s">Competing</h1>
                        <p class="text-muted wow bounceInRight" data-wow-delay="0.3s">The Competing stage is set up using Round-Robin format. Each week, all students must take on the selected opponent in the form of one-on-one competition according to match schedule set by the teacher. Those who win the competition receive 3 points, while those who lose receive no point. In case of draw, each will equally receive 1 point. Teacher may employ any kind of games, quizzes, or other related ac-tivities specific to subject and level of students in the competition. Nevertheless, it is very important that the results from competitions merely indicate individual perfor-mance. They must not be used as any kind of indicator of team performance as they are in the TGT. This is essentially to prevent any conflict among students in the team.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!---------------------------------- Declaring ---------------------------------->
    <section id="process">
        <img class="p-rectangle wow bounceInRight" data-wow-delay=".1s" src="{{ asset('images/Rectangle/n-4.png')}}">
        <div class="container">
            <div class="row">
                <div class="col-12 col-sm-6 col-lg-6">
                    <div class="card shadow border-0 wow bounceInRight d-block d-sm-none" data-wow-delay=".2s">
                        <img class="card-img-top" src="{{ asset('images/bg_card/rober-gonzalez-Ox3SuY9QbDU-unsplash.jpg')}}" alt="">
                        <div class="card-body">
                            <h4 class="card-title">Declaring</h4>
                            <p class="card-text font-weight-light">Each week, the results of all competitions are shown/summarized/displayed and the ranking is updated on the board.
                            </p>
                        </div>
                    </div>
                    <div class="text-right d-none d-sm-block">
                        <h1 class="display-4 wow bounceInLeft" data-wow-delay=".2s">Declaring</h1>
                        <p class="text-muted wow bounceInLeft" data-wow-delay=".3s">The results of all competitions are displayed on the Leaderboard. The ranking is calculated and updated on the board at weekly basis after the competitions are completed.</p>
                    </div>
                </div>
                <div class="col-12 col-sm-6 col-lg-5">
                    <div class="card shadow border-0 wow bounceInRight d-none d-sm-block" data-wow-delay=".2s">
                        <img class="card-img-top" src="{{ asset('images/bg_card/rober-gonzalez-Ox3SuY9QbDU-unsplash.jpg')}}" alt="">
                        <div class="card-body">
                            <h4 class="card-title">Declaring</h4>
                            <p class="card-text font-weight-light">The results of all competitions are displayed on the Leaderboard. The ranking is calculated and updated on the board at weekly basis after the competitions are completed.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>


    <!---------------------------------- Pairing ---------------------------------->
    <section id="process-R">
        <img class="d-rectangle wow bounceInLeft" data-wow-delay=".1s" src="{{ asset('images/Rectangle/n-4.png')}}">
        <div class="container">
            <div class="row">
                <div class="col-12 col-sm-6 col-lg-5">
                    <div class="card border-0 shadow wow bounceInLeft" data-wow-delay=".2s">
                        <img class="card-img-top" src="{{ asset('images/bg_card/yucel-moran-8cMPxOqkLE8-unsplash.jpg')}}" alt="">
                        <div class="card-body">
                            <h4 class="card-title">Pairing</h4>
                            <p class="card-text font-weight-light">The cooperation and collaboration are promoted by allowing students to work in pair. At this point, a student selects his/her partner and works together in order to achieve better performance in the upcoming competition.
                            </p>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-sm-6 col-lg-6">
                    <div class="text-left">
                        <h1 class="display-4 wow bounceInRight" data-wow-delay=".2s">Pairing</h1>
                        <p class="text-muted wow bounceInRight" data-wow-delay=".3s">This stage is mainly intended to promote cooperation and collaboration among students by allowing them to work in pair. At this point, a student selects his/her partner and works together in order to achieve better performance in the upcoming competition. In case of those who prefer to work individually, it is possible that they can opt to skip this pairing process so that they can proceed on their preferable learning style. Besides, students may quit their partnership and start working with a new one at any week. This is to make the pairing process more flexible, yet to prevent any kind of long-term conflict within the team as well. However, the pairing process is wide open to teachers to make their own decision on how the pairing be performed.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </section>


    <!---------------------------------- League Learning Alignment ---------------------------------->
    <section id="alignment">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <blockquote class="blockquote text-center">
                        <h2 class="mb-0 text-white font-weight-light">"League Learning is designed to meet Z-Generation students’ characteristics by employing competitive features from conventional sports and E-Sports"</h2>
                        <footer class="blockquote-footer text-white mt-3">Anutchai Chutipascharoen</cite>
                        </footer>
                    </blockquote>
                </div>
            </div>
        </div>
    </section>


    <!---------------------------------- League Learning Our Function Speciality ---------------------------------->
    <section id="speciality">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <h1 class="display-4 text-center mb-5 wow bounceInUp" data-wow-delay=".2s">Key Components
                    </h1>
                </div>
            </div>
            <div class="row row-cols-1 row-cols-sm-2 row-cols-md-2 row-cols-lg-4 mt-5">
                <div class="col mb-4">
                    <div class="card card-bg-1 h-100 wow bounceInLeft" data-wow-delay=".3s">
                        <div class="card-body text-center font-weight-light pt-5 pb-5">
                            <i class="fas fa-school fa-3x i-color-school"></i>
                            <h5 class="mt-4 mb-4">Classroom</h5>
                            <p class="card-text">In case, if there are more number of students than the number of classes. Students have to be divided into subgroups.
                                After that, each student must be assigned to a given division. It is very important to keep in mind that fairness must be applied equally to all students throughout the assessment, which is performed by teacher. </p>
                        </div>
                    </div>
                </div>
                <div class="col mb-4">
                    <div class="card card-bg-2 h-100 wow bounceInLeft" data-wow-delay=".4s">
                        <div class="card-body text-center font-weight-light pt-5 pb-5">
                            <i class="fas fa-sitemap fa-3x i-color-sitemap"></i>
                            <h5 class="mt-4 mb-4">League</h5>
                            <p class="card-text">The competition schedule is based on Round-Robin format so that all students within the division will have to meet others in the competitions. However, each pair will meet each other only once. An example of a competition schedule using Round-Robin format specifying the date and time of each match is depicted.
                            </p>
                        </div>
                    </div>
                </div>
                <div class="col mb-4">
                    <div class="card card-bg-3 h-100 wow bounceInLeft" data-wow-delay=".5s">
                        <div class="card-body text-center font-weight-light pt-5 pb-5">
                            <i class="fas fa-clipboard-list fa-3x i-color-clipboard"></i>
                            <h5 class="mt-4 mb-4">Leaderboard</h5>
                            <p class="card-text">The leaderboard show the number of wins, draws, losses, and points.
                                Student ranking in each division/the student’s point is/are sorted in descending order according to points. Teacher may present award to student(s), who perform(s) outstandingly.
                                </p>
                        </div>
                    </div>
                </div>
                <div class="col mb-4">
                    <div class="card card-bg-4 h-100 wow bounceInLeft" data-wow-delay=".6s">
                        <div class="card-body text-center font-weight-light pt-5 pb-5">
                            <i class="fas fa-user-friends fa-3x i-color-friends"></i>
                            <h5 class="mt-4 mb-4">Pairing & Social</h5>
                            <p class="card-text">Step 1:
                                Students in the upper zone can only pair up with students in the lower zone and vice versus.
                                Step 2:
                                Students are free to select partner in the other zone. The pairing must occur according to mutual satisfaction. However, students don’t need to make a pair, (if they are content to work independently on their own.)
                                Step 3:
                                At the end of each week, when all the competitions are finished, students may find their new partner, if they needed.
                                </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!---------------------------------- League Footer ---------------------------------->
    <footer id="tp-footer">
        <div class="container">
            <div class="col-12 text-center">
                <small> Copyright © 2020 Classroom - Designed by Anutchai</small>
            </div>
        </div>
    </footer>





    <!-- Bootstrap core JavaScript -->
    <script src="{{ asset('lib/jquery/jquery.min.js')}}"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"
        integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo"
        crossorigin="anonymous"></script>
    <script src="{{ asset('lib/bootstrap/js/bootstrap.min.js')}}"></script>

    <!-- owl_carousel core JavaScript -->
    <script src="{{ asset('lib/owl_carousel/owl.carousel.min.js')}}"></script>

    <!-- Style core JavaScript -->
    <script src="{{ asset('js/main.js')}}"></script>

    <!-- WOW -->
    <script src="{{ asset('lib/wow/wow.min.js')}}"></script>
    <script>
        new WOW().init();
    </script>


</body>

</html>
