<?php

namespace App\Controllers;

use App\Models\ModelUsers;
use App\Models\ModelUser;
use App\Models\ModelTransaksi;
use App\Models\ModelBarang;
use App\Models\ModelGroups;
use App\Models\ModelAuthGroupsUsers;
use Myth\Auth\Entities\User;

class Karyawan extends BaseController

{
    protected $modelUsers, $modelUser, $modelTransaksi, $modelBarang, $modelGroups, $modelAuthGroupsUsers, $config;

    public function __construct()
    {
        $this->modelUsers = new ModelUsers();
        $this->modelTransaksi = new ModelTransaksi();
        $this->modelBarang = new ModelBarang();
        $this->modelGroups = new ModelGroups();
        $this->modelAuthGroupsUsers = new ModelAuthGroupsUsers();
        $this->modelUser = new ModelUser();

        $this->config = config('Auth');
    }

    public function dataKaryawan()
    {
        $karyawan = $this->modelUsers->select('users.id, email, username, auth_groups.description as role, nama_lengkap, jenis_Kelamin, no_hp, tanggal_lahir, alamat, pendidikan_terakhir')
            ->join('auth_groups_users', 'auth_groups_users.user_id = users.id')
            ->join('auth_groups', 'auth_groups.id = auth_groups_users.group_id')
            ->where('auth_groups.id', '4')
            ->find();

        $data = [
            'title' => 'Data Karyawan',
            'data'  => $karyawan
        ];

        return view('karyawan/dataKaryawan', $data);
    }

    public function tambahKaryawan()
    {
        $role = $this->modelGroups->getGroups()->findAll();
        $data = [
            'title' => 'Tambah Karyawan',
            'roles' => $role
        ];

        return view('karyawan/tambahKaryawan', $data);
    }

    public function simpanKaryawan()
    {
        $rules = [
            'email'        => [
                'rules'         => 'required|is_unique[users.email]',
                'errors'        => [
                    'required'  => 'Email harus diisi.',
                    'is_unique' => 'Email Karyawan sudah terdaftar'
                ]
            ],
            'username'      => [
                'rules'         => 'required|is_unique[users.username]',
                'errors'        => [
                    'required'  => 'Username harus diisi.',
                    'is_unique' => 'Username Karyawan sudah terdaftar'
                ]
            ],
            'password'      => [
                'rules'         => 'required',
                'errors'        => [
                    'required'  => 'Password harus diisi.',
                ]
            ],
            'nama_lengkap'      => [
                'rules'         => 'required',
                'errors'        => [
                    'required'  => 'Nama Lengkap harus diisi.',
                ]
            ],
            'no_hp'      => [
                'rules'         => 'required',
                'errors'        => [
                    'required'  => 'Nomor Handphone harus diisi.',
                ]
            ],
            'tanggal_lahir'      => [
                'rules'         => 'required',
                'errors'        => [
                    'required'  => 'Tanggal Lahir harus diisi.',
                ]
            ],
            'alamat'      => [
                'rules'         => 'required',
                'errors'        => [
                    'required'  => 'Alamat harus diisi.',
                ]
            ],
            'pendidikan_terakhir'      => [
                'rules'         => 'required',
                'errors'        => [
                    'required'  => 'Pendidikan Terakhir harus diisi.',
                ]
            ],
            'jenis_Kelamin'      => [
                'rules'         => 'required',
                'errors'        => [
                    'required'  => 'Jenis Kelamin harus diisi.',
                ]
            ],

        ];

        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $no_hp = $this->request->getVar('no_hp');

        if (substr($no_hp, 0, 3) !== '+62') {
            $no_hp = '+62' . $no_hp;
        }

        $users = model(ModelUser::class);

        $allowedPostFields = array_merge(['password', 'no_hp'], $this->config->validFields, $this->config->personalFields);
        $user              = new User($this->request->getPost($allowedPostFields));
        $user->no_hp = $no_hp;

        $this->config->requireActivation === null ? $user->activate() : $user->generateActivateHash();

        $role = 'karyawan';

        if (!empty($role)) {
            $users = $users->withGroup($role);
        }

        if (!$users->save($user)) {
            return redirect()->back()->withInput()->with('errors', $users->errors());
        }

        session()->setFlashdata('pesan', 'Data karyawan berhasil ditambah');

        return redirect()->to('dataKaryawan');
    }

    public function editKaryawan($id)
    {
        $karyawan = $this->modelUsers->select('users.id, email, username, auth_groups.description as role, nama_lengkap, jenis_Kelamin, no_hp, tanggal_lahir, alamat, pendidikan_terakhir')
            ->join('auth_groups_users', 'auth_groups_users.user_id = users.id')
            ->join('auth_groups', 'auth_groups.id = auth_groups_users.group_id')
            ->where('auth_groups.id', '4')
            ->find($id);

        $data = [
            'title' => 'Edit Karyawan',
            'data'  => $karyawan
        ];

        return view('karyawan/editKaryawan', $data);
    }

