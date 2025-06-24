// Toggle Full-screen Menu


const texts = [
  "Hi, I'm Kerwin Thompson, a web developer with over 7 years of professional experience in full stack development. I love crafting digital experiences through engaging web apps that are intuitive and functional.",
  "I'm excited to share my portfolio with you. It's simple yet demonstrates a love for creativity and innovation in design.",  
  "Let's work together to bring ideas to life, creating experiences that users enjoy and remember!",
  "I'm committed for the long haul, ready to dedicate my career to delivering impactful and lasting results."
];

	
const typedTextElement = document.getElementById("typed-text");
const cursorElement = document.querySelector(".hero__cursor");
let textIndex = 0;
let charIndex = 0;
let isErasing = false;	

function toggleMenu() {
    const fullscreenMenu = document.querySelector('.fullscreen-menu');
    fullscreenMenu.classList.toggle('active');
}

// Close fullscreen menu when a link is clicked
document.querySelectorAll('.fullscreen-menu__link').forEach(link => {
    link.addEventListener('click', () => {
        const fullscreenMenu = document.querySelector('.fullscreen-menu');
        fullscreenMenu.classList.remove('active');
    });
});



// Smooth scrolling for menu links
document.querySelectorAll('.navbar__link').forEach(link => {
    link.addEventListener('click', function (e) {
        e.preventDefault();
        const targetId = this.getAttribute('href').slice(1); // Remove the '#' from the href
        const targetElement = document.getElementById(targetId);
        
        targetElement.scrollIntoView({
            behavior: 'smooth',
            block: 'start'
        });
    });
});

//Typed text
function type() {
  if (!isErasing && charIndex < texts[textIndex].length) {
    // Typing the current character
    typedTextElement.innerHTML += texts[textIndex].charAt(charIndex);
    charIndex++;

    let delay = 20;
    const currentChar = texts[textIndex].charAt(charIndex - 1);

    if (currentChar === ',') {
      delay = 500; // Pause after comma
    } else if (currentChar === '.') {
      delay = 800; // Longer pause after period
    }

    setTimeout(type, delay);
  } else if (isErasing && charIndex > 0) {
    // Erasing the current character
    typedTextElement.innerHTML = texts[textIndex].substring(0, charIndex - 1);
    charIndex--;
    setTimeout(type, 5);
  } else {
    // Switch between typing and erasing mode, or move to next text
    if (!isErasing && charIndex === texts[textIndex].length) {
      isErasing = true;
      setTimeout(type, 2500); // Pause before erasing
    } else if (isErasing && charIndex === 0) {
      isErasing = false;
      textIndex = (textIndex + 1) % texts.length; // Move to the next text, looping back if at the end
      setTimeout(type, 500); // Pause before typing next text
    }
  }
}

type();


//float contact
const popupTriggers = document.querySelectorAll("#open-popup, #open-popup-2");

// Add the event listener to each element to open popup
popupTriggers.forEach(trigger => {
  trigger.addEventListener("click", function () {
    document.getElementById("popup-container").classList.add("float__popup-container--active");
    document.getElementById("background-overlay").classList.add("active"); // Show overlay with blur
  });
});

// Close popup by clicking close button
document.getElementById("close-popup").addEventListener("click", function () {
  document.getElementById("popup-container").classList.remove("float__popup-container--active");
  document.getElementById("background-overlay").classList.remove("active"); // Hide overlay
});

// Close popup by clicking outside the popup container
window.addEventListener("click", function (event) {
  const popupContainer = document.getElementById("popup-container");
  if (event.target === document.getElementById("background-overlay")) {
    popupContainer.classList.remove("float__popup-container--active");
    document.getElementById("background-overlay").classList.remove("active"); // Hide overlay
  }
});

window.addEventListener("load", function () {
  const button = document.getElementById("open-popup");

  // Add initial animation on load
  button.classList.add("float__button--animated");

  // Remove the class after a few bounces
  setTimeout(() => {
    button.classList.remove("float__button--animated");
  }, 3000); // 3 seconds, adjust as needed
});