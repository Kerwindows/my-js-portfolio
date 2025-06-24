<style>
    /*fix select2 error*/
    .input-block.local-forms .select2.select2-container.select2-container--default:last-of-type {
        display: none;
    }
</style>
<div class="col-sm-12">
    <div class="card">
        <div class="card-body">
            <form method="POST" action="<?php echo base_url() ?>/patient/update/<?php echo $array_var['current_user_info']['uid'] ?>" enctype="multipart/form-data">
                <div class="row">
                    <div class="col-12">
                        <div class="form-heading">
                            <h4>Patient Details</h4>
                        </div>
                    </div>
                    <div class="col-12 col-md-6 col-xl-4">
                        <div class="input-block local-forms">
                            <label>First Name <span class="login-danger">*</span></label>
                            <input name="fname" class="form-control" type="text" value="<?php echo $array_var['current_user_info']['fname']; ?>" placeholder="" required />
                        </div>
                    </div>
                    <div class="col-12 col-md-6 col-xl-4">
                        <div class="input-block local-forms">
                            <label>Middle Name <span class="login-danger">*</span></label>
                            <input name="mname" class="form-control" type="text" value="<?php echo $array_var['current_user_info']['mname']; ?>" placeholder="" />
                        </div>
                    </div>
                    <div class="col-12 col-md-6 col-xl-4">
                        <div class="input-block local-forms">
                            <label>Last Name <span class="login-danger">*</span></label>
                            <input name="lname" class="form-control" type="text" value="<?php echo $array_var['current_user_info']['lname']; ?>" placeholder="" required />
                        </div>
                    </div>
                    <div class="col-12 col-md-6 col-xl-4">
                        <div class="input-block local-forms">
                            <label>Alias<span class="login-danger"></span></label>
                            <input name="alias" class="form-control" type="text" value="<?php echo $array_var['current_user_info']['alias']; ?>" placeholder="" />
                        </div>
                    </div>
                    <div class="col-12 col-md-4 col-xl-4">
                        <div class="input-block local-forms cal-icon">
                            <label>Date Of Birth <span class="login-danger">*</span></label>
                            <input class="form-control datetimepicker" type="text" value="<?php echo convert_date_time($array_var['current_user_info']['dob'], 'd-m-Y'); ?>" placeholder="" name="dob" />
                        </div>
                    </div>
                    <div class="col-12 col-md-4 col-xl-4">
                    <div class="input-block select-gender">
                        <label class="gen-label">Gender<span class="login-danger">*</span></label>
                        <div class="form-check-inline">
                        <label class="form-check-label">
                            <input type="radio" name="sex" class="form-check-input" value="Male" <?php echo ($array_var['current_user_info']['sex']  == 'Male') ? 'checked' : ''; ?>/>Male
                        </label>
                        </div>
                        <div class="form-check-inline">
                        <label class="form-check-label">
                            <input type="radio" name="sex" class="form-check-input" value="Female" <?php echo ($array_var['current_user_info']['sex'] == 'Female') ? 'checked' : ''; ?>/>Female
                        </label>
                        </div>
                    </div>
                    </div>


                    <div class="col-12 col-md-4 col-xl-4">
                        <div class="input-block local-forms">
                            <label>Ethnicity <span class="login-danger">*</span></label>
                            <input name="ethnicity" class="form-control" type="text" value="<?php echo $array_var['current_user_info']['ethnicity']; ?>" placeholder="" />
                        </div>
                    </div>
                    <div class="col-12 col-md-4 col-xl-4">
                        <div class="input-block local-forms">
                            <label>Mobile <span class="login-danger">*</span></label>
                            <input name="phone" class="form-control" type="text" value="<?php echo $array_var['current_user_info']['phone']; ?>" placeholder="" required />
                        </div>
                    </div>
                    <div class="col-12 col-md-4 col-xl-4">
                        <div class="input-block local-forms">
                            <label>Email <span class="login-danger">*</span></label>
                            <input name="email" class="form-control" type="email" value="<?php echo $array_var['current_user_info']['email']; ?>" placeholder="" required />
                        </div>
                    </div>
                    <div class="col-12 col-md-6 col-xl-6">
                        <div class="input-block local-forms">
                            <label>Address<span class="login-danger"></span></label>
                            <input name="address" class="form-control" type="text" value="<?php echo $array_var['current_user_info']['address']; ?>" placeholder="" />
                        </div>
                    </div>
                    <div class="col-12 col-md-6 col-xl-3">
                        <div class="input-block local-forms">
                            <label>Town/Village <span class="login-danger">*</span></label>
                            <select name="town" class="form-control select select2-hidden-accessible" tabindex="-1" aria-hidden="true">
                                <option>Select Town</option>
                                <option <?php echo $array_var['current_user_info']['town'] == 'Enterprise' ? 'selected' : '' ?>>Enterprise</option>
                                <option <?php echo $array_var['current_user_info']['town'] == 'Arouca' ? 'selected' : '' ?>>Arouca</option>
                            </select><span class="select2 select2-container select2-container--default" dir="ltr" style="width: 100%"><span class="selection"><span class="select2-selection select2-selection--single" role="combobox" aria-haspopup="true" aria-expanded="false" tabindex="0" aria-labelledby="select2-zfce-container"><span class="select2-selection__rendered" id="select2-zfce-container" title="Select State">Select State</span><span class="select2-selection__arrow" role="presentation"><b role="presentation"></b></span></span></span><span class="dropdown-wrapper" aria-hidden="true"></span></span>
                        </div>
                    </div>
                    <div class="col-12 col-md-6 col-xl-3">
                        <div class="input-block local-forms">
                            <label>City <span class="login-danger">*</span></label>
                            <select name="city" class="form-control select select2-hidden-accessible" tabindex="-1" aria-hidden="true">
                                <option>Select City</option>
                                <option <?php echo $array_var['current_user_info']['city'] == 'Arima' ? 'selected' : '' ?>>Arima</option>
                                <option <?php echo $array_var['current_user_info']['city'] == 'Chaguanas' ? 'selected' : '' ?>>Chaguanas</option>
                            </select><span class="select2 select2-container select2-container--default" dir="ltr" style="width: 100%"><span class="selection"><span class="select2-selection select2-selection--single" role="combobox" aria-haspopup="true" aria-expanded="false" tabindex="0" aria-labelledby="select2-6a31-container"><span class="select2-selection__rendered" id="select2-6a31-container" title="Select City">Select City</span><span class="select2-selection__arrow" role="presentation"><b role="presentation"></b></span></span></span><span class="dropdown-wrapper" aria-hidden="true"></span></span>
                        </div>
                    </div>
                    <div class="col-12 col-md-6 col-xl-3">
                        <div class="input-block local-forms">
                            <label>Country <span class="login-danger">*</span></label>
                            <select name="country" class="form-control select select2-hidden-accessible" tabindex="-1" aria-hidden="true">
                                <option>Select Country</option>
                                <option <?php echo $array_var['current_user_info']['country'] == 'Trinidad and Tobago' ? 'selected' : '' ?>>Trinidad and Tobago</option>
                                <option <?php echo $array_var['current_user_info']['country'] == 'Grenada' ? 'selected' : '' ?>>Grenada</option>
                                <option <?php echo $array_var['current_user_info']['country'] == 'Guyana' ? 'selected' : '' ?>>Guyana</option>
                            </select><span class="select2 select2-container select2-container--default" dir="ltr" style="width: 100%"><span class="selection"><span class="select2-selection select2-selection--single" role="combobox" aria-haspopup="true" aria-expanded="false" tabindex="0" aria-labelledby="select2-y5fr-container"><span class="select2-selection__rendered" id="select2-y5fr-container" title="Select Country ">Select Country </span><span class="select2-selection__arrow" role="presentation"><b role="presentation"></b></span></span></span><span class="dropdown-wrapper" aria-hidden="true"></span></span>
                        </div>
                    </div>

                    <div class="col-12 col-md-6 col-xl-3">
                        <div class="input-block local-forms">
                            <label>Postal Code <span class="login-danger">*</span></label>
                            <input name="postal_code" class="form-control" type="text" value="<?php echo $array_var['current_user_info']['postal_code']; ?>" placeholder="" />
                        </div>
                    </div>
                    <div class="col-12 col-md-4 col-xl-4">
                        <div class="input-block local-forms">
                            <label>Religion <span class="login-danger">*</span></label>
                            <input name="religion" class="form-control" type="text" value="<?php echo $array_var['current_user_info']['religion']; ?>" placeholder="" />
                        </div>
                    </div>
                    <div class="col-12 col-md-4 col-xl-4">
                        <div class="input-block local-forms">
                            <label>Union Status<span class="login-danger"></span></label>
                            <input name="union_status" class="form-control" type="text" value="<?php echo $array_var['current_user_info']['union_status']; ?>" placeholder="" />
                        </div>
                    </div>


                    <div class="col-12 col-md-4 col-xl-4">
                        <div class="input-block local-forms">
                            <label>Occupation <span class="login-danger">*</span></label>
                            <input name="occupation" class="form-control" type="text" value="<?php echo $array_var['current_user_info']['occupation']; ?>" placeholder="" />
                        </div>
                    </div>
                    <div class="col-12 col-md-4 col-xl-4">
                        <div class="input-block local-forms">
                            <label>Next of Kin First Name <span class="login-danger"></span></label>
                            <input name="next_of_kin_fname" class="form-control" type="text" value="<?php echo $array_var['current_user_info']['next_of_kin']['fname']; ?>" placeholder="" />
                        </div>
                    </div>
                    <div class="col-12 col-md-4 col-xl-4">
                        <div class="input-block local-forms">
                            <label>Next of Kin Last Name <span class="login-danger"></span></label>
                            <input name="next_of_kin_lname" class="form-control" type="text" value="<?php echo $array_var['current_user_info']['next_of_kin']['lname']; ?>" placeholder="" />
                        </div>
                    </div>
                    <div class="col-12 col-md-4 col-xl-4">
                        <div class="input-block local-forms">
                            <label>Next of Kin Relationship<span class="login-danger"></span></label>
                            <input name="next_of_kin_relationship" class="form-control" type="text" value="<?php echo $array_var['current_user_info']['next_of_kin']['relationship']; ?>" placeholder="" />
                        </div>
                    </div>
                    <div class="col-12 col-md-4 col-xl-4">
                        <div class="input-block local-forms">
                            <label>Next of Kin Telephone<span class="login-danger"></span></label>
                            <input name="next_of_kin_phone" class="form-control" type="text" value="<?php echo $array_var['current_user_info']['next_of_kin']['phone']; ?>" placeholder="" />
                        </div>
                    </div>
                    <div class="col-12 col-md-4 col-xl-4">
                        <div class="input-block local-forms">
                            <label>Mother's Maiden Name<span class="login-danger"></span></label>
                            <input name="mother_maiden_name" class="form-control" type="text" value="<?php echo $array_var['current_user_info']['mother_maiden_name']; ?>" placeholder="" />
                        </div>
                    </div>
                    <div class="col-12 col-md-4 col-xl-4">
                        <div class="input-block local-forms">
                            <label>Emergency Contact First Name<span class="login-danger"></span></label>
                            <input name="emergency_contact_fname" class="form-control" type="text" value="<?php echo $array_var['current_user_info']['emergency_contact']['fname']; ?>" placeholder="" />
                        </div>
                    </div>
                    <div class="col-12 col-md-4 col-xl-4">
                        <div class="input-block local-forms">
                            <label>Emergency Contact Last Name<span class="login-danger"></span></label>
                            <input name="emergency_contact_lname" class="form-control" type="text" value="<?php echo $array_var['current_user_info']['emergency_contact']['lname']; ?>" placeholder="" />
                        </div>
                    </div>
                    <div class="col-12 col-md-4 col-xl-4">
                        <div class="input-block local-forms">
                            <label>Emergency Contact Relationship<span class="login-danger"></span></label>
                            <input name="emergency_contact_relationship" class="form-control" type="text" value="<?php echo $array_var['current_user_info']['emergency_contact']['relationship']; ?>" placeholder="" />
                        </div>
                    </div>
                    <div class="col-12 col-md-4 col-xl-4">
                        <div class="input-block local-forms">
                            <label>Emergency Contact Telephone<span class="login-danger"></span></label>
                            <input name="emergency_contact_phone" class="form-control" type="text" value="<?php echo $array_var['current_user_info']['emergency_contact']['phone']; ?>" placeholder="" />
                        </div>
                    </div>



                    <div class="col-12 col-sm-12">
                        <div class="input-block local-forms">
                            <label>Short Biography <span class="login-danger">*</span></label>
                            <textarea name="about" class="form-control" rows="3" cols="30"><?php echo $array_var['current_user_info']['about']; ?></textarea>
                        </div>
                    </div>
                    <div class="col-12 col-md-6 col-xl-6">
                        <div class="input-block local-top-form">
                            <label class="local-top">Avatar <span class="login-danger">*</span></label>
                            <div class="settings-btn upload-files-avator">
                                <span id="fileName" class="file-name"></span> <!-- Element to display file name -->
                                <input type="file" accept="image/*" name="image" id="fileInput" class="hide-input" data-nonce="<?= htmlspecialchars($_SESSION['nonce']); ?>" />
                                <label for="fileInput" class="upload">Choose File</label>
                                
                            </div>
                            <div class="upload-images upload-size">
                                <img id="output_image" src="<?php echo base_url() ?><?php echo getImagePath($array_var['current_user_info']['image']); ?>" alt="Avatar">
                                <a href="javascript:void(0);" class="btn-icon logo-hide-btn" id="clearBtn">
                                    <i class="feather-x-circle"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-md-6 col-xl-6">
                        <div class="input-block select-gender">
                            <label class="gen-label">Status <span class="login-danger">*</span></label>
                            <div class="form-check-inline">
                                <label class="form-check-label">
                                    <input type="radio" name="status" class="form-check-input" value="active" <?php echo ($array_var['current_user_info']['status'] == 'active') ? 'checked' : ''; ?> />Active
                                </label>
                            </div>
                            <div class="form-check-inline">
                                <label class="form-check-label">
                                    <input type="radio" name="status" class="form-check-input" value="inactive" <?php echo ($array_var['current_user_info']['status']  == 'inactive') ? 'checked' : ''; ?> />In Active
                                </label>
                            </div>
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="doctor-submit text-end">
                            <button type="submit" class="btn btn-primary submit-form me-2">
                                Submit
                            </button>
                            <button type="submit" class="btn btn-primary cancel-form">
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
document.addEventListener("DOMContentLoaded", function () {
    var fileInput = document.getElementById('fileInput');
    var fileNameDisplay = document.getElementById('fileName');
    var imageDisplay = document.getElementById('output_image');
    var imageContainer = document.querySelector('.upload-images');
    var clearBtn = document.getElementById('clearBtn');

    fileInput.addEventListener('change', function (e) {
       
        imageDisplay.src = URL.createObjectURL(e.target.files[0]);
        imageDisplay.onload = function() {
            URL.revokeObjectURL(imageDisplay.src); // Free up memory - release object URL
        };
        fileNameDisplay.textContent = e.target.files[0].name; // Display the file name
        imageContainer.style.display = 'flex'; // Show the image container
    });

    clearBtn.addEventListener('click', function () {
        fileInput.value = ''; // Clear the file input
        fileNameDisplay.textContent = ''; // Clear the file name display
        imageDisplay.src = ''; // Clear the image preview
        imageContainer.style.display = 'none'; // Hide the image container
    });
});

</script>