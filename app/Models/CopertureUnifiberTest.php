<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Mpociot\Versionable\VersionableTestTrait;
// use Mpociot\Versionable\VersionableTrait;
use Carbon\Carbon;

class CopertureUnifiberTest extends Model
{
    use HasFactory;
    use VersionableTestTrait;
    // use VersionableTrait;

    const UPDATED_AT= 'data_ultima_modifica_record';
    const CREATED_AT= 'data_ultima_modifica_record';

    protected $table = 'test_unifiber_maps';

    protected $dontVersionFields = ['versione', 'data_ultima_variazione_stato_building', 'data_ultima_variazione_stato_scala_palazzina'];

    protected $fillable= [
        'id_scala',
        'regione',
        'provincia',
        'comune',
        'comune_descrizione',
        'frazione',
        'particella_top',
        'indirizzo',
        'civico',
        'scala_palazzina',
        'codice_via',
        'id_building',
        'coordinate_building',
        'pop',
        'id_pop',
        'totale_ui',
        'stato_ui',
        'stato_building',
        'stato_scala_palazzina',
        'data_rfc_indicativa',
        'data_rfc_effettiva',
        'data_rfa_indicativa',
        'data_rfa_effettiva',
        'id_egon_civico',
        'id_egon_strada',
        'geo_lat',
        'geo_long',
        'gpon',
        'ftth',
        'master_slave',
        'pfs',
        'pte',
        'idzona',
        'denom_zona'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array
     */
    protected $hidden = [
        // 'utente''versione'
    ];

    public function getDataUltimaVariazioneStatoBuildingAttribute($value)
    {
        return Carbon::parse($value, 'Europe/Rome');
    }

    public function getDataUltimaVariazioneStatoScalaPalazzinaAttribute($value)
    {
        return Carbon::parse($value, 'Europe/Rome');
    }
}
