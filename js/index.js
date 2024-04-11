function system_validation() {

    var email = document.form.Email.value;

    if (document.form.Firstname.value == "") {
        document.getElementById("result").innerHTML = "Enter your First name*";
        return false
    }

    else if (document.form.Firstname.value.length < 3) {
        document.getElementById("result").innerHTML = "first name should be more than three letters*";
        return false;
    }

    if (document.form.lastname.value == "") {
        document.getElementById("result").innerHTML = "Enter your last name*";
        return false
    }

    else if (document.form.lastname.value.length < 3) {
        document.getElementById("result").innerHTML = "lastname name should be more than three letters*";
        return false;
    }

    if (email == "") {
        document.getElementById("result").innerHTML = "Kindly enter your email*";
        return false;
    }

    else if (!validateEmail(email)) {
        document.getElementById("result").innerHTML = "Enter Correct email*";
        return false;
    }

    else if (document.form.Password.value == "") {
        document.getElementById("result").innerHTML = "Kindly enter your password*";
        return false;
    }



    else if (document.form.Password.value.length < 7) {
        document.getElementById("result").innerHTML = "Password is too short*";
        return false;
    }

    else if (document.form.confirmPassword.value == "") {
        document.getElementById("result").innerHTML = "Confirm your password*";
        return false;
    }

    else if (document.form.Password.value !== document.form.confirmPassword.value) {
        document.getElementById("result").innerHTML = "Passwords must match*";
        return false;
    }

    else if (document.form.Password.value.length < 7) {
        document.getElementById("result").innerHTML = "Password is too short*";
        return false;
    }



}


function login_validation() {

    var email = document.form.Email.value;

    if (email == "") {
        document.getElementById("result").innerHTML = "Kindly enter your email*";
        return false;
    }

    else if (!validateEmail(email)) {
        document.getElementById("result").innerHTML = "enter correct email*";
        return false;
    }

    else if (document.form.Password.value == "") {
        document.getElementById("result").innerHTML = "Kindly enter your password*";
        return false;
    }



    else if (document.form.Password.value.length < 7) {
        document.getElementById("result").innerHTML = "Password is too short*";
        return false;
    }


}

function validateEmail(email) {
    var pattern = /^[a-zA-Z0-9_.+-]+@[a-zA-Z0-9-]+\.[a-zA-Z0-9-.]+$/;
    return pattern.test(email);
}



var welcomeHeading = document.getElementById("welcome-heading");

welcomeHeading.addEventListener("mouseover", function () {
    welcomeHeading.style.animation = "none";
    welcomeHeading.offsetHeight;
    welcomeHeading.style.animation = null;
});

welcomeHeading.addEventListener("mouseout", function () {
    welcomeHeading.style.animation = "bounce 1s infinite alternate, drop 1s infinite";
});

