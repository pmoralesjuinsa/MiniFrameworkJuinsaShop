$(document).ready(function () {
    $("#new-product #type-product").change(function () {
        produtType = $(this).val();

        $.ajax({
            method: "POST",
            url: "/admin/product/attributes",
            dataType: "json",
            data: {productType: produtType}
        })
            .done(function (attributes) {
                $('#new-product .attributes').html('');
                if(attributes.html) {
                    $('#new-product .attributes').html(attributes.html);
                }
            })
            .fail(function () {
                alert("error getting the product type attributes");
            })
            .always(function (msg) {
                $('#messages').html(msg.messages);
                setTimeout(function () {
                    $('#messages .alert').alert('close');
                }, 2000);
            });
    })
})