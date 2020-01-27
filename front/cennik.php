<?php
session_start();
	
if (!isset($_SESSION['inicjuj']))
{
	session_regenerate_id();
	$_SESSION['inicjuj'] = true;
	$_SESSION['ip'] = $_SERVER['REMOTE_ADDR'];
}


if($_SESSION['ip'] != $_SERVER['REMOTE_ADDR'])
{
	die('Proba przejecia sesji udaremniona!');	
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="pl" lang="pl">
<head>
<title>Cennik</title>
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
<body id="page5">

<div class="tail-top">
	<div class="tail-bottom">
		<div id="main">
<!-- HEADER -->
			<div id="header">
				<div class="row-1">
				<div class="fleft"><a href="index.php">Kino<span>URZ</span></a></div>
					<ul><li>Witaj <?php echo($_SESSION['login']); ?>, <?php if($_SESSION['zalogowany']){?><a style="text-decoration: none;" href="logout.php">wyloguj</a><?php } ?></li>
					<li><a href="index.php"><img src="images/icon1-act.gif" alt="" /></a></li>
						<li><a href="contact-us.php"><img src="images/icon2.gif" alt="" /></a></li>
						<?php
						if(isset($_SESSION['admin'])){
							if($_SESSION['admin'] == 1 || $_SESSION['admin'] == 2){
						?>
							<li><a href="Panel_Pracownika.php"><img src="images/icon3.gif" alt="" /></a></li>
						<?php
						}}
						?>
					</ul>
				</div>
				<div class="row-2">
					<ul>
						<li><a href="index.php" >Kino</a></li>
						<?php if(!$_SESSION['zalogowany']){?>
						<li><a href="register.php">Zarejestruj</a></li>
						<li><a href="logowanie.php">Zaloguj</a></li>
						<?php } ?>
						
						<li><a href="cennik.php" class="active">Cennik</a></li>
						<li><a href="contact-us.php" >Kontakt</a></li>
						
					</ul>
				</div>
			</div>
<!-- CONTENT -->
			<div id="content">
				<div class="line-hor"></div>
				<div class="box">
					<div class="border-right">
						<div class="border-left">
							<div class="inner">
								<h3>Cennik</h3>
								<style type="text/css">
.tg  {border-collapse:collapse;border-spacing:0;}
.tg td{font-family:Arial, sans-serif;font-size:14px;padding:10px 5px;border-style:solid;border-width:1px;overflow:hidden;word-break:normal;border-color:black;}
.tg th{font-family:Arial, sans-serif;font-size:14px;font-weight:normal;padding:10px 5px;border-style:solid;border-width:1px;overflow:hidden;word-break:normal;border-color:black;}
.tg .tg-1wig{font-weight:bold;text-align:left;vertical-align:top}
.tg .tg-baqh{text-align:center;vertical-align:top}
.tg .tg-0lax{text-align:left;vertical-align:top}
.tg .tg-amwm{font-weight:bold;text-align:center;vertical-align:top}
</style>
<table class="tg">
  <tr>
    <th class="tg-0lax" style="border=1; border-color:white"></th>
    <th class="tg-amwm" style="border=1; border-color:white">Poniedziałek</th>
    <th class="tg-amwm" style="border=1; border-color:white">Wtorek</th>
    <th class="tg-amwm" style="border=1; border-color:white">Środa</th>
    <th class="tg-amwm" style="border=1; border-color:white">Czwartek<br></th>
    <th class="tg-amwm" style="border=1; border-color:white">Piątek</th>
    <th class="tg-amwm" style="border=1; border-color:white">Sobota</th>
    <th class="tg-amwm" style="border=1; border-color:white">Niedziela</th>
  </tr>
  <tr>
    <td class="tg-1wig" style="border=1; border-color:white">Bilet normalny</td>
    <td class="tg-baqh" style="border=1; border-color:white">20 zł</td>
    <td class="tg-baqh" style="border=1; border-color:white">18 zł</td>
    <td class="tg-baqh" style="border=1; border-color:white">20 zł</td>
    <td class="tg-baqh" style="border=1; border-color:white">20 zł</td>
    <td class="tg-baqh" style="border=1; border-color:white">22 zł</td>
    <td class="tg-baqh" style="border=1; border-color:white">25 zł</td>
    <td class="tg-baqh" style="border=1; border-color:white">25 zł</td>
  </tr>
  <tr>
    <td class="tg-1wig" style="border=1; border-color:white">Bilet studencki </td>
    <td class="tg-baqh" style="border=1; border-color:white">10 zł</td>
    <td class="tg-baqh" style="border=1; border-color:white">9 zł</td>
    <td class="tg-baqh" style="border=1; border-color:white">10 zł</td>
    <td class="tg-baqh" style="border=1; border-color:white">10 zł</td>
    <td class="tg-baqh" style="border=1; border-color:white">11 zł</td>
    <td class="tg-baqh" style="border=1; border-color:white">12,50 zł</td>
    <td class="tg-baqh" style="border=1; border-color:white">12,50 zł</td>
  </tr>
  <tr>
    <td class="tg-1wig" style="border=1; border-color:white">Bilet senior/uczeń</td>
    <td class="tg-baqh" style="border=1; border-color:white">14 zł</td>
    <td class="tg-baqh" style="border=1; border-color:white">12,60 zł</td>
    <td class="tg-baqh" style="border=1; border-color:white">14‬ zł</td>
    <td class="tg-baqh" style="border=1; border-color:white">14‬ zł</td>
    <td class="tg-baqh" style="border=1; border-color:white">15,4‬0 zł</td>
    <td class="tg-baqh" style="border=1; border-color:white">17,50 zł</td>
    <td class="tg-baqh" style="border=1; border-color:white">17,50 zł</td>
  </tr>
</table>
							</div>
						</div>
					</div>
				</div>

<!-- 			<div class="content">
					<h3>Kontakt </span></h3>
					<form id="contacts-form" action="">
						<fieldset>
						<div class="field"><label>Twoje imie:</label><input type="text" value=""/></div>
						<div class="field"><label>Twój E-mail:</label><input type="text" value=""/></div>
						<div class="field"><label>Twoja Strona:</label><input type="text" value=""/></div>
						<div class="field"><label>Twoja Wiadomość:</label><textarea cols="1" rows="1"></textarea></div>
						<div class="wrapper">
							<a href="#" class="link2" onclick="document.getElementById('contacts-form').submit()">	
								<span>
									<span>Wyślij</span>
								</span>
							</a>
						</div>
						</fieldset>
					</form>
				</div>
			</div>-->
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
