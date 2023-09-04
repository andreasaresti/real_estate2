<?php
	$title = $block->setting('title');
	$descript = $block->setting('descript');
	$file = $block->setting('file');
?>
<div class="main-content  full-width  inner-page" style="padding: 40px;">
	<div class="row">
		<div class="col-6">
			<h3><?php echo $title; ?></h3>
			<span style="font-size: 18px;"><?php echo $descript; ?></span>
		</div>
		<div class="col-6" style="display: flex;justify-content: center;align-items: center;">
			<img src="<?php echo $file; ?>" width="100%" height="100%">
		</div>
	</div>
</div>
