<div class="col-sm-12">
    <div class="card card-table show-entire">
        <div class="card-body">
            <!-- Table Header -->
            <div class="page-table-header mb-2">
                <div class="row align-items-center">
                    <div class="col">
                        <div class="doctor-table-blk">
                            <h3>Patient List</h3>
                            <div class="doctor-search-blk">
                                <div class="top-nav-search table-search-blk">
                                    <form>
                                        <input type="text" class="form-control" id="search-input" placeholder="Search here" autocomplete="off">
                                        <a class="btn"><img src="<?php echo base_url() ?>/assets/img/icons/search-normal.svg" alt=""></a>
                                    </form>
                                </div>
                                <div class="add-group">
                                    <a href="/patient/add" class="btn btn-primary add-pluss ms-2"><img src="<?php echo base_url() ?>/assets/img/icons/plus.svg" alt="Add"></a>
                                    <a href="#" class="btn btn-primary doctor-refresh ms-2"><img src="<?php echo base_url() ?>/assets/img/icons/re-fresh.svg" alt="Refresh"></a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-auto text-end float-end ms-auto download-grp">
                        <!-- Potential place for download buttons -->
                    </div>
                </div>
            </div>
            <!-- /Table Header -->
            <div class="table-responsive">
                <table id="medtable" class="table border-0 custom-table comman-table datatable mb-0">
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>Gender</th>
                            <th>Dob</th>
                            <th>Email</th>
                            <th>Phone</th>
                            <th>Joining Date</th>
                            <th>Options</th>
                            <th>Status</th>
                        </tr>
                    </thead>

                    <tbody>
                        <tr style="display:none">
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                        </tr>
                    </tbody>
                </table>
                <center>
                    <div id="spinner" class="spinner-border text-primary mb-3" style="display: none;" role="status">
                        <span class="visually-hidden">Loading...</span>
                    </div>
                </center>
            </div>
        </div>
    </div>
</div>
<template id="patientRowTemplate">
    <tr>
        
        <td class="profile-image">
            <a class="profile-link" href="#">
                <img class="rounded-circle m-r-5 profile_img" width="28" height="28" src="" alt="">
                <span class="patient-name"></span>
            </a>
        </td>
        <td class="patient-sex"></td>
        <td class="patient-dob"></td>
        <td class="patient-email"></td>
        <td><a class="patient-phone" href="#"></a></td>
        <td class="patient-registered"></td>
         <td class="patient-options">
        	<a class="btn btn-sm btn-default patient-profile" href="#" title="View Public profile" data-bs-toggle="tooltip" data-bs-placement="top"><i class="fa-duotone fa-user"></i></a>
        	<a class="btn btn-sm btn-default patient-edit" href="#" title="Edit Details" data-bs-toggle="tooltip" data-bs-placement="top"><i class="fa-duotone fa-user-pen"></i></a>
        	<a class="btn btn-sm btn-default patient-appointments" href="#" title="View Appointments" data-bs-toggle="tooltip" data-bs-placement="top"><i class="fa-light fa-calendar-check"></i></a>
        	<a class="btn btn-sm btn-default set-patient-appointment" href="#" title="Create Appointment" data-bs-toggle="tooltip" data-bs-placement="top"><i class="fa-light fa-calendar"></i></a>
        	<a class="btn btn-sm btn-default patient-visitation" href="#" title="New Visit" data-bs-toggle="tooltip" data-bs-placement="top"><i class="fa-sharp fa-regular fa-stethoscope"></i></a>
        	<a class="btn btn-sm btn-default patient-conditions" href="#" title="View Conditions" data-bs-toggle="tooltip" data-bs-placement="top"><i class="fa-light fa-notes-medical"></i></a>
        	<a class="btn btn-sm btn-default patient-delete" href="#" title="Delete" data-bs-toggle="tooltip" data-bs-placement="top"><i class="fa-regular fa-trash"></i></a>
        	
        </td>
        <td><span class="custom-badge status-badge"></span></td>
    </tr>
</template>
<script nonce="<?= htmlspecialchars($_SESSION['nonce']); ?>">

