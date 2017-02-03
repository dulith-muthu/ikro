var dataTable = {'count': 0, 'data': []};
var currentItem = {};
$(function () {
    initAutocomplete();
    focusSearchBox()
    bindStuff()
})
function bindStuff() {
    $(".ikro-bill-table").on('click','.btnEdit', function () {
        var toEditId = $(this).data('id')
        console.log(toEditId)
        console.log(getItemFromTable(toEditId))
        setProductBar(getItemFromTable(toEditId)[0])
    })
}
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
    //============================
    clearProductRow()
    focusSearchBox()
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
        var template = "<tr><td> " + index + "</td><td>" + item.itemCode + "</td><td>" + item.itemType + "</td><td>" + item.itemName + "</td><td>" + item.price + "</td><td>" + item.qty + "</td><td>" + item.disc + "</td><td>" + item.disc + "</td><td>" + item.price + "</td><td><button data-id='" + item.itemCode + "' class='btnEdit' name='btnEdit'> ✎ </button> <button class='btnRemove'  name='btnRemove'> ✖ </button></td></tr>"
        tableQuery.append(template)
    })

}
function focusSearchBox() {
    $("#searchProduct").val("").focus()
}

function clearProductRow() {
    $('.ikro-product-row .itemCode').html("-")
    $('.ikro-product-row .itemType').html("-")
    $('.ikro-product-row .itemName').html("-")
    $('.ikro-product-row .manufacturer').html("-")
    $('.ikro-product-row .availableQty').html("-")
    $("#qtyInput").val(1)
    $("#discInput").val(0)
    // $(".ikro-product-row #priceSelect").html("<option value=''>&nbsp;&nbsp;-&nbsp;&nbsp;</option>")
}
function isExistInTable(itemCode) {
    var result = $.grep(dataTable.data, function (e) {
        return e.itemCode == itemCode;
    });
    return result.length
}

function getItemFromTable(itemCode) {
    return $.grep(dataTable.data, function (e) {
        return e.itemCode == itemCode;
    });

}
