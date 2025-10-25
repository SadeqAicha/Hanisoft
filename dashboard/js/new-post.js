const title = document.getElementById('title');
const category = document.getElementById('category');
const post_img=document.getElementById('post-img');
const post_content = document.getElementById('post-text');
const submit_btn = document.getElementById('submit_btn');
const error_sentence = document.getElementById('error-sentence');

category.innerHTML='';
fetch("db/all-categories-data.php")
.then(r=>r.json())
.then((data)=>{
    for(let i=0;i<data.length;i++){
        category.innerHTML+=`
        <option value="${data[i].category_name}">${data[i].category_name}</option>`;
    }
})

submit_btn.addEventListener('click', function () {
    scrollTo(0, 0);
    let title_val = title.value;
    let category_val = category.value || 'General';
    let content_val = post_content.value;
    let img_file = post_img.files[0];
;

    // Validation
    if (!title_val || !img_file || !content_val) {
        error_sentence.innerHTML = `
        <div class="alert alert-warning" role="alert">
            Fill in the blanks!
        </div>`;
        return;
    }
    error_sentence.innerHTML = `
    <div class="alert alert-success" role="alert">
        Success!
    </div>`;

    let formData = new FormData();
    formData.append('title', title_val);
    formData.append('category', category_val);
    formData.append('content', content_val);
    formData.append('image', img_file);

    fetch("db/insert-new-post.php", {
        method: 'POST',
        body: formData
    })
});
