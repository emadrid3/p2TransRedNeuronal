<?php

namespace App\Http\Controllers;
use App\logistica;
use Carbon\Carbon;

use Illuminate\Support\Facades\Auth;

use Illuminate\Http\Request;

class LogisticaController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        return view('logistic.logistic', ['auth' => $user]);
    }
    public function manageLogistic()
    {
        $logistica = null;
        return view('logistic.logisticManage', ['logistica' => $logistica]);
    }

    public function editLogistic($id)
    {
        $logistica = logistica::with('encargado.user')->with('conductor')->with('vehiculo')->with('cliente')->with('carga')->with('tipo')->find($id);
        return view('logistic.logisticManage', ['logistica' => $logistica]);
    }

    public function create(Request $request)
    {
        try {

            if($request->input('id') != NULL){
                $logistica = logistica::find($request->input('id'));
            }else{
                $logistica = new logistica();
                $logistica->numero_factura = NULL;
                $logistica->numero_orden = NULL;
                $logistica->numero_factura_cliente = NULL;
                $logistica->encargado_id = NULL;
                $logistica->fecha = NULL;
                $logistica->vehiculo_id = NULL;
                $logistica->flete = 0;
                $logistica->anticipo = 0;
                $logistica->descuento = 0;
                $logistica->conductor_id = NULL;
                $logistica->origen = NULL;
                $logistica->destino = NULL;
                $logistica->trayecto = NULL;
                $logistica->carga_id = NULL;
                $logistica->tipo_id = NULL;
                $logistica->cliente_id = NULL;
                $logistica->extra = NULL;
                $logistica->extra_total = 0;
                $logistica->descripcion = NULL;
                $logistica->factura_total = 0;

                $logistica->estado = "en proceso";
            }

            $sum = 0;
            

            if($request->input('bill_number') != NULL || $request->input('bill_number') != ""){
                $logistica->numero_factura = $request->input('bill_number');
            }

            if($request->input('order_number') != NULL || $request->input('order_number') != ""){
                $logistica->numero_orden = $request->input('order_number');
            }
            
            if($request->input('customer_number') != NULL || $request->input('customer_number') != ""){
                $logistica->numero_factura_cliente = $request->input('customer_number');
            }

            if($request->input('user') != NULL){
                $logistica->encargado_id = $request->input('user')['id'];
            }

            if($request->input('date') != NULL || $request->input('date') != ""){
                $logistica->fecha = Carbon::createFromFormat('Y-m-d',$request->input('date'));
            }

            if($request->input('vehicle') != NULL){
                $logistica->vehiculo_id = $request->input('vehicle')['id'];
            }


            $logistica->flete = $request->input('freight');



            $logistica->anticipo = $request->input('advance');


            $logistica->descuento = $request->input('discount');


            if($request->input('driver') != NULL){
                $logistica->conductor_id = $request->input('driver')['id'];
            }

            if(count($request->input('travel')) > 0 && $request->input('travel')[0] != NULL){
                
                $logistica->origen = $request->input('travel')[0]['id'];

                if(count($request->input('travel')) > 1){
                    $logistica->destino = $request->input('travel')[count($request->input('travel'))-1]['id'];
                }

                $logistica->trayecto = json_encode($request->input('travel'));
            }

            if($request->input('charge') != NULL){
                $logistica->carga_id = $request->input('charge');
            }

            if($request->input('type') != NULL){
                $logistica->tipo_id = $request->input('type');
            }

            if($request->input('customer') != NULL){
                $logistica->cliente_id = $request->input('customer')['id'];
            }

            if(count($request->input('extra')) > 0){
                $logistica->extra = json_encode($request->input('extra'));

                foreach ($request->input('extra') as $value) {
                    $sum += $value['value'];
                }

                $logistica->extra_total = $sum;
            }

            if($request->input('description') != NULL || $request->input('description') != ""){
                $logistica->descripcion = $request->input('description');
            }

            if($request->input('vehicle') != NULL){
                if($request->input('vehicle')['tipo'] == "tercero"){
                    $sum += $logistica->anticipo;
                }
            }

            $logistica->factura_total = $sum + $request->input('freight');
            
            $logistica->save();

            return response()->json(['message' => 'Vehiculo creado satisfactoriamente']);
        } catch (\Exception $e) {
           throw $e;
        }
    }

    public function list(Request $request){
        try {
            $listLogistic = logistica::with('encargado.user')->with('conductor')->with('vehiculo')->with('cliente')->with('carga')->with('tipo')->with('origen_obj')->with('destino_obj')->paginate($request->input('size'));
            return response()->json($listLogistic);
        } catch (\Exception $e) {
           throw $e;
        }
    }
}
