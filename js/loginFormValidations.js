function validateLoginForm() {
    var email = document.forms["login"]["email_login"].value;
    var password = document.forms["login"]["password_login"].value;

    //Email validations
    var emailValid = /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/;
    if (email == "") {
        alert("Please enter your phone number");
        return false;
    }

    if(!email.match(emailValid)){
        alert("Invalid Email ID");
        return false;
    }


    //Password validations
    // var uppercase = /^[A-Z]+$/;
    // var lowercase = /^[a-z]+$/;
    // var number    = /^[0-9]+$/;;
   
    if (password == "") {
    alert("Please enter your Password");
    return false;
    }

    // if(!password.match(uppercase) || !password.match(lowercase) || !password.match(number)){
    //     alert("The password is not strong");
    //     return false;   
    // }

  }