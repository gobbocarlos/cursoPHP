<?= $render('header'); ?>
<section class="container">
    <?=$render('sidebar',['loggedUser'=>$loggedUser])?>
    <section class="main">
        <div id="tituloTextoCalendario">
            <div id="divtitulo">Pagamentos-<span id="tituloAno"><?=$ano?></span></div>
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
        <div class="pagamentos">
            <table class="tabelaPagamentos">
                <thead>
                    <tr>
                        <th>id</th>
                        <th>Data</th>
                        <th>Usuario</th>
                        <th>Valor</th>
                        <th>Mês Referência</th>
                        <th>Status</th>
                        <th >Ações</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach($pagamentos as $pagamento):?>   
                        <tr>
                            <td id="id"><?=$pagamento['id'];?></td>
                            <td id="dataPagamento"><?php echo(date("d/m/Y",strtotime($pagamento['data'])));?></td>
                            <td id="usuarioId"><?=$pagamento['user']['id'];?></td>
                            <td id="usuario"><?=$pagamento['user']['nome'];?></td>
                            <td id="valor"><?=$pagamento['valor'];?></td>
                            <td id="mesreferencia"><?=$pagamento['mesreferenciaNome'];?></td>
                            <td id="status"><?php switch($pagamento['status']){
                                case 1:
                                    echo 'Pago';
                                    break;
                                case 0:
                                    echo 'Não Pago';
                                    break;
                            }?></td>
                            <td id="acoes">
                                <?php if($loggedUser->email=='ppp@gmail.com' ||$loggedUser->email=='gustainde@hotmaill.com'||$loggedUser->email=='kkgobbo@gmail.com'):?>
                                    <a id="botaoAcoesFinanceiro" href="<?=$base;?>/perfilFinanceiro/<?=$pagamento['user']['id'];?>"><i class="fa fa-eye" aria-hidden="true"></i></a>
                                    <a id="botaoAcoesFinanceiro" href="#modalEditarFinanceiro" onclick="modalEditarFinanceiroOpen()"><i class="fa fa-edit" aria-hidden="true"></i></a>
                                    <a id="botaoAcoesFinanceiro" href="<?=$base;?>/financeiroDeletar/<?=$pagamento['id'];?>"><i class="fa fa-trash" aria-hidden="true"></i></a>
                                <?php endif;?>
                            </td>
                        </tr>
                   <?php endforeach;?>
                </tbody>
            </table>
        </div>
        <div id="modalEditarFinanceiro" class="modalEditarFinanceiro">
            
            <div class="modalBody">
               
                <form method="POST" action="<?=$base;?>/financeiroAlterar">
                    <a id="fecharModal" href="" onclick="closeModal()"><i class="fa fa-window-close-o" aria-hidden="true"></i></a>
                    <input id="idEditar" id="idEditar" type="text" name="idEditar"  />
                    <input id="usuarioIdEditar" id="usuarioIdEditar" type="text" name="usuarioIdEditar"  />
                    <label for="jogadoresEditar">Jogadores</label>    
                    <input id="jogadoresEditar" type="text" name="jogadoresEditar" readonly/>
                    <label for="valorEditar">Valor</label>
                    <input id="valorEditar" type="text" name="valorEditar"  />
                    <label for="dataPagamentoEditar">Data do Pagamento</label>
                    <input id="dataPagamentoEditar" type="date" id="data" name="dataPagamentoEditar" />
                    <label for="mesesEditar">Mês de Referência</label>
                    <select id="mesesEditar" name="mesesEditar">
                            <option value="01"><?="Janeiro"?></option>
                            <option value="02"><?="Fevereiro"?></option>
                            <option value="03"><?="Março"?></option>
                            <option value="04"><?="Abril"?></option>
                            <option value="05"><?="Maio"?></option>
                            <option value="06"><?="Junho"?></option>
                            <option value="07"><?="Julho"?></option>
                            <option value="08"><?="Agosto"?></option>
                            <option value="09"><?="Setembro"?></option>
                            <option value="10"><?="Outubro"?></option>
                            <option value="11"><?="Novembro"?></option>
                            <option value="12"><?="Dezembro"?></option>
                    </select>
                    <button id="lancarFinanceiro" type="submit"><i class="fa fa-check" aria-hidden="true"></i></button>
                </form>
            </div>
            
        </div>
       <?=$render('footer');?>

    </section>
   
