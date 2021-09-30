<?= $render('header'); ?>
<section class="container">
    <?=$render('sidebar',['loggedUser'=>$loggedUser])?>
    <section class="main">
        <div class="calendarioPagina">
            <div id="tituloTextoCalendario">
                <div id="divtitulo">Calendário-<span id="tituloAno"><?=$ano?></span></div>
                <span id="subTitulo"><?=$mes?></span>
            </div>
            <div class="botoesCalendario">
                <div class="botaoCalendarioVoltar">
                    <a onclick="voltarCalendario()" class="botaoCalendarioMovimentar">Voltar</a>
                </div>
                <div class="botaoCalendarioSeguir">
                <a onclick="adiantarCalendario()" class="botaoCalendarioMovimentar">Seguir</a>
                </div>
            </div>
            <div class="calendarioDatas">
                <div class="titulo1Quadro"><h1>1º Quadro</h1>
                </div>
                <div class="jogosDatas1Quadro">
                    <div onclick="acessarJogo(id)" class="calendarioDadosJogos" id="C1">
                        
                        <span class="data"><?php if(count($jogosQuadro1)>0):echo(date("d/m/Y",strtotime($jogosQuadro1[0]['data'])));endif;?> </span>
                        <span class="adversario"><?php if(count($jogosQuadro1)>0):echo($jogosQuadro1[0]['adversario']);endif;?></span>
                        <span class="placar"><?php if(count($jogosQuadro1)>0):echo($jogosQuadro1[0]['golspro']."x".$jogosQuadro1[0]['golscontra']);endif;?></span>
                        <input type="text" name="idJogo" value="<?php if(count($jogosQuadro1)>0):echo($jogosQuadro1[0]['id']);endif;?>" readonly />
                        <span><?php if(count($jogosQuadro1)==0):echo("Jogo não marcado.");endif;?></span>
                    </div>
                    <div onclick="acessarJogo(id)" class="calendarioDadosJogos" id="C2">
                        <span class="data"><?php if(count($jogosQuadro1)>1):echo(date("d/m/Y",strtotime($jogosQuadro1[1]['data'])));endif;?> </span>
                        <span class="adversario"><?php if(count($jogosQuadro1)>1):echo($jogosQuadro1[1]['adversario']);endif;?></span>
                        <span class="placar"><?php if(count($jogosQuadro1)>1):echo($jogosQuadro1[1]['golspro']."x".$jogosQuadro1[1]['golscontra']);endif;?></span>
                        <input type="text" name="idJogo" value="<?php if(count($jogosQuadro1)>1):echo($jogosQuadro1[1]['id']);endif;?>" readonly />
                        <span><?php if(count($jogosQuadro1)==0):echo("Jogo não marcado.");endif;?></span>
                    </div>
                    <div onclick="acessarJogo(id)" class="calendarioDadosJogos" id="C3">
                        <span class="data"><?php if(count($jogosQuadro1)>2):echo(date("d/m/Y",strtotime($jogosQuadro1[2]['data'])));endif;?> </span>
                        <span class="adversario"><?php if(count($jogosQuadro1)>2):echo($jogosQuadro1[2]['adversario']);endif;?></span>
                        <span class="placar"><?php if(count($jogosQuadro1)>2):echo($jogosQuadro1[2]['golspro']."x".$jogosQuadro1[2]['golscontra']);endif;?></span>
                        <input type="text" name="idJogo" value="<?php if(count($jogosQuadro1)>2):echo($jogosQuadro1[2]['id']);endif;?>" readonly />
                        <span><?php if(count($jogosQuadro1)==0):echo("Jogo não marcado.");endif;?></span>
                    </div>
                    <div onclick="acessarJogo(id)" class="calendarioDadosJogos" id="C4">
                        <span class="data"><?php if(count($jogosQuadro1)>3):echo(date("d/m/Y",strtotime($jogosQuadro1[3]['data'])));endif;?> </span>
                        <span class="adversario"><?php if(count($jogosQuadro1)>3):echo($jogosQuadro1[3]['adversario']);endif;?></span>
                        <span class="placar"><?php if(count($jogosQuadro1)>3):echo($jogosQuadro1[3]['golspro']."x".$jogosQuadro1[3]['golscontra']);endif;?></span>
                        <input type="text" name="idJogo" value="<?php if(count($jogosQuadro1)>3):echo($jogosQuadro1[3]['id']);endif;?>" readonly />
                        <span><?php if(count($jogosQuadro1)==0):echo("Jogo não marcado.");endif;?></span>
                    </div>
                    <div onclick="acessarJogo(id)" class="calendarioDadosJogos" id="C5">
                        <span class="data"><?php if(count($jogosQuadro1)>4):echo(date("d/m/Y",strtotime($jogosQuadro1[4]['data'])));endif;?> </span>
                        <span class="adversario"><?php if(count($jogosQuadro1)>4):echo($jogosQuadro1[4]['adversario']);endif;?></span>
                        <span class="placar"><?php if(count($jogosQuadro1)>4):echo($jogosQuadro1[4]['golspro']."x".$jogosQuadro1[4]['golscontra']);endif;?></span>
                        <input type="text" name="idJogo" value="<?php if(count($jogosQuadro1)>4):echo($jogosQuadro1[4]['id']);endif;?>" readonly />
                        <span><?php if(count($jogosQuadro1)==0):echo("Jogo não marcado.");endif;?></span>
                    </div>
                </div>
                <div class="titulo2Quadro"><h1>2º Quadro</h1>
                </div>
                <div class="jogosDatas2Quadro">
                    <div onclick="acessarJogo(id)" class="calendarioDadosJogos" id="C6">
                        <span class="data"><?php if(count($jogosQuadro2)>0):echo(date("d/m/Y",strtotime($jogosQuadro2[0]['data'])));endif;?> </span>
                        <span class="adversario"><?php if(count($jogosQuadro2)>0):echo($jogosQuadro2[0]['adversario']);endif;?></span>
                        <span class="placar"><?php if(count($jogosQuadro2)>0):echo($jogosQuadro2[0]['golspro']."x".$jogosQuadro2[0]['golscontra']);endif;?></span>
                        <input  type="text" name="idJogo" value="<?php if(count($jogosQuadro2)>0):echo($jogosQuadro2[0]['id']);endif;?>" readonly />
                        <span><?php if(count($jogosQuadro1)==0):echo("Jogo não marcado.");endif;?></span>
                    </div>
                    <div onclick="acessarJogo(id)" class="calendarioDadosJogos" id="C7">
                        <span class="data"><?php if(count($jogosQuadro2)>1):echo(date("d/m/Y",strtotime($jogosQuadro2[1]['data'])));endif;?> </span>
                        <span class="adversario"><?php if(count($jogosQuadro2)>1):echo($jogosQuadro2[1]['adversario']);endif;?></span>
                        <span class="placar"><?php if(count($jogosQuadro2)>1):echo($jogosQuadro2[1]['golspro']."x".$jogosQuadro2[1]['golscontra']);endif;?></span>
                        <input type="text" name="idJogo" value="<?php if(count($jogosQuadro2)>1):echo($jogosQuadro2[1]['id']);endif;?>" readonly />
                        <span><?php if(count($jogosQuadro1)==0):echo("Jogo não marcado.");endif;?></span>
                    </div>
                    <div onclick="acessarJogo(id)" class="calendarioDadosJogos"id="C8">
                        <span class="data"><?php if(count($jogosQuadro2)>2):echo(date("d/m/Y",strtotime($jogosQuadro2[2]['data'])));endif;?> </span>
                        <span class="adversario"><?php if(count($jogosQuadro2)>2):echo($jogosQuadro2[2]['adversario']);endif;?></span>
                        <span class="placar"><?php if(count($jogosQuadro2)>2):echo($jogosQuadro2[2]['golspro']."x".$jogosQuadro2[2]['golscontra']);endif;?></span>
                        <input type="text" name="idJogo" value="<?php if(count($jogosQuadro2)>2):echo($jogosQuadro2[2]['id']);endif;?>" readonly />
                        <span><?php if(count($jogosQuadro1)==0):echo("Jogo não marcado.");endif;?></span>
                    </div>
                    <div onclick="acessarJogo(id)" class="calendarioDadosJogos" id="C9">
                        <span class="data"><?php if(count($jogosQuadro2)>3):echo(date("d/m/Y",strtotime($jogosQuadro2[3]['data'])));endif;?> </span>
                        <span class="adversario"><?php if(count($jogosQuadro2)>3):echo($jogosQuadro2[3]['adversario']);endif;?></span>
                        <span class="placar"><?php if(count($jogosQuadro2)>3):echo($jogosQuadro2[3]['golspro']."x".$jogosQuadro2[3]['golscontra']);endif;?></span>
                        <input type="text" name="idJogo" value="<?php if(count($jogosQuadro2)>3):echo($jogosQuadro2[3]['id']);endif;?>" readonly />
                        <span><?php if(count($jogosQuadro1)==0):echo("Jogo não marcado.");endif;?></span>
                    </div>
                    <div onclick="acessarJogo(id)" class="calendarioDadosJogos" id="C10">
                        <span class="data"><?php if(count($jogosQuadro2)>4):echo(date("d/m/Y",strtotime($jogosQuadro2[4]['data'])));endif;?> </span>
                        <span class="adversario"><?php if(count($jogosQuadro2)>4):echo($jogosQuadro2[4]['adversario']);endif;?></span>
                        <span class="placar"><?php if(count($jogosQuadro2)>4):echo($jogosQuadro2[4]['golspro']."x".$jogosQuadro2[4]['golscontra']);endif;?></span>
                        <input type="text" name="idJogo" value="<?php if(count($jogosQuadro2)>4):echo($jogosQuadro2[4]['id']);endif;?>" readonly />
                        <span><?php if(count($jogosQuadro1)==0):echo("Jogo não marcado.");endif;?></span>
                    </div>
                </div>
            <div>
        </div>
    </section>
   
