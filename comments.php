<?php
$iceriAktar = "./ayar.php";
if (file_exists($iceriAktar)) {
    require $iceriAktar;
}

// Below function will convert datetime to time elapsed string
function time_elapsed_string($datetime, $full = false)
{
    $now = new DateTime;
    $ago = new DateTime($datetime);
    $diff = $now->diff($ago);
    $diff->w = floor($diff->d / 7);
    $diff->d -= $diff->w * 7;
    $string = array('y' => 'year', 'm' => 'month', 'w' => 'week', 'd' => 'day', 'h' => 'hour', 'i' => 'minute', 's' => 'second');
    foreach ($string as $k => &$v) {
        if ($diff->$k) {
            $v = $diff->$k . ' ' . $v . ($diff->$k > 1 ? 's' : '');
        } else {
            unset($string[$k]);
        }
    }
    if (!$full) $string = array_slice($string, 0, 1);
    return $string ? implode(', ', $string) . ' ago' : 'just now';
}

// This function will populate the comments and comments replies using a loop
function show_comments($comments, $parent_id = -1)
{
    $html = '';
    if ($parent_id != -1) {
        // If the comments are replies sort them by the "submit_date" column
        array_multisort(array_column($comments, 'submit_date'), SORT_ASC, $comments);
    }
    // Iterate the comments using the foreach loop
    foreach ($comments as $comment) {
        if ($comment['parent_id'] == $parent_id) {
            // Add the comment to the $html variable
            $html .= '
            <div class="comment">
                <div>
                    <h3 class="name">' . htmlspecialchars($comment['commenter_name'], ENT_QUOTES) . '</h3>
                    <span class="date">' . time_elapsed_string($comment['submit_date']) . '</span>
                </div>
                <p class="content">' . nl2br(htmlspecialchars($comment['comment'], ENT_QUOTES)) . '</p>
                <a class="reply_comment_btn" href="#" data-comment-id="' . $comment['id'] . '">Reply</a>
                ' . show_write_comment_form($comment['id']) . '
                <div class="replies">
                ' . show_comments($comments, $comment['id']) . '
                </div>
            </div>
            ';
        }
    }
    return $html;
}


// This function is the template for the write comment form
function show_write_comment_form($parent_id = -1)
{
    $html = '
    <div class="write_comment" data-comment-id="' . $parent_id . '">
        <form>
            <input name="parent_id" type="hidden" value="' . $parent_id . '">
            <input name="name" type="text" placeholder="Your Name" required>
            <textarea name="content" placeholder="Write your comment here..." required></textarea>
            <button type="submit">Submit Comment</button>
        </form>
    </div>
    ';
    return $html;
}

// Page ID needs to exist, this is used to determine which comments are for which page
if (isset($_GET['userid'])) {
    // Check if the submitted form variables exist

    $_GET["url"] = $_SERVER['HTTP_REFERER'];

    if (!empty($_POST['content'])) {

        $referer = $_SERVER['HTTP_REFERER'];
        $session = $_SESSION["email"];
        $stmt = $connb->prepare("INSERT INTO comments (user_id, parent_id, url, commenter_name, comment, submit_date) VALUES (?,?,?,?,?,NOW())");
        $stmt->execute([
            $_GET['userid'],
            $_POST['parent_id'],
            $referer,
            $_POST['name'],
            $_POST['content']
        ]);
        exit('Your comment has been submitted!');
    }
    // Get all comments by the Page ID ordered by the submit date
    $stmt = $connb->prepare('SELECT * FROM comments WHERE user_id = ? AND url = ? ORDER BY submit_date DESC');
    $stmt->execute([
        $_GET['userid'],
        $_GET['url']

    ]);
    $comments = $stmt->fetchAll(PDO::FETCH_ASSOC);

    // Get the total number of comments

    $stmt = $connb->prepare('SELECT COUNT(*) AS total_comments FROM comments  WHERE user_id = ? AND url = ?');
    $stmt->execute([
        $_GET['userid'],
        $_GET['url']
    ]);
    $comments_info = $stmt->fetch(PDO::FETCH_ASSOC);
} else {
    exit('No page ID specified!');
}
?>
<?php if (!empty($_SESSION["email"])) { ?>
    <?= show_write_comment_form() ?>
    <?php
    echo show_comments($comments, $parent_id = -1);
    ?>

    <div class="comment_header col-lg-12 col-md-6">
        <span class="total"><?= $comments_info['total_comments'] ?> comments</span>
        <a href="#" class="write_comment_btn" data-comment-id="-1">Yorum Yap</a>
    </div>
<?php } else { ?>
    <div class="comment_header ">
        <span class="total"><?= $comments_info['total_comments'] ?> comments</span>
        <a href="login.php"><button data-comment-id="-1" type="button" class="btn btn-light">
                Yorum Yapmak İçin Giriş Yapınız..
            </button></a>
        <!-- Button trigger modal -->

        <!--<a href="./login.php" data-comment-id="-1"><button>Yorum Yapmak İçin Giriş</button></a>-->

    </div>
<?php } ?>