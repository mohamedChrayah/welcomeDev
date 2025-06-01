
<div class ="erreur">
	<ul>
		<?php foreach($_REQUEST['erreurs'] as $erreur){ ?>
			<script type='text/javascript'>
				swal('Oops...', "<?php echo $erreur; ?>", 'error');
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
