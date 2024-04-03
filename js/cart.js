const localStorageData = localStorage.getItem('cartItems');
var products = [];
if (localStorageData !== null) {
    products = JSON.parse(localStorageData);
}



var grandTotal = 0;
var flag = 0;
var index = 0;
var checkoutHTML = "";

// Function to get unique farmer names
function getUniqueFarmers(products) {
    var uniqueFarmers = [];
    if(products.length != 0){
    document.getElementById("payment-wrap").style.display = "block";
    products.forEach(product => {
        if (!uniqueFarmers.includes(product.farmerName)) {
            uniqueFarmers.push(product.farmerName);
        }
    });
    
    }
    return uniqueFarmers;
}


function generateFarmerList(products, farmerName) {
    const farmerProducts = products.filter(product => product.farmerName === farmerName);
let farmerHTML = `
    <div class="cart-header">
    <h2>${farmerName}</h2>
    <h3>${farmerProducts.length} Items</h3>
</div>
    `;
    let farmerTotal = 0;

    farmerProducts.forEach(product => {
        const totalPrice = product.quantity * product.price;
        checkoutHTML += ` <input type='hidden' name='products[${index}][productID]' value='${product.pid}'><input type='hidden' name='products[${index}][quantity]' value='${product.quantity}'>`;
        farmerTotal += totalPrice; 
        index += 1;
        grandTotal += totalPrice;

        farmerHTML += `<div class="item" onclick="window.open('product.php?pid=` + product.pid+ `', '_blank');">
            <div class="item-img">
                <img src="${product.img}" alt="${product.productName}">
            </div>`;
        
        farmerHTML += `<div class="item-price"><h3>${product.productName}</h3></div><div class="item-quantitye"><h3>${product.quantity}</h3></div>`
        farmerHTML += `<div class="item-price"><h3>₹ ${product.price}</h3></div>`;
        farmerHTML += `<div class="item-price"><h3>₹ ${totalPrice}</h3></div>`;
        farmerHTML += `
        </div>`;
    });


    farmerHTML += `<div class="farmer-total"><h3>SubTotal: ₹ ${farmerTotal}</h3>`;
    if(farmerTotal<500){
        flag = 1;
        farmerHTML += `<div class="alert-message"><p>*Minimum order value is ₹500 required</p></div>`;
    }

    farmerHTML += `</div>`;
    return farmerHTML;
}

const uniqueFarmers = getUniqueFarmers(products);
const farmersHTML = uniqueFarmers.map(farmerName => generateFarmerList(products, farmerName)).join('');
const container = document.getElementById('cart');
container.innerHTML = farmersHTML;
if(products.length == 0){
    container.innerHTML = `<h4 style="text-align:center; margin:150px auto;">Your cart is empty.</h4>`;
}



document.getElementById("total").innerHTML = "₹" + grandTotal.toFixed(2);
document.getElementById("tax").innerHTML = "₹" + (grandTotal * 0.1).toFixed(2);
document.getElementById("grand-total").innerHTML = "₹" + (grandTotal + 60 + grandTotal * 0.1).toFixed(2);

checkoutHTML += `<button type="submit" id="checkoutBtn">Checkout</button>`;
document.getElementById("checkoutForm").innerHTML = checkoutHTML;


if(flag == 1 || grandTotal<500){
    document.getElementById("checkoutBtn").disabled = true;
    document.getElementById("checkoutBtn").style.backgroundColor = "gray";
    document.getElementById("checkoutBtn").style.cursor = "not-allowed";
}