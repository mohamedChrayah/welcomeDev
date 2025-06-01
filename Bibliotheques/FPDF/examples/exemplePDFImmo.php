<?php

// require_once ('Bibliotheques/FPDF/fpdf_bookmarks.php');
// require_once ('Bibliotheques/FPDF/fpdf_merge.php');
// require_once ('Bibliotheques/FPDI/src/autoload.php');
// require_once ('Bibliotheques/FPDF/fpdf.php');

// $pdf->SetTitle($titre);                    --> Nom du fichier PDF
// $pdf->SetKeywords($keyWords);              --> Mot clé disponible dans les propriété du fichier PDF
// $pdf->AddPage();                           --> Ajouter une nouvelle page
// $pdf->Bookmark($signetSommaire, true);     --> Ajoute un signet dans le document
// $pdf->SetFont('Arial', '', 20);            --> Mise à jour de la police, gras/souligne/italique et de la taille
// $pdf->SetXY(85, 15);                       --> Mise à jour de la position du premier caractère du paragraph en X et Y
// $pdf->Write(0,$typeContrat);               --> Ecrire la chaine de caractère
// $pdf->Line(10, 30, 200, 30);               --> ajoute une ligne
// $pdf->SetY(47);                            --> Mise à jour de la position du premier caractère du paragraph en X
// $pdf->Justify(iconv("UTF-8", "CP1252", $caisseRegionale), 90, 5, 20);
//  -->   Ajout d'un texte justifié ne dépassant pas la marge du PDF
//  -->   iconv UTF-8 pour les accents,
//  -->   CP1252 code a appliquer
//  -->   la chaine de caractère


