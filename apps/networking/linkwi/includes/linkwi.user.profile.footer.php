<div id="mobileTooltip" class="tooltip">
        For a better experience, please view this website on a mobile device.
    </div>
    
    <!-- JS -->
<!--<script src="<?php echo base_url_dir() ?>/js/jquery-3.5.1.min.js"></script>-->
<script src="<?php echo base_url_dir() ?>/js/jquery.easing.1.3.js"></script>
<script src="<?php echo base_url_dir() ?>/js/bootstrap.bundle.min.js"></script>
<script src="<?php echo base_url_dir() ?>/js/SmoothScroll.js"></script>
<script src="<?php echo base_url_dir() ?>/js/jquery.scrollTo.min.js"></script>
<script src="<?php echo base_url_dir() ?>/js/jquery.localScroll.min.js"></script>
<script src="<?php echo base_url_dir() ?>/js/jquery.viewport.mini.js"></script>
<!--<script src="<?php echo base_url_dir() ?>/js/jquery.countTo.js"></script>-->
<script src="<?php echo base_url_dir() ?>/js/jquery.appear.js"></script>
<script src="<?php echo base_url_dir() ?>/js/jquery.parallax-1.1.3.js"></script>
<script src="<?php echo base_url_dir() ?>/js/jquery.fitvids.js"></script>
<script src="<?php echo base_url_dir() ?>/js/owl.carousel.min.js"></script>
<script src="<?php echo base_url_dir() ?>/js/isotope.pkgd.min.js"></script>
<script src="<?php echo base_url_dir() ?>/js/imagesloaded.pkgd.min.js"></script>
<script src="<?php echo base_url_dir() ?>/js/jquery.magnific-popup.min.js"></script>
<script src="<?php echo base_url_dir() ?>/js/masonry.pkgd.min.js"></script>-->
<script src="<?php echo base_url_dir() ?>/js/jquery.lazyload.min.js"></script>
<script src="<?php echo base_url_dir() ?>/js/wow.min.js"></script>
<script src="<?php echo base_url_dir() ?>/js/morphext.js"></script>
<script src="<?php echo base_url_dir() ?>/js/typed.min.js"></script>
<script src="<?php echo base_url_dir() ?>/js/all.js"></script>
<script src="<?php echo base_url_dir() ?>/js/contact-form.js"></script>
<script src="<?php echo base_url_dir() ?>/js/jquery.ajaxchimp.min.js"></script>
<script src="<?php echo base_url_dir() ?>/js/objectFitPolyfill.min.js"></script>
<script src="<?php echo base_url_dir() ?>/js/splitting.min.js"></script>
<script src="<?php echo base_url() ?>/js/link.profilepage.fetch.single.js"></script>
<!--<script src="https://cdn.jsdelivr.net/gh/c-kick/mobileConsole/hnl.mobileconsole.min.js"></script>-->
<?php if ($check) { ?> <script src="<?php echo base_url_dir() ?>/js/link.profilepage.submits.js"></script> <?php } ?>
<script>
/*------------------------share button for old & new browsers----------------------------------*/
const shareButton = document.querySelector('.share-button');
const shareDialog = document.querySelector('#share__profile');
const closeButton = document.querySelector('.colour__popup-close-btn');

shareButton.addEventListener('click', event => {
    if (navigator.share) {
        navigator.share({
                title: '<?php echo $FirstName . ' ' . $LastName ?> LinkWi Business Card ®',
                url: '<?php echo base_url() ?>/card/<?php echo $Username; ?>'
            }).then(() => {
                //console.log('Thanks for sharing!');
            })
            .catch(console.error);
    } else {
        openColourModal('#share__profile', '#share');
    }
});

closeButton.addEventListener('click', event => {
    closeColourModal('#share__profile', '#share');
});

function myFunction() {
    var copyText = document.getElementById("myInput");
    copyText.select();
    copyText.setSelectionRange(0, 99999);
    document.execCommand("copy");
}


        function checkScreenSize() {
            const mobileMaxWidth = 980;
            const tooltip = document.getElementById('mobileTooltip');

            // Check if the screen width is larger than the mobile max width
            if (window.innerWidth > mobileMaxWidth) {
                // Show the tooltip
                tooltip.classList.add('show');
            } else {
                // Hide the tooltip if screen size is within mobile range
                tooltip.classList.remove('show');
            }
        }

        // Run the check when the page loads
        window.onload = checkScreenSize;

        // Optionally, you can also check on window resize
        window.onresize = checkScreenSize;
    </script>
</body>
</html>