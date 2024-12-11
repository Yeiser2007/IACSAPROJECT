
document.addEventListener('DOMContentLoaded', function () {
    const currentLocation = window.location.pathname;
    const menuItems = document.querySelectorAll('.sidebar ul li a.nav-link');
    var icon = document.getElementById('icon-toggle');
    var toggle = document.getElementById('toggleSidebar');
    

    // Apply active class based on URL
    menuItems.forEach(item => {
        if (item.getAttribute('href') === currentLocation) {
            item.parentElement.classList.add('active');
        }

        item.addEventListener('click', function () {
            menuItems.forEach(i => i.parentElement.classList.remove('active'));
            this.parentElement.classList.add('active');
        });
    });

    // Handle collapse functionality
    const dropdowns = document.querySelectorAll('.sidebar .dropdown-toggle');
    dropdowns.forEach(dropdown => {
        dropdown.addEventListener('click', function () {
            const submenus = document.querySelectorAll('.sidebar .collapse');
            submenus.forEach(submenu => {
                if (submenu !== this.nextElementSibling) {
                    $(submenu).collapse('hide');
                }
            });
        });
    });
    function updateIcon() {
        if (window.innerWidth < 992) {
            
            icon.classList.remove('bi-x-lg');
            icon.classList.add('bi-list');
        }
    }

    window.addEventListener('resize', updateIcon);
    updateIcon(); // Initial check
    toggle.addEventListener('click', function () {
        var sidebar = document.getElementById('sidebar');
        sidebar.classList.toggle('active');

        if (window.innerWidth < 992) {
        if (sidebar.classList.contains('active')) {
            toggle.classList.remove('btn-toggle2');
            icon.classList.remove('bi-x-lg');
            icon.classList.add('bi-list');

         
        } else {
            toggle.classList.add('btn-toggle2');
            icon.classList.remove('bi-list');
            icon.classList.add('bi-x-lg');
        }
        }else if (sidebar.classList.contains('active')) {
                
            icon.classList.remove('bi-list');
            icon.classList.add('bi-x-lg');
            } else {
                icon.classList.remove('bi-x-lg');
                icon.classList.add('bi-list');
            }
    
        
    });
});