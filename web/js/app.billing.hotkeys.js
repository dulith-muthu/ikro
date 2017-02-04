$(function () {
    $('*').keyup(function (e) {

    });
    Mousetrap.bindGlobal('ins', function (e) {
        preventKey(e)
        $("#btnAdd").click()
    });
    Mousetrap.bindGlobal('ctrl+del', function (e) {
        preventKey(e)
        $("#btnClear").click()
    });
    Mousetrap.bindGlobal('ctrl+home', function (e) {
        preventKey(e)
        $("#btnRemoveAll").click()
    });
    Mousetrap.bindGlobal('end', function (e) {
        preventKey(e)
        //TODO use an array to collect all tabable elements, check current one, focus next one
        var focused = $(':focus');
        console.log(focused)
        focused.next('button').focus();

    });

})

function preventKey(e) {
    if (e.preventDefault) {
        e.preventDefault();
    }
}