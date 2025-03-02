// Function to automatically hide alerts after 5 seconds
setTimeout(function() {
    const alert = document.querySelector('.alert');
    if (alert) {
        alert.style.transition = 'opacity 0.3s ease-out'; 
        alert.style.opacity = '0'; 
        setTimeout(function() {
            alert.style.display = 'none'; 
        }, 300); 
    }
}, 3000); 
