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

/* components/navbar.twig */
class __TwigTemplate_61a61591948704ad6b449865fc21d9b3 extends Template
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
        echo "<div class=\"navbar\">
\t<div class=\"navbar-start\">
\t\t<a class=\"navbar-item\" href=\"home\">ROPA ONLINE</a>
\t</div>
\t<div class=\"navbar-center\">
\t\t<a href=\"articles?public=mujer\" class=\"navbar-item\">Mujer</a>
\t\t<a href=\"articles?public=hombre\" class=\"navbar-item\">Hombre</a>
\t\t";
        // line 8
        if (twig_get_attribute($this->env, $this->source, ($context["session"] ?? null), "login", [], "any", false, false, false, 8)) {
            // line 9
            echo "\t\t\t<a href=\"articles?ofertas=1\" class=\"navbar-item\">Ofertas</a>
\t\t";
        }
        // line 11
        echo "

\t</div>
\t<div class=\"navbar-end\">
\t\t<a class=\"navbar-item\">CONTACTO</a>
\t\t";
        // line 16
        if (twig_get_attribute($this->env, $this->source, ($context["session"] ?? null), "login", [], "any", false, false, false, 16)) {
            // line 17
            echo "\t\t\t<a class=\"navbar-item\" href=\"logout\">LOGOUT</a>
\t\t";
        } else {
            // line 19
            echo "\t\t\t<a class=\"navbar-item\" href=\"login\">LOGIN</a>
\t\t";
        }
        // line 21
        echo "
\t\t";
        // line 22
        if ((twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, ($context["session"] ?? null), "rol", [], "any", false, false, false, 22), "Rol", [], "any", false, false, false, 22) == "Admin")) {
            // line 23
            echo "\t\t\t<button class=\"text-gray-500 hover:text-gray-600\" id=\"open-sidebar\">
\t\t\t\t<svg class=\"w-6 h-6\" fill=\"none\" stroke=\"currentColor\" viewbox=\"0 0 24 24\" xmlns=\"http://www.w3.org/2000/svg\">
\t\t\t\t\t<path stroke-linecap=\"round\" stroke-linejoin=\"round\" stroke-width=\"2\" d=\"M4 6h16M4 12h16M4 18h16\"></path>
\t\t\t\t</svg>
\t\t\t</button>
\t\t";
        }
        // line 29
        echo "
\t</div>
</div>
<script>
\tconst sidebar = document.getElementById('sidebar');
const openSidebarButton = document.getElementById('open-sidebar');

openSidebarButton.addEventListener('click', (e) => {
e.stopPropagation();
sidebar.classList.toggle('-translate-x-full');
});

// Close the sidebar when clicking outside of it
document.addEventListener('click', (e) => {
if (! sidebar.contains(e.target) && ! openSidebarButton.contains(e.target)) {
sidebar.classList.add('-translate-x-full');
}
});
</script>
";
    }

    public function getTemplateName()
    {
        return "components/navbar.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  82 => 29,  74 => 23,  72 => 22,  69 => 21,  65 => 19,  61 => 17,  59 => 16,  52 => 11,  48 => 9,  46 => 8,  37 => 1,);
    }

    public function getSourceContext()
    {
        return new Source("", "components/navbar.twig", "/srv/http/fempa_php/mvc/templates/components/navbar.twig");
    }
}
