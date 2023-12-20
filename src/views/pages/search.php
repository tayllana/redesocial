<?php $render('header', ['loggedUser' => $loggedUser, 'active' => 'search']); ?>

    <section class="feed mt-10">
        <div class="row">
            <div class="column pr-5">
                <h1 style="font-weight: 100;">Você pesquisou por: <?=$searchStr?></h1>
                <div class="full-friend-list box mt-10">
                    <?php foreach($usuarios as $usuario){?>
                        <div class="friend-icon">
                            <a href="<?=$base?>/perfil/<?= $usuario->id?>">
                                <div class="friend-icon-avatar">
                                    <img src="<?= $base ?>/media/avatars/<?= $usuario->avatar ?>" />
                                </div>
                                <div class="friend-icon-name">
                                <?= $usuario->nome ?>
                                </div>
                            </a>
                        </div>
                    <?php }?>
                </div>
            </div>
            <div class="column side pl-5">
                <?php $render('right-side')?>
            </div>
        </div>
    </section>
</section>
<?php $render('footer'); ?>