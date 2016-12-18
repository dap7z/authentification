<?php

/* home.twig */
class __TwigTemplate_48b454a939c3fbd0545d39b90b4daf7e90b8a042d81379920010082b37f62215 extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        // line 1
        $this->parent = $this->loadTemplate("templates/app.twig", "home.twig", 1);
        $this->blocks = array(
            'content' => array($this, 'block_content'),
        );
    }

    protected function doGetParent(array $context)
    {
        return "templates/app.twig";
    }

    protected function doDisplay(array $context, array $blocks = array())
    {
        $this->parent->display($context, array_merge($this->blocks, $blocks));
    }

    // line 3
    public function block_content($context, array $blocks = array())
    {
        // line 4
        echo "\t<div class=\"content\">
\t    <div class=\"title\">
\t\t";
        // line 6
        if ($this->getAttribute((isset($context["auth"]) ? $context["auth"] : null), "check", array())) {
            // line 7
            echo "\t\t\tBienvenue ";
            echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute((isset($context["auth"]) ? $context["auth"] : null), "user", array()), "surname", array()), "html", null, true);
            echo " ";
            echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute((isset($context["auth"]) ? $context["auth"] : null), "user", array()), "name", array()), "html", null, true);
            echo "
\t\t";
        } else {
            // line 9
            echo "\t\t\tBienvenue
\t\t";
        }
        // line 11
        echo "\t\t</div>
\t</div>
";
    }

    public function getTemplateName()
    {
        return "home.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  49 => 11,  45 => 9,  37 => 7,  35 => 6,  31 => 4,  28 => 3,  11 => 1,);
    }

    /** @deprecated since 1.27 (to be removed in 2.0). Use getSourceContext() instead */
    public function getSource()
    {
        @trigger_error('The '.__METHOD__.' method is deprecated since version 1.27 and will be removed in 2.0. Use getSourceContext() instead.', E_USER_DEPRECATED);

        return $this->getSourceContext()->getCode();
    }

    public function getSourceContext()
    {
        return new Twig_Source("", "home.twig", "D:\\DEV_TOOLS\\wamp64\\www\\authentification\\resources\\views\\home.twig");
    }
}
