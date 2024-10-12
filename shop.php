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

    $points = $user['points'];
    $username = $_SESSION['username'];
} else {
    $points = 0;
    $username = "ゲスト";
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
<header class="header">
    <div class="logo">ももだいのほめやさん</div>

    <!-- ユーザー名、やさしいポイント、ログインアイコン -->
    <div class="header-right">
        <div class="welcome-message">
            ようこそ、<?php echo $username; ?>さん
        </div>

        <div class="kind-points">
            <span id="user-points"><?php echo $points; ?>pt</span>
        </div>

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
        </ul>
    </div>
</header>

<main>
    <h3>ショップ</h3>
    <div class="product-list">
        <div class="product-item">
            <a href="product_detail.php?product_id=1">
                <img src="./img/product_sample.jpg" alt="もものぬいぐるみ">
            </a>
            <h2>もものぬいぐるみ</h2>
            <p>¥16,000</p>
        </div>
        <div class="product-item">
            <a href="product_detail.php?product_id=2">
                <img src="./img/product_sample.jpg" alt="だいのぬいぐるみ">
            </a>
            <h2>だいのぬいぐるみ</h2>
            <p>価格: ¥13,000</p>
        </div>
        <div class="product-item">
            <a href="product_detail.php?product_id=3">
                <img src="./img/product_sample.jpg" alt="ももだいのぬいぐるみセット">
            </a>
            <h2>ももだいのぬいぐるみセット</h2>
            <p>価格: ¥28,000</p>
        </div>
        <!-- 他の商品を追加する場合は同様のブロックを追加 -->
    </div>
</main>

<footer class="footer">
    <ul class="footer-menu">
        <li><a href="index.php"><img src="./img/home_icon.png" alt="ホーム"></a></li>
        <li><a href="community.php"><img src="./img/community_icon.png" alt="コミュニティ"></a></li>
        <li><a href="javascript:void(0);" onclick="toggleTalkSection()"><img src="./img/talk_icon.png" alt="トーク"></a></li>
        <li><a href="#"><img src="./img/game_icon.png" alt="ゲーム"></a></li>
        <li><a href="shop.php"><img src="./img/shop_icon.png" alt="ショップ"></a></li>
    </ul>
</footer>

</body>
</html>

