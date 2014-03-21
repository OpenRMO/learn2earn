<?php include('prepare.php'); ?>
<div id="tabs">
    <ul>
        <li><a href="#tabs-1">Projecten</a></li>
        <li><a href="#tabs-2">Clusters</a></li>
        <li><a href="#tabs-3">Lessen</a></li>
        <li><a href="#tabs-4">Gebruikers</a></li>
    </ul>
    <div id="tabs-1">
        <h1> Projecten toevoegen </h1>

        <form action="<?php print parse_link('actions/register_project.php'); ?>" method="post" name="projectRegistration" class="autopost"> 
            <p class="form">
                <label class="adjusted" for="name">Naam van het project:</label>
                <input type="text" class="required" name="name" data-id="name" />
            </p>
            <p class="form">
                <label class="adjusted" for="period">Periode:</label>
                <select name="period" data-id="period">
                    <option value="1">1</option>
                    <option value="2">2</option>
                    <option value="3">3</option>
                    <option value="4">4</option>
                </select>
            </p>
            <p class="form">
                <label class="adjusted" for="max_xp">Max. Exp.</label><input name="max_xp" readonly/><div class="slider" data-min="100" data-max="1000" data-target='input[name="max_xp"]'></div>
            </p>
            <p class="form">
                <label class="adjusted" for="description">Beschrijving:</label>
                <textarea type="text" name="description" data-id="description"></textarea>
            </p>
            <p class="form">
                <label class="adjusted" for="background">Achtergrond (Hex, geen #):</label>
                <input type="text" class="required" name="background" data-id="background"/>
            </p>
            <p class="form">
                <label class="adjusted" for="cluster">Cluster</label>
                <select class="required" name="cluster">
                    <?php
                    $test = $db->select("clusters", array("name", "id"));
                    foreach($test as $cluster){
                        print '<option value="' . $cluster['id'] . '">' . $cluster['name'] . '</option>';
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
        <p>Morbi tincidunt, dui sit amet facilisis feugiat, odio metus gravida ante, ut pharetra massa metus id nunc. Duis scelerisque molestie turpis. Sed fringilla, massa eget luctus malesuada, metus eros molestie lectus, ut tempus eros massa ut dolor. Aenean aliquet fringilla sem. Suspendisse sed ligula in ligula suscipit aliquam. Praesent in eros vestibulum mi adipiscing adipiscing. Morbi facilisis. Curabitur ornare consequat nunc. Aenean vel metus. Ut posuere viverra nulla. Aliquam erat volutpat. Pellentesque convallis. Maecenas feugiat, tellus pellentesque pretium posuere, felis lorem euismod felis, eu ornare leo nisi vel felis. Mauris consectetur tortor et purus.</p>
    </div>
    <div id="tabs-3">
        <p>Mauris eleifend est et turpis. Duis id erat. Suspendisse potenti. Aliquam vulputate, pede vel vehicula accumsan, mi neque rutrum erat, eu congue orci lorem eget lorem. Vestibulum non ante. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Fusce sodales. Quisque eu urna vel enim commodo pellentesque. Praesent eu risus hendrerit ligula tempus pretium. Curabitur lorem enim, pretium nec, feugiat nec, luctus a, lacus.</p>
        <p>Duis cursus. Maecenas ligula eros, blandit nec, pharetra at, semper at, magna. Nullam ac lacus. Nulla facilisi. Praesent viverra justo vitae neque. Praesent blandit adipiscing velit. Suspendisse potenti. Donec mattis, pede vel pharetra blandit, magna ligula faucibus eros, id euismod lacus dolor eget odio. Nam scelerisque. Donec non libero sed nulla mattis commodo. Ut sagittis. Donec nisi lectus, feugiat porttitor, tempor ac, tempor vitae, pede. Aenean vehicula velit eu tellus interdum rutrum. Maecenas commodo. Pellentesque nec elit. Fusce in lacus. Vivamus a libero vitae lectus hendrerit hendrerit.</p>
    </div>
    <div id="tabs-4">
        <h1> Leering registreren </h1>

        <form action="<?php parse_link('actions/register_user.php'); ?>" method="post" name="userRegistration" class="autopost"> 
            <label class="adjusted" for="username">Username:</label><br> 
            <input type="text" class="required" name="username" data-id="username" /> <br>

            <label class="adjusted" for="password">Password:</label><br> 
            <input type="password" class="required" name="password1" data-id="password1" /> <br>
            <label class="adjusted" for="password">Confirm Password:</label><br> 
            <input type="password" class="required" name="password2" data-id="password2" /> <br>

            <label class="adjusted" for="firstname">First Name:</label><br>
            <input type="text" class="required" name="first_name" data-id="firstname"/><br>

            <label class="adjusted" for="lastname">Last Name:</label><br>
            <input type="text" class="required" name="last_name" data-id="lastname"/><br>

            <label class="adjusted" for="studentnumber">Student Number:</label><br>
            <input type="text" class="required" name="student_number" data-id="studentnumber"/><br>

            <label class="adjusted" for="birthdate">Birth Date:</label><br>
            <input class="datepicker" class="required" name="birth_date" data-id="birthdate" value="yyyy-mm-dd"/><br>

            <label class="adjusted" for="email">E-Mail:</label><br>
            <input type="text" class="required" name="email" data-id="email"/><br>

            <label class="adjusted" for="cluster">Cluster</label><br>
            <select  class="required" name="cluster">
                <?php
                $test = $db->select("clusters", array("name"));
                $clusters = count($test);

                for ($i = 0; $i < $clusters; $i++) {
                    $name = $test[$i]['name'];
                    echo "<option value='$name'>$name</option>";
                }
                ?>
            </select><br>

            <button class="autopostSubmit" value="Registreren" />Registreren</button>
        </form> 
        <div id="userRegistration-result">

        </div>
    </div>
</div>
<?php include('parts/footer.php'); ?>