</section>
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.21.0/moment.min.js"></script>
<script type="text/javascript">
    async function voltarCalendario(){
       let ano = document.querySelector("#tituloAno").innerHTML;
        let mes = document.querySelector("#subTitulo").innerHTML;
        let req = await fetch(BASE+'/ajax/financeiroVoltar',{
            method:'POST',
            body:JSON.stringify({
                mes:mes,
                ano:ano,
            })
        });
        let json = await req.json();
        console.log(json);
        /*
            Adicionar um if para verificar os erros, só recarrega a pagina se não tiver erros.
        */
        if(json.error !=''){
            alert(json.error);
        } 
        else 
        {
            document.querySelector('#subTitulo').innerHTML = json.nomeMesNovo;
            document.querySelector('#tituloAno').innerHTML =json.ano;
            let dados = document.querySelector('.tabelaPagamentos tbody');
            dados.innerHTML = "";
            var cte="";
            for(let i=0;i<json.pagamentos.length;i++){
                cte += "<tr>";
                cte += '<td id="id">'+json.pagamentos[i].id+'</td>';
                cte += '<td id="dataPagamento">'+json.pagamentos[i].data+'</td>';
                cte += '<td id="usuarioId">'+json.pagamentos[i].user.id+'</td>';
                cte += '<td id="usuario">'+json.pagamentos[i].user.nome+'</td>';
                cte += '<td id="valor">'+json.pagamentos[i].valor+'</td>';
                cte += '<td id="mesreferencia">'+json.pagamentos[i].mesreferencia+'</td>';
                cte += '<td id="status">'+json.pagamentos[i].id+'</td>';
                cte += '<td id="acoes"><a id="botaoAcoesFinanceiro" href="<?=$base;?>/perfilFinanceiro/<?=$pagamento['user']['id'];?>"><i class="fa fa-eye" aria-hidden="true"></i></a>'+
                        '<a id="botaoAcoesFinanceiro" href="#modalEditarFinanceiro" onclick="modalEditarFinanceiroOpen()"><i class="fa fa-edit" aria-hidden="true"></i></a>'+
                        '<a id="botaoAcoesFinanceiro" href="<?=$base;?>/financeiroDeletar/<?=$pagamento['id'];?>"><i class="fa fa-trash" aria-hidden="true"></i></a></td>';
                cte += "<tr>";
            }
            dados.innerHTML=cte;
        //window.location.href =   window.location.href; 
        }
    }
    async function adiantarCalendario(){
        let ano = document.querySelector("#tituloAno").innerHTML;
        let mes = document.querySelector("#subTitulo").innerHTML;
        let req = await fetch(BASE+'/ajax/anoAdiantar',{
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
    var td = document.querySelectorAll('tr');
    var cont=0;
    td.forEach((el)=> {
        el.addEventListener('click',pegarDados);
    });
    function pegarDados(e){
        let usuarioId = e.currentTarget.querySelector('#usuarioId').innerHTML;
        let id = e.currentTarget.querySelector('#id').innerHTML;
        let data = e.currentTarget.querySelector('#dataPagamento').innerHTML;
        data = moment(data,"DD/MM/YYYY");
        data = data.format("YYYY-MM-DD");
        let valor = e.currentTarget.querySelector('#valor').innerHTML;
        let usuarioNome = e.currentTarget.querySelector('#usuario').innerHTML;
        let mesreferencia = e.currentTarget.querySelector('#mesreferencia').innerHTML;
        let mesreferenciaNumero = nomeParaNumero(mesreferencia);
        let status = e.currentTarget.querySelector('#status').innerHTML;
        document.getElementById('idEditar').value = id;
        document.getElementById('jogadoresEditar').value = usuarioNome;
        document.getElementById('usuarioIdEditar').value = usuarioId;
        document.getElementById('valorEditar').value = valor;
        document.getElementById('dataPagamentoEditar').value = data;
        document.getElementById('mesesEditar').value = mesreferenciaNumero;
        document.getelementById('jogadoresEditar').setAttribute("readonly", true);
    }
    
</script>