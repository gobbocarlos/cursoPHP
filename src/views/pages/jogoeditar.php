<?= $render('header'); ?>
<section class="container">
    <?=$render('sidebar',['loggedUser'=>$loggedUser])?>
    <section class="main">
       <div id="tituloTextoJogo">
            <span id="titulo">Editar Jogo</span>
        </div>
        <input id="idJogo" value="<?=$jogo['id']?>" />
        <div class="dadosJogoEditar">
            <div id="dadosJogo">
                <h1>Dados do Jogo</h1>
                <label for="quadro">Quadro</label>
                <input type="text" id="quadro" name="quadro" value="<?=$jogo['quadro']?>" />
                <label for="adversario">Adversário</label>
                <input type="text" id="adversario" name="adversario" value="<?=$jogo['adversario']?>" />
                <label for="data">Data do Jogo</label>
                <input type="date" id="dataJogo" name="data" value="<?=$jogo['data']?>" />
                <label for="golsPro">Gols - Aguias</label>
                <input type="text" id="golsPro" name="golsPro" value="<?=$jogo['golspro']?>" />
                <label for="golsContra">Gols Adversário</label>
                <input type="text" id="golsContra" name="golsContra" value="<?=$jogo['golscontra']?>" />
                <label for="local">Local</label>
                <input type="text" id="local" name="local" value="<?=$jogo['local']?>" />
                <a href="" id="lancarDadosJogo"onclick="lancarDadosJogo()" ><i class="fa fa-check" aria-hidden="true"></i></a>
            </div>
            <div class="classificacaoJogadores">
                <h1>Classificação Jogadores</h1>
                <label for="jogadores">Jogadores</label>    
                <select id="jogadores">
                    
                </select>
                <label for="posicao">Posição</label>
                <input type="text" name="posicao" placeholder="Digite a posição abreviada" />
                <label for="nota">Nota</label>
                <input type="number" name="nota" placeholder="Digite a nota fracionada por ponto" />
                <a href="" onclick="teste()" id="lancar"><i class="fa fa-check" aria-hidden="true"></i></a>
            </div>
       
            <div class="jogadoresDados">
                <h1>Dados Jogadores</h1>
                <table class="tabelaJogos">
                    <thead>
                        <tr>
                            <th>Posição</th>
                            <th>nome</th>
                            <th>Nota</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            
                        </tr>
                        <tr>
                            
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </section>
   
</section>

<?=$render('footer');?>
<script type="text/javascript">
    let id = document.querySelector("#idJogo").value;
    let quadro = document.querySelector("#quadro").value;
    let adversario = document.querySelector("#adversario").value;
    let dataJogo = document.querySelector("#dataJogo").value;
    let gp = document.querySelector("#golsPro").value;
    let gc = document.querySelector("#golsContra").value;
    let local = document.querySelector("#local").value;
    console.log(id);
    console.log(quadro);
    console.log(adversario);
    console.log(dataJogo);
    console.log(gp);
    console.log(gc);
    console.log(local);
    async function lancarDadosJogo(){
        /*let data = new FormData();
        data.append('id',$id);
        data.append('quadro',$quadro);
        data.append('adversario',$adversario);
        data.append('dataJogo',$dataJogo);
        data.append('gp',$gp);
        data.append('gc',$gc);
        data.append('local',$local);*/
        let req = await fetch(BASE+'/ajax/dadosjogo',{
            method:'POST',
            body:JSON.stringify({
                id:id,
                quadro:quadro,
                adversario:adversario,
                data:dataJogo,
                gp:gp,
                gc:gc,
                local:local
            })
        });
        let json = await req.json();
        console.log(json);
        if(json.error !=''){
            alert(json.error);
        }
        window.location.href =   window.location.href;
    }
    
   
</script>