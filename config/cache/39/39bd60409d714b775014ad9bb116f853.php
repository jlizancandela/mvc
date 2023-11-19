<?php

use Twig\Environment;
use Twig\Error\LoaderError;
use Twig\Error\RuntimeError;
use Twig\Extension\SandboxExtension;
use Twig\Markup;
use Twig\Sandbox\SecurityError;
use Twig\Sandbox\SecurityNotAllowedTagError;
use Twig\Sandbox\SecurityNotAllowedFilterError;
use Twig\Sandbox\SecurityNotAllowedFunctionError;
use Twig\Source;
use Twig\Template;

/* components/drawer.twig */
class __TwigTemplate_9ec566ec4cf851fd21f5703d28e8eae6 extends Template
{
    private $source;
    private $macros = [];

    public function __construct(Environment $env)
    {
        parent::__construct($env);

        $this->source = $this->getSourceContext();

        $this->parent = false;

        $this->blocks = [
        ];
    }

    protected function doDisplay(array $context, array $blocks = [])
    {
        $macros = $this->macros;
        // line 1
        echo "<div
\tclass=\"absolute bg-gray-800 text-white w-56 min-h-screen overflow-y-auto transition-transform transform -translate-x-full ease-in-out duration-300\" id=\"sidebar\">
\t<!-- Your Sidebar Content -->
\t<div class=\"p-4\">
\t\t<h1 class=\"text-2xl font-semibold\">Sidebar</h1>
\t\t<ul class=\"mt-4\">
\t\t\t<li class=\"mb-2\">
\t\t\t\t<a href=\"admin\" class=\"block hover:text-indigo-400\">
\t\t\t\t\t<i class=\"bi bi-people\"></i>
\t\t\t\t\tUsers</a>
\t\t\t</li>
\t\t\t<li class=\"mb-2\">
\t\t\t\t<a href=\"#\" class=\"block hover:text-indigo-400\">About</a>
\t\t\t</li>
\t\t\t<li class=\"mb-2\">
\t\t\t\t<a href=\"#\" class=\"block hover:text-indigo-400\">Services</a>
\t\t\t</li>
\t\t\t<li class=\"mb-2\">
\t\t\t\t<a href=\"#\" class=\"block hover:text-indigo-400\">Contact</a>
\t\t\t</li>
\t\t</ul>
\t</div>
</div>
";
    }

    public function getTemplateName()
    {
        return "components/drawer.twig";
    }

    public function getDebugInfo()
    {
        return array (  37 => 1,);
    }

    public function getSourceContext()
    {
        return new Source("", "components/drawer.twig", "/srv/http/fempa_php/mvc/templates/components/drawer.twig");
    }
}
