<?php global $goldenworks; ?>

/* ================ THEME OPTIONS CSS  ================ */

<?php if($goldenworks['sidebar-position'] == 'left') { ?>
.inner-content {
	margin-left:61px;
}

@media (min-width: 768px) and (max-width: 979px) {
	.inner-content {
		margin-left:41px;
	}
}
<?php } else { ?>
.inner-content {
	margin-right:61px;
}
@media (min-width: 768px) and (max-width: 979px) {
	.inner-content {
		margin-right:41px;
	}
}
<?php } ?>


.fd1 {
	background:<?php if($goldenworks['fdecbg-left']) { echo $goldenworks['fdecbg-left']; } else { echo '#f82e3c'; }?>;	
}
.fd2 {
	background:<?php if($goldenworks['fdecbg-center']) { echo $goldenworks['fdecbg-center']; } else { echo '#34d693'; }?>;
}
.fd3 {
	background:<?php if($goldenworks['fdecbg-right']) { echo $goldenworks['fdecbg-right']; } else { echo '#00aced'; }?>;
}


<?php if($goldenworks['altmenu-columns'] == 5) { ?>
.alt-menu > .menu-item {
	width:20%;
}
<?php } elseif($goldenworks['altmenu-columns'] == 4) { ?>
.alt-menu > .menu-item {
	width:25%;
}
<?php } elseif($goldenworks['altmenu-columns'] == 3) { ?>
.alt-menu > .menu-item {
	width:33.3333%;
}
<?php } ?>



/* ================ portfolio filters  ================ */

<?php if($goldenworks['p1col-filterp'] == 'center') { ?>
.pfw-1col .portfolio-filter {
	text-align:center;	
}
<?php } ?>

<?php if($goldenworks['p2col-filterp-classic'] == 'center') { ?>
.pfw-2col .portfolio-filter {
	text-align:center;	
}
<?php } ?>


<?php if($goldenworks['p3col-filterp-classic'] == 'center') { ?>
.pfw-3col .portfolio-filter {
	text-align:center;	
}
<?php } ?>


<?php if($goldenworks['p4col-filterp-classic'] == 'center') { ?>
.pfw-4col .portfolio-filter {
	text-align:center;	
}
<?php } ?>


<?php if($goldenworks['p3col-filterp-grid'] == 'center') { ?>
.pfw-3grid .portfolio-filter {
	text-align:center;	
}
<?php } ?>


<?php if($goldenworks['p4col-filterp-grid'] == 'center') { ?>
.pfw-4grid .portfolio-filter {
	text-align:center;	
}
<?php } ?>



/* ================ skinning custom styling  ================ */
<?php if($goldenworks['body-background'] || $goldenworks['body-color']) { ?>
body, input, textarea {
	<?php if($goldenworks['body-background']) { echo 'background:' . $goldenworks['body-background'] . ';'; } ?>
	<?php if($goldenworks['body-color']) { echo 'color:' . $goldenworks['body-color'].';'; } ?> 
}
<?php } ?>


<?php if($goldenworks['header-color']) { ?>
h1, h2, h3, h4, h5, h6 {
	color:<?php echo $goldenworks['header-color']; ?>
}
<?php } ?>


<?php if($goldenworks['header-bloglinkcolor']) { ?>
.entry-block h2 a {
	color:<?php echo $goldenworks['header-bloglinkcolor']; ?>
}
<?php } ?>


<?php if($goldenworks['link-color']) { ?>
a, a:hover, .entry-block h2 a:hover, .entry-block .more-link:hover, .entry-misc a:hover, .column-title a:hover, .ts-list li a:hover, .ts-list span a:hover, .hemail a:hover,
.ep-cat a:hover, .port1col-content h3 a:hover, .entry-port-title h4 a:hover, .port-overlay h4 a:hover,
.widget_categories ul li a:hover, .widget_archive ul li a:hover, .widget_nav_menu ul li a:hover, .widget_recent_comments ul li a:hover, .widget_meta ul li a:hover, 
.widget_pages ul li a:hover, .widget_rss ul li a:hover, .widget_gw_categories ul li a:hover, .border-list li a:hover {
	color:<?php echo $goldenworks['link-color']; ?>;
}
<?php } ?>


<?php if($goldenworks['port-overlayicons']) { ?>
.port-zoom a:hover, .port-link a:hover {
	background:<?php echo $goldenworks['port-overlayicons']; ?>
	border:2px solid <?php echo $goldenworks['port-overlayicons']; ?>
}
.port-gridzoom a {
	background:<?php echo $goldenworks['port-overlayicons']; ?>
}
<?php } ?>



