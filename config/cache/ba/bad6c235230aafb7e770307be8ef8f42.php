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

/* layouts/admin_layoud.twig */
class __TwigTemplate_76673f7b39b2bb7bff2ca37a9071a513 extends Template
{
    private $source;
    private $macros = [];

    public function __construct(Environment $env)
    {
        parent::__construct($env);

        $this->source = $this->getSourceContext();

        $this->parent = false;

        $this->blocks = [
            'error' => [$this, 'block_error'],
            'content' => [$this, 'block_content'],
        ];
    }

    protected function doDisplay(array $context, array $blocks = [])
    {
        $macros = $this->macros;
        // line 1
        echo "<html lang=\"en\">
\t<head>
\t\t<meta charset=\"UTF-8\"/>
\t\t<meta name=\"viewport\" content=\"width=device-width, initial-scale=1.0\"/>
\t\t<title>Document</title>
\t\t<link rel=\"stylesheet\" href=\"https://cdn.jsdelivr.net/npm/rippleui@1.12.1/dist/css/styles.css\"/>
\t\t<link rel=\"stylesheet\" href=\"https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css\">
\t\t<script src=\"https://cdn.tailwindcss.com\"></script>

\t</head>
\t<body>
\t\t";
        // line 12
        $this->loadTemplate("components/drawer.twig", "layouts/admin_layoud.twig", 12)->display($context);
        // line 13
        echo "\t\t";
        $this->loadTemplate("components/navbar.twig", "layouts/admin_layoud.twig", 13)->display($context);
        // line 14
        echo "\t\t";
        $this->displayBlock('error', $context, $blocks);
        // line 15
        echo "
\t\t";
        // line 16
        $this->displayBlock('content', $context, $blocks);
        // line 17
        echo "\t</body>
</html>
";
    }

    // line 14
    public function block_error($context, array $blocks = [])
    {
        $macros = $this->macros;
    }

    // line 16
    public function block_content($context, array $blocks = [])
    {
        $macros = $this->macros;
    }

    public function getTemplateName()
    {
        return "layouts/admin_layoud.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  77 => 16,  71 => 14,  65 => 17,  63 => 16,  60 => 15,  57 => 14,  54 => 13,  52 => 12,  39 => 1,);
    }

    public function getSourceContext()
    {
        return new Source("", "layouts/admin_layoud.twig", "/srv/http/fempa_php/mvc/templates/layouts/admin_layoud.twig");
    }
}
