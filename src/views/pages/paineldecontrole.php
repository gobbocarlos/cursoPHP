<?= $render('header'); ?>
<section class="container">
    <?=$render('sidebar',['loggedUser'=>$loggedUser])?>
    <section class="main">   
        <div class="painelDeControlePagina">
            
            <div id="tituloTextoJogo">
                    <span id="titulo">Painel de controle</span>
                </div>
                 
            <?php if(!empty($flash)): ?>
                <div class="flash"><?php echo $flash; ?></div>
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
                        <a class="botaoPainelDeControle" href="">Notas</a>
                    </div>
                </div>
                <div class="Galeria">
                    <div class="divPainelDeControle"><h1 class="tituloDivPainelDeControle">Galeria</h1></div>
                    <div class="JogosBotoes">
                    
                        <a class="botaoPainelDeControle" href="">Nova Foto</a>
                        <a class="botaoPainelDeControle" href="">Novo Vídeo</a>
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
           
        </div>
        <?php if(!empty($resultado)): ?>
            <h1>a <?php echo $resultado ?></h1>
        <?php endif; ?>
      
    </section>

</section>

  
  
<?=$render('footer');?>

