let items = document.querySelectorAll('.tabs li ');
items.forEach((item) => {
    item.addEventListener('click', function (e) {
        e.preventDefault();


        document.querySelector('.tabs li.selected').classList.remove('selected');
        this.classList.add('selected');

        let dataBox = this.getAttribute('data-content')

        document.querySelector('.tabContent div.selected').classList.remove('selected')
        document.querySelector(`.tabContent div[data-content="${dataBox}"]`).classList.add('selected')
    })
})
// single  contractor Page tabnavigatiion

// upload file

document.querySelector("html").classList.add('js');

var fileInput = document.querySelector(".input-file"),
    button = document.querySelector(".input-file-trigger"),
    the_return = document.querySelector(".file-return");

button.addEventListener("keydown", function (event) {
    if (event.keyCode == 13 || event.keyCode == 32) {
        fileInput.focus();
    }
});
button.addEventListener("click", function (event) {
    fileInput.focus();
    return false;
});
fileInput.addEventListener("change", function (event) {
    the_return.innerHTML = this.value;
});



document.querySelector("html").classList.add('js');

var fileInputt = document.querySelector(".input-filet"),
    buttont = document.querySelector(".input-file-triggert"),
    the_returnt = document.querySelector(".file-returnt");

buttont.addEventListener("keydown", function (event) {
    if (event.keyCode == 13 || event.keyCode == 32) {
        fileInputt.focus();
    }
});
buttont.addEventListener("click", function (event) {
    fileInputt.focus();
    return false;
});
fileInputt.addEventListener("change", function (event) {
    the_returnt.innerHTML = this.value;
});

document.querySelector("html").classList.add('js');

var fileInputtt = document.querySelector(".input-filett"),
    buttontt = document.querySelector(".input-file-triggertt"),
    the_returntt = document.querySelector(".file-returntt");

buttontt.addEventListener("keydown", function (event) {
    if (event.keyCode == 13 || event.keyCode == 32) {
        fileInputtt.focus();
    }
});
buttontt.addEventListener("click", function (event) {
    fileInputtt.focus();
    return false;
});
fileInputtt.addEventListener("change", function (event) {
    the_returntt.innerHTML = this.value;
});

document.querySelector("html").classList.add('js');

var fileInputttt = document.querySelector(".input-filettt"),
    buttonttt = document.querySelector(".input-file-triggerttt"),
    the_returnttt = document.querySelector(".file-returnttt");

buttonttt.addEventListener("keydown", function (event) {
    if (event.keyCode == 13 || event.keyCode == 32) {
        fileInputttt.focus();
    }
});
buttonttt.addEventListener("click", function (event) {
    fileInputttt.focus();
    return false;
});
fileInputttt.addEventListener("change", function (event) {
    the_returnttt.innerHTML = this.value;
});

document.querySelector("html").classList.add('js');

var fileInputtttt = document.querySelector(".input-filetttt"),
    buttontttt = document.querySelector(".input-file-triggertttt"),
    the_returntttt = document.querySelector(".file-returntttt");

buttontttt.addEventListener("keydown", function (event) {
    if (event.keyCode == 13 || event.keyCode == 32) {
        fileInputtttt.focus();
    }
});
buttontttt.addEventListener("click", function (event) {
    fileInputtttt.focus();
    return false;
});
fileInputtttt.addEventListener("change", function (event) {
    the_returntttt.innerHTML = this.value;
});
// upload file