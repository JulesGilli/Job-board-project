<div class="profile-container">

    <div class="profile-box">
        <h2>Profile of <?php echo $people->getFirstName()." ".$people->getName(); ?></h2>
        <form action="index.php?action=updateUser" method="post" enctype="multipart/form-data">
            <div class="form-group">
                <input name="firstName" type="text" placeholder="First Name*" maxlength="20" value="<?php echo $people->getFirstName(); ?>" required>
                <input name="name" type="text" placeholder="Last Name*" maxlength="20" value="<?php echo $people->getName(); ?>" required>
            </div>

                <input name="email" type="email" placeholder="Email*" maxlength="320" value="<?php echo $people->getEmail(); ?>" required>
                <input name="phone" type="tel" placeholder="Phone*" maxlength="10" value="<?php echo $people->getPhone(); ?>" required>

            <div class="form-group">
                <input name="city" type="text" placeholder="City*" maxlength="30" value="<?php echo $people->getCity(); ?>" required>
                <input name="cp" type="text" placeholder="Postal code*" maxlength="5" value="<?php echo $people->getCp(); ?>" required>
            </div>

            <input type="hidden" name="id" value="<?php echo $people->getId(); ?>">

            <button type="submit" class="apply-btn">Apply Changes</button>
        </form>
        <form action="index.php?action=deleteUser" method="post">
            <input type="hidden" name="id" value="<?php echo $people->getId(); ?>">
            <button type="submit" class="apply-btn"><b>DELETE</b></button>
        </form>
    </div>
</div>


</body>
</html>