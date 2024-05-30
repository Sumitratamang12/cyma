document.addEventListener("DOMContentLoaded", function() {
    const navToggle = document.getElementById("nav-toggle");
    const sideNav = document.getElementById("side-nav");

    navToggle.addEventListener("click", function() {
        if (sideNav.classList.contains("active")) {
            sideNav.classList.remove("active");
        } else {
            sideNav.classList.add("active");
        }
    });
});
document.getElementById('search-button').addEventListener('click', function() {
    let query = document.getElementById('search-input').value;
    if (query) {
        // Assuming you have a search results page or a search function to handle the query
        window.location.href = `search.html?q=${encodeURIComponent(query)}`;
    }
});
