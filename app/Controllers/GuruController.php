<?php

namespace App\Controllers;

use App\Models\StudentModel;
use App\Models\BookModel;
use App\Models\MaterialModel;
use App\Models\AssignmentModel;
use App\Models\GradeModel;
use App\Models\BookStoreModel;
use App\Models\BookStoreMaterialModel;
use App\Models\BookStoreAssignmentModel;
use App\Models\UserModel;

class GuruController extends BaseController
{
    protected $studentModel;
    protected $bookModel;
    protected $materialModel;
    protected $assignmentModel;
    protected $gradeModel;
    protected $bookStoreModel;
    protected $bookStoreMaterialModel;
    protected $bookStoreAssignmentModel;
    protected $userModel;

    public function __construct()
    {
        $this->studentModel   = new StudentModel();
        $this->bookModel      = new BookModel();
        $this->materialModel  = new MaterialModel();
        $this->assignmentModel = new AssignmentModel();
        $this->gradeModel     = new GradeModel();
        $this->bookStoreModel = new BookStoreModel();
        $this->bookStoreMaterialModel = new BookStoreMaterialModel();
        $this->bookStoreAssignmentModel = new BookStoreAssignmentModel();
        $this->userModel = new UserModel();
    }

    protected function getGuruId()
    {
        return session()->get('user_id');
    }

    // ==================== DASHBOARD ====================

    public function index()
    {
        $guruId = $this->getGuruId();

        $data = [
            'totalStudents'   => count($this->studentModel->getByGuru($guruId)),
            'totalBooks'      => count($this->bookModel->getByGuru($guruId)),
            'totalMaterials'  => count($this->materialModel->getByGuru($guruId)),
            'totalAssignments'=> count($this->assignmentModel->getByGuru($guruId)),
            'recentStudents'  => array_slice($this->studentModel->getByGuru($guruId), 0, 5),
        ];

        $isHtmx = ($_SERVER['HTTP_HX_REQUEST'] ?? '') === 'true';
        if($isHtmx) {
            return view('guru/htmx/dashboard', $data);
        }
        
        return view('guru/dashboard', $data);
    }

    // ==================== CLASSES ====================

    public function classes()
    {
        $guruId = $this->getGuruId();
        $students = $this->studentModel->getByGuru($guruId);

        $classes = [];
        foreach ($students as $s) {
            $class = $s['class'];
            if (!isset($classes[$class])) {
                $classes[$class] = 0;
            }
            $classes[$class]++;
        }
        ksort($classes);

        $isHtmx = ($_SERVER['HTTP_HX_REQUEST'] ?? '') === 'true';
        if($isHtmx) {
            return view('guru/htmx/kelas', [
                'classes' => $classes,
            ]);
        }

        return view('guru/kelas', [
            'classes' => $classes,
        ]);
    }

    // ==================== SETTINGS ====================

    public function settings()
    {
        $isHtmx = ($_SERVER['HTTP_HX_REQUEST'] ?? '') === 'true';
        if($isHtmx) {
            return view('guru/htmx/pengaturan');
        }
        return view('guru/pengaturan');
    }

    // ==================== PROFILE ====================

    public function profile()
    {
        $user = $this->userModel->find(session()->get('user_id'));
        if (!$user) {
            return redirect()->to('/guru/pengaturan')->with('error', 'User tidak ditemukan.');
        }

        $isHtmx = ($_SERVER['HTTP_HX_REQUEST'] ?? '') === 'true';
        if ($isHtmx) {
            return view('guru/htmx/profile', ['user' => $user]);
        }

        return view('guru/profile', ['user' => $user]);
    }

    public function updateProfile()
    {
        $userId = session()->get('user_id');
        $user   = $this->userModel->find($userId);
        if (!$user) {
            return redirect()->to('/guru/pengaturan')->with('error', 'User tidak ditemukan.');
        }

        $name  = trim((string) $this->request->getPost('name'));
        $email = trim((string) $this->request->getPost('email'));

        if ($name === '' || $email === '' || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
            return redirect()->to('/guru/pengaturan/profile')->with('error', 'Nama dan email wajib diisi dengan benar.');
        }

        $existing = $this->userModel->where('email', $email)->where('id !=', $userId)->first();
        if ($existing) {
            return redirect()->to('/guru/pengaturan/profile')->with('error', 'Email sudah digunakan akun lain.');
        }

        $this->userModel->update($userId, ['name' => $name, 'email' => $email]);
        session()->set('user_name', $name);

        return redirect()->to('/guru/pengaturan/profile')->with('success', 'Profil berhasil diperbarui.');
    }

