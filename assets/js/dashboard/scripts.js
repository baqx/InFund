document.getElementById("toggle-btn").addEventListener("click", function() {
    const sidebar = document.getElementById("sidebar");
    sidebar.classList.toggle("visible");
  
    // Toggle between bars and times icon
    this.classList.toggle("fa-bars");
    this.classList.toggle("fa-times");
  });
  