<?php if($goldenworks['port-filtercolor']) { ?>
.portfolio-filter li a:hover, .portfolio-filter li .pselected {
	border:1px solid <?php echo $goldenworks['port-filtercolor']; ?>
	background:<?php echo $goldenworks['port-filtercolor']; ?>
}
<?php } ?>


<?php if($goldenworks['news-datebg'] || $goldenworks['news-datetext']) { ?>
.date-news {
	<?php if($goldenworks['news-datebg']) { echo 'background:' . $goldenworks['news-datebg'] . ';'; } ?>
	<?php if($goldenworks['news-datetext']) { echo 'color:' . $goldenworks['news-datetext'] . ';'; } ?>
}
<?php } ?>


<?php if($goldenworks['topmenu-bg'] || $goldenworks['topmenu-textcolor'] || $goldenworks['topmenu-linkcolor'] || $goldenworks['topmenu-linkhover'] || $goldenworks['topmenu-leftborder']) { ?>

<?php if($goldenworks['topmenu-bg']) { ?>
.menu-wrapper, .sf-menu ul, .sf-menu ul li, #megaMenu,
#megaMenu ul.megaMenu li.menu-item.ss-nav-menu-reg ul.sub-menu li.menu-item a, 
#megaMenu ul.megaMenu li.menu-item.ss-nav-menu-reg ul.sub-menu li.menu-item span.um-anchoremulator,
#megaMenu ul.megaMenu li.menu-item.ss-nav-menu-mega ul.sub-menu ul.sub-menu-2 li.menu-item > a,
#megaMenu ul.megaMenu li.menu-item.ss-nav-menu-mega ul.sub-menu ul.sub-menu-2 li.menu-item > span.um-anchoremulator,
#megaMenu ul.megaMenu ul.sub-menu ul.sub-menu-2 li.menu-item > a,
#megaMenu ul.megaMenu ul.sub-menu ul.sub-menu-2 li.menu-item > span.um-anchoremulator {
	<?php echo 'background-color:' . $goldenworks['topmenu-bg'] . ' !important;'; ?>
}
#megaMenu ul.megaMenu ul {
	<?php if($goldenworks['topmenu-bg']) { echo 'background:' . $goldenworks['topmenu-bg'] . ' !important;'; } ?>
}
<?php } ?>


.sf-menu ul li a, .sf-menu ul li:last-child a,
#megaMenu ul.megaMenu li.menu-item.ss-nav-menu-reg ul.sub-menu li.menu-item a, 
#megaMenu ul.megaMenu li.menu-item.ss-nav-menu-reg ul.sub-menu li.menu-item span.um-anchoremulator,
#megaMenu ul.megaMenu li.menu-item.ss-nav-menu-mega ul.sub-menu ul.sub-menu-2 li.menu-item > a,
#megaMenu ul.megaMenu li.menu-item.ss-nav-menu-mega ul.sub-menu ul.sub-menu-2 li.menu-item > span.um-anchoremulator,
#megaMenu ul.megaMenu ul.sub-menu ul.sub-menu-2 li.menu-item > a,
#megaMenu ul.megaMenu ul.sub-menu ul.sub-menu-2 li.menu-item > span.um-anchoremulator {
    <?php if($goldenworks['topmenu-bg']) { echo 'border-left:3px solid ' . $goldenworks['topmenu-bg'] . ' !important;'; } ?>
}


<?php if($goldenworks['topmenu-textcolor']) { ?>
#megaMenu .wpmega-widgetarea .textwidget, #megaMenu .wpmega-widgetarea h2.widgettitle {
	<?php echo 'color:' . $goldenworks['topmenu-textcolor'] . ' !important;'; ?>
}
<?php } ?>


