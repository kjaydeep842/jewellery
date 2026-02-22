/**
 * Tattsvi Jewelry Store - Main Application Script
 * Consolidated from individual modules.
 */

"use strict";

/* =========================================
   Global Utilities & Mobile Menu
   ========================================= */

// Toggle Mobile Dropdown (Exposed to Window for onclick usage)
window.toggleMobileDropdown = function (menuId, btn) {
    const menu = document.getElementById(menuId);
    if (!menu) return;

    const icon = btn.querySelector("i");

    // Toggle hidden class
    if (menu.classList.contains("hidden")) {
        menu.classList.remove("hidden");
        if (icon) icon.style.transform = "rotate(180deg)";
    } else {
        menu.classList.add("hidden");
        if (icon) icon.style.transform = "rotate(0deg)";
    }
};

// Mobile Menu Logic
document.addEventListener("DOMContentLoaded", () => {
    const mobileMenuBtn = document.getElementById("mobile-menu-btn");
    const closeMenuBtn = document.getElementById("close-menu-btn");
    const mobileMenuSidebar = document.getElementById("mobile-menu-sidebar");
    const mobileMenuOverlay = document.getElementById("mobile-menu-overlay");

    function openMenu() {
        if (mobileMenuSidebar && mobileMenuOverlay) {
            mobileMenuOverlay.classList.remove("hidden");
            // small delay to allow display:block to apply before opacity transition
            setTimeout(() => {
                mobileMenuOverlay.classList.remove("opacity-0");
                mobileMenuSidebar.classList.remove("-translate-x-full");
            }, 10);
        }
    }

    function closeMenu() {
        if (mobileMenuSidebar && mobileMenuOverlay) {
            mobileMenuSidebar.classList.add("-translate-x-full");
            mobileMenuOverlay.classList.add("opacity-0");
            setTimeout(() => {
                mobileMenuOverlay.classList.add("hidden");
            }, 300); // match transition duration
        }
    }

    if (mobileMenuBtn) {
        mobileMenuBtn.addEventListener("click", openMenu);
    }

    if (closeMenuBtn) {
        closeMenuBtn.addEventListener("click", closeMenu);
    }

    if (mobileMenuOverlay) {
        mobileMenuOverlay.addEventListener("click", closeMenu);
    }

    // Mobile Filter Sidebar Logic
    const filterBtn = document.getElementById("mobile-filter-btn");
    const closeFilterBtn = document.getElementById("close-filter-btn");
    const filterSidebar = document.getElementById("filter-sidebar");
    const filterOverlay = document.getElementById("filter-overlay");

    window.openFilter = function () {
        if (filterSidebar && filterOverlay) {
            filterOverlay.classList.remove("hidden");
            // small delay to allow display:block to apply before opacity transition
            setTimeout(() => {
                filterOverlay.classList.remove("opacity-0");
                filterSidebar.classList.remove("-translate-x-full");
            }, 10);
            document.body.style.overflow = "hidden"; // Prevent background scrolling
        }
    };

    window.closeFilter = function () {
        if (filterSidebar && filterOverlay) {
            filterSidebar.classList.add("-translate-x-full");
            filterOverlay.classList.add("opacity-0");
            setTimeout(() => {
                filterOverlay.classList.add("hidden");
                document.body.style.overflow = ""; // Restore scrolling
            }, 300);
        }
    };

    if (filterBtn) {
        filterBtn.addEventListener("click", window.openFilter);
    }

    if (closeFilterBtn) {
        closeFilterBtn.addEventListener("click", closeFilter);
    }

    if (filterOverlay) {
        filterOverlay.addEventListener("click", closeFilter);
    }
});

/* =========================================
   Sliders (Shutter & AutoScroll)
   ========================================= */

