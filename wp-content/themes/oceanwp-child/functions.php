<?php
// Exit if accessed directly
if ( !defined( 'ABSPATH' ) ) exit;

// BEGIN ENQUEUE PARENT ACTION
// AUTO GENERATED - Do not modify or remove comment markers above or below:

if ( !function_exists( 'chld_thm_cfg_locale_css' ) ):
    function chld_thm_cfg_locale_css( $uri ){
        if ( empty( $uri ) && is_rtl() && file_exists( get_template_directory() . '/rtl.css' ) )
            $uri = get_template_directory_uri() . '/rtl.css';
        return $uri;
    }
endif;
add_filter( 'locale_stylesheet_uri', 'chld_thm_cfg_locale_css' );
         
if ( !function_exists( 'child_theme_configurator_css' ) ):
    function child_theme_configurator_css() {
        wp_enqueue_style( 'chld_thm_cfg_child', trailingslashit( get_stylesheet_directory_uri() ) . 'style.css', array( 'font-awesome','simple-line-icons','magnific-popup','slick','oceanwp-style','oceanwp-woo-mini-cart','oceanwp-woocommerce','oceanwp-woo-star-font','oceanwp-woo-quick-view' ) );
    }
endif;
add_action( 'wp_enqueue_scripts', 'child_theme_configurator_css', 10 );

// END ENQUEUE PARENT ACTION


/* 
==========================================================================
LA SECURITE DU COMPTE
==========================================================================
*/

/* 
 * Supprimer la barre d'administration pour les non admin
*/

    function suppression_barre_admin( $voir_barre ) {

        if ( ! current_user_can( 'administrator' ) ) {

            return false;
        }
        return $voir_barre;
    }
    add_filter( 'show_admin_bar', 'suppression_barre_admin' );

/* 
 * Bloquer l'acces à la page d'administration pour les non admin 
*/
    function Bloque_access_non_admin() {
        if ( is_admin() && ! current_user_can( 'administrator' ) && ! ( defined( 'DOING_AJAX' ) && DOING_AJAX ) ) {

            wp_safe_redirect( home_url() );

            exit;
        }
    }
    add_action( 'admin_init', 'Bloque_access_non_admin' );

/*
 * Rederigé les visiteurs à l'accueil apres la deconnexion 
*/

    function auto_redirect_apres_deconnexion(){

        wp_redirect( home_url() );

        exit();
    }
    add_action('wp_logout','auto_redirect_apres_deconnexion');

/*
 * Rederiger les utilisateurs apres la connexion 
*/
    function redirection_apres_connexion( ) {

        return home_url( );

    }
    add_filter( 'login_redirect', 'redirection_apres_connexion' );

/*
 * Affichage de connexion ou mon compte selon le statut de l'utilisateur
*/ 

function add_login_logout_register_menu( $items, $args ) {
    
    if ( is_user_logged_in() ){

        if($args->theme_location == 'main_menu'){
         
            $items .= '<li  class="menu-item menu-item-type-post_type menu-item-object-page menu-item-compte"><a href="'.get_home_url() .'/mon-compte/" aria-current="page" class="menu-link">' . __( '<img class="icone_compte" src="'.get_site_url().'/wp-content/uploads/2019/07/user-with-suit-tie-and-star_icon-icons.com_68272.ico" alt="mon-compte_boutica" width="41">' ) . '</a></li>';
        } else {
            
            $items .= '<li  class="menu-item menu-item-type-post_type menu-item-object-page current-menu-item page_item page-item-154 current_page_item menu-item-compte-footer"><a  href="'. wp_logout_url() .'" aria-current="page" class="menu-link" >' . __( 'Deconnexion' ) . '</a></li>';
            
        }
    }
    else{

        $items .= '<li  class="menu-item menu-item-type-post_type menu-item-object-page current-menu-item page_item page-item-154 current_page_item menu-item-346"><a href="'.get_home_url() .'/mon-compte/" aria-current="page" class="menu-link" >' . __( 'connexion' ) . '</a></li>';
    
    }
    return $items;  
}

add_filter( 'wp_nav_menu_items', 'add_login_logout_register_menu', 10, 2 );


