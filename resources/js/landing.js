import Alpine from 'alpinejs';
window.Alpine = Alpine;

// ── Navbar Scroll Effect ──
document.addEventListener('DOMContentLoaded', () => {
  const navbar = document.querySelector('.landing-navbar');
  if (navbar) {
    window.addEventListener('scroll', () => {
      if (window.scrollY > 50) {
        navbar.classList.add('navbar-scrolled');
      } else {
        navbar.classList.remove('navbar-scrolled');
      }
    });
  }
});

Alpine.start();
