<style>
    /*fix select2 error*/
    .input-block.local-forms
      .select2.select2-container.select2-container--default:last-of-type {
      display: none;
    }
    .error-message{
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
    box-shadow: 0 0 0 0 rgba(220,53,69,.25);
}
.cal-icon:after {
    margin: 10px auto;
    }
  </style>
  
  <div class="col-sm-12">
    <div class="card">
      <div class="card-body">
        <form id="userForm" method="POST" enctype="multipart/form-data">
          <div class="row">
            <div class="col-12">
              <div class="form-heading">
                <h4>Patient Details</h4>
              </div>
            </div>
            <div class="col-12 col-md-6 col-xl-4">
              <div class="input-block local-forms">
                <label for="fname">First Name <span class="login-danger">*</span></label>
                <input id="fname"
                  name="fname"
                  class="form-control require"
                  type="text"
                  placeholder=""
                />
              </div>
            </div>
            <div class="col-12 col-md-6 col-xl-4">
              <div class="input-block local-forms">
                <label for="mname">Middle Name</label>
                <input id="mname"
                  name="mname"
                  class="form-control"
                  type="text"
                  placeholder=""
                />
              </div>
            </div>
            <div class="col-12 col-md-6 col-xl-4">
              <div class="input-block local-forms">
                <label for="lname">Last Name <span class="login-danger">*</span></label>
                <input id="lname"
                  name="lname"
                  class="form-control require"
                  type="text"
                  placeholder=""
                />
              </div>
            </div>
            <div class="col-12 col-md-6 col-xl-4">
              <div class="input-block local-forms">
                <label for="alias">Alias</label>
                <input id="alias"
                  name="alias"
                  class="form-control"
                  type="text"
                  placeholder=""
                />
              </div>
            </div>
            <div class="col-12 col-md-4 col-xl-4">
              <div class="input-block local-forms cal-icon">
                <label for="dob">Date Of Birth <span class="login-danger">*</span></label>
                <input id="dob"
                  class="form-control datetimepicker require"
                  type="text"
                  placeholder=""
                  name="dob"
                />
              </div>
            </div>
            <div class="col-12 col-md-4 col-xl-4">
              <div class="input-block select-gender">
                <label for="gender" class="gen-label"
                  >Gender<span class="login-danger">*</span></label
                >
                <div class="form-check-inline">
                    <input id="gender"
                      value="Male"
                      type="radio"
                      name="sex"
                      class="form-check-input require"
                    />Male
                </div>
                <div class="form-check-inline">
                    <input
                      value="Female"
                      type="radio"
                      name="sex"
                      class="form-check-input"
                    />Female
                </div>
              </div>
            </div>
            <div class="col-12 col-md-4 col-xl-4">
              <div class="input-block local-forms">
                <label for="blood_type">Blood Type<span class="login-danger">*</span></label>
                <input id="blood_type"
                  class="form-control require"
                  type="text"
                  placeholder=""
                  name="blood_type"
                />
              </div>
            </div>
            <div class="col-12 col-md-4 col-xl-4">
              <div class="input-block local-forms">
                <label for="ethnicity">Ethnicity <span class="login-danger">*</span></label>
                <input id="ethnicity"
                  name="ethnicity"
                  class="form-control require"
                  type="text"
                  placeholder=""
                />
              </div>
            </div>
            <div class="col-12 col-md-4 col-xl-4">
              <div class="input-block local-forms">
                <label for="phone">Mobile <span class="login-danger">*</span></label>
                <input id="phone"
                  class="form-control require"
                  name="phone"
                  type="text"
                  placeholder=""
                  
                />
              </div>
            </div>
            <div class="col-12 col-md-4 col-xl-4">
              <div class="input-block local-forms">
                <label for="email">Email <span class="login-danger
  ">*</span></label>
                <input id="email"
                  name="email"
                  class="form-control require"
                  type="email"
                  placeholder=""
                                />
              </div>
            </div>
            <div class="col-12 col-md-6 col-xl-6">
              <div class="input-block local-forms">
                <label for="address">Address<span class="login-danger"></span></label>
                <input id="address"
                  name="address"
                  class="form-control require"
                  type="text"
                  placeholder=""
                />
              </div>
            </div>
            <div class="col-12 col-md-6 col-xl-3">
              <div class="input-block local-forms">
                <label for="town">Town/Village <span class="login-danger">*</span></label>
                <select id="town"
                  name="town" 
                  class="form-control require select select2-hidden-accessible"
                  tabindex="-1"
                  aria-hidden="true"
                >
                  <option>Select Town</option>
                  <option>Enterprise</option>
                  <option>Arouca</option></select
                ><span
                  class="select2 select2-container select2-container--default"
                  dir="ltr"
                  style="width: 100%"
                  ><span class="selection"
                    ><span
                      class="select2-selection select2-selection--single"
                      role="combobox"
                      aria-haspopup="true"
                      aria-expanded="false"
                      tabindex="0"
                      aria-labelledby="select2-zfce-container"
                      ><span
                        class="select2-selection__rendered"
                        id="select2-zfce-container"
                        title="Select State"
                        >Select State</span
                      ><span class="select2-selection__arrow" role="presentation"
                        ><b role="presentation"></b></span></span></span
                  ><span class="dropdown-wrapper" aria-hidden="true"></span
                ></span>
              </div>
            </div>
            <div class="col-12 col-md-6 col-xl-3">
              <div class="input-block local-forms">
                <label for="city">City <span class="login-danger">*</span></label>
                <select id="city"
                  name="city"
                  class="form-control require select select2-hidden-accessible"
                  tabindex="-1"
                  aria-hidden="true"
                >
                  <option>Select City</option>
                  <option>Arima</option>
                  <option>Chaguanas</option></select
                ><span
                  class="select2 select2-container select2-container--default"
                  dir="ltr"
                  style="width: 100%"
                  ><span class="selection"
                    ><span
                      class="select2-selection select2-selection--single"
                      role="combobox"
                      aria-haspopup="true"
                      aria-expanded="false"
                      tabindex="0"
                      aria-labelledby="select2-6a31-container"
                      ><span
                        class="select2-selection__rendered"
                        id="select2-6a31-container"
                        title="Select City"
                        >Select City</span
                      ><span class="select2-selection__arrow" role="presentation"
                        ><b role="presentation"></b></span></span></span
                  ><span class="dropdown-wrapper" aria-hidden="true"></span
                ></span>
              </div>
            </div>
            <div class="col-12 col-md-6 col-xl-3">
              <div class="input-block local-forms">
                <label for="country">Country <span class="login-danger">*</span></label>
                <select id="country"
                  name="country"
                  class="form-control require select select2-hidden-accessible"
                  tabindex="-1"
                  aria-hidden="true"
                >
                  <option>Select Country</option>
                  <option>Trinidad and Tobago</option>
                  <option>Grenada</option>
                  <option>Guyana</option></select
                ><span
                  class="select2 select2-container select2-container--default"
                  dir="ltr"
                  style="width: 100%"
                  ><span class="selection"
                    ><span
                      class="select2-selection select2-selection--single"
                      role="combobox"
                      aria-haspopup="true"
                      aria-expanded="false"
                      tabindex="0"
                      aria-labelledby="select2-y5fr-container"
                      ><span
                        class="select2-selection__rendered"
                        id="select2-y5fr-container"
                        title="Select Country "
                        >Select Country </span
                      ><span class="select2-selection__arrow" role="presentation"
                        ><b role="presentation"></b></span></span></span
                  ><span class="dropdown-wrapper" aria-hidden="true"></span
                ></span>
              </div>
            </div>
  
            <div class="col-12 col-md-6 col-xl-3">
              <div class="input-block local-forms">
                <label for="postal_code">Postal Code <span class="login-danger">*</span></label>
                <input id="postal_code"
                  name="postal_code"
                  class="form-control require"
                  type="text"
                  placeholder=""
                />
              </div>
            </div>
            <div class="col-12 col-md-4 col-xl-4">
              <div class="input-block local-forms">
                <label>Religion <span class="login-danger">*</span></label>
                <input
                  name="religion"
                  class="form-control"
                  type="text"
                  placeholder=""
                />
              </div>
            </div>
            <div class="col-12 col-md-4 col-xl-4">
              <div class="input-block local-forms">
                <label for="union_status">Union Status<span class="login-danger"></span></label>
                <input id="union_status"
                  name="union_status"
                  class="form-control require"
                  type="text"
                  placeholder=""
                />
              </div>
            </div>
  
            <div class="col-12 col-md-4 col-xl-4">
              <div class="input-block local-forms">
                <label>Occupation <span class="login-danger">*</span></label>
                <input
                  name="occupation"
                  class="form-control"
                  type="text"
                  placeholder=""
                />
              </div>
            </div>
            <div class="col-12 col-md-4 col-xl-4">
              <div class="input-block local-forms">
                <label
                  >Next of Kin First Name <span class="login-danger"></span
                ></label>
                <input
                  name="next_of_kin_fame"
                  class="form-control"
                  type="text"
                  placeholder=""
                />
              </div>
            </div>
            <div class="col-12 col-md-4 col-xl-4">
              <div class="input-block local-forms">
                <label
                  >Next of Kin Last Name <span class="login-danger"></span
                ></label>
                <input
                  name="next_of_kin_lame"
                  class="form-control"
                  type="text"
                  placeholder=""
                />
              </div>
            </div>
            <div class="col-12 col-md-4 col-xl-4">
              <div class="input-block local-forms">
                <label
                  >Next of Kin Relationship<span class="login-danger"></span
                ></label>
                <input
                  name="next_of_kin_relationship"
                  class="form-control"
                  type="text"
                  placeholder=""
                />
              </div>
            </div>
            <div class="col-12 col-md-4 col-xl-4">
              <div class="input-block local-forms">
                <label
                  >Next of Kin Telephone<span class="login-danger"></span
                ></label>
                <input
                  name="next_of_kin_phone"
                  class="form-control"
                  type="text"
                  placeholder=""
                />
              </div>
            </div>
            <div class="col-12 col-md-4 col-xl-4">
              <div class="input-block local-forms">
                <label
                  >Mother's Maiden Name<span class="login-danger"></span
                ></label>
                <input
                  name="mother_maiden_name"
                  class="form-control"
                  type="text"
                  placeholder=""
                />
              </div>
            </div>
            <div class="col-12 col-md-4 col-xl-4">
              <div class="input-block local-forms">
                <label
                  >Emergency Contact First Name<span class="login-danger"></span
                ></label>
                <input
                  name="emergency_contact_fname"
                  class="form-control"
                  type="text"
                  placeholder=""
                />
              </div>
            </div>
            <div class="col-12 col-md-4 col-xl-4">
              <div class="input-block local-forms">
                <label
                  >Emergency Contact Last Name<span class="login-danger"></span
                ></label>
                <input
                  name="emergency_contact_lname"
                  class="form-control"
                  type="text"
                  placeholder=""
                />
              </div>
            </div>
            <div class="col-12 col-md-4 col-xl-4">
              <div class="input-block local-forms">
                <label
                  >Emergency Contact Relationship<span class="login-danger"></span
                ></label>
                <input
                  name="emergency_contact_relationship"
                  class="form-control"
                  type="text"
                  placeholder=""
                />
              </div>
            </div>
            <div class="col-12 col-md-4 col-xl-4">
              <div class="input-block local-forms">
                <label
                  >Emergency Contact Telephone<span class="login-danger"></span
                ></label>
                <input
                  name="emergency_contact_phone"
                  class="form-control"
                  type="text"
                  placeholder=""
                />
              </div>
            </div>
  
            <div class="col-12 col-sm-12">
              <div class="input-block local-forms">
                <label>Short Biography <span class="login-danger">*</span></label>
                <textarea
                  name="about"
                  class="form-control"
                  rows="3"
                  cols="30"
                ></textarea>
              </div>
            </div>
            <div class="col-12 col-md-6 col-xl-6">
              <div class="input-block local-top-form">
                <label class="local-top"
                  >Avatar <span class="login-danger">*</span></label
                >
                <div class="settings-btn upload-files-avator">
                  <input
                    type="file"
                    accept="image/*"
                    name="image"
                    id="file"
                    onchange="loadFile(event)"
                    class="hide-input"
                  />
                  <label for="file" class="upload">Choose File</label>
                </div>
              </div>
            </div>
            <div class="col-12 col-md-6 col-xl-6">
              <div class="input-block select-gender">
                <label class="gen-label"
                  >Status <span class="login-danger">*</span></label
                >
                <div class="form-check-inline">
                  <label for="status" class="form-check-label">
                    <input checked in="status"
                      value="active"
                      type="radio"
                      name="status"
                      class="form-check-input"
                    />Active
                  </label>
                </div>
                <div class="form-check-inline">
                  <label class="form-check-label">
                    <input
                      value="inactive"
                      type="radio"
                      name="status"
                      class="form-check-input"
                    />In Active
                  </label>
                </div>
              </div>
            </div>
            <div class="col-12">
              <div class="doctor-submit text-end">
                <button type="submit" class="btn btn-primary submit-form me-2">
                  Submit
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
    email: {
        required: true,
        regex: /\S+@\S+\.\S+/,
        message: {
            required: "Please enter an email address",
            regex: "Please enter a valid email address"
        }
    },
    fname: {
        required: true,
        minlength: 2,
        message: {
            required: "Please provide a firstname",
            minlength: "Your firstname must be at least 2 characters long"
        }
    },
    lname: {
        required: true,
        minlength: 2,
        message: {
            required: "Please provide a lastname",
            minlength: "Your lastname must be at least 2 characters long"
        }
    },
    dob: {
        required: true,
        message: {
            required: "Please provide a date of birth"
        }
    },
};


document.addEventListener("DOMContentLoaded", function() {
    const form = document.getElementById("userForm");
    const cancelButton = document.querySelector('.cancel-form');
    
    addRealTimeValidation(form, validationRules); // Attach real-time validation

    form.addEventListener("submit", function(e) {
        e.preventDefault(); // Prevent the default form submission

        const isFormValid = validateForm(form, validationRules);

        if (isFormValid) {
            // If form is valid, proceed with the submission logic
            validateAndSubmitForm("userForm", `${base_url}/ajax/add_patient`);
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