/* 
==========================================================================
LA PAGE JOURNAL
==========================================================================
*/
/* Supprimer la barre latérale de recherche à l'affichage de la liste des résultats */
    function remove_search_sidebar( $layout ) {
        
        if ( is_search() ) {

            $layout = 'full-width';
        }

        return $layout;
    }

    add_filter( 'ocean_post_layout_class', 'remove_search_sidebar', 20 );

/* 
==========================================================================
Optimisation W3C avec le plugin autoptimize_html_after_minify installé
==========================================================================
*/

add_filter('autoptimize_html_after_minify', function($content) {
	    $site_url =  get_home_url().'/'; 

        /* Suppression des percentage="" , type='text/css',type='text/javascript', dans html et les remplacés par un élément vide '' */
        $liste   = array("type='text/css'",'type="text/css"',"type='text/css'","type='text/javascript'",'type="text/javascript"','type="application/javascript"','percentage="1"','percentage="2"','percentage="2"','a:FOCUS{@tab1}','a:FOCUS{@tab2}','a:ACTIVE{@tab2}','ing:FOCUS{@tab1}');
        $content = str_replace($liste , ' ', $content);
        /*replace les balises sections par div car j'ai un warning de mettre un titre h2 à h6 en dessous de section */
        $content = str_replace('<section', '<div', $content);
        $content = str_replace('</section', '</div', $content);
        
        /* insertion d'un élémént img dans la balise picture , car l'élément ne contient pas et c'est une erreur w3c */
        $content = str_replace('</picture>', '<img src="#" alt="image"></picture>', $content);
        /* maps w3c*/
        $liste_erreur_maps   = array('frameborder="0"','scrolling="no"','marginheight="0"','marginwidth="0"');
        $content = str_replace($liste_erreur_maps  , ' ', $content);
        /***slider des meilleurs produits page accueil */
        /**le font-size du slide est vide je vais le supprimer */
        $erreur1_slider_meilleurs_produits  = 'style="color:#626262;font-size:"';
        $content = str_replace($erreur1_slider_meilleurs_produits  , 'style="color:#626262;font-size:1.2em"', $content);
        
        $erreur2_slider_meilleurs_produits  = 'rgba(0, 0, 0, 0);)';
        $content = str_replace($erreur2_slider_meilleurs_produits  , 'rgba(0, 0, 0, 0)', $content);
        /***erreur script sur tt les pages */
        $erreur_script = 'lang: en_US</script>';
        $content = str_replace($erreur_script  , '</script>', $content);
        /***correction de cette erreur dans la page blog ( Bad value true for attribute selected on element option ) */
        $erreur_page_blog = '<option selected="true" disabled="disabled">';
        $content = str_replace($erreur_page_blog  , '<option selected disabled="disabled">', $content);

        /******correction de l'erreur sur page produit unique( bad value inputmode="numeric" et max="") */
        $erreur_page_produit = array('inputmode="numeric"','max=""');
        $content = str_replace($erreur_page_produit  ,'', $content);
        /***erreur duplicat facebook root sur toute les pages  */
        $erreur_fb_root = '</span></a><div id="fb-root"></div>';
        $content = str_replace($erreur_fb_root  ,'</span></a>', $content);
/*
    optimisation w3c pour les boutons de partage sur la page fiche produit car elle ils contiennent des éléments obsolètes 
*/
        $liste_erreurs_boutons_partage   = array('cellspacing="0"','ss-offset="0"','alt="Facebook"','alt="Instagram"','alt="Whatsapp"','alt="Pinterest"','alt="Linkedin"','alt="MeWe"','alt="Reddit"','alt="More"','alt="Total Shares"',' super-socializer-data-href ','super-socializer-no-counts="1"','alt="Viber"','alt="Facebook Messenger"');
        $content = str_replace($liste_erreurs_boutons_partage , '  ', $content);

        // remplacer les éléments <ss> et </ss> par des <sapan>
        //1 
        $erreurs_balise_ss_ouverte   = array('<ss');
        $content = str_replace($erreurs_balise_ss_ouverte , '<span', $content);
        // 2
        $erreurs_balise_ss_fermante   = array('</ss');
        $content = str_replace($erreurs_balise_ss_fermante , '</span', $content);


        // 2 erreur w3c  href non alowed dans la div  super-socializer-data-href="http://localhost/maboutique/boutique/chemises/chemise-coupe-cintree-en-chevron/" (le href contient le lien de la page de la fiche produit visité et qu on veut partager)
        // récupéré le lien de la page  
        global $wp;
        $url_page_actuelle = $current_url =home_url().'/'.$wp->request;
        // remplacer l'erreur par un vide 
        $erreurdatahref='super-socializer-data-href="'.$url_page_actuelle.'/'.'"';
        $content = str_replace($erreurdatahref ,' ', $content);

	return $content;    }, 10, 1);
    
    /* supprimer l 'erreur Bad value https://api.w.org/ for attribute rel on element link */
    remove_action( 'wp_head', 'rest_output_link_header', 10);    
    remove_action( 'template_redirect', 'rest_output_link_header', 11);

    /* suppression des (id="product_id_' . $product->get_id() . '")  en double à cause du bouton vu rapide qui double les id ce qui cause des erreurs w3c*/
    
    function custom_quick_view($output){

        global $product;

        /**j'ai supprimé  id="product_id_' . $product->get_id() . '"  dans ce link pour éviter l'erreur de doublure de l id ------W3C***/

        $output  = '<a href="#"  class="owp-quick-view" data-product_id="' . $product->get_id() . '"><i class="icon-eye"></i>' . esc_html__( 'Quick View', 'oceanwp' ) . 
        
        '</a>';  //Edit the $output as you want

        return $output;
    }
    add_filter('ocean_woo_quick_view_button_html','custom_quick_view');


