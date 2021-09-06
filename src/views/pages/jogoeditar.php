<?= $render('header'); ?>
<section class="container">
    <?=$render('sidebar',['loggedUser'=>$loggedUser])?>
    <section class="main">
       <div id="tituloTextoJogo">
            <span id="titulo">Editar Jogo</span>
        </div>
        <div id="suspenso">
            <input type="text" id="gollancado" name="gollancado" value="<?=$gols?>" />
            <input type="text" id="asslancado" name="asslancado" value="<?=$assistencias?>" />
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
                <a id="lancarDadosJogo" onclick="lancarDadosJogo()" ><i class="fa fa-check" aria-hidden="true"></i></a>
            </div>
            
            <div class="classificacaoJogadores">
                <h1>Classificação Jogadores</h1>
                <label for="jogadores">Jogadores</label>    
                <select id="jogadores">
                    <?php foreach ($users as $newUser):?> 
                        <option value="<?=$newUser->id?>"><?="$newUser->name"?></option>
                    <?php endforeach; ?>   
                </select>
                <label for="posicao">Posição</label>
                <input type="text" name="posicao" placeholder="Digite a posição abreviada" />
                <label for="nota">Nota</label>
                <input type="number" name="nota" placeholder="Digite a nota fracionada por ponto" />
                <label for="Gol">Gols</label>
                <input type="number" name="Gol" placeholder="Digite número de gols no jogo, do jogador selecionado" />
                <label for="Ass">Assistências</label>
                <input type="number" name="Ass" placeholder="Digite número de assistências no jogo, do jogador selecionado" />
                <a  onclick="lancarDadosJogadores()" id="lancar"><i class="fa fa-check" aria-hidden="true"></i></a><!--retirei o href-->
            </div>
       
            <div class="jogadoresDados">
                <h1>Dados Jogadores</h1><!--retirei o href-->
                <table class="tabelaJogos">
                    <thead>
                        <tr>
                            <th>Nome</th>
                            <th>Posição</th>
                            <th>Nota</th>
                            <th>Gol</th>
                            <th>Ass</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($escalacao as $newEscalacao):?>
                            <tr> 
                                <td><?=$newEscalacao['jogador'][0]['nome'];?></td>
                                <td><?=$newEscalacao['posicao'];?></td>
                                <td><?=$newEscalacao['nota'];?></td>
                                <td><?=$newEscalacao['gol'];?></td>
                                <td><?=$newEscalacao['assistencia'];?></td>
                            </tr>
                        <?php endforeach; ?> 
                    </tbody>
                </table>
            </div>
        </div>
    </section>
</section>

<?=$render('footer');?>
<script type="text/javascript">
    
    /*
        As variavies tem que ser definidas dentro da função, já que elas devem ter valores atualizados sempre que vc quiser editar
    */
    
    var golsFeitos = document.querySelector("#golsPro").value;
    var golsPreLancados = document.querySelector("#gollancado").value;
    var assistenciasPreLancadas = document.querySelector("#asslancado").value;
    async function lancarDadosJogo(){

        let id = document.querySelector("#idJogo").value;
        let quadro = document.querySelector("#quadro").value;
        let adversario = document.querySelector("#adversario").value;
        let dataJogo = document.querySelector("#dataJogo").value;
        let gp = document.querySelector("#golsPro").value;
        let gc = document.querySelector("#golsContra").value;
        let local = document.querySelector("#local").value;

        let req = await fetch(BASE+'/ajax/dadosjogo',{
            method:'POST',
            body:JSON.stringify({
                id:id,
                quadro:quadro,
                adversario:adversario,
                dataJogo:dataJogo,
                gp:gp,
                gc:gc,
                local:local
            })
        });
        let json = await req.json();

        /*
            Adicionar um if para verificar os erros, só recarrega a pagia se não tiver erros.
        */
        if(json.error !=''){
            alert(json.error);
        } else {
           window.location.href =   window.location.href; 
        }
    }
    async function lancarDadosJogadores()
    {
        if(golsFeitos === assistenciasPreLancadas){
            if(golsFeitos === golsPreLancados){
                alert("Número de assistências lançadas = número de gols feitos.");
            return;
            }
        }
            
        
        if(golsFeitos === golsPreLancados){
            if(golsFeitos === assistenciasPreLancadas){
                alert("Número de gols lançados = número de gols feitos.");
                return;
            }
        }
        let idjogo = document.querySelector("#idJogo").value;
        let posicao = document.querySelector('[name = "posicao"]').value;
        let id = document.querySelector("#jogadores").value;
        let nota = document.querySelector('[name="nota"]').value;
        let gol = document.querySelector('[name="Gol"]').value;
        let ass = document.querySelector('[name="Ass"]').value;
        let data = document.querySelector('[name="data"]').value;
        console.log(data);
        const golsLancados = parseInt(golsPreLancados) + parseInt(gol);
        const assLancadas = parseInt(assistenciasPreLancadas) + parseInt(ass);
        if(assLancadas > golsFeitos){
            alert("Número de assistências dos jogadores não pode ser maior que os gols do jogo.");
            return;
        }
        if(golsLancados > golsFeitos){
            alert("Número de gols dos jogadores não pode ser maior que os gols do jogo.");
            return;
        }

        let req = await fetch(BASE+'/ajax/dadosjogadores',{
            method:'POST',
            body:JSON.stringify({
                id:id,
                posicao:posicao,
                nota:nota,
                gol:gol,
                ass:ass,
                idjogo:idjogo,
                data:data
            })
        });
        let json = await req.json();
       
        /*
            Adicionar um if para verificar os erros, só recarrega a pagina se não tiver erros.
        */
        if(json.error !=''){
            alert(json.error);
        } else {
            document.querySelector("#gollancado").value = golsLancados;
            window.location.href =   window.location.href; 
        }
    }
 
   
</script>