<?php if($goldenworks['topmenu-linkcolor']) { ?>
.menu-wrapper a,
#megaMenu ul.megaMenu > li.menu-item > a, 
#megaMenu ul.megaMenu > li.menu-item > span.um-anchoremulator,
#megaMenu ul.megaMenu li.menu-item.ss-nav-menu-highlight > a, #megaMenu ul.megaMenu li.menu-item.ss-nav-menu-highlight > span.um-anchoremulator,
#megaMenu ul.megaMenu li.menu-item.ss-nav-menu-reg ul.sub-menu li.menu-item a, 
#megaMenu ul.megaMenu li.menu-item.ss-nav-menu-reg ul.sub-menu li.menu-item span.um-anchoremulator,
#megaMenu ul.megaMenu li.menu-item.ss-nav-menu-mega ul.sub-menu ul.sub-menu-2 li.menu-item > a,
#megaMenu ul.megaMenu li.menu-item.ss-nav-menu-mega ul.sub-menu ul.sub-menu-2 li.menu-item > span.um-anchoremulator,
#megaMenu ul.megaMenu ul.sub-menu ul.sub-menu-2 li.menu-item > a,
#megaMenu ul.megaMenu ul.sub-menu ul.sub-menu-2 li.menu-item > span.um-anchoremulator,
.wpmega-widgetarea .widget_categories ul li a, .wpmega-widgetarea .widget_archive ul li a, .wpmega-widgetarea .widget_nav_menu ul li a, .wpmega-widgetarea .widget_recent_comments ul li a, 
.wpmega-widgetarea .widget_meta ul li a, .wpmega-widgetarea .widget_pages ul li a, .wpmega-widgetarea .widget_rss ul li a, .wpmega-widgetarea .widget_gw_categories ul li a, 
.wpmega-widgetarea .border-list li a {
    <?php echo 'color:' . $goldenworks['topmenu-linkcolor'] . ' !important;'; ?>
}
<?php } ?>


<?php if($goldenworks['topmenu-linkhover']) { ?>
.menu-wrapper a:hover,
#megaMenu ul.megaMenu > li.menu-item:hover > a,
#megaMenu ul.megaMenu > li.menu-item > a:hover,
#megaMenu ul.megaMenu > li.menu-item.megaHover > a,
#megaMenu ul.megaMenu > li.menu-item:hover > span.um-anchoremulator,
#megaMenu ul.megaMenu > li.menu-item > span.um-anchoremulator:hover,
#megaMenu ul.megaMenu > li.menu-item.megaHover > span.um-anchoremulator,
#megaMenu ul.megaMenu li.ss-nav-menu-mega ul.sub-menu ul.sub-menu-2 li.menu-item a:hover, 
#megaMenu ul.megaMenu ul.sub-menu ul.sub-menu-2 > li.menu-item:hover > a,
.wpmega-widgetarea .widget_categories ul li a:hover, .wpmega-widgetarea .widget_archive ul li a:hover, .wpmega-widgetarea .widget_nav_menu ul li a:hover, 
.wpmega-widgetarea .widget_recent_comments ul li a:hover, .wpmega-widgetarea .widget_meta ul li a:hover, .wpmega-widgetarea .widget_pages ul li a:hover, 
.wpmega-widgetarea .widget_rss ul li a:hover, .wpmega-widgetarea .widget_gw_categories ul li a:hover, .wpmega-widgetarea .border-list li a:hover,
#megaMenu ul.megaMenu li.menu-item.ss-nav-menu-reg ul.sub-menu li.menu-item a:hover {
    <?php echo 'color:' . $goldenworks['topmenu-linkhover'] . ' !important;'; ?>
}
<?php } ?>


<?php if($goldenworks['topmenu-leftborder']) { ?>
.sf-menu ul li a:hover, .sf-menu li .current-menu-item > a,
#megaMenu ul.megaMenu li.menu-item.ss-nav-menu-reg ul.sub-menu li.menu-item a:hover,
#megaMenu ul.megaMenu li.ss-nav-menu-mega ul.sub-menu ul.sub-menu-2 li.menu-item a:hover, 
#megaMenu ul.megaMenu ul.sub-menu ul.sub-menu-2 > li.menu-item:hover > a {
    <?php echo 'border-left:3px solid ' . $goldenworks['topmenu-leftborder'] . ' !important;'; ?>
}
<?php } ?>

<?php } /* end of top menu color styling */ ?>


