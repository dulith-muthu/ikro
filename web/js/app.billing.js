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
    addToSelectElement(".ikro-product-row #priceSelect", data.unitPrice)
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
    console.log(currentItem)
    dataTable['count']++
    dataTable["data"].push(currentItem)
    renderTable()
}
function renderTable() {
    var tableQuery=$('.ikro-bill-table tbody');
    tableQuery.html("")
    var template = "<tr><td>01</td><td>TRE-2263543</td><td>Living Room Couch</td><td>Damro Sofa Model B23</td><td>Rs.25,000</td><td>2</td><td>10%</td><td>Rs.5,000</td><td>Rs.45,000</td><td><button class='btnEdit' id='btnEdit' name='btnEdit'> ✎ </button> <button class='btnRemove' id='btnRemove' name='btnRemove'> ✖ </button></td></tr>"
    tableQuery.append(template)
}