/* 
==========================================================================
LA PAGE CONNEXION - INSCRIPTION
==========================================================================
*/
/*
 Ajout de la div qui contienne une  classe mon_formulaire qui englobe les deux formulaires connexion et inscription ,car ils sont en mode display (block et none ) quand l'un est block l'autre none , mais ils ont la meme classe sur la page login à l'aid de hook  
 */

// Avant le formulaire (Le conteneur des formulaires connextion et inscription)
    function action_woocommerce_before_customer_login_form( $evolve_woocommerce_before_customer_login_form ) { 

    // la div ajoutée

        echo'<div class="mon_formulaire"> <p class="text-logo"> BOUTICA </p>';

    }; 
         
    add_action( 'woocommerce_before_customer_login_form', 'action_woocommerce_before_customer_login_form', 10, 1 );  // le hook qui place l'élémént avant le formulaire


// Apres le formulaire (Le conteneur des formulaires connextion et inscription) 
    function action_woocommerce_after_customer_login_form( $evolve_woocommerce_after_customer_login_form ) { 

        // La fermeture de la div

        echo'</div>';
    }; 
             
    // Le hook qui place l'élément après le formulaire 
    add_action( 'woocommerce_after_customer_login_form', 'action_woocommerce_after_customer_login_form', 10, 1 ); 


 /* 
 Ajout classe bas_login dans la boite de connexion  avec le hook woocommerce_login_form   et woocommerce_login_form_end
 c'est pour customiser les éléments qui se trouvent au dessou des input username et password
 */

    function action_woocommerce_login_form(  ) { 
        echo' <div class="bas_login">'; 

    }; 
         
    add_action( 'woocommerce_login_form', 'action_woocommerce_login_form', 10, 0 );

/* La fin du formulaire connexion */

    function action_woocommerce_login_form_end(  ) { 

        echo'</div>'; 

    }; 
         
    add_action( 'woocommerce_login_form_end', 'action_woocommerce_login_form_end', 10, 0 );
/* 
==========================================================================
LA customisation ude la page de connexion à l'administration
==========================================================================
*/

/* supprimé le  logo */

    function changerLogoLogin() {

        echo '<style> h1 a {display:none !important}</style>';
    }
    add_action('login_head', 'changerLogoLogin');

