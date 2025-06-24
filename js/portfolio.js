// Sample data for the portfolio items
const imgPath = 'https://fs.kerwindows.com/img';
const portfolioData = [
    /*{
        technology: "HTML & CSS",
        title: "Homeland Landing Page",
        image: `${imgPath}/homeland.webp`,
        alt: "Homeland landing page",
        icons : [],
        link: "./apps/homland-gallary",
        detail: "This is a simple as it gets. Utilizing flex-box and grid techniques to produce a landing page for a tourist site with a deliberate dark theme."
    },*/
    /*{
        technology: "HTML, CSS & JS",
        title: "Soccer League",
        image: `${imgPath}/ssfa.webp`,
        alt: "Soccer League",
        icons : [],
        link: "./apps/ssfa",
        detail: "This is a single-page layout template demonstrating advanced CSS techniques, designed to inspire a larger project."
    },*/
     {
        technology: "HTML, CSS, MERN Stack w/ REST API",
        title: "TrailerView Flix",
        image: `${imgPath}/trailerView-2.webp`,
        icons : ["https://raw.githubusercontent.com/devicons/devicon/master/icons/html5/html5-original.svg","https://raw.githubusercontent.com/devicons/devicon/master/icons/css3/css3-plain-wordmark.svg","https://raw.githubusercontent.com/devicons/devicon/master/icons/javascript/javascript-original.svg","https://fs.kerwindows.com/img/mysql.png","https://github.com/devicons/devicon/raw/master/icons/react/react-original-wordmark.svg","https://github.com/devicons/devicon/raw/master/icons/nodejs/nodejs-original-wordmark.svg","https://github.com/devicons/devicon/raw/master/icons/git/git-original-wordmark.svg","https://fs.kerwindows.com/img/restapi.svg"],
        alt: "Trailer View Flix",
        link: " https://trailerview.kerwindows.com/discover",
        detail: "This front-end project was created for fun as a way to practice my skills with React and REST APIs. It resembles a Netflix-style layout and streams movie trailers directly from YouTube."
    },
    {
        technology: "HTML, CSS, JS, LAMP Stack",
        title: "Linkwi Networking Profile Page",
        image: `${imgPath}/linkwi-3.webp`,
        icons : ["https://raw.githubusercontent.com/devicons/devicon/master/icons/html5/html5-original.svg","https://raw.githubusercontent.com/devicons/devicon/master/icons/css3/css3-plain-wordmark.svg","https://raw.githubusercontent.com/devicons/devicon/master/icons/javascript/javascript-original.svg","https://camo.githubusercontent.com/92a977256f3f2b4ef99e6684c1d88f1ac0394ed909893e5e56cb3539a31f2590/68747470733a2f2f63646e2e6a7364656c6976722e6e65742f67682f64657669636f6e732f64657669636f6e2f69636f6e732f7068702f7068702d6f726967696e616c2e737667","https://fs.kerwindows.com/img/mysql.png"],
        alt: "Linkwi Networking Profile Page",
        link: "https://link.kerwindows.com/card/nailahblackman",
        detail: "User username: lampstackuser, Password: L@mp$tack <br/> Admin username: lampstackuser,  Password: L@mp$tackAdmin <br/>  <br/> This project was created for entrepreneurs and corporate professionals seeking an easy way to showcase their qualifications, contact information, and social media handles at networking events. It works alongside a custom card embedded with a URL for their profile page, accessible via NFC. Users can download the contact information directly to their phones. The application features a backend for both users and administrators, allowing users to place and track orders. Although the purchasing process is a simulation, it provides a clear view of the admin interface. While the system is simple, it has the potential to be expanded further. Registered users can also log in to track visitor views and click rates.<br/> "
    },
    {
        technology: "HTML, CSS, MERN Stack",
        title: "Medicade Medical Software",
        image: `${imgPath}/medfast.webp`,
        alt: "Medfast Medical Admin",
        icons : ["https://raw.githubusercontent.com/devicons/devicon/master/icons/html5/html5-original.svg","https://raw.githubusercontent.com/devicons/devicon/master/icons/css3/css3-plain-wordmark.svg","https://raw.githubusercontent.com/devicons/devicon/master/icons/javascript/javascript-original.svg","https://fs.kerwindows.com/img/mysql.png","https://github.com/devicons/devicon/raw/master/icons/react/react-original-wordmark.svg","https://github.com/devicons/devicon/raw/master/icons/nodejs/nodejs-original-wordmark.svg"],
        link: "https://medicade.kerwindows.com/",
        detail: "Username: kerwindows@hotmail.com, Password:123456789 <br/><br/> This full-stack React project was developed as a prototype for a medical facility aiming to streamline its appointment scheduling system and efficiently manage patient records. <br/>  The application provides a centralized platform where staff can easily book, update, and monitor appointments, access statistics, and maintain secure, well-organized digital records for each patient. It features a public url accessible to emergency personnel via QR code or NFC technology. The system ensures patient data is available only to authorized personnel and is designed with scalability in mind to support future enhancements and integrations, such as automated reminders, patient notifications, and analytical tools for tracking facility performance. "   
    },
    {
        technology: "HTML, CSS, JS, LAMP Stack",
        title: "AI Powered Teaching Assistant",
        image: `${imgPath}/caribucate.webp`,
        icons : ["https://raw.githubusercontent.com/devicons/devicon/master/icons/html5/html5-original.svg","https://raw.githubusercontent.com/devicons/devicon/master/icons/css3/css3-plain-wordmark.svg","https://raw.githubusercontent.com/devicons/devicon/master/icons/javascript/javascript-original.svg","https://camo.githubusercontent.com/92a977256f3f2b4ef99e6684c1d88f1ac0394ed909893e5e56cb3539a31f2590/68747470733a2f2f63646e2e6a7364656c6976722e6e65742f67682f64657669636f6e732f64657669636f6e2f69636f6e732f7068702f7068702d6f726967696e616c2e737667","https://fs.kerwindows.com/img/mysql.png","https://fs.kerwindows.com/img/restapi.svg"],
        alt: "School Database Landing Page",
        link: "https://sis.kerwindows.com",
        detail: "Username: kerwin@cyversify.com, <br/> Password:$Kkj8412 <br/><br/> This application was designed with teachers in mind. Drawing from my own teaching background, I developed a prototype aimed at helping educators streamline their lesson planning using AI. Although it was tailored to suit the Caribbean school system, reflecting my roots, it can be easily adapted to fit any educational system. "
    },
    
   
  {
        technology: "WordPress",
        title: "WP Mobile Multipurpose Theme",
        image: `${imgPath}/adaeze.webp`,
        icons : ["https://raw.githubusercontent.com/devicons/devicon/master/icons/html5/html5-original.svg","https://raw.githubusercontent.com/devicons/devicon/master/icons/css3/css3-plain-wordmark.svg","https://raw.githubusercontent.com/devicons/devicon/master/icons/javascript/javascript-original.svg","https://camo.githubusercontent.com/92a977256f3f2b4ef99e6684c1d88f1ac0394ed909893e5e56cb3539a31f2590/68747470733a2f2f63646e2e6a7364656c6976722e6e65742f67682f64657669636f6e732f64657669636f6e2f69636f6e732f7068702f7068702d6f726967696e616c2e737667","https://fs.kerwindows.com/img/mysql.png","https://fs.kerwindows.com/img/wordpress-logo-icon.svg"],
        alt: "WP Mobile Multipurpose Divi Theme",
        link: "https://adaeze.theme.divimobifirst.com",
        detail: "I chose to highlight this project to demonstrate my familiarity with content management systems and the functionality of WordPress. It was built using the Divi page builder, incorporating custom JavaScript and CSS to create a mobile-responsive site."
    }, 
    {
        technology: "LAMP Stack",
        title: "Ecommerce Custom T-shirt Clothing Store",
        image: `${imgPath}/ecommerce.webp`,
        icons : ["https://raw.githubusercontent.com/devicons/devicon/master/icons/html5/html5-original.svg","https://raw.githubusercontent.com/devicons/devicon/master/icons/css3/css3-plain-wordmark.svg","https://raw.githubusercontent.com/devicons/devicon/master/icons/javascript/javascript-original.svg","https://camo.githubusercontent.com/92a977256f3f2b4ef99e6684c1d88f1ac0394ed909893e5e56cb3539a31f2590/68747470733a2f2f63646e2e6a7364656c6976722e6e65742f67682f64657669636f6e732f64657669636f6e2f69636f6e732f7068702f7068702d6f726967696e616c2e737667","https://fs.kerwindows.com/img/mysql.png"],
        alt: "Ecommerce Store",
        link: "https://estore.kerwindows.com",
        detail: "Admin user: kerwindows@mail.com, Password:123456789  <br/>User: brock@gmail.com, Password:987654321 <br/> <br/> This is the first e-commerce site I ever built. Sharing the flaws and the lessons learned: user interface is very simple and lacked the polished, intuitive design that users expect today. Functionality-wise, everything works well. It includes product filters and recommendations, both of which have become essential in modern e-commerce. The highlight of this project is the custom T-shirt design page. Check it out and let me know what you think."
    }, 
    
];

