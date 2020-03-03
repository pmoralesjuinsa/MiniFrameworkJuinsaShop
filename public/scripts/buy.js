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
                $('#messages').html(msg.messages);
                setTimeout(function () {
                    $('#messages .alert').alert('close');
                }, 2000);
            });
    })
})