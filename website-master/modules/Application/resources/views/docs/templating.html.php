<?php

$toc = array(
    'introduction'        => 'Introduction',
    'base-templates'      => 'Base Templates',
    'extending-base-templates' => 'Extending Base Templates',
    'example-scenario'    => 'Example Scenario',
    'using-slots-helper'  => 'Using the slots helper',
    'using-assets-helper' => 'Using the assets helper',
    'using-the-router'    => 'Using the router helper'
);

?>

<div id="toc-data" style="display: none;"><?=json_encode($toc);?></div>

<div class="section-subbar clearfix">
     <a class="prev-page btn" title="Controllers" href="<?=$view['router']->generate('DocsIndex', array('page' => 'controllers'));?>">
         <img src="<?=$view['assets']->getUrl('images/docs/previous-page.png');?>" alt="Previous">&nbsp;&nbsp;Controllers
     </a>
     <div class="main-title">Templating</div>
<!--     <a class="next-page" title="Modules" href=""><img src="--><?//=$view['assets']->getUrl('images/docs/next-page.png');?><!--" alt="Previous"></a>-->
 </div>

<div class="content-box docs-page">

        <section>
            
        <p class="section-title" id='introduction'>Introduction</p>
        <p>
            As discovered in the previous chapter, a controller's job is to process each HTTP request that hits your web application. 
            Once your controller has finished its processing it usually wants to generate some output content. To achieve this it hands over responsibility to the templating engine. 
            The templating engine will load up the template file you tell it to, and then generate the output you want, his can be in the form of a redirect, HTML webpage output, XML, CSV, JSON; you get the picture! 
        </p>
        <p><b>In this chapter you'll learn:</b></p>
        <ul>
            <li>How to create a base template</li>
            <li>How to load templates from your controller</li>
            <li>How to pass data into templates</li>
            <li>How to extend a parent template</li>
            <li>How to use template helpers</li>
        </ul>
            
            
        <p class="section-title" id='base-templates'>Base Templates</p>
        <p><b>What are base templates?</b></p>
        <p>Why do we need base templates? well you don't want to have to repeat HTML over and over again and perform repetative steps for every different type of page you have. There's usually some commonalities between the templates and this commonality is your base template. The part that's usually different is the <b>content</b> page of your webpage, such as a users profile or a blog post.</p></p>
        <p>So lets see an example of what we call a <b>base template</b>, or somethings referred to as a <b>master template</b>. This is all the HTML structure of your webpage including headers and footers, and the part that'll change will be everything inside the <b>page-content</b> section.</p>
        <p><b>Where are they stored?</b></p>
        <p>Base templates are stored in the <b>./app/views/</b> directory. You can have as <b>many</b> base templates as you like in there.</p>
        <p>This file is <b>./app/views/base.html.php</b></p>
            
        <p><b>Example base template</b></p>
        <pre><code>
&lt;!DOCTYPE html&gt;
&lt;html&gt;
    &lt;head&gt;
        &lt;title&gt;Welcome to Symfony!&lt;/title&gt;
    &lt;/head&gt;
    &lt;body&gt;
        &lt;div id="header"&gt;...&lt;/div&gt;
        &lt;div id="page-content"&gt;
            &lt;?php $view['slots']->output('_content'); ?&gt;
        &lt;/div&gt;
        &lt;div id="footer"&gt;...&lt;/div&gt;
    &lt;/body&gt;
&lt;/html&gt;
            
        </code></pre>
            
        <p>
            Lets recap a little, you see that <b>slots helper</b> outputting something called <b>_content</b>? 
            Well this is actually injecting the resulting output of the <b>CHILD</b> template belonging to this base template. 
            Yes that means we have child templates that extend parent/base templates. This is where things get interesting! Keep on reading.
        </p>
            
        
        <p class="section-title" id='extending-base-templates'>Extending Base Templates</p>
        <p>On our first line we extend the base template we want. You can extend literally any template you like by specifying its <b>Module:folder:file.format.engine</b> naming syntax. If you miss out the <b>Module</b> and <b>folder</b> sections, such as <b>::base.html.php</b> then it's going to take the global route of <b>./app/views/</b>.</p>
        <pre><code>
&lt;?php $view-&gt;extend('::base.html.php'); ?&gt;
&lt;div class="user-registration-page"&gt;
    &lt;h1&gt;Register for our site&lt;/h1&gt;
    &lt;form&gt;...&lt;/form&gt;
&lt;/div&gt;
            
        </code></pre>
        
        
        <p><b>The resulting output</b></p>
        <p>If you remember that the <b>extend</b> call is really just populating a <b>slots</b> section named <b>_content</b> then the injected content into the parent template looks like this.</p>
        <pre><code>
