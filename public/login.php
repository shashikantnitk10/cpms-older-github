<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CPMS - Secure Login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <style>
        body {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }
        
        .login-container {
            background: white;
            border-radius: 10px;
            box-shadow: 0 10px 40px rgba(0, 0, 0, 0.2);
            width: 100%;
            max-width: 400px;
            padding: 40px;
            animation: slideUp 0.5s ease-out;
        }
        
        @keyframes slideUp {
            from {
                opacity: 0;
                transform: translateY(30px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
        
        .logo-section {
            text-align: center;
            margin-bottom: 30px;
        }
        
        .logo-section h2 {
            color: #333;
            font-weight: 700;
            margin-bottom: 5px;
        }
        
        .logo-section p {
            color: #999;
            font-size: 14px;
            margin: 0;
        }
        
        .form-group {
            margin-bottom: 20px;
        }
        
        .form-label {
            color: #333;
            font-weight: 600;
            margin-bottom: 8px;
            font-size: 14px;
        }
        
        .form-control {
            border: 2px solid #e0e0e0;
            border-radius: 5px;
            padding: 12px 15px;
            font-size: 14px;
            transition: all 0.3s ease;
        }
        
        .form-control:focus {
            border-color: #667eea;
            box-shadow: 0 0 0 0.2rem rgba(102, 126, 234, 0.1);
        }
        
        .btn-login {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            border: none;
            color: white;
            padding: 12px;
            border-radius: 5px;
            font-weight: 600;
            width: 100%;
            transition: transform 0.2s ease;
        }
        
        .btn-login:hover {
            transform: translateY(-2px);
            box-shadow: 0 5px 20px rgba(102, 126, 234, 0.3);
            color: white;
        }
        
        .remember-forgot {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin: 15px 0;
            font-size: 13px;
        }
        
        .remember-forgot a {
            color: #667eea;
            text-decoration: none;
            font-weight: 500;
        }
        
        .remember-forgot a:hover {
            text-decoration: underline;
        }
        
        .alert {
            border-radius: 5px;
            margin-bottom: 20px;
        }
    </style>
</head>
<body>
    <div class="login-container">
        <div class="logo-section">
            <h2><i class="fas fa-chart-line"></i> CPMS</h2>
            <p>Corporate Project Management System</p>
        </div>
        
        <?php if(isset($error)): ?>
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <i class="fas fa-exclamation-circle"></i> <?php echo htmlspecialchars($error); ?>
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        <?php endif; ?>
        
        <form method="POST" action="../api/auth.php" id="loginForm">
            <div class="form-group">
                <label class="form-label"><i class="fas fa-user"></i> Username</label>
                <select class="form-control" name="uname" id="uname" required>
                    <option value="">Select User</option>
                    <?php
                    try {
                        require_once __DIR__ . '/../config/Database.php';
                        $db = new Database();
                        $users = $db->getRows("SELECT user_trgm, user_name FROM cpms_user WHERE user_status = 'A' ORDER BY user_name");
                        if ($users) {
                            foreach($users as $user) {
                                echo '<option value="' . htmlspecialchars($user['user_trgm']) . '">' . htmlspecialchars($user['user_name']) . '</option>';
                            }
                        }
                    } catch (Exception $e) {
                        echo '<option value="">Error loading users</option>';
                    }
                    ?>
                </select>
            </div>
            
            <div class="form-group">
                <label class="form-label"><i class="fas fa-lock"></i> Password</label>
                <div class="input-group">
                    <input type="password" class="form-control" name="psw" id="psw" placeholder="Enter your password" required>
                    <button class="btn btn-outline-secondary" type="button" id="togglePassword">
                        <i class="fas fa-eye"></i>
                    </button>
                </div>
            </div>
            
            <div class="remember-forgot">
                <label class="form-check-label">
                    <input type="checkbox" class="form-check-input" name="remember" value="yes">
                    Remember me
                </label>
                <a href="#"><i class="fas fa-question-circle"></i> Forgot Password?</a>
            </div>
            
            <button type="submit" class="btn btn-login">
                <i class="fas fa-sign-in-alt"></i> Login
            </button>
        </form>
        
        <hr style="margin: 20px 0;">
        <div style="text-align: center; font-size: 12px; color: #999;">
            <i class="fas fa-shield-alt"></i> Secure Login | Protected
        </div>
    </div>
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        document.getElementById('togglePassword').addEventListener('click', function() {
            const pswField = document.getElementById('psw');
            const icon = this.querySelector('i');
            
            if (pswField.type === 'password') {
                pswField.type = 'text';
                icon.classList.remove('fa-eye');
                icon.classList.add('fa-eye-slash');
            } else {
                pswField.type = 'password';
                icon.classList.remove('fa-eye-slash');
                icon.classList.add('fa-eye');
            }
        });
    </script>
</body>
</html>