document.addEventListener("DOMContentLoaded", function() {
    const portfolioGrid = document.querySelector('.portfolio__grid');
    
    // Create shimmer placeholders
    portfolioGrid.classList.add('portfolio__shimmer-wrapper');
    for (let i = 0; i < portfolioData.length; i++) {
        const portfolio__shimmer = document.createElement('div');
        portfolio__shimmer.classList.add('portfolio__shimmer');
        portfolioGrid.appendChild(portfolio__shimmer);
    }

    // Simulate data loading with a timeout
    setTimeout(() => {
        // Clear shimmer placeholders
        portfolioGrid.innerHTML = ''; // Clear all shimmer placeholders
        portfolioGrid.classList.remove('portfolio__shimmer-wrapper'); // Remove shimmer class

        // Populate portfolio items
        const template = document.getElementById('portfolio-item-template').content;
        portfolioData.forEach((item, index) => {
            const clone = template.cloneNode(true); // Clone the template content
            const portfolioItem = clone.querySelector('.portfolio__item');
            
            // Populate the cloned template
            portfolioItem.href = item.link;
            clone.querySelector('.portfolio__img').src = item.image;
            clone.querySelector('.portfolio__img').alt = item.alt;
            clone.querySelector('.portfolio__project-title').textContent = item.title;

            // Populate icons in the portfolio__icons div
            const iconsContainer = clone.querySelector('.portfilio__icons');
            if (item.icons && Array.isArray(item.icons)) {
                item.icons.forEach(iconUrl => {
                    const iconImg = document.createElement('img');
                    iconImg.src = iconUrl;
                    iconImg.alt = `${item.title} icon`;
                    iconImg.classList.add('portfolio__icon'); // Add a class for styling if needed
                    iconsContainer.appendChild(iconImg);
                });
            }

            // Append the cloned element to the portfolio grid
            portfolioGrid.appendChild(clone);

            // Attach click event listener to open the modal
            portfolioItem.addEventListener('click', function(e) {
                e.preventDefault();
                openModal(item); // Pass the correct item data to openModal
            });
        });
    }, 2300); // Simulate 2.3 seconds of loading time
});


