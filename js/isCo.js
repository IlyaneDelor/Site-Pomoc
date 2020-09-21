

    isCo();
    function isCo(){

    let option = {
    url: 'http://localhost/projetA/pomocServicesAPI/api/acountManage/isCo.php',
    dataType: 'text',
    type: "POST",
    success: function(data, status, xhr){
    $('#header').html(xhr.responseText);
},
    error: function(xhr, status, error){;
    $('#header').html(xhr.responseText);
}
};

    $.ajax(option);
}

function deco() {
    let option = {
        url: 'http://localhost/projetA/pomocServicesAPI/api/acountManage/deco.php',
        dataType: 'text',
        type: "POST",
        success: function (data, status, xhr) {
        //    document.location.href = "http://localhost/projetA/ProjetA/php/index.php";
        },
        error: function (xhr, status, error) {

        }
    };

    $.ajax(option);
}
