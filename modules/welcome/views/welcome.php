<!--
    Placeful Spaces — public homepage
    Save as: modules/welcome/views/welcome.php

    Assumes the Inspinia theme is served from the web root at /themes/inspinia/
    (i.e. public/themes/inspinia/... where public/ is your document root).
    If your document root or theme path differs, update the href/src paths below.

    TODO before launch:
      - Swap [Founder Name] / [Founder Bio] for the real thing
      - Replace the placeholder testimonial with a real client quote
      - Replace address / phone / email placeholders
      - Swap stock avatar images for real photos
      - Add real before/after project photos where noted
-->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="Placeful Spaces — professional home organizing. A place for everything and everything in its place.">
    <meta name="author" content="Placeful Spaces">

    <title>Placeful Spaces | Professional Home Organizing</title>

    <link href="<?= BASE_URL ?>/themes/inspinia/Landing_Page/css/bootstrap.min.css" rel="stylesheet">
    <link href="<?= BASE_URL ?>/themes/inspinia/Landing_Page/css/animate.css" rel="stylesheet">
    <link href="<?= BASE_URL ?>/themes/inspinia/Landing_Page/font-awesome/css/font-awesome.min.css" rel="stylesheet">
    <link href="<?= BASE_URL ?>/themes/inspinia/Landing_Page/css/style.css" rel="stylesheet">
</head>
<body id="page-top" class="landing-page">

<div class="navbar-wrapper">
    <nav class="navbar navbar-default navbar-fixed-top navbar-expand-md" role="navigation">
        <div class="container">
            <a class="navbar-brand" href="#page-top">Placeful Spaces</a>
            <div class="navbar-header page-scroll">
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbar">
                    <i class="fa fa-bars"></i>
                </button>
            </div>
            <div class="collapse navbar-collapse justify-content-end" id="navbar">
                <ul class="nav navbar-nav navbar-right">
                    <li><a class="nav-link page-scroll" href="#page-top">Home</a></li>
                    <li><a class="nav-link page-scroll" href="#features">Services</a></li>
                    <li><a class="nav-link page-scroll" href="#team">About</a></li>
                    <li><a class="nav-link page-scroll" href="#how-it-works">How It Works</a></li>
                    <li><a class="nav-link page-scroll" href="#testimonials">Testimonials</a></li>
                    <li><a class="nav-link page-scroll" href="#contact">Contact</a></li>
                    <li><a class="nav-link" href="<?= BASE_URL ?>welcome/login"><i class="fa fa-lock"></i>&nbsp; Login</a></li>
                </ul>
            </div>
        </div>
    </nav>
</div>

<!-- Hero -->
<div id="inSlider" class="carousel slide">
    <div class="carousel-inner" role="listbox">
        <div class="carousel-item active">
            <div class="container">
                <div class="carousel-caption">
                    <h1>A place for<br/>
                        everything, and<br/>
                        everything in its<br/>
                        place</h1>
                    <p>Placeful Spaces brings calm from chaos — professional home organizing for closets, kitchens, garages, and full-home resets.</p>
                    <p>
                        <a class="btn btn-lg btn-primary" href="#contact" role="button">Get a Free Consultation</a>
                        <a class="caption-link" href="#features" role="button">See Our Services</a>
                    </p>
                </div>
                <!-- TODO: replace with a real before/after or in-home photo -->
            </div>
            <div class="header-back one"></div>
        </div>
    </div>
</div>

<!-- Services -->
<section id="features" class="container services">
    <div class="row">
        <div class="col-sm-3">
            <h2>Closets &amp; Wardrobes</h2>
            <p>From walk-ins to reach-ins, we build systems that make getting dressed simple again.</p>
            <p><a class="navy-link" href="#contact" role="button">Get started &raquo;</a></p>
        </div>
        <div class="col-sm-3">
            <h2>Kitchens &amp; Pantries</h2>
            <p>Clear counters, labeled bins, and a layout that makes sense for how you actually cook.</p>
            <p><a class="navy-link" href="#contact" role="button">Get started &raquo;</a></p>
        </div>
        <div class="col-sm-3">
            <h2>Garages &amp; Storage</h2>
            <p>Reclaim the space you're paying for. Tools, seasonal gear, and everything else, sorted.</p>
            <p><a class="navy-link" href="#contact" role="button">Get started &raquo;</a></p>
        </div>
        <div class="col-sm-3">
            <h2>Full-Home &amp; Move Support</h2>
            <p>Moving in, moving out, or just ready for a reset — we handle spaces room by room or top to bottom.</p>
            <p><a class="navy-link" href="#contact" role="button">Get started &raquo;</a></p>
        </div>
    </div>
</section>

