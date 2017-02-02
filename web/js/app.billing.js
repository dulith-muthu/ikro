$(function () {
    initAutocomplete();
})


function initAutocomplete() {
    var origin = window.location.origin
    $(function () {
        $("#searchProduct").autocomplete({
            source: origin + "/admin/item/getItemsByCode",
            minLength: 1,
            select:function (event,object) {

                console.log(object.item)
                setProductBar(object.item)
            }
        });
    });
};

function setProductBar(data) {

}