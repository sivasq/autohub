function updateForm() {
    document.getElementById("save-button").innerHTML = "Create";
}

function updateStatus() {

    var status = document.getElementById("orderStatus").value;
    var orderId = document.getElementById("orderId").value;
    $.ajax({
        url: updateStatusUrl,
        data: JSON.stringify({
            ord_id: orderId,
            ord_statusId: status
        }),
        method: "PUT",
        beforeSend: function (request) {
            request.setRequestHeader(headerKey, headerValue);
        }
    }).success(function () {
        if (parseInt(status) >= 3) {
            $("#updatePriceDiv").attr("hidden", true);
        }
        if (parseInt(status) < 3) {
            $("#updatePriceDiv").removeAttr("hidden");
        }
        swal("Success", "The Status Updated Successfully", "success");
    }).fail(function () {
        swal("Failed", "Fail to update the status", "error");
    });
}

function getProductUpdate() {


    var productType = document.getElementById("productType").value;

    if (productType == "1") {
        $('#productCategoryDiv').prop('hidden', false);
        $('#subItems').prop('hidden', true);
    } else if (productType == "2") {
        $('#productCategoryDiv').prop('hidden', true);
        $('#subItems').prop('hidden', false);
    } else if (productType == "3") {
        $('#productCategoryDiv').prop('hidden', true);
        $('#subItems').prop('hidden', true);
    } else {

    }
}