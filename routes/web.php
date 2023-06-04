<?php

use App\Http\Controllers\AcademicYearController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\ArchiveController;
use App\Http\Controllers\ClassScoreController;
use App\Http\Controllers\ExamController;
use App\Http\Controllers\ExamScoreController;
use App\Http\Controllers\ExerciseController;
use App\Http\Controllers\ExpenseController;
use App\Http\Controllers\LegalController;
use App\Http\Controllers\ReportCardController;
use App\Http\Controllers\ReportCommentController;
use App\Http\Controllers\SmsController;
use App\Http\Controllers\StaffController;
use App\Http\Controllers\TermController;
use App\Models\SchoolSettings;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\StudentsController;
use App\Http\Controllers\StudentLevelController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SubjectsController;
use App\Http\Controllers\DepartmentController;
use App\Http\Controllers\BillingController;
use App\Http\Controllers\SchoolController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\CalendarController;
use App\Http\Controllers\SocialSecurityController;
use App\Http\Controllers\TaxController;
use App\Http\Controllers\StaffTaxController;
use App\Http\Controllers\PayrollController;
use App\Http\Controllers\AttendanceController;
use App\Http\Controllers\TeacherController;
use App\Http\Controllers\MessageController;
use App\Http\Controllers\PromotionController;
use App\Http\Controllers\GuardianController;
use App\Http\Controllers\ParentController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/


Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

