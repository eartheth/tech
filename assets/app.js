
// Basic site-wide JS for tabs, quizzes, nav effects, and a playful confetti burst.
document.addEventListener('DOMContentLoaded',() => {
  // Tabs
  document.querySelectorAll('[data-tabs]').forEach(group => {
    const buttons = group.querySelectorAll('[role="tab"]');
    const panels = group.querySelectorAll('[role="tabpanel"]');
    buttons.forEach(btn => {
      btn.addEventListener('click', () => {
        buttons.forEach(b => b.setAttribute('aria-selected','false'));
        panels.forEach(p => p.classList.remove('active'));
        btn.setAttribute('aria-selected','true');
        const id = btn.getAttribute('aria-controls');
        group.querySelector('#'+id).classList.add('active');
      });
    });
  });

  // Quiz logic (placeholder-friendly: no real content needed)
  document.querySelectorAll('.quiz').forEach(quiz => {
    const result = quiz.querySelector('.result');
    quiz.querySelector('.submit')?.addEventListener('click', () => {
      // Simple feedback with no correctness (since content is placeholder)
      result.textContent = 'Submitted! This is just a demo — replace with your own questions & answers.';
      confetti(quiz);
    });
    quiz.querySelector('.reset')?.addEventListener('click', () => {
      quiz.querySelectorAll('input[type=radio]').forEach(r => r.checked = false);
      result.textContent = '';
    });
  });

  // Tiny confetti burst for delightful feedback
  function confetti(root){
    const n = 24;
    for(let i=0;i<n;i++){
      const s = document.createElement('span');
      s.className='confetto';
      const size = 6 + Math.random()*8;
      Object.assign(s.style,{
        position:'absolute',width:size+'px',height:size+'px',
        background: ['#60a5fa','#3b82f6','#fde68a','#fb923c'][Math.floor(Math.random()*4)],
        top:'0px',left:'50%',transform:`translateX(-50%) rotate(${Math.random()*360}deg)`,
        borderRadius:'2px',pointerEvents:'none',opacity:1,transition:'all .9s ease'
      });
      root.appendChild(s);
      requestAnimationFrame(()=>{
        s.style.top = (20 + Math.random()*60) + 'px';
        s.style.left = (30 + Math.random()*40*(Math.random()<.5?-1:1)) + '%';
        s.style.opacity = 0;
      });
      setTimeout(()=>s.remove(), 1000);
    }
  }
});
