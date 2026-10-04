<?php

use CodeIgniter\Router\RouteCollection;

/** @var RouteCollection $routes */
$routes->get('/', function () {
    return redirect()->to('/murid');
});

// Auth routes
$routes->get('/signup', 'AuthController::signup');
$routes->post('/signup', 'AuthController::doSignup');
$routes->get('/login', 'AuthController::login');
$routes->post('/login', 'AuthController::doLogin');
$routes->get('/logout', 'AuthController::logout');

// Guru routes (protected)
$routes->group('guru', ['filter' => 'auth'], function ($routes) {
    $routes->get('/', 'GuruController::index');
    $routes->get('kelas', 'GuruController::classes');
    $routes->get('pengaturan', 'GuruController::settings');
    $routes->get('pengaturan/profile', 'GuruController::profile');
    $routes->post('pengaturan/profile', 'GuruController::updateProfile');
    $routes->get('pengaturan/keamanan', 'GuruController::keamanan');
    $routes->post('pengaturan/keamanan', 'GuruController::updatePassword');
    $routes->get('kategori', 'GuruController::kategori');
    $routes->get('book-store', 'GuruController::bookStore');
    $routes->get('book-store/(:num)', 'GuruController::bookStoreDetail/$1');
    $routes->get('book-store/take/(:num)', 'GuruController::takeBook/$1');
    $routes->get('buku', 'GuruController::books');
    $routes->get('buku/add', 'GuruController::addBookForm');
    $routes->post('buku', 'GuruController::addBook');
    $routes->post('buku/update/(:num)', 'GuruController::updateBook/$1');
    $routes->get('buku/delete/(:num)', 'GuruController::deleteBook/$1');
    $routes->get('materi', 'GuruController::materials');
    $routes->get('materi/add', 'GuruController::addMaterialForm');
    $routes->post('materi', 'GuruController::addMaterial');
    $routes->post('materi/update/(:num)', 'GuruController::updateMaterial/$1');
    $routes->get('materi/edit/(:num)', 'GuruController::editMaterialForm/$1');
    $routes->get('materi/delete/(:num)', 'GuruController::deleteMaterial/$1');
    $routes->post('materi/submaterial/(:num)', 'GuruController::addSubmaterial/$1');
    $routes->get('materi/submaterial/delete/(:num)', 'GuruController::deleteSubmaterial/$1');
    $routes->get('murid', 'GuruController::students');
    $routes->post('murid', 'GuruController::addStudent');
    $routes->post('murid/update/(:num)', 'GuruController::updateStudent/$1');
    $routes->get('murid/edit/(:num)', 'GuruController::editStudentForm/$1');
    $routes->get('murid/delete/(:num)', 'GuruController::deleteStudent/$1');
    $routes->get('murid/reset-password/(:num)', 'GuruController::resetStudentPassword/$1');
    $routes->get('tugas', 'GuruController::assignments');
    $routes->post('tugas', 'GuruController::addAssignment');
    $routes->get('tugas/tambah', 'GuruController::addAssignmentForm');
    $routes->post('tugas/update/(:num)', 'GuruController::updateAssignment/$1');
    $routes->get('tugas/edit/(:num)', 'GuruController::editAssignmentForm/$1');
    $routes->get('tugas/(:num)/submissions', 'GuruController::assignmentSubmissions/$1');
    $routes->get('tugas/(:num)/submissions/(:num)', 'GuruController::submissionDetail/$1/$2');
    $routes->post('tugas/(:num)/submissions/(:num)/grade', 'GuruController::gradeSubmission/$1/$2');
    $routes->get('tugas/delete/(:num)', 'GuruController::deleteAssignment/$1');
    $routes->get('nilai', 'GuruController::grades');
    $routes->post('nilai', 'GuruController::addGrade');
    $routes->post('nilai/update/(:num)', 'GuruController::updateGrade/$1');
    $routes->get('nilai/delete/(:num)', 'GuruController::deleteGrade/$1');
});

// Admin routes (protected)
$routes->group('admin', ['filter' => 'auth'], function ($routes) {
    $routes->get('/', 'AdminController::index');
    $routes->get('buku', 'AdminController::books');
    $routes->post('buku', 'AdminController::addBook');
    $routes->post('buku/update/(:num)', 'AdminController::updateBook/$1');
    $routes->get('buku/delete/(:num)', 'AdminController::deleteBook/$1');
    $routes->get('materi', 'AdminController::materials');
    $routes->post('materi', 'AdminController::addMaterial');
    $routes->post('materi/update/(:num)', 'AdminController::updateMaterial/$1');
    $routes->get('materi/delete/(:num)', 'AdminController::deleteMaterial/$1');
    $routes->get('tugas', 'AdminController::assignments');
    $routes->post('tugas', 'AdminController::addAssignment');
    $routes->post('tugas/update/(:num)', 'AdminController::updateAssignment/$1');
    $routes->get('tugas/delete/(:num)', 'AdminController::deleteAssignment/$1');
});

// Murid routes
$routes->get('murid/login', 'AuthController::studentLogin');
$routes->post('murid/login', 'AuthController::doStudentLogin');
$routes->get('murid/logout', 'AuthController::studentLogout');

$routes->group('murid', ['filter' => 'studentAuth'], function ($routes) {
    $routes->get('/', 'Home::index');
    $routes->get('missions', 'MissionController::index');
    $routes->get('missions/semester/(:num)', 'MissionController::semester/$1');
    $routes->get('missions/(:num)', 'MissionController::detail/$1');
    $routes->get('missions/(:num)/book', 'MissionController::book/$1');
    $routes->get('missions/(:num)/material', 'MissionController::material/$1');
    $routes->get('missions/(:num)/assignment', 'MissionController::assignment/$1');
    $routes->post('missions/(:num)/complete', 'MissionController::complete/$1');
    $routes->post('assignments/(:num)/submit', 'MissionController::submitAssignment/$1');
    $routes->get('sertifikat/(:num)', 'MissionController::certificate/$1');
    $routes->get('achievements', 'AchievementController::index');
    $routes->get('profile', 'ProfileController::index');

    $routes->group('htmx', function ($routes) {
        $routes->get('home', 'Htmx\HomeController::index');
        $routes->get('missions', 'Htmx\MissionController::index');
        $routes->get('missions/semester/(:num)', 'Htmx\MissionController::semester/$1');
        $routes->get('missions/(:num)/book', 'Htmx\MissionController::book/$1');
        $routes->get('missions/(:num)/material', 'Htmx\MissionController::material/$1');
        $routes->get('missions/(:num)/assignment', 'Htmx\MissionController::assignment/$1');
        $routes->get('achievements', 'Htmx\AchievementController::index');
        $routes->get('profile', 'Htmx\ProfileController::index');
    });
});
