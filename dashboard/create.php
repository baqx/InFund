<?php
session_start();
$page_title = "Create Campaign";
$page = "Campaigns";
$css1 = "create-campaign";
include '../includes/user/nav.php'; ?>


<main class="main-content">

    <form class="form-card" id="campaignForm" enctype="multipart/form-data">
        <div class="form-header">
            <h1 class="form-title">Create a New Campaign</h1>
            <p class="form-subtitle">Share your story and start raising funds</p>
        </div>

        <div class="progress-steps">
            <div class="step active">1</div>
            <div class="step">2</div>
            <div class="step">3</div>
        </div>

        <!-- Step 1: Basic Information -->
        <div class="form-step" id="step1">
            <div class="form-group">
                <label class="form-label" for="title">Campaign Title*</label>
                <input type="text" id="title" name="title" class="form-input" required maxlength="255" placeholder="Enter a clear, descriptive title">
                <div class="form-hint">Make it specific and memorable</div>
                <div class="error-message">Title is required</div>
            </div>

            <div class="form-group">
                <label class="form-label" for="description">Campaign Description*</label>
                <textarea id="description" name="description" class="form-input" required placeholder="Describe your campaign in detail"></textarea>
                <div class="form-hint">Include specific details about your campaign</div>
                <div class="error-message">Description is required</div>
            </div>

            <div class="form-group">
                <label class="form-label" for="impact">Campaign Impact</label>
                <textarea id="impact" name="impact" class="form-input" placeholder="How will this campaign make a difference?"></textarea>
                <div class="form-hint">Explain the potential impact of your campaign</div>
            </div>
            <div class="form-group">
                <label class="form-label" for="image1">Campaign Image 1 (Required)*</label>
                <input type="file" id="image1" name="image1" class="form-input" required accept="image/*">
                <div class="form-hint">Upload a clear image representing your campaign</div>
                <div class="error-message">Image is required</div>
            </div>

            <div class="form-group">
                <label class="form-label" for="image2">Campaign Image 2 (Optional)</label>
                <input type="file" id="image2" name="image2" class="form-input" accept="image/*">
                <div class="form-hint">Upload an additional image (optional)</div>
            </div>

            <div class="form-group">
                <label class="form-label" for="image3">Campaign Image 3 (Optional)</label>
                <input type="file" id="image3" name="image3" class="form-input" accept="image/*">
                <div class="form-hint">Upload another image (optional)</div>
            </div>

            <div class="form-group">
                <label class="form-label" for="image4">Campaign Image 4 (Optional)</label>
                <input type="file" id="image4" name="image4" class="form-input" accept="image/*">
                <div class="form-hint">Upload one more image (optional)</div>
            </div>
        </div>

        <!-- Step 2: Campaign Details -->
        <div class="form-step" id="step2" style="display: none;">
            <div class="form-group">
                <label class="form-label" for="importance">Campaign Importance</label>
                <textarea id="importance" name="importance" class="form-input" placeholder="Why is this campaign important?"></textarea>
                <div class="form-hint">Explain why people should support your campaign</div>
            </div>

            <div class="form-group">
                <label class="form-label" for="goalAmount">Goal Amount*</label>
                <div class="input-addon">
                    <span class="input-addon-text">₦</span>
                    <input type="number" id="goalAmount" name="goalAmount" class="form-input" required min="1000" step="100" placeholder="Enter target amount">
                </div>
                <div class="form-hint">Minimum amount is ₦1,000</div>
                <div class="error-message">Goal amount must be at least ₦1,000</div>
            </div>

            <div class="form-row">
                <div class="form-group">
                    <label class="form-label" for="startDate">Start Date*</label>
                    <input type="date" id="startDate" name="startDate" class="form-input" required>
                    <div class="error-message">Start date is required</div>
                </div>

                <div class="form-group">
                    <label class="form-label" for="endDate">End Date*</label>
                    <input type="date" id="endDate" name="endDate" class="form-input" required>
                    <div class="error-message">End date must be after start date</div>
                </div>
            </div>
        </div>

        <!-- Step 3: Review & Submit -->
        <div class="form-step" id="step3" style="display: none;">
            <div class="form-group">
                <h2>Review Your Campaign</h2>
                <div id="campaignPreview" class="form-preview">
                    <!-- Preview content will be inserted here -->
                </div>
            </div>
        </div>

        <div class="form-buttons">
            <button type="button" class="form-button button-secondary" id="prevButton" style="display: none;">Previous</button>
            <button type="button" class="form-button button-primary" id="nextButton">Next</button>
            <button type="submit" class="form-button button-primary" id="submitButton" style="display: none;">Create Campaign</button>
        </div>
    </form>

</main>

<div id="loadingSpinner" style="display: none; position: fixed; top: 0; left: 0; right: 0; bottom: 0; background: rgba(0,0,0,0.5); z-index: 9999;">
    <div style="position: absolute; top: 50%; left: 50%; transform: translate(-50%, -50%);">
        <div class="spinner-border text-light" role="status">
            <span class="visually-hidden">Loading...</span>
        </div>
    </div>
</div>
<?php
$js1 = "create";
include '../includes/user/footer.php';
?>