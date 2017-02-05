var dataTable = {'count': 0, 'data': []};
var currentItem = {};
$(function () {
    initAutocomplete();
    focusSearchBox()
    bindStuff()
})
function bindStuff() {
    $(".ikro-bill-table").on('click', '.btnEdit', function () {
        var toEditId = $(this).data('id')

        lodToEditEntry(toEditId)
    })
    $(".ikro-bill-table").on('click', '.btnRemove', function () {
        var toRemoveId = $(this).data('id')
        console.log(toRemoveId + "-- this is the D-loaded object")
        var loadedItem = getItemFromTable(toRemoveId)[0]
        console.log(loadedItem)
        var toDeleteIndex = dataTable.data.indexOf(loadedItem)
        if (toDeleteIndex > -1) {
            dataTable.data.splice(toDeleteIndex, 1);
            dataTable.count--;
        }
        renderTable()
    })
}

function lodToEditEntry(toEditId) {

    console.log(toEditId + "-- this is the loaded object")
    var loadedItem = getItemFromTable(toEditId)[0]
    console.log(loadedItem)
    currentItem = loadedItem
    setProductBar(loadedItem, "EXISTS")

}
function initAutocomplete() {
    var href = window.location.href
    console.log(window.location);
    $(function () {

        var searchProductBox = $("#searchProduct")
        searchProductBox.autocomplete({
            autoFocus: true,
            source: href + "/getItemsByCode",
            minLength: 1,
            select: function (event, object) {

                //console.log(object.item)
                currentItem = object.item;
                if (isExistInTable(currentItem.itemCode)) {
                    console.log("item EXISTS in the table")
                    lodToEditEntry(currentItem.itemCode)
                } else {
                    console.log("NEW item")
                    setProductBar(object.item, "EDIT")

                }

                jumpToNextTabIndex(object.item.unitPrice)

            }
        });
        searchProductBox.bind('focus', function () {
            $(this).autocomplete("search");
        });
    });
}
function setProductBar(data, mode) {

    allowSubmission = false;
    $('.ikro-product-row .itemCode').html(data.itemCode)
    $('.ikro-product-row .itemType').html(data.itemType)
    $('.ikro-product-row .itemName').html(data.itemName)
    $('.ikro-product-row .manufacturer').html(data.manufacturer)
    $('.ikro-product-row .availableQty').html(data.availableStock)

    addToSelectElement(".ikro-product-row #priceSelect", data.unitPrice)
    if (mode == "EXISTS") { //only if loading an existing value
        $("#qtyInput").val(data.qty)
        $("#discInput").val(data.disc)
        $("#discountSelect").val(data.discType)
        $("#priceSelect").val(data.price)
        $("#btnAdd").text("Change")
    } else {
        $("#btnAdd").text("Add")
    }
    $(".ikro-product-row").slideDown(60)
    console.log("this is data into set product bar")
    console.log(data)


}
function addToSelectElement(element, selectValues) {
    $(element).html("")
    setUnitPriceCount(selectValues)
    $.each(selectValues, function (key, value) {
        $(element)
            .append($("<option></option>")
                .attr("value", value)
                .text("Rs." + value));
    });
}
function setUnitPriceCount(selectValues) {
    $('#unitPriceCaption').html("Unit Price (" + selectValues.length + ")")
}
function jumpToNextTabIndex(priceArray) {
    if (priceArray > 1) {
        $("#priceSelect").focus()
    } else {
        $("#qtyInput").select()
    }

}

function insertRow() {
    if (validate()) {
        allowSubmission = true
        //==========================================
        delete currentItem['label']
        delete currentItem['value']
        currentItem['qty'] = $('#qtyInput').val()
        currentItem['disc'] = $('#discInput').val()
        currentItem['discType'] = $('#discountSelect').val()
        currentItem['price'] = $('#priceSelect').val()
        //console.log(currentItem)
        //===========================
        if (isExistInTable(currentItem.itemCode)) {
            getItemFromTable(currentItem.itemCode)[0] = currentItem

        } else {
            dataTable['count']++
            dataTable["data"].push(currentItem)

        }
        $("#btnAdd").text("Add")
        currentItem = {}
        //============================
        clearProductRow()
        focusSearchBox()
        renderTable()
    }
}
function renderTable() {
    var tableQuery = $('.ikro-bill-table tbody');
    tableQuery.html("")

    dataTable.data.forEach(function (item, index) {
        var template = "<tr><td> " + index + "</td><td>" + item.itemCode + "</td><td>" + item.itemType + "</td><td>" + item.itemName + "</td><td>" + item.price + "</td><td>" + item.qty + "</td><td>" + item.disc + "</td><td>" + item.disc + "</td><td>" + item.price + "</td><td><button data-id='" + item.itemCode + "' class='btnEdit' name='btnEdit' data-tabbic='1'> ✎ </button> <button data-id='" + item.itemCode + "'  class='btnRemove'  name='btnRemove' data-tabbic='1'> ✖ </button></td></tr>"
        tableQuery.append(template)
    })

}
function focusSearchBox() {
    $("#searchProduct").val("").select()
}

function clearProductRow() {
    //currentItem = {}
    $(".ikro-product-row").slideUp(60)
    $('.ikro-product-row .itemCode').html("-")
    $('.ikro-product-row .itemType').html("-")
    $('.ikro-product-row .itemName').html("-")
    $('.ikro-product-row .manufacturer').html("-")
    $('.ikro-product-row .availableQty').html("-")
    $("#qtyInput").val(1)
    $("#discInput").val(0)
    $("#discountSelect").val(1)

    $(".ikro-product-row #priceSelect").html("<option value=''>&nbsp;&nbsp;-&nbsp;&nbsp;</option>")
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
function removeAll() {
    dataTable = {'count': 0, 'data': []};
    renderTable()
}
