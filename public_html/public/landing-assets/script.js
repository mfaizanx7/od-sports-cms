document.addEventListener('DOMContentLoaded', () => {
    const body = document.body;
    body.classList.remove('light-mode');
    body.classList.add('dark-mode');
    localStorage.setItem('theme', 'dark');

    // Hamburger menu toggle
    const menuToggle = document.querySelector('.mobile-menu-toggle');
    const navLinks = document.querySelector('.nav-links');
    if (menuToggle && navLinks) {
        menuToggle.addEventListener('click', function () {
            navLinks.classList.toggle('mobile-open');
            menuToggle.classList.toggle('open');
        });
    }

    // Mobile: tap dropdown parent link to toggle sub-menu
    document.querySelectorAll('.nav-links li.dropdown > a').forEach(function (link) {
        link.addEventListener('click', function (e) {
            if (window.innerWidth <= 1024) {
                e.preventDefault();
                const parent = this.closest('li.dropdown');
                parent.classList.toggle('mobile-dd-open');
            }
        });
    });

    // Close menu when a non-dropdown nav link is clicked on mobile
    document.querySelectorAll('.nav-links li:not(.dropdown) a').forEach(function (link) {
        link.addEventListener('click', function () {
            if (window.innerWidth <= 1024 && navLinks && menuToggle) {
                navLinks.classList.remove('mobile-open');
                menuToggle.classList.remove('open');
            }
        });
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
