<?php
  include("../function.php");
?>



<!DOCTYPE html>


<html lang="en">
<head>
  <title>Home Service</title>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="icon" type="image/png" href="../../images/icons/favicon.ico"/>

    <link rel="stylesheet" type="text/css" href="../../fonts/font-awesome-4.7.0/css/font-awesome.min.css">

    <link rel="stylesheet" type="text/css" href="../../fonts/Linearicons-Free-v1.0.0/icon-font.min.css">

    <link rel="stylesheet" type="text/css" href="../../css/bootstrap/css/bootstrap-grid.min.css">

    <link rel="stylesheet" type="text/css" href="../../css/util.css">

    <link rel="stylesheet" type="text/css" href="../../css/main.css">

    <script src="../../jquery/jquery-3.2.1.min.js"></script>


    <link href="http://localhost/projetA/ProjetA/css/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="http://localhost/projetA/ProjetA/css/carousel.css" rel="stylesheet">
    <script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
    <link href="http://localhost/projetA/ProjetA/css/index.css" rel="stylesheet">
    <!--    <link href="//netdna.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">-->
    <script src="//netdna.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>


    <script src="../../jquery/jquery-3.2.1.min.js"></script>
</head>
<body>
<header id="header">

</header>

<!--    <form method="POST" action="devis/devisToPdf.php">-->
  <div class="limiter">
    <div class="login">
      <div class="wrap-login p-l-50 p-r-50 p-t-77 p-b-30">
        <div class="login-form validate-form">
          <span class="login-form-title p-b-55">
            DEVIS
          </span>



          <div class="wrap-input validate-input m-b-16" data-validate = "Name is required">
            <input class="input" type="text" id="name"name="name" placeholder="Name">
            <span class="focus-input"></span>
            <span class="symbol-input">
              <span class="lnr lnr-user"></span>
            </span>
          </div>
          <div class="wrap-input validate-input m-b-16" data-validate = "Surname is required">
            <input class="input" type="text" id="firstName" name="firstName" placeholder="FirstName">
            <span class="focus-input"></span>
            <span class="symbol-input">
              <span class="lnr lnr-user"></span>
            </span>
          </div>
          <div class="wrap-input validate-input m-b-16" data-validate = "Valid email is required: Talioh@abc.xyz">
            <input class="input" type="text" id="mail" name="mail" placeholder="Email">
            <span class="focus-input"></span>
            <span class="symbol-input">
              <span class="lnr lnr-envelope"></span>
            </span>
          </div>
          <div class="wrap-input validate-input m-b-16" data-validate = "Address is required">
            <input class="input" type="text" id="address" name = "address"placeholder="Service's address">
            <span class="focus-input"></span>
            <span class="symbol-input">
              <span class="lnr lnr-home"></span>
            </span>
          </div>

            <div class="wrap-input validate-input m-b-16" data-validate = "Postal code is required">
                <input class="input" type="text" id="postalCode" name = "postalCode" placeholder="Postal Code">
                <span class="focus-input"></span>
                <span class="symbol-input">
              <span class="lnr lnr-home"></span>
            </span>
            </div>

            <div class="wrap-input validate-input m-b-16" data-validate = "City is required">
                <input class="input" type="text" name="city" id="city" placeholder="City">
                <span class="focus-input"></span>
                <span class="symbol-input">
              <span class="lnr lnr-home"></span>
            </span>
            </div>


          <div class="wrap-input validate-input m-b-16" data-validate = " Correct hour is required">
                  <input type="time" class="input" id="serviceHour" name="hour"placeholder="Heure de la prestation">
                  <span class="focus-input"></span>
            <span class="symbol-input">
              <span class="lnr lnr-history"></span>
            </span>
                 </div>



          <div class="wrap-input validate-input m-b-16">

              <select type="text" class="input" name="service" id="serviceList">

                  <option value="">Service needed</option>
                  <?php
                  //              			$serviceName = displayServices();
                  //                 			for ($i=0; $i < count($serviceName) ; $i++) {
                  //                  				echo "<option value='" . $serviceName[$i][0] . "'>" . $serviceName[$i][0] . "</option>";
                  //                			}
                  ?>
              </select>
                    <span class="focus-input"></span>
            <span class="symbol-input">
              <span class="lnr lnr-magic-wand"></span>
            </span>
                </div>


          <div class="wrap-input validate-input m-b-16">
            <input class="input" type="number" name="duration" id="duration" placeholder="Service's duration in hours">
            <span class="focus-input"></span>
            <span class="symbol-input">
              <span class="lnr lnr-history"></span>
            </span>
          </div>



          <div class="container-login-form-btn p-t-25">
