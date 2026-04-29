<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Secure-Guard PHP Toolkit</title>
    <style>
        :root { --primary: #2563eb; --bg: #0f172a; --card: #1e293b; --text: #f8fafc; }
        body { font-family: 'Inter', sans-serif; background: var(--bg); color: var(--text); padding: 40px; }
        .container { max-width: 800px; margin: 0 auto; }
        .grid { display: grid; grid-template-columns: 1fr 1fr; gap: 20px; }
        .card { background: var(--card); padding: 20px; border-radius: 12px; border: 1px solid #334155; }
        h1, h3 { color: var(--primary); }
        input { width: 100%; padding: 10px; background: #0f172a; border: 1px solid #334155; color: white; border-radius: 6px; box-sizing: border-box; }
        button { background: var(--primary); color: white; border: none; padding: 10px 20px; border-radius: 6px; cursor: pointer; margin-top: 10px; width: 100%; }
        .result { margin-top: 15px; font-size: 0.9rem; color: #94a3b8; line-height: 1.6; }
        .tag { display: inline-block; padding: 2px 8px; border-radius: 4px; font-size: 0.75rem; background: #334155; }
    </style>
</head>
<body>
<div class="container">
    <h1>🛡️ Secure-Guard PHP Toolkit</h1>
    <p>A professional utility for data security and server-side analysis.</p>

    <div class="grid">
        <div class="card">
            <h3>Password Evaluator</h3>
            <form method="POST">
                <input type="password" name="pass" placeholder="Enter password to test" required>
                <button name="analyze">Analyze Strength</button>
            </form>
            <div class="result">
                <?php
                // Check if the "Analyze Strength" button was clicked
                if (isset($_POST['analyze'])) {
                    
                    // Sanitize input: Capture the password from the POST request
                    $p = $_POST['pass'];
                    
                    // Initialize the strength score
                    $score = 0;
                    
                    // CRITERIA 1: Check if length is greater than 8 characters
                    if (strlen($p) > 8) $score++;
                    
                    // CRITERIA 2: Use Regex to check for at least one Uppercase letter
                    if (preg_match('/[A-Z]/', $p)) $score++;
                    
                    // CRITERIA 3: Use Regex to check for at least one Number
                    if (preg_match('/[0-9]/', $p)) $score++;
                    
                    // CRITERIA 4: Use Regex to check for Special Characters (non-alphanumeric)
                    if (preg_match('/[^A-Za-z0-9]/', $p)) $score++;
                    
                    // Define strength labels corresponding to the $score (0 to 4)
                    $levels = ["Very Weak", "Weak", "Medium", "Strong", "Excellent"];
                    
                    // Output the result to the user
                    echo "Strength: <strong>" . $levels[$score] . "</strong><br>";
                    
                    // EDUCATIONAL: Simple entropy estimation (characters * 4 bits)
                    echo "Entropy Check: " . (strlen($p) * 4) . " bits estimated.";
                }
                ?>
            </div>
        </div>

        <div class="card">
            <h3>Encryption Engine</h3>
            <form method="POST">
                <input type="text" name="data" placeholder="Sensitive data here" required>
                <button name="hash">Generate Secure Hash</button>
            </form>
            <div class="result">
                <?php
                // Check if the "Generate Secure Hash" button was clicked
                if (isset($_POST['hash'])) {
                    
                    // Capture input data from the POST superglobal
                    $data = $_POST['data'];
                    
                    /* CORE LOGIC: 
                       Apply the SHA-256 Hashing algorithm.
                       Unlike encryption, hashing is a one-way function, 
                       meaning the resulting string cannot be reversed to reveal the original data.
                    */
                    $secureHash = hash('sha256', $data);
                    
                    // Display the resulting 64-character hex string
                    echo "SHA-256 Hash:<br><code style='word-break:break-all;'>" . $secureHash . "</code>";
                }
                ?>
            </div>
        </div>
    </div>
</div>
</body>
</html>