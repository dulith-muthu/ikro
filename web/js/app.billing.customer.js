var isSidebar = false
$(function () {
    $(".mdl-layout__drawer-button").on('click', function () {
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
function sidebarDone() {
    $(".mdl-layout__drawer-button").click()
    toggleSidebar()
}
function toggleSidebar() {
    //$(".mdl-layout__drawer-button").click()
    setTimeout(function () {
        isSidebar = $(".mdl-layout__drawer").hasClass("is-visible")
        if (isSidebar) {
            focusInput("#customerNIC")
        } else {
            $("#customerNIC").autocomplete("close");
        }
    }, 100)
}
function focusInput(obj) {
    $(obj).select()
}