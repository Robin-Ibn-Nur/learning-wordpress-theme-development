import './main.css';

document.addEventListener('DOMContentLoaded', () => {
  // 1. Mobile Navigation Toggle
  const mobileToggle = document.getElementById('mobile-menu-toggle');
  const mobileMenu = document.getElementById('mobile-menu');

  if (mobileToggle && mobileMenu) {
    mobileToggle.addEventListener('click', () => {
      const isHidden = mobileMenu.classList.contains('hidden');
      if (isHidden) {
        mobileMenu.classList.remove('hidden');
        mobileToggle.setAttribute('aria-expanded', 'true');
      } else {
        mobileMenu.classList.add('hidden');
        mobileToggle.setAttribute('aria-expanded', 'false');
      }
    });

    const mobileLinks = mobileMenu.querySelectorAll('a');
    mobileLinks.forEach(link => {
      link.addEventListener('click', () => {
        mobileMenu.classList.add('hidden');
        mobileToggle.setAttribute('aria-expanded', 'false');
      });
    });
  }

  // 2. Product Category Filter Tabs
  const filterBtns = document.querySelectorAll('[data-product-filter]');
  const productCards = document.querySelectorAll('[data-product-category]');

  if (filterBtns.length && productCards.length) {
    filterBtns.forEach(btn => {
      btn.addEventListener('click', () => {
        const category = btn.getAttribute('data-product-filter');

        // Update active tab styles
        filterBtns.forEach(b => {
          b.classList.remove('text-neutral-900', 'border-neutral-900', 'font-semibold');
          b.classList.add('text-neutral-500', 'border-transparent', 'font-normal');
        });
        btn.classList.add('text-neutral-900', 'border-neutral-900', 'font-semibold');
        btn.classList.remove('text-neutral-500', 'border-transparent', 'font-normal');

        // Filter cards
        productCards.forEach(card => {
          const cardCats = (card.getAttribute('data-product-category') || '').trim().split(/\s+/);
          if (category === 'all' || cardCats.includes(category)) {
            card.style.display = 'block';
            setTimeout(() => {
              card.style.opacity = '1';
              card.style.transform = 'scale(1)';
            }, 50);
          } else {
            card.style.opacity = '0';
            card.style.transform = 'scale(0.96)';
            setTimeout(() => {
              card.style.display = 'none';
            }, 200);
          }
        });
      });
    });
  }

  // 3. Wishlist Heart Toggle
  const wishlistBtns = document.querySelectorAll('[data-wishlist-btn]');
  const wishlistCounter = document.getElementById('wishlist-counter');
  let wishlistCount = 0;

  wishlistBtns.forEach(btn => {
    btn.addEventListener('click', (e) => {
      e.preventDefault();
      const svg = btn.querySelector('svg');
      const isLiked = btn.getAttribute('data-liked') === 'true';

      if (!isLiked) {
        btn.setAttribute('data-liked', 'true');
        svg.setAttribute('fill', '#c5a880');
        svg.setAttribute('stroke', '#c5a880');
        btn.classList.add('scale-110');
        wishlistCount++;
      } else {
        btn.setAttribute('data-liked', 'false');
        svg.setAttribute('fill', 'none');
        svg.setAttribute('stroke', 'currentColor');
        btn.classList.remove('scale-110');
        wishlistCount = Math.max(0, wishlistCount - 1);
      }

      if (wishlistCounter) {
        wishlistCounter.textContent = wishlistCount;
        wishlistCounter.style.display = wishlistCount > 0 ? 'inline-flex' : 'none';
      }
    });
  });

  // 4. Testimonials Carousel / Arrow Controls
  const testPrev = document.getElementById('test-prev-btn');
  const testNext = document.getElementById('test-next-btn');
  const testTrack = document.getElementById('test-cards-track');

  if (testPrev && testNext && testTrack) {
    testNext.addEventListener('click', () => {
      testTrack.scrollBy({ left: 320, behavior: 'smooth' });
    });
    testPrev.addEventListener('click', () => {
      testTrack.scrollBy({ left: -320, behavior: 'smooth' });
    });
  }

  // 5. Signature Pieces Carousel Arrows
  const prodPrev = document.getElementById('prod-prev-btn');
  const prodNext = document.getElementById('prod-next-btn');
  const prodTrack = document.getElementById('products-scroll-track');

  if (prodPrev && prodNext && prodTrack) {
    prodNext.addEventListener('click', () => {
      prodTrack.scrollBy({ left: 280, behavior: 'smooth' });
    });
    prodPrev.addEventListener('click', () => {
      prodTrack.scrollBy({ left: -280, behavior: 'smooth' });
    });
  }

  // 6. Back to Top Button
  const backToTopBtn = document.getElementById('back-to-top');
  if (backToTopBtn) {
    window.addEventListener('scroll', () => {
      if (window.scrollY > 400) {
        backToTopBtn.classList.remove('opacity-0', 'pointer-events-none');
        backToTopBtn.classList.add('opacity-100');
      } else {
        backToTopBtn.classList.add('opacity-0', 'pointer-events-none');
        backToTopBtn.classList.remove('opacity-100');
      }
    });

    backToTopBtn.addEventListener('click', () => {
      window.scrollTo({ top: 0, behavior: 'smooth' });
    });
  }
});
