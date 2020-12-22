var response = document.getElementById("response");
const form = document.getElementById("form");
form.addEventListener("submit", function (e) {
    e.preventDefault();
    const xhr = new XMLHttpRequest();
    const formData = new FormData(form);
    xhr.open("post", "/include/deleteFile.php", true);
    xhr.send(formData);
    console.log(formData);
    xhr.onload = function () {
        response.innerHTML = this.responseText;
    }
    document.querySelectorAll('input[type=checkbox]:checked').forEach(func);
    function func(item) {
        item.parentNode.parentNode.remove();
    }
});