const initShutterSlider = (sliderId, dotsId, interval = 5000) => {
    const wrapper = document.getElementById(sliderId);
    const dotsContainer = document.getElementById(dotsId);
    if (!wrapper || !dotsContainer) return;

    const slides = Array.from(wrapper.children);
    const dots = Array.from(dotsContainer.children);
    const total = slides.length;
    let currentIndex = 0;
    let autoSlideInterval;
    let touchStartX = 0;
    let touchEndX = 0;

    // Initialize Styles
    slides.forEach((slide, i) => {
        slide.style.zIndex = i === 0 ? "10" : "0";
        slide.style.transform = "none";
        slide.style.clipPath = i === 0 ? "inset(0 0 0 0)" : "inset(0 0 0 100%)";
        slide.style.transition = "clip-path 1.5s ease-in-out";
    });

    const updateDots = (index) => {
        const isExpanding = dotsContainer.classList.contains("dots-expanding");
        dots.forEach((dot, i) => {
            if (isExpanding) {
                if (i === index) {
                    dot.classList.remove("w-3", "bg-[#E8E1D5]");
                    dot.classList.add("w-8", "bg-[#CBA65A]");
                } else {
                    dot.classList.remove("w-8", "bg-[#CBA65A]");
                    dot.classList.add("w-3", "bg-[#E8E1D5]");
                }
                dot.classList.remove(
                    "bg-black",
                    "bg-opacity-75",
                    "bg-opacity-100",
                );
            } else {
                if (i === index) {
                    dot.classList.add("bg-white");
                    dot.classList.remove("bg-white/50");
                } else {
                    dot.classList.add("bg-white/50");
                    dot.classList.remove("bg-white");
                }
            }
        });
    };

    const goToSlide = (nextIndex) => {
        if (nextIndex === currentIndex) return;
        const currentSlide = slides[currentIndex];
        const nextSlide = slides[nextIndex];

        nextSlide.style.transition = "none";
        nextSlide.style.clipPath = "inset(0 0 0 100%)";
        nextSlide.style.zIndex = "20";
        void nextSlide.offsetWidth; // Force Reflow
        nextSlide.style.transition = "clip-path 1.5s ease-in-out";
        nextSlide.style.clipPath = "inset(0 0 0 0)";
        currentSlide.style.zIndex = "10";

        currentIndex = nextIndex;
        updateDots(currentIndex);

        setTimeout(() => {
            currentSlide.style.zIndex = "0";
            currentSlide.style.clipPath = "inset(0 0 0 100%)";
            nextSlide.style.zIndex = "10";
        }, 1500);
    };

    const nextSlide = () => goToSlide((currentIndex + 1) % total);

    const startAuto = () => {
        clearInterval(autoSlideInterval);
        autoSlideInterval = setInterval(nextSlide, interval);
    };

    const stopAuto = () => clearInterval(autoSlideInterval);

    dots.forEach((dot, i) => {
        dot.addEventListener("click", () => {
            stopAuto();
            goToSlide(i);
            startAuto();
        });
    });

    wrapper.addEventListener(
        "touchstart",
        (e) => {
            touchStartX = e.changedTouches[0].screenX;
            stopAuto();
        },
        { passive: true },
    );

    wrapper.addEventListener(
        "touchend",
        (e) => {
            touchEndX = e.changedTouches[0].screenX;
            if (touchStartX - touchEndX > 50) nextSlide();
            startAuto();
        },
        { passive: true },
    );

    updateDots(0);
    startAuto();
};

const initAutoScroll = (containerId, interval = 2000) => {
    const container = document.getElementById(containerId);
    if (!container) return;

    // Clone items to create an infinite loop effect
    const originalChildren = Array.from(container.children);
    if (originalChildren.length > 0) {
        originalChildren.forEach((item) => {
            const clone = item.cloneNode(true);
            container.appendChild(clone);
        });
    }

    let isPaused = false;
    let scrollInterval;

    const scroll = () => {
        if (isPaused) return;
        const firstItem = container.firstElementChild;
        if (!firstItem) return;

        const scrollAmount = firstItem.offsetWidth + 24; // approx gap

        if (container.scrollLeft >= container.scrollWidth / 2) {
            container.scrollLeft = 0;
        }
        container.scrollBy({ left: scrollAmount, behavior: "smooth" });
    };

    const start = () => (scrollInterval = setInterval(scroll, interval));
    const stop = () => clearInterval(scrollInterval);

    container.addEventListener("mouseenter", () => {
        isPaused = true;
        stop();
    });
    container.addEventListener("mouseleave", () => {
        isPaused = false;
        start();
    });
    container.addEventListener(
        "touchstart",
        () => {
            isPaused = true;
            stop();
        },
        { passive: true },
    );
    container.addEventListener(
        "touchend",
        () => {
            isPaused = false;
            start();
        },
        { passive: true },
    );

    start();
};

// Initialize Global Sliders
document.addEventListener("DOMContentLoaded", () => {
    initShutterSlider("slides", "dots", 5000);
    initShutterSlider("slides1", "dots1", 5000); // For banners if present

    initAutoScroll("productScroll1", 2000);
    initAutoScroll("productScroll2", 2000);
    initAutoScroll("launchScroll", 2000);

    // Jewellery Slider (Premium Collection)
    const jewellerySlider = document.getElementById("jewellerySlider");
    const slideIndexLabel = document.getElementById("slideIndex");

    if (jewellerySlider && slideIndexLabel) {
        jewellerySlider.addEventListener("scroll", () => {
            const firstCard = jewellerySlider.querySelector(".snap-start");
            const gap = 24; // flx gap-6 is 1.5rem = 24px
            const cardWidth = firstCard ? firstCard.offsetWidth + gap : 300;
            const index =
                Math.round(jewellerySlider.scrollLeft / cardWidth) + 1;
            slideIndexLabel.innerText = index.toString().padStart(2, "0");
        });

        window.slide = function (direction) {
            const firstCard = jewellerySlider.querySelector(".snap-start");
            const gap = 24; // flex gap-6
            const cardWidth = firstCard ? firstCard.offsetWidth + gap : 300;

            if (direction === "left") {
                jewellerySlider.scrollBy({
                    left: -cardWidth,
                    behavior: "smooth",
                });
            } else {
                jewellerySlider.scrollBy({
                    left: cardWidth,
                    behavior: "smooth",
                });
            }
        };
    }
});

