<?php $medias=$this->getMedias(); ?>

	<table border="3" height="100%" cellspacing="4">
		<tr>
			<th>Image ID</th>
			<th>Images</th>
		<?php foreach($medias as $media) : ?>
		</tr>
			<td><?php echo $media->mediaId ?></td>
			<td><img src="<?php echo "Media/Category/".$media->name ?>" width="100" height="100"></td>
		<tr>
		<?php endforeach; ?>
		<button ><a href="<?php echo $this->getUrl('grid','category',[],true ) ?>">Back</a></button>
	</table>
