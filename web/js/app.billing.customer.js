var isSidebar = false
$(function () {

    $(".mdl-layout__drawer-button,.mdl-layout__obfuscator").on('click', function () {
        toggleSidebar()
    })
    initAutocompleteCustomer()

})
function initAutocompleteCustomer() {
    var href = window.location.href

    $(function () {

        var nicSearchBox = $("#customerNIC")
        nicSearchBox.autocomplete({
            autoFocus: true,
            source: href + "/customer/getSuggestionsByNic",
            minLength: 1,
            select: function (event, object) {

                console.log(object.item)
                setCustomerFields(object.item)

            }
        });
        nicSearchBox.bind('focus', function () {
            $(this).autocomplete("search");
        });
    });
}

function setCustomerFields(data) {
    $("#customerNIC").val(data.nic)
    $("#customerName").val(data.name)
    $("#mobileNumber").val(data.mobile)
    $("#homeNumber").val(data.fixed)
    $("#address").val(data.address)
}
function sidebarSave() {
    $(".mdl-layout__drawer-button").click()
    toggleSidebar()
}
function sidebarClear() {
    $("#customerNIC").val("")
    $("#customerName").val("")
    $("#mobileNumber").val("")
    $("#homeNumber").val("")
    $("#address").val("")
}
function toggleSidebar() {
    //$(".mdl-layout__drawer-button").click()
    setTimeout(function () {
        isSidebar = $(".mdl-layout__drawer").hasClass("is-visible")
        if (isSidebar) {
            focusInput("#customerNIC")
        } else {
            $("#customerNIC").autocomplete("close");
            dataTable.customer = createCustomerObject()

        }
    }, 100)
}
function focusInput(obj) {
    $(obj).select()

}
function createCustomerObject() {
    var nic = $("#customerNIC").val()
    var name = $("#customerName").val()
    var mobile = $("#mobileNumber").val()
    var home = $("#homeNumber").val()
    var address = $("#address").val()
    return {'nic': nic, 'name': name, 'mobile': mobile, 'home': home, 'address': address}

}