/* =========================================
   Product Details Page Logic
   ========================================= */

window.selectSize = function (btn) {
    document.querySelectorAll("#size-container button").forEach((b) => {
        b.classList.remove(
            "border-amber-400",
            "text-amber-600",
            "border-amber-600",
            "text-amber-700",
            "bg-amber-50",
            "font-bold",
        );
        b.classList.add(
            "border-gray-200",
            "text-gray-600",
            "font-medium",
            "bg-white",
        );
    });
    btn.classList.remove("border-gray-200", "text-gray-600", "bg-white");
    btn.classList.add(
        "border-amber-400",
        "text-amber-600",
        "bg-amber-50",
        "font-bold",
    );
};

window.toggleSizes = function () {
    const hiddenSizes = document.querySelectorAll(".extra-size");
    const viewMoreBtn = document.getElementById("view-more-btn");
    if (!viewMoreBtn) return;

    const isExpanded = viewMoreBtn.innerText.trim() === "View Less";

    if (isExpanded) {
        hiddenSizes.forEach((btn) => btn.classList.add("hidden"));
        viewMoreBtn.innerText = "View More";
    } else {
        hiddenSizes.forEach((btn) => btn.classList.remove("hidden"));
        viewMoreBtn.innerText = "View Less";
    }
};

window.toggleAccordion = function (button) {
    const content = button.nextElementSibling;
    const icon = button.querySelector(".accordion-icon");

    if (content.style.maxHeight && content.style.maxHeight !== "0px") {
        content.style.maxHeight = "0px";
        content.classList.add("opacity-0");
        content.classList.remove("mt-4");
        if (icon)
            icon.innerHTML = '<i class="fa-solid fa-plus text-[#CBA65A]"></i>';
    } else {
        content.style.maxHeight = content.scrollHeight + "px";
        content.classList.remove("opacity-0");
        content.classList.add("mt-4");
        if (icon)
            icon.innerHTML = '<i class="fa-solid fa-minus text-[#CBA65A]"></i>';
    }
};

window.changeImage = function (src) {
    const mainImg =
        document.querySelector(".space-y-2 .aspect-\\[4\\/5\\] img") ||
        document.getElementById("mainImage");
    if (mainImg) mainImg.src = src;
};

window.switchTab = function (tabName, btn) {
    const buttons = btn.parentElement.querySelectorAll("button");
    buttons.forEach((b) => {
        b.classList.remove(
            "bg-black",
            "text-white",
            "border-black",
            "shadow-md",
        );
        b.classList.add("bg-transparent", "text-gray-600", "border-[#E8E1D5]");
    });
    btn.classList.remove("bg-transparent", "text-gray-600", "border-[#E8E1D5]");
    btn.classList.add("bg-black", "text-white", "border-black", "shadow-md");

    ["about", "details", "price"].forEach((t) => {
        const el = document.getElementById(`content-${t}`);
        if (el) el.classList.add("hidden");
    });
    const target = document.getElementById(`content-${tabName}`);
    if (target) target.classList.remove("hidden");
};

/* =========================================
   Collections / Filtering Logic
   ========================================= */

