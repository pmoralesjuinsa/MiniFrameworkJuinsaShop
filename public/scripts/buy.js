$(document).ready(function(){
    $('form.buy_product').on("submit", function(event){
        event.preventDefault();

        $.ajax({
            method: "POST",
            url: "/add_to_cart",
            data: { cart : $(this).serialize() }
        })
            .done(function( numberItems ) {
                $('#carrito-count').textContent(1);
            })
            .fail(function ( msg ) {
                alert(msg);
            });
    })
})