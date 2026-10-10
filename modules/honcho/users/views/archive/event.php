<!-- Because we want to use the same header as the welcome page on all pages -->

<!-- start: Header-->
<!-- EXCEPTION: had to copy header file into donate directory in or to pass $data for the cart dropdown -->
<!-- <php include ('header.php'); ?> -->
<!-- end: Header -->

<!-- start: Header-->
<!-- ?php $layout = 'header' ?>
<= Modules::run('welcome/runlayout', $layout); ?>            
<!-- end: Header -->

        <div id="content" role="main">

            <div class="mb40"></div><!-- space -->

<!-- Begin page content -->
            <div class="container">

                <div class="row">
                     <div class="col-md-1">
                         
                     </div>
                    <div class="col-md-11">

                        <article class="entry single">

                            <div class="entry-media">
                                <?php if($filetype == 1) { ?>
                                    <figure>
                                            <img src=<?= BASE_URL ?>welcome-ccmps_module/chapter<?= $event->chapter ?>/<?= $event->largeimage ?> alt="Entry Title">
                                    </figure>
                                    <a>Type 1</a>

                                <?php } ?>

                                <?php if($filetype == 2) { ?>
<a>Type 2</a>
                                <?php } ?>


                                <?php if($filetype == 3) { ?>
                                    <figure>
                                            <img src=<?= BASE_URL ?>welcome-ccmps_module/chapter<?= $event->chapter ?>/<?= $event->largeimage ?> alt="Entry Title">
                                    </figure>
                                   <a>Type 3</a>
                                <?php } ?>

                            </div><!-- End .entry-media -->

                            <span class="entry-date">24<span>Feb</span></span>
                            <span class="entry-format"><i class="fa fa-file-image-o"></i></span>
                            <h2 class="entry-title"><?= $event->name ?></h2>
  <div class="mb40"></div><!-- space -->

                            <div class="entry-content">
                                <p><?= $event->fulldescription ?></p>
                                <p></p>
                              
                          <!--      <blockquote>
                                    <p>Mauris urna dolor, fringilla in vestibulum sed, porta sit amet nibh. Mauris consectetur neque quis arcu pellentesque porttitor. Aenean in diam ligula. Nam dui lacus, luctus a lobortis vitae, congue a mauris.</p>
                                    <cite>-- Kobe Bryant</cite>
                                </blockquote> -->
                               
                            </div><!-- End .entry-content -->


                        </article>

            <div class="mb40"></div><!-- space -->

                        <h2 class="title mb50"> Other Events <span class="light first-color">by <?= $affiliatename ?></span></h2>
                <div class="home-blogposts-carousel owl-carousel center-top-nav white-nav no-radius">

                        <?php foreach($rows as $row) { ?>

<?php if($row->id !== $id) { ?>
                    <article class="entry entry-box">


                                <?php if($row->filetype == 1 | $row->filetype == 3) { ?>
                                     <div class="entry-media">
                                        <figure>    

                                         <a href="#">
                                             <img src=<?= BASE_URL ?>welcome_module/<?= $row->listfile ?> alt="Entry Title">
                                         </a>
                                        </figure>
                                     </div><!-- End .entry-media -->
                                <?php } ?>

                                <?php if($row->filetype == 2) { ?>
                        <div class="entry-media embed-responsive embed-responsive-16by9">
                     <!--       <iframe class="embed-responsive-item" src="//player.vimeo.com/video/30173582?color=ffffff" width="500" height="281" allowfullscreen></iframe>  -->                            
                            <iframe class="embed-responsive-item" src=<?= BASE_URL ?><?= $row->listfile ?> width="648" height="430" allowfullscreen></iframe>
                        </div><!-- End .entry-media -->
                                <?php } ?>




    <!--      <div class="mb40"></div><-- space -->

                        <div class="entry-content-wrapper">
                            <span class="entry-date"><?= $row->day ?><span><?= $row->month ?></span></span>
                     <!--       <span class="entry-format"><i class="fa fa-file-video-o"></i></span> -->

                            <h2 class="entry-title"><a href="single.html"><?= $row->name ?></a></h2>
                        

                            <div class="entry-content">
                                <p><?= $row->shortdescription ?></p> <!-- a 10 Saturday Private Pilot Groundschool and Phase Three 15 hours of flight training all paid for by the Tuskeegee Airmen!</p> -->
                            </div><!-- End .entry-content -->
                        </div><!-- End .entry-content-wrapper -->

                        <footer class="entry-footer clearfix">
                     <!--       <span class="entry-cats">
                                <span class="entry-label"><i class="fa fa-tag"></i></span><a href="#">Life</a> 
                            </span><-- End .entry-tags --> 

                            <a href="<?= BASE_URL ?>welcome/events/<?= $row->id ?>/<?= $row->affiliate_id ?>" class="entry-readmore text-right">Read More <i class="fa fa-angle-right"></i></a>
                        </footer>
                    </article>
<?php } ?>
                        <?php } ?>
                </div><!-- End .blog-related-carousel -->
                <div class="text-center">
                    <div class="mb30 mb15-xs"></div><!-- space -->
                 <!--   <h4 class="mb20">Want to check out the complete Events Calendar?</h4>
                    <a href="<?= BASE_URL ?>welcome/events" class="btn btn-custom btn-border min-width radius-lger">Click Here</a> -->
                </div><!-- End .text-center -->


                    </div><!-- End .col-md-12 -->
                </div><!-- End .row -->
            </div><!-- End .container -->
<!-- End page content -->  

            <div class="mb40"></div><!-- space -->
<!-- Begin Footer -->

<!--  footer temp fix -->


<!-- End tep fix  -->

<!-- Because we want the flxibility of using a diiferent background on the page we are using a local footer -->
<!-- start: Footer-->
<!-- <php include('footer.php'); ?> -->                
<!-- end: Footer -->