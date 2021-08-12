<?php

namespace App\Http\Controllers;
use App\logistica;
use Carbon\Carbon;

use Illuminate\Http\Request;

class LogisticaController extends Controller
{
    public function index()
    {
        return view('logistic.logistic');
    }
    public function manageLogistic()
    {
        return view('logistic.logisticManage');
    }

    public function create(Request $request)
    {
        try {
            $logistica = new logistica();
            $logistica->numero_factura = NULL;
            $logistica->numero_orden = NULL;
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
            $logistica->cliente_id = NULL;
            $logistica->extra = NULL;
            $logistica->extra_total = 0;
            $logistica->descripcion = NULL;
            $logistica->factura_total = 0;
            $sum = 0;

            if($request->input('bill_number') != NULL || $request->input('bill_number') != ""){
                $logistica->numero_factura = $request->input('bill_number');
            }

            if($request->input('order_number') != NULL || $request->input('order_number') != ""){
                $logistica->numero_orden = $request->input('order_number');
            }

            if($request->input('user') != NULL){
                $logistica->encargado_id = $request->input('user')['id'];
            }

            if($request->input('date') != NULL || $request->input('date') != ""){
                $logistica->fecha = Carbon::createFromFormat('d-m-Y',$request->input('date'));
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

            if($request->input('type') != NULL){
                $logistica->carga_id = $request->input('type');
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

            $logistica->factura_total = $sum;
            
            $logistica->save();

            return response()->json(['message' => 'Vehiculo creado satisfactoriamente']);
        } catch (\Exception $e) {
           throw $e;
        }
    }
}
