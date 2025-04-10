const apiurl = 'http://122.117.32.6:81/market-api.php?action=';
const photourl = 'http://122.117.32.6:83/';

function checkLogin() {
    var data = {};
    data['keyA'] = getCookie('keyA');
    data['keyB'] = getCookie('keyB');
    $.ajax({
        type: "POST",
        url: apiurl + "checkKey",
        dataType: "json",
        data: JSON.stringify(data),
        success: function (data) {
            if (data.state === true) {
                // console.log(data);
                if (window.location.pathname.endsWith("/")) {
                    window.location.href = '/home.php';
                }
            } else {
                if (!window.location.pathname.endsWith("/")) {
                    window.location.href = "/";
                }
            }
        },
        error: function (data) {
            console.log(data);
        }
    });
}

function logout() {
    deleteCookie("keyA");
    deleteCookie("keyB");
    deleteCookie("id");
    window.location.href = "/";
}

function setCookie(cname, cvalue, exdays) {
    const d = new Date();
    d.setTime(d.getTime() + (exdays * 24 * 60 * 60 * 1000));
    let expires = "expires=" + d.toUTCString();
    document.cookie = cname + "=" + cvalue + ";" + expires + ";path=/";
}

function getCookie(cname) {
    let name = cname + "=";
    let decodedCookie = decodeURIComponent(document.cookie);
    let ca = decodedCookie.split(';');
    for (let i = 0; i < ca.length; i++) {
        let c = ca[i];
        while (c.charAt(0) == ' ') {
            c = c.substring(1);
        }
        if (c.indexOf(name) == 0) {
            return c.substring(name.length, c.length);
        }
    }
    return "";
}

function deleteCookie(name) {
    document.cookie = name + "=; expires=Thu, 01 Jan 1970 00:00:00 UTC; path=/;";
}

function swal2(stitle = '', stext = '', sicon = '', confirmButtonText = '', confirmButtonTF = false, ok_function = () => { }, allowousideclick = false) {
    Swal.fire({
        title: stitle,
        html: stext,
        icon: sicon,
        confirmButtonText: confirmButtonText,
        showConfirmButton: confirmButtonTF,
        allowOutsideClick: allowousideclick,
    }).then((result) => {
        if (result.isConfirmed) {
            ok_function();
        }
    });
}