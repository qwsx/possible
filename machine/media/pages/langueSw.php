<nav id="langueSw" class="sw<?= $lan?>">
	<a class="btfr" href="<?=str_replace('.en','.fr',$_SERVER['REQUEST_URI']);?>">fr</a> | 
	<a class="bten"href="<?=str_replace('.fr','.en',$_SERVER['REQUEST_URI']);?>">en</a>
</nav>