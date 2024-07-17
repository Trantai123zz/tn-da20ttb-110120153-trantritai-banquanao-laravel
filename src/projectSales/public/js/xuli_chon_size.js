document.addEventListener('DOMContentLoaded', function() {
    const buttons = document.querySelectorAll('.tab-btn');
    const feedbackItems = document.querySelectorAll('.feedback-item');

    buttons.forEach(button => {
        button.addEventListener('click', function() {
            const filter = this.getAttribute('data-filter');
            console.log('Filter:', filter); // Log the filter value
            buttons.forEach(btn => btn.classList.remove('active'));
            this.classList.add('active');
            filterFeedback(filter);
        });
    });

    function filterFeedback(filter) {
        console.log('Filtering feedback for rating:', filter); // Log the filter action
        feedbackItems.forEach(item => {
            console.log('Item rating:', item.getAttribute('data-rating')); // Log each item's rating
            if (filter == 0 || item.getAttribute('data-rating') == filter) {
                item.style.display = 'block';
            } else {
                item.style.display = 'none';
            }
        });
    }

    // Initial filter to show all feedback
    filterFeedback(0);
});
document.addEventListener("DOMContentLoaded", function() {
    function updateSizeDropdown() {
        var selectedColorId = document.getElementById('product_color_id').value;

        fetch('/getSizes?product_color_id=' + selectedColorId)
            .then(response => response.json())
            .then(data => {
                var sizeDropdown = document.getElementById('size_id');
                sizeDropdown.innerHTML = '';

                data.forEach(size => {
                    var option = document.createElement('option');
                    option.value = size.id;
                    option.textContent = size.name;
                    sizeDropdown.appendChild(option);
                });
            })
            .catch(error => {
                console.error('Error fetching sizes:', error);
            });
    }

    document.getElementById('product_color_id').addEventListener('change', function() {
        updateSizeDropdown();
    });

    // Update sizes on initial load
    updateSizeDropdown();
});
document.querySelectorAll('.product-rating input').forEach(input => {
    input.addEventListener('change', function() {
        const stars = document.querySelectorAll('.product-rating i');
        stars.forEach(star => star.style.color = '#b1b1b1'); // Reset all stars
        let checkedStars = this.parentNode.querySelectorAll('i');
        checkedStars.forEach(star => star.style.color = '#FFD700'); // Highlight selected stars
    });
});
 // resources/js/prodetail.js

// Get the modal
var modal = document.getElementById("imageModal");

// Get the image and insert it inside the modal - use its "alt" text as a caption
var imgLinks = document.querySelectorAll('.product-image-link');
var modalImg = document.getElementById("modalImage");

imgLinks.forEach(function(link) {
    link.addEventListener('click', function(event) {
        event.preventDefault();
        modal.style.display = "block";
        modalImg.src = this.href;
    });
});
document.addEventListener('DOMContentLoaded', function () {
    const filterButtons = document.querySelectorAll('.tab-btn');
    const feedbackContainer = document.getElementById('feedback-container');
    
    filterButtons.forEach(button => {
        button.addEventListener('click', function () {
            const ratingFilter = this.getAttribute('data-filter');
            const feedbackItems = feedbackContainer.querySelectorAll('.feedback-item');

            filterButtons.forEach(btn => btn.classList.remove('active'));
            this.classList.add('active');

            feedbackItems.forEach(item => {
                const itemRating = item.getAttribute('data-rating');
                if (ratingFilter == 0 || itemRating == ratingFilter) {
                    item.style.display = 'block';
                } else {
                    item.style.display = 'none';
                }
            });
        });
    });
});
