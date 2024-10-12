<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use Inertia\Inertia;
use App\Models\TeachersInformation;
use App\Models\User;

Route::get('/', function () {
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
});

Route::get('/dashboard', function () {
    return Inertia::render('Dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');


Route::get('/teacher-registration', function () {
    $userId = Auth::id(); // Retrieve the logged-in user's ID
    return Inertia::render('Teacher', ['user_id' => $userId]);
})->name('teacher-registration'); 






Route::get('/view-teachers', function () {
    $teachers = TeachersInformation::all(); // Fetch only teachers
    return Inertia::render('ViewTeacher', [
        'teachers' => $teachers,
    ]);
})->name('view-teachers');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});



// Teacher Registration Submission
Route::post('/teacher-reg', function (Request $request) {
    // Validate the form data
    $validatedData = $request->validate([
        'teacher_name' => 'required|string|max:255',
        'teacher_email' => 'required|email|unique:teachers_information,teacher_email',
        'teacher_password' => 'required|string|min:8',
        'teacher_role' => 'required|string',
        'user_id' => 'required|exists:users,id', // Updated this line
    ]);

    // Hash the password before storing
    $validatedData['teacher_password'] = bcrypt($validatedData['teacher_password']);

    // Save the teacher's data into the database
    TeachersInformation::create($validatedData);

    // Redirect back to the registration page with a success message
    return redirect()->route('teacher-registration')->with('success', 'Teacher registered successfully!'); // Corrected this line
});




require __DIR__.'/auth.php';
