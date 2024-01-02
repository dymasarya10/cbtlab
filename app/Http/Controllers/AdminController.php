<?php

namespace App\Http\Controllers;

use App\Models\Grade;
use App\Models\Subject;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Crypt;


class AdminController extends Controller
{

    public function cekAdmin($func)
    {
        if (auth()->user()->role === 'admin') {
            return $func;
        }
        abort(403, 'HEHE ANDA BUKAN ADMIN YA !!.');
    }
    public string $heading = 'Admin';
    public string $title = 'CBT-LAB | Admin';

    public function dashboard()
    {
        return $this->cekAdmin(view('admin.pages.dashboard', [
            'heading' => 'Dashboard',
            'title' => $this->title
        ]));
    }

    public function student()
    {
        return $this->cekAdmin(view('admin.pages.authorops.student', [
            'heading' => $this->heading,
            'collection' => User::where('role', 'student')->orderBy('grade')->filter(request(['s']))->paginate(20)->withQueryString(),
            'title' => $this->title
        ]));
    }
    public function teacher()
    {
        return $this->cekAdmin(view('admin.pages.authorops.teacher', [
            'heading' => $this->heading,
            'collection' => User::where('role', 'teacher')->orderBy('level')->filter(request(['s']))->paginate(20)->withQueryString(),
            'title' => $this->title
        ]));
    }
    public function grade()
    {
        return $this->cekAdmin(view('admin.pages.authorops.grade', [
            'heading' => $this->heading,
            'collection' => Grade::orderBy('level')->get(),
            'title' => $this->title
        ]));
    }
    public function subject()
    {
        return $this->cekAdmin(view('admin.pages.authorops.subject', [
            'heading' => $this->heading,
            'collection' => Subject::orderby('level')->get(),
            'title' => $this->title
        ]));
    }


    // USER
    public function activateuser(Request $request)
    {
        $toggle = User::find($request->target_id);
        User::where('id', $request->target_id)->update(
            ['status' => $request->status]
        );

        if($toggle->role === 'student') {
            return redirect(route('adminstudent'));
        } else {
            return redirect(route('adminteacher'));
        }
    }

    public function deleteuser(Request $request)
    {
        if ($request->path !== '0') {
            Storage::delete($request->path);
        }
        $user = User::find($request->target);
        $msg = $user->name;
        $role = $user->role;
        $user->delete();
        if($role === 'student'){
            return redirect(route('adminstudent'))->with('success', 'Berhasil hapus ' . $msg . ' dari daftar murid !');
        } else {
            return redirect(route('adminteacher'))->with('success', 'Berhasil hapus ' . $msg . ' dari daftar guru !');
        }
    }

    public function createacc($role)
    {
        ($role === 'student') ? $data_to_show = Grade::all() : $data_to_show = Subject::all();
        return $this->cekAdmin(view('admin.pages.authorops.createacc', [
            'heading' => $this->heading,
            'role' => $role,
            'data_select' => $data_to_show,
            'title' => $this->title
        ]));
    }

    public function storeuser(Request $request)
    {
        if ($request->role === 'student') {
            $rules = [
                'identity_number' => 'required|numeric|unique:users',
                'name' => 'required',
                'email' => 'required|unique:users|email:dns',
                'password' => 'required',
                'grade' => 'required',
                'image' => 'required|image|file|max:2048',
                'role' => 'required',
                'level' => 'required',
                'remember_token' => 'required'
            ];
            $msg_rules = [
                'identity_number.required' => 'Kolom NISN wajib diisi.',
                'identity_number.numeric' => 'NISN harus berupa angka.',
                'identity_number.unique' => 'NISN sudah terdaftar.',
                'name.required' => 'Kolom nama wajib diisi.',
                'email.required' => 'Kolom email wajib diisi.',
                'email.email' => 'Format email tidak valid.',
                'email.unique' => 'Email sudah terdaftar.',
                'password.required' => 'Kolom password wajib diisi.',
                'grade.required' => 'Kolom grade wajib diisi.',
                'image.required' => 'File harus diisi.',
                'image.image' => 'File harus berupa gambar.',
                'image.file' => 'File harus berupa file.',
                'image.max' => 'Ukuran file gambar tidak boleh melebihi 2 Mb.',
                'role.required' => 'Kolom peran wajib diisi.',
                'level.required' => 'Kolom level wajib diisi.',
                'remember_token.required' => 'Kolom token ingat wajib diisi.',
            ];
        } else {
            $rules = [
                'identity_number' => 'required|numeric|unique:users',
                'name' => 'required',
                'email' => 'required|unique:users|email:dns',
                'password' => 'required',
                'subject' => 'required',
                'image' => 'required|image|file|max:2048',
                'role' => 'required',
                'level' => 'required',
                'remember_token' => 'required'
            ];
            $msg_rules = [
                'identity_number.required' => 'Kolom NISN wajib diisi.',
                'identity_number.numeric' => 'NISN harus berupa angka.',
                'identity_number.unique' => 'NISN sudah terdaftar.',
                'name.required' => 'Kolom nama wajib diisi.',
                'email.required' => 'Kolom email wajib diisi.',
                'email.email' => 'Format email tidak valid.',
                'email.unique' => 'Email sudah terdaftar.',
                'password.required' => 'Kolom password wajib diisi.',
                'subject.required' => 'Kolom subject wajib diisi.',
                'image.required' => 'File harus diisi.',
                'image.image' => 'File harus berupa gambar.',
                'image.file' => 'File harus berupa file.',
                'image.max' => 'Ukuran file gambar tidak boleh melebihi 2 Mb.',
                'role.required' => 'Kolom peran wajib diisi.',
                'level.required' => 'Kolom level wajib diisi.',
                'remember_token.required' => 'Kolom token ingat wajib diisi.',
            ];
        }
        $validatedData = $request->validate($rules, $msg_rules);

        // return dd($validatedData['grade']);
        $validatedData['password'] = Hash::make($validatedData['password']);
        if ($validatedData['role'] === 'student') {
            $validatedData['image'] = $request->file('image')->store('stdImage');
            User::create($validatedData);
            return redirect(route('adminstudent'))->with('success', 'Berhasil menambahkan murid : ' . $validatedData['name']);
        }
        if ($validatedData['role'] === 'teacher') {
            $validatedData['image'] = $request->file('image')->store('tchImage');
            User::create($validatedData);
            return redirect(route('adminteacher'))->with('success', 'Berhasil menambahkan guru : ' . $validatedData['name']);
        }
    }

