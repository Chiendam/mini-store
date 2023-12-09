$(document).ready(function () {
    $('#user-table').on('click', '.btn-delete', function () {
        console.log(11111111)
        const id = $(this).attr('data-id')

        swal({
            title: "Bạn có chắc chắn?",
            text: "Dữ liệu sau khi xóa không thể phục hồi!",
            type: "warning",
            showCancelButton: true,
            confirmButtonColor: "#FF7043",
            confirmButtonText: "Đồng ý!",
            cancelButtonText: "Đóng!"
        }, async function (value) {
            if (value) {
                const url = `/admin/users/${id}`;
                $('#frm-delete').get(0).setAttribute('action', url)
                $('#frm-delete').submit()
            }
        })
    })

})
