(function(){
  const sidebar = document.getElementById('sidebar');
  const toggle = document.getElementById('sidebarToggle');
  const collapsedKey = 'sidebar-collapsed';

  function setCollapsed(collapsed){
    if (!sidebar) return;
    if (collapsed) sidebar.classList.add('collapsed');
    else sidebar.classList.remove('collapsed');
    try { localStorage.setItem(collapsedKey, collapsed ? '1' : '0'); } catch(e){}
  }

  if (toggle){
    toggle.addEventListener('click', function(){
      const isCollapsed = sidebar && sidebar.classList.contains('collapsed');
      setCollapsed(!isCollapsed);
    });
  }

  try {
    const stored = localStorage.getItem(collapsedKey);
    if (stored === '1') setCollapsed(true);
  } catch(e){}

  // Highlight active link on exact path (server already adds .active but this is a fallback)
  const links = document.querySelectorAll('.sidebar .nav-item');
  links.forEach(link => {
    if (link.href === window.location.href) link.classList.add('active');
  });
})();
