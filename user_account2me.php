<?php
require_once('classes/database.php');
$con = new database();
session_start();
 if (! isset($_SESSION['username']) || $_SESSION['account_type'] != 1){
  header('location:login.php');
  exit();
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Welcome!</title>
  <link rel="stylesheet" href="./bootstrap-5.3.3-dist/css/bootstrap.css">
  <!-- Bootstrap CSS -->
  <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
  <!-- For Icons -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
<link rel="stylesheet" href="./includes/style.css">

<link rel="stylesheet" href="package/dist/sweetalert2.css">


</head>
<body>

<?php include('includes/navbar.php');?>
    <div class="container my-5">
        <h2 class="text-center">User Profiles</h2>
        <div class="card-container">
            <?php
            $data = $con->view();
            foreach ($data as $rows) {
            ?>
            <div class="card">
                <div class="card-body text-center">
                    <?php if (!empty($rows['user_profile_picture'])): ?>
                        <img src="<?php echo htmlspecialchars($rows['user_profile_picture']); ?>" alt="Profile Picture" class="profile-img">
                    <?php else: ?>
                        <img src="path/to/default/profile/pic.jpg" alt="Default Profile Picture" class="profile-img">
                    <?php endif; ?>
                    <h5 class="card-title"><?php echo htmlspecialchars($rows['user_firstname']) . ' ' . htmlspecialchars($rows['user_lastname']); ?></h5>
                    <p class="card-text"><strong>Birthday:</strong> <?php echo htmlspecialchars($rows['user_birthday']); ?></p>
                    <p class="card-text"><strong>Sex:</strong> <?php echo htmlspecialchars($rows['user_sex']); ?></p>
                    <p class="card-text"><strong>Username:</strong> <?php echo htmlspecialchars($rows['user_name']); ?></p>
                    <p class="card-text"><strong>Address:</strong> <?php echo ucwords(htmlspecialchars($rows['address'])); ?></p>
                    <form method="POST" class="d-inline">
                        <input type="hidden" name="id" value="<?php echo htmlspecialchars($rows['user_id']); ?>">
                    </form>
                </div>
            </div>
            <?php
            }
            ?>
        </div>
    </div>
  </div>
</div>
</div>



<!-- Bootstrap JS and dependencies -->
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
<script src="./bootstrap-5.3.3-dist/js/bootstrap.js"></script>
<!-- Bootsrap JS na nagpapagana ng danger alert natin -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>

<script src="package/dist/sweetalert2.js"></script>

<!-- Pop Up Messages after a succesful transaction starts here --> <script>
document.addEventListener('DOMContentLoaded', function() {
  const params = new URLSearchParams(window.location.search);
  const status = params.get('status');

  if (status) {
    let title, text, icon;
    switch (status) {
      case 'success':
        title = 'Success!';
        text = 'Record is successfully deleted.';
        icon = 'success';
        break;
        case 'Login':
        title = 'Success!';
        text = 'Record is successfully Login.';
        icon = 'success';
        break;
        case 'daddy':
        title = 'Success!';
        text = 'Record is already daddy.';
        icon = 'error';
        break;
      case 'error':
        title = 'Error!';
        text = 'Something went wrong.';
        icon = 'error';
        break;
      default:
        return;
    }
    

    Swal.fire({
      title: title,
      text: text,
      icon: icon
    }).then(() => {
      // Remove the status parameter from the URL
      const newUrl = window.location.origin + window.location.pathname;
      window.history.replaceState(null, null, newUrl);
    });
  }
});
</script> <!-- Pop Up Messages after a succesful transaction ends here -->

</body>
</html>
