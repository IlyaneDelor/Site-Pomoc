<?php
include("function.php");
//phpinfo();
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <title>Login Home Service</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="icon" type="image/png" href="../images/icons/favicon.ico"/>

    <link rel="stylesheet" type="text/css" href="../fonts/font-awesome-4.7.0/css/font-awesome.min.css">

    <link rel="stylesheet" type="text/css" href="../fonts/Linearicons-Free-v1.0.0/icon-font.min.css">

    <link rel="stylesheet" type="text/css" href="../css/bootstrap/css/bootstrap-grid.min.css">

    <link rel="stylesheet" type="text/css" href="../css/util.css">

    <link rel="stylesheet" type="text/css" href="../css/main.css">

    <script src="../jquery/jquery-3.2.1.min.js"></script>

    <link href="http://localhost/projetA/ProjetA/css/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="http://localhost/projetA/ProjetA/css/carousel.css" rel="stylesheet">
    <script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
    <link href="http://localhost/projetA/ProjetA/css/index.css" rel="stylesheet">
    <!--    <link href="//netdna.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">-->
    <script src="//netdna.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>
</head>
<body>
<header id="header"></header>
    <div class="limiter">
        <div class="login">
            <div class="wrap-login p-l-50 p-r-50 p-t-77 p-b-30">
                <div class="login-form validate-form">

                    <div id="list-intervention" class="container-fluid">
                        <span class="login-form-title p-b-55">
                            Liste de vos demandes
                        </span>

                        <div class="show-intervention-hide container">

                        </div>

                    </div>

                </div>
            </div>
        </div>

         <script src="../js/isCo.js"></script>


<script>
    window.onload = function go(){
        getAllIntervention();
    };

    function getAllIntervention(){
        var allIntervention;

        var options = { 
            url: "../../pomocServicesAPI/api/intervention/getAllIntervention.php", 
            dataType: "text",
            type: "POST", 

            success: function( data, status, xhr){

                showAllIntervention(JSON.parse(xhr.responseText));
                  }, 
            error: function(xhr, status, error){

            }
        };
        $.ajax(options);
    }


    function showAllIntervention(intervention){
       
        console.log("fct showAllIntervention");
       
        let divHide = $('.show-intervention-hide');
        let element;
        for(let i = 0; i < Object.keys(intervention).length;   i++){
            if(intervention[i]['etat'] == 1){

            }
            else{
                addIntervention(intervention[i]);
            }
        }
    }


    function acceptIntervention(id){
        var data = {
            id: id
        };

        var options = {
            url: "../../pomocServicesAPI/api/intervention/acceptIntervention.php",
            dataType: "text",
            type: "POST",
            data: { data: JSON.stringify( data ) }, // Our valid JSON string
            success: function( data, status, xhr ) {
                console.log("successss");
                successAcceptIntervention();
                setTimeout(function(){
                    $('.response-box').html(' ');
                }, 4000);

            },
            error: function( xhr, status, error ) {
                //console.log("mince");
            }
        };
        $.ajax( options );
    }


    function refuseIntervention(id){
        var data = {
            id: id
        };

        var options = {
            url: "../../pomocServicesAPI/api/intervention/refuseIntervention.php",
            dataType: "text",
            type: "POST",
            data: { data: JSON.stringify( data ) }, // Our valid JSON string
            success: function( data, status, xhr ) {
                console.log("successss");
                 $('#intervention-'+id).remove();


            },
            error: function( xhr, status, error ) {
            }
        };
        $.ajax( options );
    }


    function addIntervention(intervention){
        console.log(intervention['title']);
        let  element = ' <div class="one-intervention row m-t-20" id="intervention-' + intervention['idIntervention'] + '\">' +

            ' <div class="col title-intervention" id="title-intervention-' + intervention['idIntervention'] + '" name="' + intervention['title'] + '"> <b>' + intervention["title"] + '</b></div>' +
            ' <div class="col date-intervention" id="date-intervention-' + intervention['dateIntervention'] + '" name="' + intervention['dateIntervention'] + '"> <b>' + intervention["dateIntervention"] + " à " + intervention["hourIntervention"] +'</b></div>' +
            ' <div class="col detail-intervention" id="detail-intervention-' + intervention['detail'] + '" name="' + intervention['detail'] + '"> <b>' +  " durant " + intervention["duration"] + "h"+ '</b></div>' +
            ' <div class="col jobs-intervention" id="jobs-intervention-' + intervention['jobs'] + '" name="' + intervention['jobs'] + '"> <b>' + intervention["jobs"] + '</b></div>' +
            ' <div class="col name-intervention" id="name-intervention-' + intervention['name'] + '" name="' + intervention['name'] + '"> <b>' + "Réalisé par M." + intervention["name"] + '</b></div>' +

           
            '<a type="button" class="col intervention-accept dis-flex justify-content-end" href="../payment/payment.php" onclick="acceptIntervention(' + intervention['idIntervention'] + ')">Valider</a>' + 

            '<a type="button" class="col intervention-refuse" href="InterventionHistory.php" onclick="refuseIntervention(' + intervention['idIntervention'] + ')">Annuler</a>' +   

            '</div>';
 

        $('.show-intervention-hide').append(element);
    }



</script>


</body>
</html>