$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});

$(document).ready(function () {
    // show alert after redirect
    let successMess = $('#success-mess').val()
    let errorMess = $('#error-mess').val()
    if (successMess) {
        setTimeout(function () {
            init.showNoty(successMess, 'success')
        }, 1000);
    }
    if (errorMess) {
        setTimeout(function () {
            init.showNoty(errorMess, 'error')
        }, 1000)
    }

})


const init = {
    conf: {
        ajaxSending: false
    },
    showNoty: function (text, success = true, title = '') {
        new PNotify({
            title: title,
            text: text,
            addclass: 'alert-styled-left alert-arrow-left text-sky-royal',
            type: type
        });

        $.jGrowl(text, {
            header: title,
            theme: success ? 'bg-teal' : 'bg-danger'
        });
    },

    makeSlug: function (title) {
        let slug

        //Đổi chữ hoa thành chữ thường
        slug = title.toLowerCase()

        //Đổi ký tự có dấu thành không dấu
        slug = slug.replace(/á|à|ả|ạ|ã|ă|ắ|ằ|ẳ|ẵ|ặ|â|ấ|ầ|ẩ|ẫ|ậ/gi, 'a')
        slug = slug.replace(/é|è|ẻ|ẽ|ẹ|ê|ế|ề|ể|ễ|ệ/gi, 'e')
        slug = slug.replace(/i|í|ì|ỉ|ĩ|ị/gi, 'i')
        slug = slug.replace(/ó|ò|ỏ|õ|ọ|ô|ố|ồ|ổ|ỗ|ộ|ơ|ớ|ờ|ở|ỡ|ợ/gi, 'o')
        slug = slug.replace(/ú|ù|ủ|ũ|ụ|ư|ứ|ừ|ử|ữ|ự/gi, 'u')
        slug = slug.replace(/ý|ỳ|ỷ|ỹ|ỵ/gi, 'y')
        slug = slug.replace(/đ/gi, 'd')
        //Xóa các ký tự đặt biệt
        slug = slug.replace(/\`|\~|\!|\@|\#|\||\$|\%|\^|\&|\*|\(|\)|\+|\=|\,|\.|\/|\?|\>|\<|\'|\"|\:|\;|_/gi, '')
        //Đổi khoảng trắng thành ký tự gạch ngang
        slug = slug.replace(/ /gi, "-")
        //Đổi nhiều ký tự gạch ngang liên tiếp thành 1 ký tự gạch ngang
        //Phòng trường hợp người nhập vào quá nhiều ký tự trắng
        slug = slug.replace(/\-\-\-\-\-/gi, '-')
        slug = slug.replace(/\-\-\-\-/gi, '-')
        slug = slug.replace(/\-\-\-/gi, '-')
        slug = slug.replace(/\-\-/gi, '-')
        //Xóa các ký tự gạch ngang ở đầu và cuối
        slug = '@' + slug + '@'
        slug = slug.replace(/\@\-|\-\@|\@/gi, '')
        return slug
    },
    isPhone: function (num) {
        return (/^(0)(\d{9})$/i).test(num);
    },
    isEmail: function (str) {
        return (/^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/).test(this.util_trim(str));
    },
    utilTrim: function (str) {
        return (/string/).test(typeof str) ? str.replace(/^\s+|\s+$/g, "") : "";
    }
};
