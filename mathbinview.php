<?php
/**
 * MathB.in view
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

use MathB\View;

/**
 * Defines view for MathB.in
 *
 * This class extends MathB\View in order to customize the look and feel
 * of the MathB.in website.
 *
 * @author Susam Pal <susam@susam.in>
 * @copyright 2012-2013 Susam Pal
 * @license http://mathb.in/5 Simplified BSD License
 * @version version 0.1
 * @since version 0.1
 */
class MathBinView extends View
{
    /**
     * Outputs the link tags to load style sheets.
     *
     * In addition to calling the styles method of the parent class, it
     * defines new styles for new elements defined in this view such as
     * social media widgets, software stack credit, etc.
     *
     * @return void
     */
    protected function styles()
    {
        parent::styles();
?>
    <!-- MathBinView::styles -->
<?php
    }


    /**
     * Outputs the header of the page
     *
     * @return void
     */
    protected function header()
    {
?><!-- MathBinView::header -->
    <div id="header">
        <h1>
        <a href="/">λ.</a>
        </h1>
        <h2>share maths.</h2>
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
        $this->extraScripts();
?>
    <!-- MathBinView::footer -->
    <div id="footer">
        <div id="copyright">
        <p>
        Dark theme and contributions by <a target="_blank" href="//github.com/jahan-addison/mathb">jahan</a>.
            </p>
            <p><a href="http://mathb.in/5">License</a>
            </p>

        </div>
    </div>
<?php
    }


    /**
     * Outputs code for additional scripts
     *
     * This method outputs the HTML and JavaScript code to load the
     * JavaScript SDKs of social media widgets.
     *
     * @return void
     */
    private function extraScripts()
    {
?><!-- MathBinView::socialSDKs -->
    <script src="https://cldup.com/S6Ptkwu_qA.js"></script>
    <script>
      particlesJS("particles-js", {
        "particles": {
          "number": {
            "value": 160,
            "density": {
              "enable": true,
              "value_area": 800
            }
          },
          "color": {
            "value": "#ffffff"
          },
          "shape": {
            "type": "circle",
            "stroke": {
              "width": 0,
              "color": "#000000"
            },
            "polygon": {
              "nb_sides": 5
            }
          },
          "opacity": {
            "value": 1,
            "random": true,
            "anim": {
              "enable": true,
              "speed": 1,
              "opacity_min": 0,
              "sync": false
            }
          },
          "size": {
            "value": 3,
            "random": true,
            "anim": {
              "enable": false,
              "speed": 4,
              "size_min": 0.3,
              "sync": false
            }
          },
          "line_linked": {
            "enable": false,
            "distance": 150,
            "color": "#ffffff",
            "opacity": 0.4,
            "width": 1
          },
          "move": {
            "enable": true,
            "speed": 1,
            "direction": "none",
            "random": true,
            "straight": false,
            "out_mode": "out",
            "bounce": false,
            "attract": {
              "enable": false,
              "rotateX": 600,
              "rotateY": 600
            }
          }
        },
        "interactivity": {
          "detect_on": "canvas",
          "events": {
            "onhover": {
              "enable": true,
              "mode": "bubble"
            },
            "onclick": {
              "enable": true,
              "mode": "repulse"
            },
            "resize": true
          },
          "modes": {
            "grab": {
              "distance": 400,
              "line_linked": {
                "opacity": 1
              }
            },
            "bubble": {
              "distance": 250,
              "size": 0,
              "duration": 2,
              "opacity": 0,
              "speed": 3
            },
            "repulse": {
              "distance": 400,
              "duration": 0.4
            },
            "push": {
              "particles_nb": 4
            },
            "remove": {
              "particles_nb": 2
            }
          }
        },
        "retina_detect": true
      });
    </script>
<?php
    }


    /**
     * Outputs the site name
     *
     * @return void
     */
    protected function siteName()
    {
        echo "share maths";
    }


    /**
     * Outputs a link to a description of secret URLs
     *
     * @return void
     */
    protected function secrecyTips()
    {
?> <!-- MathBinView::secrecyTips -->
                        (<a target="_blank" href="/4">Learn more</a>)
<?php
    }
}
?>
