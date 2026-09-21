 // header scroll state
  const header = document.getElementById('siteHeader');
  window.addEventListener('scroll', () => {
    header.classList.toggle('scrolled', window.scrollY > 40);
  });

  // mobile menu toggle -> simple show of primary nav as dropdown
  const toggle = document.getElementById('menuToggle');
  const nav = document.querySelector('.primary-nav');
  toggle.addEventListener('click', () => {
    const open = nav.style.display === 'block';
    nav.style.display = open ? 'none' : 'block';
    if(!open){
      nav.style.position='absolute';
      nav.style.top='100%';
      nav.style.left='0';
      nav.style.right='0';
      nav.style.background='rgba(14,27,58,.98)';
      nav.style.padding='24px 28px';
    }
    nav.querySelectorAll('ul').forEach(ul=>{ ul.style.flexDirection='column'; ul.style.gap='18px'; });
  });

  // fx-in reveal for section headers only (single intentional use, not per-card)
  const fxEls = document.querySelectorAll('.fx-in');
  const fxObserver = new IntersectionObserver((entries)=>{
    entries.forEach(e=>{
      if(e.isIntersecting){ e.target.classList.add('in'); fxObserver.unobserve(e.target); }
    });
  }, {threshold:.3});
  fxEls.forEach(el=>fxObserver.observe(el));

  // process timeline: fills gold bar + activates dots as it scrolls into view
  const steps = document.querySelectorAll('.step');
  const fill = document.getElementById('timelineFill');
  const timeline = document.getElementById('timeline');
  let timelineDone = false;
  const timelineObserver = new IntersectionObserver((entries)=>{
    entries.forEach(e=>{
      if(e.isIntersecting && !timelineDone){
        timelineDone = true;
        fill.style.width = '80%';
        steps.forEach((s, i)=>{
          setTimeout(()=> s.classList.add('active'), i*260);
        });
      }
    });
  }, {threshold:.5});
  if(timeline) timelineObserver.observe(timeline);

  // stats band: count numbers up once when scrolled into view
  const countEls = document.querySelectorAll('.js-count');
  const reduceMotion = window.matchMedia('(prefers-reduced-motion: reduce)').matches;
  const countObserver = new IntersectionObserver((entries)=>{
    entries.forEach(e=>{
      if(!e.isIntersecting) return;
      countObserver.unobserve(e.target);
      const el = e.target;
      const end = parseInt(el.dataset.count, 10) || 0;
      if(reduceMotion){ el.textContent = end.toLocaleString('en-US'); return; }
      const duration = 1600;
      const start = performance.now();
      const tick = (now)=>{
        const p = Math.min((now - start) / duration, 1);
        const eased = 1 - Math.pow(1 - p, 3);
        el.textContent = Math.round(end * eased).toLocaleString('en-US');
        if(p < 1) requestAnimationFrame(tick);
      };
      requestAnimationFrame(tick);
    });
  }, {threshold:.6});
  countEls.forEach(el=>countObserver.observe(el));