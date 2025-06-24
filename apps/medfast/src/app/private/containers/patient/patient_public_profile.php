<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    require_once(PRIVATE_CLASSES_PATH . "/DBUtil.php");


    $validationRules = [
        'show_age' => [
            'type' => 'string',
            'optional' => true,
        ],
        'show_sex' => [
            'type' => 'string',
            'optional' => true,
        ],
        'show_email' => [
            'type' => 'string',
            'optional' => true,
        ], 
        'show_dob' => [
            'type' => 'string',
            'optional' => true,
        ], 
        'show_about' => [
            'type' => 'string',
            'optional' => true,
        ], 
        'show_next_of_kin' => [
            'type' => 'string',
            'optional' => true,
        ], 
        'show_phone' => [
            'type' => 'string',
            'optional' => true,
        ], 
        'show_ethnicity' => [
            'type' => 'string',
            'optional' => true,
        ], 
        'show_city' => [
            'type' => 'string',
            'optional' => true,
        ], 
        'show_country' => [
            'type' => 'string',
            'optional' => true,
        ], 
        'show_allergies' => [
            'type' => 'string',
            'optional' => true,
        ], 
        'show_medications' => [
            'type' => 'string',
            'optional' => true,
        ], 
        'show_emergency_contact' => [
            'type' => 'string',
            'optional' => true,
        ], 
        'show_blood_type' => [
            'type' => 'string',
            'optional' => true,
        ],
    ];

    $userData = [
        'show_age' => filter_input(INPUT_POST, 'show_age', FILTER_SANITIZE_NUMBER_INT) ?? 0,
        'show_sex' => filter_input(INPUT_POST, 'show_sex', FILTER_SANITIZE_NUMBER_INT) ?? 0,
         'show_email' => filter_input(INPUT_POST, 'show_email', FILTER_SANITIZE_NUMBER_INT) ?? 0,
         'show_dob'=> filter_input(INPUT_POST, 'show_dob', FILTER_SANITIZE_NUMBER_INT) ?? 0,
         'show_about'=> filter_input(INPUT_POST, 'show_about', FILTER_SANITIZE_NUMBER_INT) ?? 0, 
         'show_next_of_kin'=> filter_input(INPUT_POST, 'show_next_of_kin', FILTER_SANITIZE_NUMBER_INT) ?? 0, 
         'show_phone'=> filter_input(INPUT_POST, 'show_phone', FILTER_SANITIZE_NUMBER_INT) ?? 0, 
         'show_ethnicity'=> filter_input(INPUT_POST, 'show_ethnicity', FILTER_SANITIZE_NUMBER_INT) ?? 0,
         'show_city'=> filter_input(INPUT_POST, 'show_city', FILTER_SANITIZE_NUMBER_INT) ?? 0, 
         'show_country'=> filter_input(INPUT_POST, 'show_country', FILTER_SANITIZE_NUMBER_INT) ?? 0, 
         'show_allergies'=> filter_input(INPUT_POST, 'show_allergies', FILTER_SANITIZE_NUMBER_INT) ?? 0, 
         'show_medications'=> filter_input(INPUT_POST, 'show_medications', FILTER_SANITIZE_NUMBER_INT) ?? 0, 
         'show_emergency_contact'=> filter_input(INPUT_POST, 'show_emergency_contact', FILTER_SANITIZE_NUMBER_INT) ?? 0,
         'show_blood_type'=> filter_input(INPUT_POST, 'show_blood_type', FILTER_SANITIZE_NUMBER_INT) ?? 0
    ];

    $whereClause = ['uid' => $array_var['current_user_info']['uid']];


    try {
        $db = new dbase;
        $db->beginTransaction();

        $result = DBUtil::validateAndUpdate($db, 'user_visibility_preferences', $userData, $validationRules, $whereClause);

        if (!$result['success']) {
            $db->rollback();
            echo json_encode(['success' => false, 'message' => "Update failed: ", 'errors' => $result['errors']], JSON_PRETTY_PRINT);
            exit;
        }

        $db->commit();
        //echo json_encode(['success' => true, 'message' => 'Profile updated successfully.', 'isUpdate' => true]);
        redirect('/patient/profile/'.$array_var['current_user_info']['uid']);
        exit;
    } catch (PDOException $e) {
        $db->rollback();
        error_log($e->getMessage());
        echo json_encode(['success' => false, 'message' => "Database operation failed: ", 'errors' => $e->getMessage()], JSON_PRETTY_PRINT);
        exit;
    } catch (Exception $e) {
        $db->rollback();
        error_log($e->getMessage());
        echo json_encode(['success' => false, 'message' => "An error occurred: ", 'errors' => $e->getMessage()], JSON_PRETTY_PRINT);
        $db->closeConnection();
        exit;
    }
    
}
?>

