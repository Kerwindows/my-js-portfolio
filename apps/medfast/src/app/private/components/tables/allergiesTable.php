<?
function allergiesTable($array_var = [], $size = 'col-md-6'){ ?>
    <div class="<? echo $size ?>">
        <div class="card-box">
            <div class="card-block patient-visit">
                <h5 class="text-bold card-title">Allergies</h5><button type="button" class="btn btn-link"><i class="fa fa-plus" aria-hidden="true"></i></button>
            </div>
            <div class="table-responsive">
                <table class="table mb-0">
                    <thead>
                        <tr>
                            <th>Allergy</th>
                            <th>Symtoms</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        foreach ($array_var['current_user_info']['allergies'] as $var) {
                            echo '<tr>
                            <td>' . $var['allergy'] . '</td>
                            <td>' . $var['symptom'] . '</td>
                        </tr>';
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
<? }