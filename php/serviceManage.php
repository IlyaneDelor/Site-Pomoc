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
<!--<form method="POST" action="sendDevis.php">-->
    <div class="limiter">
        <div class="login">
            <div class="wrap-login p-l-50 p-r-50 p-t-77 p-b-30">
                <div class="login-form validate-form">
          <span class="login-form-title p-b-55">
            Services
          </span>


                    <div class="wrap-input validate-input m-b-16" data-validate="Name is required">
                        <input class="input" type="text" id="name" name="name" placeholder="Name">
                        <span class="focus-input"></span>
                        <span class="symbol-input">
              <span class="lnr lnr-user"></span>
            </span>
                    </div>
                    <div class="wrap-input validate-input m-b-16" data-validate="Price is required" >
                        <input class="input" type="text" id="price" name="price" placeholder="price">
                        <span class="focus-input"></span>
                        <span class="symbol-input">
              <span class="lnr lnr-tag"></span>
                        </span>
                    </div>




                    <div class="container-login-form-btn p-t-25" onclick="validateRequest();">
                        <button type="submit" class="login-form-btn">
                            Ajouter un service
                        </button>
                    </div>

                    <div class="text-white response-box pos-relative">

                    </div>

                    <div class="div-grey container-fluid m-t-100 m-b-50">
                        <div class="bar-grey"></div>
                    </div>



                    <div id="list-service" class="container-fluid">
                        <span class="login-form-title p-b-55">
                            Liste des services
                        </span>

                        <div class="show-service-active container">

                        </div>

                        <div class="show-service-hide container">

                        </div>

                    </div>

<!--</form>-->
</div>
</div>
</div>

        <script src="../js/isCo.js"></script>

