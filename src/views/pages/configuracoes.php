<?=$render('header', ['loggedUser'=>$loggedUser, 'active' => 'configuracoes']);?>

<section class="main" style="font-size: 16px;width: 100%;">

    <section class="feed mt-10">

        <h1 style="color: #1c0e8b;font-size: 20px;">Configurações</h1>

        <?php if(!empty($flash)): ?>
            <div class="flash"><?php echo $flash; ?></div>
        <?php endif; ?>

        <hr  style=" margin-top: 10px;"/>
        <form class="config-form" method="POST" enctype="multipart/form-data" action="<?=$base;?>/configuracoes">

            <label>
                Novo Avatar<br/>
                <input type="file" name="avatar" /><br/>
                <img class="image-edit" src="<?=$base;?>/media/avatars/<?=$usuario->avatar; ?>" />
            </label>

            <label>
                Nova Capa<br/>
                <input type="file" name="cover" /><br/>
                <img class="image-edit" src="<?=$base;?>/media/covers/<?=$usuario->capa; ?>" />
            </label>

            <hr  style=" margin-top: 10px;"/>

            <div class="row" style="display: grid;">
                <label>
                    Nome Completo<br/>
                    <input type="text" name="nome" value="<?=$usuario->nome;?>" />
                </label>

                <label>
                    Data de nascimento<br/>
                    <input type="text" name="aniversario" value="<?=date('d/m/Y', strtotime($usuario->aniversario));?>" />
                </label>

                <label>
                    E-mail<br/>
                    <input type="email" name="email" value="<?=$usuario->email;?>" />
                </label>

                <label>
                    Cidade<br/>
                    <input type="text" name="cidade" value="<?=$usuario->cidade;?>" />
                </label>

                <label>
                    Trabalho<br/>
                    <input type="text" name="emprego" value="<?=$usuario->emprego;?>" />
                </label>

                <hr style=" margin-top: 10px;"/>

                <label>
                    Nova Senha<br/>
                    <input type="password" name="senha" />
                </label>

                <label>
                    Confirmar Nova Senha<br/>
                    <input type="password" name="senhaConfirm" />
                </label>
            </div>

            <button class="button">Salvar</button>

        </form>

    </section>

</section>
<script src="https://unpkg.com/imask"></script>
<script>
IMask(
    document.getElementById('aniversario'),
    {
        mask:'00/00/0000'
    }
);
</script>
<style>
    input{
        width: 60%;
        border-radius: 15px;
        padding: 0.6em;
        margin-top: 10px;
    }
    label{
        margin-top: 10px;
    }
</style>
<?=$render('footer');?>