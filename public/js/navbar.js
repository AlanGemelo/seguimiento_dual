document.addEventListener('DOMContentLoaded', function () {

  /* SECCION DE SIDE MENU */
  const sidebar = document.getElementById('sidebar');
  const openBtn = document.getElementById('openSidebar');
  const closeBtn = document.getElementById('closeSidebar');
  const overlay = document.getElementById('overlay');

  /* Abrir sidebar y mostrar overlay */
  if (openBtn) {
    openBtn.addEventListener('click', function () {
      sidebar.classList.add('show');
      overlay.classList.add('show');
    });
  }

  /* Cerrar sidebar y ocultar overlay */
  function closeSidebar() {
    sidebar.classList.remove('show');
    overlay.classList.remove('show');
  }

  if (closeBtn) {
    closeBtn.addEventListener('click', closeSidebar);
  }

  /* Cerrar sidebar al hacer clic sobre overlay */
  if (overlay) {
    overlay.addEventListener('click', closeSidebar);
  }

  /* Cerrar el sidebar cuando el usuario hace clic fuera del menú en vista móvil */
  document.addEventListener('click', function (e) {

    if (
      sidebar.classList.contains('show') &&
      !sidebar.contains(e.target) &&
      !openBtn.contains(e.target)
    ) {
      sidebar.classList.remove('show');
    }

  });

  /* Controlar la apertura y cierre de los submenús del sidebar */
  document.querySelectorAll('.menu-toggle').forEach(function (toggle) {

    toggle.addEventListener('click', function () {

      const group = this.parentElement;
      const submenu = group.querySelector('.submenu');

      /* Cerrar otros submenús abiertos */
      document.querySelectorAll('.menu-group').forEach(function (item) {
        if (item !== group) {
          item.classList.remove('open');
          const otherSub = item.querySelector('.submenu');
          if (otherSub) otherSub.classList.remove('open');
        }
      });

      /* Alternar el estado del submenú seleccionado */
      group.classList.toggle('open');
      submenu.classList.toggle('open');

    });

  });

  /* Abrir automáticamente el submenú cuando contiene un elemento activo */
  document.querySelectorAll('.submenu').forEach(function (submenu) {
    if (submenu.querySelector('.active')) {
      submenu.classList.add('open');
      submenu.parentElement.classList.add('open');
    }
  });

});