document.addEventListener("DOMContentLoaded", () => {
    // Sort Dropdown
    const sortButton = document.getElementById("sort-button");
    const sortMenu = document.getElementById("sort-menu");
    const sortIcon = document.getElementById("sort-icon");
    const selectedSortSpan = document.getElementById("selected-sort");

    if (sortButton && sortMenu) {
        sortButton.addEventListener("click", (e) => {
            e.stopPropagation();
            const isHidden = sortMenu.classList.contains("hidden");
            if (isHidden) {
                sortMenu.classList.remove("hidden");
                if (sortIcon) sortIcon.style.transform = "rotate(180deg)";
            } else {
                sortMenu.classList.add("hidden");
                if (sortIcon) sortIcon.style.transform = "rotate(0deg)";
            }
        });

        document.addEventListener("click", (e) => {
            if (
                !document
                    .getElementById("sort-dropdown-container")
                    ?.contains(e.target)
            ) {
                sortMenu.classList.add("hidden");
                if (sortIcon) sortIcon.style.transform = "rotate(0deg)";
            }
        });

        sortMenu.querySelectorAll("a").forEach((option) => {
            option.addEventListener("click", function (e) {
                e.preventDefault();
                if (selectedSortSpan)
                    selectedSortSpan.textContent = this.textContent.trim();
                sortMenu.classList.add("hidden");
                if (sortIcon) sortIcon.style.transform = "rotate(0deg)";
            });
        });
    }

    // Filter Chips
    document.querySelectorAll(".filter-chip i").forEach((icon) => {
        icon.addEventListener("click", function () {
            this.closest(".filter-chip")?.remove();
        });
    });

    // Sidebar Accordion (Filters)
    // Sidebar Accordion (Filters) - logic from new_arrival.js
    // const headers = document.querySelectorAll('.filter-accordion-header');
    // headers.forEach(header => {
    //     header.addEventListener('click', () => {
    //         // The content div is the next sibling
    //         const content = header.nextElementSibling;
    //         const icon = header.querySelector('.accordion-icon');

    //         // Toggle the hidden class
    //         content.classList.toggle('hidden');

    //         // Rotate the icon
    //         if (icon) {
    //             if (content.classList.contains('hidden')) {
    //                 icon.style.transform = 'rotate(0deg)';
    //             } else {
    //                 icon.style.transform = 'rotate(180deg)';
    //             }
    //         }
    //     });
    // });
});

/* =========================================
   Cart / Payment Logic
   ========================================= */

window.toggleQuantityMenu = function (button) {
    const dropdown = button.nextElementSibling;
    document
        .querySelectorAll(".quantity-dropdown-container > div")
        .forEach((d) => {
            if (d !== dropdown) d.classList.add("hidden");
        });
    if (dropdown) dropdown.classList.toggle("hidden");
};

window.selectQuantity = function (element, quantity) {
    const container = element.closest(".quantity-dropdown-container");
    const displaySpan = container.querySelector(".qty-display");
    const dropdown = container.querySelector("div.absolute");

    if (displaySpan) displaySpan.textContent = `Qty: ${quantity}`;
    if (dropdown) dropdown.classList.add("hidden");

    const form = container.closest("form");
    if (form) {
        const input = form.querySelector('input[name="quantity"]');
        if (input) {
            input.value = quantity;
            form.submit();
        }
    }
};

document.addEventListener("click", function (event) {
    if (!event.target.closest(".quantity-dropdown-container")) {
        document
            .querySelectorAll(".quantity-dropdown-container > div")
            .forEach((d) => {
                d.classList.add("hidden");
            });
    }
});

/* =========================================
   Home Page Category Slider (Optional)
   ========================================= */

window.initHomeInteractive = function (
    middleBannersCount,
    categoriesData,
    storageBaseUrl,
    assetBaseUrl,
) {
    // Banner Slider
    // Banner Slider Logic for slides1 is handled by initShutterSlider globally
    // Removing conflicting translateX logic that causes the container to move off-screen
    /*
    const slides1 = document.getElementById('slides1');
    const dots1 = document.querySelectorAll('#dots1 button');
    let currentSlide1 = 0;
    const totalSlides1 = middleBannersCount || 0;

    function goToSlide1(n) {
        if (!slides1 || totalSlides1 <= 0) return;
        currentSlide1 = (n + totalSlides1) % totalSlides1;
        slides1.style.transform = `translateX(-${currentSlide1 * 100}%)`;
        if (dots1) {
            dots1.forEach((dot, index) => {
                dot.className = `w-8 h-1 rounded-[1px] transition-all duration-300 ${index === currentSlide1 ? 'bg-white' : 'bg-white/50 hover:bg-white'}`;
            });
        }
    }

    if (totalSlides1 > 1) {
        setInterval(() => goToSlide1(currentSlide1 + 1), 5000);
    }
    */

    // Category Slider
    let currentCatIndex = 0;
    const catImg = document.getElementById("mainCatImg");
    const catTitle = document.getElementById("mainCatTitle");
    const catDesc = document.getElementById("catDescription");
    const exploreCatTitle = document.getElementById("exploreCategoryTitle");

    window.changeSlide = function (direction) {
        if (!categoriesData || categoriesData.length === 0) return;

        if (direction === "next") {
            currentCatIndex = (currentCatIndex + 1) % categoriesData.length;
        } else {
            currentCatIndex =
                (currentCatIndex - 1 + categoriesData.length) %
                categoriesData.length;
        }

        const category = categoriesData[currentCatIndex];
        if (catImg) catImg.style.opacity = "0";

        setTimeout(() => {
            if (catImg) {
                const baseUrl = category.image ? storageBaseUrl : assetBaseUrl;
                const imagePath =
                    category.image || "assets/Rectangle_sidebar.png";
                // Handle slashes carefully
                const finalUrl = baseUrl.endsWith("/")
                    ? baseUrl + imagePath
                    : baseUrl + "/" + imagePath;
                catImg.src = finalUrl;
            }
            if (catTitle) catTitle.textContent = category.name;
            if (catDesc) catDesc.textContent = category.description || "";
            if (exploreCatTitle) exploreCatTitle.textContent = category.name;

            if (catImg) catImg.style.opacity = "1";

            if (typeof window.updateProductSlider === "function") {
                window.updateProductSlider(category.id);
            }

            // Sync category buttons and hidden input for Explore All button
            if (typeof window.filterProducts === "function") {
                window.filterProducts(category.id, null);
            }

            // Update slider Explore All button's hidden input
            const sliderCategoryInput = document.getElementById(
                "sliderCategoryInput",
            );
            if (sliderCategoryInput) {
                if (category.name && category.name !== "all") {
                    sliderCategoryInput.setAttribute("name", "category[]");
                    sliderCategoryInput.value = category.name;
                } else {
                    sliderCategoryInput.removeAttribute("name");
                    sliderCategoryInput.value = "";
                }
            }
        }, 300);
    };

    // Initialize slider category input on page load
    if (categoriesData && categoriesData.length > 0) {
        const initialCategory = categoriesData[0];
        const sliderCategoryInput = document.getElementById(
            "sliderCategoryInput",
        );
        if (sliderCategoryInput && initialCategory) {
            if (initialCategory.name && initialCategory.name !== "all") {
                sliderCategoryInput.setAttribute("name", "category[]");
                sliderCategoryInput.value = initialCategory.name;
            }
        }
    }
};

