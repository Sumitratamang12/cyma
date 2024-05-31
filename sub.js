document.addEventListener('DOMContentLoaded', function () {
    const container = document.querySelector('.image-container');
    const leftBtn = document.querySelector('.left-btn');
    const rightBtn = document.querySelector('.right-btn');

    const scrollAmount = 300; // Amount to scroll per button click

    leftBtn.addEventListener('click', function () {
        container.scrollBy({
            left: -scrollAmount,
            behavior: 'smooth'
        });
    });

    rightBtn.addEventListener('click', function () {
        container.scrollBy({
            left: scrollAmount,
            behavior: 'smooth'
        });
    });

    // Optional: Disable buttons if at start or end of the scroll
    container.addEventListener('scroll', function () {
        if (container.scrollLeft === 0) {
            leftBtn.disabled = true;
        } else {
            leftBtn.disabled = false;
        }

        if (container.scrollWidth - container.clientWidth === container.scrollLeft) {
            rightBtn.disabled = true;
        } else {
            rightBtn.disabled = false;
        }
    });

    // Initial button state
    container.dispatchEvent(new Event('scroll'));
});