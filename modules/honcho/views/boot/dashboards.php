<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Honcho</title>
<!--        <link rel="stylesheet" href="https://bootswatch.com/cerulean/bootstrap.min.css"> -->
<!--        <link rel="stylesheet" href="https://bootswatch.com/cosmo/bootstrap.min.css"> -->
<!--        <link rel="stylesheet" href="https://bootswatch.com/cyborg/bootstrap.min.css"> -->
<!--        <link rel="stylesheet" href="https://bootswatch.com/darkly/bootstrap.min.css"> -->
<!--        <link rel="stylesheet" href="https://bootswatch.com/flatly/bootstrap.min.css"> -->
<!--        <link rel="stylesheet" href="https://bootswatch.com/journal/bootstrap.min.css"> -->
<!--        <link rel="stylesheet" href="https://bootswatch.com/lumen/bootstrap.min.css"> -->
<!--        <link rel="stylesheet" href="https://bootswatch.com/paper/bootstrap.min.css"> -->
<!--        <link rel="stylesheet" href="https://bootswatch.com/readable/bootstrap.min.css"> -->
<!--        <link rel="stylesheet" href="https://bootswatch.com/sandstone/bootstrap.min.css"> -->
<!--        <link rel="stylesheet" href="https://bootswatch.com/simplex/bootstrap.min.css"> -->
<!--        <link rel="stylesheet" href="https://bootswatch.com/slate/bootstrap.min.css"> -->
<!--        <link rel="stylesheet" href="https://bootswatch.com/solar/bootstrap.min.css"> -->
<!--        <link rel="stylesheet" href="https://bootswatch.com/superhero/bootstrap.min.css"> -->
<!--        <link rel="stylesheet" href="https://bootswatch.com/united/bootstrap.min.css"> -->
<!--        <link rel="stylesheet" href="https://bootswatch.com/yeti/bootstrap.min.css"> -->

<!-- When offline, download bootstrap from the site, copy to the resources directory and load:  --> 
<!-- <link rel="stylesheet" href="<?php echo base_url("Resources/css/bootsrap.min.css"); ?>"> -->

<!-- When online -->
      <link rel="stylesheet" href="https://bootswatch.com/readable/bootstrap.min.css"> 

<!-- <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta/css/bootstrap.min.css" integrity="sha384-/Y6pD6FV/Vv2HJnA6t+vslU6fwYXjCFtcEpHbNJ0lyAFsXTsjBbfaDjzALeQsN6M" crossorigin="anonymous"> -->

<!-- style.css to hold custom css code -->
        <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/style.css">

<!-- TinyMCE for textareas -->        
    <script src="https://cloud.tinymce.com/stable/tinymce.min.js"></script> 
<!--  <script src="<?php echo base_url(); ?>assets/tinymce/js/tinymce.min.js"></script> -->
  <script>tinymce.init({ selector:'textarea' });</script>                                                                                                                     
    </head>
    <body>
<?php echo "In View dashboards.php" ?>
        
        <nav class="navbar navbar-inverse">
            <div class="container">
                <div class="navbar-header">
                    <a class="navbar-brand" href="">Honcho</a>
                </div>
                <div id="navbar">
                    <ul class="nav navbar-nav">
                        <li><a href="<?php echo base_url(); ?>">Home</a></li>
                        <li><a href="<?php echo base_url(); ?>about">About</a></li>
                        <li><a href="<?php echo base_url(); ?>blog">Blog</a></li>
                <!--        <li><?= $logged_in ?></li> -->

                <!-- if logged in -->
                <?php if ($logged_in == 1): ?> 
                        <?php if ($whoisit == 'administrator'): ?> 
                            <li><a href="<?php echo base_url(); ?>admin">Admin</a></li>  
                        <?php endif; ?> 
                        <li><a href="<?php echo base_url(); ?>auth/logout">Logout (<?= $whoisit ?>)</a></li>
               <!--         <li><a href="<?=  base_url('auth/logout')?>"><i class="fa fa-sign-out fa-fw"></i> Logout</a></li> -->                        

                <?php else: ?>  <!-- if not logged in -->                        
                        <li><a href="<?php echo base_url(); ?>auth">Login</a></li>
                <!--        <li><a href="<php echo base_url(); ?>users/login">Login</a></li> -->
                <?php endif; ?> 
                    </ul>
                </div>
             </div>
        </nav>
<div class="container">
              <?php echo "Using Bootswatch Template"; ?> 

<div> <!-- see assets/css/custom.css -->

        <?php 
        if(!isset($contentfile)){
            $contentfile = "";
        }
        if(!isset($module)){
            $module = $this->uri->segment(1);
        }

        if(($contentfile!="") && ($module!="")) {

        $this->load->view($module.'/'.$contentfile.'.php');

        }                        

        ?>
</div>

            </div> <!-- container -->

<!-- When offline, download bootstrap from the site, copy to the assets directory and load:  --> 
<!--  <script type="text/js" src="<?php echo base_url("Resources/js/bootsrap.js"); ?>"></script> 
 <script type="text/js" src="<?php echo base_url("Resources/js/jquert-3.2.1.min.js"); ?>"></script>  -->

<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.11.0/umd/popper.min.js" integrity="sha384-b/U6ypiBEHpOf/4+1nzFpr53nxSS+GLCkfwBdFNTxtclqqenISfwAzpKaMNFNmj4" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta/js/bootstrap.min.js" integrity="sha384-h0AbiXch4ZDo7tp9hKZ4TsHbi047NrKGLO3SEJAg45jXxnGIfYzk4Si90RDIqNm1" crossorigin="anonymous"></script> 

<script>

function doconfirm()
{
    job=confirm("Confirm Deletion?");
    if(job!=true)
    {
        return false;
    }
}
</script>
        </body>
</html>
