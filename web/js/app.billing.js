var dataTable = {'count': 0, 'data': []};
var currentItem = {};
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
                currentItem = object.item
                setProductBar(object.item)
                jumpToNextTabIndex(object.item.unitPrice)
                console.log(this)
            }
        });
    });
}
function setProductBar(data) {
    $('.ikro-product-row .itemCode').html(data.itemCode)
    $('.ikro-product-row .itemType').html(data.itemType)
    $('.ikro-product-row .itemName').html(data.itemName)
    $('.ikro-product-row .manufacturer').html(data.manufacturer)
    $('.ikro-product-row .availableQty').html(data.availableStock)
    //addToSelectElement(".ikro-product-row #priceSelect", data.unitPrice) temp
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
function jumpToNextTabIndex(priceArray) {
    if (priceArray > 1) {
        $("#priceSelect").focus()
    } else {
        $("#qtyInput").focus()
    }

}

function insertRow() {
    delete currentItem['label']
    delete currentItem['value']
    currentItem['qty'] = $('#qtyInput').val()
    currentItem['disc'] = $('#discInput').val()
    currentItem['discType'] = $('#discountSelect').val()
    currentItem['price'] = $('#priceSelect').val()
    console.log(currentItem)
    dataTable['count']++
    dataTable["data"].push(currentItem)
    renderTable()
}
function renderTable() {
    var tableQuery = $('.ikro-bill-table tbody');
    tableQuery.html("")

    dataTable.data.forEach(function (item, index) {
        // "+index+"
        // "+item.availableStock+"
        // "+item.disc+"
        // "+item.discType+"
        // "+item.itemCode+"
        // "+item.itemName+"
        // "+item.itemType+"
        // "+item.manufacturer+"
        // "+item.price+"
        // "+item.qty+"
        var template = "<tr><td> "+index+"</td><td>"+item.itemCode+"</td><td>"+item.itemType+"</td><td>"+item.itemName+"</td><td>"+item.price+"</td><td>"+item.qty+"</td><td>"+item.disc+"</td><td>"+item.disc+"</td><td>"+item.price+"</td><td><button class='btnEdit' id='btnEdit' name='btnEdit'> ✎ </button> <button class='btnRemove' id='btnRemove' name='btnRemove'> ✖ </button></td></tr>"
        tableQuery.append(template)
    })


}