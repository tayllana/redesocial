<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <title>Login - Devsbook</title>
    <meta name="viewport" content="width=device-width,minimum-scale=1,initial-scale=1"/>
    <link rel="stylesheet" href="<?=$base;?>/assets/css/login.css" />
</head>
<body>
    <header>
        <div class="container">
            <a href=""><img src="<?=$base;?>/assets/images/devsbook_logo.png" /></a>
        </div>
    </header>
    <section class="container main">
        <div style="display: inline-flex;">
            <form method="POST" action="<?=$base;?>/login">
                <label class="titulo"> Bem-vindo(a) de volta!</label>
                <h4 class="flash"> 
                    <?php if($flash){?>
                    <span class="glyphicon glyphicon-warning-sign"></span> <?= $flash; ?>
                    <?php }?>
                </h4>
                <input placeholder="Digite seu e-mail" class="input" type="email" name="email" />
                <input placeholder="Digite sua senha" class="input" type="password" name="password" />
    
                <input class="button" type="submit" value="Acessar o sistema" />
    
                <a href="<?=$base;?>/cadastro">Ainda não tem conta? Cadastre-se</a>
            </form>
            <div>
                <img class="predio" src="<?=$base;?>/assets/images/predio.png" alt="">
            </div>
        </div>
    </section>
</body>
</html>