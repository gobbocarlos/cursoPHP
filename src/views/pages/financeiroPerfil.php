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
            <div class="pagamentosPerfil">
                <table class="tabelaPagamentosPerfil">
                    <thead>
                        <tr>
                            <th>Data Pagamento</th>
                            <th>Valor</th>
                            <th>Mês Referência</th>
                            <th>Status</th>      
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach($pagamentos as $pagamento):?>   
                            <tr>
                                <td><?=date('d/m/Y',strtotime($pagamento['data']));?></td>
                                <td><?=$pagamento['valor'];?></td>
                                <td><?=$pagamento['mesreferenciaNome'];?>
                                <td><?php switch($pagamento['status']){
                                case 1:
                                    echo 'Pago';
                                    break;
                                case 0:
                                    echo 'Não Pago';
                                    break;
                            }?></td>
                            </tr>
                    <?php endforeach;?>
                    </tbody>
                </table>
            </div>
                       
        </div>
    </section>
</section>
<?=$render('footer');?>

