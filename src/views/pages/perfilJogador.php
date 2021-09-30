<?= $render('header'); ?>
<section class="container">
    <?=$render('sidebar',['loggedUser'=>$loggedUser])?>
    <section class="main">
        <div class="tituloTextoPerfil">
                <span id="tituloPerfilJogador"><?=$usuario['nome'];?></span>
        </div>
        <div>
            <div class="usuarioPerfilFoto">
                <div class="usuarioFoto">
                    <img src="<?=$base;?>/assets/images/avatars/<?=$usuario['avatar']?>" />
                </div>
            </div>
                
        </div>

        <div class="container">
            <div class="usuarioPerfil">
                
                <div class="usuarioPerfilDados">
                    <canvas id='graficoAranha'></canvas>
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
        <div class="usuarioDadosAno">
            <h2>CARREIRA</h2>
            <div class="dadosCarreira">
                <div class="dadosPerfilJogos"><!--<img class="imagemFutebolPerfil" src="<?=$base;?>/assets/images/CampoVertical.jpg"/>--><strong>Jogos - <?=$jogosFeito?></strong></div>
                <div class="dadosPerfilJogos"><!--<img class="imagemFutebolPerfil" src="<?=$base;?>/assets/images/Gol.jpg"/>--><strong> Gols - <?=$golsTotal?></strong></div>
                <div class="dadosPerfilJogos"><!--<img class="imagemFutebolPerfil" src="<?=$base;?>/assets/images/Bola.jpg"/>--> <strong>Assistências - <?=$assTotal?></strong></div>
                <div class="dadosPerfilJogos"><!--<img class="imagemFutebolPerfil" src="<?=$base;?>/assets/images/Bola.jpg"/>--> <strong>Nota Média - <?=$notaTotal?></strong></div>
            </div>
        </div>
    </section>
</section>
<?=$render('footer');?>
<script type="text/javascript">
    var defesa = "<?php echo($notas['defesa']);?>"
    var posicionamento = "<?php echo($notas['posicionamento']);?>"
    var finalizacao = "<?php echo($notas['finalizacao']);?>"
    var tecnica = "<?php echo($notas['tecnica']);?>"
    var inteligencia = "<?php echo($notas['inteligencia']);?>"
    var fisico = "<?php echo($notas['fisico']);?>"
    window.onload = draw(defesa,posicionamento,finalizacao,tecnica,inteligencia,fisico);
</script>
