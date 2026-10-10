
<html lang="zxx" data-bs-theme="light">

<head>
<!-- from _head.html -->
<!-- Favicon -->
<link rel="shortcut icon" href="<?= BASE_URL ?>themes/mombo/assets/img/favicon.ico">
<!-- Google Font -->
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>


<!--  original code -->
 <!--   @@include('./_head.html', {
    "path": "",
    "FontsURL":
    "https://fonts.googleapis.com/css2?family=Nunito+Sans:ital,opsz,wght@0,6..12,200;0,6..12,300;0,6..12,400;0,6..12,500;0,6..12,600;0,6..12,700;0,6..12,800;0,6..12,900;0,6..12,1000;1,6..12,200;1,6..12,300;1,6..12,400;1,6..12,500;1,6..12,600;1,6..12,700;1,6..12,800;1,6..12,900;1,6..12,1000&display=swap",
    "CSSName": "style",
    }) -->

 <!-- my attempt -->
<link rel="preconnect" href="https://fonts.googleapis.com/css2?family=Nunito+Sans:ital,opsz,wght@0,6..12,200;0,6..12,300;0,6..12,400;0,6..12,500;0,6..12,600;0,6..12,700;0,6..12,800;0,6..12,900;0,6..12,1000;1,6..12,200;1,6..12,300;1,6..12,400;1,6..12,500;1,6..12,600;1,6..12,700;1,6..12,800;1,6..12,900;1,6..12,1000&display=swap">

<!--  not seeing scroll.css  I added in style.css -->
    <link rel="stylesheet" type="text/css" href="<?= BASE_URL ?>themes/mombo/assets/css/style.css">
    <link rel="stylesheet" type="text/css" href="<?= BASE_URL ?>themes/mombo/assets/css/scroll.css">
</head>

<body>
<!-- from _skippy.html -->
<a id="skippy" class="skippy visually-hidden-focusable overflow-hidden" href="#content">
    <div class="container">
        <span class="u-skiplink-text">Skip to main content</span>
    </div>
</a>
<!-- End skippy -->
<!-- Preload -->
<div id="loading" class="loading-preloader bg-dark">
    <div class="loading-preloader-in">
        <div class="spinner-04">
            <span class="text-primary"></span>
        </div>
    </div>
