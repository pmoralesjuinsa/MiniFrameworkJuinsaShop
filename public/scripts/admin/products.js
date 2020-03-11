function loadAttributes(productType)
{
    $.ajax({
        method: "POST",
        url: "/admin/product/attributes",
        dataType: "json",
        data: {productType: productType, productId: $('#new-product #productId').val()}
    })
        .done(function (attributes) {
            $('#new-product .attributes').html('');
            if(attributes.html) {
                $('#new-product .attributes').append(attributes.html);
            }
        })
        .fail(function () {
            alert("error getting the product type attributes");
        })
        .always(function (msg) {
            $('#messages').append(msg.messages);
        });
}

$(document).ready(function () {

    loadAttributes($("#new-product #type-product").val());

    $("#new-product #type-product").change(function () {
        productType = $(this).val();

        loadAttributes(productType);
    })
})