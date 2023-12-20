<?php $render('header', ['loggedUser' => $loggedUser, 'active' => 'home']); ?>
    <section class="feed mt-10">
        <div class="row">
            <div class="column pr-5">
                <?php $render('feed-editor', ['loggedUser' => $loggedUser])?>

                <?php foreach ($feed['posts'] as $key => $post) { ?>
                    <?= $render('feed-item', ['post' => $post])?>
                <?php }?>
                <div class="feed-pagination">
                    <?php for ($i=0; $i < $feed['qtdPaginas']; $i++) { ?>
                        <a class="<?= $i == $feed['paginaAtual']?'active': '' ?>" href="<?= $base; ?>/?pagina=<?= $i?>"><?= $i + 1?></a>
                    <?php } ?>
                </div>
            </div>
            <div class="column side pl-5">
                <?php $render('right-side')?>
            </div>
        </div>

    </section>
</section>

<?php $render('footer');?>