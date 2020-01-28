<?php

session_start();
	
	// if (!isset($_SESSION['inicjuj']))
	// {
	// 	session_regenerate_id();
	// 	$_SESSION['inicjuj'] = true;
	// 	$_SESSION['ip'] = $_SERVER['REMOTE_ADDR'];
	// }
	
	
	// if($_SESSION['ip'] != $_SERVER['REMOTE_ADDR'])
	// {
	// 	die('Proba przejecia sesji udaremniona!');	
	// }
include_once 'curl.php';
$url = 'http://localhost:8080/WM/projekt/Projekt-WM/loadingPages/repertuar/read_single.php';
$urlBiznes = 'http://localhost:8080/WM/projekt/Projekt-WM/biznes/instruction/rezerwuj.php';
$urlRezerwacje = 'http://localhost:8080/WM/projekt/Projekt-WM/API/rezerwacje/miejsca.php';

$ch = new ClientURL();

$wyslij['id'] = $_GET['id'];

if(isset($_GET['pr'])){
	$chRM = new ClientURL();
	$chRM->setPostURL($urlRezerwacje, json_encode(array('idRezerwacji' => intval($_GET['id']))));
	$miejsca = $chRM->exec();
	$miejsca = json_decode($miejsca, TRUE);
	$_POST['miejsca'] = $miejsca['miejsca'];
	foreach($_POST['miejsca'] as $r => $dane) $miejsca [] = intval($dane);
	$cena = $_POST['cena'];
}

// $ch->setPostURL($url, $wyslij);
// $rezult = $ch->exec();
if(isset($_POST['miejsca']) && isset($_POST['imie']) && isset($_POST['nazwisko']) && isset($_POST['iloscSzkolne']) && isset($_POST['iloscStudent'])){
	if(!isset($_GET['pr'])){
		$listonosz['data'] = $_SESSION['tytul'];//tytul

		$dataRep = DateTime::createFromFormat('Y-m-d H:i:s', $_SESSION['dataRep']);


		foreach($_POST['miejsca'] as $r => $dane) $miejsca [] = intval($dane);

		$listonosz['godz'] = intval($dataRep->format('H'));
		$listonosz['min'] = intval($dataRep->format('i'));
		$listonosz['miesiac'] = intval($dataRep->format('m'));
		$listonosz['dzien'] = intval($dataRep->format('d'));
		$listonosz['rok'] = intval($dataRep->format('Y'));
		$listonosz['idSali'] = intval($_SESSION['idSali']);
		$listonosz['imie'] = $_POST['imie'];
		$listonosz['nazwisko'] = $_POST['nazwisko'];
		$listonosz['miejsca'] = $miejsca;
		$listonosz['iloscUczen'] = intval($_POST['iloscSzkolne']);
		$listonosz['iloscStudent'] = intval($_POST['iloscStudent']);
		$listonosz['idRepertuaru'] = intval($_SESSION['idRepertuaru']);
		$listonosz['idUzytkownika'] = intval($_SESSION['idUzytkownika']);

		$ch->setPostURL($urlBiznes, json_encode($listonosz));
		$fromBiznesString = $ch->exec();
		$fromBiznes = json_decode($fromBiznesString, TRUE);
		// var_dump($fromBiznesString);
		// var_dump($fromBiznes);
		$cena = 0.0;
		if($fromBiznes['rezerwacja']){
			$cena = $fromBiznes['cena'];
			$index = $fromBiznes['indexTabeliMiejsca'];
			$_SESSION['cenaRez'] = $cena;
		}else{
			echo 'źle';
			// header('Location: Rezerwacja.php?id='.$wyslij['id']);
		}
	}
	$imie = $_POST['imie'];
	$nazwisko = $_POST['nazwisko'];
	$iloscSzkolne = intval($_POST['iloscSzkolne']);
	$iloscStudenckie = intval($_POST['iloscStudent']);

	$_SESSION['imieRez'] = $imie;
	$_SESSION['nazwiskoRez'] = $nazwisko;
	$_SESSION['miejscaRez'] = $miejsca;
	$_SESSION['iloscSzkolneRez'] = $iloscSzkolne;
	$_SESSION['iloscStudentRez'] = $iloscStudenckie;
}
else{
	if(isset($_SESSION['miejscaRez']) && isset($_SESSION['imieRez']) && isset($_SESSION['nazwiskoRez']) && isset($_SESSION['iloscSzkolneRez']) && isset($_SESSION['iloscStudentRez'])){
		$imie = $_SESSION['imieRez'];
		$nazwisko = $_SESSION['nazwiskoRez'];
		$miejsca = $_SESSION['miejscaRez'];
		$iloscSzkolne = intval($_SESSION['iloscSzkolneRez']);
		$iloscStudenckie = intval($_SESSION['iloscStudentRez']);
		$cena = $_SESSION['cenaRez'];
	}else echo "to nie tak";
}	 