/* =========================================
   Header Search Logic
   ========================================= */

document.addEventListener("DOMContentLoaded", () => {
    const searchContainer = document.getElementById("search-container");
    const searchInput = document.getElementById("search-input");
    const searchBtn = document.getElementById("search-btn");
    const searchDropdown = document.getElementById("search-dropdown");
    const defaultView = document.getElementById("search-default-view");
    const suggestionsView = document.getElementById("search-suggestions-view");
    const suggestionsList = document.getElementById("suggestions-list");
    const searchQueryText = document.getElementById("search-query-text");
    const searchForBtn = document.getElementById("search-for-btn");

    if (!searchContainer || !searchInput) return;

    // Toggle Dropdown on Focus
    searchInput.addEventListener("focus", () => {
        if (searchDropdown) searchDropdown.classList.remove("hidden");
    });

    // Hide Dropdown on Click Outside
    document.addEventListener("click", (e) => {
        if (!searchContainer.contains(e.target)) {
            if (searchDropdown) searchDropdown.classList.add("hidden");
        }
    });

    // Handle Input
    let debounceTimer;
    searchInput.addEventListener("input", (e) => {
        const query = e.target.value.trim();

        // Show/Hide Views
        if (query.length > 0) {
            if (defaultView) defaultView.classList.add("hidden");
            if (suggestionsView) suggestionsView.classList.remove("hidden");
            if (searchQueryText) searchQueryText.textContent = query;
        } else {
            if (defaultView) defaultView.classList.remove("hidden");
            if (suggestionsView) suggestionsView.classList.add("hidden");
        }

        // Fetch Suggestions
        clearTimeout(debounceTimer);
        debounceTimer = setTimeout(() => {
            if (query.length > 1) {
                // Fetch if more than 1 char
                fetch(
                    `/ajax/search-suggestions?query=${encodeURIComponent(query)}`,
                )
                    .then((response) => response.json())
                    .then((data) => {
                        if (suggestionsList) {
                            suggestionsList.innerHTML = ""; // Clear previous
                            if (data && data.length > 0) {
                                data.forEach((item) => {
                                    const div = document.createElement("div");
                                    div.className =
                                        "px-5 py-3 hover:bg-gray-50 cursor-pointer flex items-center justify-between group transition-colors";
                                    div.innerHTML = `
                                        <div class="flex items-center gap-3">
                                            <i class="fa-solid fa-magnifying-glass text-gray-400 text-sm"></i>
                                            <span class="text-[#1A1A1A] font-['Outfit'] text-[15px] font-medium group-hover:text-[#B39359] transition-colors">
                                                ${item.name || item}
                                            </span>
                                        </div>
                                    `;
                                    div.addEventListener("click", () => {
                                        const searchForm =
                                            document.getElementById(
                                                "searchForm",
                                            );
                                        const searchFormInput =
                                            document.getElementById(
                                                "searchFormInput",
                                            );
                                        if (searchForm && searchFormInput) {
                                            searchFormInput.value =
                                                item.name || item;
                                            searchForm.submit();
                                        }
                                    });
                                    suggestionsList.appendChild(div);
                                });
                            } else {
                                suggestionsList.innerHTML = `
                                    <div class="px-5 py-3 text-gray-500 font-['Outfit']">No suggestions found</div>
                                `;
                            }
                        }
                    })
                    .catch((err) => console.error("Search error:", err));
            }
        }, 300);
    });

    // Perform Search
    const performSearch = () => {
        const query = searchInput.value.trim();
        if (query) {
            const searchForm = document.getElementById("searchForm");
            const searchFormInput = document.getElementById("searchFormInput");
            if (searchForm && searchFormInput) {
                searchFormInput.value = query;
                searchForm.submit();
            }
        }
    };

    // Search button
    if (searchBtn) {
        searchBtn.addEventListener("click", performSearch);
    }

    // Enter key
    if (searchInput) {
        searchInput.addEventListener("keypress", (e) => {
            if (e.key === "Enter") {
                e.preventDefault();
                performSearch();
            }
        });
    }

    // Search For button
    if (searchForBtn) {
        searchForBtn.addEventListener("click", performSearch);
    }

    // Trending and Top Search Buttons - Use POST form
    const trendingButtons = document.querySelectorAll(
        ".search-trending-btn, .search-top-btn",
    );
    trendingButtons.forEach((button) => {
        button.addEventListener("click", (e) => {
            e.preventDefault();
            const searchTerm = button.getAttribute("data-search");
            if (searchTerm) {
                const searchForm = document.getElementById("searchForm");
                const searchFormInput =
                    document.getElementById("searchFormInput");
                if (searchForm && searchFormInput) {
                    searchFormInput.value = searchTerm;
                    searchForm.submit();
                }
            }
        });
    });

    // User Menu Dropdown Toggle
    const userMenuBtn = document.getElementById("user-menu-btn");
    const userDropdownMenu = document.getElementById("user-dropdown-menu");
    const userMenuContainer = document.getElementById("user-menu-container");

    if (userMenuBtn && userDropdownMenu) {
        userMenuBtn.addEventListener("click", (e) => {
            e.stopPropagation();
            userDropdownMenu.classList.toggle("hidden");
        });

        document.addEventListener("click", (e) => {
            if (userMenuContainer && !userMenuContainer.contains(e.target)) {
                userDropdownMenu.classList.add("hidden");
            }
        });
    }
});

