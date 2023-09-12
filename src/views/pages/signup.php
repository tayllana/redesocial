<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <title>Cadastro - Devsbook</title>
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
            <form method="POST" action="<?=$base;?>/cadastro">
                <label class="titulo"> Faça seu cadastro</label>
                <h4 class="flash"> 
                    <?php if($flash){?>
                    <span class="glyphicon glyphicon-warning-sign"></span> <?= $flash; ?>
                    <?php }?>
                </h4>
                <input placeholder="Digite seu nome" class="input" type="nome" name="nome" />
                <input placeholder="Digite seu e-mail" class="input" type="email" name="email" />
                <input placeholder="Digite sua senha" class="input" type="password" name="password" />
                <input placeholder="Digite sua data de nascimento" class="input" type="text" name="nascimento" id="nascimento"/>
    
                <input class="button" type="submit" value="Cadastrar" />
    
                <a href="<?=$base;?>/login">Já tem uma conta? Faça o login!</a>
            </form>
            <div>
                <img class="predio" src="<?=$base;?>/assets/images/predio.png" alt="">
            </div>
        </div>
    </section>

    <script src="https://unpkg.com/imask"></script>
    <script>
        IMask(
            document.getElementById('nascimento'), 
            {
                mask:'00/00/0000'
            }
        )
    </script>
</body>
</html>