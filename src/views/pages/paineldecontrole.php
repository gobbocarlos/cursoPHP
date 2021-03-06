<?= $render('header'); ?>
<section class="container">
    <?=$render('sidebar',['loggedUser'=>$loggedUser])?>
    <section class="main">   
        <div class="painelDeControlePagina">
            
            <div id="tituloTextoJogo">
                    <span id="titulo">Painel de controle</span>
            </div>
            
            <?php if(!empty($flash)): ?>
                <div class="flash"><?php echo $flash;?></div>
            <?php endif;?> 
            <div class="paineldecontrole">
                <div class="Jogos">
                    <div class="divPainelDeControle"><h1 class="tituloDivPainelDeControle">Jogos</h1></div>
                    <div class="JogosBotoes">
                        <a class="botaoPainelDeControle" onclick="modalOpen()" href="#modal">Novo Jogo</a>
                        <a class="botaoPainelDeControle" href="<?=$base;?>/jogos">Editar Jogo</a>
                        <a class="botaoPainelDeControle" href="<?=$base;?>/jogos">Notas</a>
                    </div>
                </div>
                <div class="Usuarios">
                    <div class="divPainelDeControle"><h1 class="tituloDivPainelDeControle">Usuários</h1></div>
                    <div class="JogosBotoes">
                        <a class="botaoPainelDeControle" href="<?=$base;?>/cadastro">Novo Usuário</a>
                        <a class="botaoPainelDeControle"onclick="modalEditarJogadorOpen()" href="#modalEditarJogador">Editar Usuario</a>
                        <a class="botaoPainelDeControle" onclick="modalNotasJogadorOpen()" href="#modalNotasJogador">Notas</a>
                    </div>
                </div>
                <div class="Galeria">
                    <div class="divPainelDeControle"><h1 class="tituloDivPainelDeControle">Galeria</h1></div>
                    <div class="JogosBotoes">
                    
                        <a class="botaoPainelDeControle" href="">Nova Foto</a>
                        <a class="botaoPainelDeControle" href="">Novo Vídeo</a>
                    </div>
                </div>
                <div class="Financeiro">
                    <div class="divPainelDeControle"><h1 class="tituloDivPainelDeControle">Financeiro</h1></div>
                    <div class="JogosBotoes">
                        <a class="botaoPainelDeControle" href="<?=$base;?>/financeiro">Histórico</a>
                        <a class="botaoPainelDeControle" onclick="modalLancarFinanceiroOpen()" href="#modalLancarFinanceiro">Lançar</a>
                        <a class="botaoPainelDeControle" href="">Editar</a>
                    </div>
                </div>
            </div>
              
            <div id="modal" class="modal">
            
                <div class="modalBody">
                   
                    <form method="POST" action="<?=$base;?>/jogoAdd">
                        <a id="fecharModal" href="" onclick="closeModal()"><i class="fa fa-window-close-o" aria-hidden="true"></i></a>
                        <label for="quadro">Quadro</label>
                        <input type="text" name="quadro" placeholder="Digite o número do quadro do Águias" />
                        <label for="adversario">Adversário</label>
                        <input type="text" name="adversario" placeholder="Nome do Adversário" />
                        <label for="data">Data do Jogo</label>
                        <input type="date" id="dataJogo" name="data" />
                        <label for="golsPro">Gols - Aguias</label>
                        <input type="text" name="golsPro" placeholder="Gols - Aguias" />
                        <label for="golsContra">Gols Adversário</label>
                        <input type="text" name="golsContra" placeholder="Gols - Adversário" />
                        <label for="local">Local</label>
                        <input type="text" name="local" placeholder="Local do jogo" />
                        <button id="lancarDadosJogo" type="submit"><i class="fa fa-check" aria-hidden="true"></i></button>
                    </form>
                </div>
                
            </div>
            <div id="modalEditarJogador" class="modalEditarJogador">
            
                <div class="modalBody">
                   
                    <form method="GET" action="<?=$base;?>/cadastroAtualizar">
                        <a id="fecharModal" href="" onclick="closeModal()"><i class="fa fa-window-close-o" aria-hidden="true"></i></a>
                        <label for="jogadores">Jogadores</label>    
                        <select id="jogadores" name="jogadores">
                            <?php foreach ($users as $newUser):?> 
                                <option value="<?=$newUser->id?>"><?="$newUser->name"?></option>
                            <?php endforeach; ?>   
                        </select>
                        <button id="jogadorSelecionar" type="submit"><i class="fa fa-check" aria-hidden="true"></i></button>
                    </form>
                </div>
                
            </div>
            <div id="modalNotasJogador" class="modalNotasJogador">
            
                <div class="modalBody">
                
                    <form method="POST" action="<?=$base;?>/notasJogador">
                        <a id="fecharModal" href="" onclick="closeModal()"><i class="fa fa-window-close-o" aria-hidden="true"></i></a>
                        <label for="jogadores">Jogadores</label>    
                        <select id="jogadores" name="jogadores">
                            <?php foreach ($users as $newUser):?> 
                                <option value="<?=$newUser->id?>"><?="$newUser->name"?></option>
                            <?php endforeach; ?>   
                        </select>
                        <label for="finalizacao">Finalização</label>
                        <input type="text" name="finalizacao" placeholder="Digite o número redondo." />
                        <label for="inteligencia">Inteligência</label>
                        <input type="text" name="inteligencia" placeholder="digite número redondo." />
                        <label for="tecnica">Técnica</label>
                        <input type="text" id="tecnica" name="tecnica" placeholder="digite número redondo." />
                        <label for="posicionamento">Posicionamento</label>
                        <input type="text" name="posicionamento" placeholder="digite número redondo." />
                        <label for="fisico">Físico</label>
                        <input type="text" name="fisico" placeholder="digite número redondo." />
                        <label for="defesa">Defesa</label>
                        <input type="text" name="defesa" placeholder="digite número redondo." />
                        <button id="lancarNotasJogadores" type="submit"><i class="fa fa-check" aria-hidden="true"></i></button>
                    </form>
                </div>
            
            </div>
            <div id="modalLancarFinanceiro" class="modalLancarFinanceiro">
            
                <div class="modalBody">
                   
                    <form method="POST" action="<?=$base;?>/financeiroLancar">
                        <a id="fecharModal" href="" onclick="closeModal()"><i class="fa fa-window-close-o" aria-hidden="true"></i></a>
                        <label for="jogadores">Jogadores</label>    
                        <select id="jogadores" name="jogadores">
                            <?php foreach ($users as $newUser):?> 
                                <option value="<?=$newUser->id?>"><?="$newUser->name"?></option>
                            <?php endforeach; ?>   
                        </select>
                        <label for="valor">Valor</label>
                        <input type="number" name="valor" value=50 placeholder="Digite o valor da mensalidade." />
                        <label for="data">Data do Pagamento</label>
                        <input type="date" id="data" name="data" />
                        <label for="meses">Mês de Referência</label>
                        <select id="meses" name="meses">
                                <option value="1"><?="Janeiro"?></option>
                                <option value="2"><?="Fevereiro"?></option>
                                <option value="3"><?="Março"?></option>
                                <option value="4"><?="Abril"?></option>
                                <option value="5"><?="Maio"?></option>
                                <option value="6"><?="Junho"?></option>
                                <option value="7"><?="Julho"?></option>
                                <option value="8"><?="Agosto"?></option>
                                <option value="9"><?="Setembro"?></option>
                                <option value="10"><?="Outubro"?></option>
                                <option value="11"><?="Novembro"?></option>
                                <option value="12"><?="Dezembro"?></option>
                        </select>
                        <button id="lancarFinanceiro" type="submit"><i class="fa fa-check" aria-hidden="true"></i></button>
                    </form>
                </div>
                
            </div>
        </div>
        <?php if(!empty($resultado)): ?>
            <h1>a <?php echo $resultado ?></h1>
        <?php endif; ?>
      
    </section>

</section>

  
  
<?=$render('footer');?>

