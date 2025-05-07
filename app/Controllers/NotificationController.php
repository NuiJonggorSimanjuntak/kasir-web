<?php

namespace App\Controllers;

use App\Models\ModelTransaksi;
use App\Models\ModelUsers;

class NotificationController extends BaseController
{
    public function getNotifications()
    {
        $model = new ModelTransaksi();
        // $data = $model->where('is_read', 0)->orderBy('id', 'DESC')->findAll();
        $data = $model->select('transaksi.id, username, total_beli, is_read, user_id')
            ->join('users', 'users.id = transaksi.user_id')
            ->where('transaksi.is_read', 0)
            ->orderBy('transaksi.id', 'DESC')
            ->findAll();

        return $this->response->setJSON($data);
    }

    public function markAsRead($id)
    {
        $model = new ModelTransaksi();
        $model->update($id, ['is_read' => 1]);
        return $this->response->setJSON(['status' => 'success']);
    }

    public function getDetail($id)
    {
        $model = new ModelTransaksi();
        $data = $model->select('transaksi.id, transaksi.user_id, transaksi.ket_beli, transaksi.total_beli, transaksi.is_read, users.username')
            ->join('users', 'users.id = transaksi.user_id')
            ->where('transaksi.id', $id)
            ->first(); // gunakan first() karena hanya ambil 1 data

        if ($data) {
            $ketBeli = $data['ket_beli']; // contoh: "2[1], 4[2], 8[1]"
            $barangList = explode(', ', $ketBeli);

            $barangData = [];

            $modelBarang = new \App\Models\ModelBarang(); // pastikan ModelBarang sudah tersedia

            foreach ($barangList as $barang) {
                preg_match('/(\d+)\[(\d+)\]/', $barang, $matches);

                if (count($matches) === 3) {
                    $barangId = $matches[1];
                    $kuantitas = $matches[2];

                    $barangInfo = $modelBarang->find($barangId);

                    if ($barangInfo) {
                        $barangData[] = [
                            'barang_id' => $barangId,
                            'nama_barang_edit' => $barangInfo['nama_barang_edit'],
                            'harga_jual_edit' => $barangInfo['harga_jual_edit'],
                            'kuantitas' => $kuantitas
                        ];
                    }
                }
            }

            // Gabungkan ke response
            $response = [
                'transaksi_id' => $data['id'],
                'username' => $data['username'],
                'total_beli' => $data['total_beli'],
                'is_read' => $data['is_read'],
                'barang' => $barangData
            ];

            return $this->response->setJSON($response);
        } else {
            return $this->response->setStatusCode(404)->setJSON(['message' => 'Data not found']);
        }
    }
}
