// Payment Modal Functions
function openPaymentModal(billId, amount) {
  const modal = document.getElementById("paymentModal");
  const modalAmount = document.getElementById("modalAmount");
  const billIdInput = document.getElementById("billId");
  const amountInput = document.getElementById("paymentAmount");

  modalAmount.textContent = `₦${formatNumber(amount.toFixed(2))}`;
  billIdInput.value = billId;
  amountInput.value = amount;

  modal.classList.add("active");
  document.body.style.overflow = "hidden";
}

function closePaymentModal() {
  const modal = document.getElementById("paymentModal");
  modal.classList.remove("active");
  document.body.style.overflow = "auto";
}

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

// Close modal when clicking outside
window.addEventListener("DOMContentLoaded", () => {
  document.getElementById("paymentModal").addEventListener("click", (e) => {
    if (e.target === document.getElementById("paymentModal")) {
      closePaymentModal();
    }
  });
});
