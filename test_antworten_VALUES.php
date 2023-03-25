<?php
   
    if(isset($_GET['weiter'])) {

        $selectedAnswer = $_SESSION['selectedAnswer'];
        $selectedAnswer[] = $_POST['answer'];
        $_SESSION['selectedAnswer'] = $selectedAnswer;
        
        $fragenIndex = $_SESSION['fragenListe'];
        array_shift($fragenIndex);
        $_SESSION['fragenListe'] = $fragenIndex;
        if(!empty($fragenIndex)) {
            header("Location: antworten.php?fragen_id=" . $fragenIndex[0]);
        } else {
            header("Location: finaleUebersicht.php");
            exit();
        }
    }

?>

<form action="?weiter=1" method="post">
<p>Selected answer: <?php echo !empty($selectedAnswer) ? implode(', ', $selectedAnswer) : ''; ?></p>

    <p><?php foreach ($selectedAnswer as $antwort_id) {echo $antwort_id . " ";} ?></p>
    <p><?php foreach ($_SESSION['fragenListe'] as $fragen_id) {echo $fragen_id . " ";} ?></p>
    <p><?php echo $currentFrage; ?></p>
    <input type="hidden" name="question_id" value="<?php echo $fragen_id; ?>">

    <button type='submit' name='answer' value='<?php echo $currentAntworten[0]; ?>'><?php echo $currentAntworten[0]; ?></button>
    <button type='submit' name='answer' value='<?php echo $currentAntworten[1]; ?>'><?php echo $currentAntworten[1]; ?></button>
    <button type='submit' name='answer' value='<?php echo $currentAntworten[2]; ?>'><?php echo $currentAntworten[2]; ?></button>
    <button type='submit' name='answer' value='<?php echo $currentAntworten[3]; ?>'><?php echo $currentAntworten[3]; ?></button>

</form>