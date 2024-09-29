// TODO localStorage -> cookie

function setCookie(cname, cvalue, exdays) {
    var d = new Date();
    d.setTime(d.getTime() + (exdays * 24 * 60 * 60 * 1000));
    var expires = "expires=" + d.toUTCString();
    document.cookie = cname + "=" + cvalue + ";" + expires + ";path=/";
}

function getCookie(cname) {
    var name = cname + "=";
    var ca = document.cookie.split(';');
    for (var i = 0; i < ca.length; i++) {
        var c = ca[i];
        while (c.charAt(0) == ' ') {
            c = c.substring(1);
        }
        if (c.indexOf(name) == 0) {
            return c.substring(name.length, c.length);
        }
    }
    return "";
}

const body = document.querySelector('body'),
    sidebar = body.querySelector('.sidebar'),
    text = sidebar.querySelector('.text'),
    toggleLeft = body.querySelector('.toggle-left'),
    toggleRight = body.querySelector('.toggle-right'),
    menuBar = body.querySelector('.menu-bar');

if (typeof (Storage) !== "undefined") {
    if (getCookie("sidebar") === "closed") {
        sidebar.classList.toggle('close');
        menuBar.classList.toggle('close');
        toggleLeft.classList.toggle('close');
        toggleRight.classList.toggle('close');
    }
}

toggleLeft.addEventListener('click', () => {
    setCookie("sidebar", "closed", 30);
    sidebar.classList.toggle('close');
    menuBar.classList.toggle('close');
    setTimeout(function () {
        toggleLeft.classList.toggle('close');
        toggleRight.classList.toggle('close');
    }, 300);
});

toggleRight.addEventListener('click', () => {
    setCookie("sidebar", "opened", 30);
    sidebar.classList.toggle('close');
    menuBar.classList.toggle('close');
    setTimeout(function () {
        toggleRight.classList.toggle('close');
        toggleLeft.classList.toggle('close');
    }, 300);
});
