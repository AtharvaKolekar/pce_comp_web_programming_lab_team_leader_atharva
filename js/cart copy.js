const localStorageData = localStorage.getItem('cartItems');
const products = JSON.parse(localStorageData);

var grandTotal = 0;
// Function to get unique farmer names
function getUniqueFarmers(products) {
    const uniqueFarmers = [];
    products.forEach(product => {
        if (!uniqueFarmers.includes(product.farmerName)) {
            uniqueFarmers.push(product.farmerName);
        }
    });
    return uniqueFarmers;
}

// Function to generate HTML for each farmer's products
// function generateFarmerList(products, farmerName) {
//     const farmerProducts = products.filter(product => product.farmerName === farmerName);
//     let farmerHTML = `<h2>${farmerName}</h2>`;

//     farmerProducts.forEach(product => {
//         farmerHTML += `<div class="item"><div class="item-img">`
//         farmerHTML += `<img src="${product.img}"alt="${product.name}"></div>`;
//         farmerHTML += `<div class="item-quantity"><select name="q">`;
//         console.log(product.quantity);
//         for (let i = 1; i <= 6; i++) {
//             if(product.quantity == i){
//             farmerHTML += `<option value="${i}" selected>${i}</option>`;
//             }
//             farmerHTML += `<option value="${i}">${i}</option>`;
//         }
//         farmerHTML += `</select></div>`;
//         farmerHTML += `<div class="item-price"><h3>₹ ${product.price}</h3></div></div>`;

//     });
//     
//     return farmerHTML;
// }

// Function to generate HTML for each farmer's products
function generateFarmerList(products, farmerName) {
    const farmerProducts = products.filter(product => product.farmerName === farmerName);
    let farmerHTML = `<h2>${farmerName}</h2>`;
    let farmerTotal = 0; // Initialize total price for this farmer

    farmerProducts.forEach(product => {
        const totalPrice = product.quantity * product.price;
        farmerTotal += totalPrice; // Update total price for this farmer

        grandTotal += totalPrice;

        farmerHTML += `<div class="item">
            <div class="item-img">
                <img src="${product.img}" alt="${product.productName}">
            </div>`;
        farmerHTML += `<div class="item-quantitye"><h3>${product.quantity}</h3></div>`
        // farmerHTML += `<div class="item-quantity"><select name="q">`;

        // for (let i = 1; i <= 6; i++) {
        //     if(product.quantity == i){
        //     farmerHTML += `<option value="${i}" selected>${i}</option>`;
        //     }
        //     farmerHTML += `<option value="${i}">${i}</option>`;
        // }
        // farmerHTML += `</select></div>`;
        farmerHTML += `<div class="item-price"><h3>₹ ${totalPrice}</h3></div>`;
        farmerHTML += `
        </div>`;
    });

    farmerHTML += `<div class="farmer-total"><h3>Total: ₹ ${farmerTotal}</h3></div>`;
    return farmerHTML;
}

// Function to generate quantity options for select element
function generateQuantityOptions(selectedQuantity) {
    let optionsHTML = '';
    for (let i = 1; i <= 6; i++) {
        const selected = (i === selectedQuantity) ? 'selected' : '';
        optionsHTML += `<option value="${i}" ${selected}>${i}</option>`;
    }
    return optionsHTML;
}

// Add event listener to quantity select elements
document.addEventListener('change', function(event) {
    if (event.target && event.target.name === 'quantity') {
        const select = event.target;
        const productId = select.getAttribute('data-pid');
        const productPrice = parseFloat(select.getAttribute('data-price'));
        const quantity = parseInt(select.value);
        const totalPrice = quantity * productPrice;
        
        // Update price for this item
        const priceElement = select.parentElement.nextElementSibling.querySelector('h3');
        priceElement.textContent = `₹ ${totalPrice}`;

        // Recalculate total price for this farmer
        let farmerTotal = 0;
        const items = select.closest('.items').querySelectorAll('.item');
        items.forEach(item => {
            const itemPrice = parseFloat(item.querySelector('.item-price h3').textContent.replace('₹ ', ''));
            farmerTotal += itemPrice;
        });

        // Update total price for this farmer
        const farmerTotalElement = select.closest('.items').querySelector('.farmer-total h3');
        farmerTotalElement.textContent = `Total: ₹ ${farmerTotal}`;
    }
});


// Get unique farmer names
const uniqueFarmers = getUniqueFarmers(products);

// Generate HTML for each farmer
const farmersHTML = uniqueFarmers.map(farmerName => generateFarmerList(products, farmerName)).join('');

// Append HTML to a container
const container = document.getElementById('cart');
container.innerHTML = farmersHTML;