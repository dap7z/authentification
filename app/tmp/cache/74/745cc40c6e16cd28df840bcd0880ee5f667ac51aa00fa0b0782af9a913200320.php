<?php

/* templates/partials/flash.twig */
class __TwigTemplate_700d6850b08c967f45e889a4c4916c7d8fbd4740e1614727ad9e9fcbf7fb00ca extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        $this->parent = false;

        $this->blocks = array(
        );
    }

    protected function doDisplay(array $context, array $blocks = array())
    {
        // line 1
        if ($this->getAttribute((isset($context["flash"]) ? $context["flash"] : null), "getMessage", array(0 => "info"), "method")) {
            // line 2
            echo "\t<div class=\"alert alert-info\">
\t\t";
            // line 3
            echo twig_escape_filter($this->env, twig_first($this->env, $this->getAttribute((isset($context["flash"]) ? $context["flash"] : null), "getMessage", array(0 => "info"), "method")), "html", null, true);
            echo "
\t</div>
";
        }
        // line 6
        echo "
";
        // line 7
        if ($this->getAttribute((isset($context["flash"]) ? $context["flash"] : null), "getMessage", array(0 => "error"), "method")) {
            // line 8
            echo "\t<div class=\"alert alert-danger\">
\t\t";
            // line 9
            echo twig_escape_filter($this->env, twig_first($this->env, $this->getAttribute((isset($context["flash"]) ? $context["flash"] : null), "getMessage", array(0 => "error"), "method")), "html", null, true);
            echo "
\t</div>
";
        }
        // line 12
        echo "
";
    }

    public function getTemplateName()
    {
        return "templates/partials/flash.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  44 => 12,  38 => 9,  35 => 8,  33 => 7,  30 => 6,  24 => 3,  21 => 2,  19 => 1,);
    }

    /** @deprecated since 1.27 (to be removed in 2.0). Use getSourceContext() instead */
    public function getSource()
    {
        @trigger_error('The '.__METHOD__.' method is deprecated since version 1.27 and will be removed in 2.0. Use getSourceContext() instead.', E_USER_DEPRECATED);

        return $this->getSourceContext()->getCode();
    }

    public function getSourceContext()
    {
        return new Twig_Source("", "templates/partials/flash.twig", "D:\\DEV_TOOLS\\wamp64\\www\\authentification\\resources\\views\\templates\\partials\\flash.twig");
    }
}
