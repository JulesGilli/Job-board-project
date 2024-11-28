<div class="admin-container">
    <h2>Gestion des Offres d'Emploi</h2>
    <table class="admin-table">
        <thead>
            <tr>
                <th>Job name</th>
                <th>Company name</th>
                <th>Description</th>
                <th>Detail</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach($tabAdvertisements as $element){ 
                $company = $bdCompanies->getCompany($element->getIdC());    
            ?>
            <tr>
                <td><?php echo $element->getTitle(); ?></td>
                <td><?php echo $company->getNom(); ?></td>
                <td><?php echo substr($element->getDescr(), 0, 50) . '...'; ?></td> <!-- Limite la description à 50 caractères -->
                <td>
                    <form action="index.php?action=detailAdvertisement" method="post">
                        <input type="hidden" name="id" value="<?php echo $element->getId(); ?>">
                        <button type="submit" class="detail-btn">Detail</button>
                    </form>
                </td>
            </tr>
            <?php } ?>
        </tbody>
    </table>
</div>
