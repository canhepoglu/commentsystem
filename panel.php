<?php
$iceriAktar = "./ayar.php";
if (file_exists($iceriAktar)) {
    require $iceriAktar;
}

$meta = array(
    "baslik" => "Home",
    "aciklama" => "Açıklama",
);


$iceriAktar = "./source/header.php";
if (file_exists($iceriAktar)) {
    require $iceriAktar;
}

if (!empty($_GET["action"])) {
    switch ($_GET["action"]) {
        case "yorumsil":
            $id = $_GET['id'];
            $yorumquery = mysqli_query($conn, "SELECT * FROM comments WHERE id=$id");
            $yorumm = mysqli_fetch_assoc($yorumquery);
            mysqli_query($conn, "DELETE FROM comments WHERE id=$id");
            break;
    }
}

?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title>Panel</title>
</head>

<body>
    <script>
        function yorumsil(id) {
            if (confirm('Silmek istediğinize emin misiniz?')) {
                window.location.href = "panel.php?id=" + id + "&action=yorumsil";
            }
        }
    </script>
    <?php if (!empty($_SESSION["email"])) { ?>
        <table class="table table-bordered">
            <thead class="thead-dark">
                <tr>
                    <th>
                        id
                    </th>
                    <th>
                        user_id
                    </th>
                    <th>
                        url
                    </th>
                    <th>
                        commenter_name
                    </th>
                    <th>
                        comment
                    </th>
                    <th>
                        submit_date
                    </th>
                    <th>
                        İşlemler
                    </th>
                </tr>
            </thead>

            <?php
            $stmt = $connb->prepare('SELECT * from comments WHERE user_id = ? ORDER BY submit_date DESC');
            $stmt->execute([
                md5($_SESSION["email"])
            ]);
            $comments = $stmt->fetchAll(PDO::FETCH_ASSOC);

            foreach ($comments as $b) {
                $id = $b['id'];
                $user_id = $b['user_id'];
                $url = $b['url'];
                $name = $b['commenter_name'];
                $comment = $b['comment'];
                $submit_date = $b['submit_date'];
            ?>
                <tbody>
                    <form action="javascript:void(0)" method="post" id="formalani">
                        <tr>
                            <td>
                                <?= $id ?>
                            </td>
                            <td>
                                <?= $user_id ?>
                            </td>
                            <td>
                                <a href="<?= $url ?>"><?= $url ?></a>

                            </td>
                            <td>
                                <?= $name ?>
                            </td>
                            <td>
                                <?= $comment ?>
                            </td>
                            <td>
                                <?= $submit_date ?>
                            </td>
                            <td>
                                <a href="javascript:yorumsil(<?= $id ?>);" ?>Sil</a><br /><br />
                            </td>
                        </tr>
                    </form>
                </tbody>
            <?php } ?>
        </table>

    <?php } else { ?>
        Lütfen <a href="login.php">giriş</a> yapınız.
    <?php } ?>
</body>

</html>


</div>
<?php
$iceriAktar = "./source/footer.php";
if (file_exists($iceriAktar)) {
    require $iceriAktar;
}
?>