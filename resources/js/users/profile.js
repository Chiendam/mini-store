$(document).ready(function () {
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    const password = $('#modal_change_password-password')
    const labelPassword = $('#modal_change_password-password_smg')
    const passwordNew = $('#modal_change_password-password_new')
    const labelPasswordNew = $('#modal_change_password-password_new_smg')
    const passwordNewConfirm = $('#modal_change_password-password_new_confirm')
    const labelPasswordNewConfirm = $('#modal_change_password-password_new_confirm_smg')

    $('#form_change_password').on('click', '.btn-change-password', async function () {
        !password.val() && (labelPassword.text("Không được để trống dữ liệu"))
        !passwordNew.val() && (labelPasswordNew.text("Không được để trống dữ liệu"))
        !passwordNewConfirm.val() && (labelPasswordNewConfirm.text("Không được để trống dữ liệu"))
        if(!password.val() || !passwordNew.val() || !passwordNewConfirm.val()) {
            return
        } else if(passwordNewConfirm.val() != passwordNew.val()) {
            labelPasswordNewConfirm.text("Xác nhận mật khẩu không chính xác")
            return
        } else {
            try {
                const res = await checkPassword(password.val())
                if(!res?.result) labelPassword.text(`Mật khâu hiện tại không chính xác`)
                else changePassword({
                    password: password.val(), 'newPassword': passwordNew.val()
                })
            } catch (e) {
                labelPassword.text(`Mật khâu hiện tại không chính xác`)
            }
        }
    })

    $(document).mouseup(function(e) {
        const container = $("#modal_change_password");

        if (!container.is(e.target) && container.has(e.target).length === 0) {
            resetLabelForm()
        }
    });

    const resetLabelForm = () => {
        labelPassword.text("")
        labelPasswordNew.text("")
        labelPasswordNewConfirm.text("")
    }

    $('#btnCloseFormChangPass').on('click', function () {
        resetLabelForm()
    })

    password.on('keyup', function() {
        if(!password.val()) labelPassword.text("Không được để trống dữ liệu")
        else  labelPassword.text("")
    });

    passwordNew.on('keyup', function() {
        if(!passwordNew.val()) labelPasswordNew.text("Không được để trống dữ liệu")
        else  labelPasswordNew.text("")
    });

    passwordNewConfirm.on('keyup', function() {
        if(!passwordNewConfirm.val()) labelPasswordNewConfirm.text("Không được để trống dữ liệu")
        else  labelPasswordNewConfirm.text("")
    });

    const checkPassword = async (password) => {
        return $.ajax({
            url: '/admin/profile/exist-password/' ,
            type: 'POST',
            data: {
                password: password,
            },
        })
    }

    const changePassword = ({password, newPassword}) => {
        $('#password-form-change').val(password);
        $('#new-password-form-change').val(newPassword);
        const url = `/admin/profile/change-password`;
        $('#frm-change-password').get(0).setAttribute('action', url)
        $('#frm-change-password').submit()
    }

})
