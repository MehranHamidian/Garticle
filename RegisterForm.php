<div class="RegiserForm">
        <form action="<?php htmlspecialchars($_SERVER["PHP_SELF"])?>" method="post">
            <div class="token">
                <input type="hidden" name="RegisterToken" value="<?php echo $_SESSION["token"] ?? ""?>">
            </div>
            <div class="username">
                <label for="username">username</label>
                <input type="text" name="username" id="username" value="<?php echo $inputs["username"] ?? "" ?>">
                <small style="color: red;"><?php echo $errors["username"] ?? ''?></small>         
            </div>
            <div class="FirstName">
                <label for="FirstName">first name</label>
                <input type="text" name="FirstName" id="FirstName" value="<?php echo $inputs["FirstName"] ?? "" ?>">
                <small style="color: red;"><?php echo $errors["FirstName"] ?? " "?></small>
            </div>
            <div class="LastName">
                <label for="LastName">last name</label>
                <input type="text" name="LastName" id="LastName" value="<?php echo $inputs["LastName"] ?? "" ?>">
                <small style="color: red;"><?php echo $errors["LastName"] ?? " "?></small>
            </div>
            <div class="email">
                <label for="email">Email</label>
                <input type="email" name="email" id="email" value="<?php echo $inputs["email"] ?? ""?>">
                <small style="color: red;"><?php echo $errors["email"] ?? " "?></small>
            </div>
            <div class="submit">
                <input type="submit" value="send">  
            </div>
        </form>
    </div>