<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <title>Atualizar cadastro</title>
    <meta name="viewport" content="width=device-width,minimum-scale=1,initial-scale=1"/>
    <link rel="stylesheet" href="<?=$base;?>/assets/css/login.css" />
</head>
<body>
    <header>
        <div class="container">
            Aguias do Bosque Futebol & cerveja
        </div>
    </header>
    <section class="container main">
    
        <form method="POST" enctype="multipart/form-data" action="<?=$base;?>/cadastroAtualizar">
            <?php if(!empty($flash)): ?>
                <div class="flash"><?php echo $flash; ?></div>
            <?php endif;?>    
            <label>
                Novo Avatar:<br/>
                <input type="file" name="avatar" /><br/>
                <img class="image-edit" src="<?=$base;?>/assets/images/avatars/<?=$jogador['avatar'] ?>" />
            </label>
            <input class="input" id="idCadastroInvisivel" type="text" name="jogadores" value="<?=$jogador['id']?>" readonly />

            <input placeholder="Digite seu Nome Completo" class="input" type="text" name="name" value="<?=$jogador['nome']?>" />

            <input placeholder="Digite seu E-mail" class="input" type="email" name="email" value="<?=$jogador['email']?>" />

            <input placeholder="Digite sua nova Senha" class="input" type="password" name="password" />

            <input placeholder="Digite sua Data de Nascimento" class="input" type="text" name="birthdate" id="birthdate" value="<?=date('d/m/Y',strtotime($jogador['aniversario']))?>" />

            <input class="button" type="submit" value="Atualizar" />
            
        </form>
        <div >
        
            <div id="Voltar"> <a class="botaoVoltar" href="<?=$base;?>/paineldecontrole">Voltar</a></div>
        </div>
       
    </section>

    
</body>
</html>