<div class="admin-container">
    <h2>Gestion des Users</h2>
    <a href="index.php?action=formAddUser"><button class="detail-btn">Add user</button></a>
    <table class="admin-table">
        <thead>
            <tr>
                <th>First name</th>
                <th>Name</th>
                <th>Email</th>
                <th>Phone number</th>
                <th>City</th>
                <th>Postal code</th>
                <th>Detail</th>
            </tr>
        </thead>
        <tbody>
            <?php 
                $i = 0;
                foreach($tabUsers as $user){ 
                if($user->getId() != 4){
                    $tabId[$i] = $tabId[$i] ?? null;
                    if($user->getId() != $tabId[$i]){
            ?>
            <tr>
                <td><?php echo $user->getFirstName(); ?></td>
                <td><?php echo $user->getName(); ?></td>
                <td><?php echo $user->getEmail(); ?></td>
                <td><?php echo $user->getPhone(); ?></td>
                <td><?php echo $user->getCity(); ?></td>
                <td><?php echo $user->getCp(); ?></td>
                <td>
                    <form action="index.php?action=detailP" method="post">
                        <input type="hidden" name="id" value="<?php echo $user->getId(); ?>">
                        <button type="submit" class="detail-btn">Detail</button>
                    </form>
                </td>
            </tr>
            <?php }else{
                $i++;
            }}} ?>
        </tbody>
    </table>
</div>
