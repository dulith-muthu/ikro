var allowSubmission=false


$(function () {

})
$(".ikro-product-row input[type='number']").on('keypress',function () {
    $(this).removeClass("error")
})
function validate() {
    var error=0;
    var qty=$("#qtyInput").val()
    var disc=$("#discInput").val()
    if(Math.floor(qty) == qty && $.isNumeric(qty)){
        console.log("QTY VALID")
    }else{
        $("#qtyInput").addClass("error")
        if(!error){
            $("#qtyInput").select()
        }
        error=1
    }
    if($.isNumeric(disc)){
        console.log("DISCOUNT VALID")
    }else{
        $("#discInput").addClass("error")
        if(!error){
            $("#discInput").select()
        }
        error=1
    }
    return !error
}
function dialogBillIncomplete() {
    showDialog({
        title: 'Bill Incomplete',
        text: 'Make sure there is no data to be submitted.',

        positive: {
            title: 'OK',
            onClick: function (e) {

            }
        }
    });
};
//DIALOG BOX
//use https://github.com/oRRs/mdl-jquery-modal-dialog
//https://jsfiddle.net/w5cpw7yf/



