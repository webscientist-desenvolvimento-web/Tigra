<script type="text/javascript">
    $(document).ready(function(){
        $('#lista').dataTable({
            "oLanguage": {
                "sUrl": "<?=$url_base?>/cgi/language/pt_BR.txt"
            },
            "sPaginationType": "full_numbers",
            "iDisplayLength": 10,
            "aaSorting": [[2,'asc']],
            "aoColumns":[
                {"bSortable": false},
                {"bSortable": false},
                {"bSortable": true},
                {"bSortable": true}
            ]
        });
    });
</script>
<form action="<?=$url_base?>/cgi/<?=$mod?>/action" method="post" id="form_deletar" onsubmit="return valida_deletar();">
    <table id="table_botoes">
        <tr>
            <td><input type="button" onclick="window.location='<?=$url_base?>/cgi/<?=$mod?>/form'" value="Adicionar" id="bt_novo" /></td>
            <td><input type="submit" value="Excluir" id="bt_excluir" /></td>
        </tr>
    </table>
    <?php
    $busca = $con_cliente->executa("SELECT o.id_noticia, o.titulo, DATE_FORMAT(o.data,'%d/%m/%Y') AS data
                                        FROM noticias AS o
                                        ORDER BY data DESC");
    if($busca && mysqli_num_rows($busca)>0) {
        ?>
    <table width="100%">
        <tr>
            <td id="selectall"><label for="select_all" id="label_select_all">Selecionar / Deselecionar<input type="checkbox" class="crirHiddenJS" name="select_all" id="select_all" onchange="check_all()" /></label></td>
        </tr>
    </table>
    <table id="lista" class="display" border="0" cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <th></th>
                <th></th>
                <th>Título</th>
                <th>Data</th>
            </tr>
        </thead>
        <tbody>
                <?php
                while($item = mysqli_fetch_assoc($busca)) {
                    ?>
            <tr>
                <td class="campo_checkbox"><input type="checkbox" name="del_item[]" id="checkbox<?=$item['id_noticia']?>" value="<?=$item['id_noticia']?>" /></td>
                <td><a href="<?=$url_base?>/cgi/<?=$mod?>/form/<?=$item['id_noticia']?>"><img src="_css/_img/btn/btn_editar.png" /></a></td>
                <td><?=$item['titulo']?></td>
                <td><?=$item['data']?></td>
            </tr>
                    <?php
                }
                ?>
        </tbody>
    </table>
        <?php
    }else {
        ?>
    <div><span class="vazio">Não foi encontrada nenhuma notícia.</span></div>
        <?php
    }
    ?>
</form>
