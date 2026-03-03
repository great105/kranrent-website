// Mobile Navigation
const burgerBtn = document.getElementById('burgerBtn');
const mobileNav = document.getElementById('mobileNav');
const mobileClose = document.getElementById('mobileClose');
const mobileOverlay = document.getElementById('mobileOverlay');

function openMobileNav() {
  mobileNav.classList.add('active');
  mobileOverlay.classList.add('active');
  document.body.style.overflow = 'hidden';
}

function closeMobileNav() {
  mobileNav.classList.remove('active');
  mobileOverlay.classList.remove('active');
  document.body.style.overflow = '';
}

if (burgerBtn) burgerBtn.addEventListener('click', openMobileNav);
if (mobileClose) mobileClose.addEventListener('click', closeMobileNav);
if (mobileOverlay) mobileOverlay.addEventListener('click', closeMobileNav);

// FAQ Accordion
document.querySelectorAll('.faq-item__question').forEach(btn => {
  btn.addEventListener('click', () => {
    const item = btn.parentElement;
    const answer = item.querySelector('.faq-item__answer');
    const isActive = item.classList.contains('active');

    // Close all
    document.querySelectorAll('.faq-item').forEach(el => {
      el.classList.remove('active');
      el.querySelector('.faq-item__answer').style.maxHeight = null;
    });

    // Open clicked if was closed
    if (!isActive) {
      item.classList.add('active');
      answer.style.maxHeight = answer.scrollHeight + 'px';
    }
  });
});

// Sticky header shadow on scroll
const header = document.querySelector('.header');
if (header) {
  window.addEventListener('scroll', () => {
    if (window.scrollY > 10) {
      header.style.boxShadow = '0 2px 12px rgba(0,0,0,0.12)';
    } else {
      header.style.boxShadow = '0 2px 8px rgba(0,0,0,0.08)';
    }
  });
}

// CF7: Pre-select service dropdown based on page body class
document.addEventListener('DOMContentLoaded', function() {
  var select = document.querySelector('.wpcf7 select[name="service"]');
  if (!select) return;

  var body = document.body.className;
  var preselect = '';

  if (body.indexOf('page-template-page-tower-cranes') !== -1) {
    preselect = 'Аренда башенного крана';
  } else if (body.indexOf('page-template-page-mobile-cranes') !== -1) {
    preselect = 'Аренда автомобильного крана';
  } else if (body.indexOf('page-template-page-crawler-cranes') !== -1) {
    preselect = 'Аренда гусеничного крана';
  } else if (body.indexOf('page-template-page-installation') !== -1) {
    preselect = 'Монтаж и проектирование';
  }

  if (preselect) {
    for (var i = 0; i < select.options.length; i++) {
      if (select.options[i].text === preselect) {
        select.selectedIndex = i;
        break;
      }
    }
  }
});
