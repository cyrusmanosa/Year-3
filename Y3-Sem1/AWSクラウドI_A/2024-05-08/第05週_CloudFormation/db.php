<?php
//header('charset=utf-8');
define('HOST', '10.1.11.185');
define('USR', 'aws');
define('PASS', 'ecc');
define('DB', 'sk3a_db');
?>
<html>

<head>
    <title>AWS DB test</title>
</head>

<body>
    <header>
        <h1>データ一覧</h1>
    </header>
    <?php
    if (!$conn = mysqli_connect(HOST, USR, PASS, DB)) {
        die('データベースに接続できません');
    }

    mysqli_set_charset($conn, 'utf8');
    $sql = "SELECT * FROM users";
    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_bind_result($stmt, $id, $name, $age, $role);
    print "<table border=\"1\">\n";
    print "<tr><td>名前</td><td>年齢</td><td>役職</td></tr>\n";
    while (mysqli_stmt_fetch($stmt)) {
        print("<tr>");
        printf("<td>%s</td>", $name);
        printf("<td>%d</td>", $age);
        printf("<td>%s</td>", $role);
        print "</tr>\n";
    }
    print '</table>';
    mysqli_stmt_free_result($stmt);
    mysqli_stmt_close($stmt);
    mysqli_close($conn);
    ?>
</body>

</html>