function validateRegisterForm() {
    var fullname = document.forms["register"]["fullname"].value;
    var password = document.forms["register"]["password"].value;
    var telephone = document.forms["register"]["telephone"].value;
    var email = document.forms["register"]["email"].value;
    var confirm_password = document.forms["register"]["confirm_password"].value;
    var location = document.forms["register"]["location"].value;

    //Full name validations
        var letters = /^[A-Za-z ]+$/;
        if (fullname == "") {
        alert("Please enter your fullname");
        return false;
        }

        if(!fullname.match(letters)){
            alert("The name should have alphabet characters only");
            return false;   
        }


    //Password validations
        // var uppercase = /^[A-Z]+$/;
        // var lowercase = /^[a-z]+$/;
        // var numbers    = /^[0-9]+$/;;
        if (password == "") {
        alert("Please enter your Password");
        return false;
        }

        // if(!password.match(uppercase) || !password.match(lowercase) || !password.match(numbers)){
        //     alert("The password is not strong");
        //     return false;   
        // }


    //Telephone validations
        var number = /^[0-9]+$/;
        if (telephone == "") {
            alert("Please enter your phone number");
            return false;
        }

        if(telephone.length != 10 || !telephone.match(number)){
            alert("Invalid Phone number");
            return false;
        }


    //Email validations
         var emailValid = /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/;
         if (email == "") {
             alert("Please enter your email");
             return false;
         }
 
         if(!email.match(emailValid)){
             alert("Invalid Email ID");
             return false;
         }


      //Confirm Password validations
        // var uppercase = /^[A-Z]+$/;
        // var lowercase = /^[a-z]+$/;
        // var numbers    = /^[0-9]+$/;;
       
        if (confirm_password == "") {
        alert("Please enter your Confirm password");
        return false;
        }

        // if(!confirm_password.match(uppercase) || !confirm_password.match(lowercase) || !confirm_password.match(numbers)){
        //     alert("The password is not strong");
        //     return false;   
        // }


        //Location validations
            if (location == "") {
                alert("Selct your location from the list");
                return false;
            }

}