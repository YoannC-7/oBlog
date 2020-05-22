<?php 

    //ce fichier sert uniquement à afficher les PAGES


    //fait ENTRE AUTRE un include de header.php 
    get_header();

?>
<?php 
    //au cas où l'article n'existe pas
    if (have_posts()):
        //important !!! sinon ça fouère
        the_post();
?>
    <!-- Par défaut (= sur mobile) mon element <main> prend toutes les colonnes (=12)
        MAIS au dela d'une certaine taille, il n'en prendra plus que 9
        https://getbootstrap.com/docs/4.1/layout/grid/#grid-options -->
        <main class="col-lg-12">

<!-- Je dispose une card: https://getbootstrap.com/docs/4.1/components/card/ -->
<article class="card">
  <div class="card-body">
    <h2 class="card-title"><?php the_title() ?></h2>
    <p class="card-text">
        <?php the_content(); ?>
    </p>
  </div>
</article>
<?php 
    endif;
?>    

<?php 

    //va chercher le fichier footer.php 
    get_footer();

?>