<?php if($goldenworks['footer-bg'] || $goldenworks['footer-textcolor'] || $goldenworks['footer-linkcolor'] || $goldenworks['footer-linkhover'] || $goldenworks['footer-headercolor']) { ?>

<?php if($goldenworks['footer-headercolor']) { ?>
.footer-wrapper h1, .footer-wrapper h2, .footer-wrapper h3, .footer-wrapper h4, .footer-wrapper h5, .footer-wrapper h6 {
    <?php echo 'color:' . $goldenworks['footer-headercolor'] . ';'; ?>    
}
<?php } ?>


<?php if($goldenworks['footer-bg']) { ?>
.footer-wrapper {
    <?php echo 'background:' . $goldenworks['footer-bg'] . ';'; ?>        
}
<?php } ?>

<?php if($goldenworks['footer-bottombg']) { ?>
.fbottom-wrapper {
    <?php echo 'background:' . $goldenworks['footer-bottombg'] . ';'; ?>   
}
<?php } ?>


<?php if($goldenworks['footer-textcolor']) { ?>
.footer-wrapper, .fbottom-wrapper {
    <?php echo 'color:' . $goldenworks['footer-textcolor'] . ';'; ?>      
}
<?php } ?>


<?php if($goldenworks['footer-linkcolor']) { ?>
.footer-wrapper a, .fbottom-wrapper a {
    <?php echo 'color:' . $goldenworks['footer-linkcolor'] . ';'; ?>        
}
<?php } ?>


<?php if($goldenworks['footer-linkhover']) { ?>
.footer-wrapper a:hover, .fbottom-wrapper a:hover {
    <?php echo 'color:' . $goldenworks['footer-linkhover'] . ';'; ?>     
}
<?php } ?>

 
<?php } /* end of footer color styling */ ?>


<?php if($goldenworks['sidebar-border']) { ?>
.widget_categories ul li, .widget_archive ul li, .widget_nav_menu ul li, .widget_recent_comments ul li, .widget_meta ul li, .widget_pages ul li, .widget_rss ul li,
.widget_gw_categories ul li, .border-list li {
    <?php echo 'border-bottom:1px solid ' . $goldenworks['sidebar-border'] . ';'; ?>
}
.widget_categories ul li:last-child, .widget_archive ul li:last-child, .widget_nav_menu ul li:last-child, .widget_recent_comments ul li:last-child, .widget_meta ul li:last-child, 
.widget_pages ul li:last-child, .widget_rss ul li:last-child, .widget_gw_categories ul li:last-child, .border-list li:last-child {
	border-bottom:0 none;
}

.widget ul li li:first-child, .border-list li li:first-child {
    <?php echo 'border-top:1px solid ' . $goldenworks['sidebar-border'] . ';'; ?>    
}
.widget_categories ul, .widget_archive ul, .widget_nav_menu ul, .widget_recent_comments ul, .widget_meta ul, .widget_pages ul, .widget_rss ul, .widget_gw_categories ul, .border-list,
.brochure-wrapper {
    <?php echo 'border:1px solid ' . $goldenworks['sidebar-border'] . ';'; ?>        
}

.widget_calendar table {
    <?php echo 'border:1px solid ' . $goldenworks['sidebar-border'] . ';'; ?>        
}
.widget_calendar table td {
    <?php echo 'border-top:1px solid ' . $goldenworks['sidebar-border'] . ';'; ?>
    <?php echo 'border-right:1px solid ' . $goldenworks['sidebar-border'] . ';'; ?>        
}
.widget_calendar caption {
    <?php echo 'border:1px solid ' . $goldenworks['sidebar-border'] . ';'; ?>      
}
<?php } ?>


<?php if($goldenworks['sidebar-linkcolor']) { ?>
.widget_categories ul li a, .widget_archive ul li a, .widget_nav_menu ul li a, .widget_recent_comments ul li a, .widget_meta ul li a, .widget_pages ul li a, .widget_rss ul li a,
.widget_gw_categories ul li a, .border-list li a {
    <?php echo 'color:' . $goldenworks['sidebar-linkcolor'] . ';'; ?>  
}
<?php } ?>


<?php if($goldenworks['sidebar-linkhover'] || $goldenworks['sidebar-linkhoverbg']) { ?>
.widget_categories ul li a:hover, .widget_archive ul li a:hover, .widget_nav_menu ul li a:hover, .widget_recent_comments ul li a:hover, .widget_meta ul li a:hover, 
.widget_pages ul li a:hover, .widget_rss ul li a:hover, .widget_gw_categories ul li a:hover, .border-list li a:hover {
    <?php echo 'color:' . $goldenworks['sidebar-linkhover'] . ';'; ?>
    <?php echo 'background:' . $goldenworks['sidebar-linkhoverbg'] . ';'; ?>		
}
<?php } ?>



/* ================ custom css that will overwrite any other css  ================ */
<?php if($goldenworks['custom-css']) {
	echo $goldenworks['custom-css'];
} ?>


