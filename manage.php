<?php include('prepare.php'); ?>
<div id="tabs">
    <ul>
        <li><a href="#tabs-1">Projecten</a></li>
        <li><a href="#tabs-2">Clusters</a></li>
        <li><a href="#tabs-3">Lessen</a></li>
        <li><a href="#tabs-4">Gebruikers</a></li>
        <li><a href="#tabs-5">Bestanden</a></li>
    </ul>
    <div id="tabs-1">
        <h1> Projecten toevoegen </h1>

        <form action="<?php print parse_link('actions/register_project.php'); ?>" method="post" name="projectRegistration" class="autopost"> 
            <p class="form">
                <label class="adjusted" for="name">Naam van het project:</label>
                <input type="text" class="required" name="name"/>
            </p>
            <p class="form">
                <label class="adjusted" for="max_xp">Prioriteit</label><input name="priority" readonly="readonly" /><div class="slider" data-min="0" data-max="100" data-target='input[name="priority"]'></div>
            </p>
            <p class="form">
                <label class="adjusted" for="description">Beschrijving:</label>
                <textarea type="text" name="description"></textarea>
            </p>
            <p class="form">
                <label class="adjusted" for="background">Achtergrond (Hex, inclusief #):</label>
                <input type="color" class="required" name="background">
            </p>
            <p><label class="adjusted" for="file">Icoon:</label>
                <input type="file" name="file" /></p>
            <p class="form">
                <label class="adjusted" for="users">Clusters:</label><br>
                <select class="required searchable multi-select" name="clusters" multiple='multiple'>
                    <?php
                    $all_clusters = $db->select("clusters");
                    foreach ($all_clusters as $key => $value) {
                        $name[$key] = $value['name'];
                    }

                    array_multisort($name, SORT_ASC, $all_clusters);

                    foreach ($all_clusters as $key => $value) {
                        echo "<option value='" . $value['id'] . "'>" . $value['name'] . "</option>";
                    }
                    ?>
                </select>
            </p>

            <button class="autopostSubmit" value="Registreren" />Registreren</button>
        </form> 
        <div id="projectRegistration-result">

        </div>
    </div>
    <div id="tabs-2">
        <h1>Cluster toevoegen</h1>

        <form action="<?php parse_link('actions/add_cluster.php'); ?>" method="post" name="clusterRegistration" class="autopost">
            <label class="adjusted" for="cluster_name">Cluster naam:</label><br>
            <input type="text" class="required" name="name"/><br>

            <label class="adjusted" for="users">Selecteer leerlingen:</label><br>
            <select class="required searchable multi-select" name="users" multiple='multiple'>
                <?php
                $all_users = $db->select("users");
                foreach ($all_users as $key => $value) {
                    $first_name[$key] = $value['first_name'];
                    $last_name[$key] = $value['last_name'];
                }

                array_multisort($last_name, SORT_ASC, $first_name, SORT_ASC, $all_users);

                foreach ($all_users as $key => $value) {
                    echo "<option value='" . $value['id'] . "'>" . $value['last_name'] . ", " . $value['first_name'] . " " . $value['insertion_name'] . "</option>";
                }
                ?>
            </select><br>

            <label class="adjusted" for="projects">Selecteer projecten:</label><br>
            <select  class="required searchable multi-select" name="projects" multiple="multiple">
                <?php
                $test = $db->select("projects", array("name", "id"));
                sort($test);
                $projects = count($test);

                for ($i = 0; $i < $projects; $i++) {
                    $name = $test[$i]['name'];
                    echo '<option value="'.$test[$i]['id'].'">'.$name."</option>";
                }
                ?>
            </select><br>

            <button class="autopostSubmit" value="Cluster_toevoegen" />Cluster toevoegen</button>
        </form>
        <div id="clusterRegistration-result">

        </div>


    </div>
    <div id="tabs-3">
        <h1>Les toevoegen</h1>

        <form action="<?php parse_link('actions/add_course.php'); ?>" method="post" name="create_course" class="autopost">
            <p><label class="adjusted" for="course_name">Naam les:</label>
                <input type="text" class="required" name="name"/></p>
			
			<p class="form">
                <label class="adjusted" for="max_xp">Maximale XP</label><input name="max_xp" readonly="readonly" /><div class="slider" data-min="0" data-max="1000" data-target='input[name="max_xp"]'></div>
            </p>			
			
			<p><label class="adjusted" for="course_name">Youtube embedlink:</label>
                <input type="text" class="required" name="youtube"/></p>

            <p><label class="adjusted" for="description_course">Beschrijving:</label>
                <textarea type="text" name="description_course"></textarea></p>

            <p><label for="file" class="adjusted">Bestand toevoegen aan project:</label>
                <input type="file" name="file"/></p>

            <p><label class="adjusted" for="add_to_project">Toevoegen aan een project:</label>
                <select name="add_to_project">
                    <?php
                    $test = $db->select("projects", array("id","name"));
                    sort($test);

                    $projects = count($test);

                    for ($i = 0; $i < $projects; $i++) {
                        echo "<option value='".$test[$i]['id']."'>".$test[$i]['name']."</option>";
                    }
                    ?>
                </select></p>

            <p class="form">
                <label class="adjusted" for="birthdate">Deadline:</label><br> 
                <input class="datepicker" class="required" name="birth_date" value="yyyy-mm-dd"/> 
            </p>

            <button class="autopostSubmit" value="les_toevoegen" />Les toevoegen</button>
        </form>
        <div id="create_course-result">

        </div>

    </div>
    <div id="tabs-4">
        <h1> Leering registreren </h1>

        <form action="<?php parse_link('actions/register_user.php'); ?>" method="post" name="userRegistration" class="autopost"> 
            <p><label class="adjusted" for="username">Username:</label> 
                <input type="text" class="required" name="username"/></p>

            <p><label class="adjusted" for="password">Password:</label>
                <input type="password" class="required" name="password1"/></p>

            <p><label class="adjusted" for="password">Confirm Password:</label>
                <input type="password" class="required" name="password2"/></p>

            <p><label class="adjusted" for="firstname">Voornaam:</label>
                <input type="text" class="required" name="first_name"/></p>

            <p><label class="adjusted" for="insertion_name">Tussenvoegsel:</label>
                <input type="text" name="insertion_name"/></p>

            <p><label class="adjusted" for="lastname">Achternaam:</label>
                <input type="text" class="required" name="last_name"/></p>

            <p><label class="adjusted" for="studentnumber">leerlingennummer:</label>
                <input type="text" class="required" name="student_number"/></p>

            <p><label class="adjusted" for="birthdate">geboortedatum:</label>
                <input class="datepicker" class="required" name="birth_date" value="yyyy-mm-dd"/></p>

            <p><label class="adjusted" for="email">E-Mail:</label>
                <input type="text" class="required" name="email"/></p>

            <p><label class="adjusted" for="cluster">Cluster</label>
                <select  class="required" name="cluster">
                    <?php
                    $test = $db->select("clusters", array("name"));
                    sort($test);
                    foreach ($test as $key => $val) {
                        echo "info-test[" . $key . "] = " . $val . "\n";
                    }
                    $clusters = count($test);

                    for ($i = 0; $i < $clusters; $i++) {
                        $name = $test[$i]['name'];
                        echo "<option value='$name'>$name</option>";
                    }
                    ?>
                </select></p>
            <p><label class="adjusted" for="avatar_path">Gebruikersafbeelding:</label>
                <input type="file" name="avatar_path" /></p>

            <button class="autopostSubmit" value="Registreren" />Registreren</button>
        </form> 
        <div id="userRegistration-result"></div>
    </div>
    <div id="tabs-5">
        <h1>Bestanden beheren</h1>

        <form action="<?php parse_link('actions/add_file_to_course.php'); ?>" method="post" name="fileRegistration" enctype="multipart/form-data">
            <p><label class="adjusted" for="cluster_name">Bestandsnaam:</label>
                <input type="text" class="required" name="filename"/></p>

            <p><label class="adjusted" for="users">Selecteer les:</label>
                <select class="required searchable" name="course_id">
                    <?php
                    $all_courses = $db->select('courses', array('course_id', 'name'));
                    foreach ($all_courses as $course) {
                        echo "<option value='" . $course['course_id'] . "'>" . $course['name'] . "</option>";
                    }
                    ?>
                </select></p>
            <p><label class="adjusted" for="file"><input type="file" name="file" /></p>
            <input type="submit" value="Verstuur!"/>
        </form>
    </div>
</div>
<?php include('parts/footer.php'); ?>