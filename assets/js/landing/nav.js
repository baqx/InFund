
const menuButton = document.querySelector('.menu-button');
const navLinks = document.querySelector('.nav-links');
const overlay = document.querySelector('.overlay');
let isMenuOpen = false;

const toggleMenu = () => {
    isMenuOpen = !isMenuOpen;
    navLinks.classList.toggle('active');
    overlay.classList.toggle('active');
    
    // Toggle menu icon
    const svg = menuButton.querySelector('svg');
    if (isMenuOpen) {
        svg.innerHTML = '<line x1="18" y1="6" x2="6" y2="18"></line><line x1="6" y1="6" x2="18" y2="18"></line>';
    } else {
        svg.innerHTML = '<line x1="3" y1="12" x2="21" y2="12"></line><line x1="3" y1="6" x2="21" y2="6"></line><line x1="3" y1="18" x2="21" y2="18"></line>';
    }

    // Toggle body scroll
    document.body.style.overflow = isMenuOpen ? 'hidden' : '';
};

menuButton.addEventListener('click', toggleMenu);
overlay.addEventListener('click', () => {
    if (isMenuOpen) toggleMenu();
});

// Close menu when clicking on a link
navLinks.querySelectorAll('a').forEach(link => {
    link.addEventListener('click', () => {
        if (isMenuOpen) toggleMenu();
    });
});

// Close menu when resizing window beyond mobile breakpoint
window.addEventListener('resize', () => {
    if (window.innerWidth > 768 && isMenuOpen) {
        toggleMenu();
    }
});
