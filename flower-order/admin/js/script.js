document.addEventListener('DOMContentLoaded', function() {
    const statCards = document.querySelectorAll('.stat-card');
    const sidebarLinks = document.querySelectorAll('.sidebar nav a');

    // Animate stat cards
    statCards.forEach((card, index) => {
        setTimeout(() => {
            card.style.opacity = '1';
            card.style.transform = 'translateY(0)';
        }, index * 200);
    });           

    // Highlight active sidebar link
    sidebarLinks.forEach(link => {
        if (link.getAttribute('href') === location.pathname.split('/').pop()) {
            link.classList.add('active');
        }
    });

    // Add click event to stat cards
    statCards.forEach(card => {
        card.addEventListener('click', () => {
            card.classList.add('clicked');
            setTimeout(() => {
                card.classList.remove('clicked');
            }, 300);
        });
    });

    // Add hover effect to stat cards
    statCards.forEach(card => {
        card.addEventListener('mousemove', (e) => {
            const rect = card.getBoundingClientRect();
            const x = e.clientX - rect.left;
            const y = e.clientY - rect.top;

            card.style.setProperty('--mouse-x', `${x}px`);
            card.style.setProperty('--mouse-y', `${y}px`);
        });
    });
});