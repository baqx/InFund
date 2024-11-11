const menuToggle = document.querySelector('.menu-toggle');
const sidenav = document.querySelector('.sidenav');
const menuIcon = menuToggle.querySelector('i');

menuToggle.addEventListener('click', () => {
    sidenav.classList.toggle('open');
    menuIcon.classList.toggle('fa-bars');
    menuIcon.classList.toggle('fa-times');
});

// Close sidenav when clicking outside
document.addEventListener('click', (e) => {
    if (!sidenav.contains(e.target) && !menuToggle.contains(e.target)) {
        sidenav.classList.remove('open');
        menuIcon.classList.remove('fa-times');
        menuIcon.classList.add('fa-bars');
    }
});

// Active nav link
const navLinks = document.querySelectorAll('.nav-link');
navLinks.forEach(link => {
    link.addEventListener('click', () => {
        navLinks.forEach(l => l.classList.remove('active'));
        link.classList.add('active');
    });
});