document.addEventListener('DOMContentLoaded', function() {
    let currentPage = 1;
    let isLoading = false;
    let searchTimeout = null;
    let scrollTimeout = null;
    const searchInput = document.getElementById('search-input');
    const spinner = document.getElementById('spinner');

    // Initialize DataTable
    const table = $('#medtable').DataTable({
        "bFilter": false, // Disable DataTables own search functionality since you implement custom search
        "paging": false,
        "lengthChange": false,
        "searching": false,
        "ordering": true,
        "info": false,
        "autoWidth": true,
        "responsive": false,
        "dom": 'Bfrtip',    // Include 'B' for buttons
        "buttons": [
	    {
	        extend: 'copy',
	        className: 'btn btn-secondary',
	        text: '<span class="fas fa-copy btn-print"></span>',
	        attr:  {
	            title: 'Copy to clipboard',
	            'data-bs-toggle': 'tooltip',
	            'data-bs-placement': 'top'
	        }
	    },
	    {
	        extend: 'csv',
	        className: 'btn btn-secondary',
	        text: '<span class="fas fa-file-csv btn-print"></span>',
	        attr:  {
	            title: 'Export as CSV',
	            'data-bs-toggle': 'tooltip',
	            'data-bs-placement': 'top'
	        }
	    },
	    {
	        extend: 'excel',
	        className: 'btn btn-secondary',
	        text: '<span class="fas fa-file-excel btn-print"></span>',
	        attr:  {
	            title: 'Export as Excel',
	            'data-bs-toggle': 'tooltip',
	            'data-bs-placement': 'top'
	        }
	    },
	    {
	        extend: 'pdf',
	        className: 'btn btn-secondary',
	        text: '<span class="fas fa-file-pdf btn-print"></span>',
	        attr:  {
	            title: 'Export as PDF',
	            'data-bs-toggle': 'tooltip',
	            'data-bs-placement': 'top'
	        }
	    },
	    {
	        extend: 'print',
	        className: 'btn btn-secondary',
	        text: '<span class="fas fa-print btn-print"></span>',
	        attr:  {
	            title: 'Print table',
	            'data-bs-toggle': 'tooltip',
	            'data-bs-placement': 'top'
	        }
	    },
	    /*{
	        extend: 'colvis',
	        className: 'btn btn-secondary',
	        text: '<span class="fas fa-columns"></span>',
	        postfixButtons: ['colvisRestore'],
	        attr:  {
	            title: 'Column visibility',
	            'data-bs-toggle': 'tooltip',
	            'data-bs-placement': 'top'
	        }
	    }*/
	],
        "columnDefs": [
            { "orderable": false, "targets": 0 }
        ]
    });
    table.buttons().container().appendTo('.download-grp:eq(0)');

    function showSpinner() {
        spinner.style.display = 'block';
    }

    function hideSpinner() {
        spinner.style.display = 'none';
    }


    
    function setupPatientRow(patient) {
    const template = document.getElementById('patientRowTemplate');
    if (!template) {
        console.error('Patient row template not found!');
        return null;
    }

    const clone = document.importNode(template.content, true);
    const row = clone.querySelector('tr');
    if (!row) {
        console.error('No table row in template!');
        return null;
    }

    // Ensure each element exists before attempting to modify it
    const profileImage = row.querySelector(".profile_img");
    const profileLink = row.querySelector(".profile-link");
    const patientName = row.querySelector(".patient-name");
    const patientSex = row.querySelector(".patient-sex");
    const patientDob = row.querySelector(".patient-dob");
    const patientEmail = row.querySelector(".patient-email");
    const phoneLink = row.querySelector(".patient-phone");
    const patientRegistered = row.querySelector(".patient-registered");
    const statusBadge = row.querySelector(".custom-badge");
    const patientProfile = row.querySelector(".patient-profile");
    const patientAppointment = row.querySelector(".set-patient-appointment");
    const patientEdit = row.querySelector(".patient-edit");
    const patientEditPublic = row.querySelector(".patient-edit-public");
    const patientAppointments = row.querySelector(".patient-appointments");
    const patientVisitation = row.querySelector(".patient-visitation");
    const patientConditions = row.querySelector(".patient-conditions");

    // Set values safely, checking for null
    if (patientProfile) patientProfile.href = `${base_url}/patient/profile/${patient.uid}`;
    if (patientAppointment) patientAppointment.href = `${base_url}/patient/new-appointment/${patient.uid}`;
    if (patientEdit) patientEdit.href = `${base_url}/patient/edit/${patient.uid}`;
    if (patientEditPublic) patientEditPublic.href = `${base_url}/patient/public-profile/edit/${patient.uid}`;
    if (patientVisitation) patientVisitation.href = `${base_url}/patient/visit/new/${patient.uid}`;
    if (patientConditions) patientConditions.href = `${base_url}/patient/conditions/${patient.uid}`;
    if (profileImage != null) {
    profileImage.src = patient.image ? `${base_url}${patient.image}` : `${base_url}/assets/img/patients/default.jpg`;
}

    if (profileLink) profileLink.href = `${base_url}/patient/dashboard/${patient.uid}`;
    if (patientName) patientName.textContent = `${patient.fname} ${patient.lname}`;
    if (patientSex) patientSex.textContent = patient.sex;
    if (patientDob) patientDob.textContent = patient.dob;
    if (patientEmail) patientEmail.textContent = patient.email;
    if (phoneLink) {
        phoneLink.href = `tel:${patient.phone}`;
        phoneLink.textContent = patient.phone;
    }
    console.log(profileImage.src)
   
    if (patientRegistered) patientRegistered.textContent = patient.registered_on;
    if (patientAppointments) patientAppointments.href = `${base_url}/patient/appointments/view/${patient.uid}`;
    if (statusBadge) {
        statusBadge.textContent = patient.status === 'active' ? 'Active' : 'Inactive';
        statusBadge.className = 'custom-badge ' + (patient.status === 'active' ? 'status-green' : 'status-red');
    }

    return row;
}


    function loadMoreData(page, query, isNewSearch = false) {
        if (isLoading) return;
        isLoading = true;
        showSpinner();

        fetch(`${base_url}/ajax/get-patients?page=${page}&query=${encodeURIComponent(query)}`, {
            method: 'GET',
            headers: { 'Content-Type': 'application/json' }
        })
        .then(response => response.json())
        .then(data => {
            if (isNewSearch) {
                table.clear(); // Clear DataTables on new search
            }
            data.data.forEach(patient => {
                const newRow = setupPatientRow(patient);
                if (newRow) {
                    table.row.add(newRow).draw(false);
                }
            });
            if (data.morePages) {
                currentPage++;
            } else {
                window.removeEventListener('scroll', checkScroll);
            }
            // Reinitialize tooltips after adding new rows
    	    enableTooltipsInTable(); // Call this function to activate tooltips for new elements
        })
        .catch(error => {
            console.error('Error fetching data:', error);
            spinner.innerHTML = "!";
        })
        .finally(() => {
            hideSpinner();
            isLoading = false;
        });
    }
    
    function enableTooltipsInTable() {
    // Select tooltips within the table only to avoid reinitializing other tooltips on the page unnecessarily
    var tooltipTriggerList = [].slice.call(document.querySelectorAll('#medtable [data-bs-toggle="tooltip"]'));
    var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
        return new bootstrap.Tooltip(tooltipTriggerEl);
    });
}

    function checkScroll() {
        const threshold = 100;
        if (!isLoading && (window.innerHeight + window.scrollY) >= document.body.offsetHeight - threshold) {
            clearTimeout(scrollTimeout);
            scrollTimeout = setTimeout(() => {
                loadMoreData(currentPage, searchInput.value.trim(), false);
            }, 1000);
        }
    }

    searchInput.addEventListener('keyup', function() {
        clearTimeout(searchTimeout);
        searchTimeout = setTimeout(() => {
            loadMoreData(1, this.value.trim(), true);
            currentPage = 1;
        }, 500);
    });

    window.addEventListener('scroll', checkScroll);
    loadMoreData(currentPage, '', true); // Initial load with an empty query
});


</script>