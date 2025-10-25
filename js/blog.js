const posts_container = document.getElementById('posts_container');
const last_posts = document.getElementById('last-posts');
const categories = document.getElementById('categories');

last_posts.innerHTML='';
posts_container.innerHTML='';
categories.innerHTML='';

// Section d'affichage des articles
function affichage(){
posts_container.innerHTML='';
fetch("dashboard/db/all-posts-data.php")
.then(r=>r.json())
.then((data)=>{
    for(let i=0;i<data.length;i++){
        posts_container.innerHTML+=`
        <div class="post">
            <div class="post-image">
            <img src="dashboard/db/${data[i].post_image}" alt="image" onclick="read_more('${data[i].post_id}')">
            </div>
            <div class="post-title"><b onclick="read_more('${data[i].post_id}')">${data[i].post_title}</b></div>
            <div class="post-details">
                <p class="post-info">
                    <span><i class="fa-solid fa-user"></i>Admin</span>
                    <span><i class="fa-solid fa-tags"></i>${data[i].post_category}</span>
                    <span><i class="fa-solid fa-calendar-days"></i>${data[i].post_date}</span>
                </p>
                <p class="read_mode_text">${data[i].post_content}</p>
                <button onclick="read_more('${data[i].post_id}')" name="read_more_btn" class="btn btn-custom">Lire plus</button>
            </div>
        </div>`;
    }

    // Section de Derniers articles
    for(let i=data.length-1;i>=0;i--){
        if(i<=(data.length-1)-5) break;
        last_posts.innerHTML+=`
        <a onclick="read_more('${data[i].post_id}')">
            <li onclick="read_more('${data[i].post_id}')">
                <span><img src=dashboard/db/${data[i].post_image} alt="image"></span>
                <span>${data[i].post_title}</span>
            </li>
        </a>`;
    }
});
}
affichage();

// Section de Categories
fetch("dashboard/db/all-categories-data.php")
.then(r=>r.json())
.then((data)=>{
    categories.innerHTML+=`
        <li onclick="affichage()">
            <span><i class="fa-solid fa-tags"></i></span>
            <span>Tous</span>
        </li>`;
    for(let i=0;i<data.length;i++){
        categories.innerHTML+=`
        <a onclick="display_selon_cat('${data[i].category_name}')">
            <li>
                <span><i class="fa-solid fa-tags"></i></span>
                <span>${data[i].category_name}</span>
            </li>        
        </a>`;
    }
})

/// Fonction de l'affichage selon categorie
function display_selon_cat(cat_name){
    posts_container.innerHTML='';
    fetch("dashboard/db/all-posts-data.php")
    .then(r=>r.json())
    .then((data)=>{
        for(let i=0;i<data.length;i++){
            if(data[i].post_category == cat_name){
            posts_container.innerHTML+=`
            <div class="post">
                <div class="post-image">
                <img src="dashboard/db/${data[i].post_image}" alt="image" onclick="read_more('${data[i].post_id}')">
                </div>
                <div class="post-title" onclick="read_more('${data[i].post_id}')"><b>${data[i].post_title}</b></div>
                <div class="post-details">
                    <p class="post-info">
                        <span><i class="fa-solid fa-user"></i>Aicha</span>
                        <span><i class="fa-solid fa-tags"></i>${data[i].post_category}</span>
                        <span><i class="fa-solid fa-calendar-days"></i>${data[i].post_date}</span>
                    </p>
                    <p class="read_mode_text">${data[i].post_content}</p>
                    <button onclick="read_more('${data[i].post_id}')" class="btn btn-custom">Read more</button>
                </div>
            </div>`;
            }
        }
    })
}

//Fonction de Recherche
function searchArticles() {
    const query = document.getElementById('searchInput').value.toLowerCase();
    const cards = document.querySelectorAll('.post');
    
    cards.forEach(card => {
        const title = card.querySelector('.post-title').textContent.toLowerCase();
        const excerpt = card.querySelector('.post-details').textContent.toLowerCase();
        
        if (title.includes(query) || excerpt.includes(query) || query === '') {
            card.style.display = 'block';
        } else {
            card.style.display = 'none';
        }
    });
}
function read_more(id) {
    location.href = `read_more.php?id=${encodeURIComponent(id)}`;
}

// Button de Retour haut ^
window.addEventListener('scroll', () => {
  const backToTop = document.querySelector('.back-to-top');
  backToTop.classList.toggle('show', window.scrollY > 300);
});

function scrollToTop() {
  window.scrollTo({ top: 0, behavior: 'smooth' });
}