<!-- How It Works -->
<section id="how-it-works" class="container features">
    <div class="row">
        <div class="col-lg-12 text-center">
            <div class="navy-line"></div>
            <h1>How it works</h1>
            <p>A simple process, built around your space and your life.</p>
        </div>
    </div>
    <div class="row">
        <div class="col-md-3 text-center wow fadeInLeft">
            <i class="fa fa-phone features-icon"></i>
            <h2>1. Free Consultation</h2>
            <p>We talk through your space, your goals, and what hasn't been working.</p>
        </div>
        <div class="col-md-3 text-center wow fadeInLeft">
            <i class="fa fa-clipboard features-icon"></i>
            <h2>2. Custom Plan</h2>
            <p>We design a system tailored to how you actually live — not a one-size-fits-all template.</p>
        </div>
        <div class="col-md-3 text-center wow fadeInRight">
            <i class="fa fa-home features-icon"></i>
            <h2>3. Hands-On Organizing</h2>
            <p>Our team sorts, purges, and sets up the new system — start to finish.</p>
        </div>
        <div class="col-md-3 text-center wow fadeInRight">
            <i class="fa fa-heart features-icon"></i>
            <h2>4. It Sticks</h2>
            <p>Simple, sustainable systems that stay organized long after we leave.</p>
        </div>
    </div>
</section>

<!-- About / Founder -->
<section id="team" class="gray-section team">
    <div class="container">
        <div class="row m-b-lg">
            <div class="col-lg-12 text-center">
                <div class="navy-line"></div>
                <h1>About Placeful Spaces</h1>
                <p>Calm from chaos, one space at a time.</p>
            </div>
        </div>
        <div class="row justify-content-center">
            <div class="col-sm-4">
                <div class="team-member wow zoomIn">
                    <img src="/themes/inspinia/Landing_Page/img/avatar1.jpg" class="img-fluid rounded-circle" alt="Founder">
                    <h4><span class="navy">[Founder Name]</span></h4>
                    <p>[A short founder bio: how Placeful Spaces got started, what drew you to organizing, and what clients can expect working with you.]</p>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12 text-center m-t-lg m-b-lg">
                <p>Every project is supported by our trusted team of professional organizers, brought in project by project to match the size and scope of your space.</p>
            </div>
        </div>
    </div>
</section>

<!-- Testimonials -->
<section id="testimonials" class="navy-section testimonials" style="margin-top: 0">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 text-center wow zoomIn">
                <i class="fa fa-comment big-icon"></i>
                <h1>What our clients say</h1>
                <div class="testimonials-text">
                    <i>"[Add a real client testimonial here — a specific before/after result or how the experience felt works best.]"</i>
                </div>
                <small>
                    <strong>— [Client Name]</strong>
                </small>
            </div>
        </div>
    </div>
</section>

<!-- CTA (replaces pricing — consult-first, like most of the industry) -->
<section id="cta" class="pricing">
    <div class="container">
        <div class="row m-b-lg">
            <div class="col-lg-12 text-center">
                <div class="navy-line"></div>
                <h1>Ready to get organized?</h1>
                <p>Every space is different, so every quote is too. Tell us about your project and we'll take it from there.</p>
                <a class="btn btn-lg btn-primary" href="#contact" role="button">Request Your Free Consultation</a>
            </div>
        </div>
    </div>
</section>

<!-- Contact -->
<section id="contact" class="gray-section contact">
    <div class="container">
        <div class="row m-b-lg">
            <div class="col-lg-12 text-center">
                <div class="navy-line"></div>
                <h1>Contact Us</h1>
                <p>Tell us a bit about your space and we'll be in touch.</p>
            </div>
        </div>
        <div class="row m-b-lg justify-content-center">
            <div class="col-lg-3">
                <address>
                    <strong><span class="navy">Placeful Spaces</span></strong><br/>
                    [Address / service area]<br/>
                    <abbr title="Phone">P:</abbr> [phone number]
                </address>
            </div>
            <div class="col-lg-4">
                <p class="text-color">
                    Serving [your service area]. Reach out for a free, no-pressure consultation — we'll talk through your space and put together a plan that fits.
                </p>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12 text-center">
                <a href="mailto:hello@placefulspaces.com" class="btn btn-primary">Send us mail</a>
                <p class="m-t-sm">
                    Or follow us on social platform
                </p>
                <ul class="list-inline social-icon">
                    <li class="list-inline-item"><a href="#"><i class="fa fa-instagram"></i></a></li>
                    <li class="list-inline-item"><a href="#"><i class="fa fa-facebook"></i></a></li>
                    <li class="list-inline-item"><a href="#"><i class="fa fa-pinterest"></i></a></li>
                </ul>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12 text-center m-t-lg m-b-lg">
                <p><strong>&copy; <?php echo date('Y'); ?> Placeful Spaces</strong><br/> A place for everything, and everything in its place.</p>
            </div>
        </div>
    </div>
</section>

<script src="<?= BASE_URL ?>/themes/inspinia/Landing_Page/js/jquery-2.1.1.js"></script>
<script src="<?= BASE_URL ?>/themes/inspinia/Landing_Page/js/pace.min.js"></script>
<script src="<?= BASE_URL ?>/themes/inspinia/Landing_Page/js/bootstrap.min.js"></script>
<script src="<?= BASE_URL ?>/themes/inspinia/Landing_Page/js/classie.js"></script>
<script src="<?= BASE_URL ?>/themes/inspinia/Landing_Page/js/cbpAnimatedHeader.js"></script>
<script src="<?= BASE_URL ?>/themes/inspinia/Landing_Page/js/wow.min.js"></script>
<script src="<?= BASE_URL ?>/themes/inspinia/Landing_Page/js/inspinia.js"></script>
</body>
</html>
