<?php $render('header', ['loggedUser' => $loggedUser, 'active' => 'amigos']); ?>

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
        <div class="column">
                    
                    <div class="box">
                        <div class="box-body">

                            <div class="full-user-photos">
                                <?php if(count($usuario->fotos) == 0){ ?>
                                    Nenhuma foto para exibir
                                <?php }?>
                                <?php foreach($usuario->fotos as $foto){ ?>
                                    <div class="user-photo-item">
                                        <a href="#modal-<?=$foto->id?>" rel="modal:open">
                                            <img src="<?=$base?>media/uploads/<?=$foto->conteudo?>" />
                                        </a>
                                        <div id="modal-<?=$foto->id?>" style="display:none">
                                            <img src="<?=$base?>media/uploads/<?=$foto->conteudo?>" />
                                        </div>
                                    </div>
                                <?php } ?>
                            </div>
                            

                        </div>
                    </div>

                </div>

        </div>

    </section>
</section>
<?php $render('footer'); ?>