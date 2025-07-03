const apiurl = 'http://localhost:83/market-api.php?action=';
const photourl = 'http://localhost:82/';

function logout() {
    deleteCookie("keyA");
    deleteCookie("keyB");
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