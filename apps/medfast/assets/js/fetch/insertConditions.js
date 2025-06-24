document.addEventListener('DOMContentLoaded', function() {
   
    function handleFormSubmit(event) {
    event.preventDefault();
    const form = event.target;
    const formData = new FormData(form);

    fetch(`${base_url}/ajax/insert_condition`, {
        method: 'POST',
        body: formData,
    })
    .then(response => response.text())  // First, get the response as text
    .then(text => {
       
        return JSON.parse(text);  // Manually parse the text to JSON
    })
    .then(data => {
        //console.log('Success:', data);
        Swal.fire({
            toast: true,
            position: "top-end",
            showConfirmButton: false,
            timer: 3000,
            timerProgressBar: true,
            icon: "success",
            title: 'Saved successfully',
        });
    })
    .catch(error => {
       // console.error('Error:', error);
        Swal.fire({
            toast: true,
            position: "top-end",
            showConfirmButton: false,
            timer: 3000,
            timerProgressBar: true,
            icon: "error",
            title: error.message || 'An unknown error occurred.',
        });
    });
}


    const observer = new MutationObserver(mutations => {
        mutations.forEach(mutation => {
            mutation.addedNodes.forEach(node => {
                if (node.nodeType === 1 && node.tagName === 'FORM') {
                    node.addEventListener('submit', handleFormSubmit);
                    //console.log("Submit handler attached to a form");
                }
            });
        });
    });

    observer.observe(document.body, { childList: true, subtree: true });
    Array.from(document.querySelectorAll('form')).forEach(form => {
        form.addEventListener('submit', handleFormSubmit);
    });
});