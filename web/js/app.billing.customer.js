var isSidebar = false
$(function () {
    $(".mdl-layout__drawer-button").on('click', function () {
        openSidebar()
    })
    initAutocompleteCustomer()

})
function initAutocompleteCustomer() {
    var href = window.location.href

    $(function () {

        var nicSearchBox = $("#customerNIC")
        nicSearchBox.autocomplete({
            autoFocus: true,
            source: href + "/getItemsByCode",
            minLength: 1,
            select: function (event, object) {

                console.log(object.item)


            }
        });
        nicSearchBox.bind('focus', function () {
            $(this).autocomplete("search");
        });
    });
}
function openSidebar() {
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