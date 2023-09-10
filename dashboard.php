<?php
require_once("templates/header.php");

// Verifica se usuário está autenticado
require_once("models/User.php");
require_once("dao/UserDAO.php");

$user = new User();
$userDao = new UserDao($conn, $BASE_URL);


$userData = $userDao->verifyToken(true);


?>
<!-- Mova a barra lateral para fora do cabeçalho -->
<?php if ($userData) : ?>
  <aside id="sidebar" class="custom-bar">
    <ul class=" sidebar-nav">
      <!-- Links da barra lateral -->
      <li class="sidebar-item">
        <a href="<?= $BASE_URL ?>newusers.php" class="sidebar-link">
          <i class="far fa-plus-square"></i> Adicionar Usuário
        </a>
      </li>
      <li class="sidebar-item">
        <a href="<?= $BASE_URL ?>dashboard.php" class="sidebar-link">Dashboard</a>
      </li>
      <li class="sidebar-item">
        <a href="<?= $BASE_URL ?>editprofile.php" class="sidebar-link">
          <i class="fas fa-user"></i> <?= $userData->name ?>
        </a>
      </li>
      <li class="sidebar-item">
        <a href="<?= $BASE_URL ?>logout.php" class="sidebar-link">Sair</a>
      </li>
      <!-- Adicione mais links conforme necessário -->
    </ul>
  </aside>
<?php endif; ?>
<div id="main-container-dashboard-page" class="dashboard-page dashboard-content">
  <h2 class="section-title">Dashboard</h2>
  <p class="section-description">Adicione ou atualize as informações de Usuários</p>
  <div class="col-md-12" id="add-users-container">
    <a href="<?= $BASE_URL ?>newusers.php" class="btn card-btn">
      <i class="fas fa-plus"></i> Adicionar Usuário
    </a>
  </div>
  <div class="col-md-12" id="users-dashboard">
    <table class="table">
      <thead>
        <th scope="col">#</th>
        <th scope="col">Nome</th>
        <th scope="col">Setor</th>
        <th scope="col">Tipo de Permissão</th>
        <th scope="col" class="actions-column">Ações</th>
      </thead>
      <tbody>
        <?php foreach ($userUsers as $users) : ?>
          <tr>
            <td scope="row"><?= $users->id ?></td>
            <td><a href="<?= $BASE_URL ?>users.php?id=<?= $users->id ?>" class="table-users-title"><?= $users->title ?></a></td>
            <td><i class="fas fa-star"></i> <?= $users->rating ?></td>
            <td class="actions-column">
              <a href="<?= $BASE_URL ?>createUsers.php?id=<?= $users->id ?>" class="edit-btn">
                <i class="far fa-edit"></i> Editar
              </a>
              <form action="<?= $BASE_URL ?>createUsersProcess.php" method="POST">
                <input type="hidden" name="type" value="delete">
                <input type="hidden" name="id" value="<?= $users->id ?>">
                <button type="submit" class="delete-btn">
                  <i class="fas fa-times"></i> Deletar
                </button>
              </form>
            </td>
          </tr>
        <?php endforeach; ?>
      </tbody>
    </table>
  </div>
</div>
<?php
require_once("templates/footer.php");
?>