let currentStep = 1;
const totalSteps = 3;

const form = document.getElementById("campaignForm");
const nextButton = document.getElementById("nextButton");
const prevButton = document.getElementById("prevButton");
const submitButton = document.getElementById("submitButton");

// Set minimum date for start date to today
const today = new Date().toISOString().split("T")[0];
document.getElementById("startDate").min = today;

// Update end date minimum when start date changes
document.getElementById("startDate").addEventListener("change", function (e) {
  document.getElementById("endDate").min = e.target.value;
});

function showStep(step) {
  document
    .querySelectorAll(".form-step")
    .forEach((el) => (el.style.display = "none"));
  document.getElementById(`step${step}`).style.display = "block";

  document.querySelectorAll(".step").forEach((el, index) => {
    el.classList.remove("active", "completed");
    if (index + 1 === step) {
      el.classList.add("active");
    } else if (index + 1 < step) {
      el.classList.add("completed");
    }
  });

  prevButton.style.display = step === 1 ? "none" : "block";
  nextButton.style.display = step === totalSteps ? "none" : "block";
  submitButton.style.display = step === totalSteps ? "block" : "none";
}

function validateStep(step) {
  let isValid = true;
  const inputs = document
    .getElementById(`step${step}`)
    .querySelectorAll("[required]");

  inputs.forEach((input) => {
    if (!input.value) {
      input.classList.add("error");
      isValid = false;
    } else {
      input.classList.remove("error");
    }
  });

  if (step === 2) {
    const startDate = new Date(document.getElementById("startDate").value);
    const endDate = new Date(document.getElementById("endDate").value);
    const goalAmount = parseFloat(document.getElementById("goalAmount").value);

    if (endDate <= startDate) {
      document.getElementById("endDate").classList.add("error");
      isValid = false;
    }

    if (goalAmount < 1000) {
      document.getElementById("goalAmount").classList.add("error");
      isValid = false;
    }
  }

  return isValid;
}

function updatePreview() {
  const preview = document.getElementById("campaignPreview");
  preview.innerHTML = `
                <div style="padding: 1rem; background: #f8f9fa; border-radius: var(--border-radius);">
                    <h3>${document.getElementById("title").value}</h3>
                    <p><strong>Goal:</strong> ₦${parseFloat(
                      document.getElementById("goalAmount").value
                    ).toLocaleString()}</p>
                    <p><strong>Duration:</strong> ${
                      document.getElementById("startDate").value
                    } to ${document.getElementById("endDate").value}</p>
                    <p><strong>Description:</strong> ${
                      document.getElementById("description").value
                    }</p>
                    <p><strong>Impact:</strong> ${
                      document.getElementById("impact").value
                    }</p>
                    <p><strong>Importance:</strong> ${
                      document.getElementById("importance").value
                    }</p>
                </div>
            `;
}

nextButton.addEventListener("click", () => {
  if (validateStep(currentStep)) {
    currentStep++;
    if (currentStep === totalSteps) {
      updatePreview();
    }
    showStep(currentStep);
  }
});

prevButton.addEventListener("click", () => {
  currentStep--;
  showStep(currentStep);
});

form.addEventListener("submit", function (e) {
  e.preventDefault();
  if (validateStep(currentStep)) {
    const formData = new FormData(form);

    // Show loading spinner
    $("#loadingSpinner").show();

    $.ajax({
      url: "../includes/user/create_campaign_handler",
      type: "POST",
      data: formData,
      processData: false,
      contentType: false,
      success: function (response) {
        if (response.success) {
          toastr.success(response.message);
          setTimeout(function () {
            window.location.href = "view_campaign?id=" + response.campaign_id;
          }, 1500);
        } else {
          toastr.error(response.message);
        }
      },
      error: function () {
        toastr.error("An error occurred. Please try again.");
      },
      complete: function () {
        $("#loadingSpinner").hide();
      },
    });
  }
});

// Configure toastr
toastr.options = {
  closeButton: true,
  progressBar: true,
  positionClass: "toast-top-right",
  timeOut: 3000,
};
// Initialize form
showStep(1);
