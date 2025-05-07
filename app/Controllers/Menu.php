<?php

namespace App\Controllers;

use App\Models\ModelMenu;

class Menu extends BaseController
{
    protected $modelMenu;

    public function __construct()
    {
        $this->modelMenu = new ModelMenu();
    }
    public function dataMenu()
    {
        $menu = $this->modelMenu->getMenu()->findAll();

        $data = [
            'title' => 'Data Menu',
            'menu' => $menu
        ];
        return view('menu/dataMenu', $data);
    }

    public function tambahMenu()
    {
        $data = [
            'title' => 'Tambah Menu'
        ];

        return view('menu/tambahMenu', $data);
    }

    public function simpanMenu()
    {
        $rules = [
            'name'        => [
                'rules'         => 'required|is_unique[auth_permissions.name]',
                'errors'        => [
                    'required'  => 'url harus diisi.',
                    'is_unique' => 'url sudah ada'
                ]
            ],
            'description'      => [
                'rules'         => 'required|is_unique[auth_permissions.description]',
                'errors'        => [
                    'required'  => 'Nama Menu harus diisi.',
                    'is_unique' => 'Nama Menu sudah ada'
                ]
            ],
            'icon'      => [
                'rules'         => 'required',
                'errors'        => [
                    'required'  => 'Icon harus diisi.',
                ]
            ]

        ];

        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $data = [
            'name' => $this->request->getVar('name'),
            'description' => $this->request->getVar('description'),
            'icon' => $this->request->getVar('icon'),
            'status' => $this->request->getVar('active') ?? '0'
        ];

        $this->modelMenu->save($data);

        session()->setFlashdata('pesan', 'Data Menu berhasil ditambah');

        return redirect()->to('dataMenu');
    }

    public function editMenu($id)
    {
        $menu = $this->modelMenu->select('id, description, name, icon, status')->find($id);

        $data = [
            'title' => 'Edit Menu',
            'menu'  => $menu
        ];

        return view('menu/editMenu', $data);
    }

    public function ubahMenu($id)
    {
        $rules = [
            'name' => [
                'rules' => "required|is_unique[auth_permissions.name,id,{$id}]",
                'errors' => [
                    'required' => 'url harus diisi.',
                    'is_unique' => 'url sudah ada.'
                ]
            ],
            'description' => [
                'rules' => "required|is_unique[auth_permissions.description,id,{$id}]",
                'errors' => [
                    'required' => 'Nama Menu harus diisi.',
                    'is_unique' => 'Nama Menu sudah ada.'
                ]
            ],
            'icon'      => [
                'rules'         => 'required',
                'errors'        => [
                    'required'  => 'Icon harus diisi.',
                ]
            ]

        ];

        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $status = $this->request->getVar('active') ?? '0';

        $data = [
            'id' => $id,
            'name' => $this->request->getVar('name'),
            'description' => $this->request->getVar('description'),
            'icon' => $this->request->getVar('icon'),
            'status' => $status
        ];
        
        $dataLama = $this->modelMenu->select('id, description, name, icon, status')->find($id);

        if (
            $dataLama['id'] === $data['id'] &&
            $dataLama['name'] === $data['name'] &&
            $dataLama['description'] === $data['description'] &&
            $dataLama['icon'] === $data['icon'] &&
            $dataLama['status'] === $data['status']
        ) {
            session()->setFlashdata('same', 'Tidak ada data yang diubah');
            return redirect()->route('dataMenu');
        }

        $this->modelMenu->save($data);

        session()->setFlashdata('pesan', 'Data Menu berhasil diubah');

        return redirect()->to('dataMenu');
    }

    public function hapusMenu($id)
    {
        $this->modelMenu->where('id', $id)->delete();
        session()->setFlashdata('pesan', 'Data Menu berhasil dihapus');
        return redirect()->to('dataMenu');
    }

    public function active($id)
    {
        if ($this->request->isAJAX()) {
            $modelMenu = new \App\Models\ModelMenu();
            $menu = $modelMenu->find($id);

            if ($menu) {
                $newStatus = $this->request->getPost('active'); // '1' atau '0'

                $modelMenu->update($id, ['status' => $newStatus]);

                return $this->response->setJSON([
                    'success' => true,
                    'message' => 'Status berhasil diubah'
                ]);
            }

            return $this->response->setJSON([
                'success' => false,
                'message' => 'Data tidak ditemukan'
            ]);
        }

        return redirect()->back();
    }
}