/* le formulaire admin connexion */

    function action_login_header(  ) { ?>

    <!-- ajout d'une div avec la class="main_container" pour contenir le login afin de le styliser -->

    <div  style="min-height:100vh;background-repeat:no-repeat; background-size: cover ;background-color:#eaf1b3">
    <h2 id="bienvenue_login" 
        style="margin:0px auto;
               text-align:center;
               font-size:1.8em;
               padding:50px 0px 0px;">

    <!-- linké le text vers la page d'accueil -->
        <a class="titre-login-adm" href="'<?php home_url() ?>"><img src="<?php echo home_url().'/wp-content/uploads/2019/07/monlogoretina.png'; ?>" alt="boutica logo"></a> </h2>
    <?php }
    add_action( 'login_header', 'action_login_header', 10, 0 ); 

    function style_login() { ?>
        <style >
            /* le style du titre du formulaire de connexion de l'administration */
            .titre-login-adm{text-decoration:none ;
                color:white !important;
                padding:10px;
                line-height:38px;
                font-size:2em !important;
                display:block;
                text-align:center;
                width: 100%;
            /* enlever les lignes bleux en click avec outline et box-shadow*/
                outline: 0;
                box-shadow: none!important;   
            }
            /* le hover effect */
            .titre-login-adm:hover{color:black !important;}
            /* le style du formulaire login administration*/
            #login{
            padding:1% 0% 0% !important;
            }
            .login form{
                border-radius:20px;
                background-color:brown !important;
                color:white;
                margin:0 auto;
            }

            /* le bouton submit du login form */
            #wp-submit{
                width: 80%;
                margin:15px 10% 0px;
                background-color: black;
                border-radius:10px;
                padding:5px;
                height:40px;
                line-height:25px;
            }
            #wp-submit:hover{
                color:black;
                background-color:white;
            }

            /* style du text d'oublie du password */
            #login p{
                width:100%;
            }
            #login p a{
                color:black !important;
                display:block;
                text-align:center;
                width:86%;
            /* enlever les lignes bleux en click avec outline et box-shadow*/
                outline: 0;
                box-shadow: none!important;  
            }
            #login p a:hover{
            background-color:red !important;
            padding:5px;
            border-radius:5px;
            color:white !important;
            }
            /* display none du retour à la boutique car j'ai linké le titre du login vers la boutique ******/
            #backtoblog{
                display:none;
            }
        </style>

<?php
     }
    add_action( 'login_enqueue_scripts', 'style_login' );

/* La fermeture de la div du formulaire admin avec le hook du footer login */

    function action_login_footer(  ) { 

        // La div de fermeture
        echo'</div>';
    }         
    add_action( 'login_footer', 'action_login_footer', 10, 0 );  


/* Le logo de la page qui s'affiche en s'appuiyant sur  oublie password Page admin */

    function lostPasswordAdminLogin(  ) { 
        // fin du main container
        ?> 
        <img src="<?php echo home_url().'/wp-content/uploads/2019/07/monlogoretina.png'; ?>" alt="boutica logo" id="logo_lost_password">
        <?php
    }        
    add_action( 'woocommerce_lost_password_message', 'lostPasswordAdminLogin', 10, 0 ); 


/* 
==========================================================================
LA PAGE FICHE PRODUIT SIMPLE 
==========================================================================
*/

 /*
  * Le nombre de produits vendus
 */
 add_action( 'woocommerce_after_add_to_cart_button', 'bbloomer_show_return_policy', 20,0);
 
    function bbloomer_show_return_policy() {

        global $product;

        $units_sold = get_post_meta( $product->get_id(), 'total_sales', true );

            if ( $units_sold ) {
                
                echo '<div style="padding-top:10px;color:brown;text-align:center">' . sprintf( __( 'Le nombre de pièces vendues:'.'<p style="color:blue;    font-size:1.5em;text-align:center">  %s pièces </p>', 'woocommerce' ), $units_sold ) . '</div>';
            }
            else{
                echo '<div style="padding-top:10px;color:brown;text-align:center;">' . sprintf( __( 'Le nombre de pièces vendues:'.'<p style="color:blue;font-size:1.5em;text-align:center">  0  pièces </p>', 'woocommerce' ), $units_sold ) . '</div>';
                
            }
    }
/*
 * Affichage de l'explication pour les prix en double sur la fiche produit
*/
    function Text_sur_prix() {

        echo '<p class="rtrn">30-jous pour pouvoir retourner le produit. regarde les détails dans <a href="'.home_url().'/conditions-generales-de-ventes" class="lien_condition_fiche_produit">Les conditions générales de vente </a> </p>';

    }
    add_action( 'woocommerce_single_product_summary', 'Text_sur_prix', 5 );

 /* 
  * affichage message de condition 
 */

    function condition_de_vente() {

        echo '<p class="rtrn">30-jous pour pouvoir retourner le produit. regarde les détails dans <a href="'.home_url().'/conditions-generales-de-ventes" class="lien_condition_fiche_produit">Les conditions générales de vente </a> </p>';
  
    }
    add_action( 'woocommerce_single_product_summary', 'condition_de_vente', 20 );
