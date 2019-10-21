<?php
/**
 * The template for displaying the footer.
 *
 * @package OceanWP WordPress theme
 */ ?>

        </main><!-- #main -->

        <?php do_action( 'ocean_after_main' ); ?>

        <?php do_action( 'ocean_before_footer' ); ?>

        <?php
        // Elementor `footer` location
        if ( ! function_exists( 'elementor_theme_do_location' ) || ! elementor_theme_do_location( 'footer' ) ) { ?>

            <?php do_action( 'ocean_footer' ); ?>
            
        <?php } ?>

        <?php do_action( 'ocean_after_footer' ); ?>
                
    </div><!-- #wrap -->

    <?php do_action( 'ocean_after_wrap' ); ?>

</div><!-- #outer-wrap -->

<?php do_action( 'ocean_after_outer_wrap' ); ?>

<?php
// If is not sticky footer
if ( ! class_exists( 'Ocean_Sticky_Footer' ) ) {
    get_template_part( 'partials/scroll-top' );
} ?>

<?php
// Search overlay style
if ( 'overlay' == oceanwp_menu_search_style() ) {
    get_template_part( 'partials/header/search-overlay' );
} ?>

<?php
// If sidebar mobile menu style
if ( 'sidebar' == oceanwp_mobile_menu_style() ) {
    
    // Mobile panel close button
    if ( get_theme_mod( 'ocean_mobile_menu_close_btn', true ) ) {
        get_template_part( 'partials/mobile/mobile-sidr-close' );
    } ?>

    <?php
    // Mobile Menu (if defined)
    get_template_part( 'partials/mobile/mobile-nav' ); ?>

    <?php
    // Mobile search form
    if ( get_theme_mod( 'ocean_mobile_menu_search', true ) ) {
        get_template_part( 'partials/mobile/mobile-search' );
    }

} ?>

<?php
// If full screen mobile menu style
if ( 'fullscreen' == oceanwp_mobile_menu_style() ) {
    get_template_part( 'partials/mobile/mobile-fullscreen' );
} ?>
<?php wp_footer(); ?>



<script>
 /* 
Lorsque l'utilisateur fait défiler l'écran vers le bas, masquez la barre de navigation. Lorsque l'utilisateur fait défiler vers le haut, affichez la barre de navigation */
            
            var positionAvantSCrollY = window.pageYOffset;
            var navbar = document.getElementById("site-header");/***la navbar */
            var sticky = navbar.offsetTop;
            var logo=document.getElementById("site-logo-inner");/****le logo */
            var mainContainer=document.getElementById("main");/***cibler le main menu */
            var LinkNav = document.getElementsByClassName("menu-link"); /*ciblé tout les a des li de la nav*/
            var iconePanier=document.getElementsByClassName("wcmenucart-count");
            window.onscroll = function() {
            var PositionActuelAxeY = window.pageYOffset;
            //lorseque tu scroll en bas
                if (positionAvantSCrollY < PositionActuelAxeY) {
                    document.getElementById("site-header").style.top = "-155px";
                   
                    
                }
                //lorsque tu scroll en haut
                else if (positionAvantSCrollY > PositionActuelAxeY){
                        navbar.classList.add("sticky")
                        logo.style.height="100%";
                        mainContainer.style.paddingTop='100px';
                        logo.style.height="110px";
                        navbar.style.top = "0px";  
                        navbar.style.setProperty('background', 'rgba(64, 64, 64, 0.65)', 'important');
                        
                       
                }
                //lorsque tu arrives sur la page 
                else{
                        navbar.classList.add("sticky")
                        logo.style.height="100%";
                        mainContainer.style.paddingTop='100px';
                        logo.style.height="110px";
                        navbar.style.top = "0px"; 
                        
                         }

                /****couleur du header: si la position actuel est égale à la position d'avant sinon il devient un peu  transparent  
                         le but c'est de  le rendre un peu transparent au retour du scroll*/
                       if(positionAvantSCrollY = PositionActuelAxeY){
                        /***background de la nav bar */
                            navbar.style.setProperty('background', 'black', 'important');
                        /****icone du panier */
                            for(i=0;i<iconePanier.length;i++){
                                iconePanier[i].style.color="white";
                            }
                        
                        /***mettre les link en color black en scrolant en haut */
                        
                            for (i=0;i<LinkNav.length;i++){ /*avec la boucle for on cible chaque élément a */
                                LinkNav[i].style.setProperty('color', 'white', 'important');/***colorié en black tout les a de la nav */
                            }

                       }else{
                            navbar.style.setProperty('background', 'rgba(46, 0, 8, 0.65)', 'important'); 
                        /***en revenant du scrol jusqua'en haut les link redeviennent blanc */
                            for (i=0;i<LinkNav.length;i++){ /*avec la boucle for on cible chaque élément a */
                                LinkNav[i].style.setProperty('color', 'white', 'important');/***colorié en black tout les a de la nav */
                            }
                        /****icone du panier */
                            for(i=0;i<iconePanier.length;i++){
                                iconePanier[i].style.color="white";
                            }
                       
                       }

                }
 
</script>






</body>
</html>