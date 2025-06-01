		</div>
		<!-- Division pour le pied de page -->
		<!-- <footer>
			© <?= date('Y'); ?> - Pôle Innovation - Crédit Agricole Centre Loire
		</footer> -->


		<!-- PAGINATION DES TABLEAUX -->
		<script type="text/javascript" src="js/pagination.js"></script>

		<!-- IMPORTATION DES BIBLIOTHEQUES DEBUT -->

		<!--Chart js PLUGIN -->
		<script src="Bibliotheques/ChartJsPlugins/ChartPlugins.js"></script>

		<!-- Core -->
		<script src="assets/vendor/jquery/dist/jquery.min.js"></script>
		<script src="assets/vendor/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
		<script src="assets/vendor/js-cookie/js.cookie.js"></script>
		<script src="assets/vendor/jquery.scrollbar/jquery.scrollbar.min.js"></script>
		<script src="assets/vendor/jquery-scroll-lock/dist/jquery-scrollLock.min.js"></script>
		<script src="assets/vendor/anchor-js/anchor.min.js"></script>
		<script src="assets/vendor/clipboard/dist/clipboard.min.js"></script>
		<script src="assets/vendor/holderjs/holder.min.js"></script>
		<script src="assets/vendor/prismjs/prism.js"></script>

		<!-- Optional JS -->
		<script src="assets/vendor/chart.js/dist/Chart.min.js"></script>
		<script src="assets/vendor/chart.js/dist/Chart.extension.js"></script>
		<script src="assets/vendor/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js"></script>
		<script src="assets/vendor/bootstrap-datepicker/dist/locales/bootstrap-datepicker.fr.min.js"></script>
		<script src="assets/vendor/selectPicker/dist/js/bootstrap-select.min.js"></script>
		<script src="Bibliotheques/JQuery/jquery.validate.min.js"></script>
		<script src="Bibliotheques/JQuery/additional-methods.min.js"></script>

		<script src="assets/vendor/DatatableBs4FullOp/datatables.min.js"></script>
		<script src="assets/vendor/DatatableBs4FullOp/RowsGroups-2.0.0/rowsGroup.js"></script>
		<script src="assets/vendor/moment/min/moment-with-locales.min.js"></script>
		<script src="assets/vendor/CDN/datatable-datetime-moment.js"></script>
		<script src="assets/vendor/CDN/datatable-sum.js"></script>
		<script src="assets/vendor/CDN/bootstrap-datetimepicker.js"></script>
		<script src="assets/vendor/CDN/moment.min.js"></script>

		<script src="Bibliotheques/NumeralJS/min/numeral.min.js"></script>

		<script type="text/javascript">
			numeral.register('locale', 'fr', {
				delimiters: {
					thousands: ' ',
					decimal: ','
				},
				abbreviations: {
					thousand: 'k',
					million: 'm',
					billion: 'b',
					trillion: 't'
				},
				ordinal: function(number) {
					return number === 1 ? 'er' : 'ème';
				},
				currency: {
					symbol: '€'
				}
			});

			// switch between locales
			numeral.locale('fr');
		</script>

		<!-- IMPORT BASE 64 ENCODAGE ET DECODAGE -->
		<script src="Bibliotheques/Base64-js/jquery.base64.min.js"></script>

		<!-- IMPORTATION DES BIBLIOTHEQUES FIN -->

		<!-- IMPORTANT NE SURTOUT PAS SUPPRIMER /!\ -->
		<script type="text/javascript">
			// IMPOSSIBILITE D ENVOYER 2 FOIS LE MEME FORMULAIRE
			if (window.history.replaceState) {
				window.history.replaceState(null, null, window.location.href);
			}
		</script>
		<!-- IMPORTANT NE SURTOUT PAS SUPPRIMER /!\ -->

		<!-- SCRIPT TEST POUR COLLAPSE DU MENU VERTICAL-->
		<script type="text/javascript">
			$(document).ready(function() {
				$('#sidenav-icon').removeClass('active');
				$('body').removeClass('nav-open');

				var endDay = new Date(moment().add(25 - new Date().getHours(), 'hours'));
				var params = new URLSearchParams(document.location.search.substring(1));
				Cookies.set('traficJournalier' + params.get("uc"), 'true', {
					expires: endDay
				});
			});


			$('.btn-expand-collapse, #btn-menu-utilisateur, .btn-expand-collapse-middle').click(function(e) {

				// MISE A JOUR DU DOM EN CSS ET JS DEBUT

				// ACTION SUR LE MENU VERTICAL
				$('#navbar-utilisateur').toggleClass('w-100');
				$('#navbar-utilisateur').toggleClass('w-0');

				// ACTION SUR LE BTN MENU DES UTILISATEURS
				$('#btn-menu-utilisateur').toggleClass('nav-open-vertical');

				// ACTION SUR LE CONTENU DE LA VUE
				$('#nav-info-utilisateur').toggleClass('offset-md-2 col-md-10');
				$('#nav-info-utilisateur').toggleClass('col-12');

				$('#panel-utilisateur').toggleClass('offset-md-2 col-md-10');
				$('#panel-utilisateur').toggleClass('col-12');

				$('#panel-vue').toggleClass('offset-md-2 col-md-10');
				$('#panel-vue').toggleClass('col-12');


				if ($(this).hasClass('btn-expand-collapse') || ($(this).attr('id') == 'btn-menu-utilisateur' && $(".btn-expand-collapse-middle").hasClass('d-none'))) {
					setTimeout(function() {
						$(".btn-expand-collapse-middle").toggleClass('d-none')
					}, 700);
				} else {
					$(".btn-expand-collapse-middle").toggleClass('d-none');
				}

				// MISE A JOUR DU DOM EN CSS ET JS FIN

				// MISE A JOUR DU CHOIX DU CLIENT DANS UN COOKIE UTILISER POUR LES PROCHAINES CONNEXIONS DU CLIENT

				if ($('#navbar-utilisateur').hasClass('w-100')) {
					var valeurMenu = "open";
				} else {
					var valeurMenu = "close";
				}

				Cookies.set('choixMenuUtilisateur', valeurMenu, {
					expires: 31
				}) // js-cookies // 31 jours
			});
		</script>

		<!-- date picker au format fr et dd/mm/yyyy -->
		<!-- selectpicker en fr  -->
		<script type="text/javascript">
			// Date picker classique
			$('.datepicker').datepicker({
				language: 'fr',
				// autoclose: true,
				todayHighlight: true,
				orientation: "auto"
			})

			// Date picker classique la date max est la date du jour
			$('.datepickerMaxNow').datepicker({
				language: 'fr',
				// autoclose: true,
				todayHighlight: true,
				orientation: "auto",
				endDate: new Date()
			})

			// Date picker classique la date min est la date du jour
			$('.datepickerMinNow').datepicker({
				language: 'fr',
				// autoclose: true,
				todayHighlight: true,
				orientation: "auto",
				startDate: new Date()
			})

			// Date picker pour selection du mois et de l'année uniquement
			$('.datepickerMonth').datepicker({
				language: 'fr',
				format: "mm/yyyy",
				startView: "months",
				minViewMode: "months",
				orientation: "auto"
			});

			// Date picker pour selection du mois uniquement
			$('.datepickerMonthOnly').datepicker({
				language: 'fr',
				format: "mm",
				startView: "months",
				minViewMode: "months",
				orientation: "auto"
			});

			// Date picker pour selection du mois uniquement au format avec l'année
			$('.datepickerMonthOnlyFormat-mmyyyy').datepicker({
				language: 'fr',
				format: "mm/yyyy",
				startView: "months",
				minViewMode: "months",
				orientation: "auto"
			});

			// Date picker pour selection de l'année uniquement
			$('.datepickerYears').datepicker({
				language: 'fr',
				format: "yyyy",
				startView: "years",
				minViewMode: "years",
				orientation: "auto"
			});

			$('.input-daterange').each(function() {
				$(this).datepicker({
					language: 'fr',
					autoclose: true,
					todayHighlight: true,
					orientation: "auto"
				});
			});

			// PERMET DE RENDRE CLIQUABLE LE CALENDRIER SUR LE CHAMP DATEPICKER
			$('.input-group-prepend, .input-group-append').click(function() {
				var elmt = $(this).closest('.input-group').find('.datepicker, .datepickerMaxNow, .datepickerMinNow, .datepickerMonth, .datepickerMonthOnly, .datepickerMonthOnlyFormat-mmyyyy, .datepickerYears, .input-daterange');

				if(elmt.length > 0){
					if(!elmt[0].hasAttribute('disabled') && !elmt[0].hasAttribute('readonly')){
						elmt.datepicker("show");
					}
				}
			});

			$('.selectpicker').selectpicker({
				selectAllText: 'Sélectionner tout',
				deselectAllText: 'Tout désélectionner',
				noneResultsText: 'Aucun résultat pour {0}',
				maxOptionsText: "Vous ne pouvez pas sélectionner plus d'éléments",
				countSelectedText: function(num) {
					if (num == 1) {
						return "{0} élément sélectionné";
					} else {
						return "{0} éléments sélectionnés";
					}
				}
			});

			// Permet de réorganiser par ordre Alphabétique les option d'un selectPicker
			function orderOptionSelectpicker(id) {
				let options = $('#' + id + ' option')

				let sortedOptions = options.toArray().sort(function(a, b) {
					return a.text.localeCompare(b.text);
				});

				$('#' + id).empty();

				$.each(sortedOptions, function(index, option) {
					$('#' + id).append(option);
				});

				$('#' + id).selectpicker('refresh');
			}

			$('.disableSubmit').submit(function() {
				if (!$('.disableSubmit').valid()) {
					return false;
				}

				$('.disableSubmit [type=submit]').attr("disabled", "disabled");
				return true;
			});

			// Return la date du jour au format DD/MM/YYYY
			function getDateDuJour() {
				const today = new Date();
				const yyyy = today.getFullYear();
				let mm = today.getMonth() + 1; // Months start at 0!
				let dd = today.getDate();

				if (dd < 10) dd = '0' + dd;
				if (mm < 10) mm = '0' + mm;

				return dd + '/' + mm + '/' + yyyy;
			}

			//  gestion du pluriel
			function pluriel(nbr) {
				if (nbr > 1) {
					return 's';
				} else {
					return '';
				}
			}

			// Séparateur de millers dans un input a mettre dans un onchange
			/*
							/!\/!\/!\/!\/!\/!\/!\/!\/!\/!\/!\/!\/!\/!\/!\/!\/!\
								ATTENTION LE TYPE DE L'INPUT DOIT ETRE CURRENCY
							/!\/!\/!\/!\/!\/!\/!\/!\/!\/!\/!\/!\/!\/!\/!\/!\/!\
			*/
			function currencyInput() {
				var currencyInputs = document.querySelectorAll('input[type="currency"]');

				// format inital value
				for (let i = 0; i < currencyInputs.length; i++) {
					const currencyInput = currencyInputs[i];

					let text = currencyInput.value

					text = text.replace(/\s/g, '');
					text = text.replace(/\B(?=(\d{3})+(?!\d))/g, ' ');

					currencyInput.value = text;
				}
			}
		</script>

		<script>
			function getMimeType(extension) {
				switch (extension) {
					case '.xlsx':
						return 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet';
					case '.pdf':
						return 'application/pdf';
					case '.bmp':
						return 'image/bmp';
					case '.csv':
						return 'text/csv';
					case '.doc':
						return 'application/msword';
					case '.docx':
						return 'application/vnd.openxmlformats-officedocument.wordprocessingml.document';
					case '.jpg':
					case '.jpeg':
						return 'image/jpeg';
					case '.ppt':
						return 'application/vnd.ms-powerpoint';
					case '.pptx':
						return 'application/vnd.openxmlformats-officedocument.presentationml.presentation';
					case '.xls':
						return 'application/vnd.ms-excel';
					case '.zip':
						return 'application/zip';
					case '.7z':
						return 'application/x-7z-compressed';
					case '.png':
						return 'image/png';
					default:
						return 'application/octet-stream';
				}
			}
		</script>


		<!-- FUNCTION COMMUNE POUR LE COUNT DE CHARACTERE D'UN TEXTAREA -->
		<script type="text/javascript">
			// PARAMETRES
			// val = textarea
			// idCompteur = id du titre qui sert de compteur
			function countCharCorpGenerique(val, idCompteur) {
				var len = val.value.length;
				if (len > $('#' + val.id).attr("data-length")) {
					val.value = val.value.substring(0, $('#' + val.id).attr("data-length"));
				} else {
					$('#' + idCompteur).text(len + " / " + $('#' + val.id).attr("data-length"));
				}
				if (len == 0) {
					$('#' + idCompteur).hide()
				} else {
					$('#' + idCompteur).show()
				}
			}
		</script>

		<!-- GESTION DES POURCENTAGE POUR LES DATATABLE -->
		<script type="text/javascript">
			jQuery.extend(jQuery.fn.dataTableExt.oSort, {
				"percent-pre": function(a) {
					var x = (a == "-") ? 0 : a.replace(/%/, "");
					return parseFloat(x);
				},

				"percent-asc": function(a, b) {
					return ((a < b) ? -1 : ((a > b) ? 1 : 0));
				},

				"percent-desc": function(a, b) {
					return ((a < b) ? 1 : ((a > b) ? -1 : 0));
				}
			});
		</script>

		<script>
			/**
			 * ajaxUrl : STRING = Url du controolleur Ajax
			 * method : STRING = 'GET' | 'POST'
			 * args : JSON
			 *
			 * bien penser à l'appeler aussi en ASYNC / AWAIT
			 */
			async function doAjax(ajaxUrl, method, args) {
				let result;

				try {
					result = await $.ajax({
						url: ajaxUrl,
						type: method,
						data: args
					});

					return JSON.parse(result);
				} catch (error) {
					console.error(error);
				}
			}

			function $_GET(param) {
				var vars = {};
				window.location.href.replace(location.hash, '').replace(
					/[?&]+([^=&]+)=?([^&]*)?/gi, // regexp
					function(m, key, value) { // callback
						vars[key] = value !== undefined ? value : '';
					}
				);

				if (param) {
					return vars[param] ? vars[param] : null;
				}
				return vars;
			}

			function urltoFile(url, filename, mimeType) {
				mimeType = mimeType || (url.match(/^data:([^;]+);/) || '')[1];
				return (fetch(url)
					.then(function(res) {
						return res.arrayBuffer();
					})
					.then(function(buf) {
						return new File([buf], filename, {
							type: mimeType
						});
					})
				);
			}

			/*
			 *Permet de générer un PNg depuis un DOM html
			 * @var id 			Mettre l'id de la balise qui entoure ce que vous devez capturer
			 * @var nomFile	Le nom du fichier de sortie (Synthese_assurance_jeudi_10_novembre_2022.png)
			 * @var height		Par defaut a 100vh hauteur du fichier de sortie
			 */
			function createPngToHtml(id, nomFile, height = '100vh') {
				let all = document.getElementById(id)
				let originalHeight = $(all).css('height');
				$(all).css('height', height)
				html2canvas(all)
					.then(function(canvas) {
						var imgData = canvas.toDataURL('image/png');
						urltoFile(imgData, 'a.png')
							.then(function(file) {
								const event = new Date();
								const options = {
									weekday: 'long',
									year: 'numeric',
									month: 'long',
									day: 'numeric'
								};
								let date = event.toLocaleDateString('fr-FR', options)
								date = date.replaceAll(' ', '_')
								let a = document.createElement("a");
								a.href = window.URL.createObjectURL(file);
								a.download = nomFile + "_" + date + ".png";
								a.click();
								$(all).css('height', originalHeight)
							})
					});
			}
		</script>


		<!-- TOUJOURS EN DERNIER !! -->

		<!-- Argon JS -->
		<script src="assets/js/argon.min.js"></script>

		</body>

		</html>