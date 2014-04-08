<?php
include("prepare.php");
?>

<?php
$course_id = $_GET['course'];
if ($course_id == null) {
    header("Location: portal.php");
}

$query = $db->select("courses", array("course_id"), array("course_id" => $course_id));
if($query == null) {
    header("Location: portal.php");
} else {
    $course = new Course($db,$course_id);
}
?>


<div id="wrapper" id="lessonspage">
    <div id="inleveren" class="width-50 float-left">
	
	<h1> Inleveren van de les: </h1><br><br>
        <form action="<?php parse_link('actions/submit_answers.php'); ?>" method="post" name="inlever" class="autopost">

            <p><input type="hidden" value="<?php echo $course->getID() ?>"></p>

            <p><label class="adjusted" for="titel">Titel:</label>
                <input type="text" class="required" name="name" /></p>


            <p><label class="adjusted" for="description_inlever">Beschrijving:</label>
                <textarea type="text" name="description_inlever"></textarea></p>

            <p><label for="file" class="adjusted">Bestand inleveren project:</label>
                <input type="file" name="file"/></p>

            <button class="autopostSubmit" value="inlever" />Inleveren</button>
        </form>
        <div id="inlever-result"></div>
    </div>

    <div id="lessons" class="width-50 float-right">
		<h1>Dit is les:
		<?php echo $course->getname(); ?>
		</h1><br>
		
        <h1>Het volgende Filmpje hoort bij deze les</h1>

            <iframe width="640" height="360" src="<?php echo $course->getYoutube(); ?>" frameborder="" allowfullscreen></iframe>
        

        <h1>Beschrijving:</h1>

        <?php echo $course->getDescription(); ?>

        <h1>Bestanden die nodig zijn voor deze les</h1>
        <?php 
        $fileList = $db->select("files_courses", array("file_id"), array("course_id"=>$_GET['course']));
        foreach($fileList as $file_id){
            $file_id = $file_id['file_id'];
            
        }
        ?>
        <div class="float-clear"></div>
    </div>

</div>