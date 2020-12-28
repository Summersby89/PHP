var response = document.getElementById("response");
const form = document.getElementById("form");
form.addEventListener("submit", function (e) {
    e.preventDefault();
    const xhr = new XMLHttpRequest();
    const formData = new FormData(form);
    xhr.open("post", "/deleteFile.php", true);
    console.log(formData);
    xhr.onload = function () {
        response.innerHTML = this.responseText;
        document.querySelectorAll('input[type=checkbox]:checked').forEach(function (item) {
            item.parentNode.parentNode.parentNode.remove();
        })
    }
    xhr.send(formData);
});