


<!-- La barre de recherche ici -->
<div class="search-bar">
    <form action="index.php?controleur=advertisement&action=search" method="post">
        <input type="text" id="jobTitle" placeholder="Job title" class="search-input" name="jobTitle" value="<?php echo $title; ?>">
        <input type="text" id="jobLocation" placeholder="Location" class="search-input" name="location" value="<?php echo $location; ?>">
        <button class="search-btn" type="submit"><b>Search</b></button>
    </form>
</div>


    <div class="job-board container">
        <!-- offre d'emploi ici -->
        <div class="job-list-container">
            <?php if (!empty($tabAdvertisements)) {?>
            <ul class="job-list">
                <?php foreach($tabAdvertisements as $element){ 
                    $company = $bdCompanies->getCompany($element->getIdC());    
                ?>
                <li>
                    <form action="index.php?controleur=advertisement&action=formApply" method="post">
                        <div class="job-card fade-in-section">
                            <h2><?php echo $element->getTitle(); ?></h2>
                            <div class="job-info">
                                <span><?php echo $company->getCity(); ?></span>
                                <span>Salary: <?php echo $element->getSalaire(); ?></span>
                            </div>
            
                            <div class="description-container">
                                <p class="job-description"><?php echo $element->getDescr(); ?></p> 
                            </div>
                            <div class="hidden-title"  style="display: none;">
                                <p><b>Job Type</b></p>
                            </div>
                            <div class="tag-container">
                                <b>
                                    <span class="tag"><?php echo $element->getType(); ?></span>
                                    <span class="tag"><?php echo $element->getWorkingH(); ?></span>

                                </b>
                            </div>
                            <div class="hidden-show">
                                <a href="#" class="show-more"  onclick="toggleDescription(this); return false;">Show more</a>
                            </div>

                        
                            <div class="hidden-description-test" style="display: none;">
                                <div class="tag-container" >
                                <form action="index.php?controleur=advertisement&action=formApply" method="post">
                                        <input type="hidden" name="id" value="<?php echo $element->getId(); ?>">
                                        <button type="submit" class="apply-btn"><b>Apply Now</b></button>
                                    </form>
                                    <a href="#" class="show-more" onclick="toggleDescription(this); return false;">Show less</a>
                                </div>
                            </div>
                        </div>
                        <p hidden name="id"><?php echo $element->getId(); ?></p>
                    </form>
                </li>
                <?php } ?>
            </ul>
            <?php } else { ?>
                <div class="image-text" >
                    <p style="font-size: x-large"><b>No offers were found for your search</b></p>
                </div>
            <?php } ?>
        </div>
        
        
        

        <div class="filter-container">
            <div class="filter-header">
                <h3>Filtres</h3>
                <a href="#" class="clear-filters" onclick="clearFormFilter(); return false;">Clear</a>
            </div>

            <!-- filtre ici -->
            <form id="filterForm" action="index.php?controleur=advertisement&action=searchWithTag" method="post">
                <div class="filter-group">
                    <select id="jobType" name="jobType">
                        <?php if(!isset($jobType)){ ?>
                            <option id="jobTypeID" value="" disabled selected hidden>Job Type</option>
                            <option value="Full-Time">Full-Time</option>
                            <option value="Part-Time">Part-Time</option>
                        <?php }elseif($jobType == "Full-Time"){ ?>
                            <option id="jobTypeID" value="" disabled hidden>Job Type</option>
                            <option value="Full-Time" selected>Full-Time</option>
                            <option value="Part-Time">Part-Time</option>
                        <?php }else{ ?>
                            <option id="jobTypeID" value="" disabled hidden>Job Type</option>
                            <option value="Full-Time">Full-Time</option>
                            <option value="Part-Time" selected>Part-Time</option>
                        <?php } ?>
                    </select>
                </div>

                <div class="filter-group">
                    <select id="tailleCompany" name="tailleCompany">
                    <?php if(!isset($tailleCompany)){ ?>
                            <option id="companySize" value="" disabled selected hidden>Company Size</option>
                            <option value="TPE">TPE</option>
                            <option value="PME">PME</option>
                            <option value="ETI">ETI</option>
                            <option value="GE">GE</option>
                        <?php }elseif($tailleCompany == "TPE"){ ?>
                            <option id="companySize" value="" disabled hidden>Company Size</option>
                            <option value="TPE" selected>TPE</option>
                            <option value="PME">PME</option>
                            <option value="ETI">ETI</option>
                            <option value="GE">GE</option>
                        <?php }elseif($tailleCompany == "PME"){ ?>
                            <option id="companySize" value="" disabled hidden>Company Size</option>
                            <option value="TPE">TPE</option>
                            <option value="PME" selected>PME</option>
                            <option value="ETI">ETI</option>
                            <option value="GE">GE</option>
                        <?php }elseif($tailleCompany == "ETI"){ ?>
                            <option id="companySize" value="" disabled hidden>Company Size</option>
                            <option value="TPE">TPE</option>
                            <option value="PME">PME</option>
                            <option value="ETI" selected>ETI</option>
                            <option value="GE">GE</option>
                        <?php }else{ ?>
                            <option id="companySize" value="" disabled hidden>Company Size</option>
                            <option value="TPE">TPE</option>
                            <option value="PME">PME</option>
                            <option value="ETI">ETI</option>
                            <option value="GE" selected>GE</option>
                        <?php } ?>
                    </select>
                </div>

                <div class="filter-group">
                    <select id="contrat" name="contrat">
                        <?php if(!isset($contrat)){ ?>
                            <option id="contract" value="" disabled selected hidden>Contract</option>
                            <option value="Permanent contract">Permanent contract</option>
                            <option value="Fixed-term contract">Fixed-term contract</option>
                            <option value="Temporary employment contract">Temporary employment contract</option>
                            <option value="Alternance">Alternance</option>
                            <option value="Internship">Internship</option>
                        <?php }elseif($contrat == "Permanent contract"){ ?>
                            <option id="contract" value="" disabled hidden>Contract</option>
                            <option value="Permanent contract" selected>Permanent contract</option>
                            <option value="Fixed-term contract">Fixed-term contract</option>
                            <option value="Temporary employment contract">Temporary employment contract</option>
                            <option value="Alternance">Alternance</option>
                            <option value="Internship">Internship</option>
                        <?php }elseif($contrat == "Fixed-term contract"){ ?>
                            <option id="contract" value="" disabled hidden>Contract</option>
                            <option value="Permanent contract">Permanent contract</option>
                            <option value="Fixed-term contract" selected>Fixed-term contract</option>
                            <option value="Temporary employment contract">Temporary employment contract</option>
                            <option value="Alternance">Alternance</option>
                            <option value="Internship">Internship</option>
                        <?php }elseif($contrat == "Temporary employment contract"){ ?>
                            <option id="contract" value="" disabled hidden>Contract</option>
                            <option value="Permanent contract">Permanent contract</option>
                            <option value="Fixed-term contract">Fixed-term contract</option>
                            <option value="Temporary employment contract" selected>Temporary employment contract</option>
                            <option value="Alternance">Alternance</option>
                            <option value="Internship">Internship</option>
                        <?php }elseif($contrat == "Alternance"){ ?>
                            <option id="contract" value="" disabled hidden>Contract</option>
                            <option value="Permanent contract">Permanent contract</option>
                            <option value="Fixed-term contract">Fixed-term contract</option>
                            <option value="Temporary employment contract">Temporary employment contract</option>
                            <option value="Alternance" selected>Alternance</option>
                            <option value="Internship">Internship</option>
                        <?php }else{ ?>
                            <option id="contract" value="" disabled hidden>Contract</option>
                            <option value="Permanent contract">Permanent contract</option>
                            <option value="Fixed-term contract">Fixed-term contract</option>
                            <option value="Temporary employment contract">Temporary employment contract</option>
                            <option value="Alternance">Alternance</option>
                            <option value="Internship" selected>Internship</option>
                        <?php } ?>
                    </select>
                </div>

                <div class="filter-group">
                    <select id="sector" name="sector">
                        <?php 
                        $tabSector = [];
                        $verif = true;
                        if(!isset($sector)){ ?>
                            <option id="sectorID" value="" disabled selected hidden>Sector</option>
                            <?php foreach($tabCompanies as $element){ 
                                    if(!empty($tabSector)){
                                        for($i = 0; $i < count($tabSector); $i++){
                                            if ($element->getSecteur() == $tabSector[$i]){
                                                $verif = false;
                                            }
                                        }
                                        if($verif){
                                            $tabSector[] = $element->getSecteur();
                                            ?>
                                            <option value="<?php echo $element->getSecteur(); ?>"><?php echo $element->getSecteur(); ?></option>
                                            <?php
                                        }
                                    }else{
                                        $tabSector[] = $element->getSecteur();
                                ?>
                                <option value="<?php echo $element->getSecteur(); ?>"><?php echo $element->getSecteur(); ?></option>
                                <?php } ?>
                                
                            <?php } ?>
                        <?php }else{ ?>
                            <option id="sectorID" value="" disabled hidden>Sector</option>
                            <?php foreach($tabCompanies as $element){ 
                                if(!empty($tabSector)){
                                        for($i = 0; $i < count($tabSector); $i++){
                                            if ($element->getSecteur() == $tabSector[$i]){
                                                $verif = false;
                                            }
                                        }
                                        if($verif){
                                            $tabSector[] = $element->getSecteur();
                                            if($element->getSecteur() == $sector){
                                            ?>
                                            <option value="<?php echo $element->getSecteur(); ?>" selected><?php echo $element->getSecteur(); ?></option>
                                            <?php }else{ ?>
                                                <option value="<?php echo $element->getSecteur(); ?>"><?php echo $element->getSecteur(); ?></option>
                                            <?php }
                                            }

                                    }else{
                                        $tabSector[] = $element->getSecteur();
                                ?>
                                <option value="<?php echo $element->getSecteur(); ?>"><?php echo $element->getSecteur(); ?></option>
                                <?php } ?>
                        <?php }} ?>
                    </select>
                </div>

                <input type="hidden" name="jobTitle" id="hiddenJobTitle" value="<?php echo $title; ?>">
                <input type="hidden" name="location" id="hiddenLocation" value="<?php echo $location; ?>">

                <button class="btn-secondary" type="submit"><b>Apply Filters</b></button>
            </form>
        </div>


    <script src="scripts/script.js"></script>
</body>
</html>