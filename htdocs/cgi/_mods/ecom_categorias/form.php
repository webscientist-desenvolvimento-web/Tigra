<?php
require_once("categorias_produtos.php");
if($id)	{
	$pesquisa = new categorias_produtos();
	$pesquisa->busca($id);
	$id_categorias_produto = $pesquisa->id_categorias_produto;
	$categoria = $pesquisa->categoria;
}
?>
<form action="<?=$url_base?>/cgi/<?=$mod?>/action" method="post" enctype="multipart/form-data" id="form_edicao" onsubmit="return ween_validator(); <?=$validator?>">
<input type="hidden" value="<?=$id_categorias_produto?>" name="id_categorias_produto" id="id_categorias_produto" />
<table id="formulario">
	<tr>
		<td class="tit_campo">Categoria:</td>
    </tr>
    <tr>
		<td><input type="text" name="categoria" id="categoria" maxlength="255" class="inpute gde obrigatorio" title="Categoria" value="<?=$categoria?>" /></td>
    </tr>
</table>
<table id="table_botoes_rodape">
	<tr>	
    	<td><input class="btn_salvar" type="submit" value="" id="bt_salvar"/></td>
        <td><input class="btn_voltar" type="button" value="" onclick="window.location='<?=$url_base?>/cgi/<?=$mod?>'" id="bt_cancelar" /></td>
    </tr>
</table>
</form>