</div>

    <!-- Skippy & Prload 
    @@include('./_skippy.html',{
    "path": "",
    }) -->
    <!-- Edn Skippy & Prload --> 
    <!-- 
    ========================
        Wrapper 
    ========================
    -->
    <div class="wrapper">
        <!-- Header -->
        <header class="header-main header-classic headroom navbar-light fixed-top">
            <nav class="navbar navbar-expand-lg">
                <div class="container position-relative">
                    <!-- Logo -->
                 <!--   <a class="navbar-brand header-navbar-brand" href="../index.html">
                        <img class="logo-dark" src="<?= BASE_URL ?>themes/mombo/assets/img/logo.svg" title="" alt=""> -->
                <a class="navbar-brand header-navbar-brand" href="../index.html">
                     <!--   <img class="logo-dark" src="<?= BASE_URL ?>welcome_module/images/smalllogodark.png" title="" alt=""> -->
                         <img class="logo-dark" src="<?= BASE_URL ?>images/logoblueongray.jpg" title="" alt="">                                
                   <!--     <img class="logo-light" src="<?= BASE_URL ?>themes/mombo/assets/img/logo-light.svg" title="" alt=""> -->

                        <img class="logo-light"  src="<?= BASE_URL ?>welcome_module/images/smallogolight.png" title="" alt="">
                    </a>
                    <!-- Logo -->
                    
                    <!-- Menu -->
                    <div class="collapse navbar-collapse one-page-nav" id="navbarSupportedContent">
                        <ul class="navbar-nav m-auto">
                            <li class="nav-item">
                                <a href="javascript:void(0);" data-scroll-nav="0" class="nav-link">Home</a>
                            </li>
                            <li class="nav-item">
                                <a href="javascript:void(0);" data-scroll-nav="1" class="nav-link">About</a>
                            </li>
                            <li class="nav-item">
                                <a href="javascript:void(0);" data-scroll-nav="2" class="nav-link">Feature</a>
                            </li>
                            <li class="nav-item">
                                <a href="javascript:void(0);" data-scroll-nav="3" class="nav-link">Price</a>
                            </li>
                            <li class="nav-item">
                                <a href="javascript:void(0);" data-scroll-nav="4" class="nav-link">FAQ's</a>
                            </li>
                        </ul>
                    </div>
                    <!-- End Menu -->
                    <div class="nav align-items-center">
                        <div class="nav-item dropdown me-3">
                            <button class="dropdown-toggle btn theme-switch-01" id="bd-theme" type="button" aria-expanded="false" data-bs-toggle="dropdown" data-bs-display="static">
                                <span class="bi theme-icon-active">
                                    <i class="bi-circle-half"></i>
                                </span>
                            </button>
                            <ul class="dropdown-menu dropdown-menu-end  shadow" aria-labelledby="bd-theme" style="--bs-dropdown-min-width: 8rem;">
                                <li>
                                    <button type="button" class="dropdown-item d-flex align-items-center" data-bs-theme-value="light">
                                        <span class="bi me-2 opacity-50 theme-icon">
                                            <i class="bi-sun-fill"></i>
                                        </span>
                                        Light
                                        <span class="bi ms-auto d-none">
                                            <i class="bi-check2"></i>
                                        </span>
                                    </button>
                                </li>
                                <li>
                                    <button type="button" class="dropdown-item d-flex align-items-center" data-bs-theme-value="dark">
                                        <span class="bi me-2 opacity-50 theme-icon">
                                            <i class="bi-moon-stars-fill"></i>
                                        </span>
                                        Dark
                                        <span class="bi ms-auto d-none">
                                            <i class="bi-check2"></i>
                                        </span>
                                    </button>
                                </li>
                                <li>
                                    <button type="button" class="dropdown-item d-flex align-items-center active" data-bs-theme-value="auto">
                                        <span class="bi me-2 opacity-50 theme-icon">
                                            <i class="bi-circle-half"></i>
                                        </span>
                                        Auto
                                        <span class="bi ms-auto d-none">
                                            <i class="bi-check2"></i>
                                        </span>
                                    </button>
                                </li>
                            </ul>
                        </div>
                        <a href="<?= BASE_URL ?>honcho/login" class="btn btn-sm btn-secondary mb-0 ms-2 text-nowrap d-none d-lg-flex">Login</a>
                        <!-- Mobile Toggle -->
                        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                            <span class="toggler-icon"></span>
                        </button>
                        <!-- End Mobile Toggle -->
                    </div>
                </div>
            </nav>
        </header>
        <!-- End Header -->
        <!-- Main -->
        <main>
            <!-- Section -->
            <section data-scroll-index="0" class="bg-gray-200 section pb-0">
                <div class="container">
                    <div class="row justify-content-center align-items-center pt-8">
                        <div class="col-12 col-lg-10 text-center wow fadeInUp" data-wow-duration="0.5s">
                            <h1 class="display-4 lh-1 fw-800 mb-4">Honcho enables you to take the bull by the horns to <span class="typed text-primary" data-elements="manage,grow,know "></span><br /> your organization like never before!</h1>
                            <div class="w-lg-90 w-xl-75 mx-auto">
                                <p class="fs-lg">Honcho enables you to "take the bull by the horns" when sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam.</p>
                            </div>
                        </div>
                        <div class="col-lg-7 pt-2 wow fadeInUp" data-wow-duration="0.5s" data-wow-delay="0.05s">
                            <form class="d-flex flex-row mb-2 p-1 bg-body input-group shadow-sm">
                                <input type="email" class="form-control form-control-lg rounded-0 border-0" placeholder="you@yoursite.com">
                                <button class="btn btn-primary rounded-0 flex-shrink-0" type="submit">Get Started</button>
                            </form>
                            <p class="m-0 pt-2 text-center">No credit card needed, cancel anytime</p>
                        </div>
                        <div class="col-lg-12 pt-5 wow fadeInUp" data-wow-duration="0.5s" data-wow-delay="0.1s">
                        <!--    <img src="<?= BASE_URL ?>themes/mombo/assets/img/home-banner/home-banner.jpg" title="" alt=""> -->
