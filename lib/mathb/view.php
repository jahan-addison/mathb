<?php
/**
 * MathB view
 *
 * This script contains the View class that contains the definition of
 * the view to be displayed to the user.
 *
 * SIMPLIFIED BSD LICENSE
 * ----------------------
 *
 * Copyright (c) 2012-2013 Susam Pal
 * All rights reserved.
 *
 * Redistribution and use in source and binary forms, with or without
 * modification, are permitted provided that the following conditions
 * are met:
 *
 *   1. Redistributions of source code must retain the above copyright
 *      notice, this list of conditions and the following disclaimer.
 *   2. Redistributions in binary form must reproduce the above copyright
 *      notice, this list of conditions and the following disclaimer in
 *      the documentation and/or other materials provided with the
 *      distribution.
 *
 * THIS SOFTWARE IS PROVIDED BY THE COPYRIGHT HOLDERS AND CONTRIBUTORS
 * "AS IS" AND ANY EXPRESS OR IMPLIED WARRANTIES, INCLUDING, BUT NOT
 * LIMITED TO, THE IMPLIED WARRANTIES OF MERCHANTABILITY AND FITNESS FOR
 * A PARTICULAR PURPOSE ARE DISCLAIMED. IN NO EVENT SHALL THE COPYRIGHT
 * HOLDER OR CONTRIBUTORS BE LIABLE FOR ANY DIRECT, INDIRECT, INCIDENTAL,
 * SPECIAL, EXEMPLARY, OR CONSEQUENTIAL DAMAGES (INCLUDING, BUT NOT
 * LIMITED TO, PROCUREMENT OF SUBSTITUTE GOODS OR SERVICES; LOSS OF USE,
 * DATA, OR PROFITS; OR BUSINESS INTERRUPTION) HOWEVER CAUSED AND ON ANY
 * THEORY OF LIABILITY, WHETHER IN CONTRACT, STRICT LIABILITY, OR TORT
 * (INCLUDING NEGLIGENCE OR OTHERWISE) ARISING IN ANY WAY OUT OF THE USE
 * OF THIS SOFTWARE, EVEN IF ADVISED OF THE POSSIBILITY OF SUCH DAMAGE.
 *
 * @author Susam Pal <susam@susam.in>
 * @copyright 2012-2013 Susam Pal
 * @license http://mathb.in/5 Simplified BSD License
 * @version version 0.1
 * @since version 0.1
 */


namespace MathB;

use Susam\Pal;


/**
 * Defines how pages should be displayed
 *
 * This class contains various methods to generate various parts
 * of each web page of this application.
 *
 * @author Susam Pal <susam@susam.in>
 * @copyright 2012-2013 Susam Pal
 * @license http://mathb.in/5 Simplified BSD License
 * @version version 0.1
 * @since version 0.1
 */
class View
{
    /**
     * Bag of strings
     *
     * @var Bag
     */
    protected $bag;


    /**
     * An array of strings representing errors in the input
     *
     * @var array
     */
    protected $errors;


    /**
     * Whether static preview should be displayed
     *
     * @var boolean
     */
    protected $staticPreview;


    /**
     * Outputs input page
     *
     * @param Bag          $bag            A bag of strings to be used
     *                                     in this view
     * @param string|array $errors         A string or an array of
     *                                     strings with error messages
     *                                     to be displayed
     * @param boolean      $staticPreview  Whether static preview should
     *                                     be displayed
     *
     * @return void
     */
    public function inputPage($bag,
                              $errors = array(),
                              $staticPreview = false)
    {
        $this->bag = $bag;
        $this->errors = is_string($errors) ? array($errors) : $errors;
        $this->staticPreview = $staticPreview;

        $this->beginPage();
        $this->inputForm();
        $this->outputSheet();
        $this->endPage();
    }


    /**
     * Outputs an error page
     *
     * @param string $title Title of the error page
     * @param string $error Error message
     *
     * @return void
     */
    public function errorPage($bag, $error)
    {
        $this->bag = $bag;
        $this->beginPage();
?>
    <div class="errors">
        <h2><?php echo $this->bag->pageTitle ?></h2>
        <p><?php echo $error ?></p>
        <p><a href="/">Create new post</a></p>
    </div>
<?php
        $this->endPage();
    }

