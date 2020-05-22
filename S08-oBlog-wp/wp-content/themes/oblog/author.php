<?php get_header(); ?>
<?php
if(isset($_GET['author_name'])) :
$curauth = get_userdatabylogin($author_name);
else :
$curauth = get_userdata(intval($author));
endif;
?>

<?php 
        //si on a des contenus à afficher...
        if (have_posts()): ?><h2 class="card-title">Les articles de <?php echo $curauth->nickname; ?> sur oBlog :</h2>
            <?php //on boucle sur les contenus à afficher
            while(have_posts()):
                //prépare le contenu pour son affichage
                the_post();
      ?>

        <!-- Je dispose une card: https://getbootstrap.com/docs/4.1/components/card/ -->
        <article class="card">
          <div class="card-body">
            <h2 class="card-title"><a href="<?php the_permalink() ?>"><?php the_title() ?></a></h2>
            <p class="card-text"><?php the_excerpt() ?></p>
            <p class="infos">
              Posté par <?php the_author() ?> le <time datetime="<?= get_the_date('Y-m-d') ?>"><?php the_date() ?></time> dans <?php 
                //boucle sur les catégories de ce post
                foreach((get_the_category()) as $category):
            ?>
            
                <a href="<?= get_category_link($category) ?>" class="card-link">#<?= $category->name ?></a>
            
            <?php endforeach; ?>
            </p>
          </div>
        </article>

        <?php endwhile; ?>
    <?php else: ?>
        <div class="card-body">
            <h2 class="card-title">Oh non ! Cet auteur n'a pas encore écrit d'article !</h2>
            <p class="card-text">Vous pouvez retourner à <a href="<?= home_url() ?>" class="card-link">l'accueil</a>.</p>
            <p class="card-text">En revanche si vous avez perdu votre curseur, <a href="https://pointerpointer.com/" class="card-link">ces gens</a> peuvent vous aider !</p>
            <p class="card-text">Enfin si vous voulez faire de beaux dessins abstraits, je vous conseille d'aller <a href="http://weavesilk.com/" class="card-link">dessiner</a>.</p>
        </div>
        
    <?php endif ?>
<?php get_footer(); ?>