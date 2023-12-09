const idBtnLogin = $('#btn-login')
const idBtnSend = $('#btn-send')
$(document).ready(function () {
    $("#username").change(function(){
        $("#error-username").addClass('display-none')
    })

    $("#password").change(function(){
        $("#error-password").addClass('display-none')
    })

    $("#password_confirmation").change(function(){
        $("#error-password_confirmation").addClass('display-none')
    })

    $("#input-email").change(function(){
        $("#error-email").addClass('display-none')
    })

    idBtnLogin.keyup(function (e) {
        if (e.keyCode === 13) {
            $(this).trigger("enterKey");
        }
    });

    idBtnLogin.bind("enterKey", function (e) {
        $('#loginForm').submit()
    });

    idBtnSend.keyup(function (e) {
        if (e.keyCode === 13) {
            $(this).trigger("enterKey");
        }
    });

    idBtnSend.bind("enterKey", function (e) {
        $('#loginForm').submit()
    });
})
