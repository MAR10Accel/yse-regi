<!-- <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h2>YSEレジ</h2>
</body>
</html> -->

<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <title>YSEレジシステム - 金額入力画面</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 p-6">
    <div class="max-w-md mx-auto bg-white rounded-2xl shadow-lg p-6 space-y-4">
        <h1 class="text-2xl font-bold text-center text-gray-800">金額入力画面</h1>

        <!-- 表示欄 -->
        <input type="text" id="display" class="w-full text-right text-3xl p-4 bg-gray-100 rounded-lg" readonly>

        <!-- ボタン群 -->
        <div class="grid grid-cols-4 gap-2">
            <?php
            $buttons = [
                '7', '8', '9', 'AC',
                '4', '5', '6', '×',
                '1', '2', '3', '+',
                '0', '00', '税込', '=',
                '売上', '計上'
            ];

            foreach ($buttons as $btn) {
                $colSpan = in_array($btn, ['売上', '計上']) ? 2 : 1;
                echo "<button class='col-span-$colSpan bg-blue-500 hover:bg-blue-600 text-white font-bold py-2 px-4 rounded' onclick='handleInput(\"$btn\")'>$btn</button>";
            }
            ?>
        </div>
    </div>

    <script>
    let display = document.getElementById('display');

    function handleInput(val) {
        switch(val) {
            case 'AC':
                display.value = '';
                break;
            case '=':
                try {
                    display.value = eval(display.value); // 安全性は後で強化
                } catch {
                    display.value = 'エラー';
                }
                break;
            case '税込':
                display.value = Math.floor(display.value * 1.1);
                break;
            case '計上':
                alert('計上処理（仮）');
                break;
            case '売上':
                window.location.href = 'sales.php';  // ← ここをリンクに変更
                break;
            default:
                display.value += val;
        }
    }
</script>
</body>
</html>
