
<!-- start: Header -->
 <?php include('header.php'); ?>               
<!-- end: Header -->

   <div class="boss-loader-overlay"></div><!-- End .boss-loader-overlay -->

    <div id="wrapper">
        <header class="side-menu header-side-menu navbar-white left" role="banner">
            <button type="button" class="btn-toggle side-menu-btn pull-right collapsed" data-toggle="collapse" data-target="#main-navbar-container">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
            </button>
            <div class="side-menu-wrapper">
                <h1 class="logo text-center">
                    <a href="index.html" title="Boss - Multipurpose Premium Html5 Template">
                        <img src="<?= BASE_URL ?>welcome_module/images/bpalogo125x103.jpg" alt="Logo">
                    </a>
                </h1>
          <!--      <div id="header-search-form">
                    <form class="navbar-form">
                        <input type="search" id="s" name="s" class="form-control" placeholder="Search in here...">
                        <button type="submit" class="btn-circle" title="Search"><i class="fa fa-search"></i></button>
                    </form>
                </div><!-- End #header-search-form -->
                <nav>
                    <ul class="nav navbar-nav nav-stacked">
                        <li>
                            <a href="index.html"><i class="fa fa-home"></i>Home - Versions<span class="angle"></span></a>
                            <ul>
                                <li><a href="index.html">Home - Version 1</a></li>

                            </ul>
                        </li>
                        <li>
                            <a href="index.html"><i class="fa fa-sitemap"></i>Pages - Versions<span class="angle"></span></a>
                            <ul>
                                <li><a href="aboutus.html">About - Agency</a></li>
           
                                <li><a href="events.html">Events - Grid 1</a></li>
                                <li><a href="events-right-sidebar.html">Events - Grid 2</a></li>
                                <li><a href="events-left-sidebar.html">Events - Grid 3</a></li>
                                <li><a href="events-list.html">Events - List 1</a></li>
                                <li><a href="events-list-right-sidebar.html">Events - List 2</a></li>
                                <li><a href="events-list-left-sidebar.html">Events - List 3</a></li>
                                <li><a href="knowledge.html">knowledge Base 1</a></li>
                                <li><a href="knowledge2.html">knowledge Base 2</a></li>
                                <li><a href="knowledge3.html">knowledge Base 3</a></li>
                                <li><a href="testimonials.html">Testimonials - Page</a></li>
                                <li><a href="testimonials2.html">Testimonials - Page 2</a></li>
                                <li><a href="testimonials3.html">Testimonials - Page 3</a></li>
                                <li><a href="team.html">Team - Page</a></li>

                            </ul>
                        </li>
                        <li>
                            <a href="#"><i class="fa fa-shopping-cart"></i>Shop - Pages<span class="angle"></span></a>
                            <ul>
                                <li><a href="#">Category - Grid<span class="angle"></span></a>
                                    <ul>
                                        <li><a href="category.html">Grid - Right Sidebar</a></li>

                                    </ul>
                                </li>
                                <li><a href="#">Category - List<span class="angle"></span></a>
                                    <ul>
                                        <li><a href="category-list.html">List - Right Sidebar</a></li>

                                    </ul>
                                </li>
                                <li>
                                    <a href="#">Product Pages<span class="angle"></span></a>
                                    <ul>
                                        <li><a href="product.html">Product - Version 1</a></li>

                                    </ul>
                                </li>
                                <li><a href="cart.html">Shopping Cart</a></li>

                                <li>
                                    <a href="#">Login<span class="angle"></span></a>
                                    <ul>
                                        <li><a href="login.html">Login - Version 1</a></li>

                                    </ul>
                                </li>
                                <li><a href="register.html">Register - Version 1</a></li>

                            </ul>
                        </li>
                        <li>
                            <a href="#"><i class="fa fa-trophy"></i>Portfolio - Pages<span class="angle"></span></a>
                            <ul>
                                <li><a href="#">FullWidth<span class="angle"></span></a>
                                    <ul>
                                        <li><a href="portfolio-masonry-fullwidth-6col.html">Masonry - 6 Columns</a></li>

                                    </ul>
                                </li>
                                <li><a href="#">Boxed<span class="angle"></span></a>
                                    <ul>
                                        <li><a href="portfolio-masonry-4col.html">Masonry - 4 Columns</a></li>

                                    </ul>
                                </li>
                                <li>
                                    <a href="#">Single<span class="angle"></span></a>
                                    <ul>
                                        <li><a href="single-portfolio.html">Single - Image</a></li>

                                    </ul>
                                </li>
                            </ul>
                        </li>
                        <li>
                            <a href="#"><i class="fa fa-comments-o"></i>Blog - Pages<span class="angle"></span></a>
                            <ul>
                                <li>
                                    <a href="#">Blog - Simple<span class="angle"></span></a>
                                    <ul>
                                        <li><a href="blog.html">Blog Simple</a></li>

                                    </ul>
                                </li>
                                <li>
                                    <a href="#">Blog - Classic<span class="angle"></span></a>
                                    <ul>
                                        <li><a href="blog-classic-fullwidth.html">Blog - Fullwidth</a></li>

                                    </ul>
                                </li>
                                <li>
                                    <a href="#">Blog - List<span class="angle"></span></a>
                                    <ul>
                                        <li><a href="blog-list-left-sidebar.html">List - Left Sidebar</a></li>

                                    </ul>
                                </li>
                                <li>
                                    <a href="#">Masonry - Boxed<span class="angle"></span></a>
                                    <ul>
                                        <li><a href="blog-masonry-left-sidebar.html">Blog - Left Sidebar</a></li>

                                    </ul>
                                </li>
                                <li>
                                    <a href="#">Masonry - Fullwidth<span class="angle"></span></a>
                                    <ul>
                                        <li><a href="blog-masonry-fullwidth-3col.html">Masonry - 3 Columns</a></li>

                                    </ul>
                                </li>
                                <li>
                                    <a href="#">Blog - Timeline<span class="angle"></span></a>
                                    <ul>
                                        <li><a href="blog-timeline.html">Timeline - Version 1</a></li>

                                    </ul>
                                </li>
                                <li><a href="single.html">Blog Post</a></li>

                            </ul>
                        </li>
                        <li>
                            <a href="index.html"><i class="fa fa-cogs"></i>Boss - elements<span class="angle"></span></a>
                            <ul>
                                <li>
                                    <a href="#">Elements<span class="angle"></span></a>
                                    <ul>
                                        <li><a href="elements-tabs.html">Elements - Tabs</a></li>

                                    </ul>
                                </li>
                                <li>
                                    <a href="#">Header - Versions<span class="angle"></span></a>
                                    <ul>
                                        <li><a href="header.html">Header - Version 1</a></li>

                                    </ul>
                                </li>
                                <li>
                                    <a href="#">Footer - Versions<span class="angle"></span></a>
                                    <ul>

                                    </ul>
                                </li>                               
                            </ul>
                        </li>
                        <li>
                            <a href="#"><i class="fa fa-map-marker"></i>Contact - Pages<span class="angle"></span></a>
                            <ul>
                                <li><a href="contact.html">Contact - Version 1</a></li>

                            </ul>
                        </li>
                        <li><a href="<?= BASE_URL ?>welcome/logout/compccmp"><i class="fa fa-sign-out"></i>Logout</a></li>
                    </ul>
                </nav>
            </div><!-- End .side-menu-wrapper -->
        </header><!-- end .side-menu -->

        <div id="main-content"> <!-- Begin Content -->
        </div><!-- End #content -->
    </div><!-- End #wrapper -->
    <a href="#top" id="scroll-top" class="smaller dark no-radius" title="Back to Top"><i class="fa fa-angle-up"></i></a>
	<!-- END -->

            <div class="container">
  
            <div id="content" role="main" class="no-padding">
                <div class="container">
<!-- Stuff goes here  --> 

  <a>Hello World</a>




      			</div><!-- End .container -->
            </div><!-- End #content -->

            </div><!-- End .container -->

    <!--    </div><!-- End #content -->




    </div><!-- End #wrapper -->
    <a href="#top" id="scroll-top" class="smaller dark no-radius" title="Back to Top"><i class="fa fa-angle-up"></i></a>
	<!-- END -->

<!-- start: Footer -->
 <?php include('footer.php'); ?>               
<!-- end: Footer -->

