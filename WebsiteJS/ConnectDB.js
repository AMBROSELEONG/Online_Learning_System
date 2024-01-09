const DB_NAME = 'online_learning_system'; // Database Name
const DB_VERSION = 1; // Database Version

let db;

// Open Database
const request = indexedDB.open(DB_NAME, DB_VERSION);

request.onupgradeneeded = function (event) {
    const db = event.target.result;

    // Course Catefory
    const coursecategory = db.createObjectStore('coursecategory', { keyPath: 'CategoryID', autoIncrement: true });
    coursecategory.createIndex('CategoryName', 'CategoryName', { unique: false });

    // Course
    const course = db.createObjectStore('course', { keyPath: 'CourseID', autoIncrement: true });
    course.createIndex('CourseImage', 'CourseImage', { unique: false });
    course.createIndex('CourseName', 'CourseName', { unique: false });
    course.createIndex('CoursePrice', 'CoursePrice', { unique: false });
    course.createIndex('CategoryID', 'CategoryID', { unique: false });
    course.createIndex('CategoryName', 'CategoryName', { unique: false });

    // Lecturer
    const lecturer = db.createObjectStore('lecturer', { keyPath: 'LecturerID', autoIncrement: true });
    lecturer.createIndex('LecturerImage', 'LecturerImage', { unique: false });
    lecturer.createIndex('LecturerName', 'LecturerName', { unique: false });
    lecturer.createIndex('LecturerQualification', 'LecturerQualification', { unique: false });
    lecturer.createIndex(' CourseID', 'CourseID', { unique: false });
    lecturer.createIndex('CourseName', 'CourseName', { unique: false });

    // Lecturer Detail
    const lecturerdetail = db.createObjectStore('lecturerdetail', { keyPath: 'LecturerDetailID', autoIncrement: true });
    lecturerdetail.createIndex('LecturerID', 'LecturerID', { unique: false });
    lecturerdetail.createIndex('LecturerName', 'LecturerName', { unique: false });
    lecturerdetail.createIndex('Professional', 'Professional', { unique: false });
    lecturerdetail.createIndex('CourseID', 'CourseID', { unique: false });
    lecturerdetail.createIndex('CourseName', 'CourseName', { unique: false });
    lecturerdetail.createIndex('Country', 'Country', { unique: false });
    lecturerdetail.createIndex('Github', 'Github', { unique: false });
    lecturerdetail.createIndex('Twitter', 'Twitter', { unique: false });
    lecturerdetail.createIndex('Instagram', 'Instagram', { unique: false });
    lecturerdetail.createIndex('Facebook', 'Facebook', { unique: false });
    lecturerdetail.createIndex('LecturerQualification', 'LecturerQualification', { unique: false });
    lecturerdetail.createIndex('LecturerDescription', 'LecturerDescription', { unique: false });
    lecturerdetail.createIndex('LecturerEmail', 'LecturerEmail', { unique: false });
    lecturerdetail.createIndex('Phone', 'Phone', { unique: false });
    lecturerdetail.createIndex('Introduction', 'Introduction', { unique: false });

    // Course Detail
    const coursedetail = db.createObjectStore('coursedetail', { keyPath: 'CourseDetail', autoIncrement: true });
    coursedetail.createIndex('CourseID', 'CourseID', { unique: false });
    coursedetail.createIndex('CourseImage', 'CourseImage', { unique: false });
    coursedetail.createIndex('CourseName', 'CourseName', { unique: false });
    coursedetail.createIndex('CoursePrice', 'CoursePrice', { unique: false });
    coursedetail.createIndex('CourseDescription', 'CourseDescription', { unique: false });
    coursedetail.createIndex('CategoryID', 'CategoryID', { unique: false });
    coursedetail.createIndex('CategoryName', 'CategoryName', { unique: false });
    coursedetail.createIndex('LecturerID', 'LecturerID', { unique: false });
    coursedetail.createIndex('LecturerName', 'LecturerName', { unique: false });
    coursedetail.createIndex('LecturerQualification', 'LecturerQualification', { unique: false });
    coursedetail.createIndex('StudyDuration', 'StudyDuration', { unique: false });
    coursedetail.createIndex('LearningPlatform', 'LearningPlatform', { unique: false });
    coursedetail.createIndex('LearningResult', 'LearningResult', { unique: false });
    coursedetail.createIndex('CourseOutline', 'CourseOutline', { unique: false });

    // Quiz Category
    const quizcategory = db.createObjectStore('quizcategory', { keyPath: 'CategoryID', autoIncrement: true });
    quizcategory.createIndex('CategoryName', 'CategoryName', { unique: false });

    // Quiz
    const quiz = db.createObjectStore('quiz', { keyPath: 'QuizID', autoIncrement: true });
    quiz.createIndex('QuizImage', 'QuizImage', { unique: false });
    quiz.createIndex('QuizName', 'QuizName', { unique: false });
    quiz.createIndex('CategoryID', 'CategoryID', { unique: false });
    quiz.createIndex('CategoryName', 'CategoryName', { unique: false });

    // Quiz Question
    const quizquestion = db.createObjectStore('quizquestion', { keyPath: 'QuestionID', autoIncrement: true });
    quizquestion.createIndex('QuizID', 'QuizID', { unique: false });
    quizquestion.createIndex('QuestionOne', 'QuestionOne', { unique: false });
    quizquestion.createIndex('OptOne1', 'OptOne1', { unique: false });
    quizquestion.createIndex('OptOne2', 'OptOne2', { unique: false });
    quizquestion.createIndex('OptOne3', 'OptOne3', { unique: false });
    quizquestion.createIndex('AnsOne', 'AnsOne', { unique: false });
    quizquestion.createIndex('QuestionTwo', 'QuestionTwo', { unique: false });
    quizquestion.createIndex('OptTwo1', 'OptTwo1', { unique: false });
    quizquestion.createIndex('OptTwo2', 'OptTwo2', { unique: false });
    quizquestion.createIndex('OptTwo3', 'OptTwo3', { unique: false });
    quizquestion.createIndex('AnsTwo', 'AnsTwo', { unique: false });
    quizquestion.createIndex('QuestionThree', 'QuestionThree', { unique: false });
    quizquestion.createIndex('OptThree1', 'OptThree1', { unique: false });
    quizquestion.createIndex('OptThree2', 'OptThree2', { unique: false });
    quizquestion.createIndex('OptThree3', 'OptThree3', { unique: false });
    quizquestion.createIndex('AnsThree', 'AnsThree', { unique: false });
    quizquestion.createIndex('QuestionFour', 'QuestionFour', { unique: false });
    quizquestion.createIndex('OptFour1', 'OptFour1', { unique: false });
    quizquestion.createIndex('OptFour2', 'OptFour2', { unique: false });
    quizquestion.createIndex('OptFour3', 'OptFour3', { unique: false });
    quizquestion.createIndex('AnsFour', 'AnsFour', { unique: false });

    // User
    const users = db.createObjectStore('users', { keyPath: 'UserID', autoIncrement: true });
    users.createIndex('UserName', 'UserName', { unique: false });
    users.createIndex('PasswordHash', 'PasswordHash', { unique: false });
    users.createIndex('Email', 'Email', { unique: false });
    users.createIndex('ContactNumber', 'ContactNumber', { unique: false });

    // Comment
    const comment = db.createObjectStore('comments', { keyPath: 'CommentID', autoIncrement: true });
    comment.createIndex('UserID', 'UserID', { unique: false });
    comment.createIndex('UserName', 'UserName', { unique: false });
    comment.createIndex('CourseName', 'CourseName', { unique: false });
    comment.createIndex('Content', 'Content', { unique: false });
    comment.createIndex('PostDate', 'PostDate', { unique: false });

    // Contact
    const contact = db.createObjectStore('contact', { keyPath: 'ContactID', autoIncrement: true });
    contact.createIndex('UserID', 'UserID', { unique: false });
    contact.createIndex('UserName', 'UserName', { unique: false });
    contact.createIndex('ContactNumber', 'ContactNumber', { unique: false });
    contact.createIndex('Email', 'Email', { unique: false });
    contact.createIndex('Message', 'Message', { unique: false });
    contact.createIndex('ReplyStatus', 'ReplyStatus', { unique: false });

    // Email
    const email = db.createObjectStore('email', { keyPath: 'ReplyID', autoIncrement: true });
    email.createIndex('UserID', 'UserID', { unique: false });
    email.createIndex('UserName', 'UserName', { unique: false });
    email.createIndex('ContactNumber', 'ContactNumber', { unique: false });
    email.createIndex('Email', 'Email', { unique: false });
    email.createIndex('Message', 'Message', { unique: false });
    email.createIndex('Title', 'Title', { unique: false });
    email.createIndex('ReplyMessage', 'ReplyMessage', { unique: false });
    email.createIndex('ReplyDate', 'ReplyDate', { unique: false });

    // Cart
    const cart = db.createObjectStore('shoppingcart', { keyPath: 'InvoiceID', autoIncrement: true });
    cart.createIndex('UserID', 'UserID', { unique: false });
    cart.createIndex('CourseID', 'CourseID', { unique: false });
    cart.createIndex('CourseName', 'CourseName', { unique: false });
    cart.createIndex('CategoryName', 'CategoryName', { unique: false });
    cart.createIndex('CoursePrice', 'CoursePrice', { unique: false });

    // Order
    const order = db.createObjectStore('orders', { keyPath: 'OrderID', autoIncrement: true });
    order.createIndex('UserID', 'UserID', { unique: false });
    order.createIndex('CartID', 'CartID', { unique: false });
    order.createIndex('CourseID', 'CourseID', { unique: false });
    order.createIndex('CourseName', 'CourseName', { unique: false });
    order.createIndex('CoursePrice', 'CoursePrice', { unique: false });
    order.createIndex('OrderDate', 'OrderDate', { unique: false });

    // User History
    const history = db.createObjectStore('userhistory', { keyPath: 'CartID', autoIncrement: true });
    history.createIndex('OrderID', 'OrderID', { unique: false });
    history.createIndex('UserID', 'UserID', { unique: false });
    history.createIndex('CourseID', 'CourseID', { unique: false });
    history.createIndex('CourseName', 'CourseName', { unique: false });
    history.createIndex('CoursePrice', 'CoursePrice', { unique: false });
    history.createIndex('OrderDate', 'OrderDate', { unique: false });

    // User Profile
    const profile = db.createObjectStore('userprofile', { keyPath: 'ProfileID', autoIncrement: true });
    profile.createIndex('UserID', 'UserID', { unique: false });
    profile.createIndex('UserName', 'UserName', { unique: false });
    profile.createIndex('CollegeName', 'CollegeName', { unique: false });
    profile.createIndex('Email', 'Email', { unique: false });
    profile.createIndex('Phone', 'Phone', { unique: false });
    profile.createIndex('About', 'About', { unique: false });

    // Reset Password
    const reset = db.createObjectStore('userresetpassword', { keyPath: 'ResetID', autoIncrement: true });
    reset.createIndex('UserID', 'UserID', { unique: false });
    reset.createIndex('UserName', 'UserName', { unique: false });
    reset.createIndex('NewPassword', 'NewPassword', { unique: false });
    reset.createIndex('Email', 'Email', { unique: false });
    reset.createIndex('ResetDate', 'ResetDate', { unique: false });

    // User Resume
    const resume = db.createObjectStore('userresume', { keyPath: 'ResumeID', autoIncrement: true });
    resume.createIndex('UserID', 'UserID', { unique: false });
    resume.createIndex('Experience', 'Experience', { unique: false });
    resume.createIndex('Education', 'Education', { unique: false });
    resume.createIndex('Skill', 'Skill', { unique: false });
    resume.createIndex('Language_', 'Language_', { unique: false });

    // Admin
    const admin = db.createObjectStore('admin', { keyPath: 'AdminID', autoIncrement: true });
    admin.createIndex('UserName', 'UserName', { unique: false });
    admin.createIndex('Email', 'Email', { unique: false });
    admin.createIndex('Password', 'Password', { unique: false });
    admin.createIndex('ContactNumber', 'ContactNumber', { unique: false });
    admin.createIndex('IC', 'IC', { unique: false });
    admin.createIndex('Occupation', 'Occupation', { unique: false });
};

// Connect Database
request.onsuccess = function (event) {
    db = event.target.result;
};

// Error process
request.onerror = function (event) {
    console.error("Database error: " + event.target.errorCode);
};