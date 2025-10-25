const category = document.getElementById('category');
const submit_btn = document.getElementById('submit_btn');
const error_sentence = document.getElementById('error-sentence');
const table_content = document.getElementById('table_content');

submit_btn.addEventListener('click', function () {
    // Validation
    console.log('llllllllllll');
    if (!category.value) {
        error_sentence.innerHTML = `
        <div class="alert alert-warning" role="alert">
            Fill in the blanks!
        </div>`;
    }
    
    else if(category.value.length>100){
        error_sentence.innerHTML = `
        <div class="alert alert-warning" role="alert">
            Maximum is 100 characters.
        </div>`;
    }
    else{
        fetch("db/insert-new-category.php", {
            headers: {
                'Content-Type': 'application/json'
            },
            method: 'POST',
            body: JSON.stringify({'category': category.value})
        })
        .then(r=>r.json())
        .then(data=>{
            if(data.success==true){
                error_sentence.innerHTML = 
                `<div class="alert alert-success" role="alert">
                    Success!
                </div>`;
                display_data();
            }else{
                error_sentence.innerHTML = `
                <div class="alert alert-warning" role="alert">
                    Already existe !
                </div>`;
            }
        });
    }
});

function display_data(){
    table_content.innerHTML='';
    fetch("db/all-categories-data.php")
    .then(r=>r.json())
    .then((data)=>{
        for(let i=0;i<data.length;i++){
            table_content.innerHTML+=`
            <tr>
                <td>${data[i].category_name}</td>
                <td><button class="btn btn-danger" onclick="delete_category(${data[i].category_id})">Supprimer</button></td>
            </tr>`;
        }
    });
}
display_data();
function delete_category(id){
    fetch("db/delete-category.php",{
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