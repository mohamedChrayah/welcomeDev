<?php $role = $_SESSION['utilisateur']['role']; ?>


<div class="col-12 px-4">

  <!-- CONTENU DE LA VUE EN FONCTIONS DE LA DEMANDE DE L'UTILISATEUR -->
    <div class="card">
        <div class="card-header bg-default row justify-content-center align-items-center">
            <div class="row col-12">
                <h2 class="col-12 text-center text-white text-uppercase mb-0">
                    Listes des contacts
                </h2>
                <div class="col-12 mt-2 d-flex justify-content-between align-items-center">
                    <div>
                        <?php if ($role === 'admin') { ?>
                            <a href="index.php?action=tableauBord" class="btn btn-primary btn-sm">
                                <i class="ni ni-chart-bar-32"></i> Tableau de bord
                            </a>
                        <?php } ?>
                    </div>
                    <div>
                        <?php if ($role === 'admin') { ?>
                            <button class="btn btn-success btn-sm" data-toggle="modal" data-target="#creationContact">
                                <i class="ni ni-fat-add"></i> Ajouter un contact
                            </button>
                        <?php } ?>
                        <a href="index.php?action=deconnexion" class="btn btn-danger btn-sm ml-2">Déconnexion</a>
                    </div>
                </div>
            </div>
        </div>

        <div class="card-body row justify-content-around align-items-center">
            <div class="col-12">
                <div class="table-responsive">
                    <table id="tableauContacts" class="table table-striped table-hover align-items-center text-center" cellspacing="0" width="100%">
                        <thead class="thead-dark">
                            <tr>
                                <th class="text-white" style="font-size: 90%">ID</th>
                                <th class="text-white" style="font-size: 90%">Nom</th>
                                <th class="text-white" style="font-size: 90%">Prénom</th>
                                <th class="text-white" style="font-size: 90%">Age</th>
                                <th class="text-white" style="font-size: 90%">Lieu</th>
                                <th class="text-white" style="font-size: 90%">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                        <?php if (!empty($lesClients)) {
                            foreach ($lesClients as $client) { ?>
                                <tr>
                                    <td><?= $client['id'] ?></td>
                                    <td><?= $client['nom'] ?></td>
                                    <td><?= $client['prenom'] ?></td>
                                    <td><?= $client['age'] ?></td>
                                    <td><?= $client['lieu'] ?></td>

                                    <?php if ($role === 'admin') { ?>
                                        <td>
                                            <button type="button" class="btn btn-sm btn-info" data-toggle="modal" data-target="#modalClient<?= $client['id'] ?>">
                                                Consulter
                                            </button>
                                            <button type="button" class="btn btn-sm btn-warning" data-toggle="modal" data-target="#modificationContact<?= $client['id'] ?>">
                                                Modifier
                                            </button>
                                            <a href="index.php?action=supprimerContact&id=<?= $client['id'] ?>" class="btn btn-sm btn-danger" onclick="return confirm('Supprimer ce contact ?');">Supprimer</a>
                                        </td>
                                    <?php } else { ?>
                                        <td>
                                            <button type="button" class="btn btn-sm btn-info" data-toggle="modal" data-target="#modalClient<?= $client['id'] ?>">
                                                Consulter
                                            </button>
                                        </td>
                                    <?php } ?>

                                </tr>
                                <div class="modal fade" id="modalClient<?= $client['id'] ?>" tabindex="-1" role="dialog" aria-labelledby="modalLabel<?= $client['id'] ?>" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header bg-info text-white">
                                                <h5 class="modal-title" id="modalLabel<?= $client['id'] ?>">Détails du contact</h5>
                                                <button type="button" class="close text-white" data-dismiss="modal" aria-label="Fermer">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                <p><strong>Nom :</strong> <?= htmlspecialchars($client['nom']) ?></p>
                                                <p><strong>Prénom :</strong> <?= htmlspecialchars($client['prenom']) ?></p>
                                                <p><strong>Âge :</strong> <?= htmlspecialchars($client['age']) ?></p>
                                                <p><strong>Lieu :</strong> <?= htmlspecialchars($client['lieu']) ?></p>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Fermer</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div id="modificationContact<?= $client['id'] ?>" class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" aria-hidden="true">
                                    <div class="modal-dialog" style="max-width: 1250px;">
                                        <form class="col-sm-12" method="post" action="index.php?action=modifierContact&id=<?= $client['id'] ?>">
                                            <div class="modal-content">
                                                <div class="card-header bg-default">
                                                    <div class="row">
                                                        <h2 class="col-11" style="color:white;text-align:center;padding-left: 10%;">Modifier un contact</h2>
                                                        <div class="col-1">
                                                            <button type="button" class="close" data-dismiss="modal" aria-label="Fermer">
                                                                <span aria-hidden="true" style="color:white;">&times;</span>
                                                            </button>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="modal-body">
                                                    <div class="row p-4">
                                                        <div class="form-group col-md-6">
                                                            <label for="nom">Nom</label>
                                                            <input value="<?= $client['nom'] ?>" type="text" class="form-control" name="nom" required>
                                                        </div>
                                                        <div class="form-group col-md-6">
                                                            <label for="prenom">Prénom</label>
                                                            <input value="<?= $client['prenom'] ?>" type="text" class="form-control" name="prenom" required>
                                                        </div>
                                                        <div class="form-group col-md-6">
                                                            <label for="age">Âge</label>
                                                            <input value="<?= $client['age'] ?>" type="number" class="form-control" name="age" required>
                                                        </div>
                                                        <div class="form-group col-md-6">
                                                            <label for="lieu">Lieu</label>
                                                            <input value="<?= $client['lieu'] ?>" type="text" class="form-control" name="lieu" required>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="modal-footer justify-content-center">
                                                    <button type="submit" class="btn bg-gradient-success py-2 px-4 text-white">
                                                        Valider la modification <i class="ni ni-send ml-2"></i>
                                                    </button>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            <?php }
                        } ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<div id="creationContact" class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog" style="max-width: 1250px;">
        <form class="col-sm-12" method="post" action="index.php?action=ajouterContact">
            <div class="modal-content">
                <div class="card-header bg-default">
                    <div class="row">
                        <h2 class="col-11" style="color:white;text-align:center;padding-left: 10%;">Ajouter un contact</h2>
                        <div class="col-1">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Fermer">
                                <span aria-hidden="true" style="color:white;">&times;</span>
                            </button>
                        </div>
                    </div>
                </div>

                <div class="modal-body">
                    <div class="row p-4">
                        <div class="form-group col-md-6">
                            <label for="nom">Nom</label>
                            <input type="text" class="form-control" name="nom" id="nom" required>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="prenom">Prénom</label>
                            <input type="text" class="form-control" name="prenom" id="prenom" required>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="age">Âge</label>
                            <input type="number" class="form-control" name="age" id="age" required>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="lieu">Lieu</label>
                            <input type="text" class="form-control" name="lieu" id="lieu" required>
                        </div>
                    </div>
                </div>

                <div class="modal-footer justify-content-center">
                    <button id="btnValidation" type="submit" name="action" value="ajouterContact" class="btn bg-gradient-success py-2 px-4 text-white">
                        Valider la création <i class="ni ni-send ml-2"></i>
                    </button>
                </div>
            </div>
        </form>
    </div>
</div>


<script type="text/javascript">
    $(document).ready(function() {
        $('#tableauContacts').DataTable({
            "language": {
                "url": "//cdn.datatables.net/plug-ins/1.10.22/i18n/French.json"
            },
            "columnDefs": [
                {
                    "className": "dt-center",
                    "targets": "_all"
                }
            ],
        });
    });
</script>