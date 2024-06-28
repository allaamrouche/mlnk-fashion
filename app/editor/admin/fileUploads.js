document.addEventListener('DOMContentLoaded', function() {
    // Find a static parent element that exists when the page loads
    // This example uses 'body' as the static parent for broad coverage; replace 'body' with a closer parent that exists on DOM load if possible
    document.body.addEventListener('click', function(e) {
        // Check if the clicked element has the class 'upload_image_button'
        if (e.target && e.target.classList.contains('upload_image_button')) {
            e.preventDefault();  // Prevent default button action
            const button = e.target;
            const fileFrame = wp.media({
                title: 'Select or Upload Image',
                library: { type: 'image' },
                button: { text: 'Use this image' },
                multiple: false
            });

            fileFrame.on('select', function() {
                // Get the first selected attachment from the media uploader
                const attachment = fileFrame.state().get('selection').first().toJSON();
                // Assuming the input is directly preceding the button
                const inputField = button.previousElementSibling;
                // Set the value of the input field to the image URL
                inputField.value = attachment.url;
                // Optionally log the selected image URL to the console
                console.log('Selected image URL:', attachment.url);
            });

            fileFrame.open();  // Open the media uploader window
        }
    });
});

