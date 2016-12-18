<?php

/* templates/app.twig */
class __TwigTemplate_c4a8985fa673cf478b3c57c037331e48115859cbf6070c71b3ad5ad806b5912f extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        $this->parent = false;

        $this->blocks = array(
            'content' => array($this, 'block_content'),
        );
    }

    protected function doDisplay(array $context, array $blocks = array())
    {
        // line 1
        echo "<!DOCTYPE html>
<html lang=\"fr\">
<head>
\t<meta charset=\"UTF-8\">
\t<title>Gestion des utilisateurs</title>
\t
\t<!-- jquery -->
\t<script src=\"https://cdnjs.cloudflare.com/ajax/libs/jquery/2.2.3/jquery.min.js\"></script>
\t<script src=\"https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.3/jquery.mask.min.js\"></script>
\t<script src=\"https://cdnjs.cloudflare.com/ajax/libs/jquery-cookie/1.4.1/jquery.cookie.min.js\"></script>
\t<!-- bootstrap -->
\t<link rel=\"stylesheet\" href=\"https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css\" integrity=\"sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7\" crossorigin=\"anonymous\">
\t<script src=\"https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js\" integrity=\"sha384-0mSbJDEHialfmuBBQP6A4Qrprq5OVfW37PRR3j5ELqxss1yVqOtnepnHVP9aJ7xS\" crossorigin=\"anonymous\"></script>
\t<!-- ax5ui -->
\t<link rel=\"stylesheet\" type=\"text/css\" href=\"https://cdn.rawgit.com/ax5ui/ax5ui-grid/master/dist/ax5grid.css\" />
\t<link rel=\"stylesheet\" type=\"text/css\" href=\"https://cdn.rawgit.com/ax5ui/ax5ui-toast/master/dist/ax5toast.css\" />
\t<script type=\"text/javascript\" src=\"https://cdn.rawgit.com/ax5ui/ax5core/master/dist/ax5core.min.js\"></script>
\t<script type=\"text/javascript\" src=\"https://cdn.rawgit.com/ax5ui/ax5ui-grid/master/dist/ax5grid.min.js\"></script>
\t<script type=\"text/javascript\" src=\"https://cdn.rawgit.com/ax5ui/ax5ui-toast/master/dist/ax5toast.min.js\"></script>
\t<!-- app -->
\t<link rel=\"stylesheet\" href=\"/assets/css/app.css\">
\t<script src=\"/assets/js/app.js\"></script>
\t
</head>
<body>
\t";
        // line 26
        $this->loadTemplate("templates/partials/navigation.twig", "templates/app.twig", 26)->display($context);
        // line 27
        echo "\t<div class=\"container\">
\t\t";
        // line 28
        $this->loadTemplate("templates/partials/flash.twig", "templates/app.twig", 28)->display($context);
        // line 29
        echo "\t\t";
        $this->displayBlock('content', $context, $blocks);
        // line 32
        echo "
\t</div>
\t
\t<!-- js data -->
\t<script>
\t\tvar jsdata = ";
        // line 37
        echo twig_jsonencode_filter((isset($context["jsdata"]) ? $context["jsdata"] : null));
        echo ";\t//tout data contenu dans le tableau \$_SESSION[\"jsdata\"];
\t\tjsdata['auth'] = parseInt(";
        // line 38
        echo twig_escape_filter($this->env, $this->getAttribute((isset($context["auth"]) ? $context["auth"] : null), "check", array()), "html", null, true);
        echo ") || 0;
\t\tjsdata['admin'] = parseInt(";
        // line 39
        echo twig_escape_filter($this->env, $this->getAttribute((isset($context["auth"]) ? $context["auth"] : null), "checkadmin", array()), "html", null, true);
        echo ") || 0;
\t\tjsdata['view'] = window.location.pathname;
\t\t
\t\t//pour 'view', il serait préférable d'utiliser le nom de la route car l'url est susceptible de changer
\t\t//mais code si dessous ne fonctionne pas tel quel :
\t\tjsdata['testRouteName'] = \"";
        // line 44
        echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute($this->getAttribute((isset($context["app"]) ? $context["app"] : null), "request", array()), "attributes", array()), "get", array(0 => "_route"), "method"), "html", null, true);
        echo "\";
\t</script>
\t
</body>
</html>";
    }

    // line 29
    public function block_content($context, array $blocks = array())
    {
        // line 30
        echo "\t\t    
\t\t";
    }

    public function getTemplateName()
    {
        return "templates/app.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  92 => 30,  89 => 29,  80 => 44,  72 => 39,  68 => 38,  64 => 37,  57 => 32,  54 => 29,  52 => 28,  49 => 27,  47 => 26,  20 => 1,);
    }

    /** @deprecated since 1.27 (to be removed in 2.0). Use getSourceContext() instead */
    public function getSource()
    {
        @trigger_error('The '.__METHOD__.' method is deprecated since version 1.27 and will be removed in 2.0. Use getSourceContext() instead.', E_USER_DEPRECATED);

        return $this->getSourceContext()->getCode();
    }

    public function getSourceContext()
    {
        return new Twig_Source("", "templates/app.twig", "D:\\DEV_TOOLS\\wamp64\\www\\authentification\\resources\\views\\templates\\app.twig");
    }
}
