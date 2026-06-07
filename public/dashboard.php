<?php
/**
 * Dashboard - Main page after login
 */

require_once __DIR__ . '/../config/Security.php';
require_once __DIR__ . '/../classes/Project.php';
require_once __DIR__ . '/../classes/Task.php';

Security::startSecureSession();

// Check if user is logged in
if (!isset($_SESSION['user_trgm'])) {
    header('Location: login.php');
    exit;
}

$projectClass = new Project();
$taskClass = new Task();

// Get user data
$user_name = $_SESSION['user_name'];
$user_trgm = $_SESSION['user_trgm'];

// Get projects and tasks
$projects = $projectClass->getProjectsByOwner($user_trgm);
$tasks = $taskClass->getTasksByOwner($user_trgm);
$overdue_tasks = $taskClass->getOverdueTasks();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - CPMS</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.0/dist/chart.umd.js"></script>
    <style>
        :root {
            --primary: #667eea;
            --secondary: #764ba2;
            --success: #48bb78;
            --danger: #f56565;
            --warning: #ed8936;
            --info: #4299e1;
        }
        
        body {
            background-color: #f7fafc;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }
        
        .navbar {
            background: linear-gradient(135deg, var(--primary) 0%, var(--secondary) 100%);
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
        }
        
        .sidebar {
            background: white;
            min-height: 100vh;
            padding: 20px;
            box-shadow: 2px 0 10px rgba(0,0,0,0.05);
        }
        
        .sidebar .nav-link {
            color: #4a5568;
            margin: 10px 0;
            border-radius: 5px;
            transition: all 0.3s ease;
        }
        
        .sidebar .nav-link:hover {
            background-color: #edf2f7;
            color: var(--primary);
        }
        
        .sidebar .nav-link.active {
            background: linear-gradient(135deg, var(--primary) 0%, var(--secondary) 100%);
            color: white;
        }
        
        .stat-card {
            background: white;
            border-radius: 10px;
            padding: 20px;
            margin-bottom: 20px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.05);
            transition: transform 0.3s ease;
        }
        
        .stat-card:hover {
            transform: translateY(-5px);
        }
        
        .stat-value {
            font-size: 32px;
            font-weight: 700;
            color: var(--primary);
        }
        
        .stat-label {
            font-size: 14px;
            color: #718096;
            margin-top: 10px;
        }
        
        .chart-container {
            background: white;
            border-radius: 10px;
            padding: 20px;
            margin-bottom: 20px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.05);
        }
        
        .content {
            padding: 30px;
        }
        
        .task-item {
            background: white;
            border-radius: 5px;
            padding: 15px;
            margin-bottom: 10px;
            border-left: 4px solid var(--info);
        }
        
        .project-item {
            background: white;
            border-radius: 5px;
            padding: 15px;
            margin-bottom: 10px;
            border-left: 4px solid var(--success);
        }
    </style>
