// cart.js
document.addEventListener('DOMContentLoaded', () => {
    const cartKey = 'jewelry_cart';
    let cart = JSON.parse(localStorage.getItem(cartKey)) || [];

    // Add to cart functionality
    const addToCartButtons = document.querySelectorAll('.add-to-cart');
    
    addToCartButtons.forEach(button => {
        button.addEventListener('click', (e) => {
            e.preventDefault(); // In case it's an anchor tag
            
            // Add a little feedback animation to the button
            const originalText = button.textContent;
            button.textContent = 'Adding...';
            button.style.backgroundColor = 'var(--color-accent)';
            button.style.color = '#fff';
            button.style.borderColor = 'var(--color-accent)';
            
            setTimeout(() => {
                button.textContent = 'Added';
                setTimeout(() => {
                    button.textContent = originalText;
                    button.style.backgroundColor = '';
                    button.style.color = '';
                    button.style.borderColor = '';
                }, 1500);
            }, 500);

            const product = e.target.closest('.product');
            const name = product.querySelector('h3').textContent;
            const priceText = product.querySelector('p').textContent;
            const price = parseFloat(priceText.replace('Rs', '').replace('/-', '').trim());
            const imgSrc = product.querySelector('img').src;

            const existingItem = cart.find(item => item.name === name);
            if (existingItem) {
                existingItem.quantity += 1;
            } else {
                cart.push({ name, price, imgSrc, quantity: 1 });
            }

            localStorage.setItem(cartKey, JSON.stringify(cart));
        });
    });

    // Render cart items if on cart page
    const cartContainer = document.getElementById('cart-items-container');
    const cartTotalElement = document.getElementById('cart-total');
    
    if (cartContainer) {
        renderCart();
    }

    function renderCart() {
        cartContainer.innerHTML = '';
        if (cart.length === 0) {
            cartContainer.innerHTML = '<p class="empty-cart-msg">Your cart is currently empty. Start adding items from our <a href="shop.html">shop</a>!</p>';
            if(cartTotalElement) cartTotalElement.style.display = 'none';
            return;
        }

        if(cartTotalElement) cartTotalElement.style.display = 'block';
        let total = 0;

        const table = document.createElement('table');
        table.className = 'cart-table';
        table.innerHTML = `
            <thead>
                <tr>
                    <th>Product</th>
                    <th>Price</th>
                    <th>Quantity</th>
                    <th>Subtotal</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody></tbody>
        `;
        const tbody = table.querySelector('tbody');

        cart.forEach((item, index) => {
            const subtotal = item.price * item.quantity;
            total += subtotal;

            const tr = document.createElement('tr');
            tr.innerHTML = `
                <td class="cart-product-info">
                    <img src="${item.imgSrc}" alt="${item.name}">
                    <span>${item.name}</span>
                </td>
                <td class="cart-price">Rs ${item.price.toFixed(2)}</td>
                <td class="cart-quantity">
                    <input type="number" min="1" value="${item.quantity}" data-index="${index}" class="cart-quantity-input">
                </td>
                <td class="cart-subtotal">Rs ${subtotal.toFixed(2)}</td>
                <td class="cart-action"><button class="remove-btn" data-index="${index}">&times;</button></td>
            `;
            tbody.appendChild(tr);
        });

        cartContainer.appendChild(table);

        document.getElementById('cart-total-amount').textContent = `Rs ${total.toFixed(2)}`;

        // Attach event listeners to quantity inputs and remove buttons
        document.querySelectorAll('.cart-quantity-input').forEach(input => {
            input.addEventListener('change', (e) => {
                const index = e.target.getAttribute('data-index');
                const newQuantity = parseInt(e.target.value);
                if(newQuantity > 0) {
                    cart[index].quantity = newQuantity;
                    localStorage.setItem(cartKey, JSON.stringify(cart));
                    renderCart();
                }
            });
        });

        document.querySelectorAll('.remove-btn').forEach(button => {
            button.addEventListener('click', (e) => {
                const index = e.target.getAttribute('data-index');
                cart.splice(index, 1);
                localStorage.setItem(cartKey, JSON.stringify(cart));
                renderCart();
            });
        });
    }
});
