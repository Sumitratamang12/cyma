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
document.getElementById('post-button').addEventListener('click', function() {
    document.getElementById('post-modal').style.display = 'block';
});

document.querySelector('.close-button').addEventListener('click', function() {
    document.getElementById('post-modal').style.display = 'none';
});

window.addEventListener('click', function(event) {
    if (event.target == document.getElementById('post-modal')) {
        document.getElementById('post-modal').style.display = 'none';
    }
});

document.getElementById('submit-post').addEventListener('click', function() {
    const postContent = document.getElementById('post-content').value;
    const imageUpload = document.getElementById('image-upload').files[0];

    if (postContent.trim() || imageUpload) {
        // Display an alert with the post content and the image name
        let alertMessage = 'Post submitted: ' + postContent;
        if (imageUpload) {
            alertMessage += '\nImage uploaded: ' + imageUpload.name;
        }
        alert(alertMessage);
        
        // Here you can add the logic to actually submit the post (e.g., sending it to a server)
        
        document.getElementById('post-modal').style.display = 'none';
    } else {
        alert('Please write something in the post or upload an image.');
    }
});;
document.addEventListener("DOMContentLoaded", function() {
    var dropdowns = document.getElementsByClassName("dropdown");

    for (let i = 0; i < dropdowns.length; i++) {
        dropdowns[i].addEventListener("click", function(event) {
            event.stopPropagation();
            var dropdownContent = this.querySelector(".dropdown-content");
            dropdownContent.style.display = dropdownContent.style.display === "block" ? "none" : "block";
        });
    }

    document.addEventListener("click", function() {
        var dropdownContents = document.querySelectorAll(".dropdown-content");
        dropdownContents.forEach(function(content) {
            content.style.display = "none";
        });
    });
});