<img src="<?= BASE_URL ?>welcome_module/images/3people.png" title="" alt="">
                        </div>
                    </div>
                </div>
            </section>
            <!-- End Section -->
            <!-- Section -->
            <section data-scroll-index="1" class="section bg-gray-100">
                <div class="container">
                    <div class="row justify-content-center section-heading  wow fadeInUp" data-wow-duration="0.5s">
                        <div class="col-lg-8 text-center">
                            <h6 class="text-primary mb-4">What We provide</h6>
                            <h3 class="h1 mb-0">  honcho   We didn’t reinvent quotes. We just found a better way to create them.</h3>
                        </div>
                    </div>
                    <div class="row gy-4 justify-content-center">
                        <div class="col-12 col-lg-11 pb-8  wow fadeInUp" data-wow-duration="0.5s" data-wow-delay="0.05s">
                            <img class="shadow-sm rounded-3" src="../assets/img/feature/feature-01.jpg" title="" alt="">
                        </div>
                        <div class="col-md-4  wow fadeInUp" data-wow-duration="0.5s" data-wow-delay="0.05s">
                            <div class="text-center px-lg-5">
                                <h5 class="text-primary">Business Stratagy</h5>
                                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod</p>
                            </div>
                        </div>
                        <div class="col-md-4  wow fadeInUp" data-wow-duration="0.5s" data-wow-delay="0.1s">
                            <div class="text-center px-lg-5">
                                <h5 class="text-primary">Website Development</h5>
                                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod</p>
                            </div>
                        </div>
                        <div class="col-md-4  wow fadeInUp" data-wow-duration="0.5s" data-wow-delay="0.15s">
                            <div class="text-center px-lg-5">
                                <h5 class="text-primary">Marketing & Reporting</h5>
                                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod</p>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
            <!-- End Section -->
            <!-- Section -->
            <section data-scroll-index="2" class="section">
                <div class="container">
                    <div class="row gy-4 align-items-center">
                        <div class="col-lg-6 wow fadeInLeft" data-wow-duration="0.5s" data-wow-delay="0.1s">
                            <img src="../assets/img/feature/feature-01.jpg" title="" alt="">
                        </div>
                        <div class="col-lg-6 ps-xl-12  wow fadeInRight" data-wow-duration="0.5s" data-wow-delay="0.1s">
                            <h6 class="text-primary mb-3">1. Prepare your quote</h6>
                            <h3 class="h1 mb-3">Save even more time with templates</h3>
                            <p class="fs-lg">Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam.</p>
                            <div class="pt-2">
                                <a class="btn btn-primary-soft" href="#">Get Started Now</a>
                            </div>
                        </div>
                    </div>
                    <div class="row gy-4 align-items-center flex-row-reverse py-10">
                        <div class="col-lg-6 wow fadeInLeft" data-wow-duration="0.5s" data-wow-delay="0.1s">
                            <img src="../assets/img/feature/feature-01.jpg" title="" alt="">
                        </div>
                        <div class="col-lg-6 ps-xl-12 wow fadeInRight" data-wow-duration="0.5s" data-wow-delay="0.1s">
                            <h6 class="text-primary mb-3">2. Prepare your quote</h6>
                            <h3 class="h1 mb-3">Save even more time with templates</h3>
                            <p class="fs-lg">Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam.</p>
                            <div class="pt-2">
                                <a class="btn btn-primary-soft" href="#">Get Started Now</a>
                            </div>
                        </div>
                    </div>
                    <div class="row gy-4 align-items-center">
                        <div class="col-lg-6 wow fadeInLeft" data-wow-duration="0.5s" data-wow-delay="0.1s">
                            <img src="../assets/img/feature/feature-01.jpg" title="" alt="">
                        </div>
                        <div class="col-lg-6 ps-xl-12 wow fadeInRight" data-wow-duration="0.5s" data-wow-delay="0.1s">
                            <h6 class="text-primary mb-3">3. Prepare your quote</h6>
                            <h3 class="h1 mb-3">Save even more time with templates</h3>
                            <p class="fs-lg">Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam.</p>
                            <div class="pt-2">
                                <a class="btn btn-primary-soft" href="#">Get Started Now</a>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
            <!-- End Section -->
            <!-- Section -->
            <section data-scroll-index="3" class="section bg-gray-100">
                <div class="container">
                    <div class="row justify-content-center section-heading">
                        <div class="col-lg-8 col-xl-7 text-center wow fadeInUp" data-wow-duration="0.5s">
                            <h6 class="text-primary mb-3">Get comfy with Mombo for free</h6>
                            <h3 class="h1 mb-3">Get comfy with Mombo for free</h3>
                            <div class="fs-lg">Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam.</div>
                        </div>
                    </div>
                    <div class="row gy-4">
                        <div class="col-md-4 wow fadeInUp" data-wow-duration="0.5s" data-wow-delay="0.05s">
                            <div class="card">
                                <div class="card-body py-6 px-5">
                                    <h3>Free</h3>
                                    <p class="fs-lg">Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod</p>
                                    <div class="mb-4 pt-2">
                                        <h3 class="m-0">$0 USD<span class="fw-300 text-muted small">/mo</span></h3>
                                        <span>free forever</span>
                                    </div>
                                    <a class="btn btn-mode w-100" href="#">Get Started</a>
                                    <h6 class="mt-4">Everything included:</h6>
                                    <ul class="list-unstyled mb-0 pt-1">
                                        <li class="py-2"><i class="bi-check-circle-fill text-success me-1"></i> 10 GB of Space </li>
                                        <li class="py-2"><i class="bi-check-circle-fill text-success me-1"></i> Unlimited Projects</li>
                                        <li class="py-2"><i class="bi-check-circle-fill text-success me-1"></i> Unlimited Users</li>
                                        <li class="py-2"><i class="bi-check-circle-fill text-success me-1"></i> Unlimited Datas</li>
                                        <li class="pt-2"><i class="bi-check-circle-fill text-success me-1"></i> Unlimited File Recovery</li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4 wow fadeInUp" data-wow-duration="0.5s" data-wow-delay="0.05s">
                            <div class="card shadow-lg">
                                <div class="card-body py-6 px-5 position-relative">
                                    <span class="position-absolute top-0 start-0 bg-warning px-3 text-dark fw-700 small rounded-3 mt-n2 ms-4">Recommended</span>
                                    <h3>Agency</h3>
                                    <p class="fs-lg">Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod</p>
                                    <div class="mb-4 pt-2">
                                        <h3 class="m-0">$9.98 USD<span class="fw-300 text-muted small">/mo</span></h3>
                                        <span>per user, billed monthly</span>
                                    </div>
                                    <a class="btn btn-primary w-100" href="#">Get Started</a>
                                    <h6 class="mt-4">Everything included:</h6>
                                    <ul class="list-unstyled mb-0 pt-1">
                                        <li class="py-2"><i class="bi-check-circle-fill text-success me-1"></i> 10 GB of Space </li>
                                        <li class="py-2"><i class="bi-check-circle-fill text-success me-1"></i> Unlimited Projects</li>
                                        <li class="py-2"><i class="bi-check-circle-fill text-success me-1"></i> Unlimited Users</li>
                                        <li class="py-2"><i class="bi-check-circle-fill text-success me-1"></i> Unlimited Datas</li>
                                        <li class="py-2"><i class="bi-check-circle-fill text-success me-1"></i> Unlimited File Recovery</li>
                                        <li class="py-2"><i class="bi-check-circle-fill text-success me-1"></i> Advanced Branding </li>
                                        <li class="py-2"><i class="bi-check-circle-fill text-success me-1"></i> Ubranded Emails</li>
                                        <li class="py-2"><i class="bi-check-circle-fill text-success me-1"></i> Saved replies</li>
                                        <li class="py-2"><i class="bi-check-circle-fill text-success me-1"></i> Email signatures</li>
                                        <li class="pt-2"><i class="bi-check-circle-fill text-success me-1"></i> Unlimited File Recovery</li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4 wow fadeInUp" data-wow-duration="0.5s" data-wow-delay="0.05s">
                            <div class="card">
                                <div class="card-body py-6 px-5">
                                    <h3>Ultimate</h3>
                                    <p class="fs-lg">Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod</p>
                                    <div class="mb-4 pt-2">
                                        <h3 class="m-0">$59.98 USD<span class="fw-300 text-muted small">/mo</span></h3>
                                        <span>per user, billed monthly</span>
                                    </div>
                                    <a class="btn btn-mode w-100" href="#">Get Started</a>
                                    <h6 class="mt-4">Everything included:</h6>
                                    <ul class="list-unstyled mb-0 pt-1">
                                        <li class="py-2"><i class="bi-check-circle-fill text-success me-1"></i> 10 GB of Space </li>
                                        <li class="py-2"><i class="bi-check-circle-fill text-success me-1"></i> Unlimited Projects</li>
                                        <li class="py-2"><i class="bi-check-circle-fill text-success me-1"></i> Unlimited Users</li>
                                        <li class="py-2"><i class="bi-check-circle-fill text-success me-1"></i> Unlimited Datas</li>
                                        <li class="pt-2"><i class="bi-check-circle-fill text-success me-1"></i> Unlimited File Recovery</li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
            <!-- End Section -->
            <!-- Section -->
            <section class="section">
                <div class="container">
                    <div class="row align-items-center gy-4">
                        <div class="col-lg-6">
                            <div class="pe-lg-5 pe-xl-12 wow fadeInLeft" data-wow-duration="0.5s" data-wow-delay="0.1s">
                                <div class="icon-xl bg-primary rounded-circle text-white mb-4">
                                    <i class="bi bi-chat-left-quote"></i>
                                </div>
                                <p class="fs-4 text-mode fw-600">I wanted to move from Wordpress to an HTML site for page load speed reasons. After looking at a dozen packages, I decided "Tony" had what I needed.</p>
                                <div class="pt-3">
                                    <h6 class="mb-0 h5">Dick Grayson</h6>
                                    <span>Co-founder, pxdraft</span>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6 wow fadeInRight" data-wow-duration="0.5s" data-wow-delay="0.1s">
                            <img class="rounded-3" src="../assets/img/team/team-1.jpg" title="" alt="">
                        </div>
                    </div>
                </div>
            </section>
            <!-- End Section -->
            <!-- Section -->
            <section class="section bg-dark effect-section">
                <!-- @s BG Effect -->
                <div class="pe-none position-absolute start-0 top-0 mx-auto mt-n5 ms-n5 mt-lg-n10 ms-lg-n10 w-custom w-lg-custom" style="--bs-w-custom: 100px; --bs-w-lg-custom: 200px;">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 187 192" fill="none" class="text-warning w-100">
                        <path d="M49.234 40.7275C50.7799 37.5066 53.9267 35.3552 57.489 35.0836L119.332 30.3681C122.895 30.0965 126.331 31.746 128.348 34.6952L163.353 85.8953C165.369 88.8446 165.659 92.6455 164.113 95.8664L137.275 151.782C135.729 155.003 132.583 157.154 129.02 157.426L67.177 162.141C63.6147 162.413 60.178 160.763 58.1617 157.814L23.1563 106.614C21.1399 103.665 20.8501 99.8639 22.396 96.6431L49.234 40.7275Z" fill="currentColor"></path>
                    </svg>
                </div>
                <div class="pe-none position-absolute end-0 bottom-0 me-n4 mb-n4 me-lg-n8 mb-lg-n8 w-custom w-lg-custom" style="--bs-w-custom: 100px; --bs-w-lg-custom: 150px;">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 187 192" fill="none" class="text-warning">
                        <path d="M49.234 40.7275C50.7799 37.5066 53.9267 35.3552 57.489 35.0836L119.332 30.3681C122.895 30.0965 126.331 31.746 128.348 34.6952L163.353 85.8953C165.369 88.8446 165.659 92.6455 164.113 95.8664L137.275 151.782C135.729 155.003 132.583 157.154 129.02 157.426L67.177 162.141C63.6147 162.413 60.178 160.763 58.1617 157.814L23.1563 106.614C21.1399 103.665 20.8501 99.8639 22.396 96.6431L49.234 40.7275Z" fill="currentColor"></path>
                    </svg>
                </div>
                <img class="position-absolute bottom-0 start-0 pe-none w-custom w-lg-custom" style="--bs-w-custom: 100px; --bs-w-lg-custom: 250px;" src="../assets/img/effect/polygon-03.png" title="" alt="">
                <img class="position-absolute top-0 end-0 pe-none w-custom w-lg-custom" style="--bs-w-custom: 100px; --bs-w-lg-custom: 150px;" src="../assets/img/effect/polygon-04.png" title="" alt="">
                <!-- @E BG Effect -->
                <div class="container position-relative">
                    <div class="row justify-content-center">
                        <div class="col-lg-7 text-center  wow fadeInUp" data-wow-duration="0.5s">
                            <h1 class="display-4 text-white mb-3">We help to create visual strategies.</h1>
                            <p class="fs-lg m-0 text-white">Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod.</p>
                            <div class="pt-5">
                                <a class="btn btn-lg btn-primary mb-2" href="#">Get started now - it's free!</a>
                                <p class="m-0 pt-2 text-white small">No credit card needed, cancel anytime</p>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
            <!-- End Section -->
            <!-- Section -->
            <section data-scroll-index="4" class="section bg-gray-100">
                <div class="container pb-10">
                    <div class="row justify-content-center section-heading">
                        <div class="col-lg-8 col-xl-7 text-center  wow fadeInUp" data-wow-duration="0.5s">
                            <h6 class="text-primary mb-3">Frequently asked questions.</h6>
                            <h3 class="h1 mb-3">Questions? Fire away</h3>
                            <div class="fs-lg">Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam.</div>
                        </div>
                    </div>
                    <div class="row justify-content-center">
                        <div class="col-lg-10  wow fadeInUp" data-wow-duration="0.5s" data-wow-delay="0.05s">
                            <div class="accordion" id="accordionExample_01">
                                <div class="accordion-item bg-body">
                                    <p class="m-0 accordion-header" id="heading_01_1">
                                        <button class="py-3 accordion-button text-mode text-start fw-700" type="button" data-bs-toggle="collapse" data-bs-target="#collapse_01_1" aria-expanded="true" aria-controls="collapse_01_1">
                                            Can I change plans later on?
                                        </button>
                                    </p>
                                    <div id="collapse_01_1" class="accordion-collapse collapse show" aria-labelledby="heading_01_1" data-bs-parent="#accordionExample_01">
                                        <div class="accordion-body">
                                            <strong>This is the first item's accordion body.</strong> It is hidden by default, until the collapse plugin adds the appropriate classes that we use to style each element. These classes control the overall appearance, as well as the showing and hiding via CSS transitions. You can modify any of this with custom CSS or overriding our default variables. It's also worth noting that just about any HTML can go within the <code>.accordion-body</code>, though the transition does limit overflow.
                                        </div>
                                    </div>
                                </div>
                                <div class="accordion-item bg-body">
                                    <p class="m-0 accordion-header" id="heading_01_2">
                                        <button class="py-3 accordion-button text-mode text-start fw-700 collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapse_01_2" aria-expanded="false" aria-controls="collapse_01_2">
                                            What is the difference between Pro and Ultimate?
                                        </button>
                                    </p>
                                    <div id="collapse_01_2" class="accordion-collapse collapse" aria-labelledby="heading_01_2" data-bs-parent="#accordionExample_01">
                                        <div class="accordion-body">
                                            <strong>This is the second item's accordion body.</strong> It is hidden by default, until the collapse plugin adds the appropriate classes that we use to style each element. These classes control the overall appearance, as well as the showing and hiding via CSS transitions. You can modify any of this with custom CSS or overriding our default variables. It's also worth noting that just about any HTML can go within the <code>.accordion-body</code>, though the transition does limit overflow.
                                        </div>
                                    </div>
                                </div>
                                <div class="accordion-item bg-body">
                                    <p class="m-0 accordion-header" id="heading_01_3">
                                        <button class="py-3 accordion-button text-mode text-start fw-700 collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapse_01_3" aria-expanded="false" aria-controls="collapse_01_3">
                                            Can I try before I buy?
                                        </button>
                                    </p>
                                    <div id="collapse_01_3" class="accordion-collapse collapse" aria-labelledby="heading_01_3" data-bs-parent="#accordionExample_01">
                                        <div class="accordion-body">
                                            <strong>This is the third item's accordion body.</strong> It is hidden by default, until the collapse plugin adds the appropriate classes that we use to style each element. These classes control the overall appearance, as well as the showing and hiding via CSS transitions. You can modify any of this with custom CSS or overriding our default variables. It's also worth noting that just about any HTML can go within the <code>.accordion-body</code>, though the transition does limit overflow.
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
            <!-- End Section -->
            <!-- Section -->
            <section class="section pt-0">
                <div class="container">
                    <div class="row justify-content-center mt-n12">
                        <div class="col-10 col-sm-7 col-md-5 col-lg-4 wow fadeInUp" data-wow-duration="0.5s">
                            <div>
                                <img src="../assets/img/effect/free-1.svg" title="" alt="">
                            </div>
                        </div>
                    </div>
                    <div class="text-center pt-7 wow fadeInUp" data-wow-duration="0.5s" data-wow-delay="0.05s">
                        <h3 class="h1 pb-4">Change the way you<br /> work with clients forever.<br /> You’ll thank us later.</h3>
                        <a class="btn btn-lg btn-primary" href="#">Get started now - it's free!</a>
                        <p class="m-0 pt-2 small">No credit card needed, cancel anytime</p>
                    </div>
                </div>
            </section>
            <!-- End Section -->
        </main>
        <!-- End Main -->
        <!-- Footer -->
        @@include('./footer/_classic_footer_06.html', {
        "path": ".",
        "imgPath": "../../assets",
        })
        <!-- End Footer -->
    </div>
    <!-- 
    ========================
       End Wrapper 
    ========================
    -->
  
    <!-- script start 
    @@include('./_scripts.html', {
    "path": "",
    }) -->
    <!-- End script start -->