/*
 * Les boutons de partage du plugin Sharedaddy integration
*/
    function sharedaddy_for_woocommerce() {
        ?>
            <div class="social"><p class="titre_partage" <?php if(is_product()){ echo"style='display:block'";} else{echo 'style="display:none"';} ?>>
                Partager avec vos proches</p><?php echo do_shortcode('[TheChamp-Sharing total_shares="ON"]');?>
            </div>
            <?php
    }
    add_action( 'woocommerce_after_add_to_cart_form', 'sharedaddy_for_woocommerce' );

/* 
==========================================================================
LA PAGE BOUTIQUE 
==========================================================================
*/

/* 
 * ajout du  formulaire de recherche ajax avec le hook woocommerce_archive_description 
*/
    function messagePlusAjaxRecherche() {

        echo '<div id="barre_recherche_shop">'.do_shortcode('[wpdreams_ajaxsearchlite]') .'</div>'; 

    }
    add_action('woocommerce_before_shop_loop', 'messagePlusAjaxRecherche',30);

/* affichage du bloc élémentor (service client,paiement sécurisé,) en bas de la page boutique */
    function affichageApresLoopProduits(){

        if(is_shop() ){

                echo do_shortcode('[oceanwp_library id="645"]'); 

            }
    } 
    add_action( 'woocommerce_after_shop_loop', 'affichageApresLoopProduits', 30 ); // le hook qui permet d'afficher des éléments en fin de la boucle des produit

/* faire des affichages differents selon la catégorie de produit recherché */

    function affichageAvantLoopProduits(){

        if(is_shop() ){

            echo '<h1 style="color:white ; text-align:center"> Bienvenue Chez Boutica Shop </h1>'; 
        } 
        elseif(is_product_category()){

            if(is_product_category('chemises')){
                
                 echo'<div class="titre_selection_categorie"> La selection Chemises</div>';

            /*affichage du slider du plugin que j'ai installé SLIDER BY 10WEB */

                if( function_exists('wd_slider') ) { 

                    wd_slider(1); 
                } 
            }elseif(is_product_category('costumes')){

                echo'<div class="titre_selection_categorie"> La selection Costumes</div>';

            /*affichage du slider du plugin que j'ai installé SLIDER BY 10WEB */

                if( function_exists('wd_slider') ) { 

                    wd_slider(2); 
                } 
      
            }elseif(is_product_category('chaussures')){

                echo'<div class="titre_selection_categorie"> La selection Chaussures</div>';

            /* Affichage du model élémentor que j'ai installé pour les chaussures */

                echo do_shortcode('[oceanwp_library id="2253"]'); 
            }
            elseif(is_product_category('accessoires')){
            ?>
                <div class="container_filtre">	
                </div> 
            <?php
            }
            elseif(is_product_category('cravates')){

                echo'<div class="titre_selection_categorie"> La selection Cravates</div>';

            /* Affichage du model élémentor que j'ai installé pour les cravates */

                echo do_shortcode('[oceanwp_library id="2277"]'); 
            }
   
        }
    }
    add_action( 'woocommerce_before_shop_loop', 'affichageAvantLoopProduits', 30 ); // le hook qui gere la fonction au dessu 

/*
 * supprimer la description du produit sur page shop en haut , il est par defaut 
*/
    remove_action( 'woocommerce_archive_description', 'woocommerce_taxonomy_archive_description', 10 );

/* 
==========================================================================
LA PAGE ADMINISTRATION
==========================================================================
*/

/* 
 * admin supprimer les widget dans l'administration 
*/

    function style_dashboard() { ?>
        <style >
            /* effacer les widget sur l'espace d'administration*/
            #message,#heateor_ss_browser_notification,.notice,#updraft-dashnotice,#footer-left,.updated ,.sfsi_show_premium_notification,#wpfooter{
                display: none !important;   
            }
            /* arrière plan de l'administration */
            #welcome-panel{
            background-color:#dfd5c9 !important;
            }
        </style> 

    <?php
    }
    add_action( 'wp_dashboard_setup', 'style_dashboard' );

/* 
==========================================================================
LA PAGE COMPTE
==========================================================================
*/

