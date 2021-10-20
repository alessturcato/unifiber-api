<?php

namespace App\Http\Controllers;

use App\Models\CopertureUnifiber;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Log;
use Carbon\Carbon;
// Eccezioni
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Validation\ValidationException;

class CopertureUnifiberController extends Controller
{
    // Nome del file di log
    protected $log_name= 'coverage_request_prod';

    /**
     * Ricerca delle coperture
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function ricerca(Request $request)
    {
        $id_notifica= '*'.time().'* ';
        Log::channel($this->log_name)->info($id_notifica.'RICHIESTA DI VERIFICA DI UNA COPERTURA - START -');

        if(!$request->input('id_scala') && !$request->input('comune') && !$request->input('provincia')) 
        {
            Log::channel($this->log_name)->info($id_notifica.'Dati inviati non compatibili. Campi obbligatori mancanti');
            return response()->json(['message'=> 'Dati inviati non compatibili.'], 400);
        }
        
        try {
            Log::channel($this->log_name)->info($id_notifica.'Richiesta: '.json_encode($request->all()));
            App::setLocale('it');
            if($request->input('id_scala'))
            {
                $request->validate([
                    'id_scala'=> ['required', 'string', 'max:66'],
                    // 'per_page'=> ['nullable', 'numeric', 'digits_between:1,100']
                    'per_page'=> ['nullable', 'numeric']
                ]);
                
                $query_conditions= [
                    ['id_scala', 'LIKE', '%'.$request->input('id_scala').'%']
                ];
            } else {
                $request->validate([
                    'provincia'=> ['bail', 'required', 'digits:3'],
                    'comune'=> ['bail', 'required', 'digits:6'],
                    'particella_top'=> ['bail', 'nullable', 'max:77'],
                    'indirizzo'=> ['bail', 'nullable', 'max:77'],
                    'civico'=> ['bail', 'nullable', 'max:77'],
                    // 'per_page'=> ['nullable', 'numeric', 'digits_between:1,100']
                    'per_page'=> ['nullable', 'numeric']
                ]);
                
                $query_conditions= [
                    ['provincia', '=', $request->input('provincia')],
                    ['comune', '=', $request->input('comune')],
                    [DB::raw("CONCAT(particella_top, indirizzo, civico)"),  'LIKE', '%'.$request->input('particella_top').$request->input('indirizzo').$request->input('civico').'%']
                ];
            }

            if($request->input('per_page') && $request->input('per_page')< 101)
            {
                $limit= $request->input('per_page');
            } else {
                $limit= 100;
            }

            $result= CopertureUnifiber::where($query_conditions)->paginate($limit)->toArray();
            unset($result['links']);
            Log::channel($this->log_name)->info($id_notifica.'RICHIESTA DI VERIFICA DI UNA COPERTURA - END -');
            return $result;
        } catch (ValidationException $e) {
            Log::channel($this->log_name)->info($id_notifica.'Dati inviati non compatibili. Errore: '.json_encode($e->errors()));
            Log::channel($this->log_name)->info($id_notifica.'RICHIESTA DI VERIFICA DI UNA COPERTURA - END -');
            return response()->json(['message'=> 'Dati inviati non compatibili', 'errors'=> $e->errors()], 400);
        } catch (\Exception $e) {
            Log::channel($this->log_name)->info($id_notifica.'Errore: '.json_encode($e->getMessage()));
            Log::channel($this->log_name)->info($id_notifica.'RICHIESTA DI VERIFICA DI UNA COPERTURA - END -');
            return response()->json(['message'=> 'Server Error'], 500);
        }
    }

    /**
     * Registra una nuova copertura nel database.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function registra(Request $request)
    {
        $id_notifica= '*'.time().'* ';
        Log::channel($this->log_name)->info($id_notifica.'RICHIESTA DI INSERIMENTO/AGGIORNAMENTO - START -');

        try {
            App::setLocale('it');

            Log::channel($this->log_name)->info($id_notifica.'Richiesta: '.json_encode($request->all()));

            $stato_scala_palazzina= $stato_building= $stato_ui= [
                '801'=> '(pre-RFC) Rete in Lavorazione',
                '802'=> 'RFC Bassa Densita',
                '804'=> 'RFC',
                '805'=> 'RFC Attesa Permesso Amministratore',
                '806'=> 'RFC Permesso Amministratore Negato',
                '807'=> 'RFC Rete in Validazione',
                '810'=> 'RFA'
            ];

            $request->validate([
                'id_scala'=> ['bail', 'required', 'regex:/^([a-zA-Z0-9\/_°.,])*$/', 'max:66'],
                'regione'=> ['bail', 'required', 'digits:2'],
                'provincia'=> ['bail', 'required', 'digits:3'],
                'comune'=> ['bail', 'required', 'digits:6'],
                'comune_descrizione'=> ['bail', 'required', 'regex:/^([a-zA-Z0-9\/_°., ])*$/', 'max:60'],
                'frazione'=> ['bail', 'nullable', 'regex:/^([a-zA-Z0-9\/_°.,])*$/', 'max:20'],
                'particella_top'=> ['bail', 'nullable', 'regex:/^([a-zA-Z0-9\/_°.,])*$/', 'max:18'],
                'indirizzo'=> ['bail', 'required', 'regex:/^([a-zA-Z0-9\/_°., ])*$/', 'max:49'],
                'civico'=> ['bail', 'nullable', 'regex:/^([a-zA-Z0-9\/_°.,])*$/', 'max:10'],
                'scala_palazzina'=> ['bail', 'nullable', 'regex:/^([a-zA-Z0-9\/_°.,])*$/', 'max:34'],
                'codice_via'=> ['bail', 'required', 'numeric', 'digits_between:1,10'],
                'id_building'=> ['bail', 'required', 'regex:/^([a-zA-Z0-9\/_°.,])*$/', 'max:35'],
                'coordinate_building'=> ['bail', 'nullable', 'numeric', 'digits_between:1,29'],
                'pop'=> ['bail', 'required', 'regex:/^([a-zA-Z0-9\/_°.,-])*$/', 'max:50'],
                'id_pop'=> ['bail', 'required', 'numeric', 'digits_between:1,11'],
                'totale_ui'=> ['bail', 'nullable', 'numeric', 'digits_between:1,3'],
                'stato_ui'=> ['bail', 'nullable', 'in:'.implode(',',array_keys($stato_ui))],
                'stato_building'=> ['bail', 'required', 'in:'.implode(',',array_keys($stato_building))],
                'stato_scala_palazzina'=> ['bail', 'required', 'in:'.implode(',',array_keys($stato_scala_palazzina))],
                'data_rfc_indicativa'=> ['bail', 'nullable', 'date_format:Y-m-d'],
                'data_rfc_effettiva'=> ['bail', 'nullable', 'date_format:Y-m-d'],
                'data_rfa_indicativa'=> ['bail', 'nullable', 'date_format:Y-m-d'],
                'data_rfa_effettiva'=> ['bail', 'nullable', 'date_format:Y-m-d'],
                'id_egon_civico'=> ['bail', 'required', 'numeric', 'digits_between:1,15'],
                'id_egon_strada'=> ['bail', 'required', 'numeric', 'digits_between:1,12'],
                'geo_lat'=> ['bail', 'nullable', 'numeric', 'between:0,9999999999999999.999999'],
                'geo_long'=> ['bail', 'nullable', 'numeric', 'between:0,9999999999999999.999999'],
                'gpon'=> ['bail', 'nullable', 'boolean'],
                'ftth'=> ['bail', 'nullable', 'boolean'],
                'master_slave'=> ['bail', 'nullable', 'boolean'],
                'pfs'=> ['bail', 'nullable', 'regex:/^([a-zA-Z0-9\/_°.,])*$/', 'max:20'],
                'pte'=> ['bail', 'nullable', 'regex:/^([a-zA-Z0-9\/_°.,])*$/', 'max:50'],
                'idzona'=> ['bail', 'required', 'numeric', 'digits_between:1,11'],
                'denom_zona'=> ['bail', 'required', 'regex:/^([a-zA-Z0-9\/_°., ])*$/', 'max:250']
            ]);
            
            $query_conditions= [
                ['id_scala', '=', $request->input('id_scala')]
            ];

            $result= CopertureUnifiber::where($query_conditions)->first();

            if(empty($result))
            {
                Log::channel($this->log_name)->info($id_notifica.'Richiesto inserimento nuova copertura');
                $result= CopertureUnifiber::create($request->all());
                Log::channel($this->log_name)->info($id_notifica.'Nuova copertura inserita correttamente');

                Log::channel($this->log_name)->info($id_notifica.'RICHIESTA DI INSERIMENTO - END -');
                return response()->json(['message'=> 'Copertura inserita correttamente', 'dati'=> $result], 201);
            } else {
                Log::channel($this->log_name)->info($id_notifica.'Richiesto aggiornamento copertura');
                DB::beginTransaction();
                
                $result->versione+= 1;
                $result->update($request->all());
                foreach($result->getChanges() as $campo=> $valore)
                {
                    if(strcmp($campo, 'stato_building')== 0)
                    {
                        $result->data_ultima_variazione_stato_building= Carbon::now('Europe/Rome');
                    }

                    if(strcmp($campo, 'stato_scala_palazzina')== 0)
                    {
                        $result->data_ultima_variazione_stato_scala_palazzina= Carbon::now('Europe/Rome');
                    }
                }

                $result->save();

                DB::commit();

                Log::channel($this->log_name)->info($id_notifica.'Copertura aggiornata correttamente');
                // Elimino i dati da non visualizzare
                unset($result['utente']);
                unset($result['deleted']);
                unset($result['versione']);
                unset($result['operatore']);

                Log::channel($this->log_name)->info($id_notifica.'RICHIESTA DI AGGIORNAMENTO - END -');
                return response()->json(['message'=> 'Copertura aggiornata correttamente', 'dati'=> $result], 200);
            }
        } catch (ValidationException $e) {
            Log::channel($this->log_name)->info($id_notifica.'Dati inviati non compatibili. Errore: '.json_encode($e->errors()));
            Log::channel($this->log_name)->info($id_notifica.'RICHIESTA DI INSERIMENTO/AGGIORNAMENTO - END -');
            return response()->json(['message'=> 'Dati inviati non compatibili', 'errors'=> $e->errors()], 400);    
        } catch(\Exception $e) {
            Log::channel($this->log_name)->info($id_notifica.'Errore: '.$e->getMessage());

            Log::channel($this->log_name)->info($id_notifica.'RICHIESTA DI INSERIMENTO/AGGIORNAMENTO - END -');
            return response()->json(['message'=> 'Server Error'], 500);
        }
    }

    /**
     * Controllo lo storico di una copertura.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function storico($id, Request $request)
    {
        $id_notifica= '*'.time().'* ';
        Log::channel($this->log_name)->info($id_notifica.'RICHIESTA STORICO - START -');

        try {
            $results= CopertureUnifiber::findOrFail($id)->versions->toArray();

            if(empty($results))
            {
                Log::channel($this->log_name)->info($id_notifica.'La copertura [id: '.$id.'] non presenta aggiornamenti');

                Log::channel($this->log_name)->info($id_notifica.'RICHIESTA STORICO - END -');
                return [];
            }

            Log::channel($this->log_name)->info($id_notifica.'Storico recuperato correttamente');
            foreach($results as $key=> &$result)
            {
                $result['old_data']= unserialize($result['old_data']);
                $result['new_data']= unserialize($result['new_data']);
                
                $user= User::findOrFail($result['user_id'])->toArray();
                $result['user']= $user['name'];

                ksort($result);
            }

            Log::channel($this->log_name)->info($id_notifica.'RICHIESTA STORICO - END -');
            return $results;
        } catch (ModelNotFoundException $exception) {
            Log::channel($this->log_name)->info($id_notifica.'Errore: '.$exception->getMessage());

            Log::channel($this->log_name)->info($id_notifica.'RICHIESTA STORICO - END -');
            return response()->json(['message'=> 'Non ci sono entita con id: '.$id, 'data'=> []], 400);
        } catch (\Exception $e) {
            Log::channel($this->log_name)->info($id_notifica.'Errore: '.$e->getMessage());

            Log::channel($this->log_name)->info($id_notifica.'RICHIESTA STORICO - END -');
            return response()->json(['message'=> 'Server Error'], 500);
        }
    }
}
