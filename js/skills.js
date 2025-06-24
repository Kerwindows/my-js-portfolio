// Define the skills data
  const skills = [
    { name: "HTML5", imgUrl: "https://raw.githubusercontent.com/devicons/devicon/master/icons/html5/html5-original.svg" },
    { name: "CSS3", imgUrl: "https://raw.githubusercontent.com/devicons/devicon/master/icons/css3/css3-plain-wordmark.svg" },
    { name: "JavaScript", imgUrl: "https://raw.githubusercontent.com/devicons/devicon/master/icons/javascript/javascript-original.svg" },
    { name: "PHP", imgUrl: "https://camo.githubusercontent.com/92a977256f3f2b4ef99e6684c1d88f1ac0394ed909893e5e56cb3539a31f2590/68747470733a2f2f63646e2e6a7364656c6976722e6e65742f67682f64657669636f6e732f64657669636f6e2f69636f6e732f7068702f7068702d6f726967696e616c2e737667" },
    { name: "MySQL", imgUrl: "https://fs.kerwindows.com/img/mysql.png" },
    { name: "PostgreSQL", imgUrl: "https://raw.githubusercontent.com/Kerwindows/Kerwindows/ba9b82987c6c4191c4f7e2aa963fac6ab2fd89cc/files/PostgreSQL.svg" },
    { name: "Laravel", imgUrl: "https://raw.githubusercontent.com/Kerwindows/Kerwindows/main/files/laravel.png?raw=true" },
    { name: "React", imgUrl: "https://github.com/devicons/devicon/raw/master/icons/react/react-original-wordmark.svg" },
    { name: "Redux", imgUrl: "https://github.com/devicons/devicon/raw/master/icons/redux/redux-original.svg" },
    { name: "Node", imgUrl: "https://github.com/devicons/devicon/raw/master/icons/nodejs/nodejs-original-wordmark.svg" },
    { name: "Git", imgUrl: "https://github.com/devicons/devicon/raw/master/icons/git/git-original-wordmark.svg" },
    { name: "Python", imgUrl: "https://raw.githubusercontent.com/Kerwindows/Kerwindows/00bc5494078c0e18e2721f1b151da7dc1ac58a7b/files/python.svg" },
    { name: "Figma", imgUrl: "https://github.com/Kerwindows/Kerwindows/raw/main/files/figma.svg" },
    { name: "REST API", imgUrl: "https://fs.kerwindows.com/img/restapi.svg"},
    { name: "WordPress", imgUrl: "https://fs.kerwindows.com/img/wordpress-logo-icon.svg", style: "width: 100px;" },
    { name: "Google Analytics", imgUrl: "https://cdn-icons-png.flaticon.com/128/998/998331.png", style: "width: 88px;" }
  ];

document.addEventListener("DOMContentLoaded", function() {
    const skillsGrid = document.getElementById("skillsGrid");

    // Add shimmer placeholders
    skillsGrid.classList.add('skills__shimmer-wrapper');
    for (let i = 0; i < skills.length; i++) {
        const skills__shimmer = document.createElement('div');
        skills__shimmer.classList.add('skills__shimmer');
        skillsGrid.appendChild(skills__shimmer);
    }

    // Simulate data loading with a timeout
    setTimeout(() => {
        // Clear shimmer placeholders
        skillsGrid.innerHTML = ''; // Clear all shimmer placeholders
        skillsGrid.classList.remove('skills__shimmer-wrapper'); // Remove shimmer class

        // Populate actual skills data
        skills.forEach(skill => {
            const skillItem = document.createElement("div");
            skillItem.classList.add("skills__item");

            // Apply inline style only if specified
            if (skill.style) {
                skillItem.style.cssText = skill.style;
            }

            const skillIcon = document.createElement("img");
            skillIcon.src = skill.imgUrl;
            skillIcon.alt = skill.name;
            skillIcon.classList.add("skills__icon");

            const skillName = document.createElement("h3");
            skillName.classList.add("skills__name");
            skillName.textContent = skill.name;

            // Append elements
            skillItem.appendChild(skillIcon);
            skillItem.appendChild(skillName);
            skillsGrid.appendChild(skillItem);
        });
    }, 1800); // Simulate 2 seconds of loading time
});