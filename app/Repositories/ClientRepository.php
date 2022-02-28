<?php

namespace App\Repositories;

use Illuminate\Support\Facades\DB;

class ClientRepository
{

    public function getWithPaginate()
    {
        return DB::table('clients')
            ->join('automobiles', 'clients.id', '=', 'automobiles.client_id')
            ->select('clients.id', 'clients.name', 'automobiles.brand', 'automobiles.model', 'automobiles.number')
            ->orderBy('clients.name')
            ->paginate(10);
    }

    public function deactivateClients()
    {
        return DB::table('clients')
            ->select('clients.id', 'clients.name')
            ->get();
    }

    public function getIdByPhone($client_phone)
    {
        $client_id = DB::table('clients')
            ->select('id')
            ->where('phone', '=', $client_phone)
            ->get();

        return $client_id[0]->id;
    }

    public function storeClient($client)
    {
        return DB::table('clients')
            ->insert([
                'name' => $client['name'],
                'sex' => $client['sex'],
                'phone' => $client['phone'],
                'address' => $client['address'],
                'automobiles' => $client['carCount']]);
    }

    public function showClient($id)
    {
        return DB::table('clients')
            ->join('automobiles', 'clients.id', '=', 'automobiles.client_id')
            ->where('clients.id', '=', $id)
            ->get();
    }

    public function updateClient($client, $id)
    {
        return DB::table('clients')
            ->where('id', '=', $id)
            ->update([
                'name' => $client['name'],
                'sex' => $client['sex'],
                'address' => $client['address'],
                'phone' => $client['phone'],
                'id' => $id
            ]);
    }

    public function deleteClient($id)
    {
        $client_id = DB::table('clients')
            ->join('automobiles', 'clients.id', '=', 'automobiles.client_id')
            ->select('clients.id')
            ->where('automobiles.client_id', '=', $id)
            ->get();
        $client_id = $client_id[0]->id;
        DB::table('automobiles')
            ->where('client_id', '=', $client_id)
            ->delete();
        DB::table('clients')
            ->delete($client_id);
    }
}