    public function keamanan()
    {
        $isHtmx = ($_SERVER['HTTP_HX_REQUEST'] ?? '') === 'true';
        if ($isHtmx) {
            return view('guru/htmx/keamanan');
        }

        return view('guru/keamanan');
    }

    public function updatePassword()
    {
        $userId = session()->get('user_id');
        $user   = $this->userModel->find($userId);
        if (!$user) {
            return redirect()->to('/guru/pengaturan')->with('error', 'User tidak ditemukan.');
        }

        $current = (string) $this->request->getPost('current_password');
        $new     = (string) $this->request->getPost('new_password');
        $confirm = (string) $this->request->getPost('confirm_password');

        if (!password_verify($current, $user['password_hash'])) {
            return redirect()->to('/guru/pengaturan/keamanan')->with('error', 'Password lama salah.');
        }

        if (strlen($new) < 6) {
            return redirect()->to('/guru/pengaturan/keamanan')->with('error', 'Password baru minimal 6 karakter.');
        }

        if ($new !== $confirm) {
            return redirect()->to('/guru/pengaturan/keamanan')->with('error', 'Konfirmasi password tidak cocok.');
        }

        $this->userModel->update($userId, ['password_hash' => password_hash($new, PASSWORD_DEFAULT)]);

        return redirect()->to('/guru/pengaturan/keamanan')->with('success', 'Password berhasil diubah.');
    }

    // ==================== KATEGORI ====================

    public function kategori()
    {
        $isHtmx = ($_SERVER['HTTP_HX_REQUEST'] ?? '') === 'true';
        if($isHtmx) {
            return view('guru/htmx/kategori');
        }
        return view('guru/kategori');
    }

    // ==================== BOOK STORE ====================

    public function bookStore()
    {
        $search = $this->request->getGet('search');
        $class  = $this->request->getGet('class');
        $subject = $this->request->getGet('subject');

        if ($search) {
            $books = $this->bookStoreModel->search($search);
        } elseif ($class || $subject) {
            $books = $this->bookStoreModel->filter($class, $subject);
        } else {
            $books = $this->bookStoreModel->findAll();
        }

        $classes  = array_unique(array_column($this->bookStoreModel->findAll(), 'class'));
        $subjects = array_unique(array_column($this->bookStoreModel->findAll(), 'subject'));

        // Check which books are already taken by this teacher
        $guruId = $this->getGuruId();
        $myBooks = $this->bookModel->getByGuru($guruId);
        $myBookTitles = array_column($myBooks, 'title');

        $isHtmx = ($_SERVER['HTTP_HX_REQUEST'] ?? '') === 'true';
        if($isHtmx) {
            return view('guru/htmx/book-store', [
                'books'        => $books,
                'classes'      => $classes,
                'subjects'     => $subjects,
                'myBookTitles' => $myBookTitles,
            ]);
        }

        return view('guru/book-store', [
            'books'        => $books,
            'classes'      => $classes,
            'subjects'     => $subjects,
            'myBookTitles' => $myBookTitles,
        ]);
    }

    public function bookStoreDetail($id)
    {
        $book = $this->bookStoreModel->getWithDetails($id);
        if (!$book) {
            return redirect()->to('/guru/book-store')->with('error', 'Buku tidak ditemukan.');
        }

        return view('guru/book-store-detail', [
            'book' => $book,
        ]);
    }

