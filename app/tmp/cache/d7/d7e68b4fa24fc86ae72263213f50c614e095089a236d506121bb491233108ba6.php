<?php

/* templates/partials/navigation.twig */
class __TwigTemplate_765807955884bdcb314af7401ebcac3210142b92ccee33f33608ae9d3b44d565 extends Twig_Template
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
        echo "<nav id=\"navbar\" class=\"navbar navbar-inverse navbar-fixed-top\">
      <div class=\"container\">
        <div class=\"navbar-header\">
          <button type=\"button\" class=\"navbar-toggle collapsed\" data-toggle=\"collapse\" data-target=\"#navbar\" aria-expanded=\"false\" aria-controls=\"navbar\">
            <span class=\"sr-only\">Toggle navigation</span>
            <span class=\"icon-bar\"></span>
            <span class=\"icon-bar\"></span>
            <span class=\"icon-bar\"></span>
          </button>
          <a class=\"navbar-brand\" href=\"";
        // line 10
        echo twig_escape_filter($this->env, $this->env->getExtension('Slim\Views\TwigExtension')->pathFor("home"), "html", null, true);
        echo "\">Gestion des utilisateurs</a>
        </div>
        <div id=\"navbar\" class=\"navbar-collapse collapse\">
          <ul class=\"nav navbar-nav navbar-right\">
            ";
        // line 14
        if ($this->getAttribute((isset($context["auth"]) ? $context["auth"] : null), "check", array())) {
            // line 15
            echo "            <li class=\"dropdown\">
              <a href=\"#\" class=\"dropdown-toggle\" data-toggle=\"dropdown\" role=\"button\" aria-haspopup=\"true\" aria-expanded=\"false\">";
            // line 16
            echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute((isset($context["auth"]) ? $context["auth"] : null), "user", array()), "email", array()), "html", null, true);
            echo " <span class=\"caret\"></span></a>
              <ul class=\"dropdown-menu\">
\t\t\t\t\t<li><a href=\"";
            // line 18
            echo twig_escape_filter($this->env, $this->env->getExtension('Slim\Views\TwigExtension')->pathFor("home"), "html", null, true);
            echo "\"><img src=\"/assets/icons/24x24/home.png\"/> Accueil</a></li>
\t\t\t\t\t";
            // line 19
            if ($this->getAttribute((isset($context["auth"]) ? $context["auth"] : null), "checkadmin", array())) {
                // line 20
                echo "\t\t\t\t\t\t<li><a href=\"";
                echo twig_escape_filter($this->env, $this->env->getExtension('Slim\Views\TwigExtension')->pathFor("users.getlist"), "html", null, true);
                echo "\"><img src=\"/assets/icons/24x24/process.png\"/> Gérer les utilisateurs</a></li>
\t\t\t\t\t";
            }
            // line 22
            echo "\t\t\t\t\t<li role=\"separator\" class=\"divider\"></li>
                <li class=\"dropdown-header\">Mon compte</li>
                <li><a href=\"";
            // line 24
            echo twig_escape_filter($this->env, $this->env->getExtension('Slim\Views\TwigExtension')->pathFor("auth.password.change"), "html", null, true);
            echo "\"><img src=\"/assets/icons/24x24/edit_item.png\"/> Modifier mon mot de passe</a></li>
                <li><a href=\"";
            // line 25
            echo twig_escape_filter($this->env, $this->env->getExtension('Slim\Views\TwigExtension')->pathFor("auth.signout"), "html", null, true);
            echo "\"><img src=\"/assets/icons/24x24/logout.png\"/> Me déconnecter</a></li>
              </ul>
            </li>
            ";
        } else {
            // line 29
            echo "            <li><a href=\"";
            echo twig_escape_filter($this->env, $this->env->getExtension('Slim\Views\TwigExtension')->pathFor("auth.signin"), "html", null, true);
            echo "\"><img src=\"/assets/icons/24x24/login.png\"/> Se connecter</a></li>
            <li><a href=\"";
            // line 30
            echo twig_escape_filter($this->env, $this->env->getExtension('Slim\Views\TwigExtension')->pathFor("auth.signup"), "html", null, true);
            echo "\"><img src=\"/assets/icons/24x24/note.png\"/> S'enregistrer</a></li>
            ";
        }
        // line 32
        echo "          </ul>
        </div><!--/.nav-collapse -->
      </div>
    </nav>";
    }

    public function getTemplateName()
    {
        return "templates/partials/navigation.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  84 => 32,  79 => 30,  74 => 29,  67 => 25,  63 => 24,  59 => 22,  53 => 20,  51 => 19,  47 => 18,  42 => 16,  39 => 15,  37 => 14,  30 => 10,  19 => 1,);
    }

    /** @deprecated since 1.27 (to be removed in 2.0). Use getSourceContext() instead */
    public function getSource()
    {
        @trigger_error('The '.__METHOD__.' method is deprecated since version 1.27 and will be removed in 2.0. Use getSourceContext() instead.', E_USER_DEPRECATED);

        return $this->getSourceContext()->getCode();
    }

    public function getSourceContext()
    {
        return new Twig_Source("", "templates/partials/navigation.twig", "D:\\DEV_TOOLS\\wamp64\\www\\authentification\\resources\\views\\templates\\partials\\navigation.twig");
    }
}
