function updateForm(event) {
    document.getElementById("save-button").innerHTML = "Create";
    $("#"+event.target.id+" input[type=hidden]").val('');
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
        Swal.fire("Success", "The Status Updated Successfully", "success");
    }).fail(function () {
        Swal.fire("Failed", "Fail to update the status", "error");
    });
}

function updatePaymentStatus() {

    var status = document.getElementById("txnStatus").value;
    var orderId = document.getElementById("orderId").value;
    $.ajax({
        url: updatePaymentStatusUrl,
        data: JSON.stringify({
            orp_orderId: orderId,
            orp_status: status
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
        Swal.fire("Success", "The Status Updated Successfully", "success");
    }).fail(function () {
        Swal.fire("Failed", "Fail to update the status", "error");
    });
}

function convertOrder() {
    $.ajax({
        url: convertorder,
        method: "POST",
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
        Swal.fire("Success", "The Status Updated Successfully", "success");
    }).fail(function () {
        Swal.fire("Failed", "Fail to update the status", "error");
    });
}

function getProductUpdate() {

    var productType = document.getElementById("productType").value;

    if (productType === "1") {
        $('#productCategoryDiv').prop('hidden', false);
        $('#subItems').prop('hidden', true);
    } else if (productType === "2") {
        $('#productCategoryDiv').prop('hidden', true);
        $('#subItems').prop('hidden', false);
    } else if (productType === "3") {
        $('#productCategoryDiv').prop('hidden', true);
        $('#subItems').prop('hidden', true);
    } else {
        $('#productCategoryDiv').prop('hidden', false);
        $('#subItems').prop('hidden', true);
    }
}

async function updateOrderStatus() {

    var status = document.getElementById("orderStatus").value;
    var orderId = document.getElementById("orderId").value;

    var dataObject = {};
    dataObject.ord_id = orderId;
    dataObject.ord_statusId = status;

    if(status == 2) {
        let courierInfo = await getCourierInfo();
        dataObject.courierId = courierInfo.value.courierid;
        dataObject.courierTrackingId = courierInfo.value.couriertrackingid;
    }

    $.ajax({
        url: updateOrderStatusUrl,
        data: JSON.stringify(dataObject),
        method: "PUT",
        beforeSend: function (request) {
            request.setRequestHeader(headerKey, headerValue);
        }
    }).success(function () {
        Swal.fire("Success", "The Status Updated Successfully", "success");
    }).fail(function () {
        Swal.fire("Failed", "Fail to update the status", "error");
    });
}

function getCourierInfo() {

    return Swal.fire({
        title: 'Courier Details',
        html:
            '<form class="form-horizontal" role="form">'+
            '<div class="form-group">'+
            '<label class="col-md-4 control-label">Courier Id</label>'+
            '<div class="col-md-8">'+
            '<input type="text" id="courierid" class="form-control" value="" required>'+
            '</div>'+
            '</div>'+
            '<div class="form-group">'+
            '<label class="col-md-4 control-label">Courier Tracking Id</label>'+
            '<div class="col-md-8">'+
            '<input type="text" id="couriertrackingid" class="form-control" value="" required>'+
            '</div>'+
            '</div>'+
            '</form>',
        focusConfirm: false,
        showCancelButton: true,
        confirmButtonText: 'Submit',
        showLoaderOnConfirm: true,
        preConfirm: () => {
            let courierid = document.getElementById('courierid').value;
            let couriertrackingid = document.getElementById('couriertrackingid').value;

            if(courierid == ''){
                Swal.showValidationMessage(
                    'Please Enter Courier Id'
                )
            }else if(couriertrackingid == ''){
                Swal.showValidationMessage(
                    'Please Enter Courier Tracking Id'
                )
            }

            return {
                'courierid': courierid,
                'couriertrackingid': couriertrackingid
            };
        }
    });
}