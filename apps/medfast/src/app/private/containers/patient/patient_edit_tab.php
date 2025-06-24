<div class="col-12">
								<div class="card bg-white">
									<div class="card-header">
										<h5 class="card-title"></h5>
									</div>
									<div class="card-body">
										<ul class="nav nav-tabs nav-tabs-solid nav-tabs-rounded nav-justified">
    <li class="nav-item"><a class="nav-link active" href="#solid-rounded-justified-tab1" data-bs-toggle="tab">Medical History</a></li>
    <li class="nav-item"><a class="nav-link" href="#solid-rounded-justified-tab3" data-bs-toggle="tab" data-url="<?php echo base_url() ?>/ajax/patient_disease_substance_abuse">Substance Abuse</a></li>
    
</ul>
										<div class="tab-content">
											<div class="tab-pane show active" id="solid-rounded-justified-tab1">
												<?php include(PRIVATE_CONTAINERS_PATH.'/patient/patient_disease_medical_history.php'); ?>
											</div>
											<div class="tab-pane" id="solid-rounded-justified-tab2">
											    <div class="shimmer mb-2" style="width:100%; height:25px;"></div>
											    <div class="shimmer mb-2" style="width:100%; height:25px;"></div>
										            <div class="shimmer" style="width:60%; height:25px;"></div>
											</div>
											<div class="tab-pane" id="solid-rounded-justified-tab3">
												Tab content 3
											</div>
										</div>
									</div>
								</div>
							</div>
							
							
<script nonce="<?= htmlspecialchars($_SESSION['nonce']); ?>">
document.addEventListener("DOMContentLoaded", function() {
    const tabs = document.querySelectorAll('.nav-link[data-url]');
    tabs.forEach(tab => {
        tab.addEventListener('click', function(e) {
            e.preventDefault(); // Prevent default anchor click behavior
            const paneId = this.getAttribute('href');
            const pane = document.querySelector(paneId);
            const url = this.getAttribute('data-url');
            
            // Data to be sent to the server using PHP to inject the current user's ID
            let formData = new FormData();
            formData.append('patientID', '<?php echo $array_var['current_user_info']['uid']; ?>');

            // Only load content if it has not been loaded before
            if (!pane.getAttribute('data-loaded')) {
                fetch(url, {
                    method: 'POST',
                    body: formData,
                    credentials: 'same-origin' // Include credentials to comply with typical CORS policies
                })
                .then(response => {
                    if (!response.ok) {
                        throw new Error('Network response was not ok');
                    }
                    return response.text();
                })
                .then(html => {
                    pane.innerHTML = html;
                    pane.setAttribute('data-loaded', 'true');
                    Array.from(pane.querySelectorAll("script")).forEach(oldScript => {
                        const newScript = document.createElement("script");
                        newScript.nonce = '<?= htmlspecialchars($_SESSION['nonce']); ?>';  // Set nonce
                        Array.from(oldScript.attributes)
                            .forEach(attr => newScript.setAttribute(attr.name, attr.value));
                        newScript.appendChild(document.createTextNode(oldScript.innerHTML));
                        oldScript.parentNode.replaceChild(newScript, oldScript);
                    });
                })
                .catch(error => {
                    console.error('Failed to load content:', error);
                    pane.innerHTML = `<p style="color: red;">Error loading content!</p>`;
                });
            }
        });
    });
});

</script>