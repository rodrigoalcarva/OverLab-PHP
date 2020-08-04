$(document).ready(function() {
    $('#buttonCesto').click(function(e) {
        var personId = $('#idPersonSell').text();
        var idProduct = $('#idProduct').text();
        $.post( "phpScripts/storeScript2mao.php", {personSell : personId, idProductSell : idProduct}).done(function(){
            $('#cesta').load(location.href+" #rest");
        });
    });

    $('#buttonCesto1').click(function(e) {
        var idProduct1 = $('#idProduct1').text();
        var brandId = $('#idBrand1').text();
        var tam = $('#idTam1').text();
        console.log(brandId);
        console.log(idProduct1);
        console.log(tam);
        $.post("phpScripts/storeScriptDesigner.php", {b : idProduct1, a : brandId,  c: tam}).done(function(){
            console.log("a");
            $('#cesta').load(location.href+" #rest");
        });
    });
});