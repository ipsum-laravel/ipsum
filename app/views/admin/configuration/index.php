<?php foreach ($menu_configuration as $configuration) : ?>
<div class="bloc_left" style="width: 306px">
	<h3><?php echo $configuration['nom'] ?></h3>
	<table class="detail" >
	    <?php foreach ($configuration['smenus'] as $smenu) : ?>
		<tr>
			<th style="width: 240px;"><?php echo $smenu['nom'] ?></th>
			<td><?php echo Html::anchor('admin/'.$smenu['uri'], 'éditer') ?></td>
		</tr>
		<?php endforeach ?>
	</table>
</div>
<?php endforeach ?>