<style>
    small {
        font-size: x-small;
    }

    .page-wrapper {
        margin-left: 0;
    }

    .profile-user-box {
        display: flex;
        -ms-flex-pack: center;
        justify-content: space-evenly;
    }

    .profile-user-box {
        justify-content: space-around;
    }

    .follow-group {
        justify-content: space-around;
    }

    .profile-user-img>img {
        width: 167px;
        height: 167px;
        object-fit: cover;
        border-radius: 50%;
        outline: 5px solid #02b16a;
    }

    .profile-bg-img img {
        border-radius: 10px 10px 0 0;
    }

    .doctor-profile-head {
        background: #fff;
    }

    /* CSS Transition for Entrance Animation */
    .entrance-enter {
        opacity: 0;
        transform: translateY(-20px);
    }

    .entrance-enter-active {
        opacity: 1;
        transform: translateY(0);
        transition: opacity 300ms, transform 300ms;
    }

    .entrance-exit {
        opacity: 1;
        transform: translateY(0);
    }

    .entrance-exit-active {
        opacity: 0;
        transform: translateY(-20px);
        transition: opacity 300ms, transform 300ms;
    }

    @media screen and (max-width: 991px) {
        .row.row_reverse {
            flex-direction: column-reverse;
        }

        .profile-user-img>img {
            width: 141px;
            height: 141px;
        }

        .profile-user-box {
            flex-direction: column;
        }

        .names-profiles {
            text-align: center;
        }

        .follow-btn-group {
            margin-top: 20px;
        }

        button.btn.btn-info.follow-btns {
            padding: 10px;
            width: 100%;
            margin-right: 0;
        }
    }
</style>
<div class="container">
    <div class="row">
        <div class="col-sm-12">
            <div class="card">
                <div class="card-body p-0">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="doctor-profile-head">
                                <div class="profile-bg-img">
                                    <img src="https://fs.kerwindows.com/apps/medfast/assets/img/profile-backgrounds/default.png" alt="Profile Background" />
                                </div>
                                <div class="row pe-4 ps-4">
                                    <div class="col-lg-5 col-md-7 mb-4">
                                        <div class="profile-user-box">
                                            <div class="profile-user-img">
                                                <img src="<?php echo base_url() . getImagePath($array_var['current_user_info']['image']); ?>" alt="Profile" />
                                                <div class="form-group doctor-up-files profile-edit-icon mb-0"></div>
                                            </div>
                                            <div class="names-profiles">
                                                <h4>
                                                    <?php echo $array_var['current_user_info']['fname'] . ' ' . $array_var['current_user_info']['lname'] ?>
                                                </h4>
                                                <?php if ($array_var['user_visibility_preferences']['show_sex'] ?? null and !is_null($array_var['user_visibility_preferences'])) { ?>
                                                <h5 class="patient-follow-sex">
                                                    <?php echo $array_var['current_user_info']['sex'] ?>
                                                </h5>
                                                <?php } ?>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-4 col-md-5 d-flex align-items-center">
                                        <div class="follow-group">
                                            <?php if ($array_var['user_visibility_preferences']['show_age'] ?? null and !is_null($array_var['user_visibility_preferences'])) { ?>
                                                <div class="doctor-follows patient-follow-age">
                                                    <h5>Age</h5>
                                                    <h4>
                                                        <?php echo calculateAge($array_var['current_user_info']['dob']) ?>
                                                    </h4>
                                                </div>
                                            <?php }
                                            if ($array_var['user_visibility_preferences']['show_dob'] ?? null and !is_null($array_var['user_visibility_preferences'])) { ?>
                                                <div class="doctor-follows patient-follow-dob">
                                                    <h5>Date of Birth</h5>
                                                    <h4>
                                                        <?php echo $array_var['current_user_info']['dob'] ?>
                                                    </h4>
                                                </div>
                                            <?php }
                                            if ($array_var['user_visibility_preferences']['show_blood_type'] ?? null and !is_null($array_var['user_visibility_preferences'])) { ?>
                                                <div class="doctor-follows patient-follow-blood-type">
                                                    <h5>Blood Type</h5>
                                                    <h4>
                                                        <?php echo $array_var['current_user_info']['blood_type'] ?>
                                                    </h4>
                                                </div>
                                            <?php } ?>
                                        </div>
                                    </div>
                                    <div class="col-lg-3 col-md-12 d-flex align-items-center mb-3">
                                        <div class="follow-btn-group">
                                            <button type="submit" class="btn btn-info follow-btns" onclick="window.open('tel:<?php echo $array_var['current_user_info']['emergency_contact']['phone'] ?>')">
                                                <i class="fa-solid fa-phone"></i>
                                                Emergency Contact
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-12 col-md-6 col-lg-5">
            <div class="card">
                <form id="visibilityForm" method="POST">
                    <div class="card-body">
                        <div class="tab-content-set">
                            <ul class="nav">
                                <li>
                                    <a id="about-me" class="active"><span class="set-about-icon me-2"><img src="<?php echo base_url() ?>/assets/img/icons/menu-icon-02.svg" alt="" /></span>About me</a>
                                </li>
                                <li>
                                    <a class=""><span class="set-about-icon me-2"><img src="<?php echo base_url() ?>/assets/img/icons/menu-icon-16.svg" alt="" /></span>Edit</a>
                                </li>
                                <li class="p-0" style="margin-left: auto">
                                    <div class="doctor-submit text-end">
                                        <button type="submit" class="btn btn-primary submit-form me-2">
                                            Update
                                        </button>
                                    </div>
                                </li>
                            </ul>
                        </div>
                        <div class="personal-list-out">
                            <div style="display:none" class="row pb-5 display-control">
                                <div class="col-12 pb-2">Show:</div>

                                <div class="col-md-6 pb-2">
    <input type="checkbox" name="show_age" class="form-check-input" value="1" data-target=".patient-follow-age" <?= $array_var['user_visibility_preferences']['show_age'] == 1 ? 'checked' : ''; ?> />
    Age
