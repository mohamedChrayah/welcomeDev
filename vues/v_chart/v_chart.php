<?php
$statsClients = getNbClientsParMois();
$labels = [];
$valeurs = [];

foreach ($statsClients as $ligne) {
    $labels[] = $ligne['mois'];
    $valeurs[] = $ligne['total'];
}
$clients = getTousLesClients();

$totalClients = count($clients);
$lieux = array_column($clients, 'lieu');
$uniqueLieux = count(array_unique($lieux));

$ages = array_column($clients, 'age');
$moyenneAge = round(array_sum($ages) / max(count($ages), 1), 1);

$clientsRecents = array_filter($clients, function($client) {
    return date('Y-m', strtotime($client['date_creation'])) === date('Y-m');
});
$nbClientsRecents = count($clientsRecents);
?>


    <div class="row">
        <div class="row mb-4">
            <!-- Total clients -->
            <div class="col-md-3 mb-3">
                <div class="card bg-success text-white text-center p-4 shadow">
                    <h5>Total contacts</h5>
                    <h2><?= $totalClients ?></h2>
                </div>
            </div>

            <!-- Lieux uniques -->
            <div class="col-md-3 mb-3">
                <div class="card bg-primary text-white text-center p-4 shadow">
                    <h5>Lieux différents</h5>
                    <h2><?= $uniqueLieux ?></h2>
                </div>
            </div>

            <!-- Moyenne d'âge -->
            <div class="col-md-3 mb-3">
                <div class="card bg-info text-white text-center p-4 shadow">
                    <h5>Moyenne d'âge</h5>
                    <h2><?= $moyenneAge ?> ans</h2>
                </div>
            </div>

            <!-- Nouveaux clients -->
            <div class="col-md-3 mb-3">
                <div class="card bg-warning text-white text-center p-4 shadow">
                    <h5>Ajouts ce mois-ci</h5>
                    <h2><?= $nbClientsRecents ?></h2>
                </div>
            </div>
        </div>

    </div>

    <div id="chartClientsParMois" style="height: 400px; width: 100%;">

    </div>


<script>
    const chartData = {
        type: "bar",
        title: {
            text: "Ajouts de clients par mois"
        },
        scaleX: {
            labels: <?= json_encode($labels) ?>
        },
        series: [
            {
                values: <?= json_encode($valeurs) ?>
            }
        ]
    };

    zingchart.render({
        id: "chartClientsParMois",
        data: chartData,
        height: 400,
        width: "100%"
    });
</script>