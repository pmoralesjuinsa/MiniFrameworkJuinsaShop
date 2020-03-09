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
                $.each(attributes, function(row, values) {
                    console.log(id);
                    console.log(name);
                    $('#new-product .attributes').append("<label>" + values.name + "</label><input type='text' name='attributes[" + values.id + "]'>");
                });

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