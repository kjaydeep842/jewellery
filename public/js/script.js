// Image Slider Logic (Shutter Wipe Effect)
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
    // Use Clip-Path for transitions.
    // Active: Fully visible (inset(0))
    // Others: Hidden (clipped fully from left, i.e., inset(0 0 0 100%))
    slides.forEach((slide, i) => {
        slide.style.zIndex = i === 0 ? '10' : '0';
        slide.style.transform = 'none'; // Ensure no transform interference
        // Right-to-Left Wipe: Start with left edge at 100% (hidden on right)
        slide.style.clipPath = i === 0 ? 'inset(0 0 0 0)' : 'inset(0 0 0 100%)';
        // Ensure transition property is ready (but not active on init)
        slide.style.transition = 'clip-path 1.5s ease-in-out';
    });

    const updateDots = (index) => {
        const isExpanding = dotsContainer.classList.contains('dots-expanding');
        dots.forEach((dot, i) => {
            if (isExpanding) {
                if (i === index) {
                    dot.classList.remove('w-3', 'bg-[#E8E1D5]');
                    dot.classList.add('w-8', 'bg-[#CBA65A]');
                } else {
                    dot.classList.remove('w-8', 'bg-[#CBA65A]');
                    dot.classList.add('w-3', 'bg-[#E8E1D5]');
                }
                dot.classList.remove('bg-black', 'bg-opacity-75', 'bg-opacity-100');
            } else {
                if (i === index) {
                    dot.classList.add('bg-white');
                    dot.classList.remove('bg-white/50');
                } else {
                    dot.classList.add('bg-white/50');
                    dot.classList.remove('bg-white');
                }
            }
        });
    };

    const goToSlide = (nextIndex) => {
        if (nextIndex === currentIndex) return;

        const currentSlide = slides[currentIndex];
        const nextSlide = slides[nextIndex];

        // Prepare Next Slide
        // We want it to wipe in from Right to Left.
        // Start state: clipped fully from left (inset(0 0 0 100%))
        nextSlide.style.transition = 'none';
        nextSlide.style.clipPath = 'inset(0 0 0 100%)';
        nextSlide.style.zIndex = '20'; // On top

        // Force Reflow
        void nextSlide.offsetWidth;

        // Animate
        nextSlide.style.transition = 'clip-path 1.5s ease-in-out';
        nextSlide.style.clipPath = 'inset(0 0 0 0)'; // Reveal fully

        // Current Slide stays put (behind)
        currentSlide.style.zIndex = '10';

        // Update Index
        currentIndex = nextIndex;
        updateDots(currentIndex);

        // Cleanup after transition
        setTimeout(() => {
            currentSlide.style.zIndex = '0';
            currentSlide.style.clipPath = 'inset(0 0 0 100%)'; // Hide it for next time
            nextSlide.style.zIndex = '10';
        }, 1500);
    };

    const nextSlide = () => {
        goToSlide((currentIndex + 1) % total);
    };

    const startAuto = () => {
        clearInterval(autoSlideInterval);
        autoSlideInterval = setInterval(nextSlide, interval);
    };

    const stopAuto = () => {
        clearInterval(autoSlideInterval);
    };

    // Dot Events
    dots.forEach((dot, i) => {
        dot.addEventListener('click', () => {
            stopAuto();
            goToSlide(i);
            startAuto();
        });
    });

    // Swipe Events
    wrapper.addEventListener('touchstart', (e) => {
        touchStartX = e.changedTouches[0].screenX;
        stopAuto();
    });

    wrapper.addEventListener('touchend', (e) => {
        touchEndX = e.changedTouches[0].screenX;
        handleSwipe();
        startAuto();
    });

    const handleSwipe = () => {
        // Swipe Logic:
        // User wants "Right to left side swipe".
        // This implies dragging finger from R to L (Swiping Left).
        // touchStartX > touchEndX
        if (touchStartX - touchEndX > 50) {
            nextSlide();
        }
    };

    // Init
    updateDots(0);
    startAuto();
};

document.addEventListener("DOMContentLoaded", () => {
    initShutterSlider('slides', 'dots', 5000);


    initAutoScroll('productScroll1', 2000);
    initAutoScroll('productScroll2', 2000);
    initAutoScroll('launchScroll', 2000);

});
//Premium Collectin....
const slider = document.getElementById('jewellerySlider');
const slideIndexLabel = document.getElementById('slideIndex');

function slide(direction) {
    // Calculate scroll amount based on card width + gap
    const cardWidth = slider.querySelector('.group').offsetWidth + 24;

    if (direction === 'right') {
        slider.scrollLeft += cardWidth;
    } else {
        slider.scrollLeft -= cardWidth;
    }
}

