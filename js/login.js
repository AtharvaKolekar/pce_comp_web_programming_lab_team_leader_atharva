fetch("https://ipapi.co/json/")
.then(function (response) {
  return response.json();
})
.then(function (data) {
  // Display the user's proxy location
document.getElementById("city").value = data.city;
document.getElementById("lat").value = data.latitude;
document.getElementById("lon").value = data.longitude;

})

document.getElementById("loginBtn").addEventListener('click', function(e) {
    e.preventDefault();

    if(document.getElementById("Mnumber").value.length !== 10){
        customAlert("Enter a valid mobile number!!");
        return;
    }

    if(document.getElementById("pin").value.length !== 6){
        customAlert("Enter a valid 6-digit pin!!");
        return;
    }

     document.getElementById("loginForm").submit();
});