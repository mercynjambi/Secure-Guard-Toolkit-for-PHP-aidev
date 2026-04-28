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
                if (isset($_POST['analyze'])) {
                    $p = $_POST['pass'];
                    $score = 0;
                    if (strlen($p) > 8) $score++;
                    if (preg_match('/[A-Z]/', $p)) $score++;
                    if (preg_match('/[0-9]/', $p)) $score++;
                    if (preg_match('/[^A-Za-z0-9]/', $p)) $score++;
                    
                    $levels = ["Very Weak", "Weak", "Medium", "Strong", "Excellent"];
                    echo "Strength: <strong>" . $levels[$score] . "</strong><br>";
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
                if (isset($_POST['hash'])) {
                    $data = $_POST['data'];
                    echo "SHA-256 Hash:<br><code style='word-break:break-all;'>" . hash('sha256', $data) . "</code>";
                }
                ?>
            </div>
        </div>
    </div>
</div>
</body>
</html>