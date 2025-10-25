// تحقق بسيط من العميل
document.addEventListener('DOMContentLoaded', () => {
  const forms = document.querySelectorAll('form[data-validate]');
  forms.forEach(f => {
    f.addEventListener('submit', (e) => {
      const required = f.querySelectorAll('[required]');
      let ok = true;
      required.forEach(inp => {
        if (!inp.value.trim()) ok = false;
      });
      if (!ok) {
        e.preventDefault();
        alert('رجاءً املأ الحقول المطلوبة.');
      }
    });
  });
});
