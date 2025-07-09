document.addEventListener('DOMContentLoaded', function() {
    const adminCards = document.querySelectorAll('.admin-card');

    adminCards.forEach((card, index) => {
        card.style.animationDelay = `${index * 0.1}s`;
    });

    // Add confirmation for delete action
    const deleteButtons = document.querySelectorAll('.btn-danger');
    deleteButtons.forEach(button => {
        button.addEventListener('click', function(e) {
            e.preventDefault();
            if (confirm('Are you sure you want to delete this admin?')) {
                // Add a fade-out animation before deletion
                const card = this.closest('.admin-card');
                card.style.animation = 'fadeOut 0.5s forwards';
                setTimeout(() => {
                    window.location.href = this.getAttribute('href');
                }, 500);
            }
        });
    });  

    // Add animation for the "Add Admin" button
    const addAdminBtn = document.getElementById('addadmin-btn');
    addAdminBtn.addEventListener('mouseenter', function() {
        this.style.transform = 'scale(1.05)';
    });
    addAdminBtn.addEventListener('mouseleave', function() {
        this.style.transform = 'scale(1)';
    });
});