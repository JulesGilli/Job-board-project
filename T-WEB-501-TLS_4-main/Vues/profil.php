
<div class="profile-container">

    <div class="profile-box">
        <h2>Your Profile</h2>
        <form action="index.php?controleur=user&action=updateProfile" method="post" enctype="multipart/form-data">
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

            <div class="form-group">
            <label for="cvUpload" class="file-upload-label"><b>Upload your CV</b></label>
            </div>

            <input type="file" id="cvUpload" name="cvUpload" accept=".pdf, .doc, .docx">



            <button type="submit" class="apply-btn">Apply Changes</button>
        </form>
    </div>
</div>


</body>
</html>