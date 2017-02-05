var isSidebar = false
$(function () {
    $(".mdl-layout__drawer-button").on('click', function () {
        openSidebar()
    })

})
function openSidebar() {
    //$(".mdl-layout__drawer-button").click()
    setTimeout(function () {
        isSidebar = $(".mdl-layout__drawer").hasClass("is-visible")
        if(isSidebar){
            focusInput("#customerName")
        }
    }, 100)
}
function focusInput(obj) {
    $(obj).select()
}