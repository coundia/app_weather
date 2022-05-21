<?php

namespace App\Extension;

use Twig\Extension\AbstractExtension;
use Twig\TwigFilter;
class TwigExtensionDate extends AbstractExtension
{
    public function getFilters()
    {
        return [
            new TwigFilter('format_date_fr', [$this, 'dateFr']),
        ];
    }

    /**
     * Get date in French
     * @param \Datetime $datetime
     * @param bool $full_date
     * @return string
     */
    public function dateFr(\Datetime $datetime,bool $full_date=false ): string
    {
        $day = array("Dimanche","Lundi","Mardi","Mercredi","Jeudi","Vendredi","Samedi");
        $month = array("Janvier", "Février", "Mars", "Avril", "Mai", "Juin", "Juillet", "Août", "Septembre", "Octobre", "Novembre", "Décembre");
        $dateGived=$datetime->format("w|d|n|Y");
        $date = explode('|', $dateGived);
        if($full_date){
            $date_fr=$day[$date[0]] . ' ' . $date[1] . ' ' . $month[$date[2]-1] . ' ' . $date[3];
        }else{
            $date_fr=$month[$date[2]-1] . ' ' . $date[3];
        }
        return $date_fr;
    }
}