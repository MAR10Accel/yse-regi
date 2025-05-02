<!-- <!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <title>YSEレジシステム - 売上一覧</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 p-6">
    <div class="max-w-4xl mx-auto bg-white rounded-2xl shadow-lg p-6 space-y-6">
        <h1 class="text-2xl font-bold text-center text-gray-800">売上一覧（仮）</h1>

        <?php
        // 仮の売上データに品番を追加
        $sales = [
            ['日付' => '2025-04-20', '商品' => 'りんご', '品番' => 'A001', '金額' => 120],
            ['日付' => '2025-04-21', '商品' => 'バナナ', '品番' => 'B002', '金額' => 200],
            ['日付' => '2025-04-22', '商品' => 'オレンジ', '品番' => 'C003', '金額' => 150],
        ];

        $total = array_sum(array_column($sales, '金額'));
        ?>

        <table class="table-auto w-full text-left border border-gray-300">
            <thead class="bg-gray-200">
                <tr>
                    <th class="px-4 py-2 border">日付</th>
                    <th class="px-4 py-2 border">商品</th>
                    <th class="px-4 py-2 border">品番</th>
                    <th class="px-4 py-2 border">金額（円）</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($sales as $sale): ?>
                <tr class="hover:bg-gray-100">
                    <td class="px-4 py-2 border"><?= htmlspecialchars($sale['日付']) ?></td>
                    <td class="px-4 py-2 border"><?= htmlspecialchars($sale['商品']) ?></td>
                    <td class="px-4 py-2 border"><?= htmlspecialchars($sale['品番']) ?></td>
                    <td class="px-4 py-2 border text-right"><?= number_format($sale['金額']) ?></td>
                </tr>
                <?php endforeach; ?>
            </tbody>
            <tfoot>
                <tr class="font-bold bg-gray-100">
                    <td class="px-4 py-2 border text-center" colspan="3">合計</td>
                    <td class="px-4 py-2 border text-right"><?= number_format($total) ?> 円</td>
                </tr>
            </tfoot>
        </table>

        <div class="text-center">
            <a href="index.php" class="inline-block bg-blue-500 hover:bg-blue-600 text-white font-bold py-2 px-6 rounded mt-4">戻る</a>
        </div>
    </div>
</body>
</html> -->
<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <title>YSEレジシステム - 売上一覧</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 p-6">
    <div class="max-w-4xl mx-auto bg-white rounded-2xl shadow-lg p-6 space-y-6">
        <h1 class="text-2xl font-bold text-center text-gray-800">売上一覧</h1>

        <?php
        // データベース接続設定
        $host = 'localhost';
        $db   = 'yse_regi';
        $user = 'root';  // ← 自分のユーザー名に置き換えてください
        $pass = 'root';  // ← 自分のパスワードに置き換えてください
        $charset = 'utf8mb4';

        $dsn = "mysql:host=$host;dbname=$db;charset=$charset";
        $options = [
            PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
        ];

        try {
            $pdo = new PDO($dsn, $user, $pass, $options);

            // データ取得
            $stmt = $pdo->query("SELECT created_at, product_name, product_code, price FROM sales");
            $sales = $stmt->fetchAll();

            $total = array_sum(array_column($sales, 'price'));
        } catch (PDOException $e) {
            echo "<p class='text-red-500'>接続エラー: " . htmlspecialchars($e->getMessage(), ENT_QUOTES, 'UTF-8') . "</p>";
            exit;
        }
        ?>

        <table class="table-auto w-full text-left border border-gray-300">
            <thead class="bg-gray-200">
                <tr>
                    <th class="px-4 py-2 border">日付</th>
                    <th class="px-4 py-2 border">商品</th>
                    <th class="px-4 py-2 border">品番</th>
                    <th class="px-4 py-2 border">金額</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($sales as $sale): ?>
                    <tr class="bg-white hover:bg-gray-50">
                        <td class="px-4 py-2 border"><?= htmlspecialchars(date('Y-m-d', strtotime($sale['created_at']))) ?></td>
                        <td class="px-4 py-2 border"><?= htmlspecialchars($sale['product_name']) ?></td>
                        <td class="px-4 py-2 border"><?= htmlspecialchars($sale['product_code']) ?></td>
                        <td class="px-4 py-2 border"><?= htmlspecialchars($sale['price']) ?>円</td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>

        <p class="text-right font-semibold text-lg">合計金額: <?= $total ?>円</p>
    </div>
</body>
</html>