&lt;!DOCTYPE html&gt;
&lt;html&gt;
    &lt;head&gt;
        &lt;title&gt;Welcome to Symfony!&lt;/title&gt;
    &lt;/head&gt;
    &lt;body&gt;
        &lt;div id="header"&gt;...&lt;/div&gt;
        &lt;div id="page-content"&gt;
    
            &lt;div class="user-registration-page"&gt;
                &lt;h1&gt;Register for our site&lt;/h1&gt;
                &lt;form&gt;...&lt;/form&gt;
            &lt;/div&gt;
    
        &lt;/div&gt;
        &lt;div id="footer"&gt;...&lt;/div&gt;
    &lt;/body&gt;
&lt;/html&gt;
            
        </code></pre>    
            
            
        
        
        <p class="section-title" id='example-scenario'>Example scenario</p>
        <p>Consider the following scenario. We have the route <b>Blog_Show</b> which executes the action <b>"Application:Blog:show"</b>. We then load up a template named <b>Application:blog:show.html.php</b> which is designed to show the user their blog post.</p>
            
        <p><b>The route</b></p>
        <pre><code>
        Blog_Show:
            pattern: /blog/{id}
            defaults: { _controller: "Application:Blog:show"}
            
        </code></pre>
            
        <p><b>The controller</b></p>
        <pre><code>
&lt;?php
namespace Application\Controller;

use Application\Controller\Shared as BaseController;

class Blog extends BaseController {

    public function showAction() {
    
        $blogID = $this->getRouteParam('id');
        $bs     = $this->getBlogStorage();
    
        if(!$bs->existsByID($blogID)) {
            $this->setFlash('error', 'Invalid Blog ID');
            return $this->redirectToRoute('Blog_Index');
        }
    
        // Get the blog post for this ID
        $blogPost = $bs->getByID($blogID);
        
        // Render our blog post page, passing in our $blogPost article to be rendered
        $this->render('Application:blog:show.html.php', compact('blogPost'));
    }
}
            
        </code></pre>
            
        <p><b>The template</b></p>
        <p>So the name of the template loaded is <b>Application:blog:show.html.php</b> then this is going to translate to <b>./modules/Application/blog/show.html.php</b>. We also passed in a <b>$blogPost</b> variable which can be used locally within the template that you'll see below.</p>
        <pre><code>
&lt;?php $view-&gt;extend('::base.html.php'); ?&gt;
    
&lt;div class="blog-post-page"&gt;
    &lt;h1&gt;&lt;?=$blogPost-&gt;getTitle();?&gt;&lt;/h1&gt;
    &lt;p class="created-by"&gt;&lt;?=$blogPost-&gt;getCreatedBy();?&gt;&lt;/p&gt;
    &lt;p class="content"&gt;&lt;?=$blogPost-&gt;getContent();?&gt;&lt;/p&gt;
&lt;/div&gt;
            
        </code></pre>
            
        <p class="section-title" id='using-slots-helper'>Using the slots helper</p>
        <p>We have a bunch of template helpers available to you, the helpers are stored in the <b>$view</b> variable, such as <b>$view['slots']</b> or <b>$view['assets']</b>. So what is the purpose of using slots? Well they're really for segmenting the templates up into <b>named</b> sections and this allows the <b>child</b> templates to specify content that the parent is going to inject for them.</p>
        <p>Review this example it shows a few examples of using the slots helper for various different reasons.</p>
            
        <p><b>The base template</b></p>
        <pre><code>
&lt;!DOCTYPE html&gt;
&lt;html&gt;
    &lt;head&gt;
        &lt;meta http-equiv="Content-Type" content="text/html; charset=utf-8" /&gt;
        &lt;title&gt;&lt;?php $view['slots']-&gt;output('title', 'PPI Skeleton Application') ?&gt;&lt;/title&gt;
    &lt;/head&gt;
    &lt;body&gt;
        &lt;div id="page-content"&gt;
            &lt;?php $view['slots']-&gt;output('_content') ?&gt;
        &lt;/div&gt;
    &lt;/body&gt;
&lt;/html&gt;
            
        </code></pre>
        
        <p><b>The child template</b></p>
        <pre><code>
&lt;?php $view-&gt;extend('::base.html.php'); ?&gt;
    
&lt;div class="blog-post-page"&gt;
    &lt;h1&gt;&lt;?=$blogPost-&gt;getTitle();?&gt;&lt;/h1&gt;
    &lt;p class="created-by"&gt;&lt;?=$blogPost-&gt;getCreatedBy();?&gt;&lt;/p&gt;
    &lt;p class="content"&gt;&lt;?=$blogPost-&gt;getContent();?&gt;&lt;/p&gt;
&lt;/div&gt;
    
