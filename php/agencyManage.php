<?php
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
<!--<form method="POST" action="sendDevis.php">-->
<div class="limiter">
    <div class="login">
        <div class="wrap-login p-l-50 p-r-50 p-t-77 p-b-30">
            <div class="login-form validate-form">
          <span class="login-form-title p-b-55">
            Agences
          </span>



                <div class="wrap-input validate-input m-b-16" data-validate="Agress is required" >
                    <input class="input" type="text" id="address" placeholder="adresse">
                    <span class="focus-input"></span>
                    <span class="symbol-input">
              <span class="lnr lnr-home"></span>
                        </span>
                </div>

                <div class="wrap-input validate-input m-b-16" data-validate = "Postal code is required">
                    <input class="input" type="text" id="cityCode"  placeholder="Postal Code">
                    <span class="focus-input"></span>
                    <span class="symbol-input">
              <span class="lnr lnr-home"></span>
            </span>
                </div>

                <div class="wrap-input validate-input m-b-16" data-validate = "City is required">
                    <input class="input" type="text" id="city" placeholder="City">
                    <span class="focus-input"></span>
                    <span class="symbol-input">
              <span class="lnr lnr-home"></span>
            </span>
                </div>


                <div class="container-login-form-btn p-t-25" onclick="validateRequest();">
                    <button type="submit" class="login-form-btn">
                        Ajouter une agence
                    </button>
                </div>

                <div class="text-white response-box pos-relative">

                </div>

                <div class="div-grey container-fluid m-t-100 m-b-50">
                    <div class="bar-grey"></div>
                </div>



                <div id="list-service" class="container-fluid">
                        <span class="login-form-title p-b-55">
                            Liste des agences
                        </span>

                    <div class="show-agency-active container">

                    </div>

                    <div class="show-agency-hide container">

                    </div>

                </div>

                <!--</form>-->
            </div>
        </div>
    </div>

    <script src="../jquery/jquery-3.2.1.min.js"></script>
    <script src="../js/isCo.js"></script>

    <script>
        window.onload = function go(){
            getAllAgency();
        };

        function getAllAgency() {
            var allAgency;

            var options = {
                url: "../../pomocServicesAPI/api/agency/getAllAgency.php",
                dataType: "text",
                type: "POST",
                success: function( data, status, xhr ) {
                    showAllAgency(JSON.parse(xhr.responseText));
                },
                error: function( xhr, status, error ) {

                }
            };
            $.ajax( options );
        };

        function showAllAgency(agency){
            let divActive = $('.show-agency-active');
            let divHide = $('.show-agency-hide');
            let element;
            for(let i = 0; i < Object.keys(agency).length;   i++){
                if(agency[i]['state'] == 1){
                    addAgencyActive(agency[i]);
                }
                else{
                    addAgencyHide(agency[i]);
                }
            }
        }


        function successAddAgency(){
            $(".response-box").html("<div class='success'>Agence ajouté</div>");
        }

        function nameFailAddAgency(){
            $(".response-box").html("<div class='danger'>Agence deja existante</div>");
        }

        function failAddAgency(){
            $(".response-box").html("<div class='danger'>Donnée non valide</div>");
        }

        function validateRequest() {
            var data = {
                address: $("#address").val(),
                cityCode: $("#cityCode").val(),
                city: $('#city').val(),
            };

            var options = {
                url: "../../pomocServicesAPI/api/agency/addAgency.php",
                dataType: "text",
                type: "POST",
                data: { data: JSON.stringify( data ) }, // Our valid JSON string
                success: function( data, status, xhr ) {
                    successAddAgency();
                    setTimeout(function(){
                        $('.response-box').html(' ');
                    }, 4000);

                    addAgencyActive(JSON.parse(xhr.responseText));
                },
                error: function( xhr, status, error ) {
                    if(xhr.status == 409){
                        nameFailAddAgency();
                        setTimeout(function(){
                            $('.response-box').html(' ');
                        }, 4000);
                    }
                    else{
                        failAddAgency();
                        setTimeout(function(){
                            $('.response-box').html(' ');
                        }, 4000);
                    }
                }
            };
            $.ajax( options );
        }

        function delAgency(id){
            var data = {
                id: id
            };

            var options = {
                url: "../../pomocServicesAPI/api/agency/deleteAgency.php",
                dataType: "text",
                type: "POST",
                data: { data: JSON.stringify( data ) }, // Our valid JSON string
                success: function( data, status, xhr ) {
                    $('#agency-'+id).remove();
                    addAgencyHide(JSON.parse(xhr.responseText));


                },
                error: function( xhr, status, error ) {

                }
            };
            $.ajax( options );
        }

        function activeAgency(id){
            var data = {
                id: id
            };

            var options = {
                url: "../../pomocServicesAPI/api/agency/activeAgency.php",
                dataType: "text",
                type: "POST",
                data: { data: JSON.stringify( data ) }, // Our valid JSON string
                success: function( data, status, xhr ) {
                    $('#agency-'+id).remove();
                    addAgencyActive(JSON.parse(xhr.responseText));

                },
                error: function( xhr, status, error ) {

                }
            };
            $.ajax( options );
        }

        function addAgencyActive(agency){
            // console.log('ok');
            let  element = ' <div class="one-service row m-t-20" id="agency-' + agency['idAgency'] + '\">' +

                // '<div class="div-name" id="div-name-' + service['id'] + '">' +
                '<div class="col address-agency" id="address-agency-' + agency['idAgency'] + '"  name="' + agency['address'] + '" onfocus="focusAddressAgency(' + agency['idAgency'] + ')"  onfocusout="blurAddressAgency(' + agency['idAgency'] + ',\'' + agency['address'] + '\')"><b>' + agency["address"] + '</b></div>' +
                // '<div class="col valide-address" id="valide-address-' + agency['idAgency'] + '" ><img id="button-address-' + agency['idAgency'] + '" class="hov-pointer" src="../images/icons/valide.png" width="30px" onclick="changeAddress(' + agency['idAgency'] + ')"></div>' +
                // '</div>'
                '<div class="col dis-flex justify-content-center div-cityCode"> '+
                '<div class="price-service " id="cityCode-' + agency['idAgency'] + '" name="' + agency['cityCode'] + '" onfocus="focuscityCode(' + agency['idAgency'] + ')"  onfocusout="blurcityCode(' + agency['idAgency'] + ',\'' + agency['cityCode'] + '\')"><div>' + agency["cityCode"] + '</div></div>' +
                '</div>'+
                // '<div class="div-valide-price">'+
                // '<div class="valide-cityCode" id="valide-cityCode-' + agency['idAgency'] + '"><img id="button-cityCode-' + agency['idAgency'] + '" class="hov-pointer" src="../images/icons/valide.png" width="30px" onclick="changecityCode(' + agency['idAgency'] + ')"></div>' +
                // '</div>'+
                '<div class="col cross-agency-delete dis-flex justify-content-end"><img class="hov-pointer" src="../images/icons/delete.png" width="30px" height="30px"  onclick="delAgency(' + agency['idAgency'] + ')"></div>' +
                '</div>';
            $('.show-agency-active').append(element);
        }

        function addAgencyHide(agency){
            console.log('ok');
            let  element = ' <div class="one-agency row m-t-20" id="agency-' + agency['idAgency'] + '\">' +

                // '<div class="div-name" id="div-name-' + service['id'] + '">' +
                '<div class="col address-agency" id="address-agency-' + agency['idAgency'] + '" contenteditable="true" name="' + agency['address'] + '" onfocus="focusAddressAgency(' + agency['idAgency'] + ')"  onfocusout="blurAddressAgency(' + agency['idAgency'] + ',\'' + agency['address'] + '\')"><b>' + agency["address"] + '</b></div>' +
                // '<div class="col valide-address" id="valide-address-' + agency['idAgency'] + '" ><img id="button-address-' + agency['idAgency'] + '" class="hov-pointer" src="../images/icons/valide.png" width="30px" onclick="changeAddress(' + agency['idAgency'] + ')"></div>' +
                // '</div>'
                '<div class="col dis-flex justify-content-center div-cityCode"> '+
                '<div class="price-service " id="cityCode-' + agency['idAgency'] + '" contenteditable="true" name="' + agency['cityCode'] + '" onfocus="focuscityCode(' + agency['idAgency'] + ')"  onfocusout="blurcityCode(' + agency['idAgency'] + ',\'' + agency['cityCode'] + '\')"><div>' + agency["cityCode"] + '</div></div>' +
                '</div>'+
                // '<div class="div-valide-price">'+
                // '<div class="valide-cityCode" id="valide-cityCode-' + agency['idAgency'] + '"><img id="button-cityCode-' + agency['idAgency'] + '" class="hov-pointer" src="../images/icons/valide.png" width="30px" onclick="changecityCode(' + service['id'] + ')"></div>' +
                // '</div>'+
                '<div class="col cross-agency-delete dis-flex justify-content-end"><img class="hov-pointer" src="../images/icons/valide.png" width="30px" height="30px"  onclick="activeAgency(' + agency['idAgency'] + ')"></div>' +
                '</div>';
            $('.show-agency-hide').append(element);
        }





    </script>