<script type="text/javascript">
$(document).ready(function(){
	 $("#tabs").tabs();
     $("#tabs ul li a").click(function(){
         var categoria = $(this).attr("rel");
         $.ajax({
             type: "POST",
             url: "<?=$url_base?>/cgi/_mods/<?=$tg_mod?>/muda_sessao.php?noob="+ new Date().getTime(),
             data: "categoria="+categoria
         });
     });
});
</script>
<?php
$_SESSION['del_cat'] = '1';
$query = 'SELECT * FROM catalogo_categorias';
$categorias = $con_cliente->query($query);
?>
<div id="tabs">
    <ul>
        <?php
        while($categoria = $categorias->fetch_assoc()){
            $i = 0;
            $zebrado = array('even','odd');
            ?>
        <li><a href="#tab-<?=$categoria['slug']?>" rel="<?=$categoria['id_produtos_categoria']?>"><?=$categoria['categoria']?></a></li>
        <?php
    }
    ?>
    </ul>
    <form action="<?=$url_base?>/cgi/<?=$mod?>/action" method="post" id="form_deletar" onsubmit="return valida_deletar();">
        <table id="table_botoes">
            <tr>
                <td><input type="button" onclick="window.location='<?=$url_base?>/cgi/<?=$mod?>/form'" value="Novo" id="bt_novo" /></td>
                <td><input type="submit" value="Excluir" id="bt_excluir" /></td>
            </tr>
        </table>

        <?php
        $categorias = $con_cliente->query($query);
        while($categoria = $categorias->fetch_assoc()){
            ?>
        <div id="tab-<?=$categoria['slug']?>">
            <?php
            $query = 'SELECT p.id_catalogo_pagina, p.pagina, cc.categoria FROM catalogo_paginas p INNER JOIN catalogo_categorias cc ON p.id_catalogo_categoria = cc.id_catalogo_categoria WHERE cc.slug="'.$categoria['slug'].'" ORDER BY p.pagina';
            $busca = $con_cliente->executa($query);
            if($busca && mysqli_num_rows($busca)>0){
                ?>
            <table width="100%">
                <tr>
                    <td class="campo_checkbox" id="selectall"><label for="select_all" id="label_select_all">Selecionar / Deselecionar</label><input type="checkbox" class="crirHiddenJS" name="select_all" id="select_all" onchange="check_all()" /></td>
                </tr>
            </table>
            <table id="lista" class="display" border="0" cellpadding="0" cellspacing="0">
                <thead>
                    <tr>
                        <th></th>
                        <th></th>
                        <th>Pagina</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    while($item = mysqli_fetch_assoc($busca)){
                        $i++;
                        ?>
                    <tr class="<?=$zebrado[$i%2]?>">
                        <td class="campo_checkbox"><label for="checkbox<?=$item['id_catalogo_pagina']?>" id="label<?=$item['id_catalogo_pagina']?>"></label><input type="checkbox" class="crirHiddenJS" name="del_item[]" id="checkbox<?=$item['id_catalogo_pagina']?>" value="<?=$item['id_catalogo_pagina']?>" /></td>
                        <td class="campo_editar"><a href="<?=$url_base?>/cgi/<?=$mod?>/form/<?=$item['id_catalogo_pagina']?>"><img src="_css/_img/btn/btn_editar.png" /></a></td>
                        <td><?=$item['pagina']?></td>
                    </tr>
                    <?php
                }
                ?>
                </tbody>
            </table>
            <?php
        }else{
            ?>
            <div><span class="vazio">Não foi encontrado nenhuma página.</span></div>
            <?php
        }
        ?>
        </div>
        
        <?php
    }
    ?>
    </form>
</div>