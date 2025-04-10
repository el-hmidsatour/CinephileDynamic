document.addEventListener('DOMContentLoaded', function() {
    // Activer les tooltips Bootstrap
    var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
    var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
        return new bootstrap.Tooltip(tooltipTriggerEl);
    });

    // Gestion du menu actif
    const sidebarLinks = document.querySelectorAll('.sidebar-link');
    sidebarLinks.forEach(link => {
        link.addEventListener('click', function(e) {
            sidebarLinks.forEach(l => l.classList.remove('active'));
            this.classList.add('active');
        });
    });

    // Animation des cartes statistiques
    const statCards = document.querySelectorAll('.stat-card');
    statCards.forEach(card => {
        card.addEventListener('mouseenter', function() {
            this.querySelector('i').style.transform = 'scale(1.2)';
        });
        card.addEventListener('mouseleave', function() {
            this.querySelector('i').style.transform = 'scale(1)';
        });
    });

    // Gestion du formulaire d'ajout
    const addForm = document.querySelector('form');
    if (addForm) {
        addForm.addEventListener('submit', function(e) {
            e.preventDefault();
            // Ici vous pouvez ajouter la logique pour envoyer les données
            alert('Film ajouté avec succès!');
            this.reset();
        });
    }
});
// Animation de déconnexion
document.getElementById('logoutBtn').addEventListener('click', function() {
    this.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Déconnexion...';
    this.style.opacity = '0.7';
    this.disabled = true;
    
    setTimeout(() => {
        localStorage.removeItem('adminAuth');
        window.location.href = 'login.html';
    }, 800); // Délai pour l'animation
});