/* =========================================
   Wishlist Logic
   ========================================= */

document.addEventListener("DOMContentLoaded", function () {
    const wishlistButtons = document.querySelectorAll(".wishlist-btn");

    wishlistButtons.forEach((button) => {
        button.addEventListener("click", function (e) {
            e.preventDefault();
            e.stopPropagation(); // Prevent triggering card click if inside a link

            const productId = this.dataset.productId;

            fetch("/wishlist/toggle", {
                method: "POST",
                headers: {
                    "Content-Type": "application/json",
                    "X-CSRF-TOKEN": document
                        .querySelector('meta[name="csrf-token"]')
                        .getAttribute("content"),
                    Accept: "application/json",
                },
                body: JSON.stringify({ product_id: productId }),
            })
                .then((response) => {
                    if (response.status === 401) {
                        window.location.href = "/login";
                        return;
                    }
                    return response.json();
                })
                .then((data) => {
                    const img = this.querySelector("img");
                    let faIcon = this.querySelector(".fa-heart");

                    if (data.status === "added") {
                        if (img) img.classList.add("hidden");

                        if (!faIcon) {
                            faIcon = document.createElement("i");
                            faIcon.className =
                                "fa-solid fa-heart text-[#CBA65A] text-lg"; // Gold color matching theme
                            this.appendChild(faIcon);
                        } else {
                            faIcon.classList.remove("hidden");
                        }

                        showToast(data.message, "success");
                    } else if (data.status === "removed") {
                        if (img) img.classList.remove("hidden");
                        if (faIcon) faIcon.classList.add("hidden");
                        showToast(data.message, "success");
                    }

                    // Update counter if it exists
                    const headerWishlistLink = document.querySelector(
                        'a[href*="wishlist"]',
                    );
                    if (headerWishlistLink) {
                        const countSpan =
                            headerWishlistLink.querySelector("span");
                        if (countSpan) {
                            countSpan.textContent = data.count;
                            if (data.count > 0) {
                                countSpan.classList.remove("hidden");
                                countSpan.style.display = "flex"; // Ensure flex for centering
                            } else {
                                countSpan.classList.add("hidden");
                                countSpan.style.display = "none";
                            }
                        }
                    }
                })
                .catch((error) => {
                    console.error("Error:", error);
                });
        });
    });

    // Simple Toast Notification
    function showToast(message, type = "success") {
        // Check if toast container exists
        let container = document.getElementById("toast-container");
        if (!container) {
            container = document.createElement("div");
            container.id = "toast-container";
            container.className =
                "fixed bottom-5 right-5 z-[9999] flex flex-col gap-2";
            document.body.appendChild(container);
        }

        const toast = document.createElement("div");
        toast.className = `px-6 py-4 rounded-lg shadow-[0px_4px_20px_0px_rgba(0,0,0,0.15)] text-white font-['Outfit'] font-medium transform transition-all duration-500 translate-y-full ${type === "success" ? "bg-[#CBA65A]" : "bg-red-600"} border border-[#B39359]`;
        toast.innerHTML = `<div class="flex items-center gap-2">
            <i class="fa-solid ${type === "success" ? "fa-circle-check" : "fa-circle-exclamation"}"></i>
            <span>${message}</span>
        </div>`;
        container.appendChild(toast);

        // Animate in
        requestAnimationFrame(() => {
            toast.classList.remove("translate-y-full");
        });

        // Remove after 3 seconds
        setTimeout(() => {
            toast.classList.add("translate-y-full");
            setTimeout(() => {
                toast.remove();
                if (container.children.length === 0) {
                    container.remove();
                }
            }, 500);
        }, 3000);
    }
});

