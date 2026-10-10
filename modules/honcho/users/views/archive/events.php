

        <div id="content" role="main">

            <div class="mb40"></div><!-- space -->

<!-- Begin page content -->

            <div class="container">

                <div class="row">
                        <div class="col-md-2">
                        </div>

                    <div class="col-md-8">

                <?php foreach($eventsdata as $row) { ?>
                  <?php if($row->approved == 1) { ?>
                    <?php if($row->filetype == 1) { ?>

                        <article class="entry">
                            <span class="entry-date"><?= $row->day ?><span><?= $row->month ?></span></span>

                            <span class="entry-format"><img src=<?= BASE_URL ?>welcome-ccmps_module/chapter<?= $row->chapter ?>/<?= $row->orglogo ?> ></span> 
                            <div class="row">
                                <div class="col-md-6">
                                     
                                    <div class="entry-media">
                                        <figure>
                                            <a href="single.html">
                                                <img src=<?= BASE_URL ?>welcome-ccmps_module/chapter<?= $row->chapter ?>/<?= $row->smallimage ?> alt="Entry Title">
                                            </a>
                                        </figure>
                                    </div><!-- End .entry-media -->

                                </div><!-- End .col-md-6 -->

                                <div class="col-md-6">
                            
                                    <h2 class="entry-title"><a href="single.html"><?= $row->title ?></a></h2>

                                    <div class="entry-content">
                                        <p><?= $row->shortdescription ?></p>
                                    </div><!-- End .entry-content -->

                                    <footer class="entry-footer clearfix">

 <?php if (strlen($row->fulldescription)>0) { ?> 

 <a href="events/<?= $row->id ?>/<?= $row->orgid ?>" class="entry-readmore text-right">Read more <i class="fa fa-angle-right"></i></a>

 <?php } ?>                                        
                                    </footer>
                                </div><!-- End .col-md-6 -->
                            </div><!-- End .row -->

                        </article>
                    <?php } ?>

                    <?php if($row->filetype == 2) { ?>
                        <article class="entry">
                            <span class="entry-date"><?= $row->day ?><span><?= $row->month ?></span></span>
                        <!--    <span class="entry-format"><i class="fa fa-file-video-o"></i></span> -->
                              <span class="entry-format"><img src=<?= BASE_URL ?>welcome-ccmps_module/chapter<?= $row->chapter ?>/<?= $row->orglogo ?> ></span> 

                            <div class="row">
                                <div class="col-md-6">

                                    <div class="entry-media embed-responsive embed-responsive-16by9">
                                        <iframe class="embed-responsive-item" src=<?= $row->smallimage ?> width="500" height="281" allowfullscreen></iframe>
                                    </div><!-- End .entry-media -->
                                </div><!-- End .col-md-6 -->

                                <div class="col-md-6">

                                    <h2 class="entry-title"><a href="single.html"><?= $row->title ?></a></h2>

                                    <div class="entry-content">
                                        <p><?= $row->shortdescription ?></p>
                                    </div><!-- End .entry-content -->

                                    <footer class="entry-footer clearfix">
 <?php if (strlen($row->fulldescription)>0) { ?> 

 <a href="events/<?= $row->id ?>/<?= $row->orgid ?>" class="entry-readmore text-right">Read more <i class="fa fa-angle-right"></i></a>

 <?php } ?>
                                        
                                    </footer>
                                </div><!-- End .col-md-6 -->
                            </div><!-- End .row -->

                        </article>
                    <?php } ?>


                    <?php if($row->filetype == 3) { ?>
                        <article class="entry">
                            <span class="entry-date"><?= $row->day ?><span><?= $row->month ?></span></span>
                        <!--    <span class="entry-format"><i class="fa fa-file-image-o"></i></span> -->
                             <span class="entry-format"><img src=<?= BASE_URL ?>welcome-ccmps_module/chapter<?= $row->chapter ?>/<?= $row->orglogo ?> ></span> 

                            <div class="row">
                                <div class="col-md-6">

                                    <div id="post-id-1" class="entry-media carousel slide" data-ride="carousel" data-interval="7000">
                                        <div class="entry-media carousel-inner">
                                            <div class="item active">
                                                <a href="single.html"><img src="<?= BASE_URL ?>welcome-ccmps_module/chapter<?= $row->chapter ?>/<?= $row->slider1 ?>" class="img-responsive" alt="Slider post 1"></a>
                                            </div><!-- End .item -->

                                            <div class="item">
                                                <a href="single.html"><img src="<?= BASE_URL ?>welcome-ccmps_module/chapter<?= $row->chapter ?>/<?= $row->slider2 ?>" class="img-responsive" alt="Slider post 2"></a>
                                            </div><!-- End .item -->

                                            <div class="item">
                                                <a href="single.html"><img src="<?= BASE_URL ?>welcome-ccmps_module/chapter<?= $row->chapter ?>/<?= $row->slider3 ?>" class="img-responsive" alt="Slider post 3"></a>
                                            </div><!-- End .item -->
                                        </div><!-- End .carousel-inner -->

                                        <!-- Controls -->
                                        <a class="left carousel-control" href="#post-id-1" role="button" data-slide="prev"><i class="fa fa-angle-left"></i></a>
                                        <a class="right carousel-control" href="#post-id-1" role="button" data-slide="next"><i class="fa fa-angle-right"></i></a>
                                    </div><!-- End .entry-media -->

                                </div><!-- End .col-md-6 -->
                                <div class="col-md-6">
                            
                                    <h2 class="entry-title"><a href="single.html"><?= $row->title ?></a></h2>

                                    <div class="entry-content">
                                        <p><?= $row->shortdescription ?></p>
                                    </div><!-- End .entry-content -->

                                    <footer class="entry-footer clearfix">
 <?php if (strlen($row->fulldescription)>0) { ?> 

 <a href="events/<?= $row->id ?>/<?= $row->orgid ?>" class="entry-readmore text-right">Read more <i class="fa fa-angle-right"></i></a>

 <?php } ?>
                                   <!--     <span class="entry-cats">
                                            <span class="entry-label"><i class="fa fa-tag"></i>Categories:</span> <a href="#">Design</a>, <a href="#">Nature</a>
                                        </span><!-- End .entry-tags --
                                        <span class="entry-separator">/</span>
                                        <a href="#" class="entry-comments">8 Comments</a>
                                        <span class="entry-separator">/</span>
                                        by <a href="#" class="entry-author">Eon</a> -->
                                        
                                    </footer>
                                </div><!-- End .col-md-6 -->
                            </div><!-- End .row -->

                        </article>
                    <?php } ?>

                    <?php if($row->filetype == 0) { ?>                    
                        <article class="entry">

                            <span class="entry-date"><?= $row->day ?><span><?= $row->month ?></span></span>
                            <span class="entry-format"><img src=<?= BASE_URL ?>welcome-ccmps_module/chapter<?= $row->chapter ?>/<?= $row->orglogo ?> ></span> 


                        <h2 class="entry-title"><a href="single.html"><?= $row->title ?></a></h2>
                            <div class="entry-content entry-blockquote">
                                <blockquote>
                                    <p><?= $row->shortdescription ?></p>
                                </blockquote>
                            </div><!-- End .entry-content -->
                                    <footer class="entry-footer clearfix">
 <?php if (strlen($row->fulldescription)>0) { ?> 

 <a href="events/<?= $row->id ?>/<?= $row->orgid ?>" class="entry-readmore text-right">Read more <i class="fa fa-angle-right"></i></a>

 <?php } ?>                                    
                                    </footer>
                        </article>
                    <?php } ?>
                                <?php } ?>
                <?php } ?>
                        <nav class="pagination-container text-right">
                            <ul class="pagination">
                                <li>
                                    <a href="#" aria-label="Previous">
                                        <span aria-hidden="true"><i class="fa fa-angle-left"></i></span>
                                    </a>
                                </li>
                                <li  class="active"><a href="#">1</a></li>
                             <!--   <li><a href="#">2</a></li> -->

                                <li>
                                    <a href="#" aria-label="Next">
                                        <span aria-hidden="true"><i class="fa fa-angle-right"></i></span>
                                    </a>
                                </li>
                            </ul>
                        </nav>

                    </div><!-- End .col-md-9 -->

                    <div class="mb60 clearfix visible-sm visible-xs"></div><!-- space -->

                    <aside class="col-md-2 sidebar" role="complementary">


  

                </div><!-- End .row -->
            </div><!-- End .container -->

<!-- End page content -->  

      <!--      <div class="mb40"></div><!-- space -->
