<?php

namespace App\Controllers;

use App\Models\BookStoreModel;
use App\Models\BookStoreMaterialModel;
use App\Models\BookStoreAssignmentModel;

class AdminController extends BaseController
{
    protected $bookStoreModel;
    protected $bookStoreMaterialModel;
    protected $bookStoreAssignmentModel;

    public function __construct()
    {
        $this->bookStoreModel = new BookStoreModel();
        $this->bookStoreMaterialModel = new BookStoreMaterialModel();
        $this->bookStoreAssignmentModel = new BookStoreAssignmentModel();
    }

    // ==================== DASHBOARD ====================

    public function index()
    {
        $data = [
            'totalBooks'      => count($this->bookStoreModel->findAll()),
            'totalMaterials'  => count($this->bookStoreMaterialModel->findAll()),
            'totalAssignments'=> count($this->bookStoreAssignmentModel->findAll()),
        ];

        return view('admin/dashboard', $data);
    }

    // ==================== BOOKS ====================

    public function books()
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

        return view('admin/books', [
            'books'    => $books,
            'classes'  => $classes,
            'subjects' => $subjects,
        ]);
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
            'title'       => $this->request->getPost('title'),
            'type'        => $type,
            'url_or_path' => $urlOrPath,
            'subject'     => $this->request->getPost('subject'),
            'class'       => $this->request->getPost('class'),
            'semester'    => $this->request->getPost('semester'),
            'description' => $this->request->getPost('description'),
        ];

        $this->bookStoreModel->insert($data);
        return redirect()->to('/admin/buku')->with('success', 'Buku berhasil ditambahkan.');
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
            'description' => $this->request->getPost('description'),
        ];

        $this->bookStoreModel->update($id, $data);
        return redirect()->to('/admin/buku')->with('success', 'Buku berhasil diperbarui.');
    }

    public function deleteBook($id)
    {
        $this->bookStoreModel->delete($id);
        return redirect()->to('/admin/buku')->with('success', 'Buku berhasil dihapus.');
    }

    // ==================== MATERIALS ====================

    public function materials()
    {
        $bookStoreId = $this->request->getGet('book_store_id');

        if ($bookStoreId) {
            $materials = $this->bookStoreMaterialModel->getByBookStore($bookStoreId);
        } else {
            $materials = $this->bookStoreMaterialModel->findAll();
        }

        $books = $this->bookStoreModel->findAll();

        return view('admin/materials', [
            'materials' => $materials,
            'books'     => $books,
            'bookStoreId' => $bookStoreId,
        ]);
    }

    public function addMaterial()
    {
        $data = [
            'book_store_id' => $this->request->getPost('book_store_id'),
            'title'         => $this->request->getPost('title'),
            'content'       => $this->request->getPost('content'),
            'chapter'       => $this->request->getPost('chapter'),
            'subject'       => $this->request->getPost('subject'),
            'class'         => $this->request->getPost('class'),
            'semester'      => $this->request->getPost('semester'),
        ];

        $this->bookStoreMaterialModel->insert($data);
        return redirect()->to('/admin/materi')->with('success', 'Materi berhasil ditambahkan.');
    }

    public function updateMaterial($id)
    {
        $data = [
            'book_store_id' => $this->request->getPost('book_store_id'),
            'title'         => $this->request->getPost('title'),
            'content'       => $this->request->getPost('content'),
            'chapter'       => $this->request->getPost('chapter'),
            'subject'       => $this->request->getPost('subject'),
            'class'         => $this->request->getPost('class'),
            'semester'      => $this->request->getPost('semester'),
        ];

        $this->bookStoreMaterialModel->update($id, $data);
        return redirect()->to('/admin/materi')->with('success', 'Materi berhasil diperbarui.');
    }

    public function deleteMaterial($id)
    {
        $this->bookStoreMaterialModel->delete($id);
        return redirect()->to('/admin/materi')->with('success', 'Materi berhasil dihapus.');
    }

    // ==================== ASSIGNMENTS ====================

    public function assignments()
    {
        $bookStoreId = $this->request->getGet('book_store_id');

        if ($bookStoreId) {
            $assignments = $this->bookStoreAssignmentModel->getByBookStore($bookStoreId);
        } else {
            $assignments = $this->bookStoreAssignmentModel->findAll();
        }

        $books = $this->bookStoreModel->findAll();

        return view('admin/assignments', [
            'assignments' => $assignments,
            'books'       => $books,
            'bookStoreId' => $bookStoreId,
        ]);
    }

    public function addAssignment()
    {
        $data = [
            'book_store_id' => $this->request->getPost('book_store_id'),
            'title'         => $this->request->getPost('title'),
            'description'   => $this->request->getPost('description'),
            'subject'       => $this->request->getPost('subject'),
            'class'         => $this->request->getPost('class'),
            'semester'      => $this->request->getPost('semester'),
            'due_date'      => $this->request->getPost('due_date'),
        ];

        $this->bookStoreAssignmentModel->insert($data);
        return redirect()->to('/admin/tugas')->with('success', 'Tugas berhasil ditambahkan.');
    }

    public function updateAssignment($id)
    {
        $data = [
            'book_store_id' => $this->request->getPost('book_store_id'),
            'title'         => $this->request->getPost('title'),
            'description'   => $this->request->getPost('description'),
            'subject'       => $this->request->getPost('subject'),
            'class'         => $this->request->getPost('class'),
            'semester'      => $this->request->getPost('semester'),
            'due_date'      => $this->request->getPost('due_date'),
        ];

        $this->bookStoreAssignmentModel->update($id, $data);
        return redirect()->to('/admin/tugas')->with('success', 'Tugas berhasil diperbarui.');
    }

    public function deleteAssignment($id)
    {
        $this->bookStoreAssignmentModel->delete($id);
        return redirect()->to('/admin/tugas')->with('success', 'Tugas berhasil dihapus.');
    }
}
