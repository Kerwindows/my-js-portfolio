fetch(`${base_url}/ajax/medicalOnScheduleAjax`)
    .then(response => {
        return response.json()
    })
    .then(data => {
        const template = document.getElementById('data-template');
        const container = document.getElementById('data-container');
        data.forEach(itemData => {
            const instance = template.content.cloneNode(true);
            instance.querySelector('[data-field="image"]').src = `assets/img/profiles/${itemData.image}`;
            instance.querySelector('[data-field="name"]').textContent = itemData.name;
            instance.querySelector('[data-field="diagnosis"]').textContent = itemData.diagnosis;
            instance.querySelector('[data-field="schedule"]').textContent = itemData.schedule;
            container.appendChild(instance);
        });
    })
.catch(error => console.error(error));