function gerenatePDF($nomEmetteur,$agenceEmetteur,$adresseEmetteur,$telEmetteur,$mailEmetteur,$formeJuridique,$RCS,$destinataireAdresse,$destinataireTel,$destinataireMail,$NomCartePro,$nomGarant,$montantGarant,$garantie,$nomClient,$telClient,$adresseClient,$emailClient,$isClient,$dispo,$typeBesoinClient,$localisationBesoinClient,$typeBienClient,$nombrePiece,$surfaceBienClient,$entretien,$commentaireClient,$cond1,$cond2,$typeContrat){

		ob_get_clean();

		include("vues/v_variablesDesCaisses.php");

		$pdf = new PDF_Bookmark();

		if($typeContrat == "Fiche Contact"){
			$pdf->SetTitle($titreFicheContact);
			$pdf->SetKeywords($keyWordFicheContact);
		}

		if($typeContrat == "Fiche Entretien"){
			$pdf->SetTitle($titreFicheEntretien);
			$pdf->SetKeywords($keyWordFicheEntretien);
		}

		$pdf->AddPage();

		// SIGNET DE LECTURE
		$pdf->Bookmark($signetSommaire, true);
		$pdf->SetFont('Arial', '', 20);
		$pdf->SetXY(85, 15);
		$pdf->Write(0,$typeContrat);
		$pdf->Line(10, 30, 200, 30);

		//Emetteur
		$pdf->SetFont('Arial', 'B', 11);
		$pdf->SetXY(50, 40);
		$pdf->Write(0,utf8_decode("EMETTEUR"));
		$pdf->SetXY(145, 40);
		$pdf->Write(0,utf8_decode("DESTINATAIRE"));

		$pdf->SetY(47);
		$pdf->Justify(iconv("UTF-8", "CP1252", $caisseRegionale), 90, 5, 20);

		// representé
		$pdf->SetFont('Arial', '', 10);
		$pdf->SetXY(20, 65);
		$pdf->Write(0,utf8_decode("Représentée"));
		$pdf->SetXY(20, 70);
		$pdf->Write(0,utf8_decode("Par :"));
		$pdf->SetXY(30, 70);
		$pdf->Write(0,utf8_decode($nomEmetteur));

		//Agence
		$pdf->SetXY(20, 75);
		$pdf->Write(0,utf8_decode("Agence :"));

		$pdf->SetXY(35, 75);
		$pdf->Write(0,utf8_decode($agenceEmetteur));

		//Adresse
		$pdf->SetXY(20, 80);
		$pdf->Write(0,utf8_decode("Adresse :"));
		$pdf->SetY(77.5);
		$pdf->Justify(iconv("UTF-8", "CP1252", $adresseEmetteur), 75, 5, 36);

		//Tél
		$pdf->SetXY(20, 90);
		$pdf->Write(0,utf8_decode("Tél :"));

		$pdf->SetXY(28, 90);
		$pdf->Write(0,utf8_decode($telEmetteur));

		//Mail
		$pdf->SetXY(20, 95);
		$pdf->Write(0,utf8_decode("Mail :"));

		$pdf->SetXY(30, 95);
		$pdf->Write(0,utf8_decode($mailEmetteur));

		$pdf->SetFont('Arial', '', 7);
		$pdf->SetY(105);
		$pdf->Justify(iconv("UTF-8", "CP1252", $mentionLegaleCaisseRegionale), 90, 3, 20);

		// Destinataire
		$pdf->SetFont('Arial', 'B', 11);
		$pdf->SetXY(120, 50);
		$pdf->Write(0,utf8_decode($squareHabitat));
		$pdf->SetFont('Arial', '', 10);

		// forme juridique
		$pdf->SetXY(120, 60);
		$pdf->Write(0,utf8_decode("Forme juridique : "));

		$pdf->SetXY(148, 60);
		$pdf->Write(0,utf8_decode($formeJuridique));


		$pdf->SetXY(120, 65);
		$pdf->Write(0,utf8_decode("RCS : "));

		$pdf->SetXY(131, 65);
		$pdf->Write(0,utf8_decode($numRCS));

		$pdf->SetXY(120, 75);
		$pdf->Write(0,utf8_decode("Adresse : "));
		$pdf->SetY(72.5);
		$pdf->Justify(iconv("UTF-8", "CP1252", $destinataireAdresse), 60, 5, 137);

		$pdf->SetXY(120, 85);
		$pdf->Write(0,utf8_decode("Tél : "));
		$pdf->SetXY(128, 85);
		$pdf->Write(0,utf8_decode($destinataireTel));

		$pdf->SetXY(120, 90);
		$pdf->Write(0,utf8_decode("Mail : "));
		$pdf->SetXY(130, 90);
		$pdf->Write(0,utf8_decode($destinataireMail));

		$pdf->SetXY(120, 95);
		$pdf->Write(0,utf8_decode("N° carte pro : "));
		$pdf->SetXY(142, 95);
		$pdf->Write(0,utf8_decode($numCartePro));

		$pdf->SetXY(120, 100);
		$pdf->Write(0,utf8_decode("Garant / Montant garantie : "));
		$pdf->SetXY(163, 100);
		$newChamps = utf8_decode($nomGarant) . " / " . iconv("UTF-8", "CP1252", $montantGarant);
		$pdf->Write(0,$newChamps);

		$pdf->SetFont('Arial', '', 7);
		// $texte = "SAS SQH-USA au capital de 9.000.000 €- Siège social : 1 rue Pierre Truchis de Lays 69410 CHAMPAGNE AU MONT D'OR - RCS Lyon 444 464 283 - Code APE 6831 Z - TVA intracommunautaire FR 15 444 464 283 - Carte professionnelle délivrée par la CCI de Lyon n° CPI 6901 2016 000 003 387. Garantie CAMCA 53 rue de la Boétie 75008 PARIS n° 10 001 384 - T 110.000 € - G 4.000.000 € - Immatriculée à l'Orias n° 10056266";
		$pdf->SetY(105);
		$pdf->Justify(iconv("UTF-8", "CP1252", $mentionLegalesDestinaitaire), 75, 3, 120);

		// Caracteristiques du client
		$pdf->SetFont('Arial', 'B', 11);
		$pdf->SetXY(70, 150);
		$pdf->Write(0,utf8_decode("CARACTERISTIQUES DU CLIENT"));
		$pdf->SetFont('Arial', '', 10);

		$pdf->SetXY(20, 160);
		$pdf->Write(0,utf8_decode("Client :"));
		$pdf->SetXY(32, 160);
		$pdf->Write(0,utf8_decode($nomClient));

		$pdf->SetXY(120, 160);
		$pdf->Write(0,utf8_decode("Client du Crédit Agricole :"));
		$pdf->SetXY(162, 160);
		$pdf->Write(0,utf8_decode($isClient));

		$pdf->SetXY(20, 165);
		$pdf->Write(0,utf8_decode("Adresse :"));
		$pdf->SetXY(37, 165);
		$pdf->Write(0,utf8_decode($adresseClient));

		$pdf->SetXY(20, 170);
		$pdf->Write(0,utf8_decode("Tél :"));
		$pdf->SetXY(28, 170);
		$pdf->Write(0,utf8_decode($telClient));

		$pdf->SetXY(90, 170);
		$pdf->Write(0,utf8_decode("Mail :"));
		$pdf->SetXY(100, 170);
		$pdf->Write(0,utf8_decode($emailClient));

		$pdf->SetXY(20, 175);
		$pdf->Write(0,utf8_decode("Disponibilité :"));
		$pdf->SetXY(42, 175);
		$newDispo = utf8_decode($dispo[0]);
		for($i = 1; $i < count($dispo); $i++){
			$newDispo = $newDispo . " / " . utf8_decode($dispo[$i]);
		}
		$pdf->Write(0, $newDispo);

		$pdf->SetFont('Arial', 'I', 10);
		$pdf->SetY(190);
		$pdf->Justify(iconv("UTF-8", "CP1252", $oppositionClientDemarchage), 175, 5, 20);

		// BESOIN
		$pdf->SetFont('Arial', 'B', 11);
		$pdf->SetXY(100, 212);
		$pdf->Write(0,utf8_decode("BESOIN"));
		$pdf->SetFont('Arial', '', 10);

		$pdf->SetXY(20, 217);
		$pdf->Write(0,utf8_decode("Type de besoin :"));
		$pdf->SetXY(47, 217);
		$pdf->Write(0,utf8_decode($typeBesoinClient));

		$pdf->SetXY(20, 222);
		$pdf->Write(0,utf8_decode("Autres Information :"));
		$pdf->SetXY(20, 227);
		$pdf->Write(0,utf8_decode("Localisation : " . $localisationBesoinClient));
		$pdf->SetXY(115, 227);
		$pdf->Write(0,utf8_decode("Type de bien : " . $typeBienClient));
		$pdf->SetXY(20, 232);
		$pdf->Write(0,utf8_decode("Nombre de pièces : " . $nombrePiece));
		$pdf->SetXY(115, 232);
		$pdf->Write(0,utf8_decode("Surface : " . $surfaceBienClient . "m²"));

		$pdf->SetXY(20, 242);
		$pdf->Write(0,utf8_decode("Entretien réalisé dans le cadre de Trajectoires Patrimoine : " . $entretien));

		$texte = "J'accepte de recevoir de la part du destinataire mentionné ci-avant des courriers électroniques, MMS, SMS de prospection commerciale portant sur ses produits : " . $cond1;
		$pdf->SetY(247);
		$pdf->Justify(iconv("UTF-8", "CP1252", $texte), 175, 5, 20);

		$pdf->SetFont('Arial', 'B', 10);
		$texte = "Cette fiche contact ne constitue pas un mandat d'entremise (c'est-à-dire de vendre, ni d'acheter, ni de louer, ni de gérer, au sens des dispositions de la loi du 2 janvier 1970) donné par le client mentionné ci-avant.";
		$pdf->SetY(260);
		$pdf->Justify(iconv("UTF-8", "CP1252", $texte), 175, 4, 20);

		// SI LA FICHE EST ENTRETIEN ALORS AFFICHER CE TEXTE
		if($typeContrat == "Fiche Entretien"){
			$pdf->AddPage();

			$pdf->SetFont('Arial', 'B', 11);
			$pdf->SetXY(20, 20);
			$pdf->Write(0,utf8_decode("ORGANISATION D`UN ENTRETIEN ENTRE LE CLIENT, L`EMETTEUR ET LE DESTINATAIRE"));

			$pdf->SetFont('Arial', 'B', 10);
			$texte = "Accord pour la transmission des informations et levée du secret bancaire";
			$pdf->SetY(30);
			$pdf->Justify(iconv("UTF-8", "CP1252", $texte), 175, 5, 20);

			$pdf->SetFont('Arial', '', 10);
			$texte = "J’autorise expressément l'Emetteur à transmettre au Destinataire les informations mentionnées concernant :";
			$pdf->SetY(40);
			$pdf->Justify(iconv("UTF-8", "CP1252", $texte), 175, 5, 20);

			$texte = "- La connaissance client";
			$pdf->SetY(45);
			$pdf->Justify(iconv("UTF-8", "CP1252", $texte), 165, 5, 30);

			$texte = "- Mon patrimoine immobilier / mes placements";
			$pdf->SetY(50);
			$pdf->Justify(iconv("UTF-8", "CP1252", $texte), 165, 5, 30);

			$texte = "- Ma capacité d’emprunt / mes emprunts en cours";
			$pdf->SetY(55);
			$pdf->Justify(iconv("UTF-8", "CP1252", $texte), 165, 5, 30);

			$texte = "-	Mes assurances";
			$pdf->SetY(60);
			$pdf->Justify(iconv("UTF-8", "CP1252", $texte), 165, 5, 30);

			$texte = "-	Mon projet immobilier ";
			$pdf->SetY(65);
			$pdf->Justify(iconv("UTF-8", "CP1252", $texte), 165, 5, 30);

			$texte = "et le délie en conséquence du secret professionnel auquel il est tenu sur ces informations.";
			$pdf->SetY(70);
			$pdf->Justify(iconv("UTF-8", "CP1252", $texte), 165, 5, 20);
		}

		// PAGE 3 COMMUNE
		$pdf->AddPage();

		$pdf->SetFont('Arial', 'B', 11);
		$texte = "PARTIE RESERVEE AU CLIENT";
		$pdf->SetY(10);
		$pdf->Justify(iconv("UTF-8", "CP1252", $texte), 175, 5, 70);

		$pdf->SetFont('Arial', 'BU', 10);
		$texte = "Accord pour la transmission des informations et levée du secret bancaire :";
		$pdf->SetY(20);
		$pdf->Justify(iconv("UTF-8", "CP1252", $texte), 175, 5, 20);

		$pdf->SetFont('Arial', '', 10);
		$texte = "Par la signature de la présente fiche, j'accepte d'être contacté(e) par le Destinataire mentionné ci-avant. J'autorise expressément l'Emetteur à transmettre à ce Destinataire les informations mentionnées dans la présente fiche contact et le délie en conséquence du secret professionnel auquel il est tenu sur ces informations.";
		$pdf->SetY(30);
		$pdf->Justify(iconv("UTF-8", "CP1252", $texte), 175, 5, 20);

		$pdf->SetFont('Arial', 'BU', 10);
		$texte = "Information sur les traitements de données à caractère personnel";
		$pdf->SetY(55);
		$pdf->Justify(iconv("UTF-8", "CP1252", $texte), 175, 5, 20);

		$pdf->SetFont('Arial', 'BU', 10);
		$texte = "I. Traitements mis en œuvre par l'Emetteur";
		$pdf->SetY(65);
		$pdf->Justify(iconv("UTF-8", "CP1252", $texte), 175, 5, 20);

		$pdf->SetFont('Arial', '', 10);

		$texte = "Je suis informé(e), conformément à la Réglementation relative à la protection des données, que mes données à caractère personnel collectées via la présente Fiche contact pourront faire l’objet de traitements informatisés par l’Emetteur ci-avant désigné, en qualité de responsable de traitement, pour les finalités suivantes :";
		$pdf->SetY(75);
		$pdf->Justify(iconv("UTF-8", "CP1252", $texte), 175, 5, 20);

		$texte = "- Gestion de ma demande de transmission des informations contenues dans la présente Fiche contact au Destinataire sur la base de mon consentement";
		$pdf->SetY(95);
		$pdf->Justify(iconv("UTF-8", "CP1252", $texte), 165, 5, 30);

		$texte = "- Calcul des commissions versées au Destinataire dans le cadre de son partenariat avec l’Emetteur pour permettre à ce dernier la poursuite d’un intérêt légitime dans le respect de mes droits. Mes données sont nécessaires pour permettre à l’Emetteur la bonne gestion de sa relation avec le Destinataire.";
		$pdf->SetY(105);
		$pdf->Justify(iconv("UTF-8", "CP1252", $texte), 165, 5, 30);

		$texte = "Mes informations seront communiquées au Destinataire et pourront être communiquées aux autorités judiciaires ou administratives légalement habilitées pour satisfaire à des obligations légales ou réglementaires.";
		$pdf->SetY(132);
		$pdf->Justify(iconv("UTF-8", "CP1252", $texte), 175, 5, 20);

		$texte = "Mes données seront conservées pendant la durée nécessaire au calcul du commissionnement lié à la transmission de mes données au Destinataire, augmentée des durées de prescription.";
		$pdf->SetY(152);
		$pdf->Justify(iconv("UTF-8", "CP1252", $texte), 175, 5, 20);

		$texte = "Je peux à tout moment, dans les conditions prévues par la réglementation, accéder aux informations me concernant, les faire rectifier, m’opposer pour motif légitime à leur traitement, demander leur effacement, la limitation de leur traitement, leur portabilité, ou communiquer des instructions sur leur sort en cas de décès. Je peux également, lorsque le traitement a pour base légale le consentement, retirer mon consentement, sans porter atteinte à la licéité du traitement fondé sur le consentement effectué avant le retrait de celui-ci en écrivant à l’adresse figurant sur la présente Fiche contact. Les frais de timbre me seront remboursés sur simple demande de ma part. Je peux, en cas de contestation, former une réclamation auprès de la CNIL dont les coordonnées figurent à l’adresse internet http://www.cnil.fr.";
		$pdf->SetY(167);
		$pdf->Justify(iconv("UTF-8", "CP1252", $texte), 175, 5, 20);

		$texte = "L’Emetteur a désigné un Délégué à la Protection des Données, que je peux contacter à l'adresse postale suivante figurant sur la présente Fiche contact ou à l’adresse mail suivante : dpo@ca-centreloire.fr.";
		$pdf->SetY(217);
		$pdf->Justify(iconv("UTF-8", "CP1252", $texte), 175, 5, 20);

		// DERNIERE PAGE
		$pdf->AddPage();

		$pdf->SetFont('Arial', 'B', 10);
		$pdf->SetXY(20, 30);
		$pdf->Write(0,iconv("UTF-8", "CP1252", "II. Traitements mis en œuvre par le Destinataire"));

		$pdf->SetFont('Arial', '', 10);
		$texte = "Je suis informé(e), conformément à la Réglementation relative à la protection des données, que mes données à caractère personnel collectées via la présente Fiche contact feront l'objet de traitements informatisés par le Destinataire ci-avant désigné, en qualité de responsable de traitement, pour les finalités suivantes .";
		$pdf->SetY(37);
		$pdf->Justify(iconv("UTF-8", "CP1252", $texte), 175, 5, 20);

		$texte = "- Gestion de ma demande de prise de contact et prospection commerciale par voie électronique sur la base de mon consentement";
		$pdf->SetY(57);
		$pdf->Justify(iconv("UTF-8", "CP1252", $texte), 165, 5, 30);

		$texte = "- Calcul des commissions versées à l'Emetteur dans le cadre de son partenariat avec le Destinataire et prospection commerciale par voie postale, par mail ou par appels téléphoniques, études statistiques nécessaires pour permettre au Destinataire de poursuivre un intérêt légitime dans le respect de mes droits. Mes données sont nécessaires pour permettre au Destinataire d'assurer la bonne gestion de sarelation avec l'Emetteur et une meilleure promotion et fourniture de ses services auprès de ses clients et prospects.";
		$pdf->SetY(67);
		$pdf->Justify(iconv("UTF-8", "CP1252", $texte), 165, 5, 30);

		$texte = "Mes informations seront communiquées à l’Emetteur et pourront être communiquées aux autorités judiciaires ou administratives légalement habilitées pour satisfaire à des obligations légales ou réglementaires.";
		$pdf->SetY(105);
		$pdf->Justify(iconv("UTF-8", "CP1252", $texte), 175, 5, 20);

		$texte = "Mes données seront conservées pendant la durée nécessaire au traitement de ma demande de contact et du calcul du commissionnement de l’Emetteur, augmentée des durées de prescription. Par ailleurs, elles seront conservées à des fins de prospection commerciale, à défaut d’entrée en relation contractuelle, 3 mois à compter de leur collecte ou de ma dernière prise de contact auprès du Destinataire.";
		$pdf->SetY(125);
		$pdf->Justify(iconv("UTF-8", "CP1252", $texte), 175, 5, 20);

		$pdf->SetY(150);
		$pdf->Justify(iconv("UTF-8", "CP1252", $reglementationCNIL), 175, 5, 20);

		$pdf->SetY(205);
		$pdf->Justify(iconv("UTF-8", "CP1252", $delegueProtectionDesDonnees), 175, 5, 20);

		// RECAPITULATIF CLIENT
		$pdf->AddPage();
		// SIGNET DE LECTURE
		$pdf->Bookmark($signetRecapitulatif, true);

		$texte = "Cher(e) client(e),";
		$pdf->SetY(47);
		$pdf->Justify(iconv("UTF-8", "CP1252", $texte), 175, 5, 20);

		$texte = "Nous vous remercions de nous avoir autorisés à vous recommander auprès de notre Filiale Immobilière.";
		$pdf->SetY(62);
		$pdf->Justify(iconv("UTF-8", "CP1252", $texte), 175, 5, 20);

		$texte = "Nous sommes heureux de vous accompagner dans chaque moment de vie grâce à l’ensemble des métiers du Groupe Crédit Agricole.";
		$pdf->SetY(67);
		$pdf->Justify(iconv("UTF-8", "CP1252", $texte), 175, 5, 20);

		$texte = "Nous vous invitons à vérifier les informations personnalisées de la recommandation et à cliquer sur « VALIDER » pour accéder à l’étape de signature électronique sur tablette.";
		$pdf->SetY(77);
		$pdf->Justify(iconv("UTF-8", "CP1252", $texte), 175, 5, 20);

		$texte = "En cas d’inexactitude ou si vous souhaitez modifier un des éléments de cette fiche, veuillez cliquer sur « ABANDONNER ».";
		$pdf->SetY(87);
		$pdf->Justify(iconv("UTF-8", "CP1252", $texte), 175, 5, 20);

		if($typeContrat == "Fiche Contact"){
			$pdf->Output('Fiche_Contact.pdf','D');
		}else{
			$pdf->Output('Fiche_Entretien.pdf','D');
		}
	}

?>
