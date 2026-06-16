document.addEventListener('DOMContentLoaded', function () {
    const openModalBtn = document.getElementById('open-confirm-modal');
    const confirmBtn = document.getElementById('confirm-purchase-btn');

    if (openModalBtn) {
        openModalBtn.addEventListener('click', function () {
            const modal = new bootstrap.Modal(document.getElementById('confirm-modal'));
            modal.show();
        });
    }

    if (confirmBtn) {
        confirmBtn.addEventListener('click', function () {
            document.getElementById('purchase-form').submit();
        });
    }
});