<!--             <button type= "submit"  class="login-form-btn" onclick="pdf();">
              Faire le Devis
            </button> -->
              <button type= "submit"  class="login-form-btn" onclick="validateRequest();">
                  Faire le Devis
              </button>
          </div>
<!--        </form>-->
      </div>
    </div>
  </div>


<script src="http://localhost/projetA/ProjetA/js/isCo.js"> </script>

      <script>




    window.onload = function() {


        var option = {
            url: "../../../pomocServicesAPI/api/service/getServiceValide.php",
            dataType: "text",
            type: "POST",
            data: {},
            success: function(data, status, xhr){
                let serviceInfo = JSON.parse(xhr.responseText);
                let optionElement;
                for ( let i = 0; i < serviceInfo.length; i++){
                    optionElement = document.createElement("option");
                    optionElement.setAttribute( "value", serviceInfo[i]['id']);
                    optionElement.innerHTML = serviceInfo[i]['jobs'];
                    console.log(serviceInfo[i]['jobs']);
                    $('#serviceList').append(optionElement);
                }
                console.log();
            },
            error: function( xhr, status, error ){

            }
        };
        $.ajax(option);
    };




    function validateRequest(){
        let data = {
            name: $('#name').val(),
            firstName: $('#firstName').val(),
            mail: $('#mail').val(),
            address: $('#address').val(),
            postalCode: $('#postalCode').val(),
            city: $('#city').val(),
            serviceHour: $('#serviceHour').val(),
            service: $('#serviceList').val(),
            duration: $('#duration').val()
        };

        var options = {
            url: "../../../pomocServicesAPI/api/Devis/devisToPdf.php",
            dataType: "text",
            type: "POST",
            data: { data: JSON.stringify( data ) }, // Our valid JSON string
            success: function( data, status, xhr ) {
                // window.open("testPDF.php");

                var mapForm = document.createElement("form");
                mapForm.target = "_blank";
                mapForm.method = "POST"; // or "post" if appropriate
                mapForm.action = "testPDF.php";

                var mapInput = document.createElement("input");
                mapInput.type = "text";
                mapInput.name = "content";
                mapInput.value = data;
                mapForm.appendChild(mapInput);

                document.body.appendChild(mapForm);

                mapForm.submit();

                // map = window.open("", "Map", "status=0,title=0,height=600,width=800,scrollbars=1");
                // if (map) {
                // } else {
                //     alert('You must allow popups for this map to work.');
                // }
            },
            error: function( xhr, status, error ) {

            }
        };
        $.ajax( options );

        console.log(data);


    }

    // function pdf(data){
    //     var doc = new jsPDF;
    //
    //     doc.fromHTML(data, 1, 1 );
    //     doc.save('two-by-four.pdf');
    // }
</script>



<!--  <script type="text/javascript">-->
<!---->
<!--    function validateRequest(){-->
<!---->
<!---->
<!--        var options = {-->
<!--            url: "../../pomocServicesAPI/api/Devis/devisToPdf.php",-->
<!--            dataType: "text",-->
<!--            type: "POST",-->
<!--            data: { data: JSON.stringify( data ) }, // Our valid JSON string-->
<!--            success: function( data, status, xhr ) {-->
<!--            },-->
<!--            error: function( xhr, status, error ) {-->
<!---->
<!--            }-->
<!--        };-->
<!--        $.ajax( options );-->
<!---->
<!--        console.log(data);-->
<!---->
<!---->
<!--    }-->
<!--  </script>-->

</body>
</html>