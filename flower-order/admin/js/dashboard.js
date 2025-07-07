document.addEventListener('DOMContentLoaded', function() {
    const sidebar = document.querySelector('.sidebar');
    const statCards = document.querySelectorAll('.stat-card');
    const sidebarLinks = document.querySelectorAll('.sidebar nav a');

    // Toggle sidebar
    document.querySelector('.sidebar .logo').addEventListener('click', () => {
        sidebar.classList.toggle('collapsed');
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

    // Simulate recent activity
    const activityList = document.getElementById('activity-list');
    const activities = [
        { icon: 'fas fa-user-plus', text: 'New user registered' },
        { icon: 'fas fa-shopping-cart', text: 'New order placed' },
        { icon: 'fas fa-comment', text: 'New comment on blog post' },
        { icon: 'fas fa-star', text: 'New product review' }
    ];

    activities.forEach((activity, index) => {
        setTimeout(() => {
            const li = document.createElement('li');
            li.innerHTML = `<i class="${activity.icon}"></i>${activity.text}`;
            activityList.appendChild(li);
            setTimeout(() => {
                li.style.opacity = '1';
                li.style.transform = 'translateY(0)';
            }, 50);
        }, index * 1000);
    });
});