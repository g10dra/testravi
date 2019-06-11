<?php $current_page= basename($_SERVER['SCRIPT_NAME']); ?>
<div class="side-menu">
		<nav class="navbar navbar-default" role="navigation">
			<!-- Main Menu -->
			<div class="side-menu-container">
				<ul class="nav navbar-nav">
					<li <?php if($current_page=="welcome.php"){
						echo 'class="active"'; } ?>
					><a href="welcome.php"><span class="glyphicon glyphicon-dashboard"></span> Dashboard</a></li>
					<li <?php if($current_page=="category.php" || $current_page=="category_form.php" ){
						echo 'class="active"'; } ?>><a href="category.php"><span class="glyphicon glyphicon-plane"></span> Category</a></li>
					<li <?php if($current_page=="city.php" || $current_page=="city_form.php" ){
						echo 'class="active"'; } ?>><a href="city.php"><span class="glyphicon glyphicon-plane"></span> City</a></li>
					<li <?php if($current_page=="post_form.php"  || $current_page=="post.php" ){
						echo 'class="active"'; } ?>><a href="post.php"><span class="glyphicon glyphicon-cloud"></span> Post</a></li>


				</ul>
			</div><!-- /.navbar-collapse -->
		</nav>