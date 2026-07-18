<?php
    require_once "includes/header.php";
?>

<!-- Page Header Start -->
<div class="container-fluid page-header mb-5 position-relative overlay-bottom">
    <div class="d-flex flex-column align-items-center justify-content-center pt-0 pt-lg-5" style="min-height: 400px">
        <h1 class="display-4 mb-3 mt-0 mt-lg-5 text-white text-uppercase">Contact</h1>
    </div>
</div>
<!-- Page Header End -->

<!-- Contact Start -->
<div class="container-fluid pt-5">
    <div class="container">
        <div class="section-title">
            <h4 class="text-primary text-uppercase" style="letter-spacing: 5px;">Contact Us</h4>
            <h1 class="display-4">GET IN TOUCH</h1>
        </div>
        <div class="row px-3 pb-2">
            <div class="col-sm-4 text-center mb-3">
                <i class="fa fa-2x fa-map-marker-alt mb-3 text-primary"></i>
                <h4 class="font-weight-bold">Address</h4>
                <p>BAGUIO CITY, BENGUET</p>
            </div>
            <div class="col-sm-4 text-center mb-3">
                <i class="fa fa-2x fa-phone-alt mb-3 text-primary"></i>
                <h4 class="font-weight-bold">Phone</h4>
                <p>09692169432</p>
            </div>
            <div class="col-sm-4 text-center mb-3">
                <i class="far fa-2x fa-envelope mb-3 text-primary"></i>
                <h4 class="font-weight-bold">Email</h4>
                <p>MASAWRAP.com</p>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6 pb-5">
                <h1 class="mb-3">Join Us</h1>
                <h5 class="mb-3">We invite you to explore our collection of recipes, share your own, and join our community of food lovers. Follow us on social media and subscribe to our newsletter for the latest updates and exclusive content.</h5>
                <h1 class="mb-3">Contact Us</h1>
                <h5 class="mb-3">For inquiries, suggestions, or collaborations, please reach out to us at our social media platforms or fill out the contact form on our website.</h5>
            </div>
            <div class="col-md-6 pb-5">
                <div class="contact-form">
                    <div id="success"></div>
                    <form name="sentMessage" id="contactForm" novalidate="novalidate">
                        <div class="control-group">
                            <input type="text" class="form-control bg-transparent p-4" id="name" placeholder="Your Name"
                                required="required" data-validation-required-message="Please enter your name">
                            <p class="help-block text-danger"></p>
                        </div>
                        <div class="control-group">
                            <input type="email" class="form-control bg-transparent p-4" id="email" placeholder="Your Email"
                                required="required" data-validation-required-message="Please enter your email">
                            <p class="help-block text-danger"></p>
                        </div>
                        <div class="control-group">
                            <input type="text" class="form-control bg-transparent p-4" id="subject" placeholder="Subject"
                                required="required" data-validation-required-message="Please enter a subject">
                            <p class="help-block text-danger"></p>
                        </div>
                        <div class="control-group">
                            <textarea class="form-control bg-transparent py-3 px-4" rows="5" id="message" placeholder="Message"
                                required="required"
                                data-validation-required-message="Please enter your message"></textarea>
                            <p class="help-block text-danger"></p>
                        </div>
                        <div>
                            <button class="btn btn-primary font-weight-bold py-3 px-5" type="submit" id="sendMessageButton">SUBMIT</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Contact End -->

<!-- Thank You Message Start -->
<div class="container text-center my-5">
    <p class="lead">THANK YOU FOR VISITING MASA WRAP. LET'S KEEP THE FLAVORS OF THE PHILIPPINES ALIVE, ONE RECIPE AT A TIME.</p>
</div>
<!-- Thank You Message End -->

<?php 
    require_once "includes/footer.php";
    require_once "includes/java.php"
?>
