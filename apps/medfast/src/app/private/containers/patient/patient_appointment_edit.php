<style>
    /*fix select2 error*/
    .input-block.local-forms .select2.select2-container.select2-container--default:last-of-type {
        display: none;
    }

    .error-message {
        width: 100%;
        margin-top: .25rem;
        font-size: 80%;
        color: #dc3545;
    }

    .input-error {
        border-color: #dc3545;
        padding-right: 2.25rem;
        background-image: url(data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' width='12' height='12' fill='none' stroke='%23dc3545' viewBox='0 0 12 12'%3e%3ccircle cx='6' cy='6' r='4.5'/%3e%3cpath stroke-linejoin='round' d='M5.8 3.6h.4L6 6.5z'/%3e%3ccircle cx='6' cy='8.2' r='.6' fill='%23dc3545' stroke='none'/%3e%3c/svg%3e);
        background-repeat: no-repeat;
        background-position: right calc(.375em + .1875rem) center;
        background-size: calc(.75em + .375rem) calc(.75em + .375rem);
        box-shadow: 0 0 0 0 rgba(220, 53, 69, .25);
    }

    .cal-icon:after {
        margin: 10px auto;
    }
.select-icon {
	position: relative;
	width: 100%;
}
.select-icon:after {
    background: transparent url('/assets/img/icons/select-icon.svg') no-repeat scroll 0 0;
    bottom: 0;
    content: "";
    display: block;
    height: 24px;
    margin: auto;
     margin: 10px auto;
    position: absolute;
    right: 15px;
    top: 0;
    width: 24px;
    cursor: pointer;
}

</style>
<div class="col-sm-12">
    <div class="card">
        <div class="card-body">
            <form id="userForm" method="POST" enctype="multipart/form-data">
                <div class="row">
                    <div class="col-12">
                        <div class="form-heading">
                            <h4>Appointment Details</h4>
                        </div>
                    </div>
                    <div class="col-12 col-md-4 col-xl-4">
                        <div class="input-block local-forms">
                            <label for="start_date">Start Time<span class="login-danger">*</span></label>
                            <input id="start_date" class="form-control" type="datetime-local" placeholder="" name="start_date" value="<?php echo $array_var['current_user_info']['start_date'] ?>" />
                        </div>
                    </div>
                    <div class="col-12 col-md-4 col-xl-4">
                        <div class="input-block local-forms">
                            <label for="end_date">End Time <span class="login-danger">*</span></label>
                            <input id="end_date" class="form-control" type="datetime-local" placeholder="" name="end_date" value="<?php echo $array_var['current_user_info']['end_date'] ?>"/>
                        </div>
                    </div>
                    <div class="col-12 col-md-4 col-xl-4">
                        <div class="input-block local-forms select-icon">
                            <label for="did">Consulting Doctor <span class="login-danger">*</span></label>
                            <select id="did" name="did" class="form-control">
                                <option value="">Select Doctor</option>
                                <?php foreach($array_var['doctors_array'] as $doctor){ 
                                if($doctor['uid'] === $array_var['current_user_info']['doctor_id'] ){
	                                $selected = 'selected';
	                                }else{
	                                $selected = '';
	                                }
                                echo "<option $selected value='{$doctor['uid']}'>{$doctor['title']} {$doctor['fname']} {$doctor['lname']}</option>";
                                } ?>
                            </select>
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="input-block local-forms">
                            <label for="reason">Reason<span class="login-danger"></span></label>
                            <input id="reason" name="reason" class="form-control" type="text" placeholder="" value="<?php echo $array_var['current_user_info']['reason'] ?>"/>
                        </div>
                    </div>
                    <div class="col-12 col-sm-12">
                        <div class="input-block local-forms">
                            <label for="summary">Notes<span class="login-danger">*</span></label>
                            <textarea id="summary" name="summary" class="form-control" rows="3" cols="30"><?php echo $array_var['current_user_info']['summary'] ?></textarea>
                        </div>
                    </div>
                     <div class="col-12 col-md-4 col-xl-4">
	              <div class="input-block select-gender">
	                <label for="status" class="gen-label"
	                  >Mark as missed<span class="login-danger">*</span></label
	                >
	                <div class="form-check-inline">
	                    <input id="status" <?php echo $array_var['current_user_info']['status'] === 'Missed' ? '' : 'checked' ?> 
	                      value="Missed"
	                      type="radio"
	                      name="status"
	                      class="form-check-input require"
	                    />Yes
	                </div>
	                <div class="form-check-inline">
	                    <input <?php $status = $array_var['current_user_info']['status']; echo in_array($status, ['Due', '', 'Complete']) ? 'checked' : ''; ?>
	                      value="Due"
	                      type="radio"
	                      name="status"
	                      class="form-check-input"
	                    />No
	                </div>
	                <div class="form-check-inline">
	                    <input <?php echo $array_var['current_user_info']['status'] === 'Cancelled' ? 'checked' : '' ?>
	                      value="Cancelled"
	                      type="radio"
	                      name="status"
	                      class="form-check-input"
	                    />Cancelled
	                </div>
	              </div>
	            </div>
                    <div class="col-12">
                        <div class="doctor-submit text-end">
                            <button type="submit" class="btn btn-primary submit-form me-2">
                                Save
                            </button>
                            <button type="button" class="btn btn-primary cancel-form">
                                Cancel
                            </button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

<script nonce="<?= htmlspecialchars($_SESSION['nonce']); ?>">
    const validationRules = {
        start_date: {
            required: true,
            regex: /^\d{4}-\d{2}-\d{2}T\d{2}:\d{2}(?::\d{2})?$/,
            message: {
                required: "Please enter a start date",
                regex: "Please enter a valid start date"
            }
        },
        end_date: {
            required: true,
            regex: /^\d{4}-\d{2}-\d{2}T\d{2}:\d{2}(?::\d{2})?$/,
            message: {
                required: "Please enter a end date",
                minlength: "Please enter a valid end date"
            }
        },
        did: {
            required: true,
            message: {
                required: "Please select a doctor"
            }
        },
        reason: {
            required: true,
            minlength: 2,
            message: {
                required: "Please enter a reason",
                minlength: "Reason must be at least 2 characters long"
            }
        },
        summary: {
            required: true,
            minlength: 2,
            message: {
                required: "Please write a summary",
                minlength: "Summary must be at least 2 characters long"
            }
        },
    };


    document.addEventListener("DOMContentLoaded", function() {
        const form = document.getElementById("userForm");
        const cancelButton = document.querySelector('.cancel-form');
        
        const currentUrl = window.location.href; // Gets the current page URL
	const segments = currentUrl.split('/'); // Splits the URL by '/'
	const lastSegment = segments.pop() || segments.pop(); // Gets the last part
   	const startDateElement = document.getElementById("start_date");

    // Attach the 'change' event listener to the start_date element
    startDateElement.addEventListener('change', function() {
        // Get the value of the start_date input
        var startTime = this.value;

        // Check if startTime is not empty
        if (startTime) {
            // Convert startTime to a Date object
            var startDate = new Date(startTime);

            // Add 30 minutes to startDate
            startDate.setMinutes(startDate.getMinutes() + 30);

            // Format the new end date back to a string in the datetime-local format
            var year = startDate.getFullYear();
            var month = ('0' + (startDate.getMonth() + 1)).slice(-2); // Add leading 0 and slice to ensure MM format
            var day = ('0' + startDate.getDate()).slice(-2); // Add leading 0 and slice to ensure DD format
            var hours = ('0' + startDate.getHours()).slice(-2); // Add leading 0 and slice to ensure HH format
            var minutes = ('0' + startDate.getMinutes()).slice(-2); // Add leading 0 and slice to ensure MM format

            var newEndTime = `${year}-${month}-${day}T${hours}:${minutes}`;

            // Update the end_date input's value to the new end time
            document.getElementById("end_date").value = newEndTime;
        }
    });


        addRealTimeValidation(form, validationRules); // Attach real-time validation

        form.addEventListener("submit", function(e) {
            e.preventDefault(); // Prevent the default form submission

            const isFormValid = validateForm(form, validationRules);

            if (isFormValid) {
                // If form is valid, proceed with the submission logic
                validateAndSubmitForm("userForm", `${base_url}/ajax/edit_appointment?id=${lastSegment}`);
            }
        });

        // Event listener for the cancel button
        if (cancelButton) {
            cancelButton.addEventListener('click', function(e) {
                e.preventDefault(); // Prevent any default action
                form.reset(); // Reset the form
                clearAllErrors(form); // Clear all validation errors
            });
        }
    });
    
    
    
    document.addEventListener("DOMContentLoaded", function() {
    // Get the select element by its ID
    var selectElement = document.getElementById("did");

    // Attach the 'change' event listener to the select element
    selectElement.addEventListener('change', function() {
        // Get the selected option's value
        var selectedValue = this.value;
    });
});
</script>