    public function showacc($id, $role)
    {
        $tid = Crypt::decrypt($id);
        (User::find($tid)->role === 'student') ? $data_to_show = Grade::all() : $data_to_show = Subject::all();
        return $this->cekAdmin(view('admin.pages.authorops.editacc', [
            'heading' => $this->heading,
            'collection' => User::where('id', $tid)->get(),
            'data_select' => $data_to_show,
            'role' => $role,
            'title' => $this->title
        ]));
    }

    public function updateuser($id, Request $request)
    {
        if ($request->role === 'student') {
            $rules = ['identity_number' => 'required|numeric',
                'name' => 'required',
                'email' => 'required|email:dns',
                'password' => 'required',
                'grade' => 'required',
                'image' => 'image|file|max:2048',
                'role' => 'required',
                'level' => 'required',
                'remember_token' => 'required',];
        } else {
            $rules = ['identity_number' => 'required|numeric',
                'name' => 'required',
                'email' => 'required|email:dns',
                'password' => 'required',
                'subject' => 'required',
                'image' => 'image|file|max:2048',
                'role' => 'required',
                'level' => 'required',
                'remember_token' => 'required',];
        }
        $validatedData = $request->validate($rules);

        if ($request->file('image')) {
            if ($request->oldImg) {
                Storage::delete($request->oldImg);
            }
            if ($validatedData['role'] === 'student') {
                $validatedData['image'] = $request->file('image')->store('stdImage');
            }
            if ($validatedData['role'] === 'teacher') {
                $validatedData['image'] = $request->file('image')->store('tchImage');
            }
        }

        if ($validatedData['role'] === 'student') {
            User::where('id', $id)->update($validatedData);
            return redirect(route('adminstudent'))->with('success', 'Berhasil Edit ' . $validatedData['name']);
        } else {
            User::where('id', $id)->update($validatedData);
            return redirect(route('adminteacher'))->with('success', 'Berhasil Edit ' . $validatedData['name']);
        }
    }

    // GRADE
    public function storegrade(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required',
            'level' => 'required',
        ], [
            'name.required' => 'Kelas harus diisi !!',
            'level.required' => 'Pilih jenjang !'
        ]);

        Grade::create($validatedData);

        return redirect(route('admingrade'))->with('success', 'Berhasil menambahkan kelas : ' . $validatedData['name']);
    }

    public function destroygrade(Request $request)
    {
        $did = Grade::find($request->target);
        $msg = $did->name;
        $did->delete();
        return redirect(route('admingrade'))->with('success', 'Berhasil menghapus kelas : ' . $msg);
    }

    // SUBJECT
    public function storesubject(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required',
            'level' => 'required',
        ], [
            'name.required' => 'Matapelajaran harus diisi !!',
            'level.required' => 'Pilih jenjang !'
        ]);

        Subject::create($validatedData);

        return redirect(route('adminsubject'))->with('success', 'Berhasil menambahkan mata pelajaran : ' . $validatedData['name']);
    }

    public function destroysubject(Request $request)
    {
        $did = Subject::find($request->target);
        $msg = $did->name;
        $did->delete();
        return redirect(route('adminsubject'))->with('success', 'Berhasil menghapus mata pelajaran : ' . $msg);
    }
}
