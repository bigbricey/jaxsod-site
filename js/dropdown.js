/**
 * Dropdown Menu Functionality
 * Handles dropdown menu interactions for both desktop and mobile
 */
document.addEventListener('DOMContentLoaded', function() {
    // Mobile dropdown toggle
    const dropdownItems = document.querySelectorAll('.nav-menu li.has-dropdown');
    
    // For mobile: toggle dropdown on click
    if (window.innerWidth <= 991) {
        dropdownItems.forEach(item => {
            const link = item.querySelector('a');
            
            link.addEventListener('click', function(e) {
                // Only prevent default if it's a parent dropdown link
                if (this.parentNode.classList.contains('has-dropdown')) {
                    e.preventDefault();
                    item.classList.toggle('active');
                }
            });
        });
    }
    
    // Add mobile menu toggle functionality
    const mobileMenuToggle = document.querySelector('.mobile-menu-toggle');
    const navMenu = document.querySelector('.nav-menu');
    
    if (mobileMenuToggle && navMenu) {
        mobileMenuToggle.addEventListener('click', function() {
            navMenu.classList.toggle('active');
            this.setAttribute('aria-expanded', 
                this.getAttribute('aria-expanded') === 'true' ? 'false' : 'true'
            );
        });
    }
    
    // Close dropdowns when clicking outside
    document.addEventListener('click', function(e) {
        if (!e.target.closest('.nav-menu')) {
            dropdownItems.forEach(item => {
                item.classList.remove('active');
            });
            
            if (navMenu && navMenu.classList.contains('active') && mobileMenuToggle) {
                navMenu.classList.remove('active');
                mobileMenuToggle.setAttribute('aria-expanded', 'false');
            }
        }
    });
    
    // Update navigation behavior on window resize
    window.addEventListener('resize', function() {
        if (window.innerWidth > 991) {
            // Remove active class from all dropdowns in desktop view
            dropdownItems.forEach(item => {
                item.classList.remove('active');
            });
        }
    });
});
