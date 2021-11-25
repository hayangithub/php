function isEmpty(str) {
    return (!str || 0 === str.length);
}

function isEmail(email) {
    var regex = /^([a-zA-Z0-9_.+-])+\@(([a-zA-Z0-9-])+\.)+([a-zA-Z0-9]{2,4})+$/;
    return regex.test(email);
}

function checkUserSessionData() {
    let error = "";
    $.ajax({
        url: baseUrl + "home/checkUserSessionData",
        type: 'POST',
        async: false,
        data: {},
        success: function (data) {
            data = $.parseJSON(data);
            error = data['error'];
        },
        error: function (xhr) { // if error occured
            alert("Error occured.please try again");
        }

    });
    return error;
}

$(".numericOnly").keypress(function (e) {
    if (String.fromCharCode(e.keyCode).match(/[^0-9]/g))
        return false;
});

$('.numericOnly').on('paste', function (event) {
    if (event.originalEvent.clipboardData.getData('Text').match(/[^0-9]/g)) {
        event.preventDefault();
    }
});

$('.modal').on('show.bs.modal', function (e) {
    $('.modal .modal-dialog').attr('class', 'modal-dialog modal-lg  flipInX  animated');
})
$('.modal').on('hide.bs.modal', function (e) {
    $('.modal .modal-dialog').attr('class', 'modal-dialog modal-lg  flipOutX  animated');
})