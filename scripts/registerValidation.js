function validate() {
  var name = document.getElementById("name").value;
  let res = /^[a-zA-Z]+$/.test(name);
  if(!res){
    alert("Sorry, your name should only contain letters!")
    return false;
  }
  if(name.length < 3){
    alert("Sorry, your name must have at least 3 characters!")
    return false;
  }
  var pass = document.getElementById("password").value;
  if( pass.length > 7 ) {
    return true;
  }
  alert("Your password must be at least 8 characters long!");
  return false;
}
