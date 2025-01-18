Contoh Sintaks Laravel untuk Controller

Berikut adalah beberapa contoh sintaks dalam Laravel untuk looping, isset, dan penggunaan ORM (with, whereHas, nested relation), yang dapat digunakan untuk keperluan sertifikasi atau dokumentasi.

1. Looping Data dalam Controller

Looping digunakan untuk memproses data, seperti iterasi pada koleksi atau array.

Contoh:

public function index()
{
$users = User::all(); // Mengambil semua data user

    foreach ($users as $user) {
        // Proses setiap user
        echo "Nama: " . $user->name . ", Email: " . $user->email . "<br>";
    }

}

Penjelasan:

User::all(): Mengambil semua data dari tabel users.

foreach: Melakukan iterasi pada koleksi yang diambil dari database.

2. Mengecek Data dengan isset

isset digunakan untuk mengecek apakah suatu variabel atau data tertentu sudah di-set atau tidak.

Contoh:

public function checkData(Request $request)
{
    if (isset($request->name)) {
return response()->json(['message' => 'Nama ditemukan: ' . $request->name]);
} else {
return response()->json(['message' => 'Nama tidak ditemukan']);
}
}

Penjelasan:

isset($request->name): Mengecek apakah input name dikirimkan pada request.

response()->json(): Mengembalikan respon dalam format JSON.

3. Menggunakan with untuk Eager Loading

with digunakan untuk memuat relasi data dengan efisien.

Contoh:

public function showUsersWithPosts()
{
$users = User::with('posts')->get(); // Memuat user beserta post-nya

    return view('users.index', compact('users'));

}

Penjelasan:

with('posts'): Memuat relasi posts yang ada pada model User.

compact('users'): Mengirimkan variabel $users ke view.

4. Menggunakan whereHas untuk Filter Relasi

whereHas digunakan untuk memfilter data berdasarkan kondisi pada relasi.

Contoh:

public function activeUsersWithPosts()
{
$users = User::whereHas('posts', function ($query) {
$query->where('status', 'published'); // Hanya post dengan status published
})->get();

    return view('users.index', compact('users'));

}

Penjelasan:

whereHas('posts', function ($query) { ... }): Mengecek apakah user memiliki relasi post dengan kondisi tertentu.

$query->where('status', 'published'): Menambahkan filter untuk post yang berstatus published.

5. Kombinasi with dan whereHas

Anda dapat menggabungkan with dan whereHas untuk memuat data dengan filter.

Contoh:

public function filteredUsersWithRelations()
{
$users = User::with(['posts', 'roles'])
            ->whereHas('posts', function ($query) {
$query->where('status', 'published');
})
->get();

    return response()->json($users);

}

Penjelasan:

with(['posts', 'roles']): Memuat relasi posts dan roles.

whereHas('posts', function ($query) { ... }): Memfilter user yang memiliki post dengan status published.

6. Menggunakan where di Nested Relation

where dapat digunakan untuk memfilter data pada nested relation.

Contoh Kode:

public function usersWithSpecificComment()
{
$users = User::whereHas('posts.comments', function ($query) {
$query->where('content', 'like', '%Laravel%'); // Filter comment dengan kata "Laravel"
    })->with(['posts.comments' => function ($query) {
$query->where('content', 'like', '%Laravel%'); // Eager load hanya comment yang sesuai filter
}])->get();

    return response()->json($users);

}

Penjelasan:

whereHas('posts.comments', function ($query) { ... }):

Mengecek apakah ada user yang memiliki relasi posts, lalu memeriksa apakah ada comments dengan kondisi tertentu (contoh: content mengandung kata "Laravel").

with(['posts.comments' => function ($query) { ... }]):

Memuat relasi secara eager loading, tetapi hanya data relasi yang sesuai dengan filter (contoh: comment dengan kata "Laravel").

->get():

Mengambil semua data user beserta relasi yang telah difilter.

public function scopeSearch($query, array $searches)
    {
        $query->when($searches['search'] ?? false, function ($query, $search) {
            return $query->where('document_name', 'like', '%' . $search . '%');
        });
    }
