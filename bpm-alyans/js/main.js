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

// Hero Dropdown - Свободная техника
document.querySelectorAll('.hero-dropdown__toggle').forEach(function(btn) {
  btn.addEventListener('click', function(e) {
    e.preventDefault();
    e.stopPropagation();
    btn.closest('.hero-dropdown').classList.toggle('active');
  });
});
document.addEventListener('click', function(e) {
  document.querySelectorAll('.hero-dropdown.active').forEach(function(dd) {
    if (!dd.contains(e.target)) dd.classList.remove('active');
  });
});

// Modal: Рассчитать стоимость
document.querySelectorAll('[data-open-modal]').forEach(function(btn) {
  btn.addEventListener('click', function(e) {
    e.preventDefault();
    var modalId = btn.getAttribute('data-open-modal');
    var modal = document.getElementById(modalId);
    if (modal) {
      modal.classList.add('active');
      document.body.style.overflow = 'hidden';
    }
    // Close mobile nav if open
    if (mobileNav && mobileNav.classList.contains('active')) closeMobileNav();
  });
});

function closeModal(modal) {
  modal.classList.remove('active');
  document.body.style.overflow = '';
}

document.querySelectorAll('.modal__close').forEach(function(btn) {
  btn.addEventListener('click', function() {
    closeModal(btn.closest('.modal-overlay'));
  });
});

document.querySelectorAll('.modal-overlay').forEach(function(overlay) {
  overlay.addEventListener('click', function(e) {
    if (e.target === overlay) closeModal(overlay);
  });
});

document.addEventListener('keydown', function(e) {
  if (e.key === 'Escape') {
    document.querySelectorAll('.modal-overlay.active').forEach(closeModal);
  }
});

// Lightbox for crane scheme images
(function() {
  var overlay = document.createElement('div');
  overlay.className = 'lightbox-overlay';
  overlay.innerHTML = '<button class="lightbox-overlay__close" aria-label="Закрыть">&times;</button><img src="" alt="">';
  document.body.appendChild(overlay);

  var lbImg = overlay.querySelector('img');
  var lbClose = overlay.querySelector('.lightbox-overlay__close');

  function openLightbox(src, alt) {
    lbImg.src = src;
    lbImg.alt = alt || '';
    overlay.classList.add('active');
    document.body.style.overflow = 'hidden';
  }

  function closeLightbox() {
    overlay.classList.remove('active');
    document.body.style.overflow = '';
    lbImg.src = '';
  }

  document.querySelectorAll('[data-lightbox]').forEach(function(link) {
    link.addEventListener('click', function(e) {
      e.preventDefault();
      openLightbox(link.href, link.querySelector('img') ? link.querySelector('img').alt : '');
    });
  });

  lbClose.addEventListener('click', closeLightbox);
  overlay.addEventListener('click', function(e) {
    if (e.target === overlay) closeLightbox();
  });
  document.addEventListener('keydown', function(e) {
    if (e.key === 'Escape' && overlay.classList.contains('active')) closeLightbox();
  });
})();

// Smooth scroll to anchors with dynamic header offset
(function() {
  var EXTRA_GAP = 16; // extra px below header

  function getHeaderHeight() {
    var h = document.querySelector('.header');
    return h ? h.offsetHeight : 0;
  }

  function smoothScrollTo(target) {
    var targetTop = target.getBoundingClientRect().top + window.pageYOffset;
    var offset = getHeaderHeight() + EXTRA_GAP;
    window.scrollTo({ top: targetTop - offset, behavior: 'smooth' });
    // Correction pass — lazy images may shift layout during scroll
    setTimeout(function() {
      var correctedTop = target.getBoundingClientRect().top + window.pageYOffset;
      var correctedPos = correctedTop - offset;
      if (Math.abs(window.pageYOffset - correctedPos) > 5) {
        window.scrollTo({ top: correctedPos, behavior: 'smooth' });
      }
    }, 600);
  }

  // Handle clicks on anchor links
  document.addEventListener('click', function(e) {
    var link = e.target.closest('a[href*="#"]');
    if (!link) return;
    // Skip modal openers and lightbox links
    if (link.hasAttribute('data-open-modal') || link.hasAttribute('data-lightbox')) return;

    var href = link.getAttribute('href');
    if (!href) return;

    // Extract hash part
    var hashIndex = href.indexOf('#');
    if (hashIndex === -1) return;
    var hash = href.substring(hashIndex);
    if (hash === '#' || hash === '') return;

    // For cross-page links (href has path before #), let browser navigate
    var beforeHash = href.substring(0, hashIndex);
    if (beforeHash && beforeHash !== window.location.pathname && beforeHash !== '.') return;

    var target = document.querySelector(hash);
    if (!target) return;

    e.preventDefault();
    smoothScrollTo(target);
    // Update URL hash without jumping
    if (history.pushState) history.pushState(null, null, hash);
  });

  // Handle hash on page load (e.g. /tower-cranes/#detail-wa6013)
  if (window.location.hash) {
    // Wait for DOM and images to settle a bit
    window.addEventListener('load', function() {
      var target = document.querySelector(window.location.hash);
      if (target) {
        // Prevent native jump, then scroll correctly
        window.scrollTo(0, 0);
        setTimeout(function() { smoothScrollTo(target); }, 100);
      }
    });
  }
})();

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
