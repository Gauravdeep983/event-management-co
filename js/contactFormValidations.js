function validateContactForm() {
    var name = document.forms["contactForm"]["name"].value;
    var email = document.forms["contactForm"]["email"].value;
    var issue = document.forms["contactForm"]["issue"].value;
    var issueDetail = document.forms["contactForm"]["issue_detail"].value;


    // name validations
        var letters = /^[A-Za-z ]+$/;
        if (name == "") {
        alert("Please enter your fullname");
        return false;
        }

        if(!name.match(letters)){
            alert("The name should have alphabet characters only");
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


}