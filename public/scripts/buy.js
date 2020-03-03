$(document).ready(function(){
    $('form.buy_product').on("submit", function(event){
        event.preventDefault();

        $.ajax({
            method: "POST",
            url: "/add-to-cart",
            dataType: "json",
            data: { cart : $(this).serialize() }
        })
            .done(function( cartResult ) {
                $('#carrito-count').text(cartResult.total_items);
            })
            .fail(function ( msg ) {
                alert(msg);
            });
    })
})