</div>
<div class="col-md-6 pb-2">
    <input type="checkbox" name="show_dob" class="form-check-input"  value="1" data-target=".patient-follow-dob" <?= $array_var['user_visibility_preferences']['show_dob'] == 1 ? 'checked' : ''; ?> />
    Date of Birth
</div>
<div class="col-md-6 pb-2">
    <input data-target=".patient-follow-sex" type="checkbox" name="show_sex" value="1" class="form-check-input" <?= $array_var['user_visibility_preferences']['show_sex'] == 1 ? 'checked' : ''; ?> />
    Gender
</div>
<div class="col-md-6 pb-2">
    <input data-target=".patient-follow-phone" type="checkbox" name="show_phone" value="1" class="form-check-input" <?= $array_var['user_visibility_preferences']['show_phone'] == 1 ? 'checked' : ''; ?> />
    Mobile Number
</div>
<div class="col-md-6 pb-2">
    <input data-target=".patient-follow-email" type="checkbox" name="show_email"  value="1" class=" form-check-input" <?= $array_var['user_visibility_preferences']['show_email'] == 1 ? 'checked' : ''; ?> />
    Email Address
</div>
<div class="col-md-6 pb-2">
    <input data-target=".patient-follow-city" type="checkbox" name="show_city" value="1" class="form-check-input" <?= $array_var['user_visibility_preferences']['show_city'] == 1 ? 'checked' : ''; ?> />
    City
</div>
<div class="col-md-6 pb-2">
    <input data-target=".patient-follow-country" type="checkbox" name="show_country" value="1" class="form-check-input" <?= $array_var['user_visibility_preferences']['show_country'] == 1 ? 'checked' : ''; ?> />
    Country
</div>
<div class="col-md-6 pb-2">
    <input data-target=".patient-follow-ethnicity" type="checkbox" name="show_ethnicity" value="1" class="form-check-input" <?= $array_var['user_visibility_preferences']['show_ethnicity'] == 1 ? 'checked' : ''; ?> />
    Ethnicity
