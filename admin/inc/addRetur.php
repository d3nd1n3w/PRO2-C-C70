<?php if(!defined('BASEPATH')) die('You are not allowed to access this page'); ?>
<?php
	if($_POST){
		extract(html_entities($_POST));
		$picture = "";
		$files = $_FILES['upload']['name'];
		if($files != ""){
			$source = $_FILES['upload']['tmp_name'];
			$ext = end(explode(".",$files));
			$picture = $_FILES['upload']['name'];
			move_uploaded_file($source, "../".$picture);
		}
		
		$Qry = "INSERT INTO addretur (data_retur, `status`)
			VALUES ('".$data."', '".$status."')";
		$Res = mysql_query($Qry);
		if($Res){
			$message = "<div class='success'>Berhasil menambah record baru..</div>";
		} else {
			$message = "<div class='error'>".mysql_error()."</div>";
		}
		$_SESSION['msg'] = $message;
		header("Location: index.php?p=konfirm_retur");
	}
?>
<span class="page-title">Tambah Artikel</span>
<div class="inner">
<form action="" method="post" enctype="multipart/form-data" name="formContent" id="formContent" onsubmit="tinymce.triggerSave(); return validateForm('formContent')">
  <table width="100%" border="0" cellspacing="0" cellpadding="5">
    <tr>
      <td align="left" valign="top">Data Retur</td>
      <td align="left" valign="top">:</td>
      <td align="left" valign="top"><textarea name="content" class="input required" id="content"></textarea></td>
    </tr>
    <tr>
      <td align="left" valign="top">Status</td>
      <td align="left" valign="top">:</td>
      <td align="left" valign="top"><input name="status" type="radio" id="radio" value="1" checked="checked" />
        Publish 
          <input type="radio" name="status" id="radio2" value="0" />
          Unpublish</td>
    </tr>
  </table>
  <hr />
  <input type="button" value="Cancel" class="button" onclick="window.location='index.php?p=konfirm_retur';" />
  <input type="submit" value="Simpan" class="button" />
</form>
<div class="clr"></div>
</div>
<script type="text/javascript">
tinymce.init({
	skin 	: 'lightgray',
	content_css : "admin/asset/css/content.css",
	document_base_url: "<?php echo abspath;?>",
	width	: 600,
	height	: 300,
	selector: "#content",
    plugins	: [
    	"moxiemanager advlist autolink link image lists charmap hr anchor pagebreak",
        "visualblocks visualchars code media nonbreaking table contextmenu directionality emoticons textcolor textcolor"
	],

    toolbar1: "insertfile | bold italic underline strikethrough | alignleft aligncenter alignright alignjustify | bullist numlist | outdent indent blockquote",
    toolbar2: "fontselect fontsizeselect | link unlink anchor image media code | forecolor backcolor | table | hr removeformat",
    menubar: false,
	toolbar_items_size: 'small'
});
</script>