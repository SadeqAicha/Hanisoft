// Fonction de recherche
function searchArticles() {
    const query = document.getElementById('searchInput').value.toLowerCase();
    const rows = document.querySelectorAll('.compte_info');
    
    rows.forEach(row => {
        const name = row.querySelector('.compte_name').textContent.toLowerCase();
        const email = row.querySelector('.compte_email').textContent.toLowerCase();
        
        if (name.includes(query) || query === '' || email.includes(query)) {
            row.style.display = 'table-row';
        } else {
            row.style.display = 'none';
        }
    });
}