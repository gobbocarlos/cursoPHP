<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <title>Login - ABFC</title>
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
    
    <form method="POST" enctype="multipart/form-data" action="<?=$base;?>/cadastro">
        <?php if(!empty($flash)): ?>
            <div class="flash"><?php echo $flash; ?></div>
        <?php endif;?>    
        <label>
            Avatar:<br/>
            <input type="file" class="avatar" name="avatar" /><br/>
            <!--<img class="image-edit" src="<?=$base;?>/assets/images/avatars/<?=$jogador->avatar; ?>" />-->
        </label>
        <input placeholder="Digite seu Nome Completo" class="input" type="text" name="name" />

        <input placeholder="Digite seu E-mail" class="input" type="email" name="email" />

        <input placeholder="Digite sua Senha" class="input" type="password" name="password" />

        <input placeholder="Confirme sua Senha" class="input" type="password" name="password2" />

        <input placeholder="Digite sua Data de Nascimento" class="input" type="text" name="birthdate" id="birthdate" />

        <input class="button" type="submit" value="Cadastrar" />
        
    </form>
    <div >
       
        <div id="Voltar"> <a class="botaoVoltar" href="<?=$base;?>/paineldecontrole">Voltar</a></div>
    </div>
    </section>

    <script src="http://unpkg.com/imask"></script>
    <script>
        IMask(
            document.getElementById('birthdate'),
            {
                mask:'00/00/0000'
            }
        );
       
    </script>
</body>
</html>