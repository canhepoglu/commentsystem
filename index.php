<?php
$iceriAktar = "./ayar.php";
if (file_exists($iceriAktar)) {
    require $iceriAktar;
}

$meta = array(
    "baslik" => "Home",
    "aciklama" => "Açıklama",
);
/*
if (!empty($_POST["canyorumsistemi"])) {
    $stmt = $connb->prepare('INSERT INTO comments (url, user_id, commenter_name, comment, submit_date) VALUES (?,?,?,?,NOW())');
    $stmt->execute([$_GET['url'], $_POST['user_id'], $_POST['commenter_name'], $_POST['comment']]);

    exit;
}*/


$iceriAktar = "./source/header.php";
if (file_exists($iceriAktar)) {
    require $iceriAktar;
}


?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title>Comments System</title>
    <link href="style.css" rel="stylesheet" type="text/css">
    <link href="comments.css" rel="stylesheet" type="text/css">
</head>

<body>
    <?php if (!empty($_SESSION["email"])) { ?>
        <h3>Başarıyla giriş yaptınız, API kodunuz: </h3>
        <textarea>
      <?php echo $siteAyarlari["siteadresi"]; ?>/api?u=<?php echo md5($_SESSION["email"]); ?>
    </textarea>


        <nav class="navtop">
            <div>
                <h1>Comments System</h1>
            </div>
        </nav><br>

        <div class="comments"></div>

        <script>
            const comments_page_id = 1; // This number should be unique on every page
            fetch("comments.php?userid=<?php echo md5($_SESSION["email"]); ?>", {
                method: 'GET'
            }).then(response => response.text()).then(data => {
                document.querySelector(".comments").innerHTML = data;
                document.querySelectorAll(".comments .write_comment_btn, .comments .reply_comment_btn").forEach(element => {
                    element.onclick = event => {
                        event.preventDefault();
                        document.querySelectorAll(".comments .write_comment").forEach(element => element.style.display = 'none');
                        document.querySelector("div[data-comment-id='" + element.getAttribute("data-comment-id") + "']").style.display = 'block';
                        document.querySelector("div[data-comment-id='" + element.getAttribute("data-comment-id") + "'] input[name='user_id']").focus();
                    };
                });
                document.querySelectorAll(".comments .write_comment form").forEach(element => {
                    element.onsubmit = event => {
                        event.preventDefault();
                        fetch("comments.php?userid=<?php echo md5($_SESSION["email"]); ?>", {
                            method: 'POST',
                            body: new FormData(element)
                        }).then(response => response.text()).then(data => {
                            element.parentElement.innerHTML = data;
                        });
                    };
                });
            });
        </script>
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
<script src="/js/jquery-3.4.1.min.js"></script>