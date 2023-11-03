// This is simply a test of JavaScript form validation.
function validateForm() {
    let formName = document.forms["myForm"]["name"].value;
    if (formName == "") {
        alert("Please fill name out!")
        return false;
    }
}