</section>

<?=$render('footer');?>
<script type="text/javascript">
    async function voltarCalendario(){
        let ano = document.querySelector("#tituloAno").innerHTML;
        let mes = document.querySelector("#subTitulo").innerHTML;
        let req = await fetch(BASE+'/ajax/calendarioVoltar',{
            method:'POST',
            body:JSON.stringify({
                mes:mes,
                ano:ano,
            })
        });
        let json = await req.json();
        /*
            Adicionar um if para verificar os erros, só recarrega a pagina se não tiver erros.
        */
        if(json.error !=''){
            alert(json.error);
        } else {
            document.querySelector('#subTitulo').innerHTML = json.nomeMesNovo;
            document.querySelector('#tituloAno').innerHTML =json.ano;
           if(json.jogosPrimeiroQuadro.length==16){
                for (let i = 1; i <= 5; i++) {
                    let jogo = document.querySelector('.jogosDatas1Quadro #C'+i).children;
                    jogo[0].innerHTML = "";
                    jogo[1].innerHTML = "";
                    jogo[2].innerHTML = "";
                    jogo[3].innerHTML = "";
                    jogo[4].innerHTML = "";
                    jogo[1].innerHTML = json.jogosPrimeiroQuadro;
                }
            }
            else{
                for (let i = 1; i <= json.jogosPrimeiroQuadro.length; i++) {
                    let jogo = document.querySelector('.jogosDatas1Quadro #C'+i).children;
                    var data = new Date(json.jogosPrimeiroQuadro[i-1].data);
                    jogo[0].innerHTML = "";
                    jogo[1].innerHTML = "";
                    jogo[2].innerHTML = "";
                    jogo[3].innerHTML = "";
                    jogo[4].innerHTML = "";
                    jogo[0].innerHTML = data.toLocaleDateString('pt-BR', {timeZone: 'UTC'});
                    jogo[1].innerHTML = json.jogosPrimeiroQuadro[i-1].adversario;
                    jogo[2].innerHTML = json.jogosPrimeiroQuadro[i-1].golspro+" x "+json.jogosPrimeiroQuadro[i-1].golscontra;
                    jogo[3].value = json.jogosPrimeiroQuadro[i-1].id;
                }
            
            }
            if(json.jogosSegundoQuadro.length==17){
                for (let i = 1; i <= 5; i++) {
                    let jogo = document.querySelector('.jogosDatas2Quadro #C'+(5+i)).children;
                    jogo[0].innerHTML = "";
                    jogo[1].innerHTML = "";
                    jogo[2].innerHTML = "";
                    jogo[3].innerHTML = "";
                    jogo[4].innerHTML = "";
                    jogo[1].innerHTML = json.jogosSegundoQuadro;
                }
            }
            else{
                for (let i = 1; i <= json.jogosSegundoQuadro.length; i++) {
                    let jogo = document.querySelector('.jogosDatas2Quadro #C'+(5+i)).children;
                    var data = new Date(json.jogosSegundoQuadro[i-1].data);
                    jogo[0].innerHTML = "";
                    jogo[1].innerHTML = "";
                    jogo[2].innerHTML = "";
                    jogo[3].innerHTML = "";
                    jogo[4].innerHTML = "";
                    jogo[0].innerHTML = data.toLocaleDateString('pt-BR', {timeZone: 'UTC'});
                    jogo[1].innerHTML = json.jogosSegundoQuadro[i-1].adversario;
                    jogo[2].innerHTML = json.jogosSegundoQuadro[i-1].golspro+" x "+json.jogosSegundoQuadro[i-1].golscontra;
                    jogo[3].value = json.jogosSegundoQuadro[i-1].id;
                } 
            }
            
    
        //window.location.href =   window.location.href; 
        }
    }
    async function adiantarCalendario(){
        let ano = document.querySelector("#tituloAno").innerHTML;
        let mes = document.querySelector("#subTitulo").innerHTML;
        let req = await fetch(BASE+'/ajax/calendarioAdiantar',{
            method:'POST',
            body:JSON.stringify({
                mes:mes,
                ano:ano
            })
        });
        let json = await req.json();

        /*
            Adicionar um if para verificar os erros, só recarrega a pagina se não tiver erros.
        */
        if(json.error !=''){
            alert(json.error);
        } else {
            document.querySelector('#subTitulo').innerHTML = json.nomeMesNovo;
            document.querySelector('#tituloAno').innerHTML =json.ano;
           if(json.jogosPrimeiroQuadro.length==16){
                for (let i = 1; i <= 5; i++) {
                    let jogo = document.querySelector('.jogosDatas1Quadro #C'+i).children;
                    jogo[0].innerHTML = "";
                    jogo[1].innerHTML = "";
                    jogo[2].innerHTML = "";
                    jogo[3].innerHTML = "";
                    jogo[1].innerHTML = json.jogosPrimeiroQuadro;
                }
            }
            else{
                for (let i = 1; i <= json.jogosPrimeiroQuadro.length; i++) {
                    let jogo = document.querySelector('.jogosDatas1Quadro #C'+i).children;
                    var data = new Date(json.jogosPrimeiroQuadro[i-1].data);
                    jogo[0].innerHTML = "";
                    jogo[1].innerHTML = "";
                    jogo[2].innerHTML = "";
                    jogo[3].innerHTML = "";
                    jogo[0].innerHTML = data.toLocaleDateString('pt-BR', {timeZone: 'UTC'});
                    jogo[1].innerHTML = json.jogosPrimeiroQuadro[i-1].adversario;
                    jogo[2].innerHTML = json.jogosPrimeiroQuadro[i-1].golspro+" x "+json.jogosPrimeiroQuadro[i-1].golscontra;
                    jogo[3].value = json.jogosPrimeiroQuadro[i-1].id;
                }
            
            } 
            console.log(json.jogosSegundoQuadro.length);
            if(json.jogosSegundoQuadro.length==17){
                for (let i = 6; i <= 10; i++) {
                    let jogo = document.querySelector('.jogosDatas2Quadro #C'+i).children;
                    jogo[0].innerHTML = "";
                    jogo[1].innerHTML = "";
                    jogo[2].innerHTML = "";
                    jogo[3].innerHTML = "";
                    jogo[1].innerHTML = json.jogosSegundoQuadro;
                }
            }
            else{
                for (let i = 1; i <= json.jogosSegundoQuadro.length; i++) {
                    let jogo = document.querySelector('.jogosDatas2Quadro #C'+(i+5)).children;
                    var data = new Date(json.jogosSegundoQuadro[i-1].data);
                    jogo[0].innerHTML = "";
                    jogo[1].innerHTML = "";
                    jogo[2].innerHTML = "";
                    jogo[3].innerHTML = "";
                    jogo[0].innerHTML = data.toLocaleDateString('pt-BR', {timeZone: 'UTC'});
                    jogo[1].innerHTML = json.jogosSegundoQuadro[i-1].adversario;
                    jogo[2].innerHTML = json.jogosSegundoQuadro[i-1].golspro+" x "+json.jogosSegundoQuadro[i-1].golscontra;
                    jogo[3].value = json.jogosSegundoQuadro[i-1].id;
                }
            
            }     
    
        
            //window.location.href =   window.location.href; 
        }
    }
</script>