
<div class="box feed-item" data-id="<?=$post->id?>">
    <div class="box-body">
        <div class="feed-item-head row mt-20 m-width-20">
            <div class="feed-item-head-photo">
                <a href="<?= $base?>/perfil/<?=$post->usuario->id?>"><img src="<?=$base;?>/media/avatars/<?= $post->usuario->avatar; ?>" /></a>
            </div>
            <div class="feed-item-head-info">
                <a href="<?= $base?>/perfil/<?=$post->usuario->id?>"><span class="fidi-name"><?= $post->usuario->nome ?></span></a>
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
                <span class="fidi-date"><?= date('d/m/Y', strtotime($post->data)); ?> </span>
            </div>
            <?php if($post->meu){ ?>
                <div class="feed-item-head-btn">
                    <img src="<?=$base;?>/assets/images/more.png" />
                    <div class="feed-item-more-window">
                        <a href="<?=$base?>/post/<?=$post->id?>/delete">Excluir Post</a>
                    </div>
                </div>
            <?php } ?>
        </div>
        <div class="feed-item-body mt-10 m-width-20">
            <?php
            switch($post->type) {
                case 'text':
                    echo nl2br($post->conteudo);
                break;
                case 'photo':
                    echo '<img src="'.$base.'/media/uploads/'.$post->conteudo.'" />';
                break;
            }
            ?>
        </div>
        <div class="feed-item-buttons row mt-20 m-width-20">
            <div class="like-btn <?= $post->liked? 'on': '' ?>" ><?= $post->likes ?></div>
            <div class="msg-btn" ><?= count($post->comentarios) ?></div>
        </div>
        <div class="feed-item-comments">
            <div class="feed-item-comments-area">
                <?php foreach($post->comentarios as $comentario): ?>
                    <div class="fic-item row m-height-10 m-width-20">
                        <div class="fic-item-photo">
                            <a href="<?=$base;?>/perfil/<?=$comentario['usuario']['id'];?>"><img src="<?=$base;?>/media/avatars/<?=$comentario['usuario']['avatar'];?>" /></a>
                        </div>
                        <div class="fic-item-info">
                            <a href="<?=$base;?>/perfil/<?=$comentario['usuario']['id'];?>"><?=$comentario['usuario']['nome'];?></a>
                            <?=$comentario['conteudo'];?>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>

            <div class="fic-answer row m-height-10 m-width-20">
                <div class="fic-item-photo">
                    <a href=""><img src="<?=$base?>/media/avatars/<?= $_SESSION['usuario']['avatar']?>" /></a>
                </div>
                <input type="text" class="fic-item-field" placeholder="Escreva um comentário" />
            </div>
        </div>
        
    </div>
</div>