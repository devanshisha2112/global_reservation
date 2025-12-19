<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Online LMS - Learning Management System</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        body {
            font-family: 'Poppins', sans-serif;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            min-height: 100vh;
            overflow-x: hidden;
        }
        
        /* Login Page */
        .login-container {
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 20px;
        }
        .login-box {
            background: white;
            padding: 40px;
            border-radius: 20px;
            box-shadow: 0 20px 60px rgba(0,0,0,0.1);
            width: 100%;
            max-width: 400px;
            text-align: center;
        }
        .logo {
            font-size: 2.5rem;
            color: #667eea;
            margin-bottom: 20px;
        }
        .login-box input {
            width: 100%;
            padding: 15px;
            margin: 10px 0;
            border: 2px solid #e2e8f0;
            border-radius: 12px;
            font-size: 16px;
            transition: all 0.3s;
        }
        .login-box input:focus {
            outline: none;
            border-color: #667eea;
            box-shadow: 0 0 0 3px rgba(102, 126, 234, 0.1);
        }
        .login-btn {
            width: 100%;
            padding: 15px;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            border: none;
            border-radius: 12px;
            font-size: 16px;
            font-weight: 600;
            cursor: pointer;
            transition: transform 0.3s;
        }
        .login-btn:hover {
            transform: translateY(-2px);
        }
        .demo-accounts {
            margin-top: 20px;
            font-size: 14px;
            color: #666;
        }

        /* Dashboard */
        .header {
            background: white;
            padding: 20px 30px;
            box-shadow: 0 5px 20px rgba(0,0,0,0.1);
            position: sticky;
            top: 0;
            z-index: 100;
        }
        .header h1 {
            color: #667eea;
            display: flex;
            align-items: center;
            gap: 10px;
        }
        .user-info {
            display: flex;
            align-items: center;
            gap: 10px;
            background: #f8f9ff;
            padding: 10px 20px;
            border-radius: 50px;
            font-weight: 500;
        }
        .main-content {
            padding: 30px 20px;
            max-width: 1200px;
            margin: 0 auto;
        }
        
        /* Cards Grid */
        .cards-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 25px;
            margin-bottom: 40px;
        }
        .card {
            background: white;
            border-radius: 20px;
            padding: 30px;
            box-shadow: 0 10px 40px rgba(0,0,0,0.1);
            transition: all 0.3s;
            cursor: pointer;
            text-decoration: none;
            color: inherit;
            position: relative;
            overflow: hidden;
        }
        .card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 5px;
            background: linear-gradient(90deg, #667eea, #764ba2);
        }
        .card:hover {
            transform: translateY(-10px);
            box-shadow: 0 20px 60px rgba(0,0,0,0.15);
        }
        .card-icon {
            font-size: 3rem;
            margin-bottom: 20px;
            color: #667eea;
        }
        .card h3 {
            font-size: 1.4rem;
            margin-bottom: 10px;
            color: #2d3748;
        }
        .card p {
            color: #718096;
            line-height: 1.6;
        }

        /* Course List */
        .courses-section {
            background: white;
            border-radius: 20px;
            padding: 30px;
            box-shadow: 0 10px 40px rgba(0,0,0,0.1);
            margin-bottom: 30px;
        }
        .section-title {
            font-size: 1.8rem;
            color: #2d3748;
            margin-bottom: 25px;
            display: flex;
            align-items: center;
            gap: 15px;
        }
        .course-item {
            display: flex;
            align-items: center;
            padding: 20px;
            border: 2px solid #f7fafc;
            border-radius: 15px;
            margin-bottom: 15px;
            transition: all 0.3s;
        }
        .course-item:hover {
            border-color: #667eea;
            background: #f8f9ff;
        }
        .course-info {
            flex: 1;
            margin-left: 20px;
        }
        .course-title {
            font-size: 1.2rem;
            font-weight: 600;
            margin-bottom: 5px;
        }
        .course-meta {
            display: flex;
            gap: 20px;
            font-size: 14px;
            color: #718096;
        }
        .progress-bar {
            width: 100%;
            height: 8px;
            background: #e2e8f0;
            border-radius: 4px;
            overflow: hidden;
            margin-top: 10px;
        }
        .progress-fill {
            height: 100%;
            background: linear-gradient(90deg, #667eea, #764ba2);
            border-radius: 4px;
            transition: width 0.5s;
        }

        /* Stats Cards */
        .stats-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 20px;
            margin-bottom: 40px;
        }
        .stat-card {
            background: white;
            padding: 25px;
            border-radius: 15px;
            text-align: center;
            box-shadow: 0 5px 20px rgba(0,0,0,0.08);
        }
        .stat-number {
            font-size: 2.5rem;
            font-weight: 700;
            background: linear-gradient(135deg, #667eea, #764ba2);
            /* -webkit-background-clip: text; */
            -webkit-text-fill-color: transparent;
            margin-bottom: 10px;
        }

        /* Responsive */
        @media (max-width: 768px) {
            .cards-grid {
                grid-template-columns: 1fr;
            }
            .header {
                padding: 15px 20px;
            }
            .main-content {
                padding: 20px 15px;
            }
            .course-item {
                flex-direction: column;
                text-align: center;
            }
            .course-meta {
                justify-content: center;
            }
        }
    </style>
</head>
<body>
    <!-- Login Page -->
    <div id="loginPage" class="login-container">
        <div class="login-box">
            <div class="logo">
                <i class="fas fa-graduation-cap"></i> Online LMS
            </div>
            <form id="loginForm">
                <input type="text" placeholder="Username" id="username">
                <input type="password" placeholder="Password" id="password">
                <button type="submit" class="login-btn">
                    <i class="fas fa-sign-in-alt"></i> Login
                </button>
            </form>
            <div class="demo-accounts">
                <strong>Demo Accounts:</strong><br>
                admin/admin | teacher1/1234 | student1/1234
            </div>
        </div>
    </div>

    <!-- Admin Dashboard -->
    <div id="adminDashboard" class="dashboard" style="display: none;">
        <div class="header">
            <h1><i class="fas fa-tachometer-alt"></i> Admin Dashboard</h1>
            <div class="user-info">
                <i class="fas fa-user-shield"></i>
                <span>Admin</span>
                <i class="fas fa-sign-out-alt" onclick="showLogin()"></i>
            </div>
        </div>
        <div class="main-content">
            <div class="stats-grid">
                <div class="stat-card">
                    <div class="stat-number">1,247</div>
                    <div>Students</div>
                </div>
                <div class="stat-card">
                    <div class="stat-number">89</div>
                    <div>Courses</div>
                </div>
                <div class="stat-card">
                    <div class="stat-number">24</div>
                    <div>Teachers</div>
                </div>
                <div class="stat-card">
                    <div class="stat-number">95%</div>
                    <div>Completion</div>
                </div>
            </div>
            
            <div class="cards-grid">
                <a href="#" class="card">
                    <div class="card-icon"><i class="fas fa-users"></i></div>
                    <h3>Manage Students</h3>
                    <p>Add, edit, delete student accounts and track progress</p>
                </a>
                <a href="#" class="card">
                    <div class="card-icon"><i class="fas fa-chalkboard-teacher"></i></div>
                    <h3>Manage Teachers</h3>
                    <p>Manage teacher profiles and assign courses</p>
                </a>
                <a href="#" class="card">
                    <div class="card-icon"><i class="fas fa-book"></i></div>
                    <h3>Manage Courses</h3>
                    <p>Create, edit, and organize courses</p>
                </a>
                <a href="#" class="card">
                    <div class="card-icon"><i class="fas fa-chart-bar"></i></div>
                    <h3>Analytics</h3>
                    <p>View performance reports and statistics</p>
                </a>
            </div>
        </div>
    </div>

    <!-- Teacher Dashboard -->
    <div id="teacherDashboard" class="dashboard" style="display: none;">
        <div class="header">
            <h1><i class="fas fa-chalkboard-teacher"></i> Teacher Dashboard</h1>
            <div class="user-info">
                <i class="fas fa-user-tie"></i>
                <span>Teacher 1</span>
                <i class="fas fa-sign-out-alt" onclick="showLogin()"></i>
            </div>
        </div>
        <div class="main-content">
            <div class="cards-grid">
                <a href="#" class="card">
                    <div class="card-icon"><i class="fas fa-book-open"></i></div>
                    <h3>My Courses</h3>
                    <p>View and manage your assigned courses</p>
                </a>
                <a href="#" class="card">
                    <div class="card-icon"><i class="fas fa-users"></i></div>
                    <h3>My Students</h3>
                    <p>Track student progress and performance</p>
                </a>
                <a href="#" class="card">
                    <div class="card-icon"><i class="fas fa-file-alt"></i></div>
                    <h3>Assignments</h3>
                    <p>Create and grade student assignments</p>
                </a>
                <a href="#" class="card">
                    <div class="card-icon"><i class="fas fa-calendar-check"></i></div>
                    <h3>Attendance</h3>
                    <p>Mark student attendance</p>
                </a>
            </div>
            
            <div class="courses-section">
                <h2 class="section-title">
                    <i class="fas fa-list"></i> Active Courses
                </h2>
                <div class="course-item">
                    <i class="fas fa-laptop-code" style="font-size: 3rem; color: #667eea;"></i>
                    <div class="course-info">
                        <div class="course-title">Web Development with PHP</div>
                        <div class="course-meta">
                            <span>45 Students</span>
                            <span>12 Lessons</span>
                            <span>Active</span>
                        </div>
                        <div class="progress-bar">
                            <div class="progress-fill" style="width: 75%;"></div>
                        </div>
                    </div>
                </div>
                <div class="course-item">
                    <i class="fas fa-database" style="font-size: 3rem; color: #764ba2;"></i>
                    <div class="course-info">
                        <div class="course-title">MySQL Database Management</div>
                        <div class="course-meta">
                            <span>32 Students</span>
                            <span>8 Lessons</span>
                            <span>Active</span>
                        </div>
                        <div class="progress-bar">
                            <div class="progress-fill" style="width: 60%;"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Student Dashboard -->
    <div id="studentDashboard" class="dashboard" style="display: none;">
        <div class="header">
            <h1><i class="fas fa-user-graduate"></i> Student Dashboard</h1>
            <div class="user-info">
                <i class="fas fa-user-graduate"></i>
                <span>Student 1</span>
                <i class="fas fa-sign-out-alt" onclick="showLogin()"></i>
            </div>
        </div>
        <div class="main-content">
            <div class="cards-grid">
                <a href="#" class="card">
                    <div class="card-icon"><i class="fas fa-book"></i></div>
                    <h3>My Courses</h3>
                    <p>Continue learning your enrolled courses</p>
                </a>
                <a href="#" class="card">
                    <div class="card-icon"><i class="fas fa-search"></i></div>
                    <h3>Enroll Course</h3>
                    <p>Browse and join new courses</p>
                </a>
                <a href="#" class="card">
                    <div class="card-icon"><i class="fas fa-chart-line"></i></div>
                    <h3>My Progress</h3>
                    <p>Track your learning progress</p>
                </a>
                <a href="#" class="card">
                    <div class="card-icon"><i class="fas fa-calendar"></i></div>
                    <h3>Schedule</h3>
                    <p>View your class schedule</p>
                </a>
            </div>
        </div>
    </div>

    <script>
        // Demo login functionality
        document.getElementById('loginForm').addEventListener('submit', function(e) {
            e.preventDefault();
            const username = document.getElementById('username').value;
            const password = document.getElementById('password').value;
            
            // Demo accounts
            if (username === 'admin' && password === 'admin') {
                showDashboard('admin');
            } else if (username === 'teacher1' && password === '1234') {
                showDashboard('teacher');
            } else if (username === 'student1' && password === '1234') {
                showDashboard('student');
            } else {
                alert('Invalid credentials! Try: admin/admin, teacher1/1234, student1/1234');
            }
        });

        function showDashboard(role) {
            document.getElementById('loginPage').style.display = 'none';
            document.getElementById(role + 'Dashboard').style.display = 'block';
            document.body.scrollTop = 0;
        }

        function showLogin() {
            document.querySelectorAll('.dashboard').forEach(d => d.style.display = 'none');
            document.getElementById('loginPage').style.display = 'flex';
        }
    </script>
</body>
</html>