// Update the "01" counter when scrolling
slider.addEventListener('scroll', () => {
    const cardWidth = slider.querySelector('.group').offsetWidth + 24;
    const index = Math.round(slider.scrollLeft / cardWidth) + 1;
    slideIndexLabel.innerText = index.toString().padStart(2, '0');
});
// Category Section
const categoryData = [
    { title: "Rings", url: "https://images.unsplash.com/photo-1605100804763-247f67b3557e?auto=format&fit=crop&w=600" },
    { title: "Pendants", url: "https://images.unsplash.com/photo-1599643478518-a784e5dc4c8f?auto=format&fit=crop&w=600" },
    { title: "Bracelets", url: "https://images.unsplash.com/photo-1611591437281-460bfbe1220a?auto=format&fit=crop&w=600" }
];

let currentIdx = 0;

function changeSlide(dir) {
    currentIdx = dir === 'next' ? (currentIdx + 1) % categoryData.length : (currentIdx - 1 + categoryData.length) % categoryData.length;

    const img = document.getElementById('mainCatImg');
    const title = document.getElementById('mainCatTitle');

    img.style.opacity = '0';
    setTimeout(() => {
        img.src = categoryData[currentIdx].url;
        title.innerText = categoryData[currentIdx].title;
        img.style.opacity = '1';
    }, 300);
}
// Customer Review Section
function scrollSlider(direction) {
    const slider = document.getElementById('testimonialSlider');
    // Determine scroll amount based on card width
    const item = slider.firstElementChild;
    const gap = 24; // tailwind gap-6
    const scrollAmount = item ? item.offsetWidth + gap : 624;

    if (direction === 'left') {
        slider.scrollBy({ left: -scrollAmount, behavior: 'smooth' });
    } else {
        slider.scrollBy({ left: scrollAmount, behavior: 'smooth' });
    }
}
// Second Image Slider Logic (Shutter Effect)
document.addEventListener("DOMContentLoaded", () => {
    initShutterSlider('slides1', 'dots1', 5000);
});



// Unique Style Slider Logic
// Reverting to simpler independent logic for Unique Style (as user reverted unification)
// But keeping it functional
document.addEventListener("DOMContentLoaded", () => {
    const slider = document.getElementById('uniqueStyleSlider');
    if (!slider) return;

    const interval = 2000;
    let autoSlideInterval;

    const startAutoSlide = () => {
        stopAutoSlide();
        autoSlideInterval = setInterval(() => {
            if (slider.scrollWidth <= slider.clientWidth) return;

            // Simple continuous scroll feel or step
            // User reverted to step logic usually
            const item = slider.firstElementChild;
            if (!item) return;

            const isMd = window.matchMedia('(min-width: 768px)').matches;
            const gap = isMd ? 20 : 4;
            const width = item.getBoundingClientRect().width;
            const step = width + gap;

            // Seamless Infinite Scroll Logic
            // Assuming 4 items duplicated -> 8 items total.
            // Loop point is after 4th item.
            const loopThreshold = 4 * step;

            // If we have scrolled past the first set (4 items)
            if (slider.scrollLeft >= loopThreshold) {
                // Instantly jump back to start of first set (which looks identical)
                slider.scrollLeft -= loopThreshold;
            }

            // Now scroll forward
            slider.scrollBy({ left: step, behavior: 'smooth' });
        }, interval);
    };

    const stopAutoSlide = () => {
        clearInterval(autoSlideInterval);
    };

    // Basic Interaction
    slider.addEventListener('mousedown', () => stopAutoSlide());
    slider.addEventListener('touchstart', () => stopAutoSlide());
    slider.addEventListener('mouseup', () => startAutoSlide());
    slider.addEventListener('touchend', () => startAutoSlide());

    startAutoSlide();
});


// Mobile Menu Logic
document.addEventListener('DOMContentLoaded', () => {
    const mobileMenuBtn = document.getElementById('mobile-menu-btn');
    const closeMenuBtn = document.getElementById('close-menu-btn');
    const mobileMenuSidebar = document.getElementById('mobile-menu-sidebar');
    const mobileMenuOverlay = document.getElementById('mobile-menu-overlay');

    function openMenu() {
        mobileMenuOverlay.classList.remove('hidden');
        // small delay to allow display:block to apply before opacity transition
        setTimeout(() => {
            mobileMenuOverlay.classList.remove('opacity-0');
            mobileMenuSidebar.classList.remove('-translate-x-full');
        }, 10);
    }

    function closeMenu() {
        mobileMenuSidebar.classList.add('-translate-x-full');
        mobileMenuOverlay.classList.add('opacity-0');
        setTimeout(() => {
            mobileMenuOverlay.classList.add('hidden');
        }, 300); // match transition duration
    }

    if (mobileMenuBtn) {
        mobileMenuBtn.addEventListener('click', openMenu);
    }

    if (closeMenuBtn) {
        closeMenuBtn.addEventListener('click', closeMenu);
    }

    if (mobileMenuOverlay) {
        mobileMenuOverlay.addEventListener('click', closeMenu);
    }
});

