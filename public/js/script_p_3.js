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

function selectSize(btn) {
    // Remove selected style from all buttons
    document.querySelectorAll('#size-container button').forEach(b => {
        b.classList.remove('border-amber-400', 'text-amber-600', 'border-amber-600', 'text-amber-700', 'bg-amber-50', 'font-bold');
        b.classList.add('border-gray-200', 'text-gray-600', 'font-medium', 'bg-white');
    });

    // Add selected style to the clicked button
    btn.classList.remove('border-gray-200', 'text-gray-600', 'bg-white');
    btn.classList.add('border-amber-400', 'text-amber-600', 'bg-amber-50');
}

function toggleSizes() {
    const hiddenSizes = document.querySelectorAll('.extra-size');
    const viewMoreBtn = document.getElementById('view-more-btn');
    const isExpanded = viewMoreBtn.innerText.trim() === 'View Less';

    if (isExpanded) {
        // Collapse: Hide extra sizes
        hiddenSizes.forEach(btn => {
            btn.classList.add('hidden');
        });
        viewMoreBtn.innerText = 'View More';
    } else {
        // Expand: Show all sizes
        hiddenSizes.forEach(btn => {
            btn.classList.remove('hidden');
        });
        viewMoreBtn.innerText = 'View Less';
    }
}

function toggleAccordion(button) {
    const content = button.nextElementSibling;
    const icon = button.querySelector('.accordion-icon');
    const container = button.parentElement;

    if (content.style.maxHeight && content.style.maxHeight !== "0px") {
        // Collapse
        content.style.maxHeight = "0px";
        content.classList.add('opacity-0');
        content.classList.remove('mt-4');
        icon.innerHTML = '<i class="fa-solid fa-plus text-[#CBA65A]"></i>';
        icon.parentElement.classList.remove('bg-[#F9F5EC]'); // Remove active bg from icon container if needed
    } else {
        // Expand
        content.style.maxHeight = content.scrollHeight + "px";
        content.classList.remove('opacity-0');
        content.classList.add('mt-4');
        icon.innerHTML = '<i class="fa-solid fa-minus text-[#CBA65A]"></i>';
    }
}

function changeImage(src) {
    // Try to find the main image. Using a robust selector since ID might be missing.
    const mainImg = document.querySelector('.space-y-2 .aspect-\\[4\\/5\\] img') || document.getElementById('mainImage');
    if (mainImg) {
        mainImg.src = src;
    }
}

function switchTab(tabName, btn) {
    // Update Buttons
    const buttons = btn.parentElement.querySelectorAll('button');
    buttons.forEach(b => {
        b.classList.remove('bg-black', 'text-white', 'border-black', 'shadow-md');
        b.classList.add('bg-transparent', 'text-gray-600', 'border-[#E8E1D5]');
    });
    btn.classList.remove('bg-transparent', 'text-gray-600', 'border-[#E8E1D5]');
    btn.classList.add('bg-black', 'text-white', 'border-black', 'shadow-md');

    // Hide All Content Sections
    document.getElementById('content-about').classList.add('hidden');
    document.getElementById('content-details').classList.add('hidden');
    document.getElementById('content-price').classList.add('hidden');

    // Show Selected Content
    document.getElementById(`content-${tabName}`).classList.remove('hidden');
}

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
        // User wants 'Right to left side swipe'.
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

document.addEventListener('DOMContentLoaded', () => {
    initShutterSlider('slides', 'dots', 5000);
});
