<?php 
function breadcrumbs($array_var = []){
    ?>
    <!-- Page Header -->
    <div class="page-header">
        <div class="row">
            <div class="col-sm-12">
                <ul class="breadcrumb">
                    <?php 
                    $totalItems = count($array_var);
                    foreach($array_var as $index => $breadcrumb): ?>
                        <li class="breadcrumb-item">
                            <?php if (!empty($breadcrumb['url'])): ?>
                                <a href="<?= htmlspecialchars($breadcrumb['url']); ?>">
                                    <?= htmlspecialchars($breadcrumb['title']); ?>
                                </a>
                            <?php else: ?>
                                <?= htmlspecialchars($breadcrumb['title']); ?>
                            <?php endif; ?>
                        </li>
                        <?php if ($index < $totalItems - 1): // Check if not the last item ?>
                            <li class="breadcrumb-item"><i class="feather-chevron-right"></i></li>
                        <?php endif; ?>
                    <?php endforeach; ?>
                </ul>
            </div>
        </div>
    </div>
    <!-- /Page Header -->
    <?php 
}