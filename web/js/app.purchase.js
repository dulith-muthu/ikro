$(function () {
    console.log(toSendBack)


    $.ajax({
        url: 'http://localhost:8000/admin/bill/purchase/save',
        dataType: 'text',
        type: 'post',

        data: {'invoice': toSendBack},
        success: function (data, textStatus, jQxhr) {
            alert("POST done")
        },
        error: function (jqXhr, textStatus, errorThrown) {
            console.log(errorThrown);
        }
    });
})