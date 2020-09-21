<?php

function bdd(){
  try
      {
        $bdd = new PDO('mysql:host=127.0.0.1;dbname=pomocServiceDb;charset=utf8', 'root', '', array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
      }
  catch (Exception $e)
      {
              die('Erreur : ' . $e->getMessage());
      }

      return $bdd;
}


function displayServices(){
  $bdd = bdd();

  $q = "SELECT id,jobs FROM service";
  $req = $bdd->prepare($q);
  $req->execute();
  $serviceName = [];
  while($service = $req->fetch()){
    $serviceName[] = $service;
  }
  return $serviceName;
}


function displayCities(){
  $bdd = bdd();

  $q = "SELECT city FROM city";
  $req = $bdd->prepare($q);
  $req->execute();
  $cityName = [];
  while($city = $req->fetch()){
    $cityName[] = $city;
  }
  return $cityName;
}

function findService($id){
    $bdd = bdd();
    $q = "SELECT jobs, price FROM service WHERE id = ?";
    $req = $bdd->prepare($q);
    $req->execute($req);
}

?>