    public function takeBook($id)
    {
        $guruId = $this->getGuruId();
        $book = $this->bookStoreModel->find($id);

        if (!$book) {
            return redirect()->to('/guru/book-store')->with('error', 'Buku tidak ditemukan.');
        }

        // Check if already taken
        $existing = $this->bookModel->where('guru_id', $guruId)
            ->where('title', $book['title'])
            ->first();

        if ($existing) {
            return redirect()->to('/guru/book-store')->with('error', 'Buku sudah ada di daftar Anda.');
        }

        // Copy book to teacher's books
        $bookData = [
            'guru_id'     => $guruId,
            'title'       => $book['title'],
            'type'        => $book['type'],
            'url_or_path' => $book['url_or_path'],
            'subject'     => $book['subject'],
            'class'       => $book['class'],
            'semester'    => $book['semester'],
        ];
        $newBookId = $this->bookModel->insert($bookData);

        // Copy materials
        $materials = $this->bookStoreMaterialModel->getByBookStore($id);
        foreach ($materials as $m) {
            $this->materialModel->insert([
                'guru_id'  => $guruId,
                'book_id'  => $newBookId,
                'title'    => $m['title'],
                'content'  => $m['content'],
                'chapter'  => $m['chapter'],
                'subject'  => $m['subject'],
                'class'    => $m['class'],
                'semester' => $m['semester'],
            ]);
        }

        // Copy assignments
        $assignments = $this->bookStoreAssignmentModel->getByBookStore($id);
        foreach ($assignments as $a) {
            $this->assignmentModel->insert([
                'guru_id'     => $guruId,
                'book_id'     => $newBookId,
                'title'       => $a['title'],
                'description' => $a['description'],
                'subject'     => $a['subject'],
                'class'       => $a['class'],
                'semester'    => $a['semester'],
                'due_date'    => $a['due_date'],
            ]);
        }

        return redirect()->to('/guru/book-store')->with('success', 'Buku berhasil diambil! Buku, materi, dan tugas telah ditambahkan ke daftar Anda.');
    }

    // ==================== STUDENTS ====================

    public function students()
    {
        $guruId = $this->getGuruId();
        $search = $this->request->getGet('search');
        $class  = $this->request->getGet('class');

        if ($search) {
            $students = $this->studentModel->searchByGuru($guruId, $search);
        } elseif ($class) {
            $students = $this->studentModel->getByGuruAndClass($guruId, $class);
        } else {
            $students = $this->studentModel->getByGuru($guruId);
        }

        $classes = array_unique(array_column($this->studentModel->getByGuru($guruId), 'class'));

        $isHtmx = ($_SERVER['HTTP_HX_REQUEST'] ?? '') === 'true';
        if($isHtmx) {
            return view('guru/htmx/students', [
                'students' => $students,
                'classes'  => $classes,
                'search'   => $search,
                'class'    => $class,
            ]);
        }

        return view('guru/students', [
            'students' => $students,
            'classes'  => $classes,
            'search'   => $search,
            'class'    => $class,
        ]);
    }

    public function addStudent()
    {
        $data = [
            'guru_id'     => $this->getGuruId(),
            'username'    => $this->request->getPost('username'),
            'name'        => $this->request->getPost('name'),
            'class'       => $this->request->getPost('class'),
            'phone'       => $this->request->getPost('phone'),
            'parent_name' => $this->request->getPost('parent_name'),
            'address'     => $this->request->getPost('address'),
        ];

        // Auto-generate password if username is provided
        if (!empty($data['username'])) {
            $data['password_hash'] = password_hash('123456', PASSWORD_DEFAULT);
        }

        $this->studentModel->insert($data);
        return redirect()->to('/guru/murid')->with('success', 'Murid berhasil ditambahkan.');
    }

    public function editStudentForm($id)
    {
        $student = $this->studentModel->find($id);
        if (!$student || $student['guru_id'] != $this->getGuruId()) {
            return redirect()->to('/guru/murid')->with('error', 'Murid tidak ditemukan.');
        }

        $isHtmx = ($_SERVER['HTTP_HX_REQUEST'] ?? '') === 'true';
        if ($isHtmx) {
            return view('guru/htmx/student-edit', ['student' => $student]);
        }

        return view('guru/student-edit', ['student' => $student]);
    }

    public function updateStudent($id)
    {
        $data = [
            'username'    => $this->request->getPost('username'),
            'name'        => $this->request->getPost('name'),
            'class'       => $this->request->getPost('class'),
            'phone'       => $this->request->getPost('phone'),
            'parent_name' => $this->request->getPost('parent_name'),
            'address'     => $this->request->getPost('address'),
        ];

        $this->studentModel->update($id, $data);
        return redirect()->to('/guru/murid')->with('success', 'Data murid berhasil diperbarui.');
    }

    public function resetStudentPassword($id)
    {
        $this->studentModel->resetPassword($id);
        return redirect()->to('/guru/murid')->with('success', 'Password murid berhasil direset menjadi 123456.');
    }