// Global function for mobile dropdowns (called via inline onclick)
window.toggleMobileDropdown = function (menuId, btn) {
    const menu = document.getElementById(menuId);
    const icon = btn.querySelector('i');

    // Close other dropdowns (optional, but good for UX)
    // document.querySelectorAll('[id^="menu-"]').forEach(m => {
    //     if (m.id !== menuId && !m.classList.contains('hidden')) {
    //          m.classList.add('hidden');
    //          // reset icon rotation if needed
    //     }
    // });

    if (menu) {
        menu.classList.toggle('hidden');
        if (icon) {
            icon.style.transform = menu.classList.contains('hidden') ? 'rotate(0deg)' : 'rotate(180deg)';
        }
    }
};

/**
 * Automatically scrolls a horizontal container.
 * @param {string} containerId - ID of the scroll container.
 * @param {number} interval - Scrolling speed in ms.
 */
function initAutoScroll(containerId, interval = 2000) {
    const container = document.getElementById(containerId);
    if (!container) return;

    // Clone items to create an infinite loop effect
    const originalChildren = Array.from(container.children);
    originalChildren.forEach(item => {
        const clone = item.cloneNode(true);
        container.appendChild(clone);
    });

    let isPaused = false;

    const scroll = () => {
        if (isPaused) return;

        const firstItem = container.firstElementChild;
        if (!firstItem) return;

        const scrollAmount = firstItem.offsetWidth + parseFloat(getComputedStyle(container).gap || 0);

        // If we've scrolled past the original set, reset instantly to start
        if (container.scrollLeft >= container.scrollWidth / 2) {
            container.scrollLeft = 0;
        }

        container.scrollBy({ left: scrollAmount, behavior: 'smooth' });
    };

    let scrollInterval = setInterval(scroll, interval);

    const pause = () => {
        isPaused = true;
        clearInterval(scrollInterval);
    };
    const resume = () => {
        isPaused = false;
        scrollInterval = setInterval(scroll, interval);
    };

    container.addEventListener('mouseenter', pause);
    container.addEventListener('mouseleave', resume);
    container.addEventListener('touchstart', pause, { passive: true });
    container.addEventListener('touchend', resume, { passive: true });

    // Safety: reset position if user scrolls manually past halfway
    container.addEventListener('scroll', () => {
        if (container.scrollLeft >= (container.scrollWidth / 2) + 10) {
            // Only reset instantly if not currently animating or to keep flow
            // But usually instant reset is better
            // container.scrollLeft = 0; // This can be jarring if done during manual scroll
        }
    });
}








// Middle Banner & Category Slider Logic Wrapper
function initHomeInteractive(middleBannersCount, categoriesData, storageBaseUrl, assetBaseUrl) {
    // Middle Banner Slider Logic
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

    // Auto-advance middle slider only if multiple slides exist
    if (totalSlides1 > 1) {
        setInterval(() => {
            goToSlide1(currentSlide1 + 1);
        }, 5000);
    }

    // Category Slider Logic
    const categories = categoriesData || [];
    let currentCatIndex = 0;
    const catImg = document.getElementById('mainCatImg');
    const catTitle = document.getElementById('mainCatTitle');
    const catDesc = document.getElementById('catDescription');
    const exploreCatTitle = document.getElementById('exploreCategoryTitle');

    // Make changeSlide globally available as it might be called from onclick handlers in HTML
    window.changeSlide = function (direction) {
        if (!categories || categories.length === 0) return;

        if (direction === 'next') {
            currentCatIndex = (currentCatIndex + 1) % categories.length;
        } else {
            currentCatIndex = (currentCatIndex - 1 + categories.length) % categories.length;
        }

        const category = categories[currentCatIndex];

        // Fade out
        if (catImg) catImg.style.opacity = '0';

        setTimeout(() => {
            // Update content
            if (catImg) {
                if (category.image) {
                    // Ensure storageBaseUrl doesn't have double slash if user passed one
                    const baseUrl = storageBaseUrl.endsWith('/') ? storageBaseUrl : storageBaseUrl + '/';
                    catImg.src = baseUrl + category.image;
                } else {
                    // Fallback to asset logic if needed, or valid placeholder
                    const baseUrl = assetBaseUrl.endsWith('/') ? assetBaseUrl : assetBaseUrl + '/';
                    catImg.src = baseUrl + 'assets/Rectangle_sidebar.png';
                }
            }

            if (catTitle) catTitle.textContent = category.name;
            if (catDesc) {
                catDesc.textContent = category.description || 'Tattsvi jewellery feels incredibly refined and comfortable to wear. The designs are subtle yet elegant.';
            }
            if (exploreCatTitle) {
                exploreCatTitle.textContent = category.name;
            }

            // Fade in
            if (catImg) catImg.style.opacity = '1';

            // Sync with product filter
            // console.log('Changing category to:', category.name, 'ID:', category.id);

            if (typeof window.filterProducts === 'function') {
                window.filterProducts(category.id, null);
            } else if (typeof filterProducts === 'function') {
                filterProducts(category.id, null);
            } else {
                // console.warn('filterProducts function not found!');
            }
        }, 300); // Wait for transition
    };

    // Initialize logic if needed
    if (categories.length > 0) {
        // Optional init
    }
}