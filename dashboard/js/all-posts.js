const table_content = document.getElementById('table_content');
const articleModal = document.getElementById('articleModal');

//Fonction d'affichage
let posts_data =[];
let id;
function display_data(){
    table_content.innerHTML='';
    fetch("db/all-posts-data.php")
    .then(r=>r.json())
    .then((data)=>{
        posts_data=data;
        for(let i=0;i<data.length;i++){
            table_content.innerHTML+=`
            <tr class="article_info">
                <td style="width:100px"><img class="img-fluid post_image" src="db/${data[i].post_image}" alt="image"></td>
                <td class="post-title">${data[i].post_title}</td>
                <td>${data[i].post_category}</td>
                <td>${data[i].post_date}</td>
                <td><button class="btn btn-primary btn-sm" onclick="update_post('${i}')">Mise à jour</button></td>
                <td><button class="btn btn-danger btn-sm" onclick="delete_post('${data[i].post_id}')">Supprimer</button></td>
            </tr>`;
        }
    });
}
display_data();

// Fonction de recherche
function searchArticles() {
    const query = document.getElementById('searchInput').value.toLowerCase();
    const rows = document.querySelectorAll('.article_info');
    
    rows.forEach(row => {
        const title = row.querySelector('.post-title').textContent.toLowerCase();
        
        if (title.includes(query) || query === '') {
            row.style.display = 'table-row';
        } else {
            row.style.display = 'none';
        }
    });
}

// Fonction de Suppression
function delete_post(id){
    if (confirm('Voulez-vous supprimer cet article ?')){
        fetch("db/delete-post.php",{
            headers:{
                'Content-Type': 'application/json'
            },
            method: 'post',
            body: JSON.stringify({'id': id})
        })
        .then(r=>r.json())
        .then(data=>{
            if(data.success==true)
                display_data();
        })
    }
}


// Update post function

const title= document.getElementById('articleTitle');
const category= document.getElementById('articleCategory');
const post_content= document.getElementById('post_content');
const post_image= document.getElementById('post_image');
const update_btn = document.getElementById('update_btn');
const dark_membrane = document.getElementById('dark_membrane');
const close_btn = document.getElementById('close-btn');

function update_post(i){
    id=posts_data[i].post_id;
    dark_membrane.style.display='block';
    articleModal.style.display='flex';
    title.value=posts_data[i].post_title;
    category.value=posts_data[i].post_category;
    post_content.value=posts_data[i].post_content;
}
function closeModal(){
    dark_membrane.style.display='none';
    articleModal.style.display='none';
}
category.innerHTML='';
fetch("db/all-categories-data.php")
.then(r=>r.json())
.then((data)=>{
    for(let i=0;i<data.length;i++){
        category.innerHTML+=`
        <option value="${data[i].category_name}">${data[i].category_name}</option>`;
    }
})

update_btn.addEventListener('click',function(){
    dark_membrane.style.display='none';
    articleModal.style.display='none';
    let formData = new FormData();
    formData.append('id', id);
    formData.append('title', title.value);
    formData.append('category', category.value);
    formData.append('content', post_content.value);
    formData.append('image', post_image.files[0]);

    fetch("db/update-post.php", {
        method: 'POST',
        body: formData
    })
    .then(r=>r.json())
    .then(data=>{
        if(data.success=true){
            display_data();
        }
        
    })
})