<?php
/**
 * Function permettant de faire une Timeline type metro
 * $table =>  Tableau des données
 * $under => data qui sera en dessous des points
 * $above => data qui sera sur le dessus en diagonale
 * $active => clé de la table qui sera active
 * $data_active => valeur pour déclenché l'activation
 * $under_is_date => bool true si on doit mettre une date sur la valeur du dessous
 */
function addTimeline($table, $under, $above, $active, $data_active , $under_is_date = false) { ?>
    <div class="flex-parent my-5 py-5">
        <div class="input-flex-container">
            <?php for ($i=0; $i < count($table); $i++) { ?>
                <?php if ($under_is_date) {
                    if ($table[$i][$under] != '') {
                        $table[$i][$under] = dateToFrenchMonthShort($table[$i][$under], 'd M Y');
                    }
                } ?>
                <div class="tailleFont-<?= $i ?>
                            input<?php if( $i == count($table)-1){ echo '-last'; } ?>
                            <?php if( $i == count($table)-2){ echo 'has-after'; } ?>
                            <?php if($table[$i][$under] == ''){ echo 'empty'; } ?>
                            <?php if( $table[$i][$active] == $data_active){ echo 'active'; } ?>
                        ">
                    <span data-under="<?= $table[$i][$under] ?>" data-above="<?= $table[$i][$above] ?>"></span>
                </div>
            <?php } ?>
        </div>
    </div>
<?php } ?>