&lt;?php $view['slots']->start('title'); ?&gt;
Welcome to the blog page
&lt;?php $view['slots']->stop(); ?&gt;
            
        </code></pre>
        
        <p><b>What's going on?</b></p>
        <p>The slots key we specified first was <b>title</b> and we gave the output method a second parameter, this means when the child template does <b>not</b> specify a slot section named <b>title</b> then it will default to <b>PPI Skeleton Application</b>.</p>
            
        <p class="section-title" id='using-assets-helper'>Using the assets helper</p>
        <p>So why do we need an assets helper? Well one main purpose for it is to include asset files from your project's <b>./public/</b> folder such as <b>images, css files, javascript files</b>. This is useful because we're never hard-coding any baseurl's anywhere so it will work on any environment you host it on.</p>
        <p>Review this example it shows a few examples of using the slots helper for various different reasons such as including CSS and JS files.</p>
        <pre><code>
&lt;?php $view-&gt;extend('::base.html.php'); ?&gt;
    
&lt;div class="blog-post-page"&gt;
    
    &lt;h1&gt;&lt;?=$blogPost-&gt;getTitle();?&gt;&lt;/h1&gt;
    
    &lt;img src="&lt;?=$view['assets']->getUrl('images/blog.png');?&gt;" alt="The Blog Image"&gt;
    
    &lt;p class="created-by"&gt;&lt;?=$blogPost-&gt;getCreatedBy();?&gt;&lt;/p&gt;
    &lt;p class="content"&gt;&lt;?=$blogPost-&gt;getContent();?&gt;&lt;/p&gt;
    
    &lt;?php $view['slots']-&gt;start('include_js'); ?&gt;
    &lt;script type="text/javascript" src="&lt;?=$view['assets']-&gt;getUrl('js/blog.js');?&gt;"&gt;&lt;/script&gt;
    &lt;?php $view['slots']-&gt;stop(); ?&gt;
    
    &lt;?php $view['slots']-&gt;start('include_css'); ?&gt;
    &lt;link href="&lt;?=$view['assets']-&gt;getUrl('css/blog.css');?&gt;" rel="stylesheet"&gt;
    &lt;?php $view['slots']-&gt;stop(); ?&gt;
    
&lt;/div&gt;
            
        </code></pre>
            
        <p><b>What's going on?</b></p>
        <p>By asking for <b>images/blog.png</b> we're basically asking for <b>www.mysite.com/images/blog.png</b>, pretty straight forward right? Our <b>include_css</b> and <b>include_js</b> slots blocks are custom HTML that's loading up CSS/JS files just for this paritcular page load. This is great because you can split your application up onto smaller CSS/JS files and only load the required assets for your particular page, rather than having to bundle all your CSS into the one file.</p>
        
        <p class="section-title" id='using-the-router'>Using the router helper</p>
        <p>What is a router helper? The router help is a nice PHP class with routing related methods on it that you can use while you're building PHP templates for your application.</p>
        <p>What's it useful for? The most common use for this is to perform a technique commonly known as <b>reverse routing</b>. Basically this is the process of taking a <b>route key</b> and turning that into a URL, rather than the standard process of having a URL and that translate into a route to become dispatched.</p>
        <p>Why is reverse routing needed? Lets take the <b>Blog_Show</b> route we made earlier in the routing section. The syntax of that URI would be like: <b>/blog/show/{title}</b>, so rather than having numerous HTML links all manually referring to <b>/blog/show/my-title</b> we always refer to its route key instead, that way if we ever want to change the URI to something like <b>/blog/post/{title}</b> the templating layer of your application won't care because that change has been centrally maintained in your module's routes file.</p>
        <p>Here are some examples of reverse routing using the routes helper</p>
        <pre><code>
&lt;a href="&lt;?=$view['router']-&gt;generate('About_Page');?&gt;"&gt;About Page&lt;/a&gt;
            
&lt;p&gt;User List&lt;/p&gt;
&lt;ul&gt;
&lt;?php foreach($users as $user): ?&gt;
    &lt;li&gt;&lt;a href="&lt;?=$view['router']-&gt;generate('User_Profile', array('id' =&gt; $user-&gt;getID())); ?&gt;"&gt;&lt;?=$view-&gt;escape($user-&gt;getName());?&gt;&lt;/a&gt;&lt;/li&gt;
&lt;?php endforeach; ?&gt;
&lt;/ul&gt;
        </code></pre>
        
        <p>The output would be something like this</p>
<pre><code>
&lt;a href="/about"&gt;About Page&lt;/a&gt;
    
&lt;p&gt;User List&lt;/p&gt;
&lt;ul&gt;
    &lt;li&gt;&lt;a href="/user/profile?id=23"&gt;PPI User&lt;/a&gt;&lt;/li&gt;
    &lt;li&gt;&lt;a href="/user/profile?id=87675"&gt;Another PPI User&lt;/a&gt;&lt;/li&gt;
&lt;/ul&gt;
    
        </code></pre>
        
        </section>
        
</div>
