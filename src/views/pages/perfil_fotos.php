<?php $render('header', ['loggedUser' => $loggedUser, 'active' => 'fotos']); ?>

    <section class="feed">

        <?php $render('perfil-header', ['loggedUser' => $loggedUser, 'usuario' => $usuario, 'seguindo' => $seguindo])?>

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