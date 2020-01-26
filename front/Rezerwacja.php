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

if(!$_SESSION['zalogowany']){
    $_SESSION['urlBool'] = TRUE;
    $_SESSION['url'] = "Rezerwacja.php?id=".$_GET["id"];
    header('Location: logowanie.php');
}

include_once 'curl.php';

$wyslij['idRepertuaru'] = $_GET['id'];

$url = 'http://localhost:8080/WM/projekt/Projekt-WM/API/repertuar/read_single.php';
$ch = new ClientURL();
$ch->setPostURL($url, json_encode($wyslij));
$result = $ch->exec();

$json = json_decode($result, TRUE);


$_SESSION['tytul'] = $json['film']['tytul'];
$_SESSION['dataRep'] = $json['repertuar']['data'];
$_SESSION['idSali'] = $json['repertuar']['id_saliFKRep'];
$_SESSION['idRepertuaru'] = $json['repertuar']['id_repertuaru'];

$urlMiejsca = 'http://localhost:8080/WM/projekt/Projekt-WM/loadingPages/rezerwacje/read_miejsca.php';
$wyslijRep['idRepertuaru'] = $_SESSION['idRepertuaru'];
$chM = new ClientURL();
$chM->setPostURL($urlMiejsca, json_encode($wyslijRep));
$jsonMiejsca = json_decode($chM->exec(), TRUE);
// var_dump($jsonMiejsca);

use phpDocumentor\Reflection\Types\String_;

$liczbaMiejscRzedu = 14;    //te dane trzeba z kads wziac
$liczbaRzedow = 10;

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="pl" lang="pl">
<head>
<title>KinoURZ</title>
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
    <script>
        addEventListener("load", function () {
            setTimeout(hideURLbar, 0);
			
        }, false);

        function hideURLbar() {
            window.scrollTo(0, 1);
        }
    </script>

</head>

<body onload="onLoaderFunc()"id="page1">

<div class="tail-top">
	<div class="tail-bottom">
		<div id="main">
