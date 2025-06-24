<?php 

function footer($array_var = []){ ?>

    </div><!--content-->
    </div><!--page-wrapper-->
    </div><!--main-wrapper-->

    <div class="sidebar-overlay" data-reff=""></div>
    <!-- jQuery -->
    <script nonce='<?php echo htmlspecialchars($_SESSION['nonce']) ?>' src="<?php echo base_url() ?>/assets/js/jquery-3.7.1.min.js"></script>
    <!-- Bootstrap Core JS -->
    <script nonce='<?php echo htmlspecialchars($_SESSION['nonce']) ?>' src="<?php echo base_url() ?>/assets/js/bootstrap.bundle.min.js"></script>
    <?php javascript($array_var['js_scripts'] ?? []); ?>
 

    </body>
    </html>
<?php }