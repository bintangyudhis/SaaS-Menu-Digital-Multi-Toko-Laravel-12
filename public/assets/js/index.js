let cartCountElement = document.querySelector("#cart-count");

const swiper = new Swiper('.swiper', {
    slidesPerView: "auto",
    spaceBetween: 20,
});

const addToCart = (id) => {
    event.preventDefault();

    const cart = JSON.parse(localStorage.getItem("cart")) || [];
    const itemIndex = cart.findIndex(item => item.id === id);
    if (itemIndex > -1) {
        cart[itemIndex].qty += 1;
    } else {
        cart.push({ id, qty: 1, notes: "" });
    }
    localStorage.setItem("cart", JSON.stringify(cart));
    updateDisplay();
    updateCartItems();
}

const removeFromCart = (id) => {
    const cart = JSON.parse(localStorage.getItem("cart")) || [];
    const newCart = cart.filter(item => item.id !== id);
    localStorage.setItem("cart", JSON.stringify(newCart));
    updateDisplay();
    updateCartItems();
}

function increaseQuantity(id) {
    const cart = JSON.parse(localStorage.getItem("cart")) || [];
    const itemIndex = cart.findIndex(item => item.id === id);
    if (itemIndex > -1) {
        cart[itemIndex].qty += 1;
    }
    localStorage.setItem("cart", JSON.stringify(cart));

    const qtyElement = document.querySelector(`[data-id="${id}"]#qty`);
    if (qtyElement) {
        let qty = parseInt(qtyElement.textContent, 10);
        qtyElement.textContent = qty + 1;
    }

    calculateTotal();
}

function decreaseQuantity(id) {
    const cart = JSON.parse(localStorage.getItem("cart")) || [];
    const itemIndex = cart.findIndex(item => item.id === id);
    if (itemIndex > -1) {
        if (cart[itemIndex].qty > 1) {
            cart[itemIndex].qty -= 1;
        } else {
            cart.splice(itemIndex, 1);
        }
    }
    localStorage.setItem("cart", JSON.stringify(cart));

    const qtyElement = document.querySelector(`[data-id="${id}"]#qty`);
    if (qtyElement) {
        let qty = parseInt(qtyElement.textContent, 10);
        if (qty > 1) {
            qtyElement.textContent = qty - 1;
        } else {
            qtyElement.closest('.flex.gap-4.flex-col').remove();
        }
    }

    calculateTotal();
}
function deleteItem(element) {
    const cartItem = element.closest('.cart-item');
    if (cartItem) {
        const id = cartItem.dataset.id;
        const cart = JSON.parse(localStorage.getItem("cart")) || [];
        const itemIndex = cart.findIndex(item => item.id === id);
        if (itemIndex > -1) {
            cart.splice(itemIndex, 1);
        }
        localStorage.setItem("cart", JSON.stringify(cart));
        cartItem.remove();
    }

    calculateTotal();
}

function calculateTotal() {
    const prices = document.querySelectorAll('p[id="price"]');
    let total = 0;
    prices.forEach(priceElement => {
        const price = parseInt(priceElement.textContent.replace(/[^0-9]/g, ''), 10);
        const qty = parseInt(priceElement.closest('.flex').querySelector('#qty').textContent, 10);
        total += price * qty;
    });
    document.getElementById('totalAmount').textContent = `Rp ${total.toLocaleString('id-ID')}`;
}

const getCart = () => {
    const cart = JSON.parse(localStorage.getItem("cart")) || [];
    return cart;
}

const updateDisplay = () => {
    const cart = getCart();
    if (cartCountElement) {
        cartCountElement.textContent = cart.reduce((total, item) => total + item.qty, 0);
    }
}

const updateCartItems = () => {
    const cart = getCart();

    cart.forEach(item => {
        const qtyElement = document.querySelector(`[data-id="${item.id}"]#qty`);
        const notesElement = document.querySelector(`[data-id="${item.id}"]#notes`);
        if (qtyElement) {
            qtyElement.textContent = item.qty;
        }
        if (notesElement) {
            notesElement.value = item.notes;
        }
    });

    calculateTotal();
}

document.addEventListener('DOMContentLoaded', () => {
    updateDisplay();
    updateCartItems();
});

document.querySelectorAll('input[name="notes"]').forEach(element => {
    element.addEventListener('input', event => {
        const cart = getCart();
        const itemIndex = cart.findIndex(item => item.id === event.target.closest('[data-id]').dataset.id);
        if (itemIndex > -1) {
            cart[itemIndex].notes = event.target.value;
            localStorage.setItem("cart", JSON.stringify(cart));
        }
    });
});

