<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-lg-11"> 
        <h2><?php echo($content_name); ?></h2>

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
       

    </div> 
    <div class="col-lg-1">

    </div> 
</div>
