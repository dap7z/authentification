<?php

/* auth/signin.twig */
class __TwigTemplate_95c06710d5a5c34b890cc8cca4f39e4845eb32ee4985fc665f4830b4f977ea4d extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        // line 1
        $this->parent = $this->loadTemplate("templates/app.twig", "auth/signin.twig", 1);
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
        echo "    <div class=\"row\">
    \t<div class=\"col-md-6 col-md-offset-3\">
    \t\t<div class=\"panel panel-default\">
    \t\t\t<div class=\"panel-heading\">Connexion</div>
    \t\t\t<div class=\"panel-body\">
    \t\t\t\t<form action=\"";
        // line 9
        echo twig_escape_filter($this->env, $this->env->getExtension('Slim\Views\TwigExtension')->pathFor("auth.signin"), "html", null, true);
        echo "\" method=\"post\">
    \t\t\t\t\t<div class=\"form-group has-feedback ";
        // line 10
        echo (($this->getAttribute((isset($context["errors"]) ? $context["errors"] : null), "email", array())) ? (" has-error") : (""));
        echo "\">
    \t\t\t\t\t\t<label for=\"email\">Adresse email</label>
\t\t\t\t\t\t\t<input type=\"email\" name=\"email\" id=\"email\" placeholder=\"\" class=\"form-control\" value=\"admin@demo.fr\" />
\t\t\t\t\t\t\t<span class=\"glyphicon glyphicon-envelope form-control-feedback\"></span>
    \t\t\t\t\t</div>

    \t\t\t\t\t<div class=\"form-group has-feedback ";
        // line 16
        echo (($this->getAttribute((isset($context["errors"]) ? $context["errors"] : null), "password", array())) ? (" has-error") : (""));
        echo "\">
    \t\t\t\t\t\t<label for=\"password\">Mot de passe</label>
    \t\t\t\t\t\t<input type=\"password\" name=\"password\" id=\"password\" class=\"form-control\" value=\"password\">
\t\t\t\t\t\t\t<span class=\"glyphicon glyphicon-asterisk form-control-feedback\"></span>
    \t\t\t\t\t</div>
\t\t\t\t\t\t<button type=\"submit\" class=\"btn btn-primary\" style=\"width:40%; margin-top:15px;\">Se Connecter</button>

                        ";
        // line 23
        echo $this->getAttribute((isset($context["csrf"]) ? $context["csrf"] : null), "field", array());
        echo "
    \t\t\t\t</form>
    \t\t\t</div>
    \t\t</div>
    \t</div>
    </div>
";
    }

    public function getTemplateName()
    {
        return "auth/signin.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  61 => 23,  51 => 16,  42 => 10,  38 => 9,  31 => 4,  28 => 3,  11 => 1,);
    }

    /** @deprecated since 1.27 (to be removed in 2.0). Use getSourceContext() instead */
    public function getSource()
    {
        @trigger_error('The '.__METHOD__.' method is deprecated since version 1.27 and will be removed in 2.0. Use getSourceContext() instead.', E_USER_DEPRECATED);

        return $this->getSourceContext()->getCode();
    }

    public function getSourceContext()
    {
        return new Twig_Source("", "auth/signin.twig", "D:\\DEV_TOOLS\\wamp64\\www\\authentification\\resources\\views\\auth\\signin.twig");
    }
}
