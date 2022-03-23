<table>
    <tbody> <?php

    use App\Model\Entity\User;
    use App\Model\Manager\UserManager;

    foreach(UserManager::getAll() as $user) {
        ?>
        <tr>
            <td>ID</td>
            <td><?= $user->getId() ?></td>
        </tr>
        <tr>
            <td>Pseudo</td>
            <td><?= $user->getUsername() ?></td>
        </tr>
        <tr>
            <td>email</td>
            <td><?= $user->getEmail() ?></td>
        </tr>
        <tr>
            <td>Modération</td>
            <td>
                <a href="/index.php?c=user&a=delete-user&id=<?= $user->getId() ?>">Supprimer</a>
            </td>
        </tr>
        <?php
    } ?>
    </tbody>
</table>