<!-- from _scripts.html -->

    <!-- jquery -->
<script src="<?= BASE_URL ?>themes/mombo/assets/js/jquery-3.5.1.min.js"></script>

<!--bootstrap-->
<script src="<?= BASE_URL ?>themes/mombo/assets/vendor/bootstrap/dist/js/bootstrap.bundle.min.js"></script>

<!-- Headroom JS -->
<script src="<?= BASE_URL ?>themes/mombo/assets/vendor/headroom/headroom.min.js"></script>

<!-- swiper JS -->
<script src="<?= BASE_URL ?>themes/mombo/assets/vendor/swiper/swiper-bundle.min.js"></script>

<!-- jarallax JS -->
<script src="<?= BASE_URL ?>themes/mombo/assets/vendor/jarallax/jarallax.min.js"></script>
<script src="<?= BASE_URL ?>themes/mombo/assets/vendor/jarallax/jarallax-video.min.js"></script>

<!-- magnific -->
<script src=" <?= BASE_URL ?>themes/mombo/assets/vendor/magnific/jquery.magnific-popup.min.js"></script>

<!-- isotope -->
<script src="<?= BASE_URL ?>themes/mombo/assets/vendor/isotope/isotope.pkgd.min.js"></script>

<!-- easypiechart -->
<script src="<?= BASE_URL ?>themes/mombo/assets/vendor/easy-pie-chart/jquery.easypiechart.min.js"></script>

