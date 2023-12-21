<div class="row">
    <div class="box flex-1 border-top-flat">
        <div class="box-body">
            <div class="profile-cover" id="coverImg" style="background-image: url('<?= $base ?>/media/covers/<?= $usuario->capa ?>');"></div>
            <div class="profile-info m-20 row">
                <div class="profile-info-avatar">
                    <a href="<?= $base?>/perfil/<?=$usuario->id?>">
                        <img style="width: 150px; height: 150px; margin-top: -200px;" id="avatarImg" src="<?= $base ?>/media/avatars/<?= $usuario->avatar ?>" />
                    </a>                         
                </div>
                <div class="profile-info-name">
                    <div class="profile-info-name-text">
                        <a href="<?= $base?>/perfil/<?=$usuario->id?>">
                            <?= $usuario->nome ?>
                        </a>                        
                    </div>
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
                        <a href="<?=$base?>/perfil/<?=$usuario->id?>/amigos">
                            <div class="profile-info-item-n"><?= count($usuario->seguidores) ?></div>
                            <div class="profile-info-item-s">Seguidores</div>
                        </a>
                    </div>
                    <div class="profile-info-item m-width-20">
                        <a href="<?=$base?>/perfil/<?=$usuario->id?>/amigos">
                            <div class="profile-info-item-n"><?= count($usuario->seguindo) ?></div>
                            <div class="profile-info-item-s">Seguindo</div>
                        </a>
                    </div>
                    <div class="profile-info-item m-width-20">
                        <a href="<?=$base?>/perfil/<?=$usuario->id?>/fotos">
                            <div class="profile-info-item-n"><?= count($usuario->fotos) ?></div>
                            <div class="profile-info-item-s">Fotos</div>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>