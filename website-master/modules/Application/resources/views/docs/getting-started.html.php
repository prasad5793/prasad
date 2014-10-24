<?php
$toc = array(
    'downloading-ppi' => 'Downloading PPI',
    'system-requirements' => 'System Requirements'
);

?>

<div id="toc-data" style="display: none;"><?=json_encode($toc);?></div>

<div class="section-subbar clearfix">
<!--     <a class="prev-page" title="Getting Started"><img src="--><?//=$view['assets']->getUrl('images/docs/previous-page.png');?><!--" alt="Previous"></a>-->
    <div class="main-title">Getting Started</div>
    <a class="next-page btn" title="The Skeleton Application" href="<?=$view['router']->generate('DocsIndex', array('page' => 'application'));?>">
        The Skeleton Application&nbsp;&nbsp;<img src="<?=$view['assets']->getUrl('images/docs/next-page.png');?>" alt="Next">
    </a>
 </div>
    
<div class="content-box docs-page">
    
    <section class='content'>

        

<!--				<p id='standing-on-the-shoulders-of-giants' class="section-title">Standing on the shoulders of giants</p>-->
<!---->
<!--				<p>PPI has pre-integrated the best features from existing frameworks for you, allowing you to just-->
<!--					utilize-->
<!--					them at will with no tedious integration process. We're re-using the power of Symfony2 for Routing,-->
<!--					Request, Response, Templating and Class Autoloading. ZendFramework2's Module component to provide-->
<!--					simple-->
<!--					and clean modularity in your application. For database abstraction of the PDO library we're using-->
<!--					Doctrine2's clean DBAL component which has been made easy to use through PPI's DataSource-->
<!--					component.</p>-->

            <p class="section-title" id='downloading-ppi'>Downloading PPI</p>

            <p>You can download the ppi skeletonaapp from the <a href="<?=$view['router']->generate('Homepage');?>" title="Homepage">Homepage</a>. If you just want everything in one folder ready to go, you should choose the <b>"ppi skeletonapp with vendors"</b> option.</p>
            <p>If you are comfortable with using <b>git</b> then you can download the <b>"skeleton app without vendors"</b> option and run the following commands:
            <pre><code>
curl -s http://getcomposer.org/installer | php
php composer.phar install
            </code></pre>

            <p id='system-requirements' class="section-title">System requirements</p>
            <p>A web server with its rewrite module enabled. (mod_rewrite for apache)</p>
            <p>PPI needs <b>5.3.3</b> or above. The recommended version by symfony is <b>5.3.10</b> or above.</p>

    </section>

</div>