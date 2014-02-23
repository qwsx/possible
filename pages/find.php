  <div class="proches">
    <h2><? echo trans($lan,218) // recherche?></h2>
    <p class="colone">
      <object type="application/x-shockwave-flash" data="medias/findShape.swf?lan=<? echo $lan ?>" width="160" height="160">
        <param name="movie" value="medias/findShape.swf?lan=<? echo $lan ?>" />
        <param name="wmode" value="transparent">
        texte alternatif
      </object>
    </p>
    <h2><? echo trans($lan,220) // Mot en image?></h2>
    <form  action="search.<? echo $lan ?>" method="post">
<br><br>

      <? echo trans($lan,221) //Rechercher :?> <br>
      <input name="lan" type="hidden" value="<? echo $lan ?>" />
      <input name="query" type="text" id="query" size="12"/> <input name="ok" type="submit" id="edit" value="ok" />
      
          <br>-<br><a href="words.<? echo $lan ?>"><? echo trans($lan,222) //A-Z - tout les mots.?></a><br />
    </form>
    <h2><? echo trans($lan,224) //Aide ??></h2>
    <p class="colone"><? echo trans($lan,225) //Survolez les titres pour obtenir de l'aide.?><br />
-<br />
<? echo '<a href="5943.fr">'.$GLOBALS['fr'][102].'</a> <br /> <a href="4977.en">'.$GLOBALS['en'][102].'</a> <br /> <a href="53585.de">'.$GLOBALS['de'][102].'</a> <br /> <a href="4977.es">'.$GLOBALS['es'][102].'</a>';?>
-<br />
<br /><a id="copy" href="http://versatile.fr"> versatile.fr &copy; 2008-<? echo date("Y");?></a>

</p>
  </div>
</div>
