function toggleQuantityMenu(button) {
    const dropdown = button.nextElementSibling;
    const allDropdowns = document.querySelectorAll('.quantity-dropdown-container > div');

    // Close other dropdowns
    allDropdowns.forEach(d => {
        if (d !== dropdown) {
            d.classList.add('hidden');
        }
    });

    dropdown.classList.toggle('hidden');
}

function selectQuantity(element, quantity) {
    const container = element.closest('.quantity-dropdown-container');
    const displaySpan = container.querySelector('.qty-display');
    const dropdown = container.querySelector('div'); // The dropdown menu div

    // Update UI
    displaySpan.textContent = `Qty: ${quantity}`;
    dropdown.classList.add('hidden');

    // Find the hidden input and form to submit
    const form = container.closest('form');
    if (form) {
        const input = form.querySelector('input[name="quantity"]');
        if (input) {
            input.value = quantity;
            form.submit(); // Submit form to update cart
        }
    }
}

// Close dropdowns when clicking outside
document.addEventListener('click', function (event) {
    if (!event.target.closest('.quantity-dropdown-container')) {
        document.querySelectorAll('.quantity-dropdown-container > div').forEach(d => {
            d.classList.add('hidden');
        });
    }
});

// Mobile Menu Logic
document.addEventListener('DOMContentLoaded', function () {
    const mobileMenuBtn = document.getElementById('mobile-menu-btn');
    const closeMenuBtn = document.getElementById('close-menu-btn');
    const mobileMenuOverlay = document.getElementById('mobile-menu-overlay');
    const mobileMenuSidebar = document.getElementById('mobile-menu-sidebar');

    function openMenu() {
        if (!mobileMenuOverlay || !mobileMenuSidebar) return;
        mobileMenuOverlay.classList.remove('hidden');
        // Small delay to allow display:block to apply before opacity transition
        setTimeout(() => {
            mobileMenuOverlay.classList.remove('opacity-0');
            mobileMenuSidebar.classList.remove('-translate-x-full');
        }, 10);
    }

    function closeMenu() {
        if (!mobileMenuOverlay || !mobileMenuSidebar) return;
        mobileMenuOverlay.classList.add('opacity-0');
        mobileMenuSidebar.classList.add('-translate-x-full');
        setTimeout(() => {
            mobileMenuOverlay.classList.add('hidden');
        }, 300);
    }

    if (mobileMenuBtn) mobileMenuBtn.addEventListener('click', openMenu);
    if (closeMenuBtn) closeMenuBtn.addEventListener('click', closeMenu);
    if (mobileMenuOverlay) mobileMenuOverlay.addEventListener('click', closeMenu);
});

function toggleMobileDropdown(id, button) {
    const content = document.getElementById(id);
    const icon = button.querySelector('i');

    // Check if content exists before trying to toggle class
    if (!content) return;

    if (content.classList.contains('hidden')) {
        content.classList.remove('hidden');
        if (icon) icon.style.transform = 'rotate(180deg)';
    } else {
        content.classList.add('hidden');
        if (icon) icon.style.transform = 'rotate(0deg)';
    }
}
