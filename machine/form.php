<script type="text/javascript">var RecaptchaOptions = {theme : 'custom',custom_theme_widget: 'recaptcha_widget'};</script>
<form action="addTag.<?=$lan?>" method="post">
    
    
    	<!-- TAG 			-->
		<input name="tag" 	type="text"  	value="<? 

			if(isset($_COOKIE["tags".$idDec]))echo $_COOKIE["tags".$idDec];
			else echo $tagPossible["0seul"];
			
			?>" class="tag">
		<input name="idDec" type="hidden" 	value="<?=$idDec ?>">
		<input name="lan" 	type="hidden" 	value="<?= $lan ?>"	>

 	   	<!-- CONTRIBUTEUR 	-->
 	    <label><?=trans($lan,234) ?> </label><input name="by" type="text" id="by" value="<?=$_COOKIE['by'] ?>"><br>
 	    <label>www </label><input name="bySite" type="text" id="bySite" value="<?= $_COOKIE['bySite'] ?>">
 	    <br>
 			
 	    <br>
	    <!-- CAPTCHA 		-->
	    

		<div id="recaptcha_widget" style="display:none">
			<a href="javascript:Recaptcha.reload()">
	        <div id="recaptcha_image"></div></a>
	        
	    
	        
	        <span class="recaptcha_only_if_image"><?=trans($lan,233) ?></span></br>
	        <input type="text" id="recaptcha_response_field" name="recaptcha_response_field">
	        <!--<a href="javascript:Recaptcha.reload()">Get another CAPTCHA</a>-->
	        
	    </div>
       	<script type="text/javascript" src="http://www.google.com/recaptcha/api/challenge?k=6LdRWs8SAAAAAN-_TMUmweYIX-kHU38DXkWb8vHX"></script>
       	<?php 
       	
       	if($_COOKIE["error-$idDec"] == "cap") {
       		echo '<p class="error" >Incorrect please try again</p>'; 
       		//setcookie("error-$idDec");
       	}?>
 	   <input name="Ajouter" type="submit" id="edit" value="<?=trans($lan,228)?>"> 

</form>
