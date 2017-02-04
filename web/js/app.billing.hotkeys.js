$(function () {
    $(".shortcuts").click(function () {
        dialogHotkeys()
    })
    $('*').keyup(function (e) {

    });
    Mousetrap.bindGlobal('ins', function (e) {
        preventKey(e)
        if ($(".ikro-product-row").css("display") != "none") {
            $("#btnAdd").click()
        }
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

function dialogHotkeys() {
    showDialog({
        title: 'Keyboard Shortcuts',
        text: '<p>CTRL+C Copy.<br> CTRL+X Cut.<br> CTRL+V Paste.<br> CTRL+Z Undo.<br> DELETE Delete.<br> SHIFT+DELETE Delete selected item permanently<br> CTRL while dragging an item Copy selected item. <br> CTRL+SHIFT while dragging an item Create shortcut to selected item.<br> F2 Rename selected item.<br> CTRL+RIGHT ARROW Move the insertion point to the beginning of the next word.<br> CTRL+LEFT ARROW Move the insertion point to the beginning of the previous word.<br> CTRL+DOWN ARROW Move the insertion point to the beginning of the next paragraph.<br> CTRL+UP ARROW Move the insertion point to the beginning of the previous paragraph.</p>',

        positive: {
            title: 'OK',
            onClick: function (e) {

            }
        }
    });
};