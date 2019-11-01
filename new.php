<?php
require 'inc/functions.php';
include 'inc/header.php';
$title=$date=$time_spent=$learned=$resources="";

if($_SERVER['REQUEST_METHOD'] =='POST'){
    $id= trim(filter_input(INPUT_POST,'id',FILTER_SANITIZE_NUMBER_INT));  //entry_id required????
    $title= trim(filter_input(INPUT_POST,'title',FILTER_SANITIZE_STRING));
    $date= trim(filter_input(INPUT_POST,'date',FILTER_SANITIZE_STRING));
    $time_spent= trim(filter_input(INPUT_POST,'timeSpent',FILTER_SANITIZE_STRING));
    $learned= trim(filter_input(INPUT_POST,'whatILearned',FILTER_SANITIZE_STRING));
    $resources= trim(filter_input(INPUT_POST,'ResourcesToRemember',FILTER_SANITIZE_STRING));

//DATE CHECK FORMAT & IF VALID
    $dateMatch= explode('-',$date);

 if (empty($title)||empty($date)) {
      $error_message = 'Please fill in required fields: Title and/or Date';
    }elseif(count($dateMatch) != 3
         ||strlen($dateMatch[0])!= 4
         ||strlen($dateMatch[1])!= 2
         ||strlen($dateMatch[2])!= 2
         ||!checkdate($dateMatch[1],$dateMatch[2],$dateMatch[0])){
    $error_message = "Invalid Date";
    echo 'Please fill in required fields: Title and/or Date(YYYY-MM-DD)';
  }else{
    if (add_entry($title,$date,$time_spent,$learned,$resources,$id)){
    echo 'Journal Entry added.';
    header('Location: index.php');
    exit;
  } else {
    $error_message = "Could not add entry";
    }
  }
}
    //echo "title =".$title."<br />";
  //}
//}
  /*  if(add_entry($title,$date,$time_spent,$learned,$resources)){
        echo 'Journal Entry added.';
        header('Location: index.php');
        exit;
    } else{
    $error_message = "Could not add entry";
    }
  }
}
*/
?>
<!DOCTYPE php>
<html>
        <section>
            <div class="container">
                <div class="new-entry">
                    <h2>New Entry</h2>
                    <?php
                    if (isset($error_message)){
                        echo "<p class='message'>$error_message</p>";
                    }
                    ?>
                    <form method="POST">
                        <label for="title"> Title</label>
                        <input id="title" type="text" name="title" placeholder="Title" value="<?php echo htmlspecialchars($title); ?>"><br>
                        <label for="date">Date</label>
                        <input id="date" type="date" name="date" placeholder="YYYY-MM-DD" value= "<?php echo htmlspecialchars($date); ?>"><br>
                        <label for="time-spent"> Time Spent</label>
                        <input id="time-spent" type="text" name="timeSpent" placeholder="1 hour" value= "<?php echo htmlspecialchars($time_spent); ?>"><br>
                        <label for="what-i-learned">What I Learned</label>
                        <textarea id="what-i-learned" rows="5" name="whatILearned" placeholder="Today I learned..." value = ""><?php echo htmlspecialchars($learned); ?></textarea>
                        <label for="resources-to-remember">Resources to Remember</label>
                        <textarea id="resources-to-remember" rows="5" name="ResourcesToRemember" placeholder="Treehouse.com" value = ""><?php echo htmlspecialchars($resources); ?> </textarea>
                        <input type="submit" value="Publish Entry" class="button">
                        <a href="index.php" class="button button-secondary">Cancel</a>
                    </form>
                </div>
            </div>
        </section>
    <?php include 'inc/footer.php'; ?>
    </body>
</>