$data = date("Y-m-d");
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="pl" lang="pl-PL">
<head>
<title>Podsumowanie rezerwacji</title>
<meta charset="UTF-8" http-equiv="Content-Type" content="text/html" />
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
						<li><a href="Panel_Pracownika.php"><img src="images/icon3.gif" alt="" /></a></li>
					</ul>
				</div>
				<div class="row-2">
					<ul>
						<li><a href="index.php" >Kino</a></li>
						<li><a href="podsumowanie.php" class="active">Podsumowanie</a></li>
						<li><a href="cennik.php" >Cennik</a></li>
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
						<h3 style="padding-left: 50px; padding-top: 10px"><span>Podsumowanie Rezerwacji</span></h3>
							<form name="zatwierdz" action="wyslijPotw.php?id=<?php echo $wyslij['id']; ?>&index=<?php echo $index; ?>&idRezerwacji=<?php 
								if(isset($_GET['idRezerwacji'])) echo $_GET['idRezerwacji']; 
								else echo -1; 
							?>" method="POST">
                               <h4 style="padding-left: 50px">Dane klienta:</h4>
						      		<p style="padding-left: 50px; font-weight: bold"><?php echo ($imie." ".$nazwisko); ?></p>		
								<h4 style="padding-left: 50px">Zarezerwowane miejsca: </h4>
						      		<p style="padding-left: 50px"><?php echo "Miejsca nr.:	   "; foreach($miejsca as $m => $dane){echo $dane.", ";} ?></p>
								<h4 style="padding-left: 50px">Rodzaj biletów: </h4>
						      		<p style="padding-left: 50px"><?php echo "Bilety szkolne: ".$iloscSzkolne.", Biletu studencke: ".$iloscStudenckie; ?></p>		
								<h4 style="padding-left: 50px">Data dokonania rezerwacji: </h4>
									<p style="padding-left: 50px"><?php echo $data; ?></p>
								<h4 style="padding-left: 50px">Cena biletów: </h4>
									<p style="padding-left: 50px"><?php echo $cena; ?></p><br>
								<?php if(!isset($_GET['pr'])){?>
								<div class="wrapper" style="padding-left: 50px">
								<input type="submit" name="zatwierdz" value="Zatwierdź rezerwację" class="login-submit2" />
								</div><br>
								<?php
									}
								?>
							</form>
							<form name='drukuj' action="wyslijPotw.php?id=<?php echo $wyslij['id']; ?>&index=<?php echo $index; ?>" method="POST">
								<?php
									if(intval($_SESSION['admin']) == 1 || intval($_SESSION['admin']) == 2) echo "<div class='wrapper' style='padding-left: 50px'><input type='submit' name='drukuj' value='Drukuj' class='login-submit2' /></div> <br>";
									else{
								?>
							</form>
							<form name="anuluj" action="wyslijPotw.php?id=<?php echo $wyslij['id']; ?>&index=<?php echo $index; ?>" method="POST">
							<div class="wrapper" style="padding-left: 50px">	<input type="submit" name="anuluj" value="Zrezygnuj" class="login-submit2" /></div>
							</form>
							<?php
									}
							?>
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
