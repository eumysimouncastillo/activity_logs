<div class="greeting">
	<h1>Welcome, <span style="color: #4CAF50;"><?php echo $_SESSION['username']; ?></span></h1>
</div>

<div class="navbar">
	<h3>
		<a href="index.php">Home</a>
		<a href="allusers.php">All Users</a>
		<a href="activitylogs.php">Activity Logs</a>
        <a href="searchlogs.php">Search Logs</a>
		<a href="core/handleForms.php?logoutUserBtn=1">Logout</a>	
	</h3>	
</div>