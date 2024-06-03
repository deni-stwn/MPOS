<?php

namespace App\Http\Controllers;

use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Yajra\DataTables\Facades\DataTables;

class UserController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = User::query()->where('usertype', '!=', 'admin')->latest()->get();
            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('foto', function ($item) {
                    $mediaItems = $item->getMedia('foto');
                    if ($mediaItems->isEmpty()) {
                        return '--';
                    }
                    $mediaHtml = '';
                    foreach ($mediaItems as $media) {
                        $mediaHtml .= '<a href="' . $media->getUrl() . '" data-lightbox="image-' . $item->id . '"><img style="width: 100px; height:80px; object-fit:cover; object-position:center;" src="' . $media->getUrl() . '" alt="Media" loading="lazy"></a>';
                    }
                    return $mediaHtml;
                })
                ->addColumn('action', function($row){
                    $btn = '<button class="btn btn-warning edit mr-2" id="'.$row->id.'">Edit</button>';
                    $btn .= '<button type="submit" class="btn btn-danger delete" id="'.$row->id.'">Delete</button>';
                    return $btn;
                })
                ->addColumn('created_at', function($row){
                    return date('d-m-Y H:i:s', strtotime($row->created_at));
                })
                ->rawColumns(['action', 'created_at', 'DT_RowIndex', 'foto'])
                ->make(true);
        }

        return view('pages.admin.users.index');
    }

    public function create()
    {
        return view('pages.admin.users.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'foto' => 'nullable',
            'name' => 'required',
            'email' => 'required',
            'password' => 'nullable',
            'nomor_telf' => 'nullable',
            'nama_toko' => 'nullable',
        ]);

        $password = Hash::make($request->password);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => $password,
            'nomor_telf' => $request->nomor_telf,
            'nama_toko' => $request->nama_toko,
            'foto' => '',
        ]);

        foreach ($request->input('foto', []) as $file) {
            $user->addMedia(storage_path('tmp/uploads/' . basename($file)))->toMediaCollection('foto');
        }

        return response()->json(['message' => 'User created successfully.'], 201);
    }

    public function show($id)
    {
        try{
            $user = User::findOrFail($id);
            if(!$user) {
                return response()->json(['message' => 'User not found.'], 404);
            }
            return response()->json($user, 200);
        } catch (Exception $e) {
            return response()->json(['message' => 'User not found.'], 404);
        }
    }

    public function edit($id)
    {
        try{
            $user = User::with('media')->findOrFail($id);
            if(!$user) {
                return response()->json(['message' => 'User not found.'], 404);
            }
            return response()->json($user, 200);
        } catch (Exception $e) {
            return response()->json(['message' => 'User not found.'], 404);
        }
    }

    public function update(Request $request, $id)
    {
        try {
            $user = User::findOrFail($id);

            $updateData = $request->all();
            if (empty($updateData['password'])) {
                unset($updateData['password']);
            } else {
                $updateData['password'] = bcrypt($updateData['password']);
            }

            if ($request->has('foto')) {
                if ($user->foto) {
                    $user->clearMediaCollection('foto');
                }

                foreach ($request->input('foto') as $file) {
                    $user->addMedia(storage_path('tmp/uploads/' . basename($file)))->toMediaCollection('foto');
                }
            } elseif ($user->foto) {
                $user->clearMediaCollection('foto');
            }

            $user->update($updateData);

            return response()->json(['message' => 'User updated successfully.', 'user' => $user], 200);
        } catch (Exception $e) {
            return response()->json(['message' => 'User not found.'], 404);
        }
    }


    public function destroy($id)
    {
        try{
            $user = User::findOrFail($id);
            $user->delete();
            return response()->json(['message' => 'User deleted successfully.'], 200);
        } catch (Exception $e) {
            return response()->json(['message' => 'User not found.'], 404);
        }
    }

    public function getMedia($id, $collectionName)
    {
        try {
            $post = User::findOrFail($id);
            $mediaItems = $post->getMedia($collectionName);
            return response()->json(['status' => 'success', 'data' => $mediaItems]);
        } catch (Exception $e) {
            return redirect()->route('post.index')->with('error', 'Location not found.');
        }
    }

    public function storeMedia(Request $request)
    {
        $path = storage_path('tmp/uploads');

        if (!file_exists($path)) {
            mkdir($path, 0777, true);
        }

        $file = $request->file('file');

        $name = uniqid() . '_' . trim($file->getClientOriginalName());

        $file->move($path, $name);

        return response()->json([
            'name'          => $name,
            'original_name' => $file->getClientOriginalName(),
        ]);
    }

    public function deleteFile(Request $request)
    {
        try {
            $fileName = $request->input('fileName');
            $media = Media::where('file_name', $fileName)->first();

            if ($media) {
                $media->delete();
            }

            return response()->json(['message' => 'File has been removed']);
        } catch (Exception $e) {
            return response()->json(['message' => $e->getMessage()]);
        }
    }
}