/* =========================================
   Global AJAX Filter Logic
   ========================================= */

window.updateProducts = function (
    formId = "filterForm",
    containerId = "products-container",
) {
    const form = document.getElementById(formId);
    if (!form) return;

    const formData = new FormData(form);
    const params = new URLSearchParams(formData);
    const url = `${form.action}?${params.toString()}`;
    const loader = document.getElementById("page-loader");
    const productsContainer = document.getElementById(containerId);

    if (loader) loader.classList.remove("hidden");

    fetch(url, {
        headers: {
            "X-Requested-With": "XMLHttpRequest",
        },
    })
        .then((response) => response.text())
        .then((html) => {
            if (productsContainer) {
                productsContainer.innerHTML = html;

                // Re-initialize pagination listeners for the new content
                initPaginationListeners(containerId);
            }
            if (loader) loader.classList.add("hidden");
        })
        .catch((error) => {
            console.error("Error fetching products:", error);
            if (loader) loader.classList.add("hidden");
        });
};

function initPaginationListeners(containerId) {
    const container = document.getElementById(containerId);
    if (!container) return;

    container.querySelectorAll(".pagination a").forEach((link) => {
        link.addEventListener("click", function (e) {
            e.preventDefault();
            const url = this.href;
            const loader = document.getElementById("page-loader");

            if (loader) loader.classList.remove("hidden");

            fetch(url, {
                headers: {
                    "X-Requested-With": "XMLHttpRequest",
                },
            })
                .then((response) => response.text())
                .then((html) => {
                    container.innerHTML = html;
                    window.scrollTo({ top: 0, behavior: "smooth" });
                    initPaginationListeners(containerId); // Recursive bind
                    if (loader) loader.classList.add("hidden");
                })
                .catch((error) => {
                    console.error("Error fetching page:", error);
                    if (loader) loader.classList.add("hidden");
                });
        });
    });
}

// Initialize on load for existing pagination, sliders, etc.
document.addEventListener("DOMContentLoaded", () => {
    initPaginationListeners("products-container");
    initPriceSlider();
    initSortDropdown();
    initViewMoreShapes();
});

/* =========================================
   Price Slider Logic
   ========================================= */
