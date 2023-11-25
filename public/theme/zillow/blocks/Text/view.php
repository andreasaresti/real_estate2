<?php
$title = $block->setting('title');
$descript = $block->setting('descript');
$align = $block->setting('align') ?? "left";
?>
<div class="main-content  full-width  inner-page" style="padding: 10px;">
	<div class="row">
		<div class="col-12" style="text-align: <?= $align ?>;">
			<h3><?php echo $title; ?></h3>
			<span style="font-size: 18px;"><?php echo $descript; ?></span>

		</div>
	</div>
</div>