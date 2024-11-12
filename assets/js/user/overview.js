// Animate progress bars on scroll
const progressBars = document.querySelectorAll(".progress-fill");
const animateProgressBars = () => {
  progressBars.forEach((bar) => {
    const rect = bar.getBoundingClientRect();
    const isVisible = rect.top < window.innerHeight && rect.bottom >= 0;

    if (isVisible) {
      const width = bar.style.width;
      bar.style.width = "0%";
      setTimeout(() => {
        bar.style.width = width;
      }, 100);
    }
  });
};

// Initial animation
window.addEventListener("load", animateProgressBars);
// Animate on scroll
window.addEventListener("scroll", animateProgressBars);

// Add smooth scrolling for mobile
document.querySelectorAll('a[href^="#"]').forEach((anchor) => {
  anchor.addEventListener("click", function (e) {
    e.preventDefault();
    const target = document.querySelector(this.getAttribute("href"));
    if (target) {
      target.scrollIntoView({
        behavior: "smooth",
      });
      // Close mobile menu after clicking
      if (window.innerWidth <= 768) {
        sidenav.classList.remove("open");
        menuIcon.classList.remove("fa-times");
        menuIcon.classList.add("fa-bars");
      }
    }
  });
});