<!-- HEADER -->
			<div id="header">
				<div class="row-1">
					<div class="fleft"><a href="index.php">Kino<span>URZ</span></a></div>
					<ul>
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
						<li><a href="Rejestracja.php" class="active">Rezerwacja</a></li>
						<li><a href="contact-us.php">Kontakt</a></li>
						
					</ul>
				</div>
			</div>

            <div id="content">
				<div id="slogan2">
				
                <div class="row">	
  <h4  style="margin:auto;padding-top:15px; padding-left:15px">Wybór miejsc filmu <?php echo $json['film']['tytul']; ?></h4>
    <form action="podsumowanie.php?id=<?php echo $wyslij['idRepertuaru']; ?>" method="POST" class="container">
        <div class="w3ls-reg">
            <!-- input fields -->
            <div class="inputForm">
                <h3 style="margin:auto;padding-top:15px; padding-left:15px; color:black">Wypełnij pola i wybierz swoje miejsca</h3><br>
                <div class="mr_agilemain">
                    <div class="agileits-left">
                       
                        <input class="login-username2" type="text" name="imie" placeholder="Imię" id="Username" required>
                        <input class="login-username2" type="text" name="nazwisko" placeholder="Nazwisko" id="Username" required>
                    </div>
                    <div class="agileits-right">
                 
                        <input class="login-username2" type="number" name="iloscMiejsc" placeholder="Liczba miejsc" id="Numseats" required min="1">
                    </div>
                </div>
				<div>
                    <input class="login-username2" type="number" name="iloscStudent" placeholder="Bilety ulgowe studenckie" id="student" min="0">
            
                    <input  class="login-username2" type="number" name="iloscSzkolne" placeholder="Bilety ulgowe szkolne" id="szkolny" min="0">
                </div><br>
                <input style="margin:auto" type="button" name="Wybierz" value="Wybierz" class="login-submit" onclick="takeData()" />


            </div>
            <!-- //input fields -->
            <br>
            <div class='seatStructure'>
                <div class="notification"></div>
                <ul style="text-align: center; margin-bottom:0px; color:black;"><li>Wybrane siedzenia</li><li>Zarezerwowane siedzenia</li><li>Puste siedzenia</li></ul>
                <table style="margin:auto">
                    <?php
                        // var_dump($jsonMiejsca);
                        for($j = 0; $j < $liczbaRzedow; $j++){
                            echo "<tr>";
                            
                                for($i = 0; $i < $liczbaMiejscRzedu; $i++){
                                    $numerM = $j*10+$i;
                                    $zajete = FALSE;
                                    if($jsonMiejsca != null)
                                        for($x = 0; $x < count($jsonMiejsca); $x++){
                                            // echo "jsonMiejsca[$x] = ".$jsonMiejsca[$x]." numerM = ".$numerM." ";
                                            if(intval($jsonMiejsca[$x]) == $numerM){
                                                // echo "True<br/>";
                                                $zajete = TRUE;
                                                break;
                                            }
                                            // else{
                                            //     echo "False";
                                            // }
                                            // echo "<br/>";
                                        }
                                    if($zajete){
                                        echo "<td class=''><input type='checkbox' name='miejsca[]' class='seats rez' value='".($j*10+$i)."'></td>";
                                    }else{
                                        echo "<td class=''><input type='checkbox' name='miejsca[]' class='seats not' value='".($j*10+$i)."'></td>";
                                    }
                                }
                            echo "</tr>";
                        }
                    ?>
                </table>
            </div>
                <div class="screen">
                <h3 style="margin:auto;padding-top:15px; padding-left:15px; color:black; text-align:center">EKRAN KINA</h2>
                </div><br>
                <div style="margin-left: 41.5%">
                    <a href="index.php" style="text-decoration: none" value="Powrót" class="login-submit2">Powrót</a>
                    <input name="Podsumowanie" value="Podsumowanie" class="login-submit2" type="submit"/> 
                </div> 

    </form>

    <script src="js/jquery-2.2.3.min.js"></script>

    <script>

        function onLoaderFunc() {
            // $(".seatStructure *").prop("disabled", true);
            $(".not").prop("disabled", true);
            $(".rez").prop("disabled", true);
            $("input.login-submit2").prop("disabled", true);
        }

        function takeData() {
            if ($("#Username").val().length == 0 || $("#Numseats").val().length == 0 || parseInt($("#szkolny").val()) + parseInt($("#student").val()) > parseInt($("#Numseats").val())) {
                alert("podaj wszystkie dane lub zmień ilość ulg (nie mogą przekraczać liczby miejsc)");
            } else {
                $(".login-submit").prop("disabled", true);
                $('.login-username2').prop("readonly", true);
                $(".not").prop("disabled", false);
                $('.login-submit').prop('disabled', true);
                document.getElementById("notification").innerHTML =
                    "<b style='margin-bottom:0px;background:#ff9800;letter-spacing:1px;'>Please Select your Seats NOW!</b>";
            }
        }


        // function updateTextArea() {

        //     if ($("input:checked").length == ($("#Numseats").val())) {
        //         $(".seatStructure *").prop("disabled", true);

        //         var allNameVals = [];
        //         var allNumberVals = [];
        //         var allSeatsVals = [];

        //         //Storing in Array
        //         allNameVals.push($("#Username").val());
        //         allNumberVals.push($("#Numseats").val());
        //         $('#seatsBlock :checked').each(function () {
        //             allSeatsVals.push($(this).val());
        //         });
        //     } else {
        //         alert("Please select " + ($("#Numseats").val()) + " seats")
        //     }
        // }


        function myFunction() {
            alert($("input:checked").length);
        }

        /*
        function getCookie(cname) {
            var name = cname + "=";
            var ca = document.cookie.split(';');
            for(var i = 0; i < ca.length; i++) {
                var c = ca[i];
                while (c.charAt(0) == ' ') {
                    c = c.substring(1);
                }
                if (c.indexOf(name) == 0) {
                    return c.substring(name.length, c.length);
                }
            }
            return "";
        }
        */


        $(":checkbox").click(function () {
            if ($("input:checked").length == ($("#Numseats").val())) {
                $('.not').prop('disabled', true);
                $(':checked').prop('disabled', false);
                $('.login-submit2').prop('disabled', false);
            } else {
                $('.not').prop('disabled', false);
                $('.login-submit2').prop('disabled', true);
            }
        });
    </script>
    </div>   </div>  </div>
    <!-- //script for seat selection -->
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

</body>
</html>