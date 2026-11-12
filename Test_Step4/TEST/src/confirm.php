<?php
session_start();

if (!isset($_SESSION['form_data'])) {
    header('Location: form.php');
    exit;
}

$name = $_SESSION['form_data']['name'];
$age = $_SESSION['form_data']['age'];
$phone = $_SESSION['form_data']['phone'];
$email = $_SESSION['form_data']['email'];
$address = $_SESSION['form_data']['address'];
$question = $_SESSION['form_data']['question'];
$gender = $_SESSION['form_data']['gender'];
?>
<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <title>入力内容確認</title>
</head>
<body>
    <h1>入力内容確認</h1>
    <p>名前: <?php echo htmlspecialchars($name, ENT_QUOTES, 'UTF-8'); ?></p>
    <p>年齢: <?php echo htmlspecialchars($age, ENT_QUOTES, 'UTF-8'); ?></p>
    <p>電話番号: <?php echo htmlspecialchars($phone, ENT_QUOTES, 'UTF-8'); ?></p>
    <p>メールアドレス: <?php echo htmlspecialchars($email, ENT_QUOTES, 'UTF-8'); ?></p>
    <p>住所: <?php echo htmlspecialchars($address, ENT_QUOTES, 'UTF-8'); ?></p>
    <p>質問: <?php echo htmlspecialchars($question, ENT_QUOTES, 'UTF-8'); ?></p>
    <p>性別: <?php echo htmlspecialchars($gender, ENT_QUOTES, 'UTF-8'); ?></p>
</body>
</html>
