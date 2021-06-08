<?= $render('header'); ?>
<section class="container">
    <?=$render('sidebar',['loggedUser'=>$loggedUser])?>
    <section class="main">
       <div class="tituloTexto">
            <span id="titulo">Carlos Henrique Cinti Gobbo</span>
        </div>
        <div class="usuarioPerfil">
            <div class="usuarioPerfilFoto">
                <div class="usuarioFoto">

                </div>
            </div>
            <div class="usuarioDadosAno">
               <h1>2021</h1>
            </div>
            <div class="usuarioPerfilDados">
                <div class="dadosPerfilJogos"><img class="imagemFutebolPerfil" src="<?=$base;?>/assets/images/CampoVertical.jpg"/><strong>-100</strong></div>
                <div class="dadosPerfilJogos"><img class="imagemFutebolPerfil" src="<?=$base;?>/assets/images/Gol.jpg"/> <strong>-2</strong></div>
                <div class="dadosPerfilJogos"><img class="imagemFutebolPerfil" src="<?=$base;?>/assets/images/Bola.jpg"/> <strong>-10</strong></div>
                <div class="dadosPerfilJogos"><img class="imagemFutebolPerfil" src="<?=$base;?>/assets/images/CartaoAmarelo.png"/><strong>- 1</strong></div>
                <div class="dadosPerfilJogos"><img class="imagemFutebolPerfil" src="<?=$base;?>/assets/images/CartaoVermelho.jpg"/><strong>- 10</strong></div>
            </div>
        </div>
        
    </section>
</section>

<?=$render('footer');?>