document.addEventListener('DOMContentLoaded', function () {
    var colorSelect = document.getElementById('product_color_id');
    var sizeSelect = document.getElementById('size_id');

    function updateSizes(colorId) {
        fetch(`/get-sizes/${colorId}`)
            .then(response => response.json())
            .then(data => {
                sizeSelect.innerHTML = '';
                data.forEach(size => {
                    var option = document.createElement('option');
                    option.value = size.id;
                    option.textContent = size.name;
                    sizeSelect.appendChild(option);
                });
            });
    }

    colorSelect.addEventListener('change', function () {
        updateSizes(this.value);
    });

    if (colorSelect.value) {
        updateSizes(colorSelect.value); // Initial call to populate sizes
    }
});
