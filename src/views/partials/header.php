<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <title>Devsbook</title>
    <meta name="viewport" content="width=device-width,minimum-scale=1,initial-scale=1"/>
    <link rel="stylesheet" href="<?=$base?>/assets/css/style.css" />
</head>
<body>
    <header>
        <div class="container">
            <div class="logo">
                <a href="<?=$base?>/"><img src="<?=$base?>/assets/images/@.png" /><img src="<?=$base?>/assets/images/redesocial.png" /></a>
            </div>
            <div class="head-side">
                <div class="head-side-left">
                    <div class="search-area">
                        <form method="GET" action="<?=$base?>/pesquisa">
                            <input type="search" placeholder="Pesquisar" name="s" />
                        </form>
                    </div>
                </div>
                <div class="head-side-right">
                    <a href="<?=$base?>/perfil" class="user-area">
                        <div class="user-area-text"><?= $loggedUser['nome']?></div>
                        <div class="user-area-icon">
                            <img src="media/avatars/<?= $loggedUser['avatar'] ?>" />
                        </div>
                    </a>
                    <a href="<?=$base?>/sair" class="user-logout">
                        <img src="<?=$base?>/assets/images/power_white.png" />
                    </a>
                </div>
            </div>
        </div>
    </header>
    <section class="container main">
        <aside class="mt-10">
            <nav>
                <a href="<?=$base?>/">
                    <div class="menu-item <?= $active == 'home'? 'active': ''?>">
                        <div class="menu-item-icon">
                            <img src="<?=$base?>/assets/images/home-run.png" width="16" height="16" />
                        </div>
                        <div class="menu-item-text">
                            Home
                        </div>
                    </div>
                </a>
                <a href="<?=$base?>/perfil">
                    <div class="menu-item <?= $active == 'perfil'? 'active': ''?>">
                        <div class="menu-item-icon">
                            <img src="<?=$base?>/assets/images/user.png" width="16" height="16" />
                        </div>
                        <div class="menu-item-text">
                            Meu Perfil
                        </div>
                    </div>
                </a>
                <a href="<?=$base?>/amigos">
                    <div class="menu-item <?= $active == 'amigos'? 'active': ''?>">
                        <div class="menu-item-icon">
                            <img src="<?=$base?>/assets/images/friends.png" width="16" height="16" />
                        </div>
                        <div class="menu-item-text">
                            Amigos
                        </div>
                    </div>
                </a>
                <a href="<?=$base?>/fotos">
                    <div class="menu-item <?= $active == 'fotos'? 'active': ''?>">
                        <div class="menu-item-icon">
                            <img src="<?=$base?>/assets/images/photo.png" width="16" height="16" />
                        </div>
                        <div class="menu-item-text">
                            Fotos
                        </div>
                    </div>
                </a>
                <div class="menu-splitter"></div>
                <a href="<?=$base?>/configuracoes">
                    <div class="menu-item <?= $active == 'configuracoes'? 'active': ''?>">
                        <div class="menu-item-icon">
                            <img src="<?=$base?>/assets/images/settings.png" width="16" height="16" />
                        </div>
                        <div class="menu-item-text">
                            Configurações
                        </div>
                    </div>
                </a>
                <a href="<?=$base?>/sair">
                    <div class="menu-item <?= $active == 'sair'? 'active': ''?>">
                        <div class="menu-item-icon">
                            <img src="<?=$base?>/assets/images/power.png" width="16" height="16" />
                        </div>
                        <div class="menu-item-text">
                            Sair
                        </div>
                    </div>
                </a>
            </nav>
        </aside>
