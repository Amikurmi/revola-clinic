<?php
use Illuminate\Support\Facades\Route;

Route::get('/packages', function () {
    return view('packages');
});

Route::get('/contact', function () {
    return view('contact');
});


use App\Http\Controllers\AuthController;
use App\Http\Controllers\Admin\ServiceController as AdminServiceController;
use App\Http\Controllers\Frontend\ServiceController as FrontendServiceController;
use App\Http\Controllers\Admin\BlogController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\DoctorController;
use App\Http\Controllers\Admin\DoctorSlotController;
use App\Http\Controllers\Admin\AppointmentController as AdminAppointmentController;
use App\Http\Controllers\Frontend\UserAppointmentController;
use App\Http\Controllers\Frontend\UserBlogController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\EnquiryController;
use App\Http\Controllers\ServiceController;
use App\Http\Controllers\Admin\TreatmentController as AdminTreatmentController;
use App\Http\Controllers\TreatmentController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\TreatmentConsultationController;
use App\Http\Controllers\AboutController;


use App\Models\User;
use App\Models\Doctor;
use App\Models\Enquiry;
use App\Models\Treatment;
use App\Models\Blog;
use App\Models\Appointment;


// ---------------------------
// Authentication Routes
// ---------------------------
Route::middleware('web')->group(function () {

    // ---------------------------
    // Auth Pages
    // ---------------------------
    Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
    Route::post('/login', [AuthController::class, 'login']);
    Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
    Route::post('/register', [AuthController::class, 'register']);
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

    // ---------------------------
    // ADMIN ROUTES
    // ---------------------------
    Route::middleware(['auth', 'isAdmin'])->prefix('admin')->name('admin.')->group(function () {

        // Dashboard
        // Route::get('/dashboard', function () {
        //     return view('admin.dashboard');
        // })->name('dashboard');

        Route::get('/dashboard', function () {

            return view('admin.dashboard', [
                'treatmentCount' => Treatment::count(),
                'blogCount' => Blog::count(),
                'appointmentCount' => Appointment::count(),
                'userCount' => User::where('usertype', 'user')->count(), // only normal users
                'doctorCount' => Doctor::count(),
                'enquiryCount' => Enquiry::count(),
            ]);
        })->name('dashboard');

        // SERVICES CRUD
        Route::get('/services', [AdminServiceController::class, 'index'])->name('services.index');
        Route::get('/services/create', [AdminServiceController::class, 'create'])->name('services.create');
        Route::post('/services', [AdminServiceController::class, 'store'])->name('services.store');
        Route::get('/services/{service}/edit', [AdminServiceController::class, 'edit'])->name('services.edit');
        Route::put('/services/{service}', [AdminServiceController::class, 'update'])->name('services.update');
        Route::delete('/services/{service}', [AdminServiceController::class, 'destroy'])->name('services.destroy');
        Route::get('/services/{service}/view', [AdminServiceController::class, 'view'])->name('services.view');
        Route::post('/services/upload-image', [AdminServiceController::class, 'uploadImage'])->name('services.upload-image');
        Route::post('/editor/image-upload', [AdminServiceController::class, 'uploadEditorImage'])->name('editor.image.upload');




        // BLOGS CRUD
        Route::get('/blogs', [BlogController::class, 'index'])->name('blogs.index');
        Route::get('/blogs/create', [BlogController::class, 'create'])->name('blogs.create');
        Route::post('/blogs', [BlogController::class, 'store'])->name('blogs.store');
        Route::get('/blogs/{blog}/edit', [BlogController::class, 'edit'])->name('blogs.edit');
        Route::put('/blogs/{blog}', [BlogController::class, 'update'])->name('blogs.update');
        Route::delete('/blogs/{blog}', [BlogController::class, 'destroy'])->name('blogs.destroy');
        Route::get('/blogs/{blog}/view', [BlogController::class, 'view'])->name('blogs.view');

        // CATEGORIES CRUD
        Route::get('/categories', [CategoryController::class, 'index'])->name('categories.index');
        Route::get('/categories/create', [CategoryController::class, 'create'])->name('categories.create');
        Route::post('/categories', [CategoryController::class, 'store'])->name('categories.store');
        Route::get('/categories/{category}/edit', [CategoryController::class, 'edit'])->name('categories.edit');
        Route::put('/categories/{category}', [CategoryController::class, 'update'])->name('categories.update');
        Route::delete('/categories/{category}', [CategoryController::class, 'destroy'])->name('categories.destroy');

        // DOCTORS CRUD
        Route::get('/doctors', [DoctorController::class, 'index'])->name('doctors.index');
        Route::get('/doctors/create', [DoctorController::class, 'create'])->name('doctors.create');
        Route::post('/doctors/store', [DoctorController::class, 'store'])->name('doctors.store');
        Route::get('/doctors/{doctor}/edit', [DoctorController::class, 'edit'])->name('doctors.edit');
        Route::put('/doctors/{doctor}/update', [DoctorController::class, 'update'])->name('doctors.update');
        Route::delete('/doctors/{doctor}/delete', [DoctorController::class, 'destroy'])->name('doctors.destroy');

        // ---------- Doctor Availability ----------
        Route::get('/doctors/{doctor}/availability', [DoctorController::class, 'showAvailabilityForm'])->name('doctors.availability');
        Route::post('/doctors/{doctor}/availability', [DoctorController::class, 'saveAvailability'])->name('doctors.saveAvailability');
        Route::post('/doctors/{doctor}/generate-slots', [DoctorController::class, 'generateSlots'])->name('doctors.generateSlots');

        // All Slots
        Route::get('slots/all', [DoctorController::class, 'allSlots'])->name('slots.all');
        Route::delete('slots/{slot}', [DoctorController::class, 'deleteSlot'])->name('slots.delete');

        // DOCTOR SLOTS CRUD
        // Route::get('/slots', [DoctorSlotController::class, 'index'])->name('slots.index');
        // Route::get('/slots/create', [DoctorSlotController::class, 'create'])->name('slots.create');
        // Route::post('/slots/store', [DoctorSlotController::class, 'store'])->name('slots.store');
        // Route::get('/slots/{slot}/edit', [DoctorSlotController::class, 'edit'])->name('slots.edit');
        // Route::put('/slots/{slot}/update', [DoctorSlotController::class, 'update'])->name('slots.update');
        // Route::delete('/slots/{slot}/delete', [DoctorSlotController::class, 'destroy'])->name('slots.destroy');

        // APPOINTMENTS CRUD
        Route::get('/appointments', [AdminAppointmentController::class, 'index'])->name('appointments.index');
        Route::get('/appointments/create', [AdminAppointmentController::class, 'create'])->name('appointments.create');
        Route::post('/appointments', [AdminAppointmentController::class, 'store'])->name('appointments.store');
        Route::get('/appointments/{appointment}/edit', [AdminAppointmentController::class, 'edit'])->name('appointments.edit');
        Route::put('/appointments/{appointment}', [AdminAppointmentController::class, 'update'])->name('appointments.update');
        Route::delete('/appointments/{appointment}', [AdminAppointmentController::class, 'destroy'])->name('appointments.destroy');
        Route::patch('/appointments/{appointment}/status', [AdminAppointmentController::class, 'updateStatus'])->name('appointments.updateStatus');
        Route::get('/appointments/{appointment}', [AdminAppointmentController::class, 'show'])->name('appointments.show');
        Route::get('/appointments/{appointment}/download-pdf', [AdminAppointmentController::class, 'downloadPdf'])->name('appointments.pdf');
        Route::post('/appointments/{appointment}/complete', [AdminAppointmentController::class, 'markComplete'])->name('appointments.complete');



        // Show all treatments
        Route::get('/treatments', [AdminTreatmentController::class, 'index'])->name('treatments.index');
        Route::get('/treatments/create', [AdminTreatmentController::class, 'create'])->name('treatments.create');
        Route::post('/treatments', [AdminTreatmentController::class, 'store'])->name('treatments.store');
        Route::get('/treatments/{treatment}', [AdminTreatmentController::class, 'show'])->name('treatments.show');
        Route::get('/treatments/{treatment}/edit', [AdminTreatmentController::class, 'edit'])->name('treatments.edit');
        Route::put('/treatments/{treatment}', [AdminTreatmentController::class, 'update'])->name('treatments.update');
        Route::delete('/treatments/{treatment}', [AdminTreatmentController::class, 'destroy'])->name('treatments.destroy');
        Route::post('/treatments/upload-image', [AdminTreatmentController::class, 'uploadImage'])->name('treatments.upload-image');
        // Route::post('/treatments/upload-image', [AdminTreatmentController::class, 'uploadImage'])->name('treatments.upload-image');


        Route::get('/consultations', [TreatmentConsultationController::class, 'index'])->name('consultations.index');
        Route::patch('/consultations/{id}/toggle-status', [TreatmentConsultationController::class, 'toggleStatus'])
            ->name('consultations.toggle-status');


        // ENQUIRIES MANAGEMENT
        Route::get('/enquiries', [EnquiryController::class, 'index'])->name('enquiries.index');
        Route::patch('/enquiries/{enquiry}/contacted', [EnquiryController::class, 'updateContacted'])
            ->name('enquiries.updateContacted');
    });

    // ---------------------------
    // USER ROUTES
    // ---------------------------

    Route::middleware(['auth', 'isUser'])->prefix('user')->name('user.')->group(function () {

        // User Home / Dashboard
        Route::get('/dashboard', function () {
            return view('user.dashboard');
        })->name('dashboard');

        // Appointment CRUD
        Route::get('/appointments', [UserAppointmentController::class, 'index'])->name('appointments.index');
        Route::get('/appointments/create', [UserAppointmentController::class, 'create'])->name('appointments.create');
        Route::post('/appointments', [UserAppointmentController::class, 'store'])->name('appointments.store');
        Route::get('/appointments/{appointment}/edit', [UserAppointmentController::class, 'edit'])->name('appointments.edit');
        Route::put('/appointments/{appointment}', [UserAppointmentController::class, 'update'])->name('appointments.update');
        Route::delete('/appointments/{appointment}', [UserAppointmentController::class, 'destroy'])->name('appointments.destroy');
        Route::get('/appointments/{appointment}/summary', [UserAppointmentController::class, 'summary'])->name('appointments.summary');


        // Treatment page
        Route::get('/appointments/{appointment}/treatment', [UserAppointmentController::class, 'treatment'])->name('appointments.treatment');

        // Dynamic slots fetching for AJAX
        Route::get('/doctor/{doctor}/slots', [UserAppointmentController::class, 'getDoctorSlots'])->name('doctor.slots');
    });

    Route::middleware(['auth'])->group(function () {

        // View profile
        Route::get('/profile', [ProfileController::class, 'viewProfile'])->name('profile.view');

        // Edit profile
        Route::get('/profile/edit', [ProfileController::class, 'editProfile'])->name('profile.edit');

        // Update profile
        Route::post('/profile/update', [ProfileController::class, 'updateProfile'])->name('profile.update');

        // Change password form
        Route::get('/profile/change-password', [ProfileController::class, 'changePasswordForm'])->name('profile.change_password_form');

        // Update password
        Route::post('/profile/change-password', [ProfileController::class, 'changePassword'])->name('profile.change_password');
    });

    // ---------------------------
    // FRONTEND ROUTES
    // ---------------------------
    $services = [
        [
            'image' => '/images/2.jpg',
            'title' => 'Cosmetic',
            'label' => 'Enhance Your Beauty',
            'description' => 'Advanced cosmetic procedures to enhance your natural beauty and confidence.',
            'button' => 'View Services',
            'slug' => 'cosmetic',
        ],
        [
            'image' => '/images/2.jpg',
            'title' => 'Skin Care',
            'label' => 'Skin Problems',
            'description' => 'Elevate your beauty game with our cutting-edge hardware cosmetology solutions.',
            'button' => 'View Services',
            'slug' => 'skin-care',
        ],
        [
            'image' => '/images/2.jpg',
            'title' => 'Hair Treatment',
            'label' => 'Hair Loss & Damage',
            'description' => 'Professional treatments to strengthen, rejuvenate, and restore healthy hair.',
            'button' => 'View Services',
            'slug' => 'hair-treatment',
        ],
        [
            'image' => '/images/2.jpg',
            'title' => 'Anti Aging',
            'label' => 'Youthful Skin',
            'description' => 'Effective anti-aging solutions to reduce wrinkles, fine lines, and restore vitality.',
            'button' => 'View Services',
            'slug' => 'anti-aging',
        ],
    ];
});

// Frontend Blog Routes
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/home', [HomeController::class, 'index'])->name('home');
Route::get('/about', [AboutController::class, 'index'])->name('about');
Route::get('/blogs', [UserBlogController::class, 'index'])->name('blogs.index');
Route::get('/blogs/{slug}', [UserBlogController::class, 'show'])->name('blogs.details');
Route::get('/category/{category}', [UserBlogController::class, 'category'])->name('blogs.category');
Route::get('/search/blogs', [UserBlogController::class, 'search'])->name('blogs.search');
Route::post('/enquiry', [EnquiryController::class, 'store'])->name('enquiry.store');

Route::get('/services', [ServiceController::class, 'index'])->name('services.index');
Route::get('/services-details/{slug}', [ServiceController::class, 'show'])->name('services.show');
Route::get('/treatments', [TreatmentController::class, 'index'])->name('treatments.index');
Route::get('/treatments/{slug}', [TreatmentController::class, 'show'])->name('treatments.show');
Route::post('/consultation/store', [TreatmentConsultationController::class, 'store'])->name('consultation.store');
Route::view('/gallery', 'gallery')->name('gallery.page');
