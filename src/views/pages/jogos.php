<?= $render('header'); ?>
<section class="container">
    <?=$render('sidebar',['loggedUser'=>$loggedUser])?>
    <section class="main">
       <div class="tituloTexto">
            <span id="titulo">Jogos</span>
        </div>
        <div class="jogos">
            <table class="tabelaJogos">
                <thead>
                    <tr>
                        <th>Quadro</th>
                        <th>Data</th>
                        <th>Adversário</th>
                        <th>Placar</th>
                        <th colspan="3">Ações</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach($jogos as $jogo):?>   
                        <tr>
                            <td>"<?=$jogo['quadro'];?>  º"</td>
                            <td><?=$jogo['data'];?></td>
                            <td><?=$jogo['adversario'];?></td>
                            <td>"<?=$jogo['golspro'];?> x <?=$jogo['golscontra'];?>"</td>
                            <td>
                                <a href="<?=$base;?>/jogo/<?=$jogo['id'];?>"><i class="fa fa-eye" aria-hidden="true"></i></a>
                                <?php if($loggedUser->id==1 ||$loggedUser->id==2):?>
                                    <a href="<?=$base;?>/jogoeditar/<?=$jogo['id'];?>"><i class="fa fa-edit" aria-hidden="true"></i></a>
                                <?php endif;?>
                            </td>
                        </tr>
                   <?php endforeach;?>
                </tbody>
            </table>
        </div>
        
    </section>
    
</section>
<?=$render('footer');?>
