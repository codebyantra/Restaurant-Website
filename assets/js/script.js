// =======================
// CART DATA
// =======================
let cart = JSON.parse(localStorage.getItem("cart")) || [];


// =======================
// ADD TO CART
// =======================
function addToCart(id, title, price, btn) {

    let item = cart.find(p => p.id === id);

    if (item) {
        item.qty++;
    } else {
        cart.push({
            id,
            title,
            price,
            qty: 1
        });
    }

    localStorage.setItem("cart", JSON.stringify(cart));

    updateButtonUI(id, btn);
    loadCart();
}


// =======================
// BUTTON UI CHANGE
// =======================
function updateButtonUI(id, btn) {

    let item = cart.find(p => p.id === id);

    if (!item) return;

    btn.outerHTML = `
        <div class="qty-box">
            <button onclick="decreaseFromCard(${id}, this)">−</button>
            <span>${item.qty}</span>
            <button onclick="increaseFromCard(${id}, this)">+</button>
        </div>
    `;
}


// =======================
// INCREASE-decrease FROM CARD
// =======================
function increaseFromCard(id, el) {
    let item = cart.find(i => i.id === id);
    item.qty++;

    el.previousElementSibling.innerText = item.qty;
    localStorage.setItem("cart", JSON.stringify(cart));
    loadCart();
}

function decreaseFromCard(id, el) {
    let item = cart.find(i => i.id === id);

    if (item.qty > 1) {
        item.qty--;
        el.nextElementSibling.innerText = item.qty;
    } else {
        cart = cart.filter(i => i.id !== id);

        el.parentElement.outerHTML = `
            <button onclick="addToCart(${id}, '${item.title}', ${item.price}, this)">
                Add to Cart
            </button>
        `;
    }

    localStorage.setItem("cart", JSON.stringify(cart));
    loadCart();
}


// =======================
// LOAD CART PAGE
// =======================
function loadCart() {

    let tbody = document.getElementById("cart-items");
    let totalBox = document.getElementById("cart-total");

    // 🔥 ADDED
    let finalTotalBox = document.getElementById("final-total");
    const DELIVERY = 30;
    const TAX = 20;

    if (!tbody) return;

    tbody.innerHTML = "";
    let total = 0;

    if (cart.length === 0) {
        tbody.innerHTML = `<tr><td colspan="6" class="text-center">Cart is empty</td></tr>`;
        totalBox.innerText = 0;

        // 🔥 ADDED
        finalTotalBox.innerText = 0;
        return;
    }

    cart.forEach((item, i) => {
        let itemTotal = item.price * item.qty;
        total += itemTotal;

        tbody.innerHTML += `
            <tr>
                <td>${i + 1}</td>
                <td>${item.title}</td>
                <td>₹${item.price}</td>
                <td>
                    <button onclick="changeQty(${item.id}, -1)">−</button>
                    ${item.qty}
                    <button onclick="changeQty(${item.id}, 1)">+</button>
                </td>
                <td>₹${itemTotal}</td>
                <td>
                    <button onclick="removeItem(${item.id})">❌</button>
                </td>
            </tr>
        `;
    });

    totalBox.innerText = total;

    // 🔥 ADDED — GRAND TOTAL CALCULATION
    let grandTotal = total + DELIVERY + TAX;
    finalTotalBox.innerText = grandTotal;
}


// =======================
// CART PAGE QTY CHANGE
// =======================
function changeQty(id, value) {
    let item = cart.find(p => p.id === id);
    item.qty += value;

    if (item.qty <= 0) {
        cart = cart.filter(p => p.id !== id);
    }

    localStorage.setItem("cart", JSON.stringify(cart));
    loadCart();
}


// =======================
// REMOVE
// =======================
function removeItem(id) {
    cart = cart.filter(p => p.id !== id);
    localStorage.setItem("cart", JSON.stringify(cart));
    loadCart();
}

window.onload = loadCart;
