<?= $render('header'); ?>
<section class="container">
    <?=$render('sidebar',['loggedUser'=>$loggedUser])?>
    <section class="main">
       <div id="tituloTextoJogo">
            <span id="titulo">Jogo - <?=$jogo['adversario'];?></span>
            <span class="dataJogo" id="titulo"><?=date('d/m/Y',strtotime($jogo['data']));?></span>
            <span id="titulo">Placar: <?=$jogo['golspro'];?> x <?=$jogo['golscontra'];?></span>
        </div>
        <div class="jogoDados">
            
            <div class="feed">
                <?=$render('feed-editor',['loggedUser'=>$loggedUser,'idjogo'=>$jogo['id']]);?>
                <?php foreach($feed['posts'] as $feedItem): ?>
                        <?= $render('feed-item',[
                            'data'=>$feedItem,
                            'loggedUser'=>$loggedUser
                        ]);?>      
                <?php endforeach; ?>
                <div class="feed-pagination">
                    <?php for($q=0;$q<$feed['pageCount'];$q++):?>
                            <a class="<?=($q==$feed['currentPage'] ? 'active' : '')?>" href="<?=$base;?>/jogo?page=<?=$q;?>/<?=$jogo['id']?>"><?=$q+1;?></a>
                    <?php endfor; ?>           
                </div>
            </div>
            <div class="listaEscalacao">
                <table class="tabelaJogos">
                        <thead>
                            <tr>
                                <th>Posição</th>
                                <th>Nome</th>
                                <th>Gol</th>
                                <th>Assistência</th>
                                <th>Nota</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($escalacao as $newEscalacao):?>
                                <tr> 
                                <td><?=$newEscalacao['jogador'][0]['nome'];?></td>    
                                <td><?=$newEscalacao['posicao'];?></td>
                                    <td><?=$newEscalacao['gol'];?></td>
                                    <td><?=$newEscalacao['assistencia'];?></td>
                                    <td><?=$newEscalacao['nota'];?></td>
                                </tr>
                            <?php endforeach; ?> 
                        </tbody>
                    </table>
            </div>
        </div>
       
       
    </section>
   
</section>

<?=$render('footer');?>