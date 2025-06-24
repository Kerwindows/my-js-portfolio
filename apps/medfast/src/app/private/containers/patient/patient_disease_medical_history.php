<?php 
include PRIVATE_MODELS_PATH .'/db/getConditionForm.php';
include PRIVATE_MODELS_PATH .'/db/getConditionValues.php';


$patientID = $array_var['current_user_info']['uid'];  // Default ID or fetched dynamically from view
$conditionsArray = getConditionForm('medical_history'); 
$conditionValues = getConditionValues($patientID,'medical_history_log'); 
// Creating an associative array indexed by 'did' for easy access
$conditionValuesByDid = [];
if(!is_null($conditionValues)){
foreach ($conditionValues as $value) {
    $conditionValuesByDid[$value['did']] = $value;
}
}
?>

<div class="form-heading">
    <h4>Medical History</h4>
</div>
<form id="medicalHistoryForm" method="post" >
    <input type="hidden" name="patientID" value="<?= htmlspecialchars($patientID); ?>">
    <input type="hidden" name="tbl" value="<?= htmlspecialchars('medical_history_log'); ?>">
    <div class="row">
        <?php foreach ($conditionsArray as $disease): ?>
        <div class="<?= $disease['level'] == 4 ? 'col-md-3' : 
		    ($disease['level'] == 3 ? 'col-md-4' : 
		    ($disease['level'] == 2 ? 'col-md-6' : 
		    'col-12')); ?> mb-4">
            <div class="form-group">
                <label><?= htmlspecialchars($disease['disease']); ?></label>
                
                <?php
                $responses = !empty($disease['input_responses']) ? json_decode($disease['input_responses'], true) : [];
                $currentAnswer = $conditionValuesByDid[$disease['did']]['answer'] ?? '';
                $currentText = $conditionValuesByDid[$disease['did']]['result'] ?? '';
                $currentDate = $conditionValuesByDid[$disease['did']]['date'] ?? '';

                echo '<input type="hidden" name="conditions[' . $disease['did'] . '][type]" value="' . $disease['input_type'] . '">';

                if ($disease['input_type'] === 'radio'):
                    foreach ($responses as $response):
                        $isChecked = ($currentAnswer === $response) ? 'checked' : '';
                        ?>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="conditions[<?= $disease['did']; ?>][answer]"
                                   value="<?= htmlspecialchars($response); ?>" <?= $isChecked; ?>>
                            <label class="form-check-label"><?= htmlspecialchars($response); ?></label>
                        </div>
                    <?php endforeach;
                elseif ($disease['input_type'] === 'checkbox'):
                    foreach ($responses as $response):
                        $isChecked = in_array($response, explode(',', $currentAnswer)) ? 'checked' : '';
                        ?>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="conditions[<?= $disease['did']; ?>][answer][]"
                                   value="<?= htmlspecialchars($response); ?>" <?= $isChecked; ?>>
                            <label class="form-check-label"><?= htmlspecialchars($response); ?></label>
                        </div>
                    <?php endforeach;
                endif;

                if ($disease['has_note'] === 'yes'):
                    if (strpos($disease['note_type'], 'date') !== false):
                        ?>
                        <input type="date" name="conditions[<?= $disease['did']; ?>][date]" class="form-control mt-2"
                               value="<?= htmlspecialchars($currentDate); ?>">
                    <?php endif;
                    if (strpos($disease['note_type'], 'text') !== false):
                        ?>
                        <input type="text" name="conditions[<?= $disease['did']; ?>][text]" class="form-control mt-2"
                               value="<?= htmlspecialchars($currentText); ?>">
                    <?php endif;
                endif;
                ?>
            </div>
        </div>
        <?php endforeach; ?>
    </div>
    <button type="submit" class="btn btn-primary">Submit</button>
</form>