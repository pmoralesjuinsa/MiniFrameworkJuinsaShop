$(document).ready(function(){
    $('form.buy_product').on("submit", function(event){
        event.preventDefault();

        $.ajax({
            method: "POST",
            url: "/add-to-cart",
            dataType: "json",
            // contentType: "multipart/form-data",
            data: { cart : $(this).serialize() }
        })
            .done(function( cartResult ) {
                myCart = jQuery.parseJSON(cartResult);
                $('#carrito-count').text(myCart.total_items);
            })
            .fail(function ( msg ) {
                alert(msg);
            });
    })
})