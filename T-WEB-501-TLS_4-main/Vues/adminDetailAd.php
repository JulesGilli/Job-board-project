    <div class="job-board container">
        <div class="job-list-container">
            <ul class="job-list">
                <?php 
                    $company = $bdCompanies->getCompany($advertisement->getIdC());    
                ?>
                <li>
                        <div class="job-card">
                            <h2><?php echo $advertisement->getTitle(); ?></h2>
                            <div class="job-info">
                                <span><?php echo $company->getCity(); ?></span>
                                <span>Salary: <?php echo $advertisement->getSalaire(); ?></span>
                            </div>
            

                            <div class="description-container">
                                <p class="job-description"><?php echo $advertisement->getDescr(); ?></p>
                            </div>
                            <div class="hidden-title"  style="display: none;">
                                <p><b>Job Type</b></p>
                            </div>
                            <div class="tag-container">
                                <b>
                                    <span class="tag"><?php echo $advertisement->getType(); ?></span>
                                    <span class="tag"><?php echo $advertisement->getWorkingH(); ?></span>

                                </b>
                            </div>

                            <div>
                                <div class="tag-container">
                                <form action="index.php?action=deleteAdvertisement" method="post">
                                        <input type="hidden" name="id" value="<?php echo $advertisement->getId(); ?>">
                                        <button type="submit" class="apply-btn"><b>DELETE</b></button>
                                    </form>
                                </div>
                            </div>
                        </div>
                </li>
            </ul>
        </div>
    </div>
</body>
</html>
