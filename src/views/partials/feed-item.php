
<div class="box feed-item">
    <div class="box-body">
        <div class="feed-item-head row mt-20 m-width-20">
            <div class="feed-item-head-photo">
                <a href=""><img src="<?=$base;?>/media/avatars/<?= $post->usuario->avatar; ?>" /></a>
            </div>
            <div class="feed-item-head-info">
                <a href=""><span class="fidi-name"><?= $post->usuario->nome ?></span></a>
                <span class="fidi-action">
                    <?php switch($post->type){
                        case 'text':
                            echo 'fez um post';
                            break;
                        case 'photo':
                            echo 'postou uma foto';
                            break;
                    }?>

                </span>
                <br />
                <span class="fidi-date"><?= date('d/m/Y', strtotime($post->data)); ?></span>
            </div>
            <div class="feed-item-head-btn">
                <img src="<?=$base?>/assets/images/more.png" />
            </div>
        </div>
        <div class="feed-item-body mt-10 m-width-20">
            <?= nl2br($post->conteudo); ?>
        </div>
        <div class="feed-item-buttons row mt-20 m-width-20">
            <div class="like-btn on">56</div>
            <div class="msg-btn">3</div>
        </div>
        <div class="feed-item-comments">

            <div class="fic-item row m-height-10 m-width-20">
                <div class="fic-item-photo">
                    <a href=""><img src="<?= $base; ?>/media/avatars/<?= $post->usuario->avatar ?>" /></a>
                </div>
                <div class="fic-item-info">
                    <a href=""><?= $post->usuario->nome ?></a>
                    Comentando no meu próprio post
                </div>
            </div>

        </div>
    </div>
</div>