// Protected by the 'auth' middleware, meaning only authenticated users can access these routes
Route::middleware('auth')->group(function () {
    Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

    // Protected by the 'admin' middleware, meaning only users with the 'admin' role can access these routes
    Route::middleware('admin')->group(function () {
        Route::resource('users', AdminController::class);
        Route::resource('students', StudentsController::class);
        Route::resource('levels', StudentLevelController::class);
        Route::resource('departments', DepartmentController::class);
        Route::get('academy', [DepartmentController::class, 'academy'])->name('academy');
        Route::resource('subjects', SubjectsController::class);
        Route::resource('billings', BillingController::class);
        Route::resource('terms', TermController::class);
        Route::resource('exams', ExamController::class);
        Route::resource('academic_years', AcademicYearController::class);
        Route::resource('staff', StaffController::class);
        Route::resource('expenses', ExpenseController::class);
        Route::resource('social-securities', SocialSecurityController::class);
        Route::resource('taxes', TaxController::class);
        Route::resource('staff_taxes', StaffTaxController::class);
        Route::get('/dashboard',[AdminController::class, 'dashboard'])->name('dashboard.index');
        Route::resource('parents', GuardianController::class);

        //REPORTS ROUTES ===== social security
        Route::get('/social-security/report', [SocialSecurityController::class, 'generateReport'])->name('social-securities.report');
        Route::get('/social-security/generate', [SocialSecurityController::class, 'generate'])->name('contribution_report.generate');

        //REPORTS ROUTES ===== staff tax
        Route::get('/staff-taxes/report', [StaffTaxController::class, 'generateReport'])->name('staff_taxes.report');
        Route::get('/staff-taxes/generate', [StaffTaxController::class, 'generate'])->name('staff_taxes_report.generate');

        //REPORTS ROUTES ===== payroll
        Route::get('/payroll-report/report', [PayrollController::class, 'generateReport'])->name('payroll.report');
        Route::get('/payroll-report/generate', [PayrollController::class, 'generate'])->name('payroll.generate');

        //Payroll Routes
        Route::get('/payrolls', [PayrollController::class, 'index'])->name('payrolls.index');
        Route::get('/payrolls/create', [PayrollController::class, 'create'])->name('payrolls.create');
        Route::post('/payrolls', [PayrollController::class, 'store'])->name('payrolls.store');
        Route::get('/payrolls/{payroll}/edit', [PayrollController::class, 'edit'])->name('payrolls.edit');
        Route::put('/payrolls/{payroll}', [PayrollController::class, 'update'])->name('payrolls.update');
        Route::delete('/payrolls/{payroll}', [PayrollController::class, 'destroy'])->name('payrolls.destroy');


        //Payment Routes
        Route::get('/payments', [PaymentController::class, 'index'])->name('payments.index');
        Route::get('/payments/{id}', [PaymentController::class, 'show'])->name('payments.show');
        Route::get('/billings/{billingId}/payments/create', [PaymentController::class,'create'])->name('payments.create');
        Route::post('/billings/{billingId}/payments', [PaymentController::class,'store'])->name('payments.store');
        Route::delete('/payments/{id}', [PaymentController::class,'destroy'])->name('payments.destroy');
        Route::post('/print-receipt', [PaymentController::class, 'printReceipt'])->name('payments.printReceipt');

        //Exercise Routes

        Route::get('/exercises', [ExerciseController::class, 'index'])->name('exercises.index');
        Route::get('/exercises/create', [ExerciseController::class, 'create'])->name('exercises.create');
        Route::post('/exercises', [ExerciseController::class, 'store'])->name('exercises.store');
        Route::get('/exercises/{exercise}', [ExerciseController::class, 'show'])->name('exercises.show');
        Route::get('/exercises/{exercise}/edit', [ExerciseController::class, 'edit'])->name('exercises.edit');
        Route::put('/exercises/{exercise}', [ExerciseController::class, 'update'])->name('exercises.update');
        Route::delete('/exercises/{exercise}', [ExerciseController::class, 'destroy'])->name('exercises.destroy');

        //Exam score & Class score routes
        Route::get('examination/create', [ExamScoreController::class, 'create']) ->name('exam-scores.create');
        Route::post('/exam-scores', [ExamScoreController::class, 'store'])->name('exam-scores.store');
        Route::get('class/create', [ClassScoreController::class, 'create']) ->name('class-scores.create');
        Route::post('/class-scores', [ClassScoreController::class, 'store'])->name('class-scores.store');

        //Report Card Routes
        Route::get('/select-exam', [ReportCardController::class, 'showSelectExamView'])->name('select_exam');
        Route::get('/report-card/generate', [ReportCardController::class, 'generate'])->name('report_card.generate');

        //Attendance Routes
        Route::get('/attendance', [AttendanceController::class, 'index'])->name('attendance.index');
        Route::post('attendance/store', [AttendanceController::class, 'store'])->name('store.attendance');

        //Settings Routes
        Route::get('/school/profile', [SchoolController::class, 'showProfile'])->name('school.profile');
        Route::get('/school/settings', [SchoolController::class, 'showSettingsForm'])->name('school.settings.form');
        Route::put('/school/settings', [SchoolController::class, 'saveSettings'])->name('school.settings.update');

        //Promotions
        Route::get('promotion', [PromotionController::class, 'index'])->name('promotion.index');
        Route::post('promotion/promote', [PromotionController::class, 'promote'])->name('promotion.promote');

        //Calendar
        Route::get('/calendar', [CalendarController::class, 'index']);
        Route::get('/calendar/events', [CalendarController::class, 'events']);
        Route::post('/calendar/store', [CalendarController::class, 'store']);
        Route::patch('/calendar/update/{id}', [CalendarController::class, 'update']);
        Route::delete('/calendar/destroy/{id}', [CalendarController::class, 'destroy']);

        //SMS Messaging
        Route::get('/sms/create', [SmsController::class, 'create'])->name('sms.create');
        Route::post('/sms/send', [SmsController::class, 'send'])->name('sms.send');

        //Archives
        Route::get('/archived', [StudentsController::class, 'archived'])->name('archived');
        Route::get('/archived/{id}', [ArchiveController::class, 'show'])->name('archived.show');
        Route::get('/archive/{id}/edit', [ArchiveController::class, 'edit'])->name('archived.edit');
        Route::put('/archive/{student}', [ArchiveController::class, 'update'])->name('archived.update');

        Route::get('admin', function () {
            return redirect()->route('dashboard.index');
        })->name('admin')->middleware('disableback');
    });

    // Protected by the 'teacher' middleware, meaning only users with the 'teacher' role can access these routes
    Route::middleware('teacher')->group(function () {
                //Attendance Routes
                Route::get('/student_list', [TeacherController::class, 'my_list'])->name('list.students');
                Route::get('/take_attendance', [TeacherController::class, 'teacherIndex'])->name('get_attendance.index');
                Route::post('/take_attendance', [TeacherController::class, 'teacherStore'])->name('get_attendance.store');
                Route::get('/attendance_report', [TeacherController::class, 'reportIndex'])->name('attendance_report.index');
                Route::post('/attendance', [TeacherController::class, 'getAttendance'])->name('attendance.get');

                //Exercise Routes
                Route::get('/marks', [TeacherController::class, 'index'])->name('marks.index');
                Route::get('/exercise/create', [TeacherController::class, 'exeCreate'])->name('exe.create');
                Route::post('/exercise', [TeacherController::class, 'exeStore'])->name('exe.store');

                //Exam score & Class score routes
                Route::get('exam_score/create', [TeacherController::class, 'escoreCreate']) ->name('exam_scores.create');
                Route::post('/exam_scores', [TeacherController::class, 'escoreStore'])->name('exam_scores.store');
                Route::get('class_score/create', [TeacherController::class, 'cscoreCreate']) ->name('class_scores.create');
                Route::post('/class_scores', [TeacherController::class, 'cscoreStore'])->name('class_scores.store');


                //Report card comments routes
                Route::get('/comments', [TeacherController::class, 'commnetIndex'])->name('teacherComments.index');
                Route::get('/comments/create', [TeacherController::class, 'commentCreate'])->name('teacherComments.create');
                Route::post('/comments', [TeacherController::class, 'commentStore'])->name('teacherComments.store');
                Route::get('/comments/{id}/edit', [TeacherController::class, 'commentEdit'])->name('teacherComments.edid');
                Route::put('/comments/{id}/update', [TeacherController::class, 'commentUpdate'])->name('teacherComments.update');


                //Messages
                Route::get('/message', [TeacherController::class, 'meSindex'])->name('mes.index');
                Route::get('/message/create', [TeacherController::class, 'meScreate'])->name('mes.create');
                Route::post('message', [TeacherController::class, 'meSstore'])->name('mes.store');
                Route::get('/message/{id}', [TeacherController::class, 'meShow'])->name('mes.show');

        Route::get('teacher', function () {
            return view('teacher');
        })->name('teacher')->middleware('disableback');

    });

    // Protected by the 'guardian' middleware, meaning only users with the 'guardian' role can access these routes
    Route::middleware('guardian')->group(function () {

                //Attendance
                Route::get('/student_attendance', [ParentController::class, 'attendanceIndex'])->name('student_attendance.index');
                Route::get('/student_attendance/{student}/events', [ParentController::class, 'getAttendanceEvents'])->name('attendance.events');



        Route::get('guardian', function () {
            return view('guardian');
        })->name('guardian')->middleware('disableback');
    });

    // Protected by the 'user' middleware, meaning only users with the 'user' role can access these routes
    Route::middleware('user')->group(function () {


        Route::get('user', function () {
            return view('user');
        })->name('user')->middleware('disableback');
    });

    Route::middleware('auth')->group(function () {
        Route::get('/user_profile/{profile?}', [ProfileController::class, 'show'])->name('profile.show');
        Route::get('/profile/{profile?}', [ProfileController::class, 'adminShow'])->name('admin_profile.show');
        Route::put('/user_profile/{id}', [ProfileController::class, 'update'])->name('profile.update');

        Route::get('/search', 'App\Http\Controllers\StudentsController@search');
        Route::get('/get-students/{level_id}', [BillingController::class, 'getStudents'])->name('get-students');
        Route::get('/get-ssnit-number/{id}', [SocialSecurityController::class, 'getSsnitNumber']);
        Route::get('/get-basic-salary/{staff_id}', [StaffTaxController::class, 'getBasicSalary']);
        Route::get('/payrolls/get-staff-data', [PayrollController::class, 'getStaffData'])->name('payrolls.getStaffData');

        //balances
        Route::get('/student-balances', [StudentsController::class, 'showStudentBalances'])->name('student-balances');

        //Messages
        Route::resource('messages', MessageController::class)->except(['edit', 'update', 'destroy']);

        //Image Upload
        Route::put('/upload-photo/{id}', [StudentsController::class, 'updatePhoto'])->name('upload.photo');
        Route::put('/upload-logo', [SchoolController::class, 'updateLogo'])->name('upload.logo');

        //Report Comments
        Route::get('report-comments', [ReportCommentController::class, 'index'])->name('comment.index');
        Route::get('report-comments/create', [ReportCommentController::class, 'create'])->name('comment.create');
        Route::post('report-comments', [ReportCommentController::class, 'store'])->name('comment.store');
        Route::get('report-comments/{id}', [ReportCommentController::class, 'index'])->name('comment.edit');
        Route::put('report-comments/{id}', [ReportCommentController::class, 'update'])->name('comment.update');
        Route::delete('report-comments/{id}', [ReportCommentController::class, 'delete'])->name('comment.delete');

        Route::get('privacy_policy', [LegalController::class, 'privacy_policy'])->name('privacy_policy');
        Route::get('terms_of_use', [LegalController::class, 'terms_of_use'])->name('terms_of_use');

    });

}); 
