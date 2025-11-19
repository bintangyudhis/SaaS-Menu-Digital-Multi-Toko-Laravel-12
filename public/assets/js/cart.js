document.addEventListener("DOMContentLoaded", function () {
    // Ambil data cart dari localStorage
    const cartData = JSON.parse(localStorage.getItem("cart")) || [];

    // Filter produk berdasarkan ID di cartData
    const cartItems = document.querySelectorAll(".cart-item");
    cartItems.forEach((item) => {
        const productId = item.dataset.id;

        // Cari produk di cartData
        const cartProduct = cartData.find((cart) => cart.id === productId);

        if (!cartProduct) {
            // Jika produk tidak ada di cart, hapus
            item.remove();
        } else {
            // Jika ada, update quantity dan notes
            const qtyElement = item.querySelector("#qty");
            const notesInput = item.querySelector("#notes");

            if (qtyElement) qtyElement.textContent = cartProduct.qty;
            if (notesInput) notesInput.value = cartProduct.notes;
        }
    });

    // Hitung total setelah elemen yang tidak ada dihapus
    calculateTotal();
});

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

