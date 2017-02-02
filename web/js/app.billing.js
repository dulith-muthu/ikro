$(function () {
    initAutocomplete();
})


function initAutocomplete() {
    var origin = window.location.origin
    $(function () {
        $("#searchProduct").autocomplete({
            source: origin + "/admin/item/getItemsByCode",
            minLength: 1,
            select: function (event, object) {

                console.log(object.item)
                setProductBar(object.item)
                $("#priceSelect").focus()
            }
        });
    });
};

function setProductBar(data) {
    $('.ikro-product-row .itemCode').html(data.itemCode)
    $('.ikro-product-row .itemType').html(data.itemType)
    $('.ikro-product-row .itemName').html(data.itemName)
    addToSelectElement(".ikro-product-row #priceSelect", ["ABC", "ABC", "ABC", "ABC", "ABC"])
}

function addToSelectElement(element, selectValues) {
    $(element).html("")
    setUnitPriceCount(selectValues)
    $.each(selectValues, function (key, value) {
        $(element)
            .append($("<option></option>")
                .attr("value", key)
                .text(value));
    });
}
function setUnitPriceCount(selectValues) {
    $('#unitPriceCaption').html("Unit Price (" + selectValues.length + ")")
}


