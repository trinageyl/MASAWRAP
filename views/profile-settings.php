<!DOCTYPE html>
<html>
    <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta http-equiv="x-ua-compatible" content="ie=edge" />
    <title>MASA WRAP</title>
    <link rel="icon" href="img/mdb-favicon.ico" type="image/x-icon" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Alegreya:wght@400;600&family=Figtree:wght@300;600&family=Roboto+Condensed:wght@600&family=Yeseva+One&display=swap" rel="stylesheet">
        <link rel="stylesheet" href="css/styles.css">
        <link rel="stylesheet" href="css/media-queries.css">
        <!-- Bootstrap CSS -->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.2/css/all.min.css">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <link href="https://fonts.googleapis.com/css?family=Montserrat:300,400,500,600,700" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Rokkitt:100,300,400,700" rel="stylesheet">
    
    <!-- Animate.css -->
    <link rel="stylesheet" href="css/animate.css">
    <!-- Icomoon Icon Fonts-->
    <link rel="stylesheet" href="css/icomoon.css">
    <!-- Ion Icon Fonts-->
    <link rel="stylesheet" href="css/ionicons.min.css">
    <!-- Bootstrap  -->
    <link rel="stylesheet" href="css/bootstrap.min.css">

    <!-- Magnific Popup -->
    <link rel="stylesheet" href="css/magnific-popup.css">

    <!-- Flexslider  -->
    <link rel="stylesheet" href="css/flexslider.css">

    <!-- Owl Carousel -->
    <link rel="stylesheet" href="css/owl.carousel.min.css">
    <link rel="stylesheet" href="css/owl.theme.default.min.css">
    
    <!-- Date Picker -->
    <link rel="stylesheet" href="css/bootstrap-datepicker.css">
    <!-- Flaticons  -->
    <link rel="stylesheet" href="fonts/flaticon/font/flaticon.css">

    <!-- Theme style  -->
    <link rel="stylesheet" href="css/style.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">  
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">  
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.2/css/all.css" />
    <!-- Google Fonts Roboto -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500;700;900&display=swap" />
    <!-- MDB -->
    <link rel="stylesheet" href="css/bootstrap-login-form.min.css" />

    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-alpha1/dist/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-alpha1/dist/js/bootstrap.bundle.min.js">
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js">
    </head>

    <style>
        body {
            background-color: #f6f2e7;
            font-family: 'Figtree';
        }
        
        .featured-img{
            filter: brightness(0.9);
        }

        .featured h2{
            font-family: 'Figtree';
            font-size: 50px;
            text-shadow: 0 4px 6px rgba(0, 0, 0, 0.5);
            letter-spacing: 12px;
        }

        .desc h2{
            font-family: 'Figtree';
            font-size: 50px;
        }

        .border {
            background-color: white;
            border-radius: 20px;
            padding: 20px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.3);
        }

        .block-27 ul{
            display: block;
            margin: 0;
            margin-bottom: 30px;
        }

        .brands-banner {
            margin-top: 0;
        }

        .row-pb-md {
            padding-bottom: 0em !important;
        }

        .gradient-custom {
          /* fallback for old browsers */
          background: #6a11cb;

          /* Chrome 10-25, Safari 5.1-6 */
          background: -webkit-linear-gradient(to right, rgba(106, 17, 203, 1), rgba(37, 117, 252, 1));

          /* W3C, IE 10+/ Edge, Firefox 16+, Chrome 26+, Opera 12+, Safari 7+ */
          background: linear-gradient(to right, rgba(106, 17, 203, 1), rgba(37, 117, 252, 1))
        }

        .form-control:focus {
            box-shadow: none;
            border-color: #BA68C8
        }

        .text-right {
            font-family: 'Figtree';
            font-weight: bold;
            font-size: 35px;
            letter-spacing: 3px;
        }

        .row input {
            font-family: 'Roboto';
            outline: 3px solid #d9d9d9;
        }

        .profile-button {
            background: rgb(99, 39, 120);
            box-shadow: none;
            border: none
        }

        .profile-button:hover {
            background: #682773
        }

        .profile-button:focus {
            background: #682773;
            box-shadow: none
        }

        .profile-button:active {
            background: #682773;
            box-shadow: none
        }

        .back:hover {
            color: #682773;
            cursor: pointer
        }

        .labels {
            font-family: 'Figtree';
            font-size: 16px
        }

        .add-experience:hover {
            background: #BA68C8;
            color: #fff;
            cursor: pointer;
            border: solid 1px #BA68C8
        }

        .btn-container {
			display: flex;
			justify-content: center;
            gap: 40px;
			margin-bottom: 20px;
            
		}

        .edit-btn {
            display: inline-block;
            width: 140px; 
            padding: 10px;
            border: none;
            border-radius: 20px; 
            background-color:#4bb3b7; 
            color: #fff; 
            font-family: "Figtree";
            font-weight: bold; 
            font-size: 15px;
            letter-spacing: 4px; 
            cursor: pointer;
        }

        .edit-btn:hover {
            background-color: #3c8f92; 
        }

        .delete-btn {
            display: inline-block;
            width: 140px; 
            padding: 10px;
            border: none;
            border-radius: 20px; 
            background-color:#d8777c; 
            color: #fff; 
            font-family: "Figtree";
            font-weight: bold; 
            font-size: 15px;
            letter-spacing: 2px; 
            cursor: pointer;
        }

        .delete-btn:hover {
            background-color: #923c3c; 
        }
    </style>

    <body>

    <?php
    require_once "includes/header.php";
    include "includes/header2.php"; 
    $connection = new mysqli("localhost","root","","db_masawrap");
    ?>
    <div class="container-fluid page-header mb-5 position-relative overlay-bottom">
        <div class="d-flex flex-column align-items-center justify-content-center pt-0 pt-lg-5" style="min-height: 400px">
            <h1 class="display-4 mb-3 mt-0 mt-lg-5 text-white text-uppercase">PROFILE</h1>
        </div>
    </div>
    <div class="container rounded bg-white mt-5 mb-5">
    <div class="row">
        <div class="col-md-5 border-right">
            <div class="d-flex flex-column align-items-center text-center p-3 py-5">
                <img class="w-50" src="img/ak.png" alt="Image">
            </div>
            <div class="btn-container">
                <div class="mt-5"><button class="edit-btn" type="button">EDIT</button></div>
                <div class="mt-5"><button class="delete-btn" type="button">DELETE</button></div>
            </div>
        </div>

        <div class="col-md-7">
            <div class="p-3 py-5">
                
                <div class="row mt-3">
                    <div class="col-md-12"><label class="labels">Name</label><input type="text" class="form-control" placeholder="" value=""></div>
                    <div class="col-md-12"><label class="labels">Email</label><input type="text" class="form-control" placeholder="" value=""></div>
                    <div class="col-md-12"><label class="labels">Location</label><input type="text" class="form-control" placeholder="" value=""></div>
                    <div class="col-md-12"><label class="labels">Contact No.</label><input type="text" class="form-control" placeholder="" value=""></div>
                </div>
                <!-- <div class="row mt-3">
                    <div class="col-md-6"><label class="labels">Country</label><input type="text" class="form-control" placeholder="country" value=""></div>
                    <div class="col-md-6"><label class="labels">State/Region</label><input type="text" class="form-control" value="" placeholder="state"></div>
                </div> -->
                <!-- <div class="mt-5 text-center"><button class="btn btn-primary profile-button" type="button">Save Profile</button></div> -->
            </div>
        </div>
        
    </div>
</div>

        <?php require_once "includes/footer.php"; ?>
        
    </div>

    <div class="gototop js-top">
        <a href="#" class="js-gotop"><i class="ion-ios-arrow-up"></i></a>
    </div>
    
    <!-- jQuery -->
    <script src="js/jquery.min.js"></script>
   <!-- popper -->
   <script src="js/popper.min.js"></script>
   <!-- bootstrap 4.1 -->
   <script src="js/bootstrap.min.js"></script>
   <!-- jQuery easing -->
   <script src="js/jquery.easing.1.3.js"></script>
    <!-- Waypoints -->
    <script src="js/jquery.waypoints.min.js"></script>
    <!-- Flexslider -->
    <script src="js/jquery.flexslider-min.js"></script>
    <!-- Owl carousel -->
    <script src="js/owl.carousel.min.js"></script>
    <!-- Magnific Popup -->
    <script src="js/jquery.magnific-popup.min.js"></script>
    <script src="js/magnific-popup-options.js"></script>
    <!-- Date Picker -->
    <script src="js/bootstrap-datepicker.js"></script>
    <!-- Stellar Parallax -->
    <script src="js/jquery.stellar.min.js"></script>
    <!-- Main -->
    <script src="js/main.js"></script>

    </body>
</html>

