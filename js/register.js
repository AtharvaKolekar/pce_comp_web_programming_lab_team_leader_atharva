document.getElementById("farmer").addEventListener('change', function() {
    if(document.querySelector('input[name="user_type"]:checked').value == 'f'){
        document.getElementById("fd").innerHTML = `
        <div class="field input">
        <label for="bio">Bio</label>
        <input type="text" placeholder="Describe yourself" name="bio" id="bio">
        </div>
        <div class="field input">
            <label for="address">Address</label>
            <input type="text" placeholder="Bussiness Address" name="address" id="address">
        </div>
        <div class="field input">
            <label for="pincode">Pincode</label>
            <input type="number" placeholder="Pincode" name="pincode" id="pincode">
        </div>
        <div class="field input">
            <label for="bank_acc">Back Account Number</label>
            <input type="text" placeholder="Back Account Number" name="bank_acc" id="bank_acc">
        </div>
        <div class="field input">
            <label for="bank_ifsc">Bank IFSC Code</label>
            <input type="text" placeholder="Bank IFSC Code" name="bank_ifsc" id="bank_ifsc">
        </div>
        `
    }
    
});

document.getElementById("customer").addEventListener('change', function() {
    if(document.querySelector('input[name="user_type"]:checked').value == 'c'){
        document.getElementById("fd").innerHTML = ``
    }
});

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

document.getElementById("registerBtn").addEventListener('click', function(e) {
    e.preventDefault();

    if(document.getElementById("name").value === ""){
        customAlert("Name is required!!");
        return;
    }

    if(document.getElementById("Mnumber").value.length !== 10){
        customAlert("Enter a valid mobile number!!");
        return;
    }

    if(document.getElementById("pin").value.length !== 6){
        customAlert("Enter a valid 6-digit pin!!");
        return;
    }

    if(document.getElementById("cpin").value !== document.getElementById("pin").value){
        customAlert("Confirm pin did not match!!");
        return;
    }

    if(document.querySelector('input[name="user_type"]:checked').value == 'f'){
        if(document.getElementById("bio").value === ""){
            customAlert("Bio is required!!");
            return;
        }
        if(document.getElementById("address").value === ""){
            customAlert("Address is required!!");
            return;
        }
        if(document.getElementById("pincode").value.length !== 6){
            customAlert("Enter a valid 6-digit pin!!");
            return;
        }
        if(document.getElementById("bank_acc").value === ""){
            customAlert("Bank Account Number is required!!");
            return;
        }
        if(document.getElementById("bank_ifsc").value === ""){
            customAlert("Bank IFSC Code is required!!");
            return;
        }

    }



     document.getElementById("reg").submit();
});