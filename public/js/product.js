document.addEventListener('DOMContentLoaded', function () {
    const searchBtn = document.getElementById('search-btn');

    if (searchBtn) {
        searchBtn.addEventListener('click', function () {
            const productName = document.getElementById('product_name').value;
            const minPrice = document.getElementById('min_price').value;
            const maxPrice = document.getElementById('max_price').value;

            const params = new URLSearchParams();
            if (productName) params.append('product_name', productName);
            if (minPrice) params.append('min_price', minPrice);
            if (maxPrice) params.append('max_price', maxPrice);

            fetch('/products/search?' + params.toString())
                .then(response => response.json())
                .then(products => {
                    renderProducts(products);
                });
        });
    }

    function renderProducts(products) {
        const productList = document.getElementById('product-list');
        productList.innerHTML = '';

        products.forEach(function (product) {
            const imgTag = product.img_path
                ? `<img src="/storage/${product.img_path}" class="card-img-top" alt="${product.product_name}">`
                : '';

            const html = `
                <div class="col-md-4 mb-4">
                    <div class="card">
                        ${imgTag}
                        <div class="card-body">
                            <h5 class="card-title">${product.product_name}</h5>
                            <p class="card-text">${product.description}</p>
                            <p class="card-text">¥${Number(product.price).toLocaleString()}</p>
                            <a href="/products/${product.id}" class="btn btn-outline-primary">詳細</a>
                        </div>
                    </div>
                </div>
            `;
            productList.insertAdjacentHTML('beforeend', html);
        });
    }
});