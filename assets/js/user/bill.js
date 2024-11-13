
// Progress Bar Animation
const progressFill = document.querySelector(".progress-fill");
const animateProgress = () => {
  const rect = progressFill.getBoundingClientRect();
  const isVisible =
    rect.top >= 0 &&
    rect.left >= 0 &&
    rect.bottom <=
      (window.innerHeight || document.documentElement.clientHeight) &&
    rect.right <= (window.innerWidth || document.documentElement.clientWidth);

  if (isVisible) {
    progressFill.style.width = "<?php echo min(100, $progress); ?>%";
    window.removeEventListener("scroll", animateProgress);
  }
};

// Format numbers with commas
function formatNumber(num) {
  return num.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
}

// Initialize
window.addEventListener("scroll", animateProgress);
animateProgress();


