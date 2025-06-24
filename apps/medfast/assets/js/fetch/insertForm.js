// Modified the initial validation setup to use validateField inside validateForm
function validateForm(form, rules) {
    let isValid = true;
    Object.keys(rules).forEach(function(name) {
        const input = form.elements[name];
        if (!input) {
            console.error("Input not found:", name);
            return;
        }
        // Use validateField function to validate and potentially show errors
        const errorMessage = validateField(input, rules[name]);
        if (errorMessage) {
            showError(input, errorMessage); // Show error if validation fails during form submission
            isValid = false;
        }
    });

    return isValid;
}


function validateField(input, rule) {
    let errorMessage = '';
    if (rule.required && !input.value.trim()) {
        errorMessage = rule.message.required;
    } else if (rule.regex && !rule.regex.test(input.value.trim())) {
        errorMessage = rule.message.regex;
    } else if (rule.minlength && input.value.length < rule.minlength) {
        errorMessage = rule.message.minlength;
    }

    if (errorMessage) {
        return errorMessage; // Return the error message if validation fails
    } else {
        clearError(input); // Clear the error if validation passes
        return ""; // Return an empty string if there is no error
    }
}



function showError(input, message) {
    input.classList.add('input-error'); // Add class to input

    let errorSpan = input.nextElementSibling;

    if (!errorSpan || errorSpan.className !== 'error-message') {
        errorSpan = document.createElement('span');
        errorSpan.className = 'error-message';
        input.parentNode.insertBefore(errorSpan, input.nextSibling);
    }

    errorSpan.textContent = message;
}

function clearError(input) {
    input.classList.remove('input-error'); // Remove class from input

    let errorSpan = input.nextElementSibling;

    if (errorSpan && errorSpan.className === 'error-message') {
        errorSpan.remove();
    }
}

function addRealTimeValidation(form, rules) {
    Object.keys(rules).forEach(function(name) {
        const input = form.elements[name];
        if (!input) return; // Skip if input not found

        input.addEventListener('input', function() {
            // Validate the field in real-time but only clear errors, don't show them
            validateField(input, rules[name]);
        });
    });
}


function clearAllErrors(form) {
    const inputs = form.querySelectorAll('input, select, textarea');
    inputs.forEach(input => {
        clearError(input); // Assuming clearError function removes error messages and classes
    });
}

function validateAndSubmitForm(formId, fetchUrl) {
  const form = document.getElementById(formId);
  if (!form) {
    console.error("Form not found:", formId);
    return;
  }
    // Form is valid, proceed with submission
    const formData = new FormData(form);
    fetch(fetchUrl, {
      method: "POST",
      body: formData,
    })
    .then(response => response.json())
      .then(data => {
	  if (data.success) {
	    Swal.fire({
	      toast: true,
	      position: "top-end",
	      showConfirmButton: false,
	      timer: 3000,
	      timerProgressBar: true,
	      icon: "success",
	      title: data.message,
	    });
	     if (!data.isUpdate) {
            form.reset();
        }
	  } else {
	    if (data.errors && typeof data.errors === 'object') {
	      // Convert object entries to an array, then reverse it
	      const errorsArray = Object.entries(data.errors).reverse();
	      
	      // Now iterate over the reversed array to show errors in reverse order
	      errorsArray.forEach(([field, errors]) => {
	        errors.reverse(); // Also reverse the individual errors array if needed
	        errors.forEach(error => {
	          Swal.fire({
	            toast: true,
	            position: "top-end",
	            showConfirmButton: false,
	            timer: 3000, // Consider adjusting time based on the number of errors
	            timerProgressBar: true,
	            icon: "error",
	            title: `${error}`,
	          });
	        });
	      });
	    } else {
	      // Fallback for unexpected error format
	      Swal.fire({
	        toast: true,
	        position: "top-end",
	        showConfirmButton: false,
	        timer: 3000,
	        timerProgressBar: true,
	        icon: "error",
	        title: data.message || 'An unknown error occurred.',
	      });
	    }
	  }
	})
  
}