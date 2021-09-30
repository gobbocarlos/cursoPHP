<?= $render('header'); ?>
<section class="container">
    <?=$render('sidebar',['loggedUser'=>$loggedUser])?>
    <section class="main">
       <div class="tituloTexto">
            <span id="titulo">Aguias do Bosque Futebol & Cerveja</span>
        </div>
       
        <div class="tituloImagens">
            <div clas="tituloLogo">
                <img src="<?=$base;?>/assets/images/Escudo.jpg" />
            </div>
            <div id="tituloDescricao">
                <div id="tituloTextoDescricao">
                <p><strong>Clube criado em Fevereiro de 2020, o <b class="iniciais">A</b>guias do <b class="iniciais">B</b>osque <b class="iniciais">F</b>utebol & <b class="iniciais">C</b>erveja... </strong></p>
                </div>
                <div id="botaoCaminhoDescricao">
                    <a id="botaoCaminho" href="<?=$base;?>/sobre">Sobre</a>
                </div>
                
            </div>
            <div class="tituloMascote">
                <img src="<?=$base;?>/assets/images/mascote.jpg" />
            </div>
        </div>
       <div class="links">
            <div class="link1">
                
                <div id="linkDescricao" class="linkDescricao">
                    <p><strong>Acesse o calendário anual dos nossos times... </strong></p>
                    
                </div>
                <div id="imagemCalendarioFundo">
                    <img id="calendario" src="<?=$base;?>/assets/images/Calendario.jpg" />
                </div>
                <a id="botaoCaminho1" href="<?=$base;?>/calendario">Entrar</a>
            </div>
            <div class="link2">
                    <div class="linkDescricao">
                        <p><strong>Marque um jogo contra o 1º ou 2º quadro..</strong></p>
                    </div>
                    <div id="imagemApontamentoFundo">
                        <img id="apontamento" src="<?=$base;?>/assets/images/Apontamento.jpg" />
                    </div>
                    <a id="botaoCaminho2" href="">Entrar</a>
                   
            </div>
            <div class="link3">
                <div class="linkDescricao">
                    <p><strong>Fotos e vídeos dos nossos jogos e eventos</strong></p>
                </div>
                <div id="imagemFotosFundo">
                    <img id="fotos" src="<?=$base;?>/assets/images/Fotos.jpg" />
                </div>
                <a id="botaoCaminho3" href="">Entrar</a>
            </div>
       </div>
       <?=$render('footer');?>

    </section>
</section>

