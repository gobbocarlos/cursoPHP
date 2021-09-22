<?= $render('header'); ?>
<section class="container">
    <?=$render('sidebar',['loggedUser'=>$loggedUser])?>
    <section class="main">
       <div id="tituloTextoJogo">
            <span id="titulo">Jogo - <?=$jogo['adversario'];?></span>
            <span class="dataJogo" id="titulo"><?=$jogo['data'];?></span>
            <span id="titulo">Placar: <?=$jogo['golspro'];?> x <?=$jogo['golscontra'];?></span>
        </div>
        <div class="jogoDados">
            <!--<div class="campoEscalacao">
               <div class="goleiro"> <div class="j1"><img id="jogador" src="<?=$base;?>/assets/images/avatars/kk.jpg" /></div></div>
               <div class="defesa">
                    <div class="j2"><img id="jogador" src="<?=$base;?>/assets/images/avatars/kk.jpg" /></div>
                    <div class="j3"><img id="jogador" src="<?=$base;?>/assets/images/avatars/kk.jpg" /></div>
                    <div class="j4"><img id="jogador" src="<?=$base;?>/assets/images/avatars/kk.jpg" /></div>
                    <div class="j5"><img id="jogador" src="<?=$base;?>/assets/images/avatars/kk.jpg" /></div>
               </div>
               <div class="meio">
                    <div class="j6"><img id="jogador" src="<?=$base;?>/assets/images/avatars/kk.jpg" /></div>
                    <div class="j7"><img id="jogador" src="<?=$base;?>/assets/images/avatars/kk.jpg" /></div>
                    <div class="j8"><img id="jogador" src="<?=$base;?>/assets/images/avatars/kk.jpg" /></div>
                    <div class="j9"><img id="jogador" src="<?=$base;?>/assets/images/avatars/kk.jpg" /></div>
               </div>
               <div class="ataque">
                    <div class="j10"><img id="jogador" src="<?=$base;?>/assets/images/avatars/kk.jpg" /></div>
                    <div class="j11"><img id="jogador" src="<?=$base;?>/assets/images/avatars/kk.jpg" /></div>
                    
               </div>
            </div>-->
            <div class="feed">
                <?=$render('feed-editor',['loggedUser'=>$loggedUser]);?>
                <?php foreach($feed['posts'] as $feedItem): ?>
                        <?= $render('feed-item',[
                            'data'=>$feedItem,
                            'loggedUser'=>$loggedUser
                        ]);?>      
                <?php endforeach; ?>
                <div class="feed-pagination">
                    <?php for($q=0;$q<$feed['pageCount'];$q++):?>
                            <a class="<?=($q==$feed['currentPage'] ? 'active' : '')?>" href="<?=$base;?>/?page=<?=$q;?>"><?=$q+1;?></a>
                    <?php endfor; ?>           
                </div>
            </div>
            <div class="listaEscalacao">
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
                                <td>G</td>
                                <td>Unidos Venceremos</td>
                                <td>7</td>
                            </tr>
                            <tr>
                                <td>LE</td>
                                <td>Unidos Venceremos</td>
                                <td>8</td>
                            </tr>
                        </tbody>
                    </table>
            </div>
        </div>
       
       
    </section>
   
</section>

<?=$render('footer');?>