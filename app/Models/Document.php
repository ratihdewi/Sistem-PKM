<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Document extends Model
{
    use HasFactory;
    protected $guarded = ['id'];
    protected $with = ['skema_pkm', 'document_owners'];

    public function skema_pkm()
    {
        return $this->belongsTo('App\Models\Master\SkemaPKM', 'skema_pkm_id');
    }

    public function document_owners()
    {
        return $this->hasOne('App\Models\DocumentOwner', 'document_id');
    }

    public function document_checks()
    {
        return $this->hasOne('App\Models\DocumentCheck', 'document_id');
    }

    public function document_budgets()
    {
        return $this->hasMany('App\Models\DocumentBudget', 'document_id');
    }

    public function getPendanaanDiktiAttribute($value)
    {
        $value = (int) $value;

        return $value;
    }

    public function getPendanaanPtAttribute($value)
    {
        $value = (int) $value;

        return $value;
    }

    public function getBerkasAttribute($value)
    {
        return json_decode($value);
    }
}