    /**
     * Outputs the beginning of a page
     *
     * This method generates the HTML code for the beginning
     * part of the page from the DOCTYPE declaration and opening
     * html tag to the beginning of the content.
     *
     * @param string $title HTML title of the page
     *
     * @return void
     */
    protected function beginPage()
    {
?>
<!DOCTYPE html>
<?php $this->licenseComment() ?>
<html>
<head>
    <title><?php echo $this->pageTitle() ?></title>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <!-- <link rel="icon" href="/favicon.ico"> -->
    <?php $this->styles() ?>
    <?php $this->mathjaxConfig() ?>
    <?php $this->scripts() ?>
</head>

<body>
<div id="particles-js"></div>

<div id="headerPanel">
    <?php echo $this->header() ?>
</div>
<div class="clearfix" id="main">
    <?php $this->noscriptNotice() ?>
<?php
    }


    /**
     * Outputs the beginning of a page
     *
     * This method generates the HTML code for the end of the
     * page from the end of the content to the closing html tag.
     *
     * @return void
     */
    protected function endPage()
    {
?>
</div> <!-- End main -->

<div id="footerPanel">
    <?php echo $this->footer() ?>
</div>
</body>
</html>
<?php
    }


    /**
     * Outputs inline license as an HTML comment
     *
     * This method is called between outputting the DOCTYPE declaration
     * and before outputting the opening html tag.
     *
     * @return void
     */
    protected function licenseComment()
    {
?>
<?php
    }


    /**
     * Outputs the title of the page
     *
     * The title of the page is obtained by combining the following:
     *
     *  1. Displayable title of the post: $this->bag->pageTitle
     *  2. Post author's name: $this->bag->inputName
     *  3. Site name: $this->siteName()
     *  4. Site title: $this->siteTitle()
     *
     * Each string in the above list is separated by ' - ', i.e. a
     * hyphen surround by spaces on either sides. The site title is
     * displayed if and only if both displayable title and post author's
     * name are empty strings.
     *
     * @return void
     */
    protected function pageTitle()
    {
        $prefix = false;

        if ($this->bag->pageTitle !== '') {
            echo $this->bag->pageTitle . ' - ';
            $prefix = true;
        }
        $this->siteTitle();

    }


    /**
     * Outputs a descriptive title of the site
     *
     * This title is displayed in the page title after the site name if
     * and only if there is no displayable post title and author's name.
     *
     * @return void
     */
    protected function siteTitle()
    {
        echo 'share maths';
    }


    /**
     * Outputs the name of the site
     *
     * This name is always displayed in the page title.
     *
     * @return void
     */
    protected function siteName()
    {
        echo 'MathB';
    }


    /**
     * Outputs the link tags to load style sheets.
     *
     * @return void
     */
    protected function styles()
    {
?><!-- MathB\View::styles -->
    <link rel="stylesheet" type="text/css" href="styles/base.css?v=7">
    <?php $this->staticPreviewStyle() ?>
<?php
    }


    /**
     * Outputs the link tag to load style for static preview
     *
     * This method outputs a style for static preview if and only
     * if static preview is enabled.
     *
     * @return void
     */
    protected function staticPreviewStyle()
    {
        if ($this->staticPreview === false)
            return;
?><!-- MathB\View::staticPreviewStyle -->
    <noscript>
    <link rel="stylesheet" type="text/css" href="styles/noscript.css">
    </noscript>
<?php
    }


    /**
     * Outputs the MathJax configuration script
     *
     * This script goes in the HTML head element and defines the MathJax
     * configuration.
     *
     * @return void
     */
    protected function mathjaxConfig()
    {
?><!-- MathB\View::mathjaxConfig -->
    <script type="text/x-mathjax-config">
        MathJax.Hub.Config({
          tex2jax: {
            inlineMath: [ ['$','$'], ["\\(","\\)"] ],
            processEscapes: true
          },
          "HTML-CSS": {
             scale: 85,
             preferredFont: "STIX"
         },
          TeX: {
            equationNumbers: {
                autoNumber: "AMS"
            }
          },
          skipStartupTypeset: true,
        });
    </script>
<?php
    }