    public function ubahKaryawan($id)
    {
        $rules = [
            'email'        => [
                'rules'         => 'required',
                'errors'        => [
                    'required'  => 'Email harus diisi.',
                ]
            ],
            'username'      => [
                'rules'         => 'required',
                'errors'        => [
                    'required'  => 'Username harus diisi.',
                ]
            ],
            'nama_lengkap'      => [
                'rules'         => 'required',
                'errors'        => [
                    'required'  => 'Nama Lengkap harus diisi.',
                ]
            ],
            'no_hp'      => [
                'rules'         => 'required',
                'errors'        => [
                    'required'  => 'Nomor Handphone harus diisi.',
                ]
            ],
            'tanggal_lahir'      => [
                'rules'         => 'required',
                'errors'        => [
                    'required'  => 'Tanggal Lahir harus diisi.',
                ]
            ],
            'alamat'      => [
                'rules'         => 'required',
                'errors'        => [
                    'required'  => 'Alamat harus diisi.',
                ]
            ],
            'pendidikan_terakhir'      => [
                'rules'         => 'required',
                'errors'        => [
                    'required'  => 'Pendidikan Terakhir harus diisi.',
                ]
            ],
            'jenis_Kelamin'      => [
                'rules'         => 'required',
                'errors'        => [
                    'required'  => 'Jenis Kelamin harus diisi.',
                ]
            ],

        ];

        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $no_hp = $this->request->getVar('no_hp');
        if (substr($no_hp, 0, 3) !== '+62') {
            $no_hp = '+62' . $no_hp;
        }

        $data = [
            'id' => $id,
            'email'    => $this->request->getVar('email'),
            'username'    => $this->request->getVar('username'),
            'nama_lengkap'    => $this->request->getVar('nama_lengkap'),
            'jenis_Kelamin'    => $this->request->getVar('jenis_Kelamin'),
            'no_hp'    => $no_hp,
            'tanggal_lahir'    => $this->request->getVar('tanggal_lahir'),
            'alamat'    => $this->request->getVar('alamat'),
            'pendidikan_terakhir'    => $this->request->getVar('pendidikan_terakhir'),
        ];

        $dataLama = $this->modelUsers->select('users.id, email, username, auth_groups.description as role, nama_lengkap, jenis_Kelamin, no_hp, tanggal_lahir, alamat, pendidikan_terakhir')
            ->join('auth_groups_users', 'auth_groups_users.user_id = users.id')
            ->join('auth_groups', 'auth_groups.id = auth_groups_users.group_id')
            ->where('auth_groups.id', '4')
            ->find($id);

        if (
            $dataLama['id'] === $data['id'] &&
            $dataLama['email'] === $data['email'] &&
            $dataLama['username'] === $data['username'] &&
            $dataLama['nama_lengkap'] === $data['nama_lengkap'] &&
            $dataLama['jenis_Kelamin'] === $data['jenis_Kelamin'] &&
            $dataLama['no_hp'] === $data['no_hp'] &&
            $dataLama['tanggal_lahir'] === $data['tanggal_lahir'] &&
            $dataLama['alamat'] === $data['alamat'] &&
            $dataLama['pendidikan_terakhir'] === $data['pendidikan_terakhir']
        ) {
            session()->setFlashdata('same', 'Tidak ada data yang diubah');
            return redirect()->route('dataKaryawan');
        }

        $this->modelUsers->save($data);

        session()->setFlashdata('pesan', 'Data karyawan berhasil diubah');

        return redirect()->to('dataKaryawan');
    }

    public function hapusKaryawan($id)
    {
        $data = $this->modelUsers->find($id);
        $this->modelUsers->where('id', $id)->delete();
        session()->setFlashdata('pesan', 'Data karyawan berhasil dihapus');
        return redirect()->to('dataKaryawan');
    }

    public function dataTransaksi()
    {
        $transaksi = $this->modelTransaksi->select('transaksi.id, transaksi.user_id, transaksi.ket_beli, username, transaksi.status')
            ->join('users', 'users.id = transaksi.user_id')
            ->findAll();

        $dataTransaksi = [];

        foreach ($transaksi as $item) {
            $ketBeli = $item['ket_beli'];
            $barangList = explode(', ', $ketBeli);

            $barangData = [];

            foreach ($barangList as $barang) {
                preg_match('/(\d+)\[(\d+)\]/', $barang, $matches);

                if (count($matches) === 3) {
                    $barangId = $matches[1];
                    $kuantitas = $matches[2];

                    $barangInfo = $this->modelBarang->find($barangId);

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

            $dataTransaksi[] = [
                'transaksi_id' => $item['id'],
                'username' => $item['username'],
                'status'   => $item['status'],
                'barang' => $barangData
            ];
        }

        return view('karyawan/dataTransaksi', [
            'title' => 'Data Transaksi',
            'dataTransaksi' => $dataTransaksi
        ]);
    }

    public function updateStatus($id)
    {
        if ($this->request->isAJAX()) {
            $status = $this->request->getPost('status');

            $model = new ModelTransaksi();
            $transaksi = $model->find($id);

            if ($transaksi) {
                $model->update($id, ['status' => $status]);

                // ✅ Tambahkan csrf_hash() ke response
                return $this->response->setJSON([
                    'status' => 'success',
                    'csrfToken' => csrf_hash()
                ]);
            } else {
                return $this->response->setJSON([
                    'status' => 'error',
                    'message' => 'Transaksi tidak ditemukan',
                    'csrfToken' => csrf_hash() // tetap kirim token baru meskipun error
                ]);
            }
        } else {
            return $this->response->setStatusCode(405)->setJSON([
                'status' => 'error',
                'message' => 'Method not allowed',
                'csrfToken' => csrf_hash() // juga di sini
            ]);
        }
    }

    public function batalStatus($id)
    {
        if ($this->request->isAJAX()) {
            $model = new ModelTransaksi();
            $transaksi = $model->find($id);

            if ($transaksi) {
                $model->update($id, ['status' => 'batal']);

                return $this->response->setJSON([
                    'status' => 'success',
                    'csrfToken' => csrf_hash()
                ]);
            } else {
                return $this->response->setJSON([
                    'status' => 'error',
                    'message' => 'Transaksi tidak ditemukan',
                    'csrfToken' => csrf_hash()
                ]);
            }
        } else {
            return $this->response->setStatusCode(405)->setJSON([
                'status' => 'error',
                'message' => 'Method not allowed',
                'csrfToken' => csrf_hash()
            ]);
        }
    }
}
