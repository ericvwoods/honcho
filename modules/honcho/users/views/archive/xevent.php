<!-- Because we want to use the same header as the welcome page on all pages -->

<!-- start: Header-->
<!-- EXCEPTION: had to copy header file into donate directory in or to pass $data for the cart dropdown -->
<!-- <php include ('header.php'); ?> -->
<!-- end: Header -->

<!-- start: Header-->
<!-- ?php $layout = 'header' ?>
<= Modules::run('welcome/runlayout', $layout); ?>            
<!-- end: Header -->

<!-- Temp fix  -->
                <?php foreach($rows as $row) {?> <!--  only one row -->
                    <?php if($row->approved == 1) { ?>
                        <?php   $day              = $row->day; ?> 
                        <?php   $month            = $row->month; ?> 
                        <?php   $name             = $row->name; ?>
                        <?php   $affiliatename    = $row->affiliatename; ?>
                        <?php   $fulldescription  = $row->fulldescription; ?>
                        <?php   $fullsize         = $row->fullsize; ?>
                        <?php   $filetype         = $row->filetype; ?>
                        <?php   $listfile         = $row->listfile; ?>                
                        <?php   $id               = $row->id; ?>
                        <?php   $affiliate_id            = $row->affiliate_id; ?>
                    <?php } ?>
                <?php } ?>
<!-- <php print_r($row->month); die(); ?> I think print_r not working cuase values are obviously filling page-->
<!-- End Temp Fix -->


        <div id="content" role="main">

            <div class="mb40"></div><!-- space -->

<!-- Begin page content -->
            <div class="container">

                <div class="row">
                    <div class="col-md-12">

                        <article class="entry single">

                        <?php if($filetype == 3) { ?>

                                    <div id="post-id-1" class="entry-media carousel slide" data-ride="carousel" data-interval="7000">
                                        <div class="entry-media carousel-inner">
                                            <div class="item active">
                                                <a href="single.html"><img src="<?= BASE_URL ?>welcome_module/<?= $row->slider3 ?>" class="img-responsive" alt="Slider post 1"></a>
                                            </div><!-- End .item -->

                                            <div class="item">
                                                <a href="single.html"><img src="<?= BASE_URL ?>welcome_module/<?= $row->slider2 ?>" class="img-responsive" alt="Slider post 2"></a>
                                            </div><!-- End .item -->

                                            <div class="item">
                                                <a href="single.html"><img src="<?= BASE_URL ?>welcome_module/<?= $row->listfile ?>" class="img-responsive" alt="Slider post 3"></a>
                                            </div><!-- End .item -->
                                        </div><!-- End .carousel-inner -->

                                        <!-- Controls -->
                                        <a class="left carousel-control" href="#post-id-1" role="button" data-slide="prev"><i class="fa fa-angle-left"></i></a>
                                        <a class="right carousel-control" href="#post-id-1" role="button" data-slide="next"><i class="fa fa-angle-right"></i></a>
                                    </div><!-- End .entry-media -->

                        <?php } ?>

                        <?php if($filetype == 2) { ?>                         
                                    <div class="entry-media embed-responsive embed-responsive-16by9">
                                        <iframe class="embed-responsive-item" src=<?= $row->listfile ?> width="500" height="281" allowfullscreen></iframe>
                                    </div><!-- End .entry-media -->
                        <?php } ?>

                        <?php if($filetype == 1) { ?>                         
                            <div class="entry-media">
                                <figure>
                                        <img src=<?= BASE_URL ?>welcome_module/<?= $fullsize ?> alt="Entry Title">
                                </figure>
                            </div><!-- End .entry-media -->
                        <?php } ?>

                            <span class="entry-date"><?= $day ?><span><?= $month ?></span></span>
                            <p>
                            <span class="entry-format"><img src=<?= BASE_URL ?>welcome_module/<?= $row->affiliatelogo ?> ></span> 
                            <h2 class="entry-title"><?= $name ?></h2>

                            <div class="entry-content">
                                <p><?= $fulldescription  ?></p>
                            </div><!-- End .entry-content -->

                        <!--    <footer class="entry-footer clearfix">
                                <span class="entry-cats">
                                    <span class="entry-label"><i class="fa fa-tag"></i>Categories:</span><a href="#">Life</a>, <a href="#">Design</a>, <a href="#">Nature</a>
                                </span><-- End .entry-tags --
                                <span class="entry-separator">/</span>
                                <a href="#" class="entry-comments">10 Comments</a>
                                <span class="entry-separator">/</span>
                                by <a href="#" class="entry-author">Eon</a>
                                
                            </footer> -->


                        </article>

            <div class="mb40"></div><!-- space -->




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