</div>
                                <div class="col-md-6 pb-2">
                                    <input data-target=".patient-follow-about" type="checkbox" name="show_about" value="1" class="form-check-input" <?= $array_var['user_visibility_preferences']['show_about'] == 1 ? 'checked' : ''; ?> />
                                    About me
                                </div>
                                <div class="col-md-6 pb-2">
                                    <input data-target=".patient-follow-emergency" type="checkbox" name="show_emergency_contact" value="1" class="form-check-input" <?= $array_var['user_visibility_preferences']['show_emergency_contact'] == 1 ? 'checked' : ''; ?> />
                                    Emergency Contact
                                </div>
                                <div class="col-md-6 pb-2">
                                    <input data-target=".patient-follow-next-of-kin" type="checkbox" name="show_next_of_kin"  value="1" class="form-check-input" <?= $array_var['user_visibility_preferences']['show_next_of_kin'] == 1 ? 'checked' : ''; ?> />
                                    Next of Kin
                                </div>
                                <div class="col-md-6 pb-2">
                                    <input data-target=".patient-follow-allergies" type="checkbox" name="show_allergies" value="1" class="form-check-input" <?= $array_var['user_visibility_preferences']['show_allergies'] == 1 ? 'checked' : ''; ?> />
                                    Allergies
                                </div>
                                <div class="col-md-6 pb-2">
                                    <input data-target=".patient-follow-medication" type="checkbox" name="show_medications" value="1" class="form-check-input" <?= $array_var['user_visibility_preferences']['show_medications'] == 1 ? 'checked' : ''; ?> />
                                    Medications
                                </div>
                                <div class="col-md-6 pb-2">
                                    <input data-target=".patient-follow-blood-type" type="checkbox" name="show_blood_type" value="1" class="form-check-input" <?= $array_var['user_visibility_preferences']['show_blood_type'] == 1 ? 'checked' : ''; ?> />
                                   Blood Type
                                </div>

                            </div>
                            <div class="row">
				<?php if ($array_var['user_visibility_preferences']['show_phone'] ?? null and !is_null($array_var['user_visibility_preferences'])) { ?>
                                <div class="col-xl-6 col-md-6 pb-2 patient-follow-phone">
                                    <div class="detail-personal">
                                        <h2>Mobile</h2>
                                        <h3>8687987677</h3>
                                    </div>
                                </div>
				<?php } if ($array_var['user_visibility_preferences']['show_email'] ?? null and !is_null($array_var['user_visibility_preferences'])) { ?>
                                <div class="col-xl-6 col-md-6 pb-2 patient-follow-email">
                                    <div class="detail-personal">
                                        <h2>Email</h2>
                                        <h3>kerwindows@hotmail.com</h3>
                                    </div>
                                </div>
                                <?php } if ($array_var['user_visibility_preferences']['show_city'] ?? null and !is_null($array_var['user_visibility_preferences'])) { ?>
                                <div class="col-xl-6 col-md-6 pb-2 patient-follow-city">
                                    <div class="detail-personal">
                                        <h2>City</h2>
                                        <h3>Wanica</h3>
                                    </div>
                                </div>
                                <?php } if ($array_var['user_visibility_preferences']['show_country'] ?? null and !is_null($array_var['user_visibility_preferences'])) { ?>
                                <div class="col-xl-6 col-md-6 pb-2 patient-follow-country">
                                    <div class="detail-personal">
                                        <h2>Country</h2>
                                        <h3>Suriname</h3>
                                    </div>
                                </div>
                                <?php } if ($array_var['user_visibility_preferences']['show_ethnicity'] ?? null and !is_null($array_var['user_visibility_preferences'])) { ?>
                                <div class="col-xl-6 col-md-6 pb-2 patient-follow-ethnicity">
                                    <div class="detail-personal">
                                        <h2>Ethnicity</h2>
                                        <h3>African</h3>
                                    </div>
                                </div>
                                <?php } ?>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <?php if ($array_var['user_visibility_preferences']['show_about'] ?? null and !is_null($array_var['user_visibility_preferences'])) { ?>
                <div class="doctor-personals-grp patient-follow-about">
                    <div class="card">
                        <div class="card-body">
                            <div class="heading-detail">
                                <h4 class="mb-3">Bio</h4>
                            </div>
                            <p><?php echo $array_var['current_user_info']['about'] ?? '' ?></p>
                        </div>
                    </div>
                </div>
            <?php } ?>
        </div>
        <div class="col-sm-12 col-md-6 col-lg-7">
            <?php if ($array_var['user_visibility_preferences']['show_emergency_contact'] ?? null and !is_null($array_var['user_visibility_preferences'])) { ?>
                <div class="card patient-follow-emergency">
                    <div class="card-body">
                        <div class="heading-detail">
                            <h4 class="mb-3">Emergency Contact</h4>
                        </div>
                        <hr />
                        <div class="personal-list-out">
                            <div class="row">
                                <div class="col-12 col-md-5 pb-2">
                                    <div class="detail-personal">
                                        <h2>Name</h2>
                                        <h3>
                                            <?php echo $array_var['current_user_info']['emergency_contact']['fname'] . ' ' . $array_var['current_user_info']['emergency_contact']['lname'] ?>
                                        </h3>
                                    </div>
                                </div>
                                <div class="col-12 col-md-7 pb-2">
                                    <div class="detail-personal">
                                        <h2>Relationship</h2>
                                        <h3>
                                            <?php echo $array_var['current_user_info']['emergency_contact']['relationship'] ?>
                                        </h3>
                                    </div>
                                </div>
                                <div class="col-12 col-md-7 pb-2">
                                    <div class="detail-personal">
                                        <h2>Telephone</h2>
                                        <h3>
                                            <?php echo $array_var['current_user_info']['emergency_contact']['phone'] ?>
                                        </h3>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            <?php }
            if ($array_var['user_visibility_preferences']['show_next_of_kin'] ?? null and !is_null($array_var['user_visibility_preferences'])) { ?>
                <div class="card patient-follow-next-of-kin">
                    <div class="card-body">
                        <div class="heading-detail">
                            <h4 class="mb-3">Next of Kin</h4>
                        </div>
                        <hr />
                        <div class="personal-list-out">
                            <div class="row">
                                <div class="col-12 col-md-5 pb-2">
                                    <div class="detail-personal">
                                        <h2>Name</h2>
                                        <h3>
                                            <?php echo $array_var['current_user_info']['next_of_kin']['fname'] . ' ' . $array_var['current_user_info']['next_of_kin']['lname'] ?>
                                        </h3>
                                    </div>
                                </div>
                                <div class="col-12 col-md-7 pb-2">
                                    <div class="detail-personal">
                                        <h2>Relationship</h2>
                                        <h3>
                                            <?php echo $array_var['current_user_info']['emergency_contact']['relationship'] ?>
                                        </h3>
                                    </div>
                                </div>
                                <div class="col-12 col-md-7 pb-2">
                                    <div class="detail-personal">
                                        <h2>Telephone</h2>
                                        <h3>
                                            <?php echo $array_var['current_user_info']['emergency_contact']['phone'] ?>
                                        </h3>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            <?php }
            if ($array_var['user_visibility_preferences']['show_allergies'] ?? null and !is_null($array_var['user_visibility_preferences'])) { ?>
                <div class="doctor-personals-grp">
                    <div class="card patient-follow-allergies">
                        <div class="card-body">
                            <div class="heading-detail">
                                <h4>Allergies</h4>
                            </div>
                            <hr />
                            <div class="skill-blk">
                                <?php foreach ($array_var['current_user_info']['allergies'] as $allergy) { ?>
                                    <div class="detail-personal pb-3">
                                        <h2><?php echo $allergy['allergy'] ?></h2>
                                        <h3><?php echo $allergy['symptom'] ?></h3>
                                    </div>
                                <?php } ?>
                            </div>
                        </div>
                    </div>
                </div>
            <?php }
            if ($array_var['user_visibility_preferences']['show_medications'] ?? null and !is_null($array_var['user_visibility_preferences'])) { ?>
                <div class="card patient-follow-medication">
                    <div class="card-body">
                        <div class="heading-detail">
                            <h4>Medication</h4>
                        </div>
                        <hr />
                        <div class="skill-blk table-responsive">
                            <?php foreach ($array_var['current_user_info']['medications'] as $medicine) { ?>
                                <div class="detail-personal pb-4">
                                    <h2>
                                        <i class="<?php echo $medicine['icon'] ?>"></i>
                                        <?php echo $medicine['medicine'] ?>
                                    </h2>
                                    <h3>
                                        <?php echo $medicine['dosage'] ?>
                                    </h3>
                                </div>
                            <?php } ?>
                        </div>
                    </div>
                </div>
            <?php } ?>
        </div>
    </div>
</div>
<script nonce="<?= htmlspecialchars($_SESSION['nonce']); ?>">
// Select all checkboxes in the form
var checkboxes = document.querySelectorAll('#visibilityForm input[type="checkbox"]');

checkboxes.forEach(function(checkbox) {
    // Set initial value depending on whether it is checked or not
    checkbox.value = checkbox.checked ? '1' : '0';

    // Add an event listener for the 'change' event
    checkbox.addEventListener('change', function() {
    this.value = this.checked ? '1' : '0';
});
});
</script>