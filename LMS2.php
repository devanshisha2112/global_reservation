<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>LMS Learner Dashboard</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
</head>
<body class="bg-gray-100 font-sans">

    <div class="flex h-screen">
        <aside class="w-64 bg-indigo-900 text-white hidden md:flex flex-col">
            <div class="p-6 text-2xl font-bold border-b border-indigo-800">EduStream</div>
            <nav class="flex-1 p-4 space-y-2">
                <a href="#" class="block py-2.5 px-4 rounded bg-indigo-700"> <i class="fas fa-home mr-2"></i> Dashboard</a>
                <a href="#" class="block py-2.5 px-4 rounded hover:bg-indigo-800"> <i class="fas fa-book mr-2"></i> My Courses</a>
                <a href="#" class="block py-2.5 px-4 rounded hover:bg-indigo-800"> <i class="fas fa-graduation-cap mr-2"></i> Certificates</a>
                <a href="#" class="block py-2.5 px-4 rounded hover:bg-indigo-800"> <i class="fas fa-cog mr-2"></i> Settings</a>
            </nav>
        </aside>

        <main class="flex-1 flex flex-col overflow-hidden">
            <header class="bg-white shadow-sm p-4 flex justify-between items-center">
                <h2 class="text-xl font-semibold text-gray-700">Welcome Back, Student!</h2>
                <div class="flex items-center space-x-4">
                    <span class="text-gray-600 font-medium">Progress: 65%</span>
                    <div class="w-10 h-10 rounded-full bg-indigo-500 flex items-center justify-center text-white">JD</div>
                </div>
            </header>

            <div class="flex-1 overflow-y-auto p-6">
                <h3 class="text-2xl font-bold mb-6">Current Courses</h3>
                
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                    <div class="bg-white rounded-xl shadow-md overflow-hidden hover:shadow-lg transition">
                        <div class="h-40 bg-indigo-200 flex items-center justify-center">
                            <i class="fas fa-code fa-3x text-indigo-600"></i>
                        </div>
                        <div class="p-4">
                            <h4 class="font-bold text-lg">Intro to Web Development</h4>
                            <p class="text-gray-500 text-sm mb-4">Instructor: Alex Smith</p>
                            <div class="w-full bg-gray-200 rounded-full h-2 mb-4">
                                <div class="bg-green-500 h-2 rounded-full" style="width: 80%"></div>
                            </div>
                            <button onclick="alert('Loading Lesson...')" class="w-full bg-indigo-600 text-white py-2 rounded-lg hover:bg-indigo-700">Continue Learning</button>
                        </div>
                    </div>

                    <div class="bg-white rounded-xl shadow-md overflow-hidden hover:shadow-lg transition">
                        <div class="h-40 bg-pink-200 flex items-center justify-center">
                            <i class="fas fa-paint-brush fa-3x text-pink-600"></i>
                        </div>
                        <div class="p-4">
                            <h4 class="font-bold text-lg">UI/UX Design Basics</h4>
                            <p class="text-gray-500 text-sm mb-4">Instructor: Sarah Doe</p>
                            <div class="w-full bg-gray-200 rounded-full h-2 mb-4">
                                <div class="bg-yellow-500 h-2 rounded-full" style="width: 30%"></div>
                            </div>
                            <button class="w-full bg-indigo-600 text-white py-2 rounded-lg hover:bg-indigo-700">Resume Course</button>
                        </div>
                    </div>
                </div>

                <div class="mt-10 bg-white p-6 rounded-xl shadow-sm border border-gray-100">
                    <h3 class="font-bold text-xl mb-4">Your Learning Flow</h3>
                    
                    <ul class="space-y-4">
                        <li class="flex items-center text-gray-700">
                            <span class="w-8 h-8 bg-indigo-100 text-indigo-600 rounded-full flex items-center justify-center mr-3 font-bold">1</span>
                            Browse & Enroll in Courses
                        </li>
                        <li class="flex items-center text-gray-700">
                            <span class="w-8 h-8 bg-indigo-100 text-indigo-600 rounded-full flex items-center justify-center mr-3 font-bold">2</span>
                            Watch Videos & Complete Assignments
                        </li>
                        <li class="flex items-center text-gray-700">
                            <span class="w-8 h-8 bg-indigo-100 text-indigo-600 rounded-full flex items-center justify-center mr-3 font-bold">3</span>
                            Take Quizzes & Final Exam
                        </li>
                    </ul>
                </div>
            </div>
        </main>
    </div>

</body>
</html>