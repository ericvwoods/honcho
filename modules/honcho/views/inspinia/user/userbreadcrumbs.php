<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-lg-11"> 
      <!--  <h2><?php echo($content_name); ?></h2> -->
          <h2>CMS Dashboard</h2>

        <ol class="breadcrumb">
 
                <?php if(strlen($breadcrumb1) > 0): ?>
                    <li class="breadcrumb-item">
                        <a href="#"><?php echo($breadcrumb1); ?></a>
                    </li>
                <?php endif; ?>

                <?php if(strlen($breadcrumb2) > 0): ?>
                    <li class="breadcrumb-item">
                        <?php echo($breadcrumb2); ?>
                    </li>
                <?php endif; ?>
                  
                <?php if(strlen($breadcrumb3) > 0): ?>
                    <li class="breadcrumb-item">
                        <?php echo($breadcrumb3); ?> 
                    </li>
                <?php endif; ?>                    

        </ol>
      
                   <?php if($_SESSION['flashmsgcolor'] == 1): ?>
                            
                      <?= flashdata('<div style="font-weight: bold; font-size: 18px; color: lightseagreen;">', '</div>'); 
                      $flash_msg = '';
                      set_flashdata($flash_msg); ?> 
                      <br>
            <?php else: ?>
                      <?= flashdata('<div style="font-weight: bold; font-size: 18px; color: crimson;">', '</div>'); 
                      $flash_msg = '';
                      set_flashdata($flash_msg); ?>
                      <br>
            <?php endif; ?>       

    </div> 
    <div class="col-lg-1">

    </div> 
</div>