<script>
    window.onload = function go(){
        getAllService();
    };

    function getAllService() {
        var allService;

        var options = {
            url: "../../pomocServicesAPI/api/service/getAllService.php",
            dataType: "text",
            type: "POST",
            success: function( data, status, xhr ) {
                showAllService(JSON.parse(xhr.responseText));
            },
            error: function( xhr, status, error ) {

            }
        };
        $.ajax( options );
    };

    function showAllService(service){
        let divActive = $('.show-service-active');
        let divHide = $('.show-service-hide');
        let element;
        for(let i = 0; i < Object.keys(service).length;   i++){
            if(service[i]['state'] == 1){
                addServiceActive(service[i]);
            }
            else{
                addServiceHide(service[i]);
            }
        }
    }


    function successAddService(){
        $(".response-box").html("<div class='success'>Service ajouté</div>");
    }

    function nameFailAddService(){
        $(".response-box").html("<div class='danger'>Nom de service utilisé</div>");
    }

    function failAddService(){
        $(".response-box").html("<div class='danger'>Donnée non valide</div>");
    }




    function validateRequest() {
        var data = {
            name: $("#name").val(),
            price: $("#price").val()
        };

        var options = {
        url: "../../pomocServicesAPI/api/service/addService.php",
            dataType: "text",
            type: "POST",
            data: { data: JSON.stringify( data ) }, // Our valid JSON string
            success: function( data, status, xhr ) {
                successAddService();
                setTimeout(function(){
                    $('.response-box').html(' ');
                }, 4000);

                addServiceActive(JSON.parse(xhr.responseText));
            },
            error: function( xhr, status, error ) {
                if(xhr.status == 409){
                    nameFailAddService();
                    setTimeout(function(){
                        $('.response-box').html(' ');
                    }, 4000);
                }
                else{
                    failAddService();
                    setTimeout(function(){
                        $('.response-box').html(' ');
                    }, 4000);
                }
            }
        };
        $.ajax( options );
    }

    function delService(id){
        var data = {
            id: id
        };

        var options = {
            url: "../../pomocServicesAPI/api/service/deleteService.php",
            dataType: "text",
            type: "POST",
            data: { data: JSON.stringify( data ) }, // Our valid JSON string
            success: function( data, status, xhr ) {
              $('#service-'+id).remove();
              addServiceHide(JSON.parse(xhr.responseText));


            },
            error: function( xhr, status, error ) {

            }
        };
        $.ajax( options );
    }

    function activeService(id){
        var data = {
            id: id
        };

        var options = {
            url: "../../pomocServicesAPI/api/service/activeService.php",
            dataType: "text",
            type: "POST",
            data: { data: JSON.stringify( data ) }, // Our valid JSON string
            success: function( data, status, xhr ) {
                $('#service-'+id).remove();
                addServiceActive(JSON.parse(xhr.responseText));

            },
            error: function( xhr, status, error ) {

            }
        };
        $.ajax( options );
    }

    function addServiceActive(service){
        let  element = ' <div class="one-service row m-t-20" id="service-' + service['id'] + '\">' +

            // '<div class="div-name" id="div-name-' + service['id'] + '">' +
            '<div class="col name-service" id="name-service-' + service['id'] + '" contenteditable="true" name="' + service['jobs'] + '" onfocus="focusNameService(' + service['id'] + ')"  onfocusout="blurNameService(' + service['id'] + ',\'' + service['jobs'] + '\')"><b>' + service["jobs"] + '</b></div>' +
            '<div class="col valide-name" id="valide-name-' + service['id'] + '" ><img id="button-name-' + service['id'] + '" class="hov-pointer" src="../images/icons/valide.png" width="30px" onclick="changeName(' + service['id'] + ')"></div>' +
            // '</div>'
            '<div class="col dis-flex justify-content-center div-price"> '+
            '<div class="price-service " id="price-service-' + service['id'] + '" contenteditable="true" name="' + service['price'] + '" onfocus="focusPriceService(' + service['id'] + ')"  onfocusout="blurPriceService(' + service['id'] + ',\'' + service['price'] + '\')"><div>' + service["price"] + '</div></div>' +
            '<div>€</div></div>'+
            // '<div class="div-valide-price">'+
            '<div class="valide-price" id="valide-price-' + service['id'] + '"><img id="button-price-' + service['id'] + '" class="hov-pointer" src="../images/icons/valide.png" width="30px" onclick="changePrice(' + service['id'] + ')"></div>' +
            // '</div>'+
            '<div class="col cross-service-delete dis-flex justify-content-end"><img class="hov-pointer" src="../images/icons/delete.png" width="30px" height="30px"  onclick="delService(' + service['id'] + ')"></div>' +
            '</div>';
        $('.show-service-active').append(element);
    }

    function addServiceHide(service){
        let  element = ' <div class="one-service row m-t-20" id="service-' + service['id'] + '\">' +

            // '<div class="div-name" id="div-name-' + service['id'] + '">' +
                '<div class="col name-service" id="name-service-' + service['id'] + '" contenteditable="true" name="' + service['jobs'] + '" onfocus="focusNameService(' + service['id'] + ')"  onfocusout="blurNameService(' + service['id'] + ',\'' + service['jobs'] + '\')"><b>' + service["jobs"] + '</b></div>' +
                '<div class="col valide-name" id="valide-name-' + service['id'] + '" ><img id="button-name-' + service['id'] + '" class="hov-pointer" src="../images/icons/valide.png" width="30px" onclick="changeName(' + service['id'] + ')"></div>' +
            // '</div>'
            '<div class="col dis-flex justify-content-center div-price"> '+
            '<div class="price-service " id="price-service-' + service['id'] + '" contenteditable="true" name="' + service['price'] + '" onfocus="focusPriceService(' + service['id'] + ')"  onfocusout="blurPriceService(' + service['id'] + ',\'' + service['price'] + '\')"><div>' + service["price"] + '</div></div>' +
            '<div>€</div></div>'+
               // '<div class="div-valide-price">'+
            '<div class="valide-price" id="valide-price-' + service['id'] + '"><img id="button-price-' + service['id'] + '" class="hov-pointer" src="../images/icons/valide.png" width="30px" onclick="changePrice(' + service['id'] + ')"></div>' +
                // '</div>'+
            '<div class="col cross-service-delete dis-flex justify-content-end"><img class="hov-pointer" src="../images/icons/valide.png" width="30px" height="30px"  onclick="activeService(' + service['id'] + ')"></div>' +
            '</div>';
        $('.show-service-hide').append(element);
    }

    function focusNameService(id){
        $('#valide-name-' + id).show();
    }

    function focusPriceService(id){
        $('#valide-price-' + id).show();
    }

    function blurNameService(id, name){
        if($('#button-name-' + id + ':hover').length == 0) {
            hideName(id, name);
        }
    }

    function blurPriceService(id, price){
        if($('#button-price-' + id + ':hover').length == 0) {
            hidePrice(id, price);
        }
    }

    function hideName(id,name){
            $('#valide-name-' + id).hide();
            $('#name-service-' + id).html(name);

    }

    function hidePrice(id,price){
        $('#valide-price-' + id).hide();
        $('#price-service-' + id).html(price);
    }



    function changeName(id){
        var name = $('#name-service-' + id).html();
        var nameIsError = $('#name-service-' + id).attr('name');
        console.log(nameIsError);
        let reg = new RegExp("<.[^>]*>", "gi");
        name = name.replace(reg, "");
        //console.log(name);
        var data = {
            name: name,
            id: id
        }

        var options = {
            url: "../../pomocServicesAPI/api/service/updateNameService.php",
            dataType: "text",
            type: "POST",
            data: {data: JSON.stringify(data)},
            success: function(data, status, xhr){
                $('#name-service-' + id).attr('name', name);
                $('#valide-name-' + id).hide();
            },
            error: function(xhr, status, error){
                hideName(id, nameIsError);
            }
        };
        $.ajax(options);



    }

    function changePrice(id){
        var price = $('#price-service-' + id).html();
        var priceIsError = $('#price-service-' + id).attr('name');

        let reg = new RegExp("<.[^>]*>", "gi");
        price = price.replace(reg, "");
        //console.log(name);
        var data = {
            price: price,
            id: id
        }

        var options = {
            url: "../../pomocServicesAPI/api/service/updatePriceService.php",
            dataType: "text",
            type: "POST",
            data: {data: JSON.stringify(data)},
            success: function(data, status, xhr){
                $('#price-service-' + id).attr('name', price);
                $('#valide-price-' + id).hide();
            },
            error: function(xhr, status, error){
                hideName(id, priceIsError);
            }
        };
        $.ajax(options);



    }

</script>



<!--
 <script type="text/javascript">

   function validateRequest(){
     var from = new Formdata();
     var name = $('#title').val();

     form.append('title', $('#title').val());
     form.append('service', $('#service').val());
     form.append('city', $('#city').val());
     form.append('address', $('#address').val());
     form.append('serviceDate', $('#serviceDate').val());
     form.append('serviceHour', $('#serviceHour').val());
     form.append('duration', $('#duration').val());
     form.append('price', $('#price').val());
     form.append('detail', $('#detail').val());

     var xhr = new XMLHttpRequest();
     xhr.open('POST', 'validateRequest.php');
     xhr.responseType = 'json';
     xhr.send(form);
     var error = xhr.response;
   }
 </script>
-->
</body>
</html>