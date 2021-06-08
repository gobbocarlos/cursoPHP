<?= $render('header'); ?>
<section class="container">
    <?=$render('sidebar',['loggedUser'=>$loggedUser])?>
    <section class="main">
      
      <div class="dadosNovoJogo">
          <label for="adversario">Adversário</label>
          <input type="text" name="adversario" placeholder="Nome do Adversário" />
          <label for="adversario">Data</label>
          <input type="date" name="Data" />
          <label for="golsPro">Gols Pró</label>
          <input type="text" name="golsPro" placeholder="Gols - Aguias" />
          <label for="golsContra">Gols Contra</label>
          <input type="text" name="golsContra" placeholder="Gols - Aguias" />
      </div>
       
      <?=$render('footer');?>
    </section>
   
</section>

