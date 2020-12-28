const form = document.getElementById("form");
const photo = document.getElementById("photo");
var response = document.getElementById("response");
form.addEventListener("submit", function (e) {
    e.preventDefault();

    const xhr = new XMLHttpRequest();
    const formData = new FormData(form);

    xhr.open("post", "/include/upload.php", true);
    xhr.onload = function () {
        response.innerHTML = this.responseText;
    }
    xhr.send(formData);
    form.reset();
});