    public function deleteStudent($id)
    {
        $this->studentModel->delete($id);
        return redirect()->to('/guru/murid')->with('success', 'Murid berhasil dihapus.');
    }

    // ==================== BOOKS ====================

    public function books()
    {
        $guruId  = $this->getGuruId();
        $class   = $this->request->getGet('class');
        $subject = $this->request->getGet('subject');

        if ($class) {
            $books = $this->bookModel->getByGuruAndClass($guruId, $class);
        } elseif ($subject) {
            $books = $this->bookModel->getByGuruAndSubject($guruId, $subject);
        } else {
            $books = $this->bookModel->getByGuru($guruId);
        }

        $classes  = array_unique(array_column($this->bookModel->getByGuru($guruId), 'class'));
        $subjects = array_unique(array_column($this->bookModel->getByGuru($guruId), 'subject'));

        $isHtmx = ($_SERVER['HTTP_HX_REQUEST'] ?? '') === 'true';
        if($isHtmx) {
            return view('guru/htmx/books', [
                'books'    => $books,
                'classes'  => $classes,
                'subjects' => $subjects,
                'class'    => $class,
                'subject'  => $subject,
            ]);
        }

        return view('guru/books', [
            'books'    => $books,
            'classes'  => $classes,
            'subjects' => $subjects,
            'class'    => $class,
            'subject'  => $subject,
        ]);
    }

    public function addBookForm()
    {
        $isHtmx = ($_SERVER['HTTP_HX_REQUEST'] ?? '') === 'true';
        if ($isHtmx) {
            return view('guru/htmx/book-add');
        }

        return view('guru/book-add');
    }

    public function addBook()
    {
        $type = $this->request->getPost('type');
        $urlOrPath = '';

        if ($type === 'pdf') {
            $file = $this->request->getFile('pdf_file');
            if ($file && $file->isValid() && !$file->hasMoved()) {
                $newName = $file->getRandomName();
                $file->move(FCPATH . 'uploads', $newName);
                $urlOrPath = 'uploads/' . $newName;
            }
        } else {
            $urlOrPath = $this->request->getPost('url');
        }

        $data = [
            'guru_id'     => $this->getGuruId(),
            'title'       => $this->request->getPost('title'),
            'type'        => $type,
            'url_or_path' => $urlOrPath,
            'subject'     => $this->request->getPost('subject'),
            'class'       => $this->request->getPost('class'),
            'semester'    => $this->request->getPost('semester'),
        ];

        $this->bookModel->insert($data);
        return redirect()->to('/guru/buku')->with('success', 'Buku berhasil ditambahkan.');
    }

    public function updateBook($id)
    {
        $type = $this->request->getPost('type');
        $urlOrPath = $this->request->getPost('existing_url');

        if ($type === 'pdf') {
            $file = $this->request->getFile('pdf_file');
            if ($file && $file->isValid() && !$file->hasMoved()) {
                $newName = $file->getRandomName();
                $file->move(FCPATH . 'uploads', $newName);
                $urlOrPath = 'uploads/' . $newName;
            }
        } else {
            $urlOrPath = $this->request->getPost('url');
        }

        $data = [
            'title'       => $this->request->getPost('title'),
            'type'        => $type,
            'url_or_path' => $urlOrPath,
            'subject'     => $this->request->getPost('subject'),
            'class'       => $this->request->getPost('class'),
            'semester'    => $this->request->getPost('semester'),
        ];

        $this->bookModel->update($id, $data);
        return redirect()->to('/guru/buku')->with('success', 'Buku berhasil diperbarui.');
    }

    public function deleteBook($id)
    {
        $this->bookModel->delete($id);
        return redirect()->to('/guru/buku')->with('success', 'Buku berhasil dihapus.');
    }

    // ==================== MATERIALS ====================

    public function materials()
    {
        $guruId  = $this->getGuruId();
        $class   = $this->request->getGet('class');
        $subject = $this->request->getGet('subject');

        if ($class) {
            $materials = $this->materialModel->getByGuruAndClass($guruId, $class);
        } elseif ($subject) {
            $materials = $this->materialModel->getByGuruAndSubject($guruId, $subject);
        } else {
            $materials = $this->materialModel->getByGuru($guruId);
        }

        $classes  = array_unique(array_column($this->materialModel->getByGuru($guruId), 'class'));
        $subjects = array_unique(array_column($this->materialModel->getByGuru($guruId), 'subject'));
        $books    = $this->bookModel->getByGuru($guruId);

        $isHtmx = ($_SERVER['HTTP_HX_REQUEST'] ?? '') === 'true';
        if($isHtmx) {
            return view('guru/htmx/materials', [
                'materials' => $materials,
                'classes'   => $classes,
                'subjects'  => $subjects,
                'books'     => $books,
            ]);
        }

        return view('guru/materials', [
            'materials' => $materials,
            'classes'   => $classes,
            'subjects'  => $subjects,
            'books'     => $books,
        ]);
    }

