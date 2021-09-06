<?= $render('header'); ?>
<section class="container">
    <?=$render('sidebar',['loggedUser'=>$loggedUser])?>
    <section class="main">
       <div class="tituloTexto">
            <span id="titulo">Jogos</span>
        </div>
        <div class="jogadores">
            <table class="tabelaJogadores">
                <thead>
                    <tr>
                        <th>Id</th>
                        <th>Nome</th>
                        <th>Ver</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach($listaUsuarios as $usuario):?>   
                        <tr>
                            <td><?=$usuario['id'];?></td>
                            <td><?=$usuario['nome'];?></td>
                            <td>
                                <a href="<?=$base;?>/perfilJogador/<?=$usuario['id'];?>"><i class="fa fa-eye" aria-hidden="true"></i></a>
                                <?php if($loggedUser->id==1 ||$loggedUser->id==2):?>
                                    <a href="<?=$base;?>/usuarioEditar/<?=$usuario['id'];?>"><i class="fa fa-edit" aria-hidden="true"></i></a>
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