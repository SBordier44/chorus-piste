<?php
declare(strict_types=1);

namespace PhpChorusPiste;


class ChorusPisteConstants
{
    public const FLUX_STATUS = [
        'IN_EN_ATTENTE_RETRAITEMENT_CPP' => 'En attente de retraitement',
        'IN_EN_ATTENTE_TRAITEMENT_CPP' => 'En attente de traitement',
        'IN_EN_COURS_TRAITEMENT_CPP' => 'En cours de traitement',
        'IN_INCIDENTE' => 'Incidenté',
        'IN_INTEGRE' => 'Intégré',
        'IN_INTEGRE_PARTIEL' => 'Intégré partiellement',
        'QP_IRRECEVABLE' => 'Irrecevable',
        'QP_RECEVABLE' => 'Recevable',
        'QP_RECEVABLE_AVEC_ERREUR' => 'Recevable avec erreur',
        'IN_REJETE' => 'Rejeté',
        'IN_RECU' => 'Reçu',
        'IN_TRAITE_SE_CPP' => 'Traité'
    ];
}
