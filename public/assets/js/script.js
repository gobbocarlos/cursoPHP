function setActiveTab(tab) {
    document.querySelectorAll('.tab-item').forEach(function(e){
        if(e.getAttribute('data-for') == tab) {
            e.classList.add('active');
        } else {
            e.classList.remove('active');
        }
    });
}
function showTab() {
    if(document.querySelector('.tab-item.active')) {
        let activeTab = document.querySelector('.tab-item.active').getAttribute('data-for');
        document.querySelectorAll('.tab-body').forEach(function(e){
            if(e.getAttribute('data-item') == activeTab) {
                e.style.display = 'block';
            } else {
                e.style.display = 'none';
            }
        });
    }
}

if(document.querySelector('.tab-item')) {
    showTab();
    document.querySelectorAll('.tab-item').forEach(function(e){
        e.addEventListener('click', function(r) {
            setActiveTab( r.target.getAttribute('data-for') );
            showTab();
        });
    });
}

/*document.querySelector('.feed-new-input-placeholder').addEventListener('click', function(obj){
    obj.target.style.display = 'none';
    document.querySelector('.feed-new-input').style.display = 'block';
    document.querySelector('.feed-new-input').focus();
    document.querySelector('.feed-new-input').innerText = '';
});

document.querySelector('.feed-new-input').addEventListener('blur', function(obj) {
    let value = obj.target.innerText.trim();
    if(value == '') {
        obj.target.style.display = 'none';
        document.querySelector('.feed-new-input-placeholder').style.display = 'block';
    }
});*/
function closeFeedWindow(){
    document.querySelectorAll('.feed-item-more-window').forEach(item=>{
        item.style.display='none';
    });
    
    document.removeEventListener('click',closeFeedWindow);
}

document.querySelectorAll('.feed-item-head-btn').forEach(item=>{
   
    item.addEventListener('click',()=>{
        closeFeedWindow();
        item.querySelector('.feed-item-more-window').style.display = 'block';
        setTimeout(()=>{document.addEventListener('click',closeFeedWindow);},500);
    });
});


if(document.querySelector('.fic-item-field')) {
    document.querySelectorAll('.fic-item-field').forEach(item=>{
        item.addEventListener('keyup', async (e)=>{
            if(e.keyCode == 13) {
                let id = item.closest('.feed-item').getAttribute('data-id');
                let txt = item.value;
                item.value = '';

                let data = new FormData();
                data.append('id', id);
                data.append('txt', txt);

                let req = await fetch(BASE+'/ajax/comment', {
                    method: 'POST',
                    body: data
                });
                let json = await req.json();

                if(json.error == '') {
                    let html = '<div class="fic-item row m-height-10 m-width-20">';
                    html += '<div class="fic-item-photo">';
                    html += '<a href="'+BASE+json.link+'"><img src="'+BASE+json.avatar+'" /></a>';
                    html += '</div>';
                    html += '<div class="fic-item-info">';
                    html += '<a href="'+BASE+json.link+'">'+json.name+'</a>';
                    html += json.body;
                    html += '</div>';
                    html += '</div>';

                    item.closest('.feed-item')
                        .querySelector('.feed-item-comments-area')
                        .innerHTML += html;
                }

            }
        });
    });
}

function modalOpen(){
    let btnFechar = document.querySelector('#fecharModal');
    let modal = document.querySelector('.modal');
    modal.style.display="block";
    btnFechar.style.display="block";
}
function closeModal(){
    document.querySelector('#fecharModal').style.opacity =0;
    document.querySelector('.modal').style.opacity = 0;
    setTimeout(()=>{
        document.querySelector('.modal').style.display = "none";document.querySelector('#fecharModal').style.display="none";},500);
}
function acessarJogo(id){
    let jogo = document.querySelector('#'+id).children;
    if(jogo[3].value==""){
        alert("Jogo não lançado.");
    }
    else{
        window.location.href = BASE+'/jogo/'+jogo[3].value;
    }
    
}


    
 