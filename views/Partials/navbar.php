<?PHP if(empty(session_id()))session_start(); ?>
<!-- Navbar -->
<nav class="navbar navbar-inverse">
	<div class="container-fluid">
		<div class="navbar-header">
			<button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span> 
			</button>
			<a class="navbar-brand"href="index.php">YCCL</a>
		</div>
		<div class="collapse navbar-collapse" id="myNavbar">
			<ul class="nav navbar-nav">
				<li class="active"><a href="index.php">Home</a></li>
			</ul>
			<ul class="nav navbar-nav navbar-right">
				<?PHP if(isset($_SESSION['account'])): ?>
				<li><a href="admin-dashboard.php"><span class="glyphicon glyphicon-user"></span> Dashboard</a></li>
				<li><a href="logout.php"><span class="glyphicon glyphicon-user"></span> Log Out</a></li>
				<?PHP else: ?>
				<li><a data-toggle="modal" data-target="#loginModal"><span class="glyphicon glyphicon-log-in"></span> Login</a></li>
				<?PHP endif; ?>
			</ul>
		</div>
	</div>
</nav>