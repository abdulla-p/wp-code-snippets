document.addEventListener('DOMContentLoaded', () => {
    const lazyBgImages = document.querySelectorAll('.lazy-load-bg-img');

    if (lazyBgImages.length > 0) {
        const observer = new IntersectionObserver((entries, observer) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    const bgImgContainer = entry.target;
                    const imgSrc = bgImgContainer.getAttribute('data-src');

                    if (imgSrc) {
                        bgImgContainer.style.backgroundImage = `url("${imgSrc}")`;
                        observer.unobserve(bgImgContainer); // Stop observing.
                    }
                }
            });
        });

        lazyBgImages.forEach(image => observer.observe(image)); // Observe each image.
    }
});