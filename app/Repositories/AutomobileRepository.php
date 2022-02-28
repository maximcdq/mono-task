<?php

namespace App\Repositories;

use Illuminate\Support\Facades\DB;

class AutomobileRepository
{
    public function storeAutomobile($automobiles, $id = null)
    {
        foreach ($automobiles as $automobile) {
            DB::table('automobiles')
                ->insert([
                    'brand' => $automobile['brand'],
                    'model' => $automobile['model'],
                    'color' => $automobile['color'],
                    'number' => $automobile['number'],
                    'client_id' => $id ?: $automobile['client_id'],
                    'status' => 1
                ]);

            /*   Add count automobile   */

            if ($id) {
                DB::table('clients')
                ->where('id', '=', $id)
                ->increment('automobiles');
            } else {
                DB::table('clients')
                    ->where('id', '=', $automobile['client_id'])
                    ->increment('automobiles');
            }
        }
    }

    public function getCarsInParking()
    {
        return DB::table('automobiles')
            ->where('status', '=', 1)
            ->select('brand', 'model', 'status', 'number')
            ->get();
    }

    public function getCarClient($id)
    {
        return DB::table('automobiles')
            ->where('client_id', '=', $id)
            ->where('status', '=', 0)
            ->select()
            ->get();
    }

    public function disableCarStatus($number)
    {
        DB::table('automobiles')
            ->where('automobiles.number', '=', $number)
            ->update(['automobiles.status' => 0]);
    }

    public function enableCarStatus($number)
    {
        DB::table('automobiles')
            ->where('automobiles.number', '=', $number)
            ->update(['automobiles.status' => 1]);
    }

    public function updateAutomobile($automobiles)
    {
        foreach ($automobiles as $automobile) {
            $auto_id = $automobile['id'];
            DB::table('automobiles')
                ->where('automobiles.id', '=', $auto_id)
                ->update([
                    'brand' => $automobile['brand'],
                    'model' => $automobile['model'],
                    'color' => $automobile['color'],
                    'number' => $automobile['number'],
                    'id' => $auto_id,
                ]);
        }
    }

    public function deleteAuto($id)
    {

        $client_id = DB::table('automobiles')
            ->where('id', '=', $id)
            ->select('client_id')
            ->get();
        $client_id = $client_id[0]->client_id;

        /*  Delete count automobile  */

        DB::table('clients')
            ->where('id', '=', $client_id)
            ->decrement('automobiles');

        /*   Delete car   */

        DB::table('automobiles')
            ->delete($id);
    }

}