<!-- typed -->
<script src="<?= BASE_URL ?>themes/mombo/assets/vendor/typed/typed.js"></script>

<!-- Purecounter -->
<script src="<?= BASE_URL ?>themes/mombo/assets/vendor/purecounter/purecounter_vanilla.js"></script>

<!-- Purecounter -->
<script src="<?= BASE_URL ?>themes/mombo/assets/vendor/wow/wow.min.js"></script>

<!-- working form -->
<script src="<?= BASE_URL ?>themes/mombo/assets/vendor/mail/js/form.min.js"></script>
<script src="<?= BASE_URL ?>themes/mombo/assets/vendor/mail/js/script.js"></script>

<!-- countdown JS -->
<script src="<?= BASE_URL ?>themes/mombo/assets/vendor/count-down/jquery.countdown.min.js"></script>

<!-- one-page JS -->
<script src="<?= BASE_URL ?>themes/mombo/assets/vendor/one-page/scrollIt.min.js"></script>

<!-- Theme JS -->
<script src="<?= BASE_URL ?>themes/mombo/assets/js/theme.js"></script>
<script src="<?= BASE_URL ?>themes/mombo/assets/js/color-modes.js"></script>
<script src="<?= BASE_URL ?>themes/mombo/assets/js/theme-jquery.js"></script>
</body>

</html>