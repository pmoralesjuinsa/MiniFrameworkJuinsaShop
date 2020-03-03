$(document).ready(function () {
    $('form.buy_product').on("submit", function (event) {
        event.preventDefault();

        $.ajax({
            method: "POST",
            url: "/add-to-cart",
            dataType: "json",
            data: {cart: $(this).serialize()}
        })
            .done(function (cartResult) {
                $('#carrito-count').text(cartResult.totalItems);
            })
            .always(function (msg) {
                $('#messages').text(msg.messages);
            });
    })
})