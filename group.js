document.addEventListener('DOMContentLoaded', function() {
    const navToggle = document.getElementById('nav-toggle');
    const sideNav = document.getElementById('side-nav');
    const body = document.body;

    navToggle.addEventListener('click', function() {
        sideNav.classList.toggle('open');
        body.classList.toggle('nav-open');
    });

    // Search functionality
    const searchButton = document.getElementById('search-button');
    const searchInput = document.getElementById('search-input');
    const groupContainer = document.getElementById('group-container');
    const groups = groupContainer.getElementsByClassName('grid-item');

    const searchGroups = () => {
        const searchTerm = searchInput.value.toLowerCase();

        for (let i = 0; i < groups.length; i++) {
            const group = groups[i];
            const groupName = group.getElementsByTagName('h3')[0].textContent.toLowerCase();
            const groupDescription = group.getElementsByTagName('p')[0].textContent.toLowerCase();

            if (groupName.includes(searchTerm) || groupDescription.includes(searchTerm)) {
                group.classList.remove('hidden');
            } else {
                group.classList.add('hidden');
            }
        }
    };

    searchButton.addEventListener('click', searchGroups);

    // Enable search on pressing Enter key
    searchInput.addEventListener('keypress', function(event) {
        if (event.key === 'Enter') {
            searchGroups();
        }
    });
});
