<?php
require_once __DIR__ . '/inc/functions.php';
require_once __DIR__ . '/inc/database.php';
require_once __DIR__ . '/models/Post.php';
require_once __DIR__ . '/models/Comment.php';
require_once __DIR__ . '/models/post_user.php';

session_start();

if (!isset($_SESSION['user']))
    header("Location: sign-in.php");

$db = new DbConnection();
$conn = $db->getConnection();


/**    MAJ ARTICLE   **/

if (isset($_POST['update_id'])) {
    if (!empty($_POST['titre']) and !empty($_POST['description'])) {
        $titre = htmlspecialchars($_POST['titre']);
        $description = htmlspecialchars($_POST['description']);

        if (isset($_FILES['file']) && !empty($_FILES['file']['name'])) {
            $tmpName = $_FILES['file']['tmp_name'];
            $name = $_FILES['file']['name'];
            $size = $_FILES['file']['size'];
            $error = $_FILES['file']['error'];

            $tabExtension = explode('.', $name);
            $extension = strtolower(end($tabExtension));

            $uniqueName = uniqid('', true);
            //uniqid génère quelque chose comme ca : 5f586bf96dcd38.73540086
            $file = $uniqueName . "." . $extension;
            move_uploaded_file($tmpName, './assets/img/' . $file);
            $query = $conn->prepare('update posts set titre=?, description=?,image=?, date_modification = now() where id_post = ? ');
            $query->execute(array($titre, $description, $file, $_POST['update_id']));
        } else {
            $query = $conn->prepare('update posts set titre=?, description=?, date_modification = now() where id_post = ? ');
            $query->execute(array($titre, $description, $_POST['update_id']));
        }


    }
}


/**  FIN MAJ ARTICLE    **/


/**    AJOUTER UN POST   **/

else if (!empty($_POST['titre']) and !empty($_POST['description']) && isset($_FILES['file'])) {
    $titre = htmlspecialchars($_POST['titre']);
    $description = htmlspecialchars($_POST['description']);

    $tmpName = $_FILES['file']['tmp_name'];
    $name = $_FILES['file']['name'];
    $size = $_FILES['file']['size'];
    $error = $_FILES['file']['error'];

    $tabExtension = explode('.', $name);
    $extension = strtolower(end($tabExtension));

    $uniqueName = uniqid('', true);
    //uniqid génère quelque chose comme ca : 5f586bf96dcd38.73540086
    $file = $uniqueName . "." . $extension;
    move_uploaded_file($tmpName, './assets/img/' . $file);


    $pseudolength = strlen($titre);

    if ($pseudolength <= 255) {


        try {
            $bdd = new PDO('mysql:host=localhost;dbname=blog;charset=utf8', 'root', '');

        } catch (exception $e) {

            die('Erreur : ' . $e->getMessage());
        }

        $insertmbr = $bdd->prepare('INSERT INTO  posts (titre,description,image,id_user,date_creation) VALUES(?,?,?,?,now()) ');
        $insertmbr->execute(array($titre, $description, $file, $_SESSION['user']->id));
        //var_dump($req);
        $erreur = 'votre post a eté ajouter';
    } else {
        $erreur = 'erreur';
    }


}


/**  FIN AJOUT POST    **/


/**  afficher les commentaires **/
$query = $conn->prepare('select * from comments, posts, utilisateur where comments.id_user=id and comments.id_post=posts.id_post order by comments.date_creation desc;');
$query->execute();
$comments = $query->fetchAll(PDO::FETCH_CLASS, 'comment');


?>
<html lang="en" itemscope itemtype="http://schema.org/WebPage">

<head>
    <meta charset="utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="apple-touch-icon" sizes="76x76" href="assets/img/apple-icon.png">
    <link rel="icon" type="image/png" href="assets/img/favicon.png">
    <title>
        Blog Khalil Abid
    </title>
    <!--     Fonts and icons     -->
    <link rel="stylesheet" type="text/css"
          href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700,900|Roboto+Slab:400,700"/>
    <!-- Nucleo Icons -->
    <link href="assets/css/nucleo-icons.css" rel="stylesheet"/>
    <link href="assets/css/nucleo-svg.css" rel="stylesheet"/>
    <!-- Font Awesome Icons -->
    <script src="https://kit.fontawesome.com/42d5adcbca.js" crossorigin="anonymous"></script>
    <!-- Material Icons -->
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons+Round" rel="stylesheet">
    <!-- CSS Files -->
    <link id="pagestyle" href="assets/css/material-kit.css?v=3.0.0" rel="stylesheet"/>
</head>

<body class="blog-author bg-gray-200">
<!-- Navbar Transparent -->
<?php include "nav.php" ?>
<!-- End Navbar -->
<!-- -------- START HEADER 4 w/ search book a ticket form ------- -->
<header>
    <di class="page-header min-height-300" style="background-image: url('assets/img/fond.jpg');" loading="lazy">
        <span class="mask bg-gradient-dark opacity-8"></span>
    </di>
</header>
<!---->
<main


