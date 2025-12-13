const slides = document.querySelectorAll('.slide');
const prev = document.querySelector('.prev');
const next = document.querySelector('.next');
const dots = document.querySelectorAll('.dot');

let index = 0;

function showSlide(i) {
    slides.forEach((s, j) => s.classList.toggle('active', j === i));
    dots.forEach((d, j) => d.classList.toggle('active', j === i));
}

// Only add carousel listeners if elements exist
if (prev && next && dots.length > 0) {
    prev.onclick = () => {
        index = (index - 1 + slides.length) % slides.length;
        showSlide(index);
    }

    next.onclick = () => {
        index = (index + 1) % slides.length;
        showSlide(index);
    }

    // Cliquer sur un point pour naviguer
    dots.forEach(dot => {
        dot.addEventListener('click', () => {
            index = Number.parseInt(dot.getAttribute('data-index'));
            showSlide(index);
        });
    });
}

// Défilement automatique
//     setInterval(() => {
//         index = (index + 1) % slides.length;
//         showSlide(index);
//     }, 5000);
// 

// --- Responsive header: toggle du menu hamburger ---
document.addEventListener('DOMContentLoaded', () => {
    const navToggle = document.getElementById('nav-toggle');
    const navMenu = document.getElementById('nav-menu');

    if (!navToggle || !navMenu) return;

    navToggle.addEventListener('click', (e) => {
        e.stopPropagation();
        const isOpen = navMenu.classList.toggle('open');
        navToggle.classList.toggle('active', isOpen);
        navToggle.setAttribute('aria-expanded', isOpen ? 'true' : 'false');
    });

    // Fermer le menu avec la touche Escape
    document.addEventListener('keydown', (e) => {
        if (e.key === 'Escape' && navMenu.classList.contains('open')) {
            navMenu.classList.remove('open');
            navToggle.classList.remove('active');
            navToggle.setAttribute('aria-expanded', 'false');
            navToggle.focus();
        }
    });

    // Fermer en cliquant à l'extérieur (pour mobile)
    document.addEventListener('click', (e) => {
        const target = e.target;
        if (navMenu.classList.contains('open') && !navMenu.contains(target) && target !== navToggle && !navToggle.contains(target)) {
            navMenu.classList.remove('open');
            navToggle.classList.remove('active');
            navToggle.setAttribute('aria-expanded', 'false');
        }
    });

    // Fermer le menu quand on clique sur un lien
    const navLinks = navMenu.querySelectorAll('a');
    navLinks.forEach(link => {
        link.addEventListener('click', () => {
            navMenu.classList.remove('open');
            navToggle.classList.remove('active');
            navToggle.setAttribute('aria-expanded', 'false');
        });
    });
});