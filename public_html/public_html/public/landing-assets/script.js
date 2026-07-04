document.addEventListener('DOMContentLoaded', () => {
    const themeToggle = document.getElementById('theme-toggle');
    const body = document.body;
    if (!themeToggle) return;
    
    const themeIcon = themeToggle.querySelector('i');
    if (!themeIcon) return;

    // Check for saved theme preference
    const savedTheme = localStorage.getItem('theme');
    
    const updateThemeUI = (isLight) => {
        if (isLight) {
            body.classList.remove('dark-mode');
            body.classList.add('light-mode');
            themeIcon.classList.remove('fa-sun');
            themeIcon.classList.add('fa-moon');
        } else {
            body.classList.remove('light-mode');
            body.classList.add('dark-mode');
            themeIcon.classList.remove('fa-moon');
            themeIcon.classList.add('fa-sun');
        }
    };

    if (savedTheme === 'light') {
        updateThemeUI(true);
    } else {
        updateThemeUI(false); // Default to dark as requested
    }

    // Toggle theme
    themeToggle.addEventListener('click', (e) => {
        e.preventDefault();
        const isCurrentLight = body.classList.contains('light-mode');
        updateThemeUI(!isCurrentLight);
        localStorage.setItem('theme', !isCurrentLight ? 'light' : 'dark');
    });


    // Search bar toggle
    const searchForm = document.querySelector('.nav-actions form');
    const searchInput = searchForm ? searchForm.querySelector('input') : null;
    const searchBtn = searchForm ? searchForm.querySelector('button') : null;

    if (searchBtn && searchInput) {
        searchBtn.addEventListener('click', (e) => {
            if (searchInput.value === '' && window.innerWidth > 768) {
                e.preventDefault();
                searchInput.focus();
                searchForm.classList.toggle('active');
            }
        });
    }

    // Smooth scroll for nav links
    document.querySelectorAll('.nav-links a, .hero-btns button').forEach(anchor => {
        anchor.addEventListener('click', function (e) {
            const href = this.getAttribute('href');
            if (href && href.startsWith('#')) {
                e.preventDefault();
                const target = document.querySelector(href);
                if (target) {
                    window.scrollTo({
                        top: target.offsetTop - 80,
                        behavior: 'smooth'
                    });
                }
            }
        });
    });
});
