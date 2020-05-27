function validateCreateEventForm() {
  var name = document.forms["createEventForm"]["name"].value;
  var location = document.forms["createEventForm"]["location"].value;
  var date = document.forms["createEventForm"]["date"].value;
  var manager = document.forms["createEventForm"]["manager"].value;

  // name validations

  if (name == "") {
    alert("Please enter the name");
    return false;
  }

  //location validations

  if (date == "") {
    alert("Please enter the location");
    return false;
  }

  //date validations

  if (date == "") {
    alert("Please enter the date");
    return false;
  }

  //manager validations

  if (manager == "") {
    alert("Select the manager from the list");
    return false;
  }
}
