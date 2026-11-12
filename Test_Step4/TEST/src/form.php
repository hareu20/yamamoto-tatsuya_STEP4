<?php
session_start();

$errors = [];
$name = '';
$age = '';
$phone = '';
$email = '';
$address = '';
$question = '';
$gender = '男性';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = isset($_POST['name']) ? trim($_POST['name']) : '';
    $age = isset($_POST['age']) ? trim($_POST['age']) : '';
    $phone = isset($_POST['phone']) ? trim($_POST['phone']) : '';
    $email = isset($_POST['email']) ? trim($_POST['email']) : '';
    $address = isset($_POST['address']) ? trim($_POST['address']) : '';
    $question = isset($_POST['question']) ? trim($_POST['question']) : '';
    $gender = isset($_POST['gender']) ? trim($_POST['gender']) : '';

    if ($name === '' || !preg_match('/^[ぁ-んァ-ヶー一-龯a-zA-Z]+$/u', $name)) {
        $errors['name'] = '名前はひらがな、カタカナ、漢字、英字のみ使用できます。';
    }

    if ($age === '' || !preg_match('/^[0-9]+$/', $age) || (int)$age < 0 || (int)$age > 150) {
        $errors['age'] = '年齢は0から150の間で入力してください。';
    }

    if ($phone === '' || !preg_match('/^[0-9-]+$/', $phone)) {
        $errors['phone'] = '電話番号は半角数字とハイフンのみ使用できます。';
    }

    if ($email === '' || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors['email'] = 'メールアドレスの形式が正しくありません。';
    }

    if ($address === '' || !preg_match('/^[ぁ-んァ-ヶー一-龯a-zA-Z0-9-]+$/u', $address)) {
        $errors['address'] = '住所はひらがな、カタカナ、漢字、英字、半角数字、ハイフンのみ使用できます。';
    }

    if (empty($errors)) {
        $_SESSION['form_data'] = [
            'name' => $name,
            'age' => $age,
            'phone' => $phone,
            'email' => $email,
            'address' => $address,
            'question' => $question,
            'gender' => $gender,
        ];
        header('Location: confirm.php');
        exit;
    }
}
?>
<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>フォーム入力</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="page">
        <h1>フォーム入力</h1>
        <form class="input-form" action="form.php" method="post">
            <div class="form-group">
                <label for="name">名前:</label>
                <input type="text" id="name" name="name" value="<?php echo htmlspecialchars($name, ENT_QUOTES, 'UTF-8'); ?>">
                <?php if (isset($errors['name'])): ?>
                    <p class="error"><?php echo htmlspecialchars($errors['name'], ENT_QUOTES, 'UTF-8'); ?></p>
                <?php endif; ?>
            </div>
            <div class="form-group">
                <label for="age">年齢:</label>
                <input type="text" id="age" name="age" value="<?php echo htmlspecialchars($age, ENT_QUOTES, 'UTF-8'); ?>">
                <?php if (isset($errors['age'])): ?>
                    <p class="error"><?php echo htmlspecialchars($errors['age'], ENT_QUOTES, 'UTF-8'); ?></p>
                <?php endif; ?>
            </div>
            <div class="form-group">
                <label for="phone">電話番号:</label>
                <input type="text" id="phone" name="phone" value="<?php echo htmlspecialchars($phone, ENT_QUOTES, 'UTF-8'); ?>">
                <?php if (isset($errors['phone'])): ?>
                    <p class="error"><?php echo htmlspecialchars($errors['phone'], ENT_QUOTES, 'UTF-8'); ?></p>
                <?php endif; ?>
            </div>
            <div class="form-group">
                <label for="email">メールアドレス:</label>
                <input type="text" id="email" name="email" value="<?php echo htmlspecialchars($email, ENT_QUOTES, 'UTF-8'); ?>">
                <?php if (isset($errors['email'])): ?>
                    <p class="error"><?php echo htmlspecialchars($errors['email'], ENT_QUOTES, 'UTF-8'); ?></p>
                <?php endif; ?>
            </div>
            <div class="form-group">
                <label for="address">住所:</label>
                <input type="text" id="address" name="address" value="<?php echo htmlspecialchars($address, ENT_QUOTES, 'UTF-8'); ?>">
                <?php if (isset($errors['address'])): ?>
                    <p class="error"><?php echo htmlspecialchars($errors['address'], ENT_QUOTES, 'UTF-8'); ?></p>
                <?php endif; ?>
            </div>
            <div class="form-group">
                <label for="question">質問:</label>
                <input type="text" id="question" name="question" value="<?php echo htmlspecialchars($question, ENT_QUOTES, 'UTF-8'); ?>">
            </div>
            <div class="form-group">
                <label for="gender">性別:</label>
                <select id="gender" name="gender">
                    <option value="男性" <?php echo $gender === '男性' ? 'selected' : ''; ?>>男性</option>
                    <option value="女性" <?php echo $gender === '女性' ? 'selected' : ''; ?>>女性</option>
                </select>
            </div>
            <div class="form-group">
                <button type="submit" id="submit" name="submit">送信</button>
            </div>
        </form>
    </div>
</body>
</html>
