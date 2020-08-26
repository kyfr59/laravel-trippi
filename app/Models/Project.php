<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    const SEUL        = 'seul';
    const EN_COUPLE   = 'couple';
    const EN_FAMILLE  = 'famille';
    const ENTRE_AMIS  = 'amis';

    const BUDGET_SERRE        = 'serre';
    const BUDGET_MOYEN        = 'moyen';
    const BUDGET_A_LAISE      = 'alaise';
    const BUDGET_TRES_A_LAISE = 'tres_alaise';


    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'categories' => 'array',
    ];
}
