<?php
require 'inc/functions.php';
include 'inc/header.php';

if(isset($_POST['delete'])){
    if(delete_entry(filter_input(INPUT_POST, 'delete', FILTER_SANITIZE_NUMBER_INT))){
    header('location: index.php?msg=Task+Deleted');
    exit;
  } else{
    header('location: index.php?msg=Unable+to+Delete+Task');
      exit;
  }
}
if(isset($_GET['msg'])){
  $error_message = trim(filter_input(INPUT_GET, 'msg', FILTER_SANITIZE_STRING));
}

?>

<!DOCTYPE html>
        <section>
            <div class="container">
                <div class="entry-list">
                    <article>
                      <?php

                      foreach(get_entry_list() as $item) {
                          echo "<h2><a href='detail.php?id=".$item['id']."'>".$item['title']."</a></h2>";
                          echo "<time datetime='".$item['date']."'>".date("F d, Y",strtotime($item['date']))."</time><br>";

                          echo "<form method='post' action='index.php' onsubmit=\"return confirm('Are you sure want to delete this entry?');\">";
                          echo "<input type='hidden' value='".$item['id']."'  name='delete' />\n";
                          echo "<input type='submit' class='button--delete' value='Delete'>";
                          echo "</form>";

                          }
                            ?>
                    </article>
              <?php        if (isset($error_message)){
            echo "<p class='message'>$error_message</p>";
        }
        ?>
                </div>
            </div>
        </section>
<?php include 'inc/footer.php'; ?>