    /**
     * Outputs the script tags to load scripts
     *
     * @return void
     */
    protected function scripts()
    {
?><!-- MathB\View::scripts -->
    <script src="thirdparty/MathJax/MathJax.js?config=TeX-AMS_HTML"></script>
    <script src="thirdparty/pagedown/Markdown.Converter.js"></script>
    <script src="scripts/mathb.js"></script>
    <script>window.onload = MathB.init</script>
<?php
    }


    /**
     * Outputs the header of the page
     *
     * @return void
     */
    protected function header()
    {
?><!-- MathB\View::header -->
    <div id="header">
        <h1>
            <a href="/"><?php $this->siteName() ?></a>
        </h1>
    </div><div id="navigation">
        <span>
            [ <a href="/">New post</a> ]
        </span><span>
            [ <a href="http://github.com/susam/mathb">Source</a> ]
        </span>
    </div>
<?php
    }


    /**
     * Outputs the footer of the page
     *
     * @return void
     */
    protected function footer()
    {
?><!-- MathB\View::header -->
    <div id="footer">
        <div id="navigation">
            <a href="/">New post</a>
            <a href="//github.com/susam/mathb">Source code</a>
            <a href="//github.com/susam/mathb/issues">Report issues</a>
        </div>
        <div id="copyright">
            <p>
            λ Dark theme and contributions by <a target="_blank" href="https://github.com/jahan-addison/mathb">jahan</a>.
            </p>
            <p>
            λ <a href="http://mathb.in/5">License</a>
            </p>
        </div>
    </div>
<?php
    }


    protected function noscriptNotice()
    {
        if ($this->staticPreview === true)
            return;
?><!-- MathB\View::noscriptNotice -->
    <noscript>
        <p id="noscript">JavaScript must be enabled to use this tool.</p>
    </noscript>
<?php
    }


    /**
     * Outputs the input form
     *
     * This method outputs the HTML form where the user is expected to
     * type HTML, LaTeX and Markdown code.
     *
     * @return void
     */
    protected function inputForm()
    {
?>
    <div class="input">
        <div id="form">
            <form class="box" method="post"
                  action="<?php echo $this->bag->actionURL ?>">

                <?php $this->errors() ?>

                <!-- Input code -->
                <textarea id="code" name="code" required
                          placeholder="<?php $this->inputTips() ?>"><?php
                                echo $this->bag->inputCode ?></textarea>

                <!-- Input title -->
                <input type="text" id="title" name="title"
                       placeholder="title of the post (optional)"
                       value="<?php echo $this->bag->inputTitle ?>">

                <!-- Input name -->
                <input type="text" id="name" name="name"
                       placeholder="your name (optional)"
                       value="<?php echo $this->bag->inputName ?>">

                <!-- Input secret URL -->
                <div id="secretURL">
                    <input type="checkbox" id="secrecy" name="secrecy" <?php
                           echo $this->bag->secrecyAttribute ?> value="yes">
                    <label for="secrecy">
                        Private URL
                    </label>
                </div>

                <!-- Hidden ID -->
                <input type="hidden" id="id" name="id"
                       value="<?php echo $this->bag->postID ?>">

                <!-- Hidden date -->
                <input type="hidden" id="date" name="date"
                       value="<?php echo $this->bag->date ?>">

                <!-- Preview button -->
                <noscript>
                <input type="submit" id="preview" name="preview"
                       value="<?php $this->previewLabel() ?>">
                </noscript>

                <!-- Submit button -->
                <input class="btn1" type="submit" id="submit" name="submit"
                       value="<?php $this->submitLabel() ?>">
            </form>
        </div> <!-- End form -->
    </div> <!-- End input -->
<?php
    }


