document.addEventListener('DOMContentLoaded', function() {
  // Dropdowns principales
  var dropdownElements = [].slice.call(document.querySelectorAll('.dropdown-toggle'));
  dropdownElements.map(function(element) {
    element.addEventListener('click', function(e) {
      // Solo manejar si es un submenú
      if (this.closest('.dropdown-submenu')) {
        e.preventDefault();
        e.stopPropagation();
        var submenu = this.nextElementSibling;
        submenu.classList.toggle('show');
        
        // Cerrar otros submenús
        var allSubmenus = [].slice.call(document.querySelectorAll('.dropdown-submenu .dropdown-menu'));
        allSubmenus.map(function(menu) {
          if (menu !== submenu) menu.classList.remove('show');
        });
      }
    });
  });

  // Cerrar menús al hacer clic fuera
  document.addEventListener('click', function(e) {
    if (!e.target.closest('.dropdown')) {
      var openMenus = [].slice.call(document.querySelectorAll('.dropdown-menu.show'));
      openMenus.map(function(menu) {
        menu.classList.remove('show');
      });
    }
  });
});