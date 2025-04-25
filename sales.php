<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <title>YSEレジシステム - 売上一覧</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 p-6">
    <div class="max-w-3xl mx-auto bg-white rounded-2xl shadow-lg p-6 space-y-6">
        <h1 class="text-2xl font-bold text-center text-gray-800">売上一覧（仮）</h1>

        <?php
        // 仮の売上データ
        $sales = [
            ['日付' => '2025-04-20', '商品' => 'りんご', '金額' => 120],
            ['日付' => '2025-04-21', '商品' => 'バナナ', '金額' => 200],
            ['日付' => '2025-04-22', '商品' => 'オレンジ', '金額' => 150],
        ];

        $total = array_sum(array_column($sales, '金額'));
        ?>

        <table class="table-auto w-full text-left border border-gray-300">
            <thead class="bg-gray-200">
                <tr>
                    <th class="px-4 py-2 border">日付</th>
                    <th class="px-4 py-2 border">商品</th>
                    <th class="px-4 py-2 border">金額（円）</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($sales as $sale): ?>
                <tr class="hover:bg-gray-100">
                    <td class="px-4 py-2 border"><?= htmlspecialchars($sale['日付']) ?></td>
                    <td class="px-4 py-2 border"><?= htmlspecialchars($sale['商品']) ?></td>
                    <td class="px-4 py-2 border text-right"><?= number_format($sale['金額']) ?></td>
                </tr>
                <?php endforeach; ?>
            </tbody>
            <tfoot>
                <tr class="font-bold bg-gray-100">
                    <td class="px-4 py-2 border text-center" colspan="2">合計</td>
                    <td class="px-4 py-2 border text-right"><?= number_format($total) ?> 円</td>
                </tr>
            </tfoot>
        </table>

        <div class="text-center">
            <a href="index.php" class="inline-block bg-blue-500 hover:bg-blue-600 text-white font-bold py-2 px-6 rounded mt-4">戻る</a>
        </div>
    </div>
</body>
</html>