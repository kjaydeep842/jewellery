// Mobile Menu Functionality
document.addEventListener('DOMContentLoaded', () => {
    const mobileMenuBtn = document.getElementById('mobile-menu-btn');
    const closeMenuBtn = document.getElementById('close-menu-btn');
    const mobileMenuSidebar = document.getElementById('mobile-menu-sidebar');
    const mobileMenuOverlay = document.getElementById('mobile-menu-overlay');

    function openMenu() {
        mobileMenuSidebar.classList.remove('-translate-x-full');
        mobileMenuOverlay.classList.remove('hidden');
        setTimeout(() => {
            mobileMenuOverlay.classList.remove('opacity-0');
        }, 10);
        document.body.style.overflow = 'hidden';
    }

    function closeMenu() {
        mobileMenuSidebar.classList.add('-translate-x-full');
        mobileMenuOverlay.classList.add('opacity-0');
        setTimeout(() => {
            mobileMenuOverlay.classList.add('hidden');
        }, 300);
        document.body.style.overflow = '';
    }

    if (mobileMenuBtn) mobileMenuBtn.addEventListener('click', openMenu);
    if (closeMenuBtn) closeMenuBtn.addEventListener('click', closeMenu);
    if (mobileMenuOverlay) mobileMenuOverlay.addEventListener('click', closeMenu);


    // Search Dropdown Functionality
    const searchInput = document.getElementById('search-input');
    const searchDropdown = document.getElementById('search-dropdown');
    const searchClearBtn = document.getElementById('search-clear-btn');
    const searchContainer = document.getElementById('search-container');

    if (searchInput && searchDropdown && searchContainer) {

        // Show dropdown on page load
        // searchDropdown.classList.remove('hidden');

        // Show dropdown on focus
        searchInput.addEventListener('focus', () => {
            searchDropdown.classList.remove('hidden');
        });

        // Hide dropdown when clicking outside
        document.addEventListener('click', (e) => {
            if (!searchContainer.contains(e.target)) {
                searchDropdown.classList.add('hidden');
            }
        });

        const searchDefaultView = document.getElementById('search-default-view');
        const searchSuggestionsView = document.getElementById('search-suggestions-view');
        const suggestionsList = document.getElementById('suggestions-list');
        const searchQueryText = document.getElementById('search-query-text');
        const searchForBtn = document.getElementById('search-for-btn');

        // Handle typing to show/hide clear button and fetch suggestions
        searchInput.addEventListener('input', () => {
            const query = searchInput.value.trim();

            if (searchInput.value.length > 0) {
                searchClearBtn.classList.remove('hidden');

                if (query.length > 0) {
                    searchDefaultView.classList.add('hidden');
                    searchSuggestionsView.classList.remove('hidden');
                    searchQueryText.textContent = query;

                    // Fetch suggestions
                    fetch(`/ajax/search-suggestions?query=${encodeURIComponent(query)}`)
                        .then(response => response.json())
                        .then(data => {
                            suggestionsList.innerHTML = '';
                            if (data.length > 0) {
                                data.forEach(item => {
                                    const btn = document.createElement('button');
                                    btn.className = 'px-5 py-2 text-left hover:bg-gray-50 transition-colors group flex items-center w-full';

                                    // Highlight logic: finding the query case-insensitive
                                    const regex = new RegExp(`(${query})`, 'gi');
                                    const parts = item.name.split(regex);

                                    let html = '';
                                    parts.forEach(part => {
                                        if (part.toLowerCase() === query.toLowerCase()) {
                                            html += `<span class="text-[#B39359] font-['Outfit'] text-[15px] font-normal">${part}</span>`;
                                        } else {
                                            html += `<span class="text-[#1A1A1A] font-['Outfit'] text-[15px] font-normal">${part}</span>`;
                                        }
                                    });

                                    btn.innerHTML = html;
                                    btn.addEventListener('click', () => {
                                        performSearch(item.name);
                                    });
                                    suggestionsList.appendChild(btn);
                                });
                            } else {
                                suggestionsList.innerHTML = `<div class="px-5 py-2 text-gray-500 text-sm">No suggestions found.</div>`;
                            }
                        })
                        .catch(err => console.error('Error fetching suggestions:', err));
                } else {
                    // Space only
                    searchDefaultView.classList.remove('hidden');
                    searchSuggestionsView.classList.add('hidden');
                }

            } else {
                searchClearBtn.classList.add('hidden');
                searchDefaultView.classList.remove('hidden');
                searchSuggestionsView.classList.add('hidden');
            }
        });

        // Search For specific query footer button
        if (searchForBtn) {
            searchForBtn.addEventListener('click', () => {
                performSearch(searchInput.value);
            });
        }

        // Handle clear button click
        if (searchClearBtn) {
            searchClearBtn.addEventListener('click', () => {
                searchInput.value = '';
                searchClearBtn.classList.add('hidden');
                searchInput.focus(); // Keep focus on input
                searchDefaultView.classList.remove('hidden');
                searchSuggestionsView.classList.add('hidden');
            });
        }

        const searchIconBtn = document.getElementById('search-icon-btn');
        if (searchIconBtn) {
            searchIconBtn.addEventListener('click', () => {
                const query = searchInput.value;
                if (query && query.trim().length > 0) {
                    window.location.href = `/products?search=${encodeURIComponent(query.trim())}`;
                }
            });
        }

        // Perform search function
        const performSearch = (query) => {
            if (query && query.trim().length > 0) {
                window.location.href = `/products?search=${encodeURIComponent(query.trim())}`;
            }
        };

        // Handle Enter key
        searchInput.addEventListener('keydown', (e) => {
            if (e.key === 'Enter') {
                performSearch(searchInput.value);
            }
        });

        // Handle clicks on trending/top search items (delegated from dropdown)
        // Default view items
        searchDefaultView.addEventListener('click', (e) => {
            const button = e.target.closest('button');
            if (button) {
                // Check if it's a valid search item button
                const textSpan = button.querySelector('span');
                if (textSpan) {
                    performSearch(textSpan.textContent.trim());
                }
            }
        });
    }
});

// Expose toggle function globally for HTML onclick attributes
window.toggleMobileDropdown = function (menuId, btn) {
    const menu = document.getElementById(menuId);
    const icon = btn.querySelector('.fa-chevron-down');

    if (menu.classList.contains('hidden')) {
        menu.classList.remove('hidden');
        icon.classList.add('rotate-180');
    } else {
        menu.classList.add('hidden');
        icon.classList.remove('rotate-180');
    }
};
