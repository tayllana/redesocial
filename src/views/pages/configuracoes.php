<?=$render('header', ['loggedUser'=>$loggedUser, 'active' => 'configuracoes']);?>

<section class="main" style="font-size: 16px;width: 100%;">

    <section class="feed mt-10">

        <?php if(!empty($flash)): ?>
            <div class="flash"><?php echo $flash; ?></div>
        <?php endif; ?>
        <?php $render('perfil-header', ['loggedUser' => $loggedUser, 'usuario' => $usuario, 'seguindo' => false])?>
        <form class="config-form box mt-10" id="form" style="padding: 40px;" method="POST" enctype="multipart/form-data" action="<?=$base;?>/configuracoes">
            <h1 style="margin-bottom: 20px; color: #1c0e8b;font-size: 20px;">Configurações</h1>
            <div class="row" style="margin-bottom: 20px; display: grid; grid-template-columns: repeat(2, 1fr); gap: 16px;">
                <label>
                    <input type="file" class="custom-file-input" name="avatar" data-content="Selecione um novo avatar" onchange="showImagePreview(this, 'avatarImg')" /><br/>
                </label>

                <label>
                    <input type="file" class="custom-file-input" name="cover" data-content="Selecione uma nova Capa" onchange="showImagePreview(this, 'coverImg')" /><br/>
                </label>
            </div>
            <label>
                Nome Completo<br/>
                <input type="text" name="nome" value="<?=$usuario->nome;?>" />
            </label>
            <div class="row" style="display: grid; grid-template-columns: repeat(2, 1fr); gap: 16px;">
                <label>
                    Data de nascimento<br/>
                    <input type="text" name="aniversario" id="aniversario" value="<?=date('d/m/Y', strtotime($usuario->aniversario));?>" />
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
    function showImagePreview(input, previewId) {
        const preview = document.getElementById(previewId);
        const file = input.files[0];

        if (file) {
            const reader = new FileReader();

            reader.onload = function(e) {
                previewId === "coverImg"? preview.style.backgroundImage = `url('${e.target.result}')`: preview.src = e.target.result;
                preview.style.display = 'block';
            };

            reader.readAsDataURL(file);
        } else {
            previewId === "coverImg"? preview.style.backgroundImage = 'none': preview.src = '';
            preview.style.display = 'none';
        }
    }

</script>
<style>
    input{
        width: 100%;
        border-radius: 15px;
        padding: 0.6em;
        margin-top: 10px;
    }
    label{
        margin-top: 10px;
    }

    .custom-file-input {
        color: transparent;
    }
    .custom-file-input::-webkit-file-upload-button {
        visibility: hidden;
    }
    .custom-file-input::before {
        content: attr(data-content);
        color: #ffffff;
        display: inline-block;
        border: 1px solid #999;
        border-radius: 3px;
        padding: 5px 8px;
        outline: none;
        white-space: nowrap;
        -webkit-user-select: none;
        cursor: pointer;
        font-weight: 700;
        font-size: 10pt;
        padding: 10px 20px;
        background-color: #5c2cf1;
        border-radius: 10px;
        text-align: center;
        width: 100%; 
        box-sizing: border-box;
    }
    .custom-file-input:hover::before {
        border-color: black;
    }
    .custom-file-input:active {
        outline: 0;
    }
    .custom-file-input:active::before {
        background: -webkit-linear-gradient(top, #e3e3e3, #f9f9f9); 
    }

</style>
<?=$render('footer');?>