</head>
<body>
    <!-- Navigation -->
    <nav class="navbar navbar-expand-lg navbar-dark">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">
                <i class="fas fa-chart-line"></i> CPMS Dashboard
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="userMenu" role="button" data-bs-toggle="dropdown">
                            <i class="fas fa-user-circle"></i> <?php echo htmlspecialchars($user_name); ?>
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="userMenu">
                            <li><a class="dropdown-item" href="#"><i class="fas fa-user"></i> Profile</a></li>
                            <li><a class="dropdown-item" href="#"><i class="fas fa-cog"></i> Settings</a></li>
                            <li><hr class="dropdown-divider"></li>
                            <li><a class="dropdown-item" href="logout.php"><i class="fas fa-sign-out-alt"></i> Logout</a></li>
                        </ul>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    
    <div class="container-fluid">
        <div class="row">
            <!-- Sidebar -->
            <nav class="col-md-2 sidebar">
                <div class="nav flex-column">
                    <a class="nav-link active" href="dashboard.php">
                        <i class="fas fa-home"></i> Dashboard
                    </a>
                    <a class="nav-link" href="projects.php">
                        <i class="fas fa-project-diagram"></i> Projects
                    </a>
                    <a class="nav-link" href="tasks.php">
                        <i class="fas fa-tasks"></i> My Tasks
                    </a>
                    <a class="nav-link" href="reports.php">
                        <i class="fas fa-chart-bar"></i> Reports
                    </a>
                </div>
            </nav>
            
            <!-- Main Content -->
            <main class="col-md-10 content">
                <h1 class="mb-4">Welcome, <?php echo htmlspecialchars($user_name); ?>! 👋</h1>
                
                <!-- Statistics Row -->
                <div class="row mb-4">
                    <div class="col-md-3">
                        <div class="stat-card">
                            <div class="d-flex justify-content-between align-items-start">
                                <div>
                                    <div class="stat-value"><?php echo count($projects); ?></div>
                                    <div class="stat-label">Your Projects</div>
                                </div>
                                <div style="font-size: 32px; color: rgba(102, 126, 234, 0.2);">
                                    <i class="fas fa-project-diagram"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <div class="col-md-3">
                        <div class="stat-card">
                            <div class="d-flex justify-content-between align-items-start">
                                <div>
                                    <div class="stat-value"><?php echo count($tasks); ?></div>
                                    <div class="stat-label">Active Tasks</div>
                                </div>
                                <div style="font-size: 32px; color: rgba(102, 126, 234, 0.2);">
                                    <i class="fas fa-tasks"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <div class="col-md-3">
                        <div class="stat-card">
                            <div class="d-flex justify-content-between align-items-start">
                                <div>
                                    <div class="stat-value"><?php echo count($overdue_tasks); ?></div>
                                    <div class="stat-label">Overdue Tasks</div>
                                </div>
                                <div style="font-size: 32px; color: rgba(102, 126, 234, 0.2);">
                                    <i class="fas fa-exclamation-triangle"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <div class="col-md-3">
                        <div class="stat-card">
                            <div class="d-flex justify-content-between align-items-start">
                                <div>
                                    <div class="stat-value">100%</div>
                                    <div class="stat-label">System Status</div>
                                </div>
                                <div style="font-size: 32px; color: rgba(72, 187, 120, 0.2);">
                                    <i class="fas fa-check-circle"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                
                <!-- Projects and Tasks Row -->
                <div class="row">
                    <div class="col-md-6">
                        <h5 class="mb-3">📋 Your Projects</h5>
                        <?php if (count($projects) > 0): ?>
                            <?php foreach (array_slice($projects, 0, 5) as $project): ?>
                                <div class="project-item">
                                    <div class="d-flex justify-content-between align-items-start">
                                        <div>
                                            <strong><?php echo htmlspecialchars($project['project_cd']); ?></strong>
                                            <br>
                                            <small class="text-muted">
                                                Budget: $<?php echo number_format($project['project_budget_abacus'], 2); ?>
                                            </small>
                                        </div>
                                        <span class="badge bg-primary">Active</span>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <p class="text-muted">No projects assigned</p>
                        <?php endif; ?>
                    </div>
                    
                    <div class="col-md-6">
                        <h5 class="mb-3">✅ Recent Tasks</h5>
                        <?php if (count($tasks) > 0): ?>
                            <?php foreach (array_slice($tasks, 0, 5) as $task): ?>
                                <div class="task-item">
                                    <div class="d-flex justify-content-between align-items-start">
                                        <div>
                                            <strong><?php echo htmlspecialchars($task['task_name']); ?></strong>
                                            <br>
                                            <small class="text-muted">
                                                Due: <?php echo date('M d, Y', strtotime($task['task_pln_end_dt'])); ?>
                                            </small>
                                        </div>
                                        <?php if (strtotime($task['task_pln_end_dt']) < time()): ?>
                                            <span class="badge bg-danger">Overdue</span>
                                        <?php else: ?>
                                            <span class="badge bg-success">Pending</span>
                                        <?php endif; ?>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <p class="text-muted">No tasks assigned</p>
                        <?php endif; ?>
                    </div>
                </div>
                
                <!-- Info Box -->
                <div class="alert alert-info mt-4" role="alert">
                    <i class="fas fa-lightbulb"></i> <strong>Tip:</strong> Use the sidebar menu to navigate through projects, tasks, and reports.
                </div>
            </main>
        </div>
    </div>
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>