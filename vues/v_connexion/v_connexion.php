<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
<div class="container d-flex justify-content-center align-items-center" style="height: 100vh;">
    <div class="card shadow-lg" style="width: 500px;">
        <div class="card-header bg-primary text-white text-center py-4">
            <h3 class="mb-0">Connexion à votre espace</h3>
        </div>
        <div class="card-body p-5">
            <form action="index.php?action=connexion" method="post">
                <div class="form-group mb-4">
                    <label for="identifiant" class="font-weight-bold">Identifiant</label>
                    <input type="text" class="form-control form-control-lg" name="identifiant" id="identifiant" placeholder="Entrez votre identifiant" required>
                </div>
                <div class="text-center">
                    <button type="submit" class="btn btn-primary btn-lg btn-block">Se connecter</button>
                </div>
            </form>
        </div>
    </div>
</div>

