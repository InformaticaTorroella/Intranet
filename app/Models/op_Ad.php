<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class op_Ad extends Model
{
    protected $table = 'op_ad';
    protected $primaryKey = 'id'; 
    public $timestamps = false;
    protected $fillable = [
        'data', 'responsable_id', 'partida', 'import_reserva',
        'exp_sedipualba', 'concepte_despesa', 'cif', 'rc'
    ];

    public function responsable() {
        return $this->belongsTo(op_Usuari::class, 'responsable_id');
    }

    public function partidaRel() {
        return $this->belongsTo(op_Partida::class, 'partida', 'partida');
    }

    public function tercer() {
        return $this->belongsTo(op_Tercer::class, 'cif', 'TER_ITE');
    }


}
