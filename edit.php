<?php
require 'inc/functions.php';
include 'inc/header.php';

$title = $date = $time_spent = $learned = $resources = $tag = " ";
$id = filter_input(INPUT_GET, 'id', FILTER_SANITIZE_NUMBER_INT);
$page="edit";
$selected= get_entry($id);


if(isset($_GET['id'])){
    list($id,$title,$date,$time_spent,$learned,$resources) = get_entry(filter_input(INPUT_GET, 'id',
    FILTER_SANITIZE_NUMBER_INT));
}

if($_SERVER['REQUEST_METHOD'] =='POST'){
    $id= trim(filter_input(INPUT_POST,'id',FILTER_SANITIZE_NUMBER_INT));  //entry_id required????
    $title= trim(filter_input(INPUT_POST,'title',FILTER_SANITIZE_STRING));
    $date= trim(filter_input(INPUT_POST,'date',FILTER_SANITIZE_STRING));
    $time_spent= trim(filter_input(INPUT_POST,'timeSpent',FILTER_SANITIZE_NUMBER_INT));
    $learned= trim(filter_input(INPUT_POST,'whatILearned',FILTER_SANITIZE_STRING));
    $resources= trim(filter_input(INPUT_POST,'ResourcesToRemember',FILTER_SANITIZE_STRING));


    $dateMatch= explode('-',$date);

 if (empty($title)||empty($date)||empty($id)) {
      $error_message = 'Please fill in required fields: Title and/or Date';
      echo "Please fill in required fields: Title and/or Date";
  /*  }elseif(count($dateMatch) != 3
         ||strlen($dateMatch[0])!= 4
         ||strlen($dateMatch[1])!= 2
         ||strlen($dateMatch[2])!= 2
         ||!checkdate($dateMatch[0],$dateMatch[1],$dateMatch[2])){
    $error_message = "Invalid Date";
    echo "Please fill in required fields: Title and/or Date(YYYY-MM-DD)";
*/}else{
    if (add_entry($title,$date,$time_spent,$learned,$resources,$id)){
    echo 'Journal Entry updated.';
    header('Location: index.php');
    exit;
  } else {
    $error_message = "Could not update entry";
    }
  }
}

?>



<!DOCTYPE html>
<html>

        <section>
            <div class="container">
                <div class="edit-entry">
                    <h2>Edit Entry</h2>
                      <form method="POST">
                          <label for="title">Title</label>
                          <input id="title" type="text" name="title" placeholder="Title" value= "<?php echo htmlspecialchars($title); ?>"><br>
                          <label for="date">Date</label>
                          <input id="date" type="date" name="date" placeholder="YYYY-MM-DD" value= "<?php echo htmlspecialchars($date); ?>"><br>
                          <label for="time-spent"> Time Spent</label>
                          <input id="time-spent" type="text" name="timeSpent" value= "<?php echo htmlspecialchars($time_spent); ?>"placeholder="1 hour" ><br>
                          <label for="what-i-learned">What I Learned</label>
                          <textarea id="what-i-learned" rows="5" name="whatILearned" placeholder="Today I learned..." value = ""><?php echo htmlspecialchars($learned); ?></textarea>
                          <label for="resources-to-remember">Resources to Remember</label>
                          <textarea id="resources-to-remember" rows="5" name="ResourcesToRemember" placeholder="Treehouse.com" value = ""><?php echo htmlspecialchars($resources); ?> </textarea>
                          <input type="submit" value="Publish Entry" class="button">
                          <a href="index.php" class="button button-secondary">Cancel</a>
                          <?php
                          if (!empty($id)){
                          echo "<input type='hidden' name = 'id' value='".$id."' />";
                            }
                          ?>
                      </form>
                </div>
            </div>
        </section>
<?php include 'inc/footer.php'; ?>
</html>
