function validateProfileForm() {
    var fullname = document.forms["profile"]["fullname"].value;
    var phone = document.forms["profile"]["phone"].value;
    var address = document.forms["profile"]["address"].value;
    var city = document.forms["profile"]["city"].value;
    var country = document.forms["profile"]["country"].value;
    var zipcode = document.forms["profile"]["zipcode"].value;
    var about = document.forms["profile"]["about"].value;

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

    //Phone validations
    var number = /^[0-9]+$/;
    if (phone == "") {
        alert("Please enter your phone number");
        return false;
      }

      if(phone.length != 10 || !phone.match(number)){
          alert("Invalid Phone number");
          return false;
      }

        //Address validations
      if (address == "") {
        alert("Please enter your address");
        return false;
      }

      //City validations
      
      if (city == "") {
        alert("Please enter your city");
        return false;
      }

      if(!city.match(letters)){
        alert("The city must have alphabet characters only");
        return false;
    }

        //Country validations
      if (country == "") {
        alert("Please enter your country");
        return false;
      }

      if(!country.match(letters)){
        alert("The country must have alphabet characters only");
        return false;
    }

        //Zipcode validations
        var zipNumber = /^[0-9]+$/;
        if(zipcode == "" || !zipcode.match(zipNumber)){
            alert("The zipcode is invalid");
            return false;
        }
        
      //About validations
      if (about == "") {
        alert("Please write about yourself");
        return false;
      }
  }