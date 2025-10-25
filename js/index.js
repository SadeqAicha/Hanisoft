// Back to top functionality
window.addEventListener('scroll', () => {
  const backToTop = document.querySelector('.back-to-top');
  const navbar = document.querySelector('.navbar');
  backToTop.classList.toggle('show', window.scrollY > 300);
  navbar.classList.toggle('scrolled', window.scrollY > 50);
});

function scrollToTop() {
  window.scrollTo({ top: 0, behavior: 'smooth' });
}

function scrollToServices() {
  document.getElementById('services').scrollIntoView({ behavior: 'smooth' });
}

// Contact form
const contactForm = document.getElementById('contactForm');
if (contactForm) {
  const contact_name=document.getElementById('contact_name');
  const contact_email=document.getElementById('contact_email');
  const contact_message=document.getElementById('contact_message');
  contactForm.addEventListener('submit', e => {
    e.preventDefault();
    fetch("dashboard/db/insert-message.php", {
      headers: {
          'Content-Type': 'application/json'
      },
      method: 'POST',
      body: JSON.stringify({'name': contact_name.value, 'email': contact_email.value, 'message': contact_message.value})
    })
    .then(r=>r.json())
    .then(data=>{
      if(data.success==true){
          alert('Merci pour votre message ! Nous vous contacterons bientôt.');
          contactForm.reset();
      }else{
          alert(data.error);
      }
    });
  });
}

// Counter animation
function animateCounter(element, target, addPlus = false) {
  let current = 0;
  const duration = 2000;
  const stepTime = 20;
  const increment = target / (duration / stepTime);

  const timer = setInterval(() => {
    current += increment;
    if (current >= target) {
      current = target;
      clearInterval(timer);
    }
    element.textContent = Math.floor(current) + (addPlus ? '+' : '');
  }, stepTime);
}

const statsObserver = new IntersectionObserver(entries => {
  entries.forEach(entry => {
    if (entry.isIntersecting) {
      const statNumbers = entry.target.querySelectorAll('.stat-number');
      statNumbers.forEach((stat, index) => {
        const target = parseInt(stat.getAttribute('data-target'), 10);
        const addPlus = stat.hasAttribute('data-plus');
        setTimeout(() => animateCounter(stat, target, addPlus), index * 200);
      });
      statsObserver.unobserve(entry.target);
    }
  });
});

const statsSection = document.querySelector('.stats-section');
if (statsSection) statsObserver.observe(statsSection);
