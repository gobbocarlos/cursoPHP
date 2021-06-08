<?php $render('header'); ?>
<section class="container">
    <?php $render('sidebar');?>
    <section class="main">
        <div class="tituloSobre"><h4 id="titulo">Nossa História</h4></div>
        <div class="descricaoSobre">
            Fundado em Fevereiro de 2020, o <b class="iniciais">A</b>guias do <b class="iniciais">B</b>osque <b class="iniciais">F</b>utebol & <b class="iniciais">C</b>erveja, o clube foi fundado com um principio básico: <i><u>Amigos que se reunem para curtir, jogar e tomara quela gelada todos os sábados.</u></i><br/>
            Pelo pouco tempo de vida, e a paralisação devido à Pandemia do Covid-19, o clube não tem um histórico grande de jogos. Na verdade, para os fundadores, a estréia deste novo clube será no primeiro jogo após a volta/abertura do nosso campo(<a href="">U.C.R.A.</a>)
            Deste dia em diante, o mais novo clube da várzea paulista estará pronto para receber todos os times dispostos a competirem em alto nível, e tomar uma gelada após o término do jogo.
        </div>
        <div class="uniformes">
            <p><strong>Este é nosso primeiro manto sagrado...</strong></p>
            <div class="uniformeFotos">
                <img src="<?=$base;?>/assets/images/uniformeFrente.jpg"/>
                <img src="<?=$base;?>/assets/images/uniformeVerso.jpg"/>
            </div>
        </div>
    </section>
</section>
<?php $render('footer');?>