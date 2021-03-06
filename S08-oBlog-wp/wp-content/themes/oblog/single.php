<?php 

    //ce fichier sert uniquement à afficher les PAGES


    //fait ENTRE AUTRE un include de header.php 
    get_header();

?>

    <?php 
        //si on a des contenus à afficher...
        if (have_posts()):
            //on boucle sur les contenus à afficher
            while(have_posts()):
                //prépare le contenu pour son affichage
                the_post();
    ?>

        <!-- Je dispose une card: https://getbootstrap.com/docs/4.1/components/card/ -->
        <article class="card">
        <?php 
            //boucle sur les catégories de ce post
            foreach((get_the_category()) as $category):
        ?>
          <div class="card-body">
            <h2 class="card-title"><a href="<?= get_category_link($category) ?>">
        <?php endforeach ?>
            <?php the_title() ?></a></h2>
            <p class="card-text"><?php the_content() ?></p>
            <p class="infos">
              Posté par <?php the_author() ?> le <time datetime="<?= get_the_date('Y-m-d') ?>"><?php the_date() ?></time> dans 
              <?php 
                //boucle sur les catégories de ce post
                foreach((get_the_category()) as $category):
              ?>
              
                <a href="<?= get_category_link($category) ?>" class="card-link">#<?= $category->name ?></a>
              
              <?php endforeach; ?>
            </p>
          </div>
        </article>

        <?php endwhile; ?>
    <?php endif; ?>

        <!-- Je met un element de navigation: https://getbootstrap.com/docs/4.1/components/pagination/ -->
        <nav aria-label="Page navigation example" class="avec-bonus">
          <ul class="pagination justify-content-between">
            <li class="page-item"><a class="page-link" href="#"><i class="fas fa-arrow-left"></i> Previous</a></li>
            <li class="page-item"><a class="page-link" href="#">Next <i class="fas fa-arrow-right"></i></a></li>
          </ul>
        </nav>

        </main>

      
<?php 
    //va chercher le fichier footer.php 
    get_footer();

?>