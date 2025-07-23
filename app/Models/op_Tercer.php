<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class op_Tercer extends Model
{
    use HasFactory;

    protected $table = 'op_tercers';

    protected $primaryKey = 'ter_doc';
    public $incrementing = false; // perquè és varchar
    protected $keyType = 'string';

    protected $fillable = [
        'ter_doc', 'ter_nom', 'ter_dom', 'ter_pob', 'ter_cpo', 'ter_pro', 'ter_tlf', 'ter_fax', 'ter_dce'
    ];

    public $timestamps = false;
}
