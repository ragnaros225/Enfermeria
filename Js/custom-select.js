// Custom select for registro
// This script replaces native <select> with a custom dropdown for .registro-fields

document.addEventListener('DOMContentLoaded', function () {
  // Aplica el custom select tanto en registro como en pretest/posttest
  document.querySelectorAll('.registro-fields .custom-select, .formulario-layout .custom-select, .pretest-card-glass .custom-select').forEach(function (selectWrapper) {
    const select = selectWrapper.querySelector('select');
    const selected = document.createElement('div');
    selected.className = 'select-selected';
    selected.textContent = select.options[select.selectedIndex]?.text || select.options[0]?.text || '';
    selectWrapper.appendChild(selected);

    const optionsList = document.createElement('div');
    optionsList.className = 'select-items select-hide';
    for (let i = 0; i < select.options.length; i++) {
      const option = document.createElement('div');
      option.textContent = select.options[i].text;
      if (select.options[i].disabled) {
        option.className = 'disabled';
      }
      // Estética: alineación y color
      option.style.textAlign = 'right';
      option.style.padding = '12px 24px';
      option.style.borderRadius = '18px';
      option.style.marginBottom = '6px';
      option.style.background = '#fff';
      option.style.fontWeight = '500';
      option.style.transition = 'background 0.2s, color 0.2s';
      option.style.cursor = select.options[i].disabled ? 'not-allowed' : 'pointer';
      option.addEventListener('click', function (e) {
        if (select.options[i].disabled) return;
        select.selectedIndex = i;
        selected.textContent = this.textContent;
        optionsList.querySelectorAll('.same-as-selected').forEach(el => el.classList.remove('same-as-selected'));
        this.classList.add('same-as-selected');
        select.dispatchEvent(new Event('change'));
        selected.click();
      });
      option.addEventListener('mouseenter', function () {
        if (!select.options[i].disabled) {
          option.style.background = '#e8edf3';
          option.style.color = '#26425A';
        }
      });
      option.addEventListener('mouseleave', function () {
        option.style.background = '#fff';
        option.style.color = '';
      });
      optionsList.appendChild(option);
    }
    selectWrapper.appendChild(optionsList);

    selected.addEventListener('click', function (e) {
      e.stopPropagation();
      closeAllSelect(this);
      optionsList.classList.toggle('select-hide');
      selected.classList.toggle('select-arrow-active');
    });
  });

  function closeAllSelect(elmnt) {
    document.querySelectorAll('.select-items').forEach(function (list) {
      if (elmnt !== list.previousSibling) {
        list.classList.add('select-hide');
      }
    });
    document.querySelectorAll('.select-selected').forEach(function (sel) {
      if (elmnt !== sel) {
        sel.classList.remove('select-arrow-active');
      }
    });
  }

  document.addEventListener('click', closeAllSelect);
});