// Function to open modal
function openModal(data) {
    const modal = document.getElementById('portfolioModal');
    const downArrow = `<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-chevron-down" viewBox="0 0 24 24"><polyline points="6 9 12 15 18 9"></polyline></svg>`;

    modal.querySelector('.modal__image').src = data.image;
    modal.querySelector('.modal__image').alt = data.alt;
    modal.querySelector('.modal__title').textContent = data.title;
    modal.querySelector('.modal__description').textContent = `Project built with: ${data.technology}`;
    modal.querySelector('.modal__link').href = data.link;
    
    const modalDetail = modal.querySelector('.modal__detail');
    
    // Store the full content in a data attribute for later retrieval
    modalDetail.setAttribute('data-full-content', data.detail.replace(/\n\n/g, '<br /><br />'));

    // Set the modal details to collapsed by default
    const contentLengthThreshold = 150; // Adjust as needed
    if (data.detail.length > contentLengthThreshold) {
        modalDetail.innerHTML = data.detail.substring(0, contentLengthThreshold) + '...';
        modalDetail.classList.add('collapsed');
        modalDetail.classList.remove('expanded');
        
        // Show the "Show more" button
        const toggle = modal.querySelector('.modal__toggle');
        toggle.style.display = 'block';
        toggle.innerHTML = `SHOW MORE  <br/> ${downArrow}`;
        toggle.classList.remove('expanded');
    } else {
        // If the content is short, show the full content and hide the "Show more" button
        modalDetail.innerHTML = data.detail.replace(/\n\n/g, '<br /><br />');
        modalDetail.classList.remove('collapsed');
        modalDetail.classList.add('expanded');
        
        // Hide the toggle if content is short
        const toggle = modal.querySelector('.modal__toggle');
        toggle.style.display = 'none';
    }

    modal.style.display = 'block';
}

// Function to toggle details visibility
function toggleDetails() {
    const modalDetail = document.querySelector('.modal__detail');
    const toggle = document.querySelector('.modal__toggle');
    const downArrow = `<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-chevron-down" viewBox="0 0 24 24"><polyline points="6 9 12 15 18 9"></polyline></svg>`;
    const upArrow = `<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-chevron-up" viewBox="0 0 24 24"><polyline points="18 15 12 9 6 15"></polyline></svg>`;

    if (modalDetail.classList.contains('collapsed')) {
        // Show the full content (restore from data attribute)
        modalDetail.innerHTML = modalDetail.getAttribute('data-full-content');
        modalDetail.classList.remove('collapsed');
        modalDetail.classList.add('expanded');
        toggle.innerHTML = `SHOW LESS <br/> ${upArrow}`;
        
        // Scroll down to the full content after expanding
        modalDetail.scrollIntoView({ behavior: 'smooth', block: 'end' });
    } else {
        // Collapse the content and show the truncated version with "..."
        const truncatedContent = modalDetail.getAttribute('data-full-content').substring(0, 150) + '...';
        modalDetail.innerHTML = truncatedContent;
        modalDetail.classList.add('collapsed');
        modalDetail.classList.remove('expanded');
        toggle.innerHTML = `SHOW MORE  <br/> ${downArrow}`;
    }
}


// Function to close modal
function closeModal() {
    const modal = document.getElementById('portfolioModal');
    modal.style.display = 'none';
}