<?php $render('header', ['loggedUser' => $loggedUser, 'active' => 'amigos']); ?>

    <section class="feed">

        <?php $render('perfil-header', ['loggedUser' => $loggedUser, 'usuario' => $usuario, 'seguindo' => $seguindo])?>

        <div class="row">
            <div class="column">        
                <div class="box">
                    <div class="box-body">

                        <div class="tabs">
                            <div class="tab-item" data-for="followers">
                                Seguidores
                            </div>
                            <div class="tab-item active" data-for="following">
                                Seguindo
                            </div>
                        </div>
                        <div class="tab-content">
                            <div class="tab-body" data-item="followers">
                                
                                <div class="full-friend-list">
                                    <?php foreach($usuario->seguidores as $seguidor){?>
                                        <div class="friend-icon">
                                            <a href="<?=$base?>/perfil/<?= $seguidor->id?>">
                                                <div class="friend-icon-avatar">
                                                    <img src="<?= $base ?>/media/avatars/<?= $seguidor->avatar ?>" />
                                                </div>
                                                <div class="friend-icon-name">
                                                <?= $seguidor->nome ?>
                                                </div>
                                            </a>
                                        </div>
                                    <?php }?>
                                </div>

                            </div>
                            <div class="tab-body" data-item="following">
                                
                                <div class="full-friend-list">
                                <?php foreach($usuario->seguindo as $seguidor){?>
                                        <div class="friend-icon">
                                            <a href="<?=$base?>/perfil/<?= $seguidor->id?>">
                                                <div class="friend-icon-avatar">
                                                    <img src="<?= $base ?>/media/avatars/<?= $seguidor->avatar ?>" />
                                                </div>
                                                <div class="friend-icon-name">
                                                <?= $seguidor->nome ?>
                                                </div>
                                            </a>
                                        </div>
                                    <?php }?>
                                </div>

                            </div>
                        </div>

                    </div>
                </div>

            </div>

        </div>

    </section>
</section>
<?php $render('footer'); ?>