    public function addMaterialForm()
    {
        $books = $this->bookModel->getByGuru($this->getGuruId());

        $isHtmx = ($_SERVER['HTTP_HX_REQUEST'] ?? '') === 'true';
        if ($isHtmx) {
            return view('guru/htmx/material-add', ['books' => $books]);
        }

        return view('guru/material-add', ['books' => $books]);
    }

    public function addMaterial()
    {
        $data = [
            'guru_id'  => $this->getGuruId(),
            'book_id'  => $this->request->getPost('book_id') ?: null,
            'title'    => $this->request->getPost('title'),
            'subject'  => $this->request->getPost('subject'),
            'chapter'  => $this->request->getPost('chapter'),
            'semester' => $this->request->getPost('semester'),
            'class'    => $this->request->getPost('class'),
            'content'  => $this->request->getPost('content'),
        ];

        $this->materialModel->insert($data);
        return redirect()->to('/guru/materi')->with('success', 'Materi berhasil ditambahkan.');
    }

    public function editMaterialForm($id)
    {
        $material = $this->materialModel->find($id);
        if (!$material || $material['guru_id'] != $this->getGuruId()) {
            return redirect()->to('/guru/materi')->with('error', 'Materi tidak ditemukan.');
        }

        $books = $this->bookModel->getByGuru($this->getGuruId());

        $isHtmx = ($_SERVER['HTTP_HX_REQUEST'] ?? '') === 'true';
        if ($isHtmx) {
            return view('guru/htmx/material-edit', ['material' => $material, 'books' => $books]);
        }

        return view('guru/material-edit', ['material' => $material, 'books' => $books]);
    }

    public function updateMaterial($id)
    {
        $data = [
            'book_id'  => $this->request->getPost('book_id') ?: null,
            'title'    => $this->request->getPost('title'),
            'subject'  => $this->request->getPost('subject'),
            'chapter'  => $this->request->getPost('chapter'),
            'semester' => $this->request->getPost('semester'),
            'class'    => $this->request->getPost('class'),
            'content'  => $this->request->getPost('content'),
        ];

        $this->materialModel->update($id, $data);
        return redirect()->to('/guru/materi')->with('success', 'Materi berhasil diperbarui.');
    }

    public function deleteMaterial($id)
    {
        $this->materialModel->delete($id);
        return redirect()->to('/guru/materi')->with('success', 'Materi berhasil dihapus.');
    }

    // ==================== ASSIGNMENTS ====================

    public function assignments()
    {
        $guruId  = $this->getGuruId();
        $class   = $this->request->getGet('class');
        $subject = $this->request->getGet('subject');

        if ($class) {
            $assignments = $this->assignmentModel->getByGuruAndClass($guruId, $class);
        } elseif ($subject) {
            $assignments = $this->assignmentModel->getByGuruAndSubject($guruId, $subject);
        } else {
            $assignments = $this->assignmentModel->getByGuru($guruId);
        }

        $classes  = array_unique(array_column($this->assignmentModel->getByGuru($guruId), 'class'));
        $subjects = array_unique(array_column($this->assignmentModel->getByGuru($guruId), 'subject'));
        $books    = $this->bookModel->getByGuru($guruId);
        $materials = $this->materialModel->getByGuru($guruId);

        $isHtmx = ($_SERVER['HTTP_HX_REQUEST'] ?? '') === 'true';
        if($isHtmx) {
            return view('guru/htmx/assignments', [
                'assignments' => $assignments,
                'classes'     => $classes,
                'subjects'    => $subjects,
                'books'       => $books,
                'materials'   => $materials,
                'class'       => $class,
                'subject'     => $subject,
            ]);
        }

        return view('guru/assignments', [
            'assignments' => $assignments,
            'classes'     => $classes,
            'subjects'    => $subjects,
            'books'       => $books,
            'materials'   => $materials,
            'class'       => $class,
            'subject'     => $subject,
        ]);
    }

