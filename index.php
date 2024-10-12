<?php
session_start(); // セッション開始

// try {
//     $pdo = new PDO('mysql:host=localhost;dbname=ranking_db;charset=utf8', 'root', '');
// } catch (PDOException $e) {
//     echo 'データベース接続失敗: ' . $e->getMessage();
//     exit();
// }

try {
    $pdo = new PDO('mysql:host=mysql3101.db.sakura.ne.jp;dbname=momodai_homayasan;charset=utf8', '', '');
} catch (PDOException $e) {
    echo 'データベース接続失敗: ' . $e->getMessage();
    exit();
}

// ユーザーがログインしているか確認
if (isset($_SESSION['user_id'])) {
    $stmt = $pdo->prepare("SELECT points FROM users WHERE id = :id");
    $stmt->bindParam(':id', $_SESSION['user_id'], PDO::PARAM_INT);
    $stmt->execute();
    $user = $stmt->fetch();

    $points = $user['points']; // ポイントを取得
    $username = $_SESSION['username']; // セッションからユーザー名を取得
} else {
    $points = 0; // ログインしていない場合のデフォルト値
    $username = "ゲスト"; // ログインしていない場合は「ゲスト」
}
?>

<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./css/style.css">
    <link href="https://fonts.googleapis.com/css2?family=Darumadrop+One&display=swap" rel="stylesheet">
    <title>ももだいのほめやさん</title>
</head>
<body>
    <!-- ヘッダー部分 -->
    <header class="header">
        <div class="logo">ももだいのほめやさん</div>

        <!-- ユーザー名、やさしいポイント、ログインアイコン -->
        <div class="header-right">
            <div class="welcome-message">
                ようこそ、<?php echo $username; ?>さん <!-- ユーザー名を表示 -->
            </div>

            <!-- やさしいポイント表示 -->
            <div class="kind-points">
                <span id="user-points"><?php echo $points; ?>pt</span> <!-- ログイン後のポイント表示 -->
            </div>

            <!-- ログインアイコン -->
            <div class="login-icon">
                <a href="javascript:void(0);" onclick="toggleLoginMenu()">
                    <img src="./img/login_icon.png" alt="ログイン">
                </a>
            </div>
        </div>

        <!-- ログインメニュー -->
        <div id="login-menu" class="menu" style="display: none;">
            <ul>
                <li><a href="login.php">ログイン/とうろく</a></li>
                <li><a href="view_ranking.php">やさしいランキング</a></li>
                <li><a href="admin_dashboard.php">かんり</a></li>
                <li><a href="logout.php">ログアウト</a></li>
            </ul>
        </div>
    </header>

    <main>
        <div id="talk-section" style="display: none; text-align: center;">
                <img src="./img/momo-dai.png" alt="おはなし" style="max-width: 400px; margin-bottom: 20px;">
                <button id="talk-button">おはなしする</button>
        </div>
    </main>

    <!-- フッターメニュー -->
    <footer class="footer">
        <ul class="footer-menu">
            <li><a href="index.php"><img src="./img/home_icon.png" alt="ホーム"></a></li>
            <li><a href="community.php"><img src="./img/community_icon.png" alt="コミュニティ"></a></li>
            <li><a href="javascript:void(0);" onclick="toggleTalkSection()"><img src="./img/talk_icon.png" alt="トーク"></a></li>
            <li><a href="#"><img src="./img/game_icon.png" alt="ゲーム"></a></li>
            <li><a href="shop.php"><img src="./img/shop_icon.png" alt="ショップ"></a></li>
        </ul>
    </footer>

    <!-- JavaScriptでメニューの表示/非表示を切り替える -->
    <script>
        function toggleLoginMenu() {
            var menu = document.getElementById('login-menu');
            if (menu.style.display === "none") {
                menu.style.display = "block";
            } else {
                menu.style.display = "none";
            }
        }

        function toggleTalkSection() {
            var talkSection = document.getElementById('talk-section');
            if (talkSection.style.display === "none") {
                talkSection.style.display = "block";
            } else {
                talkSection.style.display = "none";
            }
        }
    </script>
</body>
</html>








