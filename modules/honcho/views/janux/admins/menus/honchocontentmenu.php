
	<div class="navbar">
		<div class="navbar-inner">
<!-- Janux  -->		<div class="container-fluid">
				<a class="btn btn-navbar" data-toggle="collapse" data-target=".top-nav.nav-collapse,.sidebar-nav.nav-collapse">
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
				</a>
				<a class="brand" href="index"><span><h2><?=$content_name; ?></h2></span></a>
								
				<!-- start: Header Menu -->
				<div class="nav-no-collapse header-nav">
					<ul class="nav pull-right">

						<!-- start: User Dropdown Doesnt show because role_id =0. So just a black header with content_name-->
                        <?php if ($_SESSION['role_id'] !== 0):  ?> 

						<li class="dropdown">
							<a class="btn dropdown-toggle" data-toggle="dropdown" href="#">
								<i class="halflings-icon white user"></i> (<?= $_SESSION['whoisit'] ?>)
								<span class="caret"></span>
							</a>
							<ul class="dropdown-menu">
								<li class="dropdown-menu-title">
 									<span>Account Settings</span>
								</li>
								<li><a href="#"><i class="halflings-icon user"></i> Profile</a></li>
                                <li><a href="<?= BASE_URL ?>dashboards/logout"><i class="halflings-icon user"></i> Logout</a></li>
							<!--	<li><a href="<=  base_url('auth/logout')?>"><i class="halflings-icon off"></i> Logout</a></li> -->
							</ul>
						</li>
						<!-- end: User Dropdown -->

                        <?php endif; ?>    
					</ul>
				</div>
				<!-- end: Header Menu -->
				
			</div>
		</div>
	</div>

