<?php
	session_start();
	
	// if (!isset($_SESSION['inicjuj']))
	// {
	// 	session_regenerate_id();
	// 	$_SESSION['inicjuj'] = true;
	// 	$_SESSION['ip'] = $_SERVER['REMOTE_ADDR'];
	// }
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="pl" lang="pl">
<head>
<title>Dodaj repertuar</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="description" content="Place your description here" />
<meta name="keywords" content="put, your, keyword, here" />
<meta name="author" content="Templates.com - website templates provider" />
<link href="style.css" rel="stylesheet" type="text/css" />
<script src="js/jquery-1.4.2.min.js" type="text/javascript"></script>
<script src="js/cufon-yui.js" type="text/javascript"></script>
<script src="js/cufon-replace.js" type="text/javascript"></script>
<script src="js/Gill_Sans_400.font.js" type="text/javascript"></script>
<script src="js/script.js" type="text/javascript"></script>
<!--[if lt IE 7]>
	<script type="text/javascript" src="js/ie_png.js"></script>
	<script type="text/javascript">
		 ie_png.fix('.png, .link1 span, .link1');
	</script>
	<link href="ie6.css" rel="stylesheet" type="text/css" />
<![endif]-->
</head>
<body id="page3">

<div class="tail-top">
	<div class="tail-bottom">
		<div id="main">
<!-- HEADER -->
			<div id="header">
				<div class="row-1">
				<div class="fleft"><a href="index.php">Kino<span>URZ</span></a></div>
				<ul><li>Witaj <?php echo($_SESSION['login']); ?></li>
					<li><a href="index.php"><img src="images/icon1-act.gif" alt="" /></a></li>
						<li><a href="contact-us.php"><img src="images/icon2.gif" alt="" /></a></li>
						<li><a href="Panel_Pracownika.php"><img src="images/icon3.gif" alt="" /></a></li>
						
					</ul>
				</div>
				<div class="row-2">
					<ul>
						
					<li><a href="Dodawanie_filmu.php" >Panel Filmów</a></li>
						<li><a href="Panel_Admina.php">Panel Admin</a></li>
						<li><a href="Panel_Repertuaru.php" class="active">Panel Repertuaru</a></li>
						<li><a href="Panel_Pracownika.php">Panel Pracownika</a></li>
						<li><a href="logout.php">Wyloguj</a></li>
					</ul>
				</div>
			</div>
<!-- CONTENT -->
<!-- CONTENT -->

<div id="content">
				<div id="slogan">
					<div class="image png"></div>
					<div class="inside">
			
					
					<p class="login-text">
    <span class="fa-stack fa-lg">
      <i class="fa fa-circle fa-stack-2x"></i>
      <i class="fa fa-lock fa-stack-1x"></i>
    </span>
  </p>
						
					
					
  <form action="repertuar_add_post.php" method="POST">
  <h4 style="padding-bottom:0px">Dodaj repertuar</h4>
  <input type="film" name="film" class="login-username" autofocus="true" required="true" placeholder="ID filmu" />
  <input type="id_sali" name="id_sali" class="login-password" required="true" placeholder="ID sali" />
  <input type="text" name="date" class="login-password" value="2020-01-29 08:00:00" required="true" placeholder="data" />
  <input type="submit" name="LoginButton" value="Dodaj repertuar" class="login-submit" />
</form>

</div></div></div><div>
				
				


<!-- FOOTER -->
<div id="footer2">
				<div class="left">
					<div class="right">
						<div class="inside">Copyright - Grupa laboratoryjna nr 2, projektowa nr 1<br>
							Krzysztof Banaś, Kamil Dziok, Damian Gaworowski, Hubert Jakobsze, Łukasz Kwaśny
							
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<script type="text/javascript"> Cufon.now(); </script>
</body>
</html>