<div class="container my-3">


    <div class="card-body text-center">
        <h4 class="card-title">POSTS</h4>
        <p class="card-text">Gerer vos posts</p>
    </div>
    <div class="card">


        <!-- Button trigger modal -->
        <button type="button" class="btn btn btn-success position-relative" data-bs-toggle="modal"
                data-bs-target="#exampleModal">
            Ajouter un post
        </button>

        <!-- Modal -->
        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Ajouter Post</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <form method="POST" action="" enctype="multipart/form-data">
                        <div class="modal-body">


                            <div class="mb-3">
                                <label for="title" class="form-label">Titre</label>
                                <input type="text" name="titre" class="form-control" id="title">
                            </div>

                            <div class="mb-5">
                                <label for="description" class="form-label">Description</label>
                                <input type="text" name="description" class="form-control" id="description">
                            </div>

                            <div class="mb-5">
                                <label for="file">photo</label>
                                <input type="file" name="file" id="file">
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Save changes</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <table class="table table-hover">
            <thead>
            <tr>
                <th scope="col">ID</th>
                <th scope="col">POST</th>
                <th scope="col">utilisateur</th>
                <th scope="col">Modifier/supprimer</th>
                <th scope="col"> publié le</th>
                <th scope="col"> mis a jour</th>
            </tr>
            </thead>
            <tbody>
            <?php foreach ($posts as $post) { ?>

                <tr>
                    <th scope="row"><?php echo $post->id_post ?></th>
                    <td><?php echo $post->titre ?></td>
                    <td><?php echo $post->nom ?></td>

                    <td>
                        <button type="button" class="btn btn-sm btn-outline-primary" data-bs-toggle="modal"
                                data-bs-target="#editModal<?php echo $post->id_post ?>">
                            Editer
                        </button>


                        <a class="btn btn-sm btn-danger" href="delete-post-<?php echo $post->id_post ?>"><i
                                    class="fas fa-trash-alt"></i> Supprimer</a>
                    </td>
                    <td>  <?php echo $post->date_creation ?> </td>
                    <td>  <?php echo $post->date_modification ?> </td>
                </tr>

            <?php } ?>
            </tbody>
        </table>

    </div>

</div>
</main>


<!-- afficher les commentaires -->

<main>
    <div class="container my-5">
        <div class="card-body text-center">
            <h4 class="card-title">liste des commentaires </h4>
            <p class="card-text">Gerer les commentaires</p>
        </div>
        <div class="card">


            <table class="table table-hover">
                <thead>
                <tr>
                    <th scope="col">publié le</th>
                    <th scope="col">POST</th>
                    <th scope="col">utilisateur</th>
                    <th scope="col">Commentaire</th>
                    <th scope="col">Validé</th>
                    <th scope="col">Action</th>
                </tr>
                </thead>
                <tbody>
                <?php foreach ($comments as $comment) { ?>
                    <tr>
                        <td><?php echo $comment->date_creation ?></td>
                        <td><?php echo $comment->nom ?></td>
                        <td><?php echo $comment->titre ?></td>
                        <td><?php echo $comment->comment ?> </td>
                        <td><i class="fa <?php echo $comment->validated ? 'fa-check' : 'fa-ban' ?>"></i></td>

                        <td>


                            <?php if ($comment->validated == false) { ?>
                                <a class="btn btn-sm btn-primary"
                                   href="validate-comment-<?php echo $comment->id_comment ?>"><i
                                            class="far fa-edit"></i> Valider</a>
                                <?php
                            }

                            ?>


                            <a class="btn btn-sm btn-danger"
                               href="delete-comment-<?php echo $comment->id_comment ?>"><i
                                        class="fas fa-trash-alt"></i> Supprimer</a>
                        </td>

                    </tr>

                <?php } ?>
                </tbody>
            </table>

        </div>
        <!-- Large modal -->


        <div class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel"
             aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="card-body text-center">
                        <h4 class="card-title">Special title treatment</h4>
                        <p class="card-text">With supporting text below as a natural lead-in to additional content.</p>
                    </div>
                    <div class=" card col-8 offset-2 my-2 p-3">
                        <form>
                            <div class="form-group">
                                <label for="listname">List name</label>
                                <input type="text" class="form-control" name="listname" id="listname"
                                       placeholder="Enter your listname">
                            </div>
                            <div class="form-group">
                                <label for="datepicker">Deadline</label>
                                <input type="text" class="form-control" name="datepicker" id="datepicker"
                                       placeholder="Pick up a date">
                            </div>
                            <div class="form-group">
                                <label for="datepicker">Add a list item</label>
                                <div class="input-group">

                                    <input type="text" class="form-control" placeholder="Add an item"
                                           aria-label="Search for...">
                                    <span class="input-group-btn">
                    <button class="btn btn-secondary" type="button">Go!</button>
                  </span>
                                </div>
                            </div>
                            <div class="form-group text-center">
                                <button type="submit" class="btn btn-block btn-primary">Sign in</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>

<!---->


<?php

foreach ($posts as $post) {
    ?>
    <div class="modal fade" id="editModal<?php echo $post->id_post ?>" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Ajouter Post</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form method="POST" action="" enctype="multipart/form-data">
                    <div class="modal-body">
                        <input type="hidden" name="update_id" value="<?php echo $post->id_post ?>">

                        <div class="mb-3">
                            <label for="title" class="form-label">Titre</label>
                            <input type="text" name="titre" value="<?php echo $post->titre ?>" class="form-control"
                                   id="title">
                        </div>

                        <div class="mb-5">
                            <label for="description" class="form-label">Description</label>
                            <input type="text" name="description" value="<?php echo $post->description ?>"
                                   class="form-control" id="description">
                        </div>


                        <div class="mb-5">
                            <label for="file">photo</label>
                            <img class="img-fluid img-thumbnail" src='assets/img/<?php echo $post->image ?>'>
                            <input type="file" name="file" id="file">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Save changes</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <?php
}
?>


<!---->
<footer>
    <div class="container bg-info p-2">

    </div>
</footer>
</body>
<!--   Core JS Files   -->
<script src="./assets/js/core/popper.min.js" type="text/javascript"></script>
<script src="./assets/js/core/bootstrap.min.js" type="text/javascript"></script>
<script src="./assets/js/plugins/perfect-scrollbar.min.js"></script>

</html>
