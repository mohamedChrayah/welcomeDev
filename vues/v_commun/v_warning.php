
<div class ="warning">
	<ul>
		<?php foreach($_REQUEST['warning'] as $warning){ ?>
			<script type='text/javascript'>
				swal('Attention...', "<?php echo $warning; ?>", 'info');
			</script>
		<?php } ?>
	</ul>
</div>


<!-- echo"<script type='text/javascript'>
Swal.fire({
	icon: 'error',
	title: 'Oops...',
	text: 'Oups un probleme est survenue lors de la saisie...',
});
</script>"; -->
