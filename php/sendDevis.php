<?php
$name = $_POST["name"];
$firstname = $_POST["firstname"];
$mail = $_POST["email"];
$address = $_POST["address"];
$hour = $_POST["hour"];
$service = $_POST["service"];
$duration = $_POST["duration"];


function bdd(){
  try
      {
        $bdd = new PDO('mysql:host=127.0.0.1;dbname=pomocServiceDb;charset=utf8', 'ccddr', 'CCDDRtomtom77', array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
      }
  catch (Exception $e)
      {
              die('Erreur : ' . $e->getMessage());
      }

      return $bdd;
}



  $bdd = bdd();

  $q = "SELECT price FROM service WHERE jobs = '$service'";
  $req = $bdd->prepare($q);
  $req->execute();
  
  $price= $req->fetch();
  $priceTVA = $price[0] / 5;
  $pricefinal = $price[0] + $priceTVA;
  $mydate=getdate(date("U"));

?>





<html>
<head><meta http-equiv=Content-Type content="text/html; charset=UTF-8">
<style type="text/css">
<!--
span.cls_002{font-family:Arial,serif;font-size:16.1px;color:rgb(0,0,0);font-weight:bold;font-style:normal;text-decoration: none}
div.cls_002{font-family:Arial,serif;font-size:16.1px;color:rgb(0,0,0);font-weight:bold;font-style:normal;text-decoration: none}
span.cls_003{font-family:Arial,serif;font-size:10.1px;color:rgb(0,0,0);font-weight:normal;font-style:normal;text-decoration: none}
div.cls_003{font-family:Arial,serif;font-size:10.1px;color:rgb(0,0,0);font-weight:normal;font-style:normal;text-decoration: none}
span.cls_004{font-family:Arial,serif;font-size:10.1px;color:rgb(0,0,0);font-weight:bold;font-style:normal;text-decoration: none}
div.cls_004{font-family:Arial,serif;font-size:10.1px;color:rgb(0,0,0);font-weight:bold;font-style:normal;text-decoration: none}
span.cls_005{font-family:Arial,serif;font-size:14.1px;color:rgb(0,0,0);font-weight:bold;font-style:normal;text-decoration: none}
div.cls_005{font-family:Arial,serif;font-size:14.1px;color:rgb(0,0,0);font-weight:bold;font-style:normal;text-decoration: none}
-->
</style>

</head>
<body>
<div style="position:absolute;left:50%;margin-left:-297px;top:0px;width:595px;height:842px;border-style:outset;overflow:hidden">
<div style="position:absolute;left:0px;top:0px">
<img src="../images/Theme/background1.jpg" width=595 height=842></div>
<div style="position:absolute;left:57.00px;top:53.30px" class="cls_002"><span class="cls_002"><?php echo $firstname ?><?php echo $name?></span></div>
<div style="position:absolute;left:490.70px;top:53.30px" class="cls_002"><span class="cls_002">DEVIS</span></div>
<div style="position:absolute;left:57.00px;top:88.70px" class="cls_003"><span class="cls_003"><?php echo $address?></span></div>
<div style="position:absolute;left:57.00px;top:103.10px" class="cls_003"><span class="cls_003">75012: Paris</span></div>
<div style="position:absolute;left:57.00px;top:190.70px" class="cls_004"><span class="cls_004">Facturé à</span></div>
<div style="position:absolute;left:416.30px;top:190.70px" class="cls_004"><span class="cls_004">Devis n°</span></div>
<div style="position:absolute;left:533.20px;top:190.70px" class="cls_003"><span class="cls_003">1</span></div>
<div style="position:absolute;left:57.00px;top:207.80px" class="cls_003"><span class="cls_003">DELOR Ilyane</span></div>
<div style="position:absolute;left:390.90px;top:211.00px" class="cls_004"><span class="cls_004">Date du devis</span></div>
<div style="position:absolute;left:488.70px;top:211.00px" class="cls_003"><span class="cls_003"><?php echo $mydate["mday"]."-".$mydate["mon"]."-".$mydate["year"]?></span></div>
<div style="position:absolute;left:57.00px;top:222.20px" class="cls_003"><span class="cls_003">20 boulevard Maurice Berteaux</span></div>
<div style="position:absolute;left:57.00px;top:236.60px" class="cls_003"><span class="cls_003">93190: LivryGaran</span></div>
<div style="position:absolute;left:196.90px;top:288.30px" class="cls_004"><span class="cls_004">DÉSIGNATION</span></div>
<div style="position:absolute;left:439.40px;top:288.30px" class="cls_004"><span class="cls_004">MONTANT HT</span></div>
<div style="position:absolute;left:62.80px;top:314.70px" class="cls_003"><span class="cls_003"><?php echo $service ?></span></div>
<div style="position:absolute;left:505.10px;top:314.70px" class="cls_003"><span class="cls_003"><?php echo $price[0]?></span></div>
<div style="position:absolute;left:362.10px;top:341.10px" class="cls_003"><span class="cls_003">Total HT</span></div>
<div style="position:absolute;left:505.10px;top:341.10px" class="cls_003"><span class="cls_003"><?php echo $price[0]?></span></div>
<div style="position:absolute;left:349.90px;top:367.00px" class="cls_003"><span class="cls_003">TVA 20.0%</span></div>
<div style="position:absolute;left:510.60px;top:367.00px" class="cls_003"><span class="cls_003"><?php echo $priceTVA ?></span></div>
<div style="position:absolute;left:353.80px;top:392.30px" class="cls_005"><span class="cls_005">TOTAL</span></div>
<div style="position:absolute;left:483.40px;top:392.30px" class="cls_005"><span class="cls_005"><?php echo $pricefinal ?></span></div>
<div style="position:absolute;left:522.24px;top:392.30px" class="cls_005"><span class="cls_005">€</span></div>

<div style="position:absolute;left:57.00px;top:757.00px" class="cls_004"><span class="cls_004">Conditions et modalités de paiement</span></div>
<div style="position:absolute;left:57.00px;top:774.10px" class="cls_003"><span class="cls_003">Le devis est dû dans 30 jours.</span></div>
</div>

</body>
</html>