function initPriceSlider() {
    const minPriceInput = document.getElementById("min-price-input");
    const maxPriceInput = document.getElementById("max-price-input");
    const minPriceDisplay = document.getElementById("min-price-display");
    const maxPriceDisplay = document.getElementById("max-price-display");
    const priceTrack = document.getElementById("price-track");
    const hiddenMinPrice = document.getElementById("hidden-min-price");
    const hiddenMaxPrice = document.getElementById("hidden-max-price");

    if (minPriceInput && maxPriceInput) {
        function updatePriceSlider() {
            const min = parseInt(minPriceInput.value);
            const max = parseInt(maxPriceInput.value);
            const range =
                parseInt(maxPriceInput.max) - parseInt(maxPriceInput.min);

            // Prevent crossing
            if (min > max - 1000) {
                minPriceInput.value = max - 1000;
            }

            const percent1 =
                ((minPriceInput.value - minPriceInput.min) / range) * 100;
            const percent2 =
                ((maxPriceInput.value - maxPriceInput.min) / range) * 100;

            if (priceTrack) {
                priceTrack.style.left = percent1 + "%";
                priceTrack.style.width = percent2 - percent1 + "%";
            }

            if (minPriceDisplay)
                minPriceDisplay.textContent =
                    "₹ " + parseInt(minPriceInput.value).toLocaleString();
            if (maxPriceDisplay)
                maxPriceDisplay.textContent =
                    "₹ " +
                    parseInt(maxPriceInput.value).toLocaleString() +
                    (maxPriceInput.value == maxPriceInput.max ? "+" : "");

            // Update hidden inputs if they exist
            if (hiddenMinPrice) hiddenMinPrice.value = minPriceInput.value;
            if (hiddenMaxPrice) hiddenMaxPrice.value = maxPriceInput.value;
        }

        // Initialize
        updatePriceSlider();

        // Event Listeners
        minPriceInput.addEventListener("input", updatePriceSlider);
        maxPriceInput.addEventListener("input", updatePriceSlider);

        // Trigger filter on change (mouse up / touch end)
        const triggerSliderFilter = () => {
            // Uncheck checkboxes when slider is used
            document
                .querySelectorAll(".price-checkbox")
                .forEach((cb) => (cb.checked = false));
            if (window.innerWidth >= 1024) {
                window.updateProducts();
            }
        };

        minPriceInput.addEventListener("change", triggerSliderFilter);
        maxPriceInput.addEventListener("change", triggerSliderFilter);
    }
}

/* =========================================
   Sort Dropdown Logic
   ========================================= */
function initSortDropdown() {
    const filterForm = document.getElementById("filterForm");

    // Helper to update all sort texts to keep them in sync
    const updateAllSortTexts = (text) => {
        document
            .querySelectorAll(".selected-sort-text")
            .forEach((el) => (el.textContent = text));
    };

    // Iterate over all dropdown containers (Mobile & Desktop)
    document
        .querySelectorAll(".sort-dropdown-container")
        .forEach((container) => {
            const sortButton = container.querySelector(".sort-button");
            const sortMenu = container.querySelector(".sort-menu");
            const sortIcon = container.querySelector(".sort-icon");

            if (sortButton && sortMenu) {
                // Toggle Menu
                sortButton.addEventListener("click", function (e) {
                    e.stopPropagation();
                    // Close other open menus first
                    document.querySelectorAll(".sort-menu").forEach((m) => {
                        if (m !== sortMenu) m.classList.add("hidden");
                    });
                    document.querySelectorAll(".sort-icon").forEach((i) => {
                        if (i !== sortIcon) i.classList.remove("rotate-180");
                    });

                    sortMenu.classList.toggle("hidden");
                    if (sortIcon) sortIcon.classList.toggle("rotate-180");
                });

                // Sort Item Click
                container.querySelectorAll(".sort-item").forEach((item) => {
                    item.addEventListener("click", function (e) {
                        e.preventDefault();
                        const sort = this.dataset.sort;
                        const text = this.textContent.trim();

                        // Update UI text in all dropdowns
                        updateAllSortTexts(text);

                        if (filterForm) {
                            let sortInput =
                                filterForm.querySelector('input[name="sort"]');
                            if (!sortInput) {
                                sortInput = document.createElement("input");
                                sortInput.type = "hidden";
                                sortInput.name = "sort";
                                filterForm.appendChild(sortInput);
                            }
                            sortInput.value = sort;

                            // Close all menus
                            document
                                .querySelectorAll(".sort-menu")
                                .forEach((m) => m.classList.add("hidden"));
                            document
                                .querySelectorAll(".sort-icon")
                                .forEach((i) =>
                                    i.classList.remove("rotate-180"),
                                );

                            window.updateProducts();
                        }
                    });
                });
            }
        });

    // Close when clicking outside
    document.addEventListener("click", function (e) {
        if (!e.target.closest(".sort-dropdown-container")) {
            document
                .querySelectorAll(".sort-menu")
                .forEach((m) => m.classList.add("hidden"));
            document
                .querySelectorAll(".sort-icon")
                .forEach((i) => i.classList.remove("rotate-180"));
        }
    });
}

/* =========================================
   View More Shapes Logic
   ========================================= */
function initViewMoreShapes() {
    document.body.addEventListener("click", function (e) {
        if (e.target.classList.contains("view-more-shapes")) {
            const btn = e.target;
            const container = btn.closest(".filter-content");
            if (container) {
                const extraShapes = container.querySelectorAll(".extra-shape");
                extraShapes.forEach((shape) => {
                    shape.classList.toggle("hidden");
                });

                if (btn.textContent.trim() === "+ View More") {
                    btn.textContent = "- View Less";
                } else {
                    btn.textContent = "+ View More";
                }
            }
        }
    });
}