/* 
 * change nom des liens  compte
*/

    function my_account_menu_order() {
        $menuOrder = array(
            'dashboard'          => __( 'Accueil', 'woocommerce' ),
            'orders'             => __( 'Commandes', 'woocommerce' ),
            'downloads'          => __( 'Download', 'woocommerce' ),
            'edit-address'       => __( 'Adresse', 'woocommerce' ),
            'edit-account'    	=> __( 'Détails du compte', 'woocommerce' ),
            'nous_joindre'    	=> __( 'Nous joindre', 'woocommerce' ),
            'customer-logout'    => __( 'Déconnexion', 'woocommerce' )
    
        );
        return $menuOrder;
    }
    add_filter ( 'woocommerce_account_menu_items', 'my_account_menu_order' );

/* 
* changer apparence des listes compte 
*/
remove_action('woocommerce_account_navigation','woocommerce_account_navigation'); // supprimer les liens par defaut de woocommerce
// remplacer la nav du compte par ma nav personnelle en créant un endpoint
    function change_nav_compte(){
    
        ?>
        <!-- la nav que je remplace à la place de celle par défaut  -->
            <nav class="woocommerce-MyAccount-navigation">
                <ul class="liste_liens_compte">
                    <?php foreach ( wc_get_account_menu_items() as $endpoint => $label ) : ?>
                        <li class="<?php echo wc_get_account_menu_item_classes( $endpoint ); ?>">
                            <a href="<?php echo esc_url( wc_get_account_endpoint_url( $endpoint ) ); ?>"><?php echo esc_html( $label ); ?></a>
                        </li>
                    <?php endforeach; ?>
                </ul>
            </nav>
        <!--  mon menu mobile pour mon compte que je viens de créer juste au dessou -->
        <div class="menu_compte_mobile">
            <button onclick="myFunction()" class="dropbtn">Choisir une option</button>

            <ul id="myDropdown" class="dropdown-content ">
                <?php foreach ( wc_get_account_menu_items() as $endpoint => $label ) : ?>
                    <li class="<?php echo wc_get_account_menu_item_classes( $endpoint ); ?>">
                        <a href="<?php echo esc_url( wc_get_account_endpoint_url( $endpoint ) ); ?>"><?php echo esc_html( $label ); ?></a>
                    </li>
                <?php endforeach; ?>
            </ul>
        </div>
        <!--  script javascript pour les nouveaux menu que je viens de créer juste au dessu -->
        <script>
            //quand l'utilisateur click sur le bouton les menus apparaissent 
            function myFunction() {
                document.getElementById("myDropdown").classList.toggle("show");
                }

                // fermer le menu si l'utilisateur click en dehors du menu
                window.onclick = function(event) {
                if (!event.target.matches('.dropbtn')) {
                    var dropdowns = document.getElementsByClassName("dropdown-content");
                    var i;
                    for (i = 0; i < dropdowns.length; i++) {
                    var openDropdown = dropdowns[i];
                        if (openDropdown.classList.contains('show')) {
                            openDropdown.classList.remove('show');
                        }
                    }
                }
            }
        </script>

    <?php 

    } add_filter( 'woocommerce_account_navigation' ,'change_nav_compte'); 

  /* 
   * création d' une zonne widget dans page compte pour produits consultés recemments 
  */
  function compte_widgets_init() { // initialisé le widget apres en le rajoute juste en bas 
      
    register_sidebar( array(
  
    'name' => 'Widget page compte',
    'id' => 'widget_compte',
    'before_widget' => '<div class="le_widget">',
    'after_widget' => '</div>',
    'before_title' => '<h2 class="le_widget_titre">',
    'after_title' => '</h2>',
    ) );
  }
  add_action( 'widgets_init', 'compte_widgets_init' ); // widget initialisé et près à étre rajouter

