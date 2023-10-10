<?php $render('header', ['loggedUser' => $loggedUser]); ?>
        <div class="row">
            <div class="column pr-5">
                <?php $render('feed-editor', ['loggedUser' => $loggedUser])?>
                <?php $render('feed-item', ['loggedUser' => $loggedUser])?>
            </div>
            <div class="column side pl-5">
                <div class="box banners">
                    <div class="box-header">
                        <div class="box-header-text">Patrocinios</div>
                        <div class="box-header-buttons">

                        </div>
                    </div>
                    <div class="box-body">
                        <a href=""><img src="<?=$base?>/assets/images/php.jpeg" /></a>
                        <a href=""><img src="<?=$base?>/assets/images/js.png" /></a>
                        <a href=""><img src="<?=$base?>/assets/images/mvc.png" /></a>
                    </div>
                </div>
                <div class="box">
                    <div class="box-body m-10">
                        Criado com ❤️ por B7Web
                    </div>
                </div>
            </div>
        </div>

    </section>
</section>

<?php $render('footer');?>