    public function addAssignment()
    {
        $data = [
            'guru_id'     => $this->getGuruId(),
            'book_id'     => $this->request->getPost('book_id') ?: null,
            'material_id' => $this->request->getPost('material_id') ?: null,
            'title'       => $this->request->getPost('title'),
            'description' => $this->request->getPost('description'),
            'subject'     => $this->request->getPost('subject'),
            'class'       => $this->request->getPost('class'),
            'semester'    => $this->request->getPost('semester'),
            'due_date'    => $this->request->getPost('due_date'),
        ];

        $this->assignmentModel->insert($data);
        return redirect()->to('/guru/tugas')->with('success', 'Tugas berhasil ditambahkan.');
    }

    public function editAssignmentForm($id)
    {
        $assignment = $this->assignmentModel->find($id);
        if (!$assignment || $assignment['guru_id'] != $this->getGuruId()) {
            return redirect()->to('/guru/tugas')->with('error', 'Tugas tidak ditemukan.');
        }

        $books     = $this->bookModel->getByGuru($this->getGuruId());
        $materials = $this->materialModel->getByGuru($this->getGuruId());

        $isHtmx = ($_SERVER['HTTP_HX_REQUEST'] ?? '') === 'true';
        if ($isHtmx) {
            return view('guru/htmx/assignment-edit', ['assignment' => $assignment, 'books' => $books, 'materials' => $materials]);
        }

        return view('guru/assignment-edit', ['assignment' => $assignment, 'books' => $books, 'materials' => $materials]);
    }

    public function updateAssignment($id)
    {
        $data = [
            'book_id'     => $this->request->getPost('book_id') ?: null,
            'material_id' => $this->request->getPost('material_id') ?: null,
            'title'       => $this->request->getPost('title'),
            'description' => $this->request->getPost('description'),
            'subject'     => $this->request->getPost('subject'),
            'class'       => $this->request->getPost('class'),
            'semester'    => $this->request->getPost('semester'),
            'due_date'    => $this->request->getPost('due_date'),
        ];

        $this->assignmentModel->update($id, $data);
        return redirect()->to('/guru/tugas')->with('success', 'Tugas berhasil diperbarui.');
    }

    public function deleteAssignment($id)
    {
        $this->assignmentModel->delete($id);
        return redirect()->to('/guru/tugas')->with('success', 'Tugas berhasil dihapus.');
    }

    // ==================== GRADES ====================

    public function grades()
    {
        $guruId = $this->getGuruId();
        $assignmentId = $this->request->getGet('assignment_id');

        $assignments = $this->assignmentModel->getByGuru($guruId);
        $students = $this->studentModel->getByGuru($guruId);

        if ($assignmentId) {
            $grades = $this->gradeModel->getByAssignment($assignmentId);
        } else {
            $grades = $this->gradeModel->getGradesWithDetails($guruId);
        }

        return view('guru/grades', [
            'grades'      => $grades,
            'assignments' => $assignments,
            'students'    => $students,
            'assignmentId' => $assignmentId,
        ]);
    }

    public function addGrade()
    {
        $data = [
            'assignment_id' => $this->request->getPost('assignment_id'),
            'student_id'    => $this->request->getPost('student_id'),
            'score'         => $this->request->getPost('score'),
            'feedback'      => $this->request->getPost('feedback'),
        ];

        $existing = $this->gradeModel->getByAssignmentAndStudent($data['assignment_id'], $data['student_id']);

        if ($existing) {
            $this->gradeModel->update($existing['id'], $data);
        } else {
            $this->gradeModel->insert($data);
        }

        return redirect()->to('/guru/nilai')->with('success', 'Nilai berhasil disimpan.');
    }

    public function updateGrade($id)
    {
        $data = [
            'score'    => $this->request->getPost('score'),
            'feedback' => $this->request->getPost('feedback'),
        ];

        $this->gradeModel->update($id, $data);
        return redirect()->to('/guru/nilai')->with('success', 'Nilai berhasil diperbarui.');
    }

    public function deleteGrade($id)
    {
        $this->gradeModel->delete($id);
        return redirect()->to('/guru/nilai')->with('success', 'Nilai berhasil dihapus.');
    }
}
