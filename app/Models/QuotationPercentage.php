<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class QuotationPercentage extends Model
{
    protected $table = 'quotation_percentages';
    protected $fillable = [
        'percent_id',
        'name',
        'cost_of_offer',
        'cost_of_invest',
        'labor_cost_offer',
        'labor_cost_invest',
        'profile_id',
        'project_auctions_id',
        'created_at',
        'updated_at',
    ];
}
