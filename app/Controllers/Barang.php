<?php

namespace App\Controllers;

use App\Models\ModelBarang;

class Barang extends BaseController

{
    protected $modelBarang;

    public function __construct()
    {
        $this->modelBarang = new ModelBarang();
    }

    public function dataBarang()
    {
        $barang = $this->modelBarang->getBarang()->findAll();

        $data = [
            'title' => 'Data Barang',
            'data'  => $barang
        ];

        return view('barang/dataBarang', $data);
    }

    public function tambahBarang()
    {
        $data = [
            'title' => 'Tambah Barang',
        ];

        return view('barang/tambahBarang', $data);
    }

    public function simpanBarang()
    {
        $rules = [
            'nama_barang_edit'        => [
                'rules'         => 'required|is_unique[barang.nama_barang_edit]',
                'errors'        => [
                    'required'  => 'Nama Barang harus diisi.',
                    'is_unique' => 'Nama Barang sudah digunakan'
                ]
            ],
            'harga_jual_edit'      => [
                'rules'         => 'required',
                'errors'        => [
                    'required'  => 'Harga jual harus diisi.',
                ]
            ],
            'harga_beli_edit'      => [
                'rules'         => 'required',
                'errors'        => [
                    'required'  => 'Harga Beli harus diisi.',
                ]
            ],
            'stok'      => [
                'rules'         => 'required',
                'errors'        => [
                    'required'  => 'Stok harus diisi.',
                ]
            ],
            'gambar' => [
                'rules' => 'max_size[gambar,3000]|is_image[gambar]|mime_in[gambar,image/jpg,image/jpeg,image/png]',
                'errors' => [
                    'max_size' => 'Ukuran gambar terlalu besar',
                    'is_image' => 'Yang dipilih bukan gambar',
                    'mime_in'  => 'Yang dipilih bukan gambar',
                ]
            ]

        ];

        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $fileImage = $this->request->getFile('gambar');

        if ($fileImage->getError() == 4) {
            $namaImage = 'default.jpeg';
        } else {
            $namaImage = $fileImage->getName();
            $fileImage->move('img', $namaImage);
        }

        $data = [
            'nama_barang_edit'    => $this->request->getVar('nama_barang_edit'),
            'harga_jual_edit'    => $this->request->getVar('harga_jual_edit'),
            'harga_beli_edit'    => $this->request->getVar('harga_beli_edit'),
            'stok'    => $this->request->getVar('stok'),
            'gambar'            => $namaImage
        ];

        $this->modelBarang->save($data);

        session()->setFlashdata('pesan', 'Barang berhasil ditambahkan');

        return redirect()->to('dataBarang');
    }

    public function editBarang($id)
    {
        $query = $this->modelBarang->getBarang()->find($id);
        $data = [
            'title' => 'Edit Barang',
            'data'  => $query
        ];

        return view('barang/editBarang', $data);
    }

    public function ubahBarang($id)
    {
        $rules = [
            'nama_barang_edit'        => [
                'rules'         => 'required',
                'errors'        => [
                    'required'  => 'Nama Barang harus diisi.',
                ]
            ],
            'harga_jual_edit'      => [
                'rules'         => 'required',
                'errors'        => [
                    'required'  => 'Harga jual harus diisi.',
                ]
            ],
            'harga_beli_edit'      => [
                'rules'         => 'required',
                'errors'        => [
                    'required'  => 'Harga Beli harus diisi.',
                ]
            ],
            'stok'      => [
                'rules'         => 'required',
                'errors'        => [
                    'required'  => 'Stok harus diisi.',
                ]
            ],
            'gambar' => [
                'rules' => 'max_size[gambar,3000]|is_image[gambar]|mime_in[gambar,image/jpg,image/jpeg,image/png]',
                'errors' => [
                    'max_size' => 'Ukuran gambar terlalu besar',
                    'is_image' => 'Yang dipilih bukan gambar',
                    'mime_in'  => 'Yang dipilih bukan gambar',
                ]
            ]

        ];

        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $fileImage = $this->request->getFile('gambar');

        if ($fileImage->getError() == 4) {
            $namaImage = 'default.jpeg';
        } else {
            $namaImage = $fileImage->getName();
            $fileImage->move('img', $namaImage);
        }

        $data = [
            'id' => $id,
            'nama_barang_edit'    => $this->request->getVar('nama_barang_edit'),
            'harga_jual_edit'    => $this->request->getVar('harga_jual_edit'),
            'harga_beli_edit'    => $this->request->getVar('harga_beli_edit'),
            'stok'    => $this->request->getVar('stok'),
            'gambar'            => $namaImage
        ];

        $dataLama = $this->modelBarang->getBarang()->where('id', $id)->first();

        if ($namaImage != 'default.jpeg' && $namaImage != $dataLama['gambar']) {
            $data['gambar'] = $namaImage;
        }

        if (
            $dataLama['id'] === $data['id'] &&
            $dataLama['nama_barang_edit'] === $data['nama_barang_edit'] &&
            $dataLama['harga_jual_edit'] === $data['harga_jual_edit'] &&
            $dataLama['harga_beli_edit'] === $data['harga_beli_edit'] &&
            $dataLama['stok'] === $data['stok'] &&
            $dataLama['gambar'] === $namaImage
        ) {
            session()->setFlashdata('same', 'Tidak produk yang diubah');
            return redirect()->route('dataBarang');
        }
        $this->modelBarang->save($data);

        session()->setFlashdata('pesan', 'Produk berhasil diubah');

        return redirect()->to('dataBarang');
    }

    public function hapusBarang($id)
    {
        $data = $this->modelBarang->find($id);

        $this->modelBarang->where('id', $id)->delete();
        session()->setFlashdata('pesan', 'Produk berhasil dihapus');
        return redirect()->to('dataBarang');
    }
}
