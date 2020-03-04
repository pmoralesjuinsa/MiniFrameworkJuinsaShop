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
    });

    $('.pay_cart .quantity').change(function(){
        quantity = $(this).val();
        id_product = $(this).parent().parent().children('.id_product').val();

        $.ajax({
            method: "POST",
            url: "/cart-modify-quantity",
            dataType: "json",
            data: {quantity: quantity, id_product: id_product}
        })
            .done(function (cart) {
                if(!cart.cart) {
                    $('.wrapper.cart-page').html('');
                    $('#carrito-count').text('0');
                    return;
                }

                $.each(cart.cart, function(idProduct, values) {
                    $('.product-' + idProduct + ' .totalProduct').text(values.total);
                });

                $('#carrito-count').text(cart.totalItems);
                $('#totalAmountValue').text(cart.totalAmount);
            })
            .fail(function () {
                alert("error");
            })
            .always(function (msg) {
                $('#messages').html(msg.messages);
                setTimeout(function () {
                    $('#messages .alert').alert('close');
                }, 2000);
            });
    });
});