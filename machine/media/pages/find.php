<aside class="findFlash">
	<h2><?= trans($lan,218) // recherche?></h2>
	<p>
	      <!--<object type="application/x-shockwave-flash" data="machine/media/pages/search/findShape.swf?lan=<? echo $lan ?>" width="100%" height="100%">
	        <param name="movie" value="medias/findShape.swf?lan=<? echo $lan ?>" />
	        <param name="wmode" value="transparent">
	        texte alternatif
	      </object>-->
	      <embed src="machine/media/pages/search/findShape.swf?lan=<? echo $lan ?>" TYPE="application/x-shockwave-flash" PLUGINSPAGE="http://www.macromedia.com/go/getflashplayer"
 width="100%" height="100%" wmode="transparent"></embed>
	</p>
</aside>

<aside>
    <h2><?= trans($lan,221) //Rechercher :?></h2>
    <p class="list">
	    <form action="search.<? echo $lan ?>" method="post">
	      <input name="lan" type="hidden" value="<? echo $lan ?>" />
	      <input name="query" type="text" id="query"/> <input name="ok" type="submit" id="edit" value="ok" />
 <!-- <br />-<br /><a href="words.<? echo $lan ?>"><? echo trans($lan,222) //A-Z - tout les mots.?></a><br /> -->
	    </form>
    </p>
</aside>