/* MOBILE MENU */
const navDialog = document.getElementById("nav-dailog1");

function handleMenu() {
    if (!navDialog) return;

    navDialog.classList.toggle("hidden");

    if (navDialog.classList.contains("hidden")) {
        document.body.style.overflow = "auto";   // enable page scroll
    } else {
        document.body.style.overflow = "hidden"; // disable background scroll
    }
}

document.addEventListener("DOMContentLoaded", () => {

    /* -----------------------------------------------------------
       HERO SLIDER / IMAGE SLIDER (IF EXISTS)
    ----------------------------------------------------------- */
    const slidesWrapper = document.getElementById("slides");
    const dotsContainer = document.getElementById("dots");

    if (slidesWrapper && dotsContainer) {
        const dots = Array.from(dotsContainer.children);
        const total = slidesWrapper.children.length;
        let index = 0;

        function goToSlide(i) {
            index = i;
            slidesWrapper.style.transform = `translateX(${-index * 100}%)`;
            updateDots();
        }

        function updateDots() {
            dots.forEach((dot, i) => {
                dot.classList.toggle("bg-opacity-100", i === index);
                dot.classList.toggle("bg-opacity-75", i !== index);
            });
        }

        dots.forEach((dot, i) => {
            dot.addEventListener("click", () => goToSlide(i));
        });

        setInterval(() => {
            goToSlide((index + 1) % total);
        }, 5000);

        goToSlide(0);
    }

    /* -----------------------------------------------------------
       COUNTDOWN TIMER
    ----------------------------------------------------------- */
    const countdownElement = document.getElementById("countdown");

    if (countdownElement) {
        const countdownDate = new Date().getTime() + 5 * 60 * 60 * 1000;

        const timer = setInterval(() => {
            const now = Date.now();
            const diff = countdownDate - now;

            if (diff < 0) {
                clearInterval(timer);
                countdownElement.innerHTML =
                    "<p class='text-2xl font-semibold'>Offer Expired!</p>";
                return;
            }

            const days = Math.floor(diff / (1000 * 60 * 60 * 24));
            const hrs = Math.floor((diff % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
            const mins = Math.floor((diff % (1000 * 60 * 60)) / (1000 * 60));
            const secs = Math.floor((diff % (1000 * 60)) / 1000);

            const set = (id, val) => {
                const el = document.getElementById(id);
                if (el) el.textContent = String(val).padStart(2, "0");
            };

            set("days", days);
            set("hours", hrs);
            set("minutes", mins);
            set("seconds", secs);
        }, 1000);
    }

    /* -----------------------------------------------------------
       CATEGORY SLIDER (Explore Categories)
    ----------------------------------------------------------- */
    const categorySlider = document.getElementById("slider");

    if (categorySlider) {
        const slides = categorySlider.children;
        let index = 0;

        function update() {
            categorySlider.style.transform = `translateX(-${index * 100}%)`;
        }

        let startX = 0;

        categorySlider.addEventListener("touchstart", e => {
            startX = e.touches[0].clientX;
        });

        categorySlider.addEventListener("touchend", e => {
            const endX = e.changedTouches[0].clientX;
            const diff = startX - endX;

            if (diff > 50) index = (index + 1) % slides.length;
            if (diff < -50) index = (index - 1 + slides.length) % slides.length;

            update();
        });
    }

    /* -----------------------------------------------------------
       TESTIMONIAL SLIDER
    ----------------------------------------------------------- */
    const testimonialTrack = document.getElementById("testimonial-track");

    if (testimonialTrack) {
        const slides = testimonialTrack.children;
        let index = 0;

        const nextBtn = document.getElementById("next");
        const prevBtn = document.getElementById("prev");

        function update() {
            testimonialTrack.style.transform = `translateX(-${index * 100}%)`;
        }

        if (nextBtn) {
            nextBtn.onclick = () => {
                index = (index + 1) % slides.length;
                update();
            };
        }

        if (prevBtn) {
            prevBtn.onclick = () => {
                index = (index - 1 + slides.length) % slides.length;
                update();
            };
        }
    }
});