    /**
     * Outputs the output sheet displaying the rendered math content
     *
     * This method outputs the HTML div elements containing the math
     * content rendered by MathJax and PageDown.
     */
    protected function outputSheet()
    {
?>
    <div class="output">
        <!-- Output sheet -->
        <div id="sheet">
            <h1 id="outputTitle" <?php
                echo $this->bag->outputTitleClass ?>><?php
                echo $this->bag->outputTitle ?></h1>
            <h2 id="outputName" <?php
                echo $this->bag->outputNameClass ?>><?php
                echo $this->bag->outputName ?></h2>

            <?php $this->staticPreview() ?>

            <div id="outputCode">
                <?php echo $this->bag->outputCode ?>
            </div>
            <div id="outputDate"><?php echo $this->bag->date ?></div>
        </div>
        <?php $this->permanentURL() ?>
    </div> <!-- End output -->
<?php
    }


    /**
     * Outputs a list of errors in the input
     *
     * This method outputs a list of errors in the input.
     *
     * @return void
     */
    protected function errors()
    {
        // Do nothing if there are no errors
        if (count($this->errors) === 0)
            return;

?><!-- MathB\View::errors -->
                <div class="errors">
                <p>
                    Post failed due to the following
                    error<?php echo count($this->errors) > 1 ? 's' : '' ?>:
                </p><ul>
<?php
        foreach ($this->errors as $error) {
?>
                    <li><?php echo $error ?></li>
<?php
        }
?>
                </ul>
                </div>
<?php
    }


    /**
     * Outputs tips on how to enter input
     *
     * This method outputs tips on how to enter input. This is used in
     * the placeholder attribute of HTML textarea element for the input.
     *
     * @return void
     */
    protected function inputTips()
    {
        echo 'Enter LaTeX, Markdown and HTML code here. ' .
             'Enclose inline math within $ and $, or \( and \). ' .
             'Enclose displayed math within $$ and $$, or \[ and \]. ' .
             'The following commands work outside math mode: ' .
             '\ref, \eqref, \begin, \end and \$. ' .
             'Put spaces on both sides of less-than sign.';
    }


    /**
     * Outputs description of secret URL
     *
     * @return void
     */
    protected function secrecyTips()
    {
?><!-- MathB\View::secrecyTips -->
                        (An URL with a secret component)
<?php
    }


    /**
     * Outputs the preview
     *
     * @return void
     */
    protected function previewLabel()
    {
        echo 'Preview';
    }


    /**
     * Outputs the label used for submit button
     *
     * @return void
     */
    protected function submitLabel()
    {
        if ($this->bag->postID === '')
            echo 'Save';
        else
            echo 'Update and get new URL';
    }


    /**
     * Outputs static preview of the post
     *
     * This method outputs static preview if and only if server
     * side preview is enabled.
     *
     * @return void
     */
    protected function staticPreview()
    {
        if ($this->staticPreview === false)
            return;

        // The $this->bag->previewImageURL check needs to be there only
        // for the img tag generation, and not for this entire method
        // because we want the outputImage div element to be generated
        // when static preview is enabled and JavaScript is disabled
        // because this div element provides a minimum height to the
        // output sheet. Without this element, the output sheet would
        // look ridiculously short.
?><!-- MathB\View::staticPreview -->
            <noscript>
            <div id="outputImage">
            <?php if ($this->bag->previewImageURL !== '') { ?><!-- if { -->
                <img src="<?php echo $this->bag->previewImageURL ?>"
                     alt="Markdown, LaTeX and HTML rendered as image">
            <?php } ?><!-- } -->
            </div>
            </noscript>
<?php
    }


    /**
     * Displays permanent URL if there is a post ID available
     *
     * @return void
     */
    protected function permanentURL()
    {
        echo "<!-- MathB\View::permanentURL -->\n";
        if ($this->bag->postURL === '') {
            return;
        }
?>
        <div id="permaurl">
            <label for="url">URL:</label>
            <input id="url" type="text" readonly
                   value="<?php echo $this->bag->postURL ?>">
        </div>
<?php
    }


    /**
     * Displays copyright notice
     *
     * @return void
     */
    protected function copyrightNotice()
    {
        echo '&copy; 2012&ndash;2013 ' .
             '<a href="http://susam.in">Susam Pal</a>';
    }
}
?>

