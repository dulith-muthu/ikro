$(function () {
    $.post("http://localhost:8000/admin/bill/purchase/save",{'invoice':toSendBack}, function () {
        alert("Sent")
    });
})