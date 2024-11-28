<div class="profile-container">
    <!-- Texte au-dessus du bloc de profil -->
<?php if($people == null){?>

    <div class="profile-box">
        <h2>Apply for this job</h2>
        <form action="index.php?controleur=advertisement&action=apply" method="post" enctype="multipart/form-data">
            <input type="hidden" name="id" value="<?php echo $idA; ?>">
            <!-- Group for First Name and Name -->
            <div class="form-group">
                <input name="firstName" type="text" placeholder="First Name*" maxlength="20" required>
                <input name="name" type="text" placeholder="Last Name*" maxlength="20" required>
            </div>

            <!-- Group for Email and Phone -->
                <input name="email" type="email" placeholder="Email*" maxlength="320" required>
                <input name="phone" type="tel" placeholder="Phone*" maxlength="10" required>

            <!-- Upload new CV -->
            <div class="form-group">
            <label for="cvUpload" class="file-upload-label"><b>Upload your CV</b></label>
            </div>

            <input type="file" id="cvUpload" name="cvUpload" accept=".pdf, .doc, .docx">

            <!-- Message textarea -->
            <div class="form-group">
                <textarea id="message" name="message" placeholder="Write your message here..." rows="4" maxlength="500"></textarea>
            </div>


            <!-- Button for applying changes -->
            <button type="submit" class="apply-btn">Apply</button>
        </form>
    </div>

    
<?php } else { ?>

    <div class="profile-box">
        <h2>Apply for this job</h2>
        <form action="index.php?controleur=advertisement&action=apply" method="post" enctype="multipart/form-data">
        <input type="hidden" name="id" value="<?php echo $idA; ?>">
            <!-- Group for First Name and Name -->
            <div class="form-group">
                <input name="firstName" type="text" placeholder="First Name*" maxlength="20" value="<?php echo $people->getFirstName(); ?>" required>
                <input name="name" type="text" placeholder="Last Name*" maxlength="20" value="<?php echo $people->getName(); ?>" required>
            </div>

            <!-- Group for Email and Phone -->
                <input name="email" type="email" placeholder="Email*" maxlength="320" value="<?php echo $people->getEmail(); ?>" required>
                <input name="phone" type="tel" placeholder="Phone*" maxlength="10" value="<?php echo $people->getPhone(); ?>" required>

            <!-- Upload new CV -->
            <div class="form-group">
            <label for="cvUpload" class="file-upload-label"><b>Upload your CV</b></label>
            </div>

            <input type="file" id="cvUpload" name="cvUpload" accept=".pdf, .doc, .docx">

            <!-- Message textarea -->
            <div class="form-group">
                <textarea id="message" name="message" placeholder="Write your message here..." rows="4" maxlength="500"></textarea>
            </div>

            <!-- Button for applying changes -->
            <button type="submit" class="apply-btn">Apply</button>
        </form>
    </div>

    <?php } ?>
</div>