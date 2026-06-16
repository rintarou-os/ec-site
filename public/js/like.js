document.addEventListener('DOMContentLoaded', function () {
    const likeBtn = document.getElementById('like-btn');

    if (likeBtn) {
        likeBtn.addEventListener('click', function () {
            const productId = likeBtn.dataset.productId;
            const token = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

            fetch('/likes/' + productId, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': token,
                },
            })
                .then(response => response.json())
                .then(data => {
                    if (data.liked) {
                        likeBtn.classList.remove('btn-outline-secondary');
                        likeBtn.classList.add('btn-danger');
                    } else {
                        likeBtn.classList.remove('btn-danger');
                        likeBtn.classList.add('btn-outline-secondary');
                    }
                });
        });
    }
});