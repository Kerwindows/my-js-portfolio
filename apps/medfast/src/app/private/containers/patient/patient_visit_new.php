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
                            <h4>Ongoing Appointment</h4>
                        </div>
                    </div>
                     <div class="col-12">
                        <div class="input-block local-forms">
                            <label for="reason">Reason for Visit<span class="login-danger"></span></label>
                            <input id="reason" name="reason" class="form-control" type="text" placeholder="" value="<?php echo $array_var['current_user_info']['reason'] ?>" />
                        </div>
                    </div>
                    <div class="col-12 col-sm-12">
                        <div class="input-block local-forms">
                            <label for="summary">Chief Complaint<span class="login-danger">*</span></label>
                            <textarea id="summary" name="summary" class="form-control" rows="3" cols="30"><?php echo $array_var['current_user_info']['summary'] ?></textarea>
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
	              <div class="input-block ">
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
	                    <input  <?php $status = $array_var['current_user_info']['status']; echo in_array($status, ['Due', '', 'Complete']) ? 'checked' : ''; ?>
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
                        <div class="form-heading">
                            <h4>Vitals</h4>
                        </div>
                    </div>
	             <div class="col-12 col-md-3 col-xl-3">
                        <div class="input-block local-forms">
                            <label for="height">Height (cm)<span class="login-danger">*</span></label>
                            <input id="height" name="height" class="form-control" type="text" placeholder="" value="<?php echo $array_var['current_user_info']['height'] ?>"/>
                        </div>
                    </div>
                     <div class="col-12 col-md-3 col-xl-3">
                        <div class="input-block local-forms">
                            <label for="weight">Weight (lb)<span class="login-danger">*</span></label>
                            <input id="weight" name="weight" class="form-control" type="text" placeholder="" value="<?php echo $array_var['current_user_info']['weight'] ?>"/>
                        </div>
                    </div>
                    <div class="col-12 col-md-3 col-xl-3">
                        <div class="input-block local-forms">
                            <label for="temperature">Temperature (⁰C) <span class="login-danger">*</span></label>
                            <input id=temperature" name="temperature" class="form-control" type="text" placeholder="" value="<?php echo $array_var['current_user_info']['temperature'] ?>"/>
                        </div>
                    </div>
                    <div class="col-12 col-md-3 col-xl-3">
                        <div class="input-block local-forms">
                            <label for="sleep">Sleep (h:m) <span class="login-danger"></span>*</label>
                            <input id="sleep" name="sleep" class="form-control" type="text" placeholder="" value="<?php echo $array_var['current_user_info']['sleep'] ?>"/>
                        </div>
                    </div>
                    <div class="col-12 col-md-3 col-xl-3">
                        <div class="input-block local-forms">
                            <label for="blood_pressure">Blood Pressure (mm/Hg)<span class="login-danger">*</span></label>
                            <input id="blood_pressure" name="blood_pressure" class="form-control" type="text" placeholder="" value="<?php echo $array_var['current_user_info']['blood_pressure'] ?>"/>
                        </div>
                    </div>
                    <div class="col-12 col-md-3 col-xl-3">
                        <div class="input-block local-forms">
                            <label for="heart_rate">Heart Rate (bpm)<span class="login-danger">*</span></label>
                            <input id="heart_rate" name="heart_rate" class="form-control" type="text" placeholder="" value="<?php echo $array_var['current_user_info']['heart_rate'] ?>"/>
                        </div>
                    </div>
                    <div class="col-12 col-md-3 col-xl-3">
                        <div class="input-block local-forms">
                            <label for="glucose">Glucose (mg/dL)<span class="login-danger">*</span></label>
                            <input id="glucose" name="glucose" class="form-control" type="text" placeholder="" value="<?php echo $array_var['current_user_info']['glucose'] ?>"/>
                        </div>
                    </div>
                    <div class="col-12 col-md-3 col-xl-3">
                        <div class="input-block local-forms">
                            <label for="cholesterol">Cholesterol (mg/dL)<span class="login-danger">*</span></label>
                            <input id="cholesterol" name="cholesterol" class="form-control" type="text" placeholder="" value="<?php echo $array_var['current_user_info']['cholesterol'] ?>"/>
                        </div>
                    </div>
                     <div class="col-12 col-md-4 col-xl-4">
                        <div class="input-block local-forms">
                            <label for="notes">Notes<span class="login-danger"></span></label>
                            <textarea id="notes" name="notes" class="form-control" rows="3" cols="30"><?php echo $array_var['current_user_info']['visit_notes'] ?></textarea>
                        </div>
                    </div>
                     <div class="col-12 col-md-4 col-xl-4">
                        <div class="input-block local-forms">
                            <label for="inventory_request">Inventory Request<span class="login-danger"></span></label>
                            <textarea id="inventory_request" name="inventory_request" class="form-control" rows="3" cols="30"><?php echo $array_var['current_user_info']['inventory_request'] ?></textarea>
                        </div>
                    </div>
                    <div class="col-12 col-md-4 col-xl-4">
                        <div class="input-block local-forms">
                            <label for="inventory_result">Inventory Result<span class="login-danger"></span></label>
                            <textarea id="inventory_result" name="inventory_result" class="form-control" rows="3" cols="30"><?php echo $array_var['current_user_info']['inventory_result'] ?></textarea>
                        </div>
                    </div>
                    <div class="col-12 col-md-4 col-xl-4">
                        <div class="input-block local-forms">
                            <label for="diagnosis">Diagnosis<span class="login-danger"></span></label>
                            <textarea id="diagnosis" name="diagnosis" class="form-control" rows="3" cols="30"><?php echo $array_var['current_user_info']['diagnosis'] ?></textarea>
                        </div>
                    </div>
                    <div class="col-12 col-md-4 col-xl-4">
                        <div class="input-block local-forms">
                            <label for="treatment">Treatment<span class="login-danger"></span></label>
                            <textarea id="treatment" name="treatment" class="form-control" rows="3" cols="30"><?php echo $array_var['current_user_info']['treatment'] ?></textarea>
                        </div>
                    </div>
                    
                     <div class="col-12 col-md-4 col-xl-4">
                        <div class="input-block local-forms select-icon">
                            <label for="did">Seen by<span class="login-danger">*</span></label>
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
                    <input hidden class="conditionalInput" type="text" name="uid"  value="<?php echo $array_var['current_user_info']['patient_uid'] ?>"/>
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
document.addEventListener("DOMContentLoaded", function() {
// Get the select element by its ID
    
    const inputFields = document.querySelectorAll('.conditionalInput');
    const condition = true;  // This could be dynamic based on some server-side condition passed to JS

    // Making inputs readonly based on a condition
    inputFields.forEach(inputField => {
        if (condition) {
            inputField.setAttribute('readonly', true);
        }
    });

    // Validation rules object
    const validationRules = {
        start_date: {
            required: true,
            regex: /^\d{4}-\d{2}-\d{2}T\d{2}:\d{2}$/,
            message: {
                required: "Please enter a start date",
                regex: "Please enter a valid start date in the correct format"
            }
        },
        end_date: {
            required: true,
            regex: /^\d{4}-\d{2}-\d{2}T\d{2}:\d{2}$/,
            message: {
                required: "Please enter an end date",
                regex: "Please enter a valid end date in the correct format"
            }
        },
        reason: {
            required: true,
            minlength: 2,
            message: {
                required: "Please enter a reason for the visit",
                minlength: "Reason must be at least 2 characters long"
            }
        },
        summary: {
            required: true,
            minlength: 2,
            message: {
                required: "Please write a summary of the complaint",
                minlength: "Summary must be at least 2 characters long"
            }
        },
         blood_pressure: {
            required: true,
            regex : /^\d{1,3}\/\d{1,3}$/,
            message: {
                required: "Blood pressure required",
                regex: "Blood pressure must be in a numerical value the format xx/yy"
            }
        },
         sleep: {
            required: true,
            regex : /^(2[0-3]|[01]?[0-9]):([0-5]?[0-9])$/,
            message: {
                required: "Average sleep is required",
                regex: "Sleep must be in the format hr:min"
            }
        },
        weight: {
           required: true,
	    regex : /^(?:[1-9]\d{0,2}|0)$/,
	     message: {
                required: "Weight is is required",
                regex: "Weight must be a numerial value"
            }
        },
        height: {
           required: true,
	    regex : /^(?:[1-9]\d{0,2}|0)$/,
	     message: {
                required: "Height is is required",
                regex: "Height must be a numerial value"
            }
        },
        glucose: {
           required: true,
	    regex : /^(?:[1-9]\d{0,2}|0)$/,
	     message: {
	        required: "Glucose is is required",
                regex: "Glucose must be a numerial value"
            }
        },
        temperature: {
           required: true,
	    regex : /^(?:[1-9]\d{0,2}|0)$/,
	     message: {
	     required: "Temperature is is required",
                regex: "Temperature must be a numerial value"
            }
        },
       
        heart_rate: {
           required: true,
	    regex : /^(?:[1-9]\d{0,2}|0)$/,
	     message: {
	     required: "Heart rate is is required",
                regex: "Heart rate must be a numerical value"
            }
        },
        cholesterol: {
           required: true,
	    regex : /^(?:[1-9]\d{0,2}|0)$/,
	     message: {
	     required: "Cholesterol is is required",
                regex: "Cholesterol must be a numerical value"
            }
        },
        did: {
           required: true,
	    regex : /^[a-zA-Z0-9]+$/,
	     message: {
	     required: "Doctor selection is is required",
                regex: "Doctor is invalid"
            }
        },
        
    };
    
    const currentUrl = window.location.href; // Gets the current page URL
    const segments = currentUrl.split('/'); // Splits the URL by '/'
    const lastSegment = segments.pop() || segments.pop(); // Gets the last part
    const form = document.getElementById("userForm");
    const cancelButton = document.querySelector('.cancel-form');
    const startDateElement = document.getElementById("start_date");
    const endDateElement = document.getElementById("end_date");

    // Automatically calculate and set end date when start date changes
    startDateElement.addEventListener('change', function() {
        const startTime = this.value;
        const startDate = new Date(startTime);
        startDate.setMinutes(startDate.getMinutes() + 30);

        const year = startDate.getFullYear();
        const month = ('0' + (startDate.getMonth() + 1)).slice(-2);
        const day = ('0' + startDate.getDate()).slice(-2);
        const hours = ('0' + startDate.getHours()).slice(-2);
        const minutes = ('0' + startDate.getMinutes()).slice(-2);

        const newEndTime = `${year}-${month}-${day}T${hours}:${minutes}`;
        endDateElement.value = newEndTime;
    });

     addRealTimeValidation(form, validationRules); // Attach real-time validation

        form.addEventListener("submit", function(e) {
            e.preventDefault(); // Prevent the default form submission

            const isFormValid = validateForm(form, validationRules);

            if (isFormValid) {
                // If form is valid, proceed with the submission logic
                validateAndSubmitForm("userForm", `${base_url}/ajax/new-visit?id=${lastSegment}`);
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
</script>