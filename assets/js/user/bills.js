const filterSelect = document.querySelector(".filter-select");
const searchInput = document.querySelector(".search-input");
const billCards = document.querySelectorAll(".bill-card");

function filterBills() {
  const filterValue = filterSelect.value;
  const searchValue = searchInput.value.toLowerCase();

  billCards.forEach((card) => {
    const status = card.dataset.status;
    const title = card.querySelector("h3").textContent.toLowerCase();
    const description = card
      .querySelector(".bill-description")
      .textContent.toLowerCase();

    let matchesFilter = filterValue === "all";
    if (filterValue === "unpaid") matchesFilter = status === "unpaid";
    if (filterValue === "partially")
      matchesFilter = status === "partially paid";
    if (filterValue === "paid") matchesFilter = status === "paid";

    const matchesSearch =
      title.includes(searchValue) || description.includes(searchValue);

    card.style.display = matchesFilter && matchesSearch ? "block" : "none";
  });
}

filterSelect.addEventListener("change", filterBills);
searchInput.addEventListener("input", filterBills);