/*
  * Ajout des liens  dans la page mon compte 
*/
    function modification_page_compte(  ) { 
        // récupéré l'utilisateur
        global $current_user;
        // affiché l'utilisateur dans le message de bienvenue
        echo '<h1 style="text-align:center"> Bienvenu <strong>'.' '. $current_user->user_login .' '. ' </strong> sur votre espace personnel </h1>' ;
        // Le menu que j'ajoute dans la page compte
        echo    '<ul class="liens_blind">
                <li id="suivi_commande"> Suivi de commande </li>   
                <li id="infos_activite">Infos et activité</li>
                <li id="meilleurs_produits"> Produit phares </li>
                <li id="contacter_nous"> Contact </li>
                </ul>';
            ?>
        <script>
        // faire des événements en cliquant sur chacun des liens
        $(document).ready(function(){
         
            /* lien suivie de commande */ 
                $('#suivi_commande').on('click', function () {

                    $(".woocommerce-form-track-order").toggle("blind");
                    /*si j'ai déja effectuer une recherche elle affiche le résultat*/
                    $(".resultat_de_commande").toggle("blind");
                    /**cacher les vue en appuiyant sur un autre  */
                    $("#widget_page_compte").hide();
                    $(".meilleur_produits_blind").hide();
                    $(".formulaire_blind").hide();

                 });
            /* infos et activité */      
                $(document).ready(function () {
                    /* lien info activite */
                    $('#infos_activite').on('click', function () {
                    $("#widget_page_compte").toggle("blind");
                    $("#widget_page_compte").css("display","flex");
                    /**cacher les vue en appuiyant sur un autre  */
                    $(".woocommerce-form-track-order").hide();
                    $(".meilleur_produits_blind").hide();
                    $(".formulaire_blind").hide();
                    $(".resultat_de_commande").hide();

                });
           /* lien contact */ 
                $('#contacter_nous').on('click', function () {

                    $(".formulaire_blind").toggle("blind");
                    /**cacher les vue en appuiyant sur un autre  */
                    $("#widget_page_compte").hide();
                    $(".woocommerce-form-track-order").hide();
                    $(".resultat_de_commande").hide();
                    $(".meilleur_produits_blind").hide();
                });
            /* meilleurs produits compte */
                $('#meilleurs_produits').on('click', function () {

                    $(".meilleur_produits_blind").toggle("blind");
                    /**cacher les vue en appuiyant sur un autre  */
                    $("#widget_page_compte").hide();
                    $(".formulaire_blind").hide();
                    $(".resultat_de_commande").hide();
                    $(".woocommerce-form-track-order").hide();
                });
         
            });
        })
      </script>
        <?php 
        // suivi de commande affichage du formulaire de suivi de commande
            echo '<div class="resultat_de_commande suivi_commande">';
            echo do_shortcode('[woocommerce_order_tracking]');
            echo '</div>';
            //infos et activité
            //la zone widger est crée avant juste cette fonction  
            //-- ajout de ma nouvelle widget -->
            if ( is_active_sidebar( 'widget_compte' ) ) : ?>

            <div id="widget_page_compte" class="nwa-header-widget" role="complementary">
                <?php dynamic_sidebar( 'widget_compte' ); ?>
            </div>

            <?php endif;
            //  fin zone widget compte   
        //Meilleurs produits
            echo '<div class="meilleur_produits_blind">';
            echo do_shortcode('[top_rated_products]');
            echo '</div>';
        // ajout contact form
            echo'<div class="formulaire_blind">';
            echo do_shortcode('[contact-form-7 id="241" title="formulaire de contact"]');
            echo'</div>';
    } 
        
    add_action( 'woocommerce_account_dashboard', 'modification_page_compte', 10, 0 ); 

/* 
 * Ajout du lien Nous joindre avec un formulaire de contact qui est le même que la page contact 
*/
    // 1) initialisé le lien
    function inistialise_nouveau_lien() {

        add_rewrite_endpoint( 'nous_joindre', EP_ROOT | EP_PAGES );
    }
    add_action( 'init', 'inistialise_nouveau_lien' );


   // 2) inséré le lien
    function wk_new_menu_items( $items ) {

        $items[ 'nous_joindre' ] = __( 'Nous joindre', 'webkul' );

        return $items;
    }
    add_filter( 'woocommerce_account_menu_items', 'wk_new_menu_items' );

   // 3) nomé le lien comme on veut

    $endpoint = 'nous_joindre';

   // 4)  faire affiché le lien  sur la nav du compte
    function wk_endpoint_content() {
        //le contenu
        echo do_shortcode('[contact-form-7 id="241" title="formulaire de contact"]');

    }
    add_action( 'woocommerce_account_' . $endpoint .  '_endpoint', 'wk_endpoint_content' );






  
















 








