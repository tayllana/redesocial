<?php $render('header', ['loggedUser' => $loggedUser, 'active' => 'perfil']); ?>

    <section class="feed">

        <div class="row">
            <div class="box flex-1 border-top-flat">
                <div class="box-body">
                    <div class="profile-cover" style="background-image: url('<?= $base ?>/media/covers/<?= $usuario->capa ?>');"></div>
                    <div class="profile-info m-20 row">
                        <div class="profile-info-avatar">
                            <img src="<?= $base ?>/media/avatars/<?= $usuario->avatar ?>" />
                        </div>
                        <div class="profile-info-name">
                            <div class="profile-info-name-text"><?= $usuario->nome ?></div>
                            <div class="profile-info-location"><?= $usuario->cidade ?></div>
                        </div>
                        
                        <div class="profile-info-data row">                            
                            <?php if ($usuario->id != $loggedUser['id']) {?>
                                <div class="profile-info-item m-width-20">
                                <a href="<?=$base?>/perfil/<?=$usuario->id?>/follow" class="button" style="margin-top: 0px;">
                                <?php if($seguindo){ ?>
                                        Deixar de seguir
                                    <?php }else{?>
                                        Seguir
                                    <?php }?>
                                    </a>
                                </div>
                            <?php }?>
                            <div class="profile-info-item m-width-20">
                                <div class="profile-info-item-n"><?= count($usuario->seguidores) ?></div>
                                <div class="profile-info-item-s">Seguidores</div>
                            </div>
                            <div class="profile-info-item m-width-20">
                                <div class="profile-info-item-n"><?= count($usuario->seguindo) ?></div>
                                <div class="profile-info-item-s">Seguindo</div>
                            </div>
                            <div class="profile-info-item m-width-20">
                                <div class="profile-info-item-n"><?= count($usuario->fotos) ?></div>
                                <div class="profile-info-item-s">Fotos</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">

            <div class="column side pr-5">

                <div class="box">
                    <div class="box-body">

                        <div class="user-info-mini">
                            <img src="<?= $base ?>/assets/images/calendar.png" />
                            <?= date('d/m/Y', strtotime($usuario->aniversario)); ?> (<?= $usuario->idade ?>)
                        </div>

                        <?php if(!empty($usuario->cidade)){?>
                            <div class="user-info-mini">
                                <img src="<?= $base ?>/assets/images/pin.png" />
                                <?= $usuario->cidade ?>
                            </div>
                        <?php } if(!empty($usuario->cidade)){?>
                            <div class="user-info-mini">
                                <img src="<?= $base ?>/assets/images/work.png" />
                                <?= $usuario->emprego ?>
                            </div>
                        <?php }?>
                    </div>
                </div>

                <div class="box">
                    <div class="box-header m-10">
                        <div class="box-header-text">
                            Seguindo
                            <span>(<?= count($usuario->seguindo) ?>)</span>
                        </div>
                        <div class="box-header-buttons">
                            <a href="">ver todos</a>
                        </div>
                    </div>
                    <div class="box-body friend-list">

                        <?php for ($i=0; $i < 9; $i++) {  
                            if(isset($usuario->seguindo[$i])){?>
                                <div class="friend-icon">
                                    <a href="<?= $base ?>/perfil/<?= $usuario->seguindo[$i]->id ?>">
                                        <div class="friend-icon-avatar">
                                            <img src="<?= $base ?>/media/avatars/<?= $usuario->seguindo[$i]->avatar ?>" />
                                        </div>
                                        <div class="friend-icon-name">
                                            <?= $usuario->seguindo[$i]->nome ?>
                                        </div>
                                    </a>
                                </div>
                            <?php }
                        }?>

                    </div>
                </div>

            </div>
            <div class="column pl-5">

                <div class="box">
                    <div class="box-header m-10">
                        <div class="box-header-text">
                            Fotos
                            <span>(<?= count($usuario->fotos) ?>)</span>
                        </div>
                        <div class="box-header-buttons">
                            <a href="<?=$base?>/perfil/<?= $usuario->id?>/amigos">ver todos</a>
                        </div>
                    </div>
                    <div class="box-body row m-20">

                        <?php for ($i=0; $i < 4; $i++) { 
                            if(isset($usuario->fotos[$i])){ ?>
                                <div class="user-photo-item">
                                    <a href="#modal-<?= $usuario->fotos[$i]->id?>" rel="modal:open">
                                        <img src="<?= $base ?>/media/uploads/<?= $usuario->fotos[$i]->conteudo?>" />
                                    </a>
                                    <div id="modal-<?= $usuario->fotos[$i]->id?>" style="display:none">
                                        <img src="<?= $base ?>/media/uploads/<?= $usuario->fotos[$i]->conteudo?>" />
                                    </div>
                                </div>
                        <?php } 
                    } ?>

                    </div>
                </div>
                <?php if($usuario->id == $loggedUser['id']){
                        $render('feed-editor', ['loggedUser' => $loggedUser]);
                    } ?>
                <?php foreach ($feed['posts'] as $key => $post) { ?>
                    <?= $render('feed-item', ['post' => $post])?>
                <?php }?>
                <div class="feed-pagination">
                    <?php for ($i=0; $i < $feed['qtdPaginas']; $i++) { ?>
                        <a class="<?= $i == $feed['paginaAtual']?'active': '' ?>" href="<?= $base; ?>/perfil/<?=$usuario->id?>?pagina=<?= $i?>"><?= $i + 1?></a>
                    <?php } ?>
                </div>

            </div>

        </div>

    </section>
</section>
<?php $render('footer'); ?>