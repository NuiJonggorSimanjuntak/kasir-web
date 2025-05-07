<?php

namespace App\Controllers;

use App\Models\ModelUsers;
use App\Models\ModelBarang;
use App\Models\ModelTransaksi;

class Pelanggan extends BaseController

{
    protected $modelUsers, $modelBarang, $cart, $modelTransaksi;

    public function __construct()
    {
        $this->cart = \Config\Services::cart();
        $this->modelUsers = new ModelUsers();
        $this->modelBarang = new ModelBarang();
        $this->modelTransaksi = new ModelTransaksi();
    }

    public function dashboard()
    {
        $barang = $this->modelBarang->getBarang()->findAll();
        $data = [
            'barang' => $barang
        ];
        return view('pelanggan/dashboard', $data);
    }

    public function deskripsi($id)
    {
        $barang = $this->modelBarang->getBarang()->find($id);
        $data = [
            'barang' => $barang
        ];
        return view('pelanggan/deskripsi', $data);
    }

    public function keranjang($id)
    {
        $query = $this->modelBarang->getBarang()->find($id);
        $qty = $this->request->getPost('qty');
        $data = [
            'id'      => $id,
            'qty'     => $qty,
            'price'   => $query['harga_jual_edit'],
            'name'    => $query['nama_barang_edit'],
            'image'    => $query['gambar'],
        ];
        $this->cart->insert($data);

        return redirect()->back();
    }

    public function lihat_keranjang()
    {
        $barang = $this->cart->contents();
        $data = [
            'title'   => 'Keranjang',
            'barang' => $barang,
            'total'   => $this->cart->total(),
        ];

        $data['json_encode'] = json_encode($data['total']);

        return view('pelanggan/lihat_keranjang', $data);
    }

    public function hapus_keranjang($id)
    {
        $this->cart->remove($id);
        return redirect()->to('lihat_keranjang');
    }

    public function beli()
    {
        $jumlahItem = $this->cart->contents();

        for ($i = 1; $i <= count($jumlahItem); $i++) {
            $id = $this->request->getVar('rowid' . $i);
            $qty = $this->request->getVar('quantity' . $i);

            $this->cart->update([
                'rowid' => $id,
                'qty'   => (int)$qty,
            ]);
        }

        $data['items'] = [];
        $productSelected = false;
        $totalAmount = 0;
        $ket = '';

        for ($i = 1; $i <= count($jumlahItem); $i++) {
            $activeKey     = 'active' . $i;
            $idBarangKey   = 'idBarang' . $i;
            $quantityKey   = 'quantity' . $i;
            $amountKey     = 'amount' . $i;

            $activeValue = $this->request->getVar($activeKey);

            if ($activeValue === 'on') {
                $productSelected = true;

                $idBarangValue   = $this->request->getVar($idBarangKey);
                $quantityValue   = $this->request->getVar($quantityKey);
                $amountValue     = $this->request->getVar($amountKey);

                $cleanedAmount = preg_replace('/[^\d]/', '', $amountValue);
                $amountInt     = (int)$cleanedAmount / 100;

                $data['items'][] = [
                    'idBarang' => $idBarangValue,
                    'quantity' => $quantityValue,
                    'amount'   => $amountValue,
                ];

                $totalAmount += $amountInt;

                $ket .= $idBarangValue . '[' . $quantityValue . '], ';
            }
        }

        if ($productSelected) {
            $ket = rtrim($ket, ', ');

            $data['total_beli'] = $totalAmount;
            $data['ket_beli']         = $ket;
            $data['user_id']     = user()->id;
            $data['status']  = 'proses';

            foreach ($data['items'] as $item) {
                $idBarang = $item['idBarang'];
                $qty = (int)$item['quantity'];

                $barang = $this->modelBarang->find($idBarang);

                $stokBaru = intval($barang['stok']) - $qty;
                $this->modelBarang->update($idBarang, ['stok' => $stokBaru]);
            }

            $this->modelTransaksi->save($data);

            $this->cart->destroy();
            session()->setFlashdata('success', 'Silakan lakukan pembayaran');
            return redirect()->to('/');
        } else {
            session()->setFlashdata('empty', 'Product Belum Dipilih !!!');
            return redirect()->back();
        }
    }


    public function dataPelanggan()
    {
        $pelanggan = $this->modelUsers->select('users.id, email, username, auth_groups.name as role')
            ->join('auth_groups_users', 'auth_groups_users.user_id = users.id')
            ->join('auth_groups', 'auth_groups.id = auth_groups_users.group_id')
            ->where('auth_groups.id', '2')
            ->find();

        $data = [
            'title' => 'Data Pelanggan',
            'data'  => $pelanggan
        ];

        return view('pelanggan/dataPelanggan', $data);
    }
}
