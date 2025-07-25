<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class op_Tercer extends Model
{
    use HasFactory;

    protected $table = 'op_tercers_aytos';

    protected $primaryKey = 'ter_ite';
    public $incrementing = true; 
    protected $keyType = 'string';

    protected $fillable = [
        'ter_ite', 'ter_tdc', 'ter_doc', 'ter_ali', 'ter_nom', 'ter_dom', 'ter_pob', 'ter_cpo',
        'ter_pro', 'ter_tlf', 'ter_fax', 'ter_tip', 'ter_rel', 'ter_sec', 'ter_act', 'ter_fpg',
        'ter_acf', 'ter_com', 'ter_gas', 'ter_fal', 'ter_obs', 'ter_emb', 'ter_dce', 'ter_mte',
        'ter_usu', 'ter_obd', 'ter_dif', 'ter_sit', 'ter_est', 'ter_tpi', 'ter_arg', 'ter_347',
        'ter_190', 'ter_emp', 'ter_irpf', 'ter_rex', 'ter_ccl', 'ter_km', 'ter_num', 'ter_nca',
        'ter_req', 'ter_loc', 'ter_pai', 'ter_nombre', 'ter_apellido1', 'ter_apellido2',
        'ter_01c', 'ter_doc_2008', 'ter_tsw', 'ter_gru', 'ter_tao_terdir', 'ter_eprop', 'ter_pex',
    ];

    public $timestamps = false;
}
