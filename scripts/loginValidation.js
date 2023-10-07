//Perform client-side input validation

function validatePassword() {
  var pass = document.getElementById("password").value;
  if( pass.length > 7 ) {
    return true;
  }
  alert("Your password must be at least 8 characters long!");
  return false;
}
