// Filter functionality
const filterSelect = document.querySelector(".filter-select");
const searchInput = document.querySelector(".search-input");
const campaignCards = document.querySelectorAll(".campaign-card");

function filterCampaigns() {
  const filterValue = filterSelect.value;
  const searchValue = searchInput.value.toLowerCase();

  campaignCards.forEach((card) => {
    const status = card.querySelector(".badge").textContent.toLowerCase();
    const title = card.querySelector("h3").textContent.toLowerCase();

    const matchesFilter = filterValue === "all" || status.includes(filterValue);
    const matchesSearch = title.includes(searchValue);

    card.style.display = matchesFilter && matchesSearch ? "block" : "none";
  });
}

filterSelect.addEventListener("change", filterCampaigns);
searchInput.addEventListener("input", filterCampaigns);

// Animate progress bars
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

window.addEventListener("load", animateProgressBars);
window.addEventListener("scroll", animateProgressBars);
