
    <div id="wrapper">

<div class="row">
    <div class="col-md-2">
    <!-- start: Side  Menu -->
    <?php include('sidemenu.php'); ?>					
	<!-- end: Side Menu -->
</div>
<div class="col-md-10">

        <div id="page-wrapper" class="gray-bg">

        
        <div class="row border-bottom">

       <!--     <php include('topmenu.php');  ?> -->
   

        </div>
        <!-- If you take out of down div and put in content div it will box instead of extending full width  -->
        <div>
            <?php include('breadcrumbfile.php');  ?> 
        </div>

        <div class="wrapper wrapper-content">

            <?php include($contentfile.'.php');  ?> 

        </div>

        <div class="footer">
            <div class="float-right">
           <!--     floated right -->
            </div>
            <div>
            <!--	<php include('footer.php');  ?> -->
             <!--   <strong>Copyright</strong> Encore Digital Arts &copy; 2023 -->
            </div>
        </div>

        </div>

    </div>
</div>
 