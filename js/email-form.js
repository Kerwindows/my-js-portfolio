document.addEventListener("DOMContentLoaded", function () {
    const emailForm = document.getElementById("email-form");
    const submitBtn = document.getElementById("submit-btn");
    const statusMessage = document.getElementById("status-message");
    const loadingAnimation = document.getElementById("loading-animation");
    const successMessage = document.getElementById("success-message");
    let formSubmitted = false;

    // Function to check character limit and show a message if the limit is exceeded
    function checkCharacterLimit(input) {
        const charLimit = parseInt(input.getAttribute("data-char-limit"), 10); // New attribute for character limit
        const charCount = input.value.length;
        if (charCount > charLimit) {
            statusMessage.textContent = `Exceeded character limit: ${charLimit} characters max.`;
            statusMessage.classList.add("error");
            return false;
        }
        statusMessage.textContent = "";
        statusMessage.classList.remove("error");
        return true;
    }

    // Check character limits as user types
    ["input", "textarea"].forEach(selector => {
        document.querySelectorAll(selector).forEach(input => {
            input.addEventListener("input", () => checkCharacterLimit(input));
        });
    });

    // Handle form submission
    emailForm.addEventListener("submit", async function (e) {
        e.preventDefault();

        if (
            formSubmitted || 
            !checkCharacterLimit(document.getElementById("name")) || 
            !checkCharacterLimit(document.getElementById("message"))
        ) {
            return;
        }

        formSubmitted = true;

        // Show loading animation
        emailForm.style.display = "none";
        loadingAnimation.style.display = "block";

        const formData = new FormData(emailForm);

        try {
            const response = await fetch("promises/send_email.php", {
                method: "POST",
                body: formData
            });

            if (response.ok) {
                // Show success message
                loadingAnimation.style.display = "none";
                successMessage.style.display = "block";
            } else {
                throw new Error("Failed to send message.");
            }
        } catch (error) {
            loadingAnimation.style.display = "none";
            statusMessage.textContent = "Error sending message. Please try again.";
            statusMessage.classList.add("error");
            emailForm.style.display = "block";
            formSubmitted = false;
        }
    });
});