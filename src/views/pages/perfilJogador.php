<?= $render('header'); ?>
<section class="container">
    <?=$render('sidebar',['loggedUser'=>$loggedUser])?>
    <section class="main">
        <div class="tituloTextoPerfil">
                <span id="tituloPerfilJogador">Carlos Henrique Cinti Gobbo</span>
        </div>
        <div class="container">
            
            <div class="usuarioPerfil">
                <div class="usuarioPerfilFoto">
                    <div class="usuarioFoto">

                    </div>
                </div>
                <div class="usuarioDadosAno">
                    <h2>CARREIRA</h2>
                </div>
                <div class="usuarioPerfilDados">
                    <div class="dadosPerfilJogos"><img class="imagemFutebolPerfil" src="<?=$base;?>/assets/images/CampoVertical.jpg"/><strong>-<?=$jogosFeito?></strong></div>
                    <div class="dadosPerfilJogos"><img class="imagemFutebolPerfil" src="<?=$base;?>/assets/images/Gol.jpg"/> <strong>-<?=$golsTotal?></strong></div>
                    <div class="dadosPerfilJogos"><img class="imagemFutebolPerfil" src="<?=$base;?>/assets/images/Bola.jpg"/> <strong>-<?=$assTotal?></strong></div>
                </div>
            </div>
            <div class="jogosCarreira">
                <table class="tabelaJogos">
                    <thead>
                        <tr>
                            <th>Ano</th>
                            <th>Gols</th>
                            <th>Assistências</th>
                            <th>Nota</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach($jogos as $jogo):?>   
                            <tr>
                                <td><?=$jogo['ano'];?></td>
                                <td><?=$jogo['gol'];?></td>
                                <td><?=$jogo['ass'];?></td>
                                <td><?=$jogo['nota'];?></td>
                            
                            </tr>
                    <?php endforeach;?>
                    </tbody>
                </table>
            </div>
        
        </div>
    </section>
</section>
<?=$render('footer');?>