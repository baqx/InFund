// Modal functionality
const modal = document.getElementById("donateModal");
const amountInput = document.querySelector(".donation-input");
const modalAmount = document.getElementById("modalAmount");
const hiddenAmount = document.getElementById("hiddenAmount");

function openDonateModal() {
  const amount = amountInput.value || 0;
  modalAmount.textContent = `₦${formatNumber(amount)}`;
  hiddenAmount.value = amount;
  modal.classList.add("active");
  document.body.style.overflow = "hidden";
}

function closeDonateModal() {
  modal.classList.remove("active");
  document.body.style.overflow = "auto";
}

// Close modal when clicking outside
modal.addEventListener("click", (e) => {
  if (e.target === modal) {
    closeDonateModal();
  }
});

// Animate progress bar on scroll
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

// Initialize progress bar animation
window.addEventListener("scroll", animateProgress);
animateProgress();

// Share functionality
const shareButtons = document.querySelectorAll(".share-button");
shareButtons.forEach((button) => {
  button.addEventListener("click", async () => {
    const campaignTitle = document.querySelector(".campaign-title").textContent;
    const campaignUrl = window.location.href;
    const shareText = `Support ${campaignTitle} on INFund: ${campaignUrl}`;

    if (button.querySelector(".fa-whatsapp")) {
      window.open(
        `https://wa.me/?text=${encodeURIComponent(shareText)}`,
        "_blank"
      );
    } else if (button.querySelector(".fa-twitter")) {
      window.open(
        `https://twitter.com/intent/tweet?text=${encodeURIComponent(
          shareText
        )}`,
        "_blank"
      );
    } else {
      try {
        await navigator.share({
          title: campaignTitle,
          text: "Support my education campaign on INFund",
          url: campaignUrl,
        });
      } catch (err) {
        prompt("Copy this link to share:", campaignUrl);
      }
    }
  });
});

// Input validation for donation amount
amountInput.addEventListener("input", (e) => {
  const value = e.target.value;
  if (value < 100) {
    amountInput.setCustomValidity("Minimum donation amount is ₦100");
  } else {
    amountInput.setCustomValidity("");
  }
});

// Format numbers with commas
function formatNumber(num) {
  return num.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
}

// Update all displayed amounts with proper formatting
document.querySelectorAll(".donation-amount").forEach((el) => {
  const amount = el.textContent.replace("₦", "").trim();
  el.textContent = `₦${formatNumber(amount)}`;
});
