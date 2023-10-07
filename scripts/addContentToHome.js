var Date = new Date();
var Hour = Date.getHours();

if (Hour > 18) {
document.write('Good evening, ');
} else if(Hour > 12){
document.write('Good afternoon, ');
} else if(Hour > 0){
document.write('Good morning, ');
}else{
document.write('Hello, ');
}
