<?php $medias=$this->getMedias(); ?>

	<table border="3" height="100%" cellspacing="4">
		<tr>
			<th>Image ID</th>
			<th>Images</th>
		</tr>
		<?php if(!$medias) : ?>
			<tr>
				<td colspan="2">NO MEDIA FOUND</td>
			</tr>
		<?php else: ?>
		<?php foreach($medias as $media) : ?>
		</tr>
			<td><?php echo $media->mediaId ?></td>
			<td><img src="<?php echo "Media/Product/".$media->name ?>" width="100" height="100"></td>
		<tr>
		<?php endforeach; ?>
	<?php endif; ?>
		<button ><a href="<?php echo $this->getUrl('grid','product',[],true ) ?>">Back</a></button>
	</table>
