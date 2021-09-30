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

document.querySelector('.feed-new-input-placeholder').addEventListener('click', function(obj){
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
});
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
                let req = await fetch(BASE+'/ajax/comment',{
                  method:'POST',
                  body:JSON.stringify({
                      id:id,
                      txt:txt
                  })
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
function modalEditarJogadorOpen(){
    let btnFechar = document.querySelector('#fecharModal');
    let modal = document.querySelector('.modalEditarJogador');
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
function draw(defesa,posicionamento,finalizacao,tecnica,inteligencia,fisico){
    let largura = document.querySelector('.usuarioPerfilDados').clientWidth;
    let altura = document.querySelector('.usuarioPerfilDados').clientHeight;
    var canvas = document.getElementById('graficoAranha');
    canvas.width = largura-10;
    canvas.height = altura - 10;
    let xInicial = canvas.width/2;
    let yInicial = 10;
    if (canvas.getContext){
        var ctx = canvas.getContext('2d');
        ctx.beginPath();
        //ctx.moveTo(150,38);//V1
        ctx.fillText("FINALIZAÇÃO",xInicial-40,yInicial);
        ctx.fillText("INTELIGÊNCIA",(xInicial-(canvas.height/2)-80),((canvas.height-10)/2)-((canvas.height-10)/2)/2);
        ctx.fillText("TÉCNICA",(xInicial-(canvas.height/2)-55),((canvas.height-10)/2)+((canvas.height-10)/2)/2);
        ctx.fillText("POSICIONAMENTO",xInicial-55,canvas.height);
        ctx.fillText("FÍSICO",xInicial+(canvas.height/2)-10,((canvas.height-10)/2)+(((canvas.height-10)/2)/2));
        ctx.fillText("DEFESA",xInicial+(canvas.height/2)-10,((canvas.height-10)/2)-(((canvas.height-10)/2)/2));
        ctx.moveTo(xInicial-10,yInicial);
        ctx.lineTo(xInicial-10,canvas.height-10);
        ctx.moveTo(xInicial,(canvas.height-10)/2);
        ctx.moveTo(xInicial-(canvas.height/2)-10,((canvas.height-10)/2)-((canvas.height-10)/2)/2);
        ctx.lineTo(xInicial+(canvas.height/2)-10,((canvas.height-10)/2)+((canvas.height-10)/2)/2);
        ctx.moveTo(xInicial-(canvas.height/2)-10,((canvas.height-10)/2)+((canvas.height-10)/2)/2);
        //linha nota 10
        ctx.lineTo(xInicial+(canvas.height/2)-10,((canvas.height-10)/2)-((canvas.height-10)/2)/2);//P50
        ctx.lineTo(xInicial-10,yInicial);//P00
        ctx.lineTo(xInicial-(canvas.height/2)-10,((canvas.height-10)/2)-((canvas.height-10)/2)/2);//P10
        ctx.lineTo(xInicial-(canvas.height/2)-10,((canvas.height-10)/2)+((canvas.height-10)/2)/2);//P20
        ctx.lineTo(xInicial-10,canvas.height-10);//P30
        ctx.lineTo(xInicial+(canvas.height/2)-10,((canvas.height-10)/2)+((canvas.height-10)/2)/2);//P40
        ctx.lineTo(xInicial+(canvas.height/2)-10,((canvas.height-10)/2)-((canvas.height-10)/2)/2);//P50
       //linha nota 9
        ctx.moveTo(xInicial+(canvas.height/2)-25,((canvas.height+20)/2)-((canvas.height+25)/2)/2);//P51
        ctx.lineTo(xInicial-10,yInicial+15);//P01
        ctx.lineTo(xInicial-(canvas.height/2)+5,((canvas.height-5)/2)-((canvas.height-30)/2)/2);//P11
        ctx.lineTo(xInicial-(canvas.height/2)+5,((canvas.height-20)/2)+((canvas.height-15)/2)/2);//P21
        ctx.lineTo(xInicial-10,canvas.height-25);//P31
        ctx.lineTo(xInicial+(canvas.height/2)-25,((canvas.height-20)/2)+((canvas.height-15)/2)/2);//P41
        ctx.lineTo(xInicial+(canvas.height/2)-25,((canvas.height+20)/2)-((canvas.height+25)/2)/2);//P51
        //linha nota 8
        ctx.moveTo(xInicial+(canvas.height/2)-40,((canvas.height+50)/2)-((canvas.height+55)/2)/2);//P52
        ctx.lineTo(xInicial-10,yInicial+30);//P02
        ctx.lineTo(xInicial-(canvas.height/2)+20,((canvas.height)/2)-((canvas.height-50)/2)/2);//P12
        ctx.lineTo(xInicial-(canvas.height/2)+20,((canvas.height-30)/2)+((canvas.height-25)/2)/2);//P22
        ctx.lineTo(xInicial-10,canvas.height-40);//P32
        ctx.lineTo(xInicial+(canvas.height/2)-40,((canvas.height-30)/2)+((canvas.height - 25)/2)/2);//P42
        ctx.lineTo(xInicial+(canvas.height/2)-40,((canvas.height+50)/2)-((canvas.height+55)/2)/2);//P52
        //linha nota 7
        ctx.moveTo(xInicial+(canvas.height/2)-55,((canvas.height+80)/2)-((canvas.height+85)/2)/2);//P53 15 30 30
        ctx.lineTo(xInicial-10,yInicial+45);//P03 15
        ctx.lineTo(xInicial-(canvas.height/2)+35,((canvas.height+5)/2)-((canvas.height-70)/2)/2);//P13 15 20
        ctx.lineTo(xInicial-(canvas.height/2)+35,((canvas.height-40)/2)+((canvas.height-35)/2)/2);//P23 15 10 15
        ctx.lineTo(xInicial-10,canvas.height-55);//P33 15
        ctx.lineTo(xInicial+(canvas.height/2)-55,((canvas.height-40)/2)+((canvas.height-35)/2)/2);//P43 30 10 15
        ctx.lineTo(xInicial+(canvas.height/2)-55,((canvas.height+80)/2)-((canvas.height+85)/2)/2);//P53
        //linha nota 6
        ctx.moveTo(xInicial+(canvas.height/2)-70,((canvas.height+110)/2)-((canvas.height+115)/2)/2);//P54
        ctx.lineTo(xInicial-10,yInicial+60);//P04
        ctx.lineTo(xInicial-(canvas.height/2)+50,((canvas.height+10)/2)-((canvas.height-90)/2)/2);//P14
        ctx.lineTo(xInicial-(canvas.height/2)+50,((canvas.height-50)/2)+((canvas.height-45)/2)/2);//P24
        ctx.lineTo(xInicial-10,canvas.height-70);//P34
        ctx.lineTo(xInicial+(canvas.height/2)-70,((canvas.height-50)/2)+((canvas.height-45)/2)/2);//P44
        ctx.lineTo(xInicial+(canvas.height/2)-70,((canvas.height+110)/2)-((canvas.height+115)/2)/2);//P54
        //linha nota 5
        ctx.moveTo(xInicial+(canvas.height/2)-85,((canvas.height+140)/2)-((canvas.height+145)/2)/2);//P55
        ctx.lineTo(xInicial-10,yInicial+75);//P05
        ctx.lineTo(xInicial-(canvas.height/2)+65,((canvas.height+15)/2)-((canvas.height-110)/2)/2);//P15
        ctx.lineTo(xInicial-(canvas.height/2)+65,((canvas.height-60)/2)+((canvas.height-55)/2)/2);//P25
        ctx.lineTo(xInicial-10,canvas.height-85);//P35
        ctx.lineTo(xInicial+(canvas.height/2)-85,((canvas.height-60)/2)+((canvas.height-55)/2)/2);//P45
        ctx.lineTo(xInicial+(canvas.height/2)-85,((canvas.height+140)/2)-((canvas.height+145)/2)/2);//P55
        //linha nota 4
        ctx.moveTo(xInicial+(canvas.height/2)-100,((canvas.height+170)/2)-((canvas.height+175)/2)/2);//P56
        ctx.lineTo(xInicial-10,yInicial+90);//P06
        ctx.lineTo(xInicial-(canvas.height/2)+80,((canvas.height+20)/2)-((canvas.height-130)/2)/2);//P16
        ctx.lineTo(xInicial-(canvas.height/2)+80,((canvas.height-70)/2)+((canvas.height-65)/2)/2);//P26
        ctx.lineTo(xInicial-10,canvas.height-100);//P36
        ctx.lineTo(xInicial+(canvas.height/2)-100,((canvas.height-70)/2)+((canvas.height-65)/2)/2);//P46
        ctx.lineTo(xInicial+(canvas.height/2)-100,((canvas.height+170)/2)-((canvas.height+175)/2)/2);//P56
        //linha nota 3
        ctx.moveTo(xInicial+(canvas.height/2)-115,((canvas.height+200)/2)-((canvas.height+205)/2)/2);//P57
        ctx.lineTo(xInicial-10,yInicial+105);//P07
        ctx.lineTo(xInicial-(canvas.height/2)+95,((canvas.height+25)/2)-((canvas.height-150)/2)/2);//P17
        ctx.lineTo(xInicial-(canvas.height/2)+95,((canvas.height-80)/2)+((canvas.height-75)/2)/2);//P27
        ctx.lineTo(xInicial-10,canvas.height-115);//P37
        ctx.lineTo(xInicial+(canvas.height/2)-115,((canvas.height-80)/2)+((canvas.height-75)/2)/2);//P47
        ctx.lineTo(xInicial+(canvas.height/2)-115,((canvas.height+200)/2)-((canvas.height+205)/2)/2);//P57
        //linha nota 2
        ctx.moveTo(xInicial+(canvas.height/2)-130,((canvas.height+230)/2)-((canvas.height+235)/2)/2);//P58
        ctx.lineTo(xInicial-10,yInicial+120);//P08
        ctx.lineTo(xInicial-(canvas.height/2)+110,((canvas.height+30)/2)-((canvas.height-170)/2)/2);//P18
        ctx.lineTo(xInicial-(canvas.height/2)+110,((canvas.height-90)/2)+((canvas.height-85)/2)/2);//P28
        ctx.lineTo(xInicial-10,canvas.height-130);//P38
        ctx.lineTo(xInicial+(canvas.height/2)-130,((canvas.height-90)/2)+((canvas.height-85)/2)/2);//P48
        ctx.lineTo(xInicial+(canvas.height/2)-130,((canvas.height+230)/2)-((canvas.height+235)/2)/2);//P58
        //linha nota 1
        ctx.moveTo(xInicial+(canvas.height/2)-145,((canvas.height+260)/2)-((canvas.height+265)/2)/2);//P59
        ctx.lineTo(xInicial-10,yInicial+135);//P09
        ctx.lineTo(xInicial-(canvas.height/2)+125,((canvas.height+35)/2)-((canvas.height-190)/2)/2);//P19
        ctx.lineTo(xInicial-(canvas.height/2)+125,((canvas.height-90)/2)+((canvas.height - 110)/2)/2);//P29
        ctx.lineTo(xInicial-10,canvas.height-145);//P39
        ctx.lineTo(xInicial+(canvas.height/2)-145,((canvas.height-100)/2)+((canvas.height-90)/2)/2);//P49
        ctx.lineTo(xInicial+(canvas.height/2)-145,((canvas.height+260)/2)-((canvas.height+265)/2)/2);//P59
      //ctx.strokeStyle = '#FFA500';
      var ctx2 = canvas.getContext('2d');
        ctx.lineWidth = 0.3;
        ctx.stroke();
        ctx2.beginPath();
        ctx2.lineWidth = 0.8;
        ctx2.strokeStyle = '#FF0000';
      defesa = parseInt(defesa);
      switch (defesa) {
          case 10:
              ctx2.moveTo(xInicial+(canvas.height/2)-10,((canvas.height-10)/2)-((canvas.height-10)/2)/2);
            break;
            case 9:
              ctx2.moveTo(xInicial+(canvas.height/2)-25,((canvas.height+20)/2)-((canvas.height+25)/2)/2);
            break;
            case 8:
              ctx2.moveTo(xInicial+(canvas.height/2)-40,((canvas.height+50)/2)-((canvas.height+55)/2)/2);
            break;
            case 7:
              ctx2.moveTo(xInicial+(canvas.height/2)-55,((canvas.height+80)/2)-((canvas.height+85)/2)/2);
            break;
            case 6:
              ctx2.moveTo(xInicial+(canvas.height/2)-70,((canvas.height+110)/2)-((canvas.height+115)/2)/2);
            break;
            case 5:
              ctx2.moveTo(xInicial+(canvas.height/2)-85,((canvas.height+140)/2)-((canvas.height+145)/2)/2);
            break;
            case 4:
              ctx2.moveTo(xInicial+(canvas.height/2)-100,((canvas.height+170)/2)-((canvas.height+175)/2)/2);
            break;
            case 3:
              ctx2.moveTo(xInicial+(canvas.height/2)-115,((canvas.height+200)/2)-((canvas.height+205)/2)/2);
            break;
            case 2:
              ctx2.moveTo(xInicial+(canvas.height/2)-130,((canvas.height+230)/2)-((canvas.height+235)/2)/2);
            break;
            case 1:
              ctx2.moveTo(xInicial+(canvas.height/2)-145,((canvas.height+260)/2)-((canvas.height+265)/2)/2);
            break;
            default:
                
            break;
        }
        finalizacao = parseInt(finalizacao);
        switch (finalizacao) {
            case 10:
                ctx2.lineTo(xInicial-10,yInicial);
              break;
              case 9:
                ctx2.lineTo(xInicial-10,yInicial+15);
              break;
              case 8:
                ctx2.lineTo(xInicial-10,yInicial+30);
              break;
              case 7:
                ctx2.lineTo(xInicial-10,yInicial+45);
              break;
              case 6:
                ctx2.lineTo(xInicial-10,yInicial+60);
              break;
              case 5:
                ctx2.lineTo(xInicial-10,yInicial+75);
              break;
              case 4:
                ctx2.lineTo(xInicial-10,yInicial+90);
              break;
              case 3:
                ctx2.lineTo(xInicial-10,yInicial+105);
              break;
              case 2:
                ctx2.lineTo(xInicial-10,yInicial+120);
              break;
              case 1:
                ctx2.lineTo(xInicial-10,yInicial+135);
              break;
              default:
                  
              break;
        }
       inteligencia = parseInt(inteligencia);
        switch (inteligencia) {
            case 10:
              ctx2.lineTo(xInicial-(canvas.height/2)-10,((canvas.height-10)/2)-((canvas.height-10)/2)/2);
            break;
            case 9:
              ctx2.lineTo(xInicial-(canvas.height/2)+5,((canvas.height-5)/2)-((canvas.height-30)/2)/2);
            break;
            case 8:
              ctx2.lineTo(xInicial-(canvas.height/2)+20,((canvas.height)/2)-((canvas.height-50)/2)/2);
            break;
            case 7:
              ctx2.lineTo(xInicial-(canvas.height/2)+35,((canvas.height+5)/2)-((canvas.height-70)/2)/2);
            break;
            case 6:
              ctx2.lineTo(xInicial-(canvas.height/2)+50,((canvas.height+10)/2)-((canvas.height-90)/2)/2);
            break;
            case 5:
              ctx2.lineTo(xInicial-(canvas.height/2)+65,((canvas.height+15)/2)-((canvas.height-110)/2)/2);
            break;
            case 4:
              ctx2.lineTo(xInicial-(canvas.height/2)+80,((canvas.height+20)/2)-((canvas.height-130)/2)/2);
            break;
            case 3:
              ctx2.lineTo(xInicial-(canvas.height/2)+95,((canvas.height+25)/2)-((canvas.height-150)/2)/2);
            break;
            case 2:
              ctx2.lineTo(xInicial-(canvas.height/2)+110,((canvas.height+30)/2)-((canvas.height-170)/2)/2);
            break;
            case 1:
              ctx2.lineTo(xInicial-(canvas.height/2)+125,((canvas.height+40)/2)-((canvas.height-190)/2)/2);
            break;
            default:
                
            break;
        }
        tecnica = parseInt(tecnica);
        switch (tecnica) {
            case 10:
              ctx2.lineTo(xInicial-(canvas.height/2)-10,((canvas.height-10)/2)+((canvas.height-10)/2)/2);
            break;
            case 9:
              ctx2.lineTo(xInicial-(canvas.height/2)+5,((canvas.height-20)/2)+((canvas.height-15)/2)/2);
            break;
            case 8:
              ctx2.lineTo(xInicial-(canvas.height/2)+20,((canvas.height-30)/2)+((canvas.height-25)/2)/2);
            break;
            case 7:
              ctx2.lineTo(xInicial-(canvas.height/2)+35,((canvas.height-40)/2)+((canvas.height-35)/2)/2);
            break;
            case 6:
              ctx2.lineTo(xInicial-(canvas.height/2)+50,((canvas.height-50)/2)+((canvas.height-45)/2)/2);
            break;
            case 5:
              ctx2.lineTo(xInicial-(canvas.height/2)+65,((canvas.height-60)/2)+((canvas.height-55)/2)/2);
            break;
            case 4:
              ctx2.lineTo(xInicial-(canvas.height/2)+80,((canvas.height-70)/2)+((canvas.height-65)/2)/2);
            break;
            case 3:
              ctx2.lineTo(xInicial-(canvas.height/2)+95,((canvas.height-80)/2)+((canvas.height-75)/2)/2);
            break;
            case 2:
              ctx2.lineTo(xInicial-(canvas.height/2)+110,((canvas.height-90)/2)+((canvas.height-85)/2)/2);
            break;
            case 1:
              ctx2.lineTo(xInicial-(canvas.height/2)+125,((canvas.height-100)/2)+((canvas.height-110)/2)/2);
            break;
            default:
                
            break;
        }
        posicionamento = parseInt(posicionamento);
        switch (posicionamento) {
            case 10:
                ctx2.lineTo(xInicial-10,canvas.height-10);
              break;
              case 9:
                ctx2.lineTo(xInicial-10,canvas.height-25);
              break;
              case 8:
                ctx2.lineTo(xInicial-10,canvas.height-40);
              break;
              case 7:
                ctx2.lineTo(xInicial-10,canvas.height-55);
              break;
              case 6:
                ctx2.lineTo(xInicial-10,canvas.height-70);
              break;
              case 5:
                ctx2.lineTo(xInicial-10,canvas.height-85);
              break;
              case 4:
                ctx2.lineTo(xInicial-10,canvas.height-100);
              break;
              case 3:
                ctx2.lineTo(xInicial-10,canvas.height-115);
              break;
              case 2:
                ctx2.lineTo(xInicial-10,canvas.height-130);
              break;
              case 1:
                ctx2.lineTo(xInicial-10,canvas.height-145);
              break;
              default:
                  
              break;
        }
        fisico = parseInt(fisico);
        switch (fisico) {
            case 10:
                ctx2.lineTo(xInicial+(canvas.height/2)-10,((canvas.height-10)/2)+((canvas.height-10)/2)/2);
              break;
              case 9:
                ctx2.lineTo(xInicial+(canvas.height/2)-25,((canvas.height-20)/2)+((canvas.height-15)/2)/2);
              break;
              case 8:
                ctx2.lineTo(xInicial+(canvas.height/2)-40,((canvas.height-30)/2)+((canvas.height-25)/2)/2);
              break;
              case 7:
                ctx2.lineTo(xInicial+(canvas.height/2)-55,((canvas.height-40)/2)+((canvas.height-35)/2)/2);
              break;
              case 6:
                ctx2.lineTo(xInicial+(canvas.height/2)-70,((canvas.height-50)/2)+((canvas.height-45)/2)/2);
              break;
              case 5:
                ctx2.lineTo(xInicial+(canvas.height/2)-85,((canvas.height-60)/2)+((canvas.height-55)/2)/2);
              break;
              case 4:
                ctx2.lineTo(xInicial+(canvas.height/2)-100,((canvas.height-70)/2)+((canvas.height-65)/2)/2);
              break;
              case 3:
                ctx2.lineTo(xInicial+(canvas.height/2)-115,((canvas.height-80)/2)+((canvas.height-75)/2)/2);
              break;
              case 2:
                ctx2.lineTo(xInicial+(canvas.height/2)-130,((canvas.height-90)/2)+((canvas.height-85)/2)/2);
              break;
              case 1:
                ctx2.lineTo(xInicial+(canvas.height/2)-145,((canvas.height-100)/2)+((canvas.height-90)/2)/2);
              break;
              default:
                  
              break;
          }
          defesa = parseInt(defesa);
          switch (defesa) {
            case 10:
                ctx2.lineTo(xInicial+(canvas.height/2)-10,((canvas.height-10)/2)-((canvas.height-10)/2)/2);
              break;
              case 9:
                ctx2.lineTo(xInicial+(canvas.height/2)-25,((canvas.height+20)/2)-((canvas.height+25)/2)/2);
              break;
              case 8:
                ctx2.lineTo(xInicial+(canvas.height/2)-40,((canvas.height+50)/2)-((canvas.height+55)/2)/2);
              break;
              case 7:
                ctx2.lineTo(xInicial+(canvas.height/2)-55,((canvas.height+80)/2)-((canvas.height+85)/2)/2);
              break;
              case 6:
                ctx2.lineTo(xInicial+(canvas.height/2)-70,((canvas.height+110)/2)-((canvas.height+115)/2)/2);
              break;
              case 5:
                ctx2.lineTo(xInicial+(canvas.height/2)-85,((canvas.height+140)/2)-((canvas.height+145)/2)/2);
              break;
              case 4:
                ctx2.lineTo(xInicial+(canvas.height/2)-100,((canvas.height+170)/2)-((canvas.height+175)/2)/2);
              break;
              case 3:
                ctx2.lineTo(xInicial+(canvas.height/2)-115,((canvas.height+200)/2)-((canvas.height+205)/2)/2);
              break;
              case 2:
                ctx2.lineTo(xInicial+(canvas.height/2)-130,((canvas.height+230)/2)-((canvas.height+235)/2)/2);
              break;
              case 1:
                ctx2.lineTo(xInicial+(canvas.height/2)-145,((canvas.height+260)/2)-((canvas.height+265)/2)/2);
              break;
              default:
                  
              break;
          }
        ctx2.stroke();

    }
}
function modalNotasJogadorOpen(){
  let btnFechar = document.querySelector('#fecharModal');
  let modal = document.querySelector('.modalNotasJogador');
  modal.style.display="block";
  btnFechar.style.display="block";
}  
function modalLancarFinanceiroOpen(){
  let btnFechar = document.querySelector('#fecharModal');
  let modal = document.querySelector('.modalLancarFinanceiro');
  modal.style.display="block";
  btnFechar.style.display="block";
}  
function modalEditarFinanceiroOpen(){
  let btnFechar = document.querySelector('#fecharModal');
  let modal = document.querySelector('.modalEditarFinanceiro');
  modal.style.display="block";
  btnFechar.style.display="block";
}
function nomeParaNumero($mes){
  switch ($mes) {
      case ("JANEIRO"):
          $mesNovo = "01";
      break;
      case ("FEVEREIRO"):
          $mesNovo = "02";
      break;
      case ("MARÇO"):
          $mesNovo = "03";
      break;
      case ("ABRIL"):
          $mesNovo = "04";
      break;
      case ("MAIO"):
          $mesNovo = "05";
      break;
      case ("JUNHO"):
          $mesNovo = "06";
      break;
      case ("JULHO"):
          $mesNovo = "07";
      break;
      case ("AGOSTO"):
          $mesNovo = "08";
      break;
      case ("SETEMBRO"):
          $mesNovo = "09";
      break;
      case ("OUTUBRO"):
          $mesNovo = "10";
      break;
      case ("NOVEMBRO"):
          $mesNovo = "11";
      break;
      case ("DEZEMBRO"):
          $mesNovo = "12";
      break;
  }
  return $mesNovo;
}
function numeroParaNome($numeroMes){
  switch ($numeroMes) {
      case (1):
          $mes = "JANEIRO";   
      break;
      case (2):
          $mes = "FEVEREIRO";
          break;
      case (3):
          $mes = "MARÇO";
          break;
      case (4):
          $mes = "ABRIL";
          break;
      case (5):
          $mes = "MAIO";
          break;
      case (6):
          $mes = "JUNHO";
          break;
      case (7):
          $mes = "JULHO";
          break;
      case (8):
          $mes = "AGOSTO";
          break;
      case (9):
          $mes = "SETEMBRO";
          break;
      case (10):
          $mes = "OUTUBRO";
          break;
      case (11):
          $mes = "NOVEMBRO";
          break;
      case (12):
          $mes = "DEZEMBRO";
          break;
  }
  return $mes;
} 