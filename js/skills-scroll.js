const skills = [
    { name: "HTML5", imgUrl: "https://raw.githubusercontent.com/devicons/devicon/master/icons/html5/html5-original.svg" },
    { name: "CSS3", imgUrl: "https://raw.githubusercontent.com/devicons/devicon/master/icons/css3/css3-plain-wordmark.svg" },
    { name: "JavaScript", imgUrl: "https://raw.githubusercontent.com/devicons/devicon/master/icons/javascript/javascript-original.svg" },
    { name: "jQuery", imgUrl: "https://fs.kerwindows.com/img/jquery.png"},
    { name: "TypeScript", imgUrl: "https://fs.kerwindows.com/img/typescript.svg"},
    { name: "PHP", imgUrl: "https://camo.githubusercontent.com/92a977256f3f2b4ef99e6684c1d88f1ac0394ed909893e5e56cb3539a31f2590/68747470733a2f2f63646e2e6a7364656c6976722e6e65742f67682f64657669636f6e732f64657669636f6e2f69636f6e732f7068702f7068702d6f726967696e616c2e737667" },
    { name: "MySQL", imgUrl: "https://fs.kerwindows.com/img/mysql.png" },
    { name: "MongoDB", imgUrl: "https://fs.kerwindows.com/img/mongodb.svg"},
    { name: "PostgreSQL", imgUrl: "https://raw.githubusercontent.com/Kerwindows/Kerwindows/ba9b82987c6c4191c4f7e2aa963fac6ab2fd89cc/files/PostgreSQL.svg" },
    { name: "Laravel", imgUrl: "https://raw.githubusercontent.com/Kerwindows/Kerwindows/main/files/laravel.png?raw=true" },
    { name: "React", imgUrl: "https://github.com/devicons/devicon/raw/master/icons/react/react-original-wordmark.svg" },
    { name: "Redux", imgUrl: "https://github.com/devicons/devicon/raw/master/icons/redux/redux-original.svg" },
    { name: "Node", imgUrl: "https://github.com/devicons/devicon/raw/master/icons/nodejs/nodejs-original-wordmark.svg" },
    { name: "Vue", imgUrl: "https://fs.kerwindows.com/img/vue-icon.png" },
    { name: "Git", imgUrl: "https://github.com/devicons/devicon/raw/master/icons/git/git-original-wordmark.svg" },
    { name: "Python", imgUrl: "https://raw.githubusercontent.com/Kerwindows/Kerwindows/00bc5494078c0e18e2721f1b151da7dc1ac58a7b/files/python.svg" },
    { name: "Figma", imgUrl: "https://github.com/Kerwindows/Kerwindows/raw/main/files/figma.svg", style: "width: 100px;" },
    { name: "REST API", imgUrl: "https://fs.kerwindows.com/img/restapi.svg"},
    { name: "WordPress", imgUrl: "https://fs.kerwindows.com/img/wordpress-logo-icon.svg", style: "width: 100px;" },
    { name: "Drupal", imgUrl: "https://fs.kerwindows.com/img/drupal.png"},
    { name: "OpenCart", imgUrl: "https://fs.kerwindows.com/img/OpenCart.png"},
    { name: "Google Analytics", imgUrl: "https://cdn-icons-png.flaticon.com/128/998/998331.png", style: "width: 88px;" }
  ];
  
  document.addEventListener("DOMContentLoaded", function () {
  const skillsRow1 = document.getElementById("skillsRow1");
  const skillsRow2 = document.getElementById("skillsRow2");

  const midpoint = Math.ceil(skills.length / 2);
  const skillsRow1Data = skills.slice(0, midpoint);
  const skillsRow2Data = skills.slice(midpoint);

  function createSkillItem(skill) {
    const skillItem = document.createElement("div");
    skillItem.classList.add("skills__item");

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

    skillItem.appendChild(skillIcon);
    skillItem.appendChild(skillName);
    return skillItem;
  }

  function populateRow(row, skillsList) {
    for (let i = 0; i < 2; i++) {
      skillsList.forEach(skill => {
        const item = createSkillItem(skill);
        row.appendChild(item);
      });
    }
  }

  populateRow(skillsRow1, skillsRow1